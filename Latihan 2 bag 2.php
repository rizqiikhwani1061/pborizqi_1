<?php

$angka1 = 0;
$angka2 = 1;

echo "Deret Fibonacci hingga 10 suku: <br>";

for ($i = 0; $i < 10; $i++) {
    echo $angka1 . " ";
    
    $selanjutnya = $angka1 + $angka2;
    
    $angka1 = $angka2;
    $angka2 = $selanjutnya;
}

?>