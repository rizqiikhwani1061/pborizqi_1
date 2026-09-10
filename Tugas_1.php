<?php

class Mobil
{
    private $merek;
    private $warna;
    private $kecepatan;

    public function __construct($merek, $warna, $kecepatan)
    {
        $this->merek = $merek;

        $this->setWarna($warna);
        $this->setKecepatan($kecepatan);
    }

    public function getMerek()
    {
        return $this->merek;
    }

    public function getWarna()
    {
        return $this->warna;
    }

    public function getKecepatan()
    {
        return $this->kecepatan;
    }

    public function setMerek($merek)
    {
        $this->merek = $merek;
    }


    public function setWarna($warna)
    {
        if (empty(trim($warna))) {
            echo "Error: Warna untuk mobil {$this->merek} tidak boleh kosong.<br>";
        } elseif (strlen(trim($warna)) < 3) {
            echo "Error: Warna '{$warna}' untuk mobil {$this->merek} tidak valid (minimal 3 karakter).<br>";
        } else {
            $this->warna = $warna;
        }
    }


    public function setKecepatan($kecepatan)
    {
        if ($kecepatan < 0) {
            echo "Error: Mobil {$this->merek} dengan kecepatan {$kecepatan} tidak valid (kecepatan tidak boleh negatif).<br>";
        } elseif ($kecepatan > 200) {
            echo "Error: Mobil {$this->merek} dengan kecepatan {$kecepatan} melebihi batas (maksimal 200 km/jam).<br>";
        } else {
            $this->kecepatan = $kecepatan;
        }
    }

    public function getInfo()
    {
        $w = $this->warna ? $this->warna : "[Warna Invalid]";
        $k = $this->kecepatan !== null ? $this->kecepatan : "[Kecepatan Invalid]";

        return "Mobil {$this->getMerek()} berwarna {$w} dengan kecepatan {$k} km/jam.";
    }

    public function jalankan()
    {
        return "Mobil berjalan...";
    }

    public function berhenti()
    {
        return "Mobil berhenti";
    }
}

$mobil1 = new Mobil("Mazda", "Hitam", 120);
$mobil2 = new Mobil("Suzuki", "Merah", 100);
$mobil3 = new Mobil("Hyundai", "Putih", 98);

echo "<b>===== Info Mobil 1 =====</b><br>";
echo $mobil1->getInfo() . "<br>";
echo $mobil1->jalankan() . "<br><br>";

echo "<b>===== Info Mobil 2 =====</b><br>";
echo $mobil2->getInfo() . "<br>";
echo $mobil2->berhenti() . "<br><br>";

echo "<b>===== Info Mobil 3 =====</b><br>";
echo $mobil3->getInfo() . "<br>";
echo $mobil3->jalankan() . "<br>";
