<?php


use Phinx\Migration\AbstractMigration;

class InsertFieldGameQuizzes extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('filegame_quizzes');
        $quizzes = $this->getQuizzes();
        if (!empty($quizzes)) {
        $table->insert($quizzes)->save();
    }
    }

    public function down()
    {
        $idMax = count($this->getQuizzes());
        $this->execute("DELETE FROM filegame_quizzes WHERE quiz_id <= '$idMax'");
    }

    public function getQuizzes()
    {
        $raw_str = "";

        $tmp = explode("\n", base64_decode($raw_str));
        $quizzes = [];

        foreach ($tmp as $key => $row) {
            $quizinfo = explode("@@^@@", $row);
            $choices = array_map(function ($item) { return trim($item); }, array_slice($quizinfo, 1, 4));
            $quizzes[] = [
                'quiz_id' => $key + 1,
                'quiz' => trim($quizinfo[0]),
                'choices' => json_encode($choices, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'reward' => mt_rand(5, 50),
                'answer' => trim($quizinfo[5]),
                'started_at' => '2018-11-03 08:30:00',
                'expired_at' => '2018-11-04 17:30:00',
                'created_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        return empty($raw_str) ? [] : $quizzes;
    }
}
