<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_case_type`.
 */
class m170619_135702_create_tbl_case_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_case_type', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_case_type');
    }
}
