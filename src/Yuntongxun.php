<?php
/**
 * Created by PhpStorm.
 * author: sjzlai
 * User: Administrator
 * Date: 2018/10/26 0026
 * Time: 15:07
 */
namespace Sjzlai\Yuntongxun;

use Illuminate\Config\Repository;

use Mockery\Exception;
use Sjzlai\Yuntongxun\CCPRestSms;
class Yuntongxun
{
    protected $config;
    protected $rest;
    public function __construct(Repository $config)
    {
        $this->config = $config->get('yuntongxun');
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        $accountSid = $this->config['accountSid'];
        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        $accountToken = $this->config['accountToken'];
        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        $appId = $this->config['appId'];
        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        $serverIP = $this->config['serverIP'];
        //请求端口，生产环境和沙盒环境一致
        $serverPort = $this->config['serverPort'];
        //REST版本号，在官网文档REST介绍中获得。
        $softVersion = $this->config['softVersion'];
        // 初始化REST SDK
        $this->rest = new CCPRestSms($serverIP,$serverPort,$softVersion);
        $this->rest->setAccount($accountSid,$accountToken);
        $this->rest->setAppId($appId);
    }
    /**
     * 发送短信
     * @param $phone
     * @param $datas
     * @param $tempId
     * @return array|mixed|内容数据|\SimpleXMLElement
     */
    public function sms($phone,$datas,$tempId){
        $result = [];
        try{
            // 发送模板短信
            $result = $this->rest->sendTemplateSMS($phone,$datas,$tempId);
            if($result == NULL ) {
                throw new Exception('result error!',-1);
            }
            if($result->statusCode!=0) {
                throw new Exception($result->statusCode.$result->statusMsg,-2);
            }
            $result = [
                'code'  => 1,
                'msg'   => '请求成功'
            ];
        } catch(Exception $e){
            $result = [
                'code'  => $e->getCode(),
                'msg'   => $e->getMessage()
            ];
        }
        return $result;
    }
}