<?php

header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $isLike = $_GET['isLike'];
    $id = (int) $_GET['id'];
    if($isLike == 'true'){
       $sql = "UPDATE messages SET likes= likes+1 WHERE id=$id";
    }
    else{
        $sql = "UPDATE messages SET disles= disles+1 WHERE id=$id";
    }
    

$mysqli = new mysqli("localhost", "0000", "0000", "0000");

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