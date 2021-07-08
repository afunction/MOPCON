<?php

use Phinx\Migration\AbstractMigration;

class InitMopconBackendSchema2018 extends AbstractMigration
{
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/init2018.sql');
        $this->execute($sql);
    }
}
