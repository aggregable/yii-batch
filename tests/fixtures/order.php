<?php

$data = [];

$count = 1;
while($count < 30){
    array_push($data, [
            'id'=> $count,
            'name' => 'Channel # ' . rand(0,1000),
            'price' => rand(1,100),
            'date_updated' => new CDbExpression('NOW()'),
        ]);
    ++$count;
}

return $data;
