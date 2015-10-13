<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $clientAcc
 * @property string $client_name
 * @property string $email
 * @property string $cellphone
 * @property string $username
 * @property string $password
 * @property string $bonus_days
 * @property string $lastpayment_date
 * @property string $balances
 * @property string $timestamp
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['clientAcc', 'client_name', 'email', 'cellphone', 'username', 'password', 'bonus_days', 'lastpayment_date','arrears','status'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'clientAcc' => 'Client Acc',
            'client_name' => 'Client Name',
            'email' => 'Email',
            'cellphone' => 'Cellphone',
            'username' => 'Username',
            'password' => 'Password',
            'bonus_days' => 'Bonus Days',
            'lastpayment_date' => 'Lastpayment Date',
            'balances' => 'Balances',
            'arrears' => 'Arrears',
            'status' => 'Status',
            'timestamp' => 'Timestamp',
        ];
    }
}
