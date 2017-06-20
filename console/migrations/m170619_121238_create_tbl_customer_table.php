<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer`.
 */
class m170619_121238_create_tbl_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer', [
            'id' => $this->primaryKey(),
            'customer_number'=>$this->string(200)->notNull(),
            'name'=>$this->string(200)->notNull(),
            'account_1'=>$this->string(200)->unique(),
            'account_2'=>$this->string(200)->unique(),
            'phone_1'=>$this->string(200)->notNull(),
            'phone_2'=>$this->string(200),
            'address'=>$this->text(),
            'email'=>$this->string(200),
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
        $this->dropTable('tbl_customer');
    }
}
