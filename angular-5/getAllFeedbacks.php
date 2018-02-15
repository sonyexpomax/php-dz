<?php
include ('likes.php');


if($_SERVER['REQUEST_METHOD'] == "GET"){
    echo json_encode($records);
}

