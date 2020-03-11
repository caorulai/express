Express

## 安装
```
composer require caorulai/ali_express_api
```

## 使用说明

```
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
```
