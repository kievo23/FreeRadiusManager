<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mpesa".
 *
 * @property integer $id
 * @property string $origin
 * @property string $destination
 * @property string $customer_id
 * @property string $user
 * @property string $pass
 * @property string $routemethod_id
 * @property string $routemethod_name
 * @property string $business_number
 */
class Mpesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mpesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['origin', 'destination', 'customer_id', 'user', 'pass', 'routemethod_id', 'routemethod_name', 'business_number'], 'required'],
            [['origin', 'destination', 'customer_id', 'user', 'pass', 'routemethod_id', 'routemethod_name', 'business_number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'origin' => 'Origin',
            'destination' => 'Destination',
            'customer_id' => 'Customer ID',
            'user' => 'User',
            'pass' => 'Pass',
            'routemethod_id' => 'Routemethod ID',
            'routemethod_name' => 'Routemethod Name',
            'business_number' => 'Business Number',
        ];
    }
}
