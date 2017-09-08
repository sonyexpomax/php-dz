<?php
$arr_days = [
    1 =>'Понедельник' ,
    2 =>'Вторник' ,
    3 =>'Среда' ,
    4 =>'Четверг' ,
    5 =>'Пятница' ,
    6 =>'Суббота' ,
    7 =>'Воскресенье'
];

foreach ($arr_days as $keys => $values){
    if ($keys==date("N")){
        $day=$values;
        echo "<i><b>$values</b></i><br />";
    }
    else{
        echo "$values<br />";
    }
}
?>

