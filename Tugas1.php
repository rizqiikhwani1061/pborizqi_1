<?php

class Produk {
    protected $nama;
    protected $merek;
    protected $harga;

    public function __construct($nama, $merek, $harga) {
        $this->nama = $nama;
        $this->merek = $merek;
        
        if (!is_numeric($harga) || $harga < 0) {
            echo "Error: Harga produk tidak valid!<br>";
            $this->harga = 0;
        } else {
            $this->harga = $harga;
        }
    }

    public function getInfo() {
        return "Merek: {$this->merek}<br>Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

class Makanan extends Produk {
    public $tanggalKadaluarsa;

    public function __construct($nama, $merek, $harga, $tanggalKadaluarsa) {
        parent::__construct($nama, $merek, $harga);
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }

    public function getInfo() {
        $hargaFormat = number_format($this->harga, 0, ',', '.');
        return "Produk: Makanan - {$this->nama}<br>" .
               "Merek: {$this->merek}<br>" .
               "Harga: Rp {$hargaFormat}<br>" .
               "Tanggal Kadaluarsa: {$this->tanggalKadaluarsa}<br>" .
               "Status: Segar<br>";
    }
}

class Elektronik extends Produk {
    public $garansi;

    public function __construct($nama, $merek, $harga, $garansi) {
        parent::__construct($nama, $merek, $harga);
        $this->garansi = $garansi;
    }

    public function getInfo() {
        $hargaFormat = number_format($this->harga, 0, ',', '.');
        return "Produk: Elektronik - {$this->nama}<br>" .
               "Merek: {$this->merek}<br>" .
               "Harga: Rp {$hargaFormat}<br>" .
               "Garansi: {$this->garansi} Tahun<br>";
    }
}


$produk1 = new Makanan("Keripik", "Kusuka", 18000, "2027-08-16");
$produk2 = new Elektronik("Laptop", "Lenovo", 5000000, 3);

echo $produk1->getInfo() . "<br>";
echo $produk2->getInfo() . "<br>";

?>