<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil parameter kecamatan dari URL
$kecamatan = isset($_GET['kecamatan']) ? $_GET['kecamatan'] : '';
if (empty($kecamatan)) {
    die("Kecamatan tidak ditemukan.");
}

// Query untuk mendapatkan data kelurahan berdasarkan kecamatan dari tb_pdd
$sql_kelurahan = $koneksi->query("SELECT DISTINCT kelurahan FROM tb_pdd WHERE kecamatan = '$kecamatan'");
if (!$sql_kelurahan) {
    die("Query gagal: " . $koneksi->error);
}

// Hitung jumlah kelurahan
$jumlah_kelurahan = $sql_kelurahan->num_rows;
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-building"></i> Data Kelurahan di Kecamatan: <?php echo htmlspecialchars($kecamatan); ?>
        </h3>
        <div class="card-tools">
            <span class="badge badge-info"><?php echo $jumlah_kelurahan; ?> Kelurahan Ditemukan</span>
        </div>
    </div>
    <div class="card-body">
        <?php if ($jumlah_kelurahan > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Kelurahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = $sql_kelurahan->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($data['kelurahan']); ?></td>
        <td>
            <a href="?page=view-kelurahan&kode=<?php echo $data['kelurahan']; ?>" class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Detail
            </a>
            <a href="?page=dowload-kelurahan&kode=<?php echo urlencode($data['kelurahan']); ?>" class="btn btn-warning btn-sm">
    <i class="fa fa-download"></i> Download
</a>
        </td>
    </tr>
<?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data kelurahan yang ditemukan untuk kecamatan ini.</p>
        <?php endif; ?>
    </div>
</div>
<div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>

<?php
// Tutup koneksi
mysqli_close($koneksi);
?>