<?php

/**
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class Order extends CActiveRecord
{

    public static function model($class=__CLASS__)
    {
        return parent::model($class);
    }

    public function rules()
    {
        return array(
            array('name, price, date_updated', 'required'),
        );
    }

    public function relations()
    {
        return [];
    }

    public function tableName()
    {
        return 'order';
    }

    public function scopes()
    {
        return [];
    }
}
