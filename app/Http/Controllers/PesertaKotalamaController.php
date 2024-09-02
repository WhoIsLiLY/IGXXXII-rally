<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesertaKotalamaController extends Controller
{
    public function showpage(){
        $userID = Auth::user()->id;
        $player = DB::table("players")->where("user_id", $userID)->first();
        $kotalama = DB::table('kotalama')
                      ->join('cities as c','c.id','=','kotalama.location_id')
                      ->select('total_passengers', 'total_duration', 'c.name', 'location_id')
                      ->where('player_id', $player->id)
                      ->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $maps = DB::table('maps')->select('city_id')->where('player_id', $player->id)->get();
    
        $destinationList = DB::table('roads as r')
            ->join('maps as m', 'm.city_id', '=', 'r.origin_id')
            ->join('players as p', 'p.id', '=', 'm.player_id')
            ->where('p.id', $player->id)
            ->where('r.origin_id', $kotalama->location_id)
            ->whereIn('r.destination_id', function ($query) use ($player) {
                $query->select('city_id')
                    ->from('maps')
                    ->where('player_id', $player->id);
            })->pluck('r.destination_id');
    
        // Ambil semua data kota untuk digunakan di view
        $cities = DB::table('cities')->get()->keyBy('id');
    
        return view('peserta.kotalama', compact('player', 'kotalama', 'bus', 'maps', 'destinationList', 'cities'));
    }
    
    public function moveCity(Request $request)
    {
        $userID = Auth::user()->id;
        $player = DB::table("players")->where("user_id", $userID)->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $kotalama = DB::table('kotalama')->where('player_id', $player->id)->first();

        $destinationCityId = $request->input('city_id');
        $cityData = DB::table('cities')->where('id', $destinationCityId)->first();
        $road = DB::table('roads')
                    ->where('origin_id', $kotalama->location_id)
                    ->where('destination_id', $destinationCityId)
                    ->first();

        if (!$road) {
            return response()->json(['status' => 'error', 'message' => 'Road does not exist!']);
        }

        $distance = $road->distance;
        $speed = $road->speed;

        // Perhitungan duration (distance / speed)
        $duration = $distance / $speed;

        // Cek bensin
        if ($bus->fuel >= $distance) {
            $newFuel = ($cityData->name === 'Pom Bensin') ? 25 : $bus->fuel - $distance;
            DB::table('buses')->where('id', $bus->id)->update(['fuel' => $newFuel]);

            // Cek uda pernah lewat atau belum
            if ($cityData->visited) {
                $newPassengerCount = 0; // Kalo uda jadi 0 passengernya
            } else {
                $newPassengerCount = $bus->passenger + $cityData->passenger;
                // Mark city as visited
                DB::table('cities')->where('id', $destinationCityId)->update(['visited' => true]);
            }

            // Update the bus with the new passenger count
            DB::table('buses')->where('id', $bus->id)->update(['passenger' => $newPassengerCount]);

            // Update total passengers
            $totalPassengers = $kotalama->total_passengers + ($cityData->visited ? 0 : $cityData->passenger);
            DB::table('kotalama')->where('player_id', $player->id)->update(['total_passengers' => $totalPassengers]);

            // Update lokasi
            DB::table('kotalama')->where('player_id', $player->id)->update(['location_id' => $destinationCityId]);

            // Update total durasi
            $existingDuration = $kotalama->total_duration;
            $totalDuration = $existingDuration + $duration;
            DB::table('kotalama')->where('player_id', $player->id)->update(['total_duration' => $totalDuration]);

            return response()->json([
                'status' => 'success',
                'remainingFuel' => $newFuel,
                'newPassengerCount' => $newPassengerCount,
                'totalPassengers' => $totalPassengers,
                'totalDuration' => $totalDuration
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Out of fuel!']);
        }
    }
}
