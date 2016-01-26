<?php

use yii\db\Migration;
use \yii\db;

class m160125_235011_fix_sequences extends Migration
{

	public function up()
	{
		/*
		 * IMPORTANT!
		 * Though the data inserted by the previous migration has primary keys not starting from 1,
		 * we should fix sequences counters, or else they will start from 1 and after some new inserts
		 * we will have an exception!
		 */

		$iMaxUserId = (new \yii\db\Query())
		->from('Users')
		->max('"userId"');

		$this->execute('ALTER SEQUENCE "Users_userId_seq" RESTART WITH ' . ++$iMaxUserId);

		$iMaxLoanId = (new \yii\db\Query())
			->from('Loans')
			->max('"loanId"');

		$this->execute('ALTER SEQUENCE "Loans_loanId_seq" RESTART WITH ' . ++$iMaxLoanId);
	}

	public function down()
	{
		$this->execute('ALTER SEQUENCE "Users_userId_seq" RESTART');

		$this->execute('ALTER SEQUENCE "Loans_loanId_seq" RESTART');
	}

}