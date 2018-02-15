<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 14.02.18
 * Time: 9:50
 */

include ('likes.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
   // $records[] = $_GET;
    $isLike = $_GET['isLike'];
    $id = (int) $_GET['id'];
    if($isLike == 'true'){
        var_dump($records[$id]['like']);
        $records[$id]['like'] += 1;
        var_dump($records[$id]['like']);
    }
    else{
        $records[$id]['dislike'] += 1;
    }
    echo $_GET['id'].'  '.$_GET['isLike'];
    echo is_numeric($id);

}
