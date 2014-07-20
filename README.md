yii-batch
=========

Same "batch" of yii2, but Simplified. Just for fun


yii-batch / protected / components / Batch.php
 
```         
// Usage:
$criteria = new \CDbCriteria();
$criteria->limit = 10000;
foreach(new \Batch(1000, Models\Heisenberg::model()->with('Jesse'), $criteria) as $meth){
  echo $meth->getColor();
}
```
