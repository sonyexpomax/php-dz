<?php
$i = 1;
while ($i <= 10) {
    $j = 1;
    while ( $j <= 10) {
        $m=$i*$j;
        echo str_pad($m, 6,' ', STR_PAD_LEFT);
        $j++;
    }
    echo "<br />";
    $i++;
}



