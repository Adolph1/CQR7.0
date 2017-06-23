<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_email_service`.
 */
class m170621_160255_create_tbl_email_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_email_service', [
            'id' => $this->primaryKey(),
            'from'=>$this->string(200),
            'to'=>$this->string(200),
            'message'=>$this->text(),
            'time_sent'=>$this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_email_service');
    }
}
