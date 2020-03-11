<?php
/**
 * Created on PhpStorm.
 * User: Buddha
 * Date: 2020/3/11 16:38
 */

namespace Express;

class Express
{
    /**
     * 接口基础域名
     * @var string
     */
    private $host = "https://kuaidi101.market.alicloudapi.com";

    /**
     * 请求方式
     * @var string
     */
    private $method = "GET";

    /**
     * 请求接口
     * @var string
     */
    private $path = "/getExpress";

    /**
     * 申请接口的AppCode
     * @var string
     */
    private $appCode = "";

    /**
     * 快递物流公司编码(
     * @var string
     */
    private $type = "AUTO";

    /**
     * 构造函数传参AppCode
     * Express constructor.
     * @param string $appCode
     * @throws \Exception
     */
    public function __construct($appCode = "")
    {
        if(empty($appCode)){
            throw new \Exception("构造参数请传appcode参数");
        }
        $this->appCode = $appCode;
    }

    /**
     * 获取物流信息
     * getExpressInfo
     * @author: buddha
     * @date 2020/3/11 17:12
     * @param $queryInfo
     * @return bool|string
     * @throws \Exception
     */
    public function getExpressInfo($queryInfo)
    {
        if(!isset($queryInfo['NO'])){
            throw new \Exception("查询单号或者快递类型参数不存在");
        }
        if (empty($queryInfo['TYPE'])) {
            $queryInfo['TYPE'] = $this->type;
        }
        $queryStr = http_build_query($queryInfo);
        return $this->http_request($queryStr);
    }

    /**
     * curl请求
     * http_request
     * @author: buddha
     * @date 2020/3/11 17:11
     * @param $queryStr
     * @return bool|string
     */
    private function http_request($queryStr)
    {
        $url = $this->host . $this->path . "?" . $queryStr;
        $headers = [];
        array_push($headers, "Authorization:APPCODE " . $this->appCode);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $this->host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
}
