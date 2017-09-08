<?php
$arr = ['green'=>'зеленый', 'red'=>'красный','blue'=>'голубой'];
echo "<table width='20%'>";
foreach ($arr as $keys => $values){
    echo "<tr>
            <td>$keys</td><td>$values</td>
          </tr>";
}
echo "</table>";
?>