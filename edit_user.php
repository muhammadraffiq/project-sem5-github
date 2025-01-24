<?php
// Memulai session untuk mengambil data pengguna
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_form.html");
    exit();
}

// Ambil data pengguna dari sesi
$username = $_SESSION['username'];
$profileImage = isset($_SESSION['profileImage']) ? $_SESSION['profileImage'] : "profile.jpeg"; // Default image
$discord = isset($_SESSION['discord']) ? $_SESSION['discord'] : "";

// Inisialisasi variabel error
$errors = [];

// Periksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newUsername = trim($_POST['username']);
    $newDiscord = trim($_POST['discord']);
    $newProfileImage = $_FILES['profileImage'];

    // Validasi username
    if (empty($newUsername)) {
        $errors[] = "Username tidak boleh kosong.";
    }

    // Validasi Discord
    if (empty($newDiscord)) {
        $errors[] = "Discord tidak boleh kosong.";
    }

    // Menangani upload gambar profil
    if ($newProfileImage['size'] > 0) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($newProfileImage['type'], $allowedTypes)) {
            $errors[] = "Hanya gambar JPEG dan PNG yang diizinkan.";
        } else {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($newProfileImage['name']);
            if (move_uploaded_file($newProfileImage['tmp_name'], $targetFile)) {
                $_SESSION['profileImage'] = $targetFile; // Menyimpan path gambar di session
            } else {
                $errors[] = "Gagal mengunggah gambar.";
            }
        }
    }

    // Jika tidak ada error, simpan perubahan
    if (empty($errors)) {
        $_SESSION['username'] = $newUsername;
        $_SESSION['discord'] = $newDiscord;

        // Redirect kembali ke dashboard setelah berhasil menyimpan
        header("Location: dash_board.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
        }

        .form-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-size: 24px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-container input[type="file"] {
            padding: 0.5rem;
        }

        .form-container button {
            width: 100%;
            padding: 1rem;
            background-color: #007aff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 1rem;
        }

        .error ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Edit Profil</h2>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulir Edit Profil -->
        <form action="edit_user.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="discord">Discord</label>
            <input type="text" id="discord" name="discord" value="<?php echo htmlspecialchars($discord); ?>" required>

            <label for="profileImage">Gambar Profil</label>
            <input type="file" id="profileImage" name="profileImage" accept="image/jpeg, image/png">

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

</body>

</html>
