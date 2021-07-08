<?php


use Phinx\Migration\AbstractMigration;

class UpdateMissionQuizTablePK extends AbstractMigration
{
    public function up()
    {
        $sql = <<<SQL
-- filegame_booth_missions
ALTER TABLE `filegame_booth_missions` CHANGE `mission_id` `mission_id` INT NOT NULL AUTO_INCREMENT COMMENT 'mission_id';
ALTER TABLE `filegame_booth_missions` CHANGE `boothname` `booth_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '攤位名稱';
ALTER TABLE `filegame_booth_missions` CHANGE `boothinfo` `booth_info` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '攤位資訊';
-- filegame_quizzes
ALTER TABLE `filegame_quizzes` CHANGE `quiz_id` `quiz_id` INT NOT NULL AUTO_INCREMENT COMMENT 'quiz_id';
SQL;
        $this->execute($sql);
    }
}
