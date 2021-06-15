<?php

// Database
$config['database'] = array(
    'Development' => array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'opshell',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ),
    'Production' => array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'opshell',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    )
);


// JWT 設定
$config['jwtHeader'] = [  // JWT header
    "typ" => "JWT",   //使用的type
    "alg" => "HS256"  //使用的加密演算法
];
$config['jwtKeys'] = "eZ^w|m4|n].4Kw~"; // JWT簽章金鑰

?>