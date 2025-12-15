<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil parameter kode dari URL
$kode = isset($_GET['kode']) ? $_GET['kode'] : '';
if (empty($kode)) {
    die("Data desa tidak ditemukan.");
}

// Query untuk mendapatkan detail desa
$sql_desa = $koneksi->query("SELECT * FROM tb_pdd WHERE desa = '$kode' LIMIT 1");
if (!$sql_desa) {
    die("Query gagal: " . $koneksi->error);
}

$data_desa = $sql_desa->fetch_assoc();
if (!$data_desa) {
    die("Data desa tidak ditemukan.");
}

// Query untuk menghitung jumlah penduduk di desa tersebut
$sql_jumlah_penduduk = $koneksi->query("SELECT COUNT(*) AS jumlah_penduduk FROM tb_pdd WHERE desa = '$kode'");
$data_jumlah = $sql_jumlah_penduduk->fetch_assoc();
$jumlah_penduduk = $data_jumlah['jumlah_penduduk'];
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-building"></i> Detail Desa: <?php echo htmlspecialchars($data_desa['desa']); ?>
        </h3>
    </div>
    <div class="card-body">
        <p><strong>Nama Desa:</strong> <?php echo htmlspecialchars($data_desa['desa']); ?></p>
        <p><strong>Kecamatan:</strong> <?php echo htmlspecialchars($data_desa['kecamatan']); ?></p>
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