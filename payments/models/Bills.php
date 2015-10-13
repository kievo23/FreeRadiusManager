<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bills".
 *
 * @property integer $id
 * @property string $monthly_charge
 */
class Bills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monthly_charge'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monthly_charge' => 'Monthly Charge',
        ];
    }
}
