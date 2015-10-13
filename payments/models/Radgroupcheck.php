<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radgroupcheck".
 *
 * @property string $id
 * @property string $groupname
 * @property string $attribute
 * @property string $op
 * @property string $value
 */
class Radgroupcheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radgroupcheck';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupname', 'attribute'], 'string', 'max' => 64],
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
            'groupname' => 'Groupname',
            'attribute' => 'Attribute',
            'op' => 'Op',
            'value' => 'Value',
        ];
    }
}
