<?php
/**
 * Created by PhpStorm.
 * author: sjzlai
 * User: Administrator
 * Date: 2018/10/26 0026
 * Time: 15:44
 */
namespace  Sjzlai\Yuntongxun\Facades;
use Illuminate\Support\Facades\Facade;
class Yuntongxun extends Facade {
    protected static function getFacadeAccessor()
    {
//        parent::getFacadeAccessor(); // TODO: Change the autogenerated stub
        return 'yuntongxun';
    }
}