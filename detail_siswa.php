<?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID peserta tidak ditemukan.";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM data_peserta WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }
        .container {
            max-width: 800px;
            width: 100%;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.5s ease-in-out;
        }
        h2 {
            color: #4B0082;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .data-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .data-item:hover {
            background-color: #f0f8ff;
        }
        .data-item i {
            color: #2575fc;
            margin-right: 15px;
            font-size: 20px;
        }
        .data-item span {
            font-weight: bold;
            color: #4B0082;
            flex-basis: 35%;
            text-align: right;
            margin-right: 20px;
        }
        .data-item .value {
            flex-grow: 1;
            color: #555;
        }
        .back-link {
            display: block;
            margin: 30px auto 0;
            padding: 12px 25px;
            color: #fff;
            background-color: #4B0082;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
            width: fit-content;
        }
        .back-link:hover {
            background-color: #5a0f99;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Peserta</h2>
        <?php if ($data): ?>
            <?php foreach ($data as $key => $value): ?>
                <div class="data-item">
                    <i class="fas fa-info-circle"></i>
                    <span><?php echo ucfirst(str_replace('_', ' ', $key)); ?>:</span>
                    <div class="value"><?php echo htmlspecialchars($value); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Data peserta tidak ditemukan.</p>
        <?php endif; ?>
        <a href="data_siswa.php" class="back-link">Kembali</a>
    </div>

    <!-- Font Awesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
