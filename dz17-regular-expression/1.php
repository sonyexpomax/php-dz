<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 22.12.17
 * Time: 8:41
 */

//================== задание  1
echo 'Задание 1<br>';
$str = file_get_contents('http://php.net/downloads.php');

preg_match_all(
    "/<a[\w ]*(href|src)\s*=['\"](.+)['\"]/iU",
    $str,
    $matches
);
echo '<pre>';
//var_dump($matches[2]);
echo '</pre>';

//================= задание 2 ==============
echo '<br>Задание 2<br>';
$str = 'текст $var текст!!2345 текст $var_2;
         текст текст $var3 текст текст $var4;
         текст.,.,. текст $var5 текст екст $data1["key"];
         теdfs/.rfкс екст $data2["key"] 
        текс екст $data3["key"];<br>';
echo '<b>Исходная строка:</b> '.$str;
$result = preg_replace('/(\$[a-z0-9_\[\]\"\']+)([\s;\'])/iU',
    "<b>$1</b>$2",
    $str);
echo '<b>Результирующая строка:</b> '.$result;
//var_dump($matches2);


//================= задание 3=============
echo '<br>Задание 3<br>';
$str = 'https://sub.some-si_te.com/ads/some/page.html';
echo '<b>Исходная строка:</b> '.$str."<br>";
preg_match('/:\/\/([a-z0-9_.-]+)\//i', $str, $matches2);
echo '<b>Результирующая строка:</b> '.$matches2[1].'<br>';


//================= задание 4=============
echo '<br>Задание 4<br>';
$str = 'another *** message * ** another ** *** message *';
echo '<b>Исходная строка:</b> '.$str."<br>";
$result = preg_replace('/(\s)(\*\*)(\s)/iU',
    "$1!$3",
    $str);
echo '<b>Результирующая строка:</b> '.$result;


//================= задание 5=============
echo '<br>Задание 5<br>';
$str = 'we we are the the champions champions ';
echo '<b>Исходная строка:</b> '.$str."<br>";
$result = preg_replace('/(\b\w+\b\s)(?=.?\1)/si',
    "",
    $str);
echo '<b>Результирующая строка:</b> '.$result;
