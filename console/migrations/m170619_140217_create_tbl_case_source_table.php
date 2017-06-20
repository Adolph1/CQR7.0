<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_case_source`.
 */
class m170619_140217_create_tbl_case_source_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_case_source', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_case_source');
    }
}
