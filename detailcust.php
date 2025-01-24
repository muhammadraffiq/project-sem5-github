<?php
// Data customer
$customers = [
    1 => [
        "nama" => "Customer 1",
        "toko" => ["HiFi Technology"],
        "tanggal" => "2025-01-10",
        "alamat" => "Jl. Garam No. 13, Jakarta",
        "produk" => ["Powerbank ANKERS"]
    ],
    2 => [
        "nama" => "Customer 2",
        "toko" => ["LoFi Tics"],
        "tanggal" => "2025-01-12",
        "alamat" => "Jl. Ubud No. 10, Bandung",
        "produk" => ["Casing Indroid"]
    ],
    3 => [
        "nama" => "Customer 3",
        "toko" => ["RECH Tech"],
        "tanggal" => "2025-01-15",
        "alamat" => "Jl. Pahlawan No. 11, Surabaya",
        "produk" => ["Earphone JDL"]
    ],
    4 => [
        "nama" => "Customer 4",
        "toko" => ["AB Handphone"],
        "tanggal" => "2025-01-17",
        "alamat" => "Jl. Pattimura No. 14, Yogyakarta",
        "produk" => ["Handphone Samsam A12"]
    ]
];

// Ambil parameter customer
$customer_id = isset($_GET['customer']) ? (int)$_GET['customer'] : null;

// Cek apakah customer valid
if (isset($customers[$customer_id])) {
    $customer = $customers[$customer_id];
} else {
    die("Customer tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - <?= $customer['nama'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: linear-gradient(135deg, #a8c0ff, #3f2b96);
            background-size: 400% 400%;
            background-position: center;
            animation: gradientAnimation 10s ease infinite;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .container h2 {
            text-align: center;
            color: #007aff;
        }

        .order-details {
            margin-top: 20px;
        }

        .order-details p {
            font-size: 16px;
            margin: 10px 0;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background-color: #007aff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Pesanan</h2>
        <div class="order-details">
            <p><strong>Nama Pembeli:</strong> <?= $customer['nama'] ?></p>
            <p><strong>Toko Penjual:</strong> <?= implode(", ", $customer['toko']) ?></p>
            <p><strong>Tanggal Pembelian:</strong> <?= $customer['tanggal'] ?></p>
            <p><strong>Alamat:</strong> <?= $customer['alamat'] ?></p>
            <p><strong>Info Produk:</strong> <?= implode(", ", $customer['produk'])  ?></p>
        </div>
        <a href="customer.html" class="back-link">Kembali ke Daftar Customer</a>
    </div>
</body>

</html>
