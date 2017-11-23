<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/20/17
 * Time: 19:10
 */

namespace App\Core;

class Session
{
    use \App\Core\Traits\Singleton;

    /**
     * Session constructor.
     */
    protected function __construct()
    {
        session_start();
    }

    public static  function destroy()
    {
        session_destroy();
    }

    public function __destruct()
    {
        session_write_close();
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * @param $key
     */
    public static function unset($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }


    protected static $flash_message = [];

    public static function addFlash($message){
        self::$flash_message[] = $message;
    }

    public static function hasFlash(){

        return !empty(self::$flash_message);
    }

    public static function flash(){

        $data = self::$flash_message;
        self::$flash_message = [];
        return $data;
    }

}