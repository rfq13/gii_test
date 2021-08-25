<?php
$x=8;
for ($i = 1; $i <= $x; $i++) {
	for ($j = 1; $j <= $i ; $j++) {
		echo $j;
	}
	echo '<br>';
}

$jumlah=5;
for($a=1; $a<=$jumlah; $a++){
     for($b=$jumlah; $b>=$a; $b--){
          print('&nbsp');

     }
     for($c=1; $c<=$a; $c++){
          echo '*';
     }
     echo "<br/>";
}