<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data kepala keluarga dari tabel tb_anggota
$sql_anggota = $koneksi->query("
    SELECT a.id_kk, a.hubungan, p.nama, k.no_kk, p.desa, p.kelurahan, p.kecamatan 
    FROM tb_anggota a
    JOIN tb_pdd p ON a.id_pend = p.id_pend
    JOIN tb_kk k ON a.id_kk = k.id_kk
    WHERE a.hubungan = 'Kepala Keluarga'  -- Filter untuk hanya kepala keluarga
");

?>

<div class="card card-success mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-download"></i> Data Kepala Keluarga
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No KK</th>
                    <th>Nama</th>
                    <th>Alamat</th> <!-- Mengganti Desa dan Kelurahan dengan Alamat -->
                    <th>Kecamatan</th>
                    <th>Hubungan</th>
                    <th>Aksi</th> <!-- Kolom untuk Aksi -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $sql_anggota->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['no_kk']); ?></td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                        <td>
                            <?php 
                            // Cek apakah kelurahan ada
                            if (!empty($data['kelurahan'])) {
                                // Jika kelurahan ada, tampilkan kelurahan
                                echo strtoupper($data['kelurahan']) . " ";
                            } else {
                                // Jika kelurahan tidak ada, tampilkan desa
                                echo strtoupper($data['desa']) . " ";
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($data['kecamatan']); ?></td>
                        <td><?php echo htmlspecialchars($data['hubungan']); ?></td>
                        <td>
                            <!-- Ganti tautan untuk melihat detail dengan format yang benar menggunakan no_kk -->
                            <a href="?page=view-kk&id_kk=<?php echo urlencode($data['id_kk']); ?>" class="btn btn-info btn-sm" title="Lihat Detail">
    <i class="fa fa-eye"></i> Detail
</a>
<a href="?page=download-kk&id_kk=<?php echo urlencode($data['id_kk']); ?>" class="btn btn-primary btn-sm" title="Download KK">
    <i class="fa fa-download"></i> Download
</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Menutup koneksi
$koneksi->close();
?>