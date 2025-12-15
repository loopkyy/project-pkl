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

// Query untuk mendapatkan data desa berdasarkan kecamatan dari tb_pdd
$sql_desa = $koneksi->query("SELECT DISTINCT desa FROM tb_pdd WHERE kecamatan = '$kecamatan'");
if (!$sql_desa) {
    die("Query gagal: " . $koneksi->error);
}

// Hitung jumlah desa
$jumlah_desa = $sql_desa->num_rows;
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-building"></i> Data desa di Kecamatan: <?php echo htmlspecialchars($kecamatan); ?>
        </h3>
        <div class="card-tools">
            <span class="badge badge-info"><?php echo $jumlah_desa; ?> desa Ditemukan</span>
        </div>
    </div>
    <div class="card-body">
        <?php if ($jumlah_desa > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama desa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($data = $sql_desa->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($data['desa']); ?></td>
        <td>
            <a href="?page=view-desa&kode=<?php echo $data['desa']; ?>" class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Detail
            </a>
            <a href="?page=dowload-desa&kode=<?php echo urlencode($data['desa']); ?>" class="btn btn-warning btn-sm">
    <i class="fa fa-download"></i> Download
</a>
        </td>
    </tr>
<?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data desa yang ditemukan untuk kecamatan ini.</p>
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