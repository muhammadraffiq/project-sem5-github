<?php
// Cek apakah formulir dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $fullName = trim($_POST['fullName']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $birthdate = trim($_POST['birthdate']);
    $gender = trim($_POST['gender']);

    // Validasi data
    if (empty($fullName) || empty($phone) || empty($email) || empty($birthdate) || empty($gender)) {
        echo "Error: All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email address.";
        exit;
    }

    if (!preg_match('/^\+?\d+$/', $phone)) {
        echo "Error: Invalid phone number.";
        exit;
    }

    // Simpan data ke database atau file (opsional)
    // Contoh menyimpan ke file
    $data = "Full Name: $fullName\nPhone: $phone\nEmail: $email\nBirthdate: $birthdate\nGender: $gender\n\n";
    file_put_contents("user_data.txt", $data, FILE_APPEND);

    echo "Success: Profile updated successfully.";
} else {
    echo "Invalid request method.";
}
?>
