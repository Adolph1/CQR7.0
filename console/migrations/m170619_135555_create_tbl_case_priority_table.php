<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_priority`.
 */
class m170619_135555_create_tbl_case_priority_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_case_priority', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_case_priority');
    }
}
