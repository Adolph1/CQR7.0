<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_case_status`.
 */
class m170622_133913_create_tbl_case_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_case_status', [
            'id' => $this->primaryKey(),
            'status_name'=>$this->string(200),
            'type'=>$this->string(20),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_case_status');
    }
}
