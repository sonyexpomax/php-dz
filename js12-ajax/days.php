<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: text/html; charset=utf-8");

$days = ['1. Monday', '2. Tuesday', '3. Wednesday', '4. Thursday', '5. Friday', '6. Saturday', '7. Sunday'];
$limit = $_GET['limit'];
$countOfDays = count($days);

if($_GET['startFrom'] == 0){
    $startFrom = 0;
}else{
    $startFrom = $_GET['startFrom'] % $countOfDays;
}

if(($countOfDays - $startFrom) < $limit){
    $result1 = array_slice($days, $startFrom, ($countOfDays - $startFrom));
    //    var_dump($result1);
    $result2 = array_slice($days, 0, ($limit - ($countOfDays - $startFrom)));
    //     var_dump($result2);
    $result = array_merge($result1,$result2);
}
else{
    $result = array_slice($days, $startFrom, $limit);
};
foreach ($result as $key => $day){
    $id =  $_GET['startFrom'] + $key;
    echo "createDiv($id,'$day');";

}
echo "
<script>ddsds/*
for(var i=0; i <6 ; i++){
document.body.removeChild(document.body.lastChild);
}*/
</script>
";
