<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $user_type
 * @property string $username
 * @property string $password
 * @property string $authkey
 *
 * @property Employees $employee
 * @property Students $student
 */
class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }		

    /**		
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type'], 'string', 'max' => 32],
            [['username', 'password'], 'string', 'max' => 22],
            [['authkey'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type' => 'User Type',
            'username' => 'Username',
            'password' => 'Password',
            'authkey' => 'Authkey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getAuthKey(){
    	return $this->authkey;
    }
    
    public function validateAuthKey($authKey){
    	return $this->authkey===$authKey;
    }
    
    public function getId(){
    	return $this->id;
    }
    
    public static function findIdentity($id){
    	return static::findOne($id);
    }
    
	public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }
    
    public function findByUsername($username){
    	return self::findOne(['username'=>$username]);
    }
    
    public function validatePassword($password){
    	return $this->password===$password;
    }
    
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['user_id' => 'id']);
    }
}
