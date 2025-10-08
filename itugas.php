<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Negara & Ibukota Asia</title>
  <style>
    body { font-family: Arial, sans-serif; background:#eef3f7; margin:40px; color:#333; }
    h2 { color:#0a4ea8; }
    .card { background:#fff; padding:20px; border-radius:12px; max-width:700px;
            box-shadow:0 8px 24px rgba(0,0,0,.08); }
    ol { margin-top: 12px; line-height: 1.8; }
  </style>
</head>
<body>
  <h2>Daftar Negara & Ibukota di Asia</h2>
  <div class="card">
    <?php
      // Array berdasarkan soal (dengan perbaikan ejaan minor untuk tampilan)
      $negaraAsia = [
        "Indonesia"     => "Jakarta",
        "India"         => "New Delhi",
        "Jepang"        => "Tokyo",
        "Cina"          => "Beijing",
        "Malaysia"      => "Kuala Lumpur",
        "Filipina"      => "Manila",
        "KoreaUtara"    => "Pyongyang",
        "KoreaSelatan"  => "Seoul",
        "Iran"          => "Teheran",
        "Irak"          => "Baghdad", // perbaikan ejaan dari "Bahgdad"
        "Vietnam"       => "Hanoi",
        "Thailand"      => "Bangkok"  // pastikan tidak terpecah "T hailand"
      ];

      // Fungsi kecil untuk merapikan "KoreaUtara" -> "Korea Utara"
      $rapikanNama = function(string $nama): string {
        $nama = preg_replace('/([a-z])([A-Z])/', '$1 $2', $nama);
        return trim($nama);
      };

      echo "<ol>";
      foreach ($negaraAsia as $negara => $ibukota) {
        $negaraTampil = $rapikanNama($negara);
        echo "<li>" . htmlspecialchars($negaraTampil) . " ibukotanya " . htmlspecialchars($ibukota) . "</li>";
      }
      echo "</ol>";
    ?>
  </div>
</body>
</html>
