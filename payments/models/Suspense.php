<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suspense".
 *
 * @property integer $id
 * @property string $mpesa_id
 * @property string $original
 * @property string $destination
 * @property integer $customer_id
 * @property string $test
 * @property string $mpesa_code
 * @property string $mpesa_acc
 * @property string $mpesa_msidn
 * @property string $mpesa_amount
 * @property string $mpesa_sender
 * @property string $status
 * @property string $actual_uri
 * @property string $timestamp
 */
class Suspense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suspense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mpesa_id', 'original', 'destination', 'customer_id', 'test', 'mpesa_code', 'mpesa_acc', 'mpesa_msidn', 'mpesa_amount', 'mpesa_sender'], 'required'],
            [['customer_id'], 'integer'],
            [['test'], 'string'],
            [['timestamp'], 'safe'],
            [['mpesa_id', 'original', 'destination', 'mpesa_code', 'mpesa_acc', 'mpesa_msidn', 'mpesa_amount', 'mpesa_sender', 'status', 'actual_uri'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mpesa_id' => 'Mpesa ID',
            'original' => 'Original',
            'destination' => 'Destination',
            'customer_id' => 'Customer ID',
            'test' => 'Test',
            'mpesa_code' => 'Mpesa Code',
            'mpesa_acc' => 'Mpesa Acc',
            'mpesa_msidn' => 'Mpesa Msidn',
            'mpesa_amount' => 'Mpesa Amount',
            'mpesa_sender' => 'Mpesa Sender',
            'status' => 'Status',
            'actual_uri' => 'Actual Uri',
            'timestamp' => 'Timestamp',
        ];
    }
}
