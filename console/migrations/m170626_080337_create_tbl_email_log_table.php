<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_email_log`.
 */
class m170626_080337_create_tbl_email_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_email_log', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(200),
            'from'=>$this->string(200),
            'to'=>$this->string(200),
            'subject'=>$this->string(200),
            'message'=>$this->text(),
            'case_reference_number'=>$this->string(200),
            'status'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_email_log');
    }
}
