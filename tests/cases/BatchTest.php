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

    public function provider()
    {
        return array(
            [null, 10],
            [1, 1, ],
            [4, 4,],
            [10, 10,],
            [100, 100,],
        );
    }

    public function providerLimit()
    {
        return array(
//            [null, 10, 43],
//            [1, 1, 5],
//            [4, 4, 20],
//            [100, 100, 50],
            [10, 10, 100],
            [10, 10, 1000],
        );
    }

//    /**
//     * @dataProvider provider
//     */
//    public function testObjectCountWithoutCriteria($expectedSize, $actualSize){
//        foreach($this->getBatch($expectedSize)->findAll() as $items){
//            $this->assertTrue(count($items) <= $actualSize);
//            break;
//        }
//
//        foreach($this->getBatch($expectedSize, true)->findAll() as $items){
//            $this->assertEquals(1, count($items));
//            break;
//        }
//    }

    /**
     * @dataProvider providerLimit
     */
    public function testObjectCountWithCriteria($expectedSize, $actualSize, $expectedLimit){

        $eachCount = 0;
        $batch = $this->getBatch($expectedSize);
        $criteria = new CDbCriteria(['limit'=>$expectedLimit]);
        foreach($batch->findAll($criteria) as $items){
            $this->assertTrue(count($items) <= $actualSize);
            $eachCount += count($items);
        }
        $this->assertEquals($eachCount, $expectedLimit);
        unset($eachCount);

//        $eachCount = 0;
//        foreach($this->getBatch($expectedSize, true)->findAll(new CDbCriteria(['limit'=>$expectedLimit])) as $items){
//            $this->assertEquals(1, count($items));
//        }
//        unset($eachCount);



    }
} 