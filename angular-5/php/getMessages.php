<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.02.18
 * Time: 12:26
 */
header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $mysqli = new mysqli("localhost", "sonyDB1", "sonyDB1", "sony");

    $result = $mysqli->query("SELECT * FROM messages");

    if($result){

        while ($row = $result->fetch_object()){
            $messages[] = $row;
        }

        $result->close();
        echo json_encode($messages);
    }

}


