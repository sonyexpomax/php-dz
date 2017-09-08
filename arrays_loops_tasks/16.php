<?php
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$count=0;
foreach ($arr as $value_arr){
    if ($value_arr%3==0){
        echo $value_arr." ";
    }
    else{
        echo $value_arr.", ";
    }
}
?>