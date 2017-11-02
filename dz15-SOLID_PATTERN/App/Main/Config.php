<?php

namespace App\Main;
include('IConfig.php');
class Config implements \IConfig {

    static private  $options = [
        'dbHost' =>     'localhost',
        'dbUser' =>     'goods',
        'dbPassword' => 'goods',
        'dbName' =>     'goods',
    ];

    public static function  get($paramName){
        return self::$options[$paramName];
    }
}