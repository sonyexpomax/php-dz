<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.02.18
 * Time: 12:26
 */

$mysqli = new mysqli("localhost", "sonyDB1", "sonyDB1", "sony");

$result = $mysqli->query("SELECT * FROM messages");

    if($result){
        // Cycle through results
        while ($row = $result->fetch_object()){
            $feedbacks[] = $row;
        }
        // Free result set
        $result->close();
        echo json_encode($feedbacks;
    }

