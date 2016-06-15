<?php

use yii\db\Schema;
use yii\db\Migration;

class m160531_114554_create_dividends_table extends Migration
{
    public function up()
    {
        $this->createTable('dividends',[
            'id' => $this->primaryKey(),
            'quoteid' => $this->integer()->notNull(),
            'companyid' => $this->integer()->notNull(),
            'exchid' => $this->integer()->notNull(),
            'exdividenddate' => $this->date()->notNull(),
            'recorddate' => $this->date()->notNull(),
            'announcementdate' => $this->date()->notNull(),
            'paymentdate' => $this->date()->notNull(),
            'value' => $this->decimal()->notNull(),
            'currencyid' => $this->integer()->notNull(),
            'ActiveFlag' => $this->boolean()->notNull(),
            'ChangeDate' => $this->dateTime()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('dividends');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
