<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Motor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: #fff;
        }

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }

        label {
            display: block;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }

        .result {
display: none;
            margin-top: 20px;
        }

        .result.show {
            display: block;
        }
    </style>
</head>
<body>
    <center>
        <h1>Form Rental Motor</h1>
        <form action="" method="post">
            <label for="member">Nama:</label><br>
            <input type="text" id="member" name="member"><br><br>

            <label for="jenis">Jenis Motor:</label><br>
            <select id="jenis" name="jenis">
                <option value="Scooter">Scooter</option>
                <option value="Sport">Sport</option>
                <option value="SportTouring">Sport Touring</option>
                <option value="Cross">Cross</option>
            </select><br><br>

            <label for="waktu">Lama Rental (hari):</label><br>
            <input type="number" id="waktu" name="waktu"><br><br>

            <input type="submit" value="Hitung">
        </form>
    </center>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'back-end.php'; 
        $member = $_POST['member'];
        $jenis = $_POST['jenis'];
        $waktu = $_POST['waktu'];

        $rental = new Rental();
        $rental->member = $member;
        $rental->jenis = $jenis;
        $rental->waktu = $waktu;

        // Set harga jenis motor
        $rental->setHarga(100000, 150000, 200000, 180000);
        echo "<br>";
        $rental->pembayaran();
    }
    ?>
</body>
</html>