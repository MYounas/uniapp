<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CourEmp[] $courEmps
 * @property Employees[] $es
 * @property Students[] $students
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourEmps()
    {
        return $this->hasMany(CourEmp::className(), ['c_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEs()
    {
        return $this->hasMany(Employees::className(), ['id' => 'e_id'])->viaTable('cour_emp', ['c_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['c_id' => 'id']);
    }
}
