<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_customer_case`.
 */
class m170619_140218_create_tbl_customer_case_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_customer_case', [
            'id' => $this->primaryKey(),
            'case_number'=>$this->string(200)->unique(),
            'title'=>$this->string(200)->notNull(),
            'source'=>$this->integer()->notNull(),
            'type'=>$this->integer(),
            'priority'=>$this->integer(),
            'customer_number'=>$this->integer(),
            'reported_date'=>$this->string(200),
            'description'=>$this->text(),
            'related_activity'=>$this->integer(),
            'related_module'=>$this->integer(),
            'related_department'=>$this->integer(),
            'assigned_to'=>$this->integer(),
            'escalation_hours'=>$this->integer(),
            'escalation_time'=>$this->dateTime(),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),


        ]);

        // creates index for column `customer_number`
        $this->createIndex(
            'idx-tbl_customer_case-customer_number',
            'tbl_customer_case',
            'customer_number'
        );


        // add foreign key for table `tbl_customer`
        $this->addForeignKey(
            'fk-tbl_customer_case-customer_number',
            'tbl_customer_case',
            'customer_number',
            'tbl_customer',
            'id',
            'RESTRICT'
        );

        // creates index for column `source`
        $this->createIndex(
            'idx-tbl_customer_case-source',
            'tbl_customer_case',
            'source'
        );


        // add foreign key for table `tbl_case_source`
        $this->addForeignKey(
            'fk-tbl_customer_case-source',
            'tbl_customer_case',
            'source',
            'tbl_case_source',
            'id',
            'RESTRICT'
        );

        // creates index for column `type`
        $this->createIndex(
            'idx-tbl_customer_case-type',
            'tbl_customer_case',
            'type'
        );


        // add foreign key for table `tbl_case_type`
        $this->addForeignKey(
            'fk-tbl_customer_case-type',
            'tbl_customer_case',
            'type',
            'tbl_case_type',
            'id',
            'RESTRICT'
        );

        // creates index for column `priority`
        $this->createIndex(
            'idx-tbl_customer_case-priority',
            'tbl_customer_case',
            'priority'
        );


        // add foreign key for table `tbl_case_type`
        $this->addForeignKey(
            'fk-tbl_customer_case-priority',
            'tbl_customer_case',
            'type',
            'tbl_case_priority',
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
            'fk-tbl_customer_case-customer_number',
            'tbl_customer_case'
        );

        // drops index for column `customer_number`
        $this->dropIndex(
            'idx-tbl_customer_case-customer_number',
            'tbl_customer_case'
        );


        $this->dropForeignKey(
            'fk-tbl_customer_case-source',
            'tbl_customer_case'
        );

        // drops index for column `source`
        $this->dropIndex(
            'idx-tbl_customer_case-source',
            'tbl_customer_case'
        );

        $this->dropForeignKey(
            'fk-tbl_customer_case-type',
            'tbl_customer_case'
        );

        // drops index for column `type`
        $this->dropIndex(
            'idx-tbl_customer_case-type',
            'tbl_customer_case'
        );

        $this->dropForeignKey(
            'fk-tbl_customer_case-priority',
            'tbl_customer_case'
        );

        // drops index for column `priority`
        $this->dropIndex(
            'idx-tbl_customer_case-priority',
            'tbl_customer_case'
        );
        $this->dropTable('tbl_customer_case');
    }
}
