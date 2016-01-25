<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_235722_create_tables extends Migration
{
	public function tableExists($sTable)
	{
		return (Yii::$app->db->schema->getTableSchema($sTable, true) !== null);
	}

	public function up()
    {

		$this->down();

		$this->createTable('Users',[
			'userId' => Schema::TYPE_PK,
			'firstName' => Schema::TYPE_TEXT . ' NOT NULL',
			'lastName' => Schema::TYPE_TEXT . ' NOT NULL',
			'email' => Schema::TYPE_TEXT . ' NOT NULL',
			'personalCode' => Schema::TYPE_BIGINT . ' NOT NULL',
			'phone' => Schema::TYPE_BIGINT . ' NOT NULL',
			'active' => Schema::TYPE_BOOLEAN,
			'isDead' => Schema::TYPE_BOOLEAN,
			'lang' => Schema::TYPE_TEXT,
			'isDeleted' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE'
		]);

		$this->createIndex('Users_Ind_isDeleted', 'Users', 'isDeleted', false);


		$this->createTable('Loans',[
			'loanId' => Schema::TYPE_PK,
			'userId' => Schema::TYPE_BIGINT . ' NOT NULL',
			'amount' => 'NUMERIC( 10, 4 ) NOT NULL',
			'interest' => 'NUMERIC( 10, 4 ) NOT NULL',
			'duration' => Schema::TYPE_INTEGER . ' NOT NULL',
			'dateApplied' => Schema::TYPE_DATE . ' NOT NULL',
			'dateLoanEnds' => Schema::TYPE_DATE . ' NOT NULL',
			'campaign' => Schema::TYPE_INTEGER . ' NOT NULL',
			'status' => Schema::TYPE_INTEGER,
			'isDeleted' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE'
		]);

		$this->createIndex('Loans_Ind_userId', 'Loans', 'userId', false);
		$this->createIndex('Loans_Ind_isDeleted', 'Loans', 'isDeleted', false);

		$this->addForeignKey(
			'Loans_Fk_userId',
			'Loans',
			'userId',
			'Users',
			'userId',
			'RESTRICT',
			'CASCADE'
		);

	}

    public function down()
    {
		if ($this->tableExists('Loans'))
		{
			$this->dropTable('Loans');
		}

		if ($this->tableExists('Users'))
		{
			$this->dropTable('Users');
		}
    }

}
