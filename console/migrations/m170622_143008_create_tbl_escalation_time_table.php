<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_escalation_time`.
 */
class m170622_143008_create_tbl_escalation_time_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_escalation_time', [
            'id' => $this->primaryKey(),
            'time_number'=>$this->integer(),
            'duration'=>$this->string(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_escalation_time');
    }
}
