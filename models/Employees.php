<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $user_name
 * @property string $email
 * @property string $phone
 *
 * @property CourEmp[] $courEmps
 * @property Courses[] $cs
 * @property Users $user
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['full_name', 'user_name', 'email', 'phone'], 'required'],
            [['full_name', 'user_name', 'email'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 22],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourEmps()
    {
        return $this->hasMany(CourEmp::className(), ['e_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCs()
    {
        return $this->hasMany(Courses::className(), ['id' => 'c_id'])->viaTable('cour_emp', ['e_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
