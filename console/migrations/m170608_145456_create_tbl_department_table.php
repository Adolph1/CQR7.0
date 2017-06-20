<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_department`.
 */
class m170608_145456_create_tbl_department_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_department', [
            'id' => $this->primaryKey(),
            'dept_name'=>$this->string(200)->notNull(),
            'parent'=>$this->integer(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);



    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropTable('tbl_department');
    }
}
