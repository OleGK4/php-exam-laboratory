<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $fio
 * @property int $age
 * @property string $family_status
 * @property int $kids
 * @property string $appointment
 * @property string $education
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'age', 'family_status', 'kids', 'appointment', 'education'], 'required'],
            [['age', 'kids'], 'integer'],
            [['fio', 'family_status', 'appointment', 'education'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'age' => 'Age',
            'family_status' => 'Family Status',
            'kids' => 'Kids',
            'appointment' => 'Appointment',
            'education' => 'Education',
        ];
    }
}
