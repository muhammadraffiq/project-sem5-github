<?php
// Cek apakah formulir dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Direktori penyimpanan gambar
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // Buat folder jika belum ada
    }

    $fileName = basename($_FILES["profilePicture"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validasi ukuran file (maks 2MB)
    if ($_FILES["profilePicture"]["size"] > 2097152) {
        echo "Error: File size exceeds 2MB.";
        exit;
    }

    // Validasi tipe file
    $allowedTypes = ['jpg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Error: Only JPG, PNG, and GIF files are allowed.";
        exit;
    }

    // Upload file
    if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFilePath)) {
        echo "Success: File uploaded successfully to $targetFilePath.";
    } else {
        echo "Error: There was an error uploading your file.";
    }
} else {
    echo "Invalid request method.";
}
?>
