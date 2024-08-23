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
        $userId = Auth::user()->id; // Asumsikan player sudah login
        $questionId = $request->input('question_id');
        $player = Player::where('user_id', $userId)->first();
        //dd($player);

        // Jika belum pernah dijawab, ambil pertanyaan dan jawabannya
        $question = TupalQuestion::find($questionId);
        if($question){
            $existingAnswer = TupalAnswer::where('player_id', $player->id)
                                        ->where('tupal_question_id', $questionId)
                                        ->first();
                                        //dd($existingAnswer);
            if ($existingAnswer) {
                return redirect()->back()->with([
                    'questionStatus' => false,
                    'questionMessage' => 'Pertanyaan ini sudah pernah dijawab sebelumnya.'
                ]);
            }
            return redirect()->back()->with([
                'questionStatus' => true,
                'questionMessage' => $question,
            ]);
        }else{
            return redirect()->back()->with([
                'questionStatus' => false,
                'questionMessage' => 'Pertanyaan tidak ditemukan!'
            ]);
        }
    }
    public function checkAnswer(Request $request){
        $userId = Auth::user()->id; // Asumsikan player sudah login
        $questionId = $request->input('question_id');
        $userAnswer = $request->input('answer');
        $player = Player::where('user_id', $userId)->first();

        // Ambil pertanyaan dan jawaban yang benar dari database
        $question = TupalQuestion::findOrFail($questionId);
        $correctAnswer = $question->answer; // Jawaban yang benar, misalnya 'A'
    
        // Bandingkan jawaban yang diberikan user dengan jawaban yang benar
        $isCorrect = ($userAnswer === $correctAnswer);
        TupalAnswer::create([
            'player_id' => $player->id,
            'tupal_question_id' => $questionId,
            'answer' => $userAnswer,
            'status' => $isCorrect ? 'Benar' : 'Salah', // Menyimpan status jawaban
        ]);
        // Update poin player jika jawaban benar
        if ($isCorrect) {
            // Anda dapat menambahkan logika untuk update poin player di sini
            $player->load('tupals');
            $tupal = $player->tupals;
            $tupal->point += $question->point;
            $tupal->save();

            // Berikan feedback ke user
            return redirect()->back()->with([
                'answerStatus' => true,
                'answerMessage' => 'Jawaban benar!'
            ]);
        }
        return redirect()->back()->with([
            'answerStatus' => false,
            'answerMessage' => 'Jawaban salah!'
        ]);
    }
}
