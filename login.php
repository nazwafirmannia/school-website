<?php
include 'koneksi.php'; // Sambungkan dengan database
session_start(); // Pastikan session dimulai

// Proses validasi login setelah form di-submit
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username dan password di database
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Set session untuk login
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['username'] = $username;

            // Arahkan ke beranda
            header("Location: beranda.php");
            exit;
        } else {
            // Password salah, arahkan ke halaman registrasi setelah pesan ditampilkan
            echo "<p style='color:red;'>Password salah. Anda akan diarahkan ke halaman registrasi...</p>";
            header("Refresh: 3; url=registrasi.php"); // Arahkan ke halaman registrasi setelah 3 detik
            exit;
        }
    } else {
        // Jika username tidak ditemukan, arahkan langsung ke halaman registrasi
        header("Location: registrasi.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('background.jpg'); /* Ganti dengan URL gambar latar belakang */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            animation: fadeIn 0.5s; /* Animasi saat loading */
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s; /* Transisi border */
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #5cb85c; /* Warna border saat fokus */
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; /* Transisi warna latar belakang */
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .show-password {
            margin-top: -10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .show-password input {
            margin-right: 5px;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        
        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        }
        ?>

        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <div class="show-password">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Show Password</label>
            </div>

            <button type="submit" name="submit">Login</button>
        </form>

        <div class="register-link">
            <p>Belum punya akun? <a href="registrasi.php">Buat Akun</a></p>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("showPassword");
            passwordField.type
            if (showPasswordCheckbox.checked) {
                passwordField.type = "text"; // Show password
            } else {
                passwordField.type = "password"; // Hide password
            }
        }
    </script>
</body>
</html>