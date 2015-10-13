<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "radiususers".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $departments
 * @property string $roles
 * @property string $status
 */
class Radiususers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'radiususers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'departments', 'roles', 'status'], 'string', 'max' => 45]
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
            'password' => 'Password',
            'departments' => 'Departments',
            'roles' => 'Roles',
            'status' => 'Status',
        ];
    }
}
