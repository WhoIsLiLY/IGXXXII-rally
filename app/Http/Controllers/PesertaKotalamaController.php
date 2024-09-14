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
                      ->select('total_passengers', 'total_duration', 'location_id')
                      ->where('player_id', $player->id)
                      ->first();
        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $maps = DB::table('maps')->select('city_id')->where('player_id', $player->id)->get();

        // ID untuk Kota A
        $cityAId = 1;

        $hasOpenedCityA = DB::table('maps')
            ->where('player_id', $player->id)
            ->where('city_id', $cityAId)
            ->exists();

        if ($hasOpenedCityA) {
            DB::table('buses')->where('id', $bus->id)->increment('passenger', 50);
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

        if ($player->has_restarted) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah pernah melakukan restart. Anda tidak dapat restart lagi',
            ]);
        }

        $bus = DB::table('buses')->where('player_id', $player->id)->first();
        $kotalama = DB::table('kotalama')->where('player_id', $player->id)->first();

        $cityAId = 1; // ID untuk City A

        DB::table('kotalama')->where('player_id', $player->id)->update([
            'location_id' => $cityAId
        ]);

        DB::table('buses')->where('id', $bus->id)->update([
            'fuel' => 25, 
        ]);

        DB::table('kotalama')->where('id', $player->id)->update([
            'has_restarted' => true
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Anda berhasil kembali ke Kota A.',
            'newLocation' => 'City A',
            'newFuel' => 25,
        ]);
    }



    public function saveScore(Request $request)
    {
        $userID = Auth::user()->id;
        $player = DB::table('players')->where('user_id', $userID)->first();
        $kotalama = DB::table('kotalama')->where('player_id', $player->id)->first();

        $visitedCityC = DB::table('city')
            ->where('player_id', $player->id)
            ->where('name', 'c')
            ->value('visited');

        if ($visitedCityC != true) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum mengunjungi kota C, skor tidak dapat disimpan.'
            ]);
        }

        $pointsForPassengers = $kotalama->total_passengers * 10;

        if ($kotalama->total_passengers >= 150) {
            $pointsForPassengers += 100;
        }

        $pointsForDuration = ($kotalama->total_duration <= 117) ? 400 : 100;

        $totalScore = $pointsForPassengers + $pointsForDuration;

        DB::table('players')->updateOrInsert(
            ['id' => $userID],
            ['score' => $totalScore]
        );

        return response()->json([
            'status' => 'success',
            'finalScore' => $totalScore
        ]);
    }
}