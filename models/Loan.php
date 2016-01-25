<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Loans".
 *
 * @property integer $loanId
 * @property integer $userId
 * @property string $amount
 * @property string $interest
 * @property integer $duration
 * @property string $dateApplied
 * @property string $dateLoanEnds
 * @property integer $campaign
 * @property integer $status
 * @property boolean $isDeleted
 *
 * @property Users $user
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Loans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'amount', 'interest', 'duration', 'dateApplied', 'dateLoanEnds', 'campaign', 'status'], 'required'],
            [['userId'], 'exist', 'targetClass' => 'app\models\User', 'targetAttribute' => 'userId'],
            [['userId', 'duration', 'campaign', 'status'], 'integer'],
            [['amount', 'interest'], 'double'],
            [['dateApplied', 'dateLoanEnds'], 'match', 'pattern' => '/^\d\d\d\d-\d\d-\d\d$/'],
            [['dateApplied', 'dateLoanEnds'], 'validateDate'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loanId'        => 'Loan ID',
            'userId'        => 'User ID',
            'amount'        => 'Amount',
            'interest'      => 'Interest',
            'duration'      => 'Duration',
            'dateApplied'   => 'Date Applied',
            'dateLoanEnds'  => 'Date Loan Ends',
            'campaign'      => 'Campaign',
            'status'        => 'Status',
            'isDeleted'     => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * checks if the date really exists
     */
    public function validateDate($attribute, $params)
    {
        if (checkdate (
                (int)substr($this->$attribute, 5, 2),
                (int)substr($this->$attribute, 8),
                (int)substr($this->$attribute, 0, 4)
            ) !== true)
        {
            $this->addError($attribute, 'The date is not valid');
        }
    }

}
