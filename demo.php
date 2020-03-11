<?php
/**
 * Created on PhpStorm.
 * User: Buddha
 * Date: 2020/3/11 19:10
 */
require __DIR__ . '/vendor/autoload.php';

// 阿里AppCode
$appCode = "";
// 快递单号
$no = "9897984468520";
// 快递物流公司编码，默认AUTO
$type = "AUTO";

try {
    $express = new \Express\Express($appCode);
    $messageInfo = $express->getExpressInfo(['NO' => $no, 'TYPE' => $type]);
    var_dump($messageInfo);
} catch (Exception $e) {
    echo $e->getMessage();
}
