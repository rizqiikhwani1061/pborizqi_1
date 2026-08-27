<?php

class PersegiPanjang{
    public $panjang;
    public $lebar;
    
    public function luas() {
        return $this->panjang * $this->lebar;
    }
}

$kotak = new PersegiPanjang();
$kotak->panjang = 20;
$kotak->lebar = 10;

$kotak2 = new PersegiPanjang();
$kotak2->panjang = 20;
$kotak2->lebar = 10;

echo "kotak1 = ".$kotak->luas() . "<br>";
echo "kotak2 = ".$kotak2->luas();

?>