<?php

return array(
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=malmo_test',
            'emulatePrepare' => true,
            'username' => '',
            'password' => '',
            'charset' => 'utf8',

            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
    ),
);