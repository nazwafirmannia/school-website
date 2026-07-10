<?php include "koneksi.php" ; 

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data layanan
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM services WHERE id = $id");
$service = $result->fetch_assoc();

// Update layanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $delay = $_POST['delay'];

    $sql = "UPDATE services SET icon='$icon', title='$title', description='$description', delay='$delay' WHERE id=$id";
    $conn->query($sql);
    header("Location: konten_home_layanan.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #4CAF50;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"], 
        input[type="number"], 
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus, 
        input[type="number"]:focus, 
        textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background: #4CAF50;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                font-size: 14px;
            }

            input[type="text"], 
            input[type="number"], 
            textarea {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Service</h1>
    <div class="container">
        <form action="" method="POST">
            <label for="icon">Icon:</label>
            <input type="text" name="icon" id="icon" value="<?php echo $service['icon']; ?>" required>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $service['title']; ?>" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo $service['description']; ?></textarea>

            <label for="delay">Delay (in seconds):</label>
            <input type="number" name="delay" id="delay" value="<?php echo $service['delay']; ?>" step="0.1" required>

            <button type="submit">Update Service</button>
        </form>

        <a href="konten_home_layanan.php">Back to Services</a>
    </div>
</body>
</html>
