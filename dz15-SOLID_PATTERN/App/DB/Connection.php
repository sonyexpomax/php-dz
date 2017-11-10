<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 02.11.17
 * Time: 10:39
 */

namespace App\DB;
//include('IConnection.php');
use App\Main\Config;

class Connection implements IConnection
{

    private $connection;
    private static $_instance; //The single instance

    public static function getInstance() {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        $this->connection =  mysqli_connect(
            Config::get('dbHost'),
            Config::get('dbUser'),
            Config::get('dbPassword'),
            Config::get('dbName')
        );

        if(mysqli_connect_error()) {
            trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
        return $this->connection;
    }


    public function query($query){
        return mysqli_query($this->connection, $query );
    }

}