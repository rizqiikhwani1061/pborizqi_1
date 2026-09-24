<?php

interface Bentuk {
    public function hitungLuas();
}

class Persegi implements Bentuk {
    private $sisi;

    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    public function hitungLuas() {
        $luas = $this->sisi * $this->sisi;
        return "Luas Persegi (sisi={$this->sisi}): {$luas}";
    }
}

class Lingkaran implements Bentuk {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function hitungLuas() {
        $luas = 3.14 * $this->radius * $this->radius;
        return "Luas Lingkaran (radius={$this->radius}): {$luas}";
    }
}

$kumpulanBentuk = [
    new Persegi(5),
    new Lingkaran(7)
];

foreach ($kumpulanBentuk as $bentuk) {
    echo $bentuk->hitungLuas() . "<br>";
}

?>