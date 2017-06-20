<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_module_activity`.
 */
class m170618_154752_create_tbl_module_activity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_module_activity', [
            'id' => $this->primaryKey(),
            'activity_name'=>$this->string(200)->notNull(),
            'module_id'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        // creates index for column `module_id`
        $this->createIndex(
            'idx-tbl_module_activity-module_id',
            'tbl_module_activity',
            'module_id'
        );


        // add foreign key for table `tbl_system_module`
        $this->addForeignKey(
            'fk-tbl_module_activity-module_id',
            'tbl_module_activity',
            'module_id',
            'tbl_system_module',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_module_activity-module_id',
            'tbl_module_activity'
        );

        // drops index for column `module_id`
        $this->dropIndex(
            'idx-tbl_module_activity-module_id',
            'tbl_module_activity'
        );
        $this->dropTable('tbl_module_activity');
    }
}
