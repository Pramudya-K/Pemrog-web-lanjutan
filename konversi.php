<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konversi Mata Uang Asing ke Rupiah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f6fa;
            padding: 40px;
        }
        h2 {
            color: #004aad;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        button {
            background-color: #004aad;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #0062cc;
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #004aad;
            color: white;
        }
    </style>
</head>
<body>
    <h2>💰 Konversi Mata Uang Asing ke Rupiah</h2>
    <div class="card">
    <form method="POST">
        <label for="jumlah">Jumlah Uang :</label>
        <input type="number" step="0.01" name="jumlah" required placeholder="Masukkan jumlah">

        <label for="mata_uang">Pilih Mata Uang:</label>
        <select name="mata_uang" required>
            <option value="">-- Pilih Mata Uang --</option>
            <option value="usd">USD (Dollar Amerika)</option>
            <option value="jpy">JPY (Yen Jepang)</option>
            <option value="cny">CNY (Yuan China)</option>
            <option value="krw">KRW (Won Korea)</option>
            <option value="myr">MYR (Ringgit Malaysia)</option>
            <option value="sgd">SGD (Dollar Singapura)</option>
            <option value="gbp">GBP (Pound Inggris)</option>
            <option value="eur">EUR (Euro)</option>
        </select>

        <button type="submit" name="konversi">Konversi ke Rupiah</button>
    </form>

    <?php
    include "dbkonversi.php";

    // Array kurs (nilai tukar terhadap 1 satuan mata uang)
    $rate = [
        'usd' => 14367,
        'jpy' => 1192,
        'cny' => 2262,
        'krw' => 11.87,
        'myr' => 3416,
        'sgd' => 10621,
        'gbp' => 19074,
        'eur' => 15891
    ];

    if (isset($_POST['konversi'])) {
        $jumlah = $_POST['jumlah'];
        $mata_uang = strtolower($_POST['mata_uang']);

        if (array_key_exists($mata_uang, $rate)) {
            $hasil = $jumlah * $rate[$mata_uang];
            echo "<p><b>{$jumlah} {$mata_uang}</b> dikonversi menjadi <b>Rp " . number_format($hasil, 0, ',', '.') . "</b></p>";

            // Simpan ke database
            $sql = "INSERT INTO konversi (mata_uang, jumlah, hasil_rupiah)
                    VALUES ('$mata_uang', '$jumlah', '$hasil')";
            mysqli_query($conn, $sql);
        } else {
            echo "<p style='color:red;'>Mata uang tidak valid.</p>";
        }
    }

    // Tampilkan riwayat konversi
    $query = mysqli_query($conn, "SELECT * FROM konversi ORDER BY id DESC LIMIT 10");
    if (mysqli_num_rows($query) > 0) {
        echo "<h3>Riwayat Konversi Terakhir</h3>";
        echo "<table>";
        echo "<tr><th>No</th><th>Mata Uang</th><th>Jumlah</th><th>Hasil (Rp)</th><th>Tanggal</th></tr>";
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['mata_uang']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>Rp " . number_format($row['hasil_rupiah'], 0, ',', '.') . "</td>
                    <td>{$row['tanggal']}</td>
                  </tr>";
            $no++;
        }
        echo "</table>";
    }

    mysqli_close($conn);
    ?>
    </div>
</body>
</html>
