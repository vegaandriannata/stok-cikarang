<?php
// Koneksi ke database (gantilah dengan informasi koneksi yang sesuai)
include 'koneksi.php';

// Inisialisasi variabel dengan nilai default
$tanggal = $shift = $nama = $tdp = $tbg = $hdp = $hbg = $cdp = $cbg = '';

// Inisialisasi pesan untuk informasi hasil penyimpanan
$pesan = '';

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir jika tersedia
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
	$shift = isset($_POST['shift']) ? $_POST['shift'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $tdp = isset($_POST['tdp']) ? $_POST['tdp'] : '';
    $tbg = isset($_POST['tbg']) ? $_POST['tbg'] : '';
	$hdp = isset($_POST['hdp']) ? $_POST['hdp'] : '';
    $hbg = isset($_POST['hbg']) ? $_POST['hbg'] : '';
	$cdp = isset($_POST['cdp']) ? $_POST['cdp'] : '';
    $cbg = isset($_POST['cbg']) ? $_POST['cbg'] : '';
    

    // Query untuk menyimpan data ke dalam tabel ht_xpander
    $sql = "INSERT INTO ht_xpander (tanggal, shift, nama, tdp, tbg, hdp, hbg, cdp, cbg)
            VALUES ('$tanggal', '$shift', '$nama', '$tdp', '$tbg', '$hdp', '$hbg', '$cdp', '$cbg')";

    if ($koneksi->query($sql) === TRUE) {
        $pesan = "Data berhasil disimpan.";
        // Arahkan ke halaman stok_ht_xpander.php setelah berhasil disimpan
        header("Location: stok_ht_xpander.php");
        exit(); // Penting untuk menghentikan eksekusi script setelah header diarahkan
    } else {
        $pesan = "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Stok HT Xpander</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Form Input Stok HT Xpander</h1>

    <?php echo $pesan; // Tampilkan pesan informasi ?>

    <form action="" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

        <label for="shift">Shift:</label>
    <select id="shift" name="shift" required>
        <option value="Pagi" <?php if ($shift == "Pagi") echo "selected"; ?>>Pagi</option>
        <option value="Malam" <?php if ($shift == "Malam") echo "selected"; ?>>Malam</option>
    </select>

        <label for="nama">nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

        <label for="tdp">Terima Depan:</label>
        <input type="number" id="tdp" name="tdp" value="<?php echo $tdp; ?>" required>
		
        <label for="tbg">Terima Bagasi:</label>
        <input type="number" id="tbg" name="tbg" value="<?php echo $tbg; ?>" required>

        <label for="hdp">Hasil Depan:</label>
        <input type="number" id="hdp" name="hdp" value="<?php echo $hdp; ?>" required>
		
        <label for="hbg">Hasil Bagasi:</label>
        <input type="number" id="hbg" name="hbg" value="<?php echo $hbg; ?>" required>

        <label for="cdp">Claim Depan:</label>
        <input type="number" id="cdp" name="cdp" value="<?php echo $cdp; ?>" required>
		
        <label for="cbg">Claim Bagasi:</label>
        <input type="number" id="cbg" name="cbg" value="<?php echo $cbg; ?>" required>

        

        <input type="submit" value="Simpan">
    </form>

</body>
</html>
