<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil id_kk dari parameter URL
$id_kk = isset($_GET['id_kk']) ? $_GET['id_kk'] : '';

// Cek apakah id_kk valid
if (empty($id_kk)) {
    echo "ID KK tidak ditemukan.";
    exit;
}

// Sanitasi id_kk untuk mencegah SQL Injection
$id_kk = mysqli_real_escape_string($koneksi, $id_kk);

// Ambil data anggota keluarga berdasarkan id_kk
$sql_anggota = $koneksi->query("
    SELECT a.id_pend, k.no_kk, a.hubungan, p.nama, p.desa, p.kelurahan, p.kecamatan 
    FROM tb_anggota a
    JOIN tb_pdd p ON a.id_pend = p.id_pend
    JOIN tb_kk k ON a.id_kk = k.id_kk
    WHERE a.id_kk = '$id_kk'
");

// Cek apakah query berhasil
if (!$sql_anggota) {
    die("Query Error: " . $koneksi->error);
}

// Cek jumlah baris yang diambil
if ($sql_anggota->num_rows == 0) {
    echo "Tidak ada data anggota keluarga yang ditemukan untuk ID KK: " . htmlspecialchars($id_kk);
    exit;
}
?>

<div class="card card-success mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-users"></i> Anggota Keluarga untuk No KK: <?php echo htmlspecialchars($id_kk); ?>
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No KK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kecamatan</th>
                    <th>Hubungan</th>
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
                                // Jika kelurahan ada, tampilkan kelurahan dan desa
                                echo htmlspecialchars($data['kelurahan']) . " " . htmlspecialchars($data['desa']);
                            } else {
                                // Jika kelurahan tidak ada, tampilkan desa
                                echo htmlspecialchars($data['desa']);
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($data['kecamatan']); ?></td>
                        <td><?php echo htmlspecialchars($data['hubungan']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>

<?php
// Menutup koneksi
$koneksi->close();
?>