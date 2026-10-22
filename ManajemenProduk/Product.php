<?php
require_once 'DatabaseConnection.php'; 

class Product {
    private $db;
    public $nama_produk;
    public $harga;
    public $stok;

    public function __construct() {
        $this->db = DatabaseConnection::getConnection(); 
    }

    public function save() {
        $query = "INSERT INTO products (nama_produk, harga, stok) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$this->nama_produk, $this->harga, $this->stok]);
    }

    public function findAll() {
        $query = "SELECT * FROM products ORDER BY id DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id) {
        $query = "UPDATE products SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$this->nama_produk, $this->harga, $this->stok, $id]);
    }

    public function delete($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>