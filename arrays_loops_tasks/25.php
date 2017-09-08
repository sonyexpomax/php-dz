<?php
$max_key=0;
$min_key=20;
$max_val=0;
$min_val=1001;
for ($i = 0; $i <= 20; $i++){
    $array[$i] = rand(1, 1000);
    if ($array[$i]>$max_val){
        $max_val=$array[$i];
        $max_key=$i;
    }
    if ($array[$i]<$min_val){
        $min_val=$array[$i];
        $min_key=$i;
    }
}
echo "Исходный массив с выбранными min и max:<br />";
foreach ($array as $key => $value){
    if ($value==$max_val or $value==$min_val){
        echo "<font color='red'><b color='red'>$key => $value</b></font><br />";
    }
    else{
        echo "$key => $value<br/>";
    }
}
//echo $array[$max_key]."-------".$array[$min_key]."<br />";
$array[$max_key]=$min_val;
$array[$min_key]=$max_val;
echo "<br />Выходной массив с поменанными местами min и max:<br />";
foreach ($array as $key => $value){
    if ($value==$max_val or $value==$min_val){
        echo "<font color='blue'><b color='red'>$key => $value</b></font><br />";
    }
    else{
        echo "$key => $value<br/>";
    }
}
?>