<?php

use yii\db\Migration;

class m160124_004212_insert_data extends Migration
{

    public function up()
    {

        // drop foreign key and truncate tables before the data will be imported
        $this->down();

        /*
         * migrating data to table `Users`
         *
         * assume that needed file exists, that it is not empty and that the data is complete and correct,
         * so in this test exsercise we will not check any of mentioned above
        */

        $aUsers = (array)json_decode(file_get_contents(__DIR__ . '/../users.json'));
        $aFields = array_keys((array)$aUsers[0]);

        $aRows = array();

        foreach ($aUsers as $oStdObject)
        {
            $aRows[] = array_values((array)$oStdObject);
        }

        $this->batchInsert('Users',
            $aFields,
            $aRows);


        /*
         * migrating data to table `Loans`
         *
         * assume that needed file exists, that it is not empty and that the data is complete and correct,
         * so in this test exsercise we will not check any of mentioned above
        */

        $aLoans = (array)json_decode(file_get_contents(__DIR__ . '/../loans.json'));
        $aFields = array_keys((array)$aLoans[0]);

        $aRows = array();

        foreach ($aLoans as $oStdObject)
        {
            $aLoan = (array)$oStdObject;

            $aLoan['dateApplied'] = date("Y-m-d", $aLoan['dateApplied']);
            $aLoan['dateLoanEnds'] = date("Y-m-d", $aLoan['dateLoanEnds']);

            $aRows[] = array_values($aLoan);
        }

        $this->batchInsert('Loans',
            $aFields,
            $aRows);


    }

    public function down()
    {

        // drop foreign key before the tables will be truncated

        $aForeignKeys = Yii::$app->db->schema->getTableSchema('Loans', true)->foreignKeys;

        if (isset($aForeignKeys[0]['userId']))
        {
            $this->dropForeignKey('Loans_Fk_userId',
                'Loans');
        }

        $this->truncateTable('Loans');
        $this->truncateTable('Users');

        // add foreign key
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
}