<?php

class DatabaseConnection {
    private static $connection = null;

    private function __construct() {}

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=localhost;dbname=manajemen_produk;charset=utf8";
                $username = "root";
                $password = "";
                
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi gagal: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>