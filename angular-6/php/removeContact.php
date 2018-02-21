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

header("Content-type: text/html; charset=utf-8");

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $id = (int) $_POST['id'];

    $sql = "DELETE FROM `contacts` WHERE `contacts`.`id` = $id";

    $mysqli = new mysqli("localhost", "sonyDB1", "sonyDB1", "sony");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();

}