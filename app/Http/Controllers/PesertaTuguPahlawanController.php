<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\tuguPahlawan\TupalAnswer;
use App\Models\tuguPahlawan\TupalQuestion;

class PesertaTuguPahlawanController extends Controller
{
    /*
    protected $player;
    public function __construct(Player $player)
    {
        $this->player = $player;
    }*/
    public function showPage(){
        $userID = Auth::user()->id;
        $p = DB::table("players")->where("user_id", $userID)->first();
        $player = Player::getPlayerById($p->id);
        
        //$player = Player::with(['tupals', 'playersStandsAds', 'tupalLogs', 'lokets'])->findOrFail($id);
        return view('peserta.tugupahlawan', compact('player'));
    }
    public function checkQuestion(Request $request)
    {
        $playerId = Auth::user()->id; // Asumsikan player sudah login
        $questionId = $request->input('question_id');

        // Cek apakah player sudah menjawab pertanyaan ini sebelumnya
        $existingAnswer = TupalAnswer::where('player_id', $playerId)
                                     ->where('tupal_question_id', $questionId)
                                     ->first();

        if ($existingAnswer) {
            return response()->json([
                'status' => false,
                'message' => 'Pertanyaan ini sudah pernah dijawab sebelumnya.'
            ]);
        }

        // Jika belum pernah dijawab, ambil pertanyaan dan jawabannya
        $question = TupalQuestion::with('choices')->find($questionId);

        return response()->json([
            'status' => true,
            'question' => $question,
        ]);
    }
}
