<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $user_name
 * @property string $email
 * @property string $phone
 * @property integer $c_id
 *
 * @property Courses $c
 * @property Users $user
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'c_id'], 'integer'],
            [['full_name', 'user_name', 'email', 'phone', 'c_id'], 'required'],
            [['full_name', 'user_name', 'email'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 22],
            [['c_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['c_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'full_name' => 'Full Name',
            'user_name' => 'User Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'c_id' => 'C ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return $this->hasOne(Courses::className(), ['id' => 'c_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
