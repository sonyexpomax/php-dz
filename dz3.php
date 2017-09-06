<?php
$n=24;
echo "n = $n<br /><br />";
//---------------------------  Задание 1  ------------
echo "<b>Задание 1</b><br />";
for ($i=1; $i<=$n; $i++){
    echo "$i. Silence is golden<br />";
}

//---------------------------  Задание 2 FOR ------------
echo "<b>Задание 2</b><br />";
$s=0;
for ($i=1; $i<=150; $i++){
    $s=$s+$i;
//    echo "иттерация  $i). $s<br />";
}
echo "Cумма чисел в диапазоне от 1 до 150 (FOR) = $s<br/>";

//---------------------------  Задание 2 while ------------
$s=0;
$i=1;
while ($i<=150){
    $s=$s+$i;
//    echo "иттерация  $i). $s<br />";
    $i++;
}
echo "Cумма чисел в диапазоне от 1 до 150 (while) = $s<br/>";

//---------------------------  Задание 3 ------------
echo "<b>Задание 3</b><br />";
for ($i=1; $i<=200; $i++){
    echo "N - $i<br />";
}

//---------------------------  Задание 4 for------------
echo "<b>Задание 4</b><br />";
echo "Числа в последовательности от 200 до 1 (for)<br/>";
echo "<table>
        <tr>
            <th>FOR</th>
            <th>WHILE</th>
            <th>foreach</th>
        <tr>
            <td>";
for ($i=200; $i>=1; $i--){
    echo "$i<br />";
}
echo "</td>
      <td>";
$i=200;
//---------------------------  Задание 4 while------------
while ($i>=1){
    echo "$i<br />";
    $i--;
}
echo "</td>
      <td>";
//---------------------------  Задание 4 foreach------------
foreach (range(200, 1) as $i) {
    echo "$i<br />";
}
echo "</td>
    </tr>
  </table>";

//---------------------------  Задание 5 FOR ------------
echo "<b>Задание 5</b><br />";
$s=1;
for ($i=1; $i<=50; $i++){
    $s=$s*$i;
//    echo "иттерация  $i). $s<br />";
}
echo "произведение чисел от 1 до 50 (FOR) = $s<br/>";

//---------------------------  Задание 5 foreach ------------
$s=1;
foreach (range(1, 50) as $i) {
    $s=$s*$i;
//    echo "иттерация  $i). $s<br />";
}
echo "произведение чисел от 1 до 50 (FOREACH) = $s<br/>";


//---------------------------  Задание 6 FOR ------------
echo "<b>Задание 6</b><br />";
echo "<table>
        <tr>
            <th>FOR</th>
            <th>WHILE</th>
        <tr>
            <td>";
$s=1;
for ($i=1; $i<1000; $i++){
    if ($i%3==0 and $i%5==0) {
        echo "$i<br />";
    }
}
echo "</td>
      <td>";
//---------------------------  Задание 6 while ------------
$i=1;
while ($i<1000){
    if ($i%3==0 and $i%5==0) {
        echo "$i<br />";
    }
    $i++;
}
echo "</td>
    </tr>
  </table>";

//---------------------------  Задание 7 -------------
echo "<b>Задание 7</b><br />";
$s=0;
$s=0;
for ($i=100000; $i<119999; $i++) {  //сузил немного диапазон, уж очень долго перебирает!!
    $sum_first_3=substr($i, 0, 1)+substr($i, 1, 1)+substr($i, 2, 1);
    $sum_last_3=substr($i, 3, 1)+substr($i, 4, 1)+substr($i, 5, 1);
    if($sum_first_3== $sum_last_3) {
        echo "$i<br />";
        $s++;
    }
    $s1++;
}
$p=round((100*$s/$s1),2);
echo "Количество счастливых билетов в заданном диапазоне - $s<br />";
echo "процент счастливых билетов от общего числа - $p<br />";

//---------------------------  Задание 8 for-------------
unset($n);
echo "<b>Задание 8</b><br />";
for ($i=0; $i<30; $i++) {
    if ($i % 2 == 0) {
        $n[$i] = 0;
    }
    else{
        $n[$i] = 1;
    }
}
echo "<pre>";
print_r($n);
echo "</pre>";

//---------------------------  Задание 8 while-------------
unset($n);
$i=0;
while($i<30){
    if ($i % 2 == 0) {
        $n[$i] = 0;
    }
    else{
        $n[$i] = 1;
    }
    $i++;
}
echo "<pre>";
print_r($n);
echo "</pre>";
//---------------------------  Задание 9 -------------
unset($n);
echo "<b>Задание 9</b><br />";
for ($i=1; $i<30; $i++) {
        $n[$i] = pow($i,2);
}
echo "<pre>";
print_r($n);
echo "</pre>";

//---------------------------  Задание 10 -------------
unset($n);
echo "<b>Задание 10</b><br />";
$array1 = array(1,5,6,8,13,14,15,80);
$array2 = array(0,2,5,12,65,68,70,71);
$r_both=array_merge($array1, $array2);
//$result=uasort($r_both,strnatcmp);
echo "<pre>";
print_r($r_both);
echo "</pre>";

//---------------------------  Задание 11 -------------
unset($n);
$n=2311561;
echo "<b>Задание 11</b><br />";
echo "n=$n<br>";
$count=strlen($n) ;
$f=$count/3;
$bythree=ceil($f);
//echo "count =  $count <br>";
//echo "bythree =  $bythree <br>";
$j=1;
for ($i=1;$i<=$bythree;$i++){
    unset($s1);
    unset($s2);
    unset($s3);
    unset($simvol_one);
    unset($simvol_two);
    unset($simvol_three);
    //echo $j."<br>";
    $simvol_one =   substr($n, $count-$j, 1);
    if(($count-$j+1)>=3){
        $simvol_three = substr($n, $count-$j-2, 1);
        if ($simvol_three>0) {
            switch ($simvol_three) {
                case '1':
                    $s3 = "сто";
                    break;
                case '2':
                    $s3 = "двести";
                    break;
                case '3':
                    $s3 = "триста";
                    break;
                case '4':
                    $s3 = "четыреста";
                    break;
                case '5':
                    $s3 = "пятьсот";
                    break;
                case '6':
                    $s3 = "шестьсот";
                    break;
                case '7':
                    $s3 = "семьсот";
                    break;
                case '8':
                    $s3 = "восемьсот";
                    break;
                case '9':
                    $s3 = "девятьсот";
                    break;
            }
        }
    }

    if(($count-$j+1)>=2){
        $simvol_two = substr($n, $count-$j-1, 1);
   //     echo "simvol_two = $simvol_two<br>";
         if ($simvol_two==1){
             switch ($simvol_one) {
                 case '0':    $s2 = "десять";
                     break;
                 case '1':    $s2 = "одиннацать";
                     break;
                 case '2':    $s2 = "двенадцать";
                     break;
                 case '3':    $s2 = "тринадцать";
                     break;
                 case '4':    $s2 = "четырнадцать";
                     break;
                 case '5':    $s2 = "пятнадцать";
                     break;
                 case '6':    $s2 = "шестнадцать";
                     break;
                 case '7':    $s2 = "семнадцать";
                     break;
                 case '8':    $s2 = "восемнадцать";
                     break;
                 case '9':    $s2 = "девятнадцать";
                     break;
             }
         }


        if ($simvol_two!=1) {
   //         echo "simvol_two ==== $simvol_two<br>";
            switch ($simvol_two) {
                case '2':
                    $s2 = "двадцать";
                    break;
                case '3':
                    $s2 = "тридцать";
                    break;
                case '4':
                    $s2 = "сорок";
                    break;
                case '5':
                    $s2 = "пятьдесят";
                    break;
                case '6':
                    $s2 = "шестьдесят";
                    break;
                case '7':
                    $s2 = "семьдесят";
                    break;
                case '8':
                    $s2 = "восемдесят";
                    break;
                case '9':
                    $s2 = "девяносто";
                    break;
            }
        }
    }
    if ($simvol_one<>0 and $simvol_two<>1){
        switch ($simvol_one) {
            case '1':    $s1 = "один";
                break;
            case '2':    $s1 = "два ";
                break;
            case '3':    $s1 = "три ";
                break;
            case '4':    $s1 = "четыре";
                break;
            case '5':    $s1 = "пять";
                break;
            case '6':    $s1 = "шесть";
                break;
            case '7':    $s1 = "семь";
                break;
            case '8':    $s1 = "восемь";
                break;
            case '9':    $s1 = "девять";
                break;
        }

    }
    $s=$s3." ".$s2." ".$s1;
    if ($j==4) {
        if ($simvol_two <> 1) {
            switch ($simvol_one) {
                case '1':
                    $st = "тысяча";
                    break;
                case '2':
                case '3':
                case '4':
                    $st = "тысячи";
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                case '0':
                    $st = "тысяч";
                    break;
            }
        }
        if ($simvol_two == 1) {
            $st = "тысяч";
        }
        if ($simvol_one == 0 and $simvol_two == 0 and $simvol_three == 0) {
            $st = " ";
        }
        $s = $s . " " . $st;
    }
    if ($j==7) {
       if ($simvol_two <> 1) {
            switch ($simvol_one) {
                case '1':
                    $sm = "миллон";
                    break;
                case '2':
                case '3':
                case '4':
                    $sm = "миллона";
                    break;
                case '5':
                case '6':
                case '7':
                case '8':
                case '9':
                case '0':
                    $sm = "миллонов";
                    break;
            }
        }
        if ($simvol_two == 1) {
            $sm = "миллонов";
        }
        if ($simvol_one == 0 and $simvol_two == 0 and $simvol_three == 0) {
            $sm = " ";
        }
        $s = $s . " " . $sm;
    }
$sb=$s." ".$sb;
   // echo "$s<br>";
   // $i=$i+2;
    $j=$j+3;
}

echo "$sb<br>";
//---------------------------  Задание 12 -------------
echo "<b>Задание 12</b><br />";
$array11=range(a,z);
foreach ($array11 as $i){
    echo "$i<br>";
}
