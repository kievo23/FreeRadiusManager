<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radreply".
 *
 * @property string $id
 * @property string $username
 * @property string $attribute
 * @property string $op
 * @property string $value
 */
class Radreply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radreply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'attribute'], 'string', 'max' => 64],
            [['op'], 'string', 'max' => 2],
            [['value'], 'string', 'max' => 253]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'attribute' => 'Attribute',
            'op' => 'Op',
            'value' => 'Value',
        ];
    }
}
