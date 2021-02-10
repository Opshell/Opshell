<?php
// DB 初始化
// use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;

$DB = new DB;
// 建立連線
$DB->addConnection($config['database'][$develop_mode]);
// 設定全域靜態可訪問
$DB->setAsGlobal();
// 啟動Eloquent
$DB->bootEloquent();

return 'Illuminate\Database\Capsule\Manager'; // 主要由外部替物件重新指定你喜歡的別名