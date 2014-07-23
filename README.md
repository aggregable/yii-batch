yii-batch
=========

Same "batch" of yii2, but Simplified. Just for fun

Batch is helper-iterator for yii created for batch processing.

yii-batch / protected / components / Batch.php
 
```         
// Usage batch:
$criteria = new \CDbCriteria();
$criteria->limit = 1000;

// Get 100 records per object
foreach((new \Batch(100, Models\Heisenberg::model()->with('Jesse'))->findAll($criteria) as $meth){
  // 100 objects in $meth, 10 query to db
}
```

```         
// Usage each:
$criteria = new \CDbCriteria();
$criteria->limit = 1000;

// Get 100 records per object
foreach((new \Batch(100, Models\Heisenberg::model()->with('Jesse'), true)->findAll($criteria) as $meth){
  // 1 object in $meth, 10 query to db
}
```
