<?php
$array=[26, 17, 136, 12, 79, 15];
$result=0;
foreach ($array as $q){
    $result=$result+pow($q,2);
}
echo "$result<br>";
?>