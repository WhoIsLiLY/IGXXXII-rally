<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TupalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tupal_questions')->insert([
            [
                'question' => 'What is the capital of France?',
                'img_name' => "1.png",
                'answer' => 'a',
                'a' => 'Paris',
                'b' => 'London',
                'c' => 'Rome',
                'd' => 'Berlin',
                'e' => 'Madrid',
                'point' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Which planet is known as the Red Planet?',
                'img_name' => null,
                'answer' => 'c',
                'a' => 'Earth',
                'b' => 'Venus',
                'c' => 'Mars',
                'd' => 'Jupiter',
                'e' => 'Saturn',
                'point' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Who wrote "Hamlet"?',
                'img_name' => null,
                'answer' => 'b',
                'a' => 'Charles Dickens',
                'b' => 'William Shakespeare',
                'c' => 'Leo Tolstoy',
                'd' => 'Mark Twain',
                'e' => 'Homer',
                'point' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
