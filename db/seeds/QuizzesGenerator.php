<?php

use Phinx\Seed\AbstractSeed;

class QuizzesGenerator extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $fakeQuizzes = [];
        for ($i = 0; $i < 10; $i++) {
            $fakeQuizzes[] = $this->getFakeQuiz();
        }

        $this->insert('filegame_quizzes', $fakeQuizzes);
    }

    private function getFakeQuiz()
    {
        $faker = Faker\Factory::create();
        $choices = $faker->words(4);
        $answer = $choices[mt_rand(0, 3)];

        $quiz = [
            'quiz' => $faker->realText(30),
            'choices' => json_encode($choices, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'reward' => mt_rand(5, 50),
            'answer' => $answer,
            'started_at' => '2018-10-03 08:30:00',
            'expired_at' => '2018-10-31 17:30:00',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $quiz;
    }
}
