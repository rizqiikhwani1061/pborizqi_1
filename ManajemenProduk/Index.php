<?php
require_once 'Product.php';

$productObj = new Product();
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productObj->nama_produk = $_POST['nama_produk'];
    $productObj->harga = $_POST['harga'];
    $productObj->stok = $_POST['stok'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $productObj->update($_POST['id']);
    } else {
        $productObj->save();
    }
    header("Location: index.php");
    exit;
}

if ($action === 'delete' && $id) {
    $productObj->delete($id);
    header("Location: index.php");
    exit;
}

$editData = null;
if ($action === 'edit' && $id) {
    $editData = $productObj->findById($id);
}

$products = $productObj->findAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Manajemen Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        h2 { text-align: center; color: #00796b; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] {
            width: 100%; padding: 10px; border: 1px solid #ccc;
            border-radius: 6px; box-sizing: border-box;
        }
        button {
            padding: 10px 20px; background-color: #0288d1; color: white;
            border: none; border-radius: 6px; cursor: pointer; font-size: 14px;
        }
        button:hover { background-color: #0277bd; }
        table {
            width: 100%; border-collapse: collapse; margin-top: 25px;
        }
        th, td {
            padding: 12px; border-bottom: 1px solid #ddd; text-align: left;
        }
        th { background-color: #b2ebf2; color: #006064; }
        .btn-edit { color: #0288d1; text-decoration: none; margin-right: 10px; font-weight: bold;}
        .btn-delete { color: #d32f2f; text-decoration: none; font-weight: bold;}
    </style>
</head>
<body>

<div class="container">
    <h2>Manajemen Produk</h2>
  
    <form method="POST" action="index.php">
        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
        <div class="form-group">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?= $editData['nama_produk'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" value="<?= $editData['harga'] ?? '' ?>" required>
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok" value="<?= $editData['stok'] ?? '' ?>" required>
        </div>
        <button type="submit"><?= $editData ? 'Update Produk' : 'Simpan Produk' ?></button>
        <?php if($editData): ?>
            <a href="index.php" style="margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                <td><?= $row['stok'] ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                    <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($products)): ?>
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data produk.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>