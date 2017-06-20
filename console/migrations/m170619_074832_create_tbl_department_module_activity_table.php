<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_department_module_activity`.
 */
class m170619_074832_create_tbl_department_module_activity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_department_module_activity', [
            'id' => $this->primaryKey(),
            'module_activity_id'=>$this->integer(),
            'department_id'=>$this->integer(),
            'related_module'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);

        // creates index for column `module_activity_id`
        $this->createIndex(
            'idx-tbl_department_module_activity-module_activity_id',
            'tbl_department_module_activity',
            'module_activity_id'
        );


        // add foreign key for table `tbl_module_activity`
        $this->addForeignKey(
            'fk-tbl_department_module_activity-module_activity_id',
            'tbl_department_module_activity',
            'module_activity_id',
            'tbl_module_activity',
            'id',
            'RESTRICT'
        );

        // creates index for column `module_activity_id`
        $this->createIndex(
            'idx-tbl_department_module_activity-department_id',
            'tbl_department_module_activity',
            'department_id'
        );


        // add foreign key for table `tbl_department`
        $this->addForeignKey(
            'fk-tbl_department_module_activity-department_id',
            'tbl_department_module_activity',
            'department_id',
            'tbl_department',
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
            'fk-tbl_department_module_activity-department_id',
            'tbl_department_module_activity'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            'idx-tbl_department_module_activity-department_id',
            'tbl_department_module_activity'
        );

        $this->dropForeignKey(
            'fk-tbl_department_module_activity-module_activity_id',
            'tbl_department_module_activity'
        );

        // drops index for column `module_activity_id`
        $this->dropIndex(
            'idx-tbl_department_module_activity-module_activity_id',
            'tbl_department_module_activity'
        );
        $this->dropTable('tbl_department_module_activity');
    }
}
