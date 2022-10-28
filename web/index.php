<?php
date_default_timezone_set('Asia/Almaty');
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'http://'.$_SERVER['SERVER_NAME'];
$allowed_domains = [
    'http://localhost:8080'
];

if (in_array($origin, $allowed_domains)) {
    header('Access-Control-Allow-Origin: ' . $origin);
}
header("Access-Control-Allow-Methods:  POST, GET, DELETE, PUT, PATCH, OPTIONS, HEAD");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Access-Control-Allow-Credentials: true');
$headers = headers_list();
// get the content type header
foreach($headers as $header){
    if (substr(strtolower($header),0,13) == "content-type:"){
        list($contentType, $charset) = explode(";", trim(substr($header, 14), 2));
        if (strtolower(trim($charset)) != "charset=utf-8"){
            header("Content-Type: ".trim($contentType)."; charset=utf-8");
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("HTTP/1.1 200 OK");
    die();
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
