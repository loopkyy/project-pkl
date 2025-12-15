<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil parameter kode dari URL
$kode = isset($_GET['kode']) ? $_GET['kode'] : '';
if (empty($kode)) {
    die("Data kelurahan tidak ditemukan.");
}

// Query untuk mendapatkan detail kelurahan
$sql_kelurahan = $koneksi->query("SELECT * FROM tb_pdd WHERE kelurahan = '$kode' LIMIT 1");
if (!$sql_kelurahan) {
    die("Query gagal: " . $koneksi->error);
}

$data_kelurahan = $sql_kelurahan->fetch_assoc();
if (!$data_kelurahan) {
    die("Data kelurahan tidak ditemukan.");
}

// Query untuk menghitung jumlah penduduk di kelurahan tersebut
$sql_jumlah_penduduk = $koneksi->query("SELECT COUNT(*) AS jumlah_penduduk FROM tb_pdd WHERE kelurahan = '$kode'");
$data_jumlah = $sql_jumlah_penduduk->fetch_assoc();
$jumlah_penduduk = $data_jumlah['jumlah_penduduk'];
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-building"></i> Detail Kelurahan: <?php echo htmlspecialchars($data_kelurahan['kelurahan']); ?>
        </h3>
    </div>
    <div class="card-body">
        <p><strong>Nama Kelurahan:</strong> <?php echo htmlspecialchars($data_kelurahan['kelurahan']); ?></p>
        <p><strong>Kecamatan:</strong> <?php echo htmlspecialchars($data_kelurahan['kecamatan']); ?></p>
        <p><strong>Jumlah Penduduk:</strong> <?php echo htmlspecialchars($jumlah_penduduk); ?></p>
    </div>
    <div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>