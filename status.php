<?php
session_start();

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit();
}

$id = (int)$_GET['id']; // Mengambil ID dari URL

// Data barang
$barangList = [
    1 => ['barang' => "Onemutan Sanemi", 'batch' => 'Batch 1', 'harga' => 'Rp22.000'],
    2 => ['barang' => "Onemutan Mui", 'batch' => 'Batch 2', 'harga' => 'Rp22.000'],
    3 => ['barang' => "Onemutan Giyuu", 'batch' => 'Batch 3', 'harga' => 'Rp22.000'],
];

if (!array_key_exists($id, $barangList)) {
    echo "Data barang tidak ditemukan.";
    exit();
}

$barang = $barangList[$id];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Barang</title>
</head>
<body>
    <h1>Status Barang</h1>
    <p><strong>Barang:</strong> <?php echo htmlspecialchars($barang['barang']); ?></p>
    <p><strong>Batch:</strong> <?php echo htmlspecialchars($barang['batch']); ?></p>
    <p><strong>Harga:</strong> <?php echo htmlspecialchars($barang['harga']); ?></p>
    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
