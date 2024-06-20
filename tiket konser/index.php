<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #CCFFFF;
        }
        #container {
            width: 80%;
            margin: 0 auto;
        }
        form {
            margin-bottom: 20px;
        }
        
        @media screen and (max-width: 600px) {
            hr {
                width: 50%;
            }
        }
        label {
            display: block;
            margin-bottom: 10px;
        }

        input[for="jenis"], input[type="number"] {
            /* width: 100%; */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        option {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        button[type="submit"] {
            background-color: yellow;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        button[type="submit"]:hover {
            background-color: #00FFFF;
            transition:1s;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        </style>
</head>
<body>
    <div id="container">
        <h2>Form Pembelian Tiket</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="jenis">Jenis Tiket : </label>
        <select id="jenis" name="jenis">
            <option value="Silver">Silver</option>
            <option value="Platinum">Platinum</option>
            <option value="Premium">Premium</option>
            <option value="VIP">VIP</option>
</select>
<br></br>
        <label for="jumlah">Jumlah Tiket : </label>
        <input type="number" id="jumlah" name="jumlah" min="0" step="1" placeholder= "Masukkan Jumlahnya"required>
<br></br>
        <button type="submit">Beli</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    class Shell {
        protected $jenis;
        protected $harga;
        protected $jumlah;
        protected $ppn;
        public function __construct($jenis, $harga, $jumlah) {
            $this->jenis = $jenis;
            $this->harga = $harga;
            $this->jumlah = $jumlah;
            $this->ppn = 10; // Buat PPN Menjadi 10%
        }
        public function getJenis() {
            return $this->jenis;
        }
        public function getHarga() {
            return $this->harga;
        }
        public function getJumlah() {
            return $this->jumlah;
        }
        public function getPPN() {
            return $this->ppn;
        }
    }
    class Beli extends Shell {
        public function hitungTotal() {
            $total = $this->harga * $this->jumlah;
            $total += $total * $this->ppn / 100;
            return $total;
        }
        public function buktiTransaksi() {
            $total = $this->hitungTotal();
            echo "<div style='text-align: center;'>";
            echo "---------------------------------";
            echo "<h3>Bukti Transaksi : </h3>";
            echo "<p><strong>Anda Membeli tiket dengan class : </strong> " . $this->jenis . "</p>";
            echo "<p><strong>sebanyak : </strong> " . $this->jumlah . " Tiket</p>";
            echo "<p><strong>Total Yang Harus Anda Bayar : </strong> Rp " . number_format($total,2,',','.') . "</p>";
            echo "---------------------------------";
            echo "</div>";
        }
    }
    $hargaBahanBakar = [
        "Silver" => 70000.00,
        "Platinum" => 1300000.00,
        "Premium" => 200000.00,
        "VIP" => 2700000.00,
    ];
    $jenis = $_POST["jenis"];
    $jumlah = $_POST["jumlah"];
    if(array_key_exists($jenis, $hargaBahanBakar)) {
        $harga = $hargaBahanBakar[$jenis];
        $beli = new Beli($jenis, $harga, $jumlah);
        $beli->buktiTransaksi();
    } else {
        echo "<p style='text-align: center;'>Jenis Bahan Bakar Tidak Valid.</p>";
    }
}
?>
</html>