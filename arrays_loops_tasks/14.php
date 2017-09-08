<?php
$arr = [4, 2, 5, 19, 13, 0, 10];
$check = [2,3,4];
$i=0;
foreach ($arr as $value_arr){
    foreach ($check as $value_check) {
        if ($value_arr==$value_check) {
            echo "ЕСТЬ!";
            $i++;
            break 2;
        }
    }
}
if ($i==0){
    echo "НЕТ!!";
}
?>