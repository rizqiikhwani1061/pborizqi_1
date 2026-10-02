<?php

abstract class LayananKlinik {
    protected $id;
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar) {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    public function getId() {
        return $this->id;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getHargaDasar() {
        return $this->hargaDasar;
    }

    abstract public function hitungTotal();
    abstract public function getJenis();
}

class Konsultasi extends LayananKlinik {
    private $menit;

    public function __construct($id, $nama, $hargaDasar, $menit) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->menit = $menit;
    }

    public function hitungTotal() {
        return $this->hargaDasar + (1000 * $this->menit);
    }

    public function getJenis() {
        return "Konsultasi";
    }
}

class Lab extends LayananKlinik {
    private $tes;

    public function __construct($id, $nama, $hargaDasar, $tes) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->tes = $tes;
    }

    public function hitungTotal() {
        $total = $this->hargaDasar + (50000 * $this->tes);
        
        if ($this->tes > 2) {
            $diskon = $total * 0.10;
            $total -= $diskon;
        }
        
        return $total;
    }

    public function getJenis() {
        return "Lab";
    }
}

class Vaksin extends LayananKlinik {
    private $dosis;

    public function __construct($id, $nama, $hargaDasar, $dosis) {
        parent::__construct($id, $nama, $hargaDasar);
        $this->dosis = $dosis;
    }

    public function hitungTotal() {
        return $this->hargaDasar + (15000 * $this->dosis) + 20000;
    }

    public function getJenis() {
        return "Vaksin";
    }
}
$objek1 = new Konsultasi("K001", "Rizqi Ikhwani", 50000, 30);
$objek2 = new Lab("L001", "Hafizh", 100000, 3); 
$objek3 = new Vaksin("V001", "Roby", 75000, 2); 
$objek4 = new Konsultasi("K002", "Citra", 50000, 15);
$objek5 = new Lab("L002", "Dewi", 100000, 1);

$daftarLayanan = [$objek1, $objek2, $objek3, $objek4, $objek5];

$totalKeseluruhan = 0;

echo "Daftar Layanan Klinik:<br><br>";

foreach ($daftarLayanan as $layanan) {
    $total = $layanan->hitungTotal();
    $totalKeseluruhan += $total; 

    echo "ID: " . $layanan->getId() . ", ";
    echo "Nama: " . $layanan->getNama() . ", ";
    echo "Jenis: " . $layanan->getJenis() . ", ";
    echo "Harga Dasar:Rp" . $layanan->getHargaDasar() . ", ";
    echo "Total:Rp" . $total . "<br>";
}

echo "<br>Total Keseluruhan:Rp" . $totalKeseluruhan;

?>