<?php
for ($i = 1; $i <= 10; $i++) {
    for ($j = 1; $j <= 10; $j++) {
        $m=$i*$j;
        echo str_pad($m, 6,' ', STR_PAD_LEFT);
    }
    echo "<br />";
}



