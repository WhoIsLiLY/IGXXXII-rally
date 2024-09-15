<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesertaKotalamaController extends Controller
{
    public function showpage()
    {
        $userID = Auth::user()->id;
        $player = DB::table("players")->where("user_id", $userID)->first();
        $kotalama = DB::table('kotalama')
                    ->select('total_passengers', 'total_duration', 'location_id')
                    ->where('player_id', $player->id)
                    ->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $maps = DB::table('maps')->select('city_id', 'has_added_passenger')->where('player_id', $player->id)->get();

        if (!$bus) {
            DB::table('buses')->insert([
                'player_id' => $player->id,
                'fuel' => 25,
                'passenger' => 0,
            ]);
            $bus = DB::table('buses')->where('player_id', $player->id)->first();
        }

        // ID untuk Kota A
        $cityAId = 1;

        $cityARecord = DB::table('maps')
            ->select('has_added_passenger')
            ->where('player_id', $player->id)
            ->where('city_id', $cityAId)
            ->first();

        if ($cityARecord) {
            if (!$cityARecord->has_added_passenger) {
                if ($bus) { // Check if bus exists
                    // Add 50 passengers to the bus
                    DB::table('buses')->where('id', $bus->id)->increment('passenger', 50);

                    // Update the `has_added_passenger` field to true
                    DB::table('maps')
                        ->where('player_id', $player->id)
                        ->where('city_id', $cityAId) // Ensure we update the correct record
                        ->update(['has_added_passenger' => true]);
                } else {
                    // Handle case where the bus doesn't exist (optional)
                    // e.g., you could create a bus record or log a message.
                }
            } else {
                if ($bus) { // Check if bus exists
                    // If already added, increment by 0 (no change)
                    DB::table('buses')->where('id', $bus->id)->increment('passenger', 0);
                }
            }
        }

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
            $newFuel = ($cityData->name === 'Pom Bensin' || $cityData->name === 'Kota Lama') ? 25 : $bus->fuel - $distance;

            DB::table('buses')->where('id', $bus->id)->update(['fuel' => $newFuel]);

            if ($cityData->name === 'Kota Lama') {
                // Player reaches Kota Lama
                $totalPassengers = $kotalama->total_passengers + $bus->passenger;

                DB::table('kotalama')->where('player_id', $player->id)->update([
                    'total_passengers' => $totalPassengers
                ]);
                DB::table('buses')->where('id', $bus->id)->update(['passenger' => 0]);

                $newPassengerCount = 0; 

            } else {
                // Player does not reach Kota Lama
                if ($cityData->visited) {
                    $newPassengerCount = $bus->passenger; 
                    DB::table('cities')->where('id', $destinationCityId)->update(['passenger' => 0]);
                } else {
                    $newPassengerCount = $bus->passenger + $cityData->passenger;
                    DB::table('cities')->where('id', $destinationCityId)->update(['visited' => true]);
                }
                DB::table('buses')->where('id', $bus->id)->update(['passenger' => $newPassengerCount]);
            }

            // Update total durasi
            $existingDuration = $kotalama->total_duration;
            $totalDuration = $existingDuration + $duration;

            DB::table('kotalama')->where('player_id', $player->id)->update([
                'location_id' => $destinationCityId,
                'total_duration' => $totalDuration
            ]);

            return response()->json([
                'status' => 'success',
                'remainingFuel' => $newFuel,
                'newPassengerCount' => $newPassengerCount,
                'totalPassengers' => $totalPassengers ?? $kotalama->total_passengers,
                'totalDuration' => $totalDuration
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Out of fuel!']);
        }
    }

    public function restart()
    {
        $userID = Auth::user()->id;
        $player = DB::table("players")->where("user_id", $userID)->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $playerKota = DB::table('kotalama')->where('player_id', $player->id)->first();

        if ($playerKota->has_restarted == false) {
            if ($bus->fuel <= 20) {
                $cityAId = 1; 

                DB::table('kotalama')->where('player_id', $player->id)->update([
                    'location_id' => $cityAId,
                    'has_restarted' => true
                ]);

                DB::table('buses')->where('id', $bus->id)->update(['fuel' => 25]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Game restarted. You have been moved back to City A.'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot restart. Fuel is not empty yet.'
                ], 400); 
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot restart again. You have already restarted once.'
            ], 400); 
        }
    }

    public function saveScore(Request $request)
    {
        $userID = Auth::user()->id;
        $player = DB::table('players')->where('user_id', $userID)->first();
        $kotalama = DB::table('kotalama')->where('player_id', $player->id)->first();

        $pointsForPassengers = $kotalama->total_passengers * 10;

        if ($kotalama->total_passengers >= 150) {
            $pointsForPassengers += 100;
        }
        $pointsForDuration = ($kotalama->total_duration <= 117) ? 400 : 100;

        $totalScore = $pointsForPassengers + $pointsForDuration;

        DB::table('players')->where('id', $player->id)->update(['score' => $totalScore]);

        return response()->json([
            'status' => 'success',
            'finalScore' => 'Total Score anda adalah ' . $totalScore . '.'
        ]);
    }
}