<?php
/**
 * Class Batch
 *
 * Usage:
 *         $criteria = new \CDbCriteria();
 *         $criteria->limit = 10000;
 *         foreach(new \Batch(1000, Models\Heisenberg::model()->with('Jesse'), $criteria) as $meth){
 *              echo $meth->getColor();
 *         }
 *
 * @author Roman Dutchak <dutchakdev@gmail.com>
 * @web https://github.com/dutchakdev
 */
class Batch implements Iterator
{

    public $batchSize = 10;
    public $each = false;

    /**
     * @var array the data to be iterated through
     */
    private $_d;
    /**
     * @var array list of keys in the map
     */
    private $_keys;
    /**
     * @var mixed current key
     */
    private $_key;

    private $_empty;

    private $_model;

    private $_criteria;

    private $_limit = 0;
    private $_offset = 0;

    private $_params = [];


    /**
     * Fetches the next batch of data.
     * @return array the data fetched
     */
    protected function fetchData(){

        if($this->_criteria === null){
            $this->_criteria = new \CDbCriteria();
        }

        if($this->_criteria->limit <= $this->batchSize){
            $this->batchSize = $this->_criteria->limit;
        }

        if($this->_limit < $this->_criteria->limit)
            $this->_limit = $this->_criteria->limit;

        $this->_criteria->limit = $this->batchSize;
        $this->_criteria->offset = $this->_offset;
        $data = $this->_model->findAll($this->_criteria);
        $this->_limit -= count($data);
        $this->_empty = $data ? false:true;
        return $data;
    }

    /**
     * Constructor
     * @param integer $batchSize
     * @param CActiveRecord $model
     * @param CDbCriteria $criteria
     * @param array $params
     */
    public function __construct($batchSize = 10, CActiveRecord $model, \CDbCriteria $criteria=null, array $params = [])
    {
        $this->batchSize = $batchSize;
        $this->_model = $model;
        $this->_criteria = $criteria;
        $this->_params= $params;
        $data = $this->fetchData();
        $this->setData($data);
    }

    /**
     * Set iterator data
     * @param $data
     */
    private function setData($data){
        $this->_d=$data;
        $this->_keys=array_keys($data);
        $this->_key=reset($this->_keys);
    }

    /**
     * Rewinds internal array pointer.
     * This method is required by the interface Iterator.
     */
    public function rewind()
    {
        $this->_key=reset($this->_keys);
    }

    /**
     * Returns the key of the current array element.
     * This method is required by the interface Iterator.
     * @return mixed the key of the current array element
     */
    public function key()
    {
        return $this->_key;
    }

    /**
     * Returns the current array element.
     * This method is required by the interface Iterator.
     * @return mixed the current array element
     */
    public function current()
    {
        if($this->each)
            return $this->_d[$this->_key];
        else
            return $this->_d;

    }

    /**
     * Moves the internal pointer to the next array element.
     * This method is required by the interface Iterator.
     */
    public function next()
    {
        // each ???
        $this->_key=next($this->_keys);
    }

    /**
     * Returns whether there is an element at current position.
     * This method is required by the interface Iterator.
     * @return boolean
     */
    public function valid()
    {
        if($this->_key===false && !$this->_empty && $this->_limit){
            $this->_offset += $this->batchSize;
            $data = $this->fetchData();
            $this->setData($data);
        }
        return $this->_key!==false;
    }
}
