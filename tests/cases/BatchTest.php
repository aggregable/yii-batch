<?php
/**
 * @author: Roman Dutchak <dutchakdev@gmail.com
 * @link: https://github.com/dutchakdev
 * Make with love and PhpStorm for batch
 */
require_once(dirname(__FILE__).'/../data/models.php');
class BatchTest extends CDbTestCase{

    private $db;
    public function setUp()
    {
        $this->getFixtureManager()->resetTable('order');
        $this->getFixtureManager()->loadFixture('order');
        CActiveRecord::$db=$this->db=Yii::app()->db;
        parent::setUp();

    }

    public function batchSizes()
    {
        return array(
            array(null),
            array(1),
            array(10),
            array(110),
        );
    }

    public function testInsteadOf(){
        $batch = new Batch(10, Order::model());
        $this->assertInstanceOf('CApplicationComponent', $batch);
        $this->assertInstanceOf('Traversable', $batch);
    }


} 