yii-batch
=========

Same "batch" of yii2, but Simplified. Just for fun

Batch is helper-iterator for yii created for batch processing.

yii-batch / protected / components / Batch.php
 
```         
// Usage:
$criteria = new \CDbCriteria();
$criteria->limit = 10000;

// Get 100 records per object
foreach(new \Batch(100, Models\Heisenberg::model()->with('Jesse'), $criteria) as $meth){
  echo $meth->getColor();
}
```
