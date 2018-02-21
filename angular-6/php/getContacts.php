<?php

header("Content-type: text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');

header("Content-type: text/html; charset=utf-8");
$mysqli = new mysqli("localhost", "sonyDB1", "sonyDB1", "sony");

$result = $mysqli->query("SELECT * FROM contacts");

$contacts = [];
if($result){
    // Cycle through results
    while ($row = $result->fetch_object()){
        $contacts[] = $row;
    }
    // Free result set
    $result->close();
    echo json_encode($contacts);
}
