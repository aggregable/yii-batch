<?php

$data = [];

$count = 0;
while($count < 1000){
    array_push($data, [
            'id'=> null,
            'name' => 'Channel # ' . rand(0,1000),
            'price' => rand(1,100),
            'date_updated' => new CDbExpression('NOW()'),
        ]);
    ++$count;
}

return $data;
