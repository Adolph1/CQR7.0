<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_case_history`.
 */
class m170619_140220_create_tbl_case_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_case_history', [
            'id' => $this->primaryKey(),
            'case_id'=>$this->integer(),
            'date'=>$this->date(),
            'description'=>$this->text(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);


        // creates index for column `case_id`
        $this->createIndex(
            'idx-tbl_case_history-case_id',
            'tbl_case_history',
            'case_id'
        );


        // add foreign key for table `tbl_case`
        $this->addForeignKey(
            'fk-tbl_case_history-case_id',
            'tbl_case_history',
            'case_id',
            'tbl_customer_case',
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
            'fk-tbl_case_history-case_id',
            'tbl_case_history'
        );

        // drops index for column `case_id`
        $this->dropIndex(
            'idx-tbl_case_history-case_id',
            'tbl_case_history'
        );
        $this->dropTable('tbl_case_history');
    }
}
