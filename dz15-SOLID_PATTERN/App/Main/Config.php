<?php

namespace App\Main;
class Config implements IConfig {

    static private  $options = [
        'dbHost' =>     'localhost',
        'dbUser' =>     'goods',
        'dbPassword' => 'goods',
        'dbName' =>     'goods',
    ];

    public static function  get($paramName){
        return self::$options[$paramName];
    }

    protected static $pageLimit = 5;

    public static function getPageLimit(){
        return self::$pageLimit;
    }
    public function setPageLimit($pageLimit){
        self::$pageLimit = $pageLimit;
    }

}