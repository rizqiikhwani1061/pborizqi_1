<?php
interface InfoKendaraan {
    public function getTarifSewa(): float;
    public function getInfo(): string;
}

class Pelanggan {
    private int $idPelanggan; 
    private string $nama;
    private string $nomorTelepon;
    private string $alamat;

    public function __construct(int $idPelanggan, string $nama, string $nomorTelepon, string $alamat) {
        $this->idPelanggan = $idPelanggan;
        $this->nama = $nama;
        $this->nomorTelepon = $nomorTelepon;
        $this->alamat = $alamat;
    }

    public function getIdPelanggan(): int {
        return $this->idPelanggan;
    }

    public function getNama(): string {
        return $this->nama;
    }

    public function getInfo(): string {
        return "Pelanggan: {$this->nama} | Telp: {$this->nomorTelepon}";
    }
}

class Kendaraan implements InfoKendaraan {
    private int $idKendaraan; 
    private string $nomorKendaraan;
    private string $jenisKendaraan;
    private string $merek;
    private float $tarifSewa;

    public function __construct(int $idKendaraan, string $nomorKendaraan, string $jenisKendaraan, string $merek, float $tarifSewa) {
        $this->idKendaraan = $idKendaraan;
        $this->nomorKendaraan = $nomorKendaraan;
        $this->jenisKendaraan = $jenisKendaraan;
        $this->merek = $merek;
        $this->tarifSewa = $tarifSewa;
    }

    public function getIdKendaraan(): int {
        return $this->idKendaraan;
    }

    public function getNomorKendaraan(): string {
        return $this->nomorKendaraan;
    }

    public function getTarifSewa(): float {
        return $this->tarifSewa;
    }

    public function getInfo(): string {
        return "Kendaraan: {$this->merek} ({$this->jenisKendaraan}) | Plat: {$this->nomorKendaraan}";
    }
}

class Peminjaman {
    private int $idPeminjaman;
    
    private int $idPelanggan;
    private int $idKendaraan;
    private string $tanggalMulai;
    private string $tanggalSelesai;
    private int $totalHari;
    private float $totalHarga;
    
    private string $statusPeminjaman;

    public function buatPeminjaman(int $idPeminjaman, Pelanggan $pelanggan, Kendaraan $kendaraan, string $tanggalMulai, string $tanggalSelesai, int $totalHari): void {
        $this->idPeminjaman = $idPeminjaman;
        
        $this->idPelanggan = $pelanggan->getIdPelanggan();
        $this->idKendaraan = $kendaraan->getIdKendaraan();
        
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
        $this->totalHari = $totalHari;
        
        $this->totalHarga = $kendaraan->getTarifSewa() * $this->totalHari;
        
        $this->statusPeminjaman = "Aktif";
    }

    public function kembalikanKendaraan(): void {
        $this->statusPeminjaman = "Selesai";
    }

    public function perbaruiStatus(string $status): void {
        $this->statusPeminjaman = $status;
    }

    public function getInfoTransaksi(): string {
        return "Transaksi #{$this->idPeminjaman} <br>" .
               "- ID Pelanggan : {$this->idPelanggan} <br>" .
               "- ID Kendaraan : {$this->idKendaraan} <br>" .
               "- Durasi       : {$this->totalHari} Hari <br>" .
               "- Total Harga  : Rp" . number_format($this->totalHarga, 0, ',', '.') . " <br>" .
               "- Status       : {$this->statusPeminjaman}<br>";
    }
}

echo "<h3>Simulasi Sistem Rental Kendaraan</h3>";

$pelanggan1 = new Pelanggan(101, "Nanda Adi", "081234567890", "Jl. Ayani, Pontianak");
$mobil1 = new Kendaraan(201, "KB 1234 XX", "Mobil", "Toyota Avanza", 300000);

$transaksi1 = new Peminjaman();
$transaksi1->buatPeminjaman(
    1, 
    $pelanggan1, 
    $mobil1,    
    "2026-10-31", 
    "2026-11-02", 
    3 
);

echo $pelanggan1->getInfo() . "<br>";
echo $mobil1->getInfo() . "<br>";
echo "<hr>";
echo "<b>Data Peminjaman Awal:</b><br>";
echo $transaksi1->getInfoTransaksi();
echo "<hr>";

echo "<b>Memproses pengembalian kendaraan...</b><br>";
$transaksi1->kembalikanKendaraan();
echo $transaksi1->getInfoTransaksi();

?>