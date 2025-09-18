<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // 1. General Info
            [
                'text' => 'What is your full name?',
                'type' => 'text',
                'expected_answer' => null,
                'max_marks' => 5,
            ],
            [
                'text' => 'What is your age?',
                'type' => 'text',
                'expected_answer' => null,
                'max_marks' => 5,
            ],
            [
                'text' => 'What is your highest level of education?',
                'type' => 'text',
                'expected_answer' => null,
                'max_marks' => 10,
            ],

            // 2. File Uploads
            [
                'text' => 'Upload a clear scanned copy of your passport.',
                'type' => 'file',
                'expected_answer' => null,
                'max_marks' => 0, // no AI grading
            ],
            [
                'text' => 'Upload a recent passport-size photo.',
                'type' => 'file',
                'expected_answer' => null,
                'max_marks' => 0,
            ],

            // 3. English Skills (Basic)
            [
                'text' => 'Write a short paragraph about your family.',
                'type' => 'text',
                'expected_answer' => 'A simple paragraph in English, with basic grammar and vocabulary.',
                'max_marks' => 10,
            ],
            [
                'text' => 'Describe your favorite book or movie in English.',
                'type' => 'text',
                'expected_answer' => 'A short description in English showing understanding of simple ideas.',
                'max_marks' => 10,
            ],
            [
                'text' => 'Why do you want to join this program/job? Answer in English.',
                'type' => 'text',
                'expected_answer' => 'Clear motivation expressed in English, with correct basic sentence structure.',
                'max_marks' => 10,
            ],
            [
                'text' => 'Write three sentences using the past tense in English.',
                'type' => 'text',
                'expected_answer' => 'Three correctly formed past tense sentences.',
                'max_marks' => 10,
            ],
            [
                'text' => 'What are your hobbies? Write at least 5 sentences in English.',
                'type' => 'text',
                'expected_answer' => 'Five correct and simple sentences in English.',
                'max_marks' => 10,
            ],

            // 4. English Skills (Extended: verbs, adverbs, sentence completion)
            [
                'text' => 'Write 3 sentences using different verbs in the present tense.',
                'type' => 'text',
                'expected_answer' => 'Three sentences with clear use of present tense verbs (e.g., run, eat, play).',
                'max_marks' => 10,
            ],
            [
                'text' => 'Write 3 sentences that include adverbs (e.g., quickly, slowly, happily).',
                'type' => 'text',
                'expected_answer' => 'Sentences with adverbs modifying verbs, showing understanding of adverb use.',
                'max_marks' => 10,
            ],
            [
                'text' => 'Complete the sentence: "I am looking forward to ________ you."',
                'type' => 'text',
                'expected_answer' => 'Correct use of gerund/verb form such as "meeting" or "seeing".',
                'max_marks' => 10,
            ],
            [
                'text' => 'Fill in the blank with the correct form of the verb: "She ________ to school every day."',
                'type' => 'text',
                'expected_answer' => 'Correct present tense verb, e.g., "goes".',
                'max_marks' => 10,
            ],
            [
                'text' => 'Write 5 sentences in English that use future tense.',
                'type' => 'text',
                'expected_answer' => 'Five correctly formed future tense sentences (e.g., "I will travel tomorrow.").',
                'max_marks' => 10,
            ],
        ];

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
