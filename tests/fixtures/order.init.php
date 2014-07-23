<?php


Yii::app()->db->createCommand('DROP TABLE IF EXISTS `order`')->execute();

Yii::app()->db->createCommand()->createTable('order', array(
        'id'           => 'pk',
        'name'         => 'string',
        'price'        => 'double',
        'date_updated' => 'timestamp',
 ));