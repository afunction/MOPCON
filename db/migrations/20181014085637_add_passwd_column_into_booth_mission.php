<?php


use Phinx\Migration\AbstractMigration;

class AddPasswdColumnIntoBoothMission extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('filegame_booth_missions');
        $table->addColumn('passwd', 'string', ['null' => false, 'limit' => 255, 'comment' => '產生 qrcode 的頁面 passwd', 'after' => 'mission_id']);
        $table->update();
    }
}
