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

    private function getBatch($batchSize=10, $each=false){
        return new Batch($batchSize, Order::model(), $each);
    }


    public function testInsteadOf(){
        $batch = $this->getBatch();
        $this->assertInstanceOf('CComponent', $batch);
        $this->assertInstanceOf('Traversable', $batch);
    }

    public function testObjectCountWithoutCriteria(){

        foreach($this->getBatch(null)->findAll() as $items){
            $this->assertTrue(count($items) === 10);
            break;
        }

        foreach($this->getBatch(10)->findAll() as $items){
            $this->assertTrue(count($items) === 10);
            break;
        }

        foreach($this->getBatch(3)->findAll() as $items){
            $this->assertTrue(count($items) === 3);
            break;
        }

        //test each

        foreach($this->getBatch(3, true)->findAll() as $items){
            $this->assertTrue(count($items) === 1);
            break;
        }


    }

    public function testObjectCountWithCriteria(){


        foreach($this->getBatch(10)->findAll(new CDbCriteria(['limit'=>1])) as $items){
            $this->assertTrue(count($items) === 1);
            break;
        }

        foreach($this->getBatch(10)->findAll(new CDbCriteria(['limit'=>10])) as $items){
            $this->assertTrue(count($items) === 10);
            break;
        }

    }
} 