<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radusergroup".
 *
 * @property string $username
 * @property string $groupname
 * @property integer $priority
 */
class Radusergroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radusergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority'], 'integer'],
            [['username', 'groupname'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'groupname' => 'Groupname',
            'priority' => 'Priority',
        ];
    }
}
