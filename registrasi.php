<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Tidak Terdaftar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .message-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.2s ease;
        }
        .message-container h2 {
            color: #dc3545;
            font-size: 24px;
            font-weight: bold;
        }
        .message-container p {
            color: #555;
            margin-top: 10px;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .message-container a:hover {
            background-color: #c82333;
        }
        .icon-cross {
            font-size: 70px;
            color: #dc3545;
            margin-bottom: 20px;
            animation: popUp 0.5s ease-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes popUp {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .floating-circles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
        }

        .circle {
            position: absolute;
            background-color: rgba(220, 53, 69, 0.1);
            border-radius: 50%;
            animation: floatUp 5s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 150px;
            height: 150px;
            bottom: -50px;
            right: -50px;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 250px;
            height: 250px;
            top: -100px;
            left: -100px;
            animation-delay: 2s;
        }

        .circle:nth-child(3) {
            width: 200px;
            height: 200px;
            top: 40%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes floatUp {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-50px); opacity: 0; }
        }
    </style>
</head>
<body>

<div class="floating-circles">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div class="message-container">
    <div class="icon-cross">✘</div>
    <h2>Akun Tidak Terdaftar</h2>
    <p>Maaf, akun Anda tidak terdaftar. Silakan hubungi admin untuk bantuan lebih lanjut.</p>
    <a href="login.php">Kembali ke Halaman Utama</a>
</div>

</body>
</html>
