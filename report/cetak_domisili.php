<?php
include "../inc/koneksi.php";

// Mengecek jika tombol 'Cetak' ditekan
if (isset($_POST['btnCetak'])) {
    $id = $_POST['id_pend'];
}

$tanggal = date("m/y"); // Format bulan dan tahun
$tgl = date("d/m/y"); // Format hari, bulan, dan tahun
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CETAK SURAT</title>
    <style>
        /* Gaya untuk tampilan header surat */
        .header {
            display: flex; /* Menggunakan flexbox untuk tata letak */
            align-items: center; /* Menyelaraskan item secara vertikal */
            margin-bottom: 20px;
        }
        .header img {
            width: 100px; /* Ukuran logo */
            height: auto; /* Mempertahankan rasio aspek */
            margin-right: 20px; /* Jarak antara logo dan teks */
        }

        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .content {
            text-align: center;
            max-width: 800px; /* Maksimal lebar konten */
            margin: auto; /* Memusatkan konten */
            border: 2px solid #000; /* Border untuk surat */
            padding: 20px; /* Memberikan padding di dalam border */
        }
        .line {
            border-top: 2px solid #000; /* Garis horizontal */
            margin: 10px 0;
        }
        .info {
            text-align: left;
            margin: 20px 0;
        }
        .info p {
            margin: 5px 0; /* Jarak antar paragraf */
        }
        .signature {
            text-align: right;
            margin-top: 50px; /* Spasi di atas tanda tangan */
        }
    </style>
</head>

<body>
    <div class="content">
        <?php
        // Menampilkan data penduduk berdasarkan ID yang dipilih
        $sql_tampil = "SELECT * FROM tb_pdd WHERE id_pend ='$id'";
        $query_tampil = mysqli_query($koneksi, $sql_tampil);
        
        if ($data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH)) {
            $desa = strtoupper($data['desa']);
            $kecamatan = strtoupper($data['kecamatan']);
            $kelurahan = strtoupper($data['kelurahan']); // Ambil kelurahan
            
            // Tentukan apakah akan menampilkan desa atau kelurahan
            $tempat = !empty($kelurahan) ? $kelurahan : $desa; // Gunakan kelurahan jika ada, jika tidak gunakan desa
            $labelTempat = !empty($kelurahan) ? "KELURAHAN" : "DESA"; // Tentukan label yang akan ditampilkan
        ?>
        
        <!-- Bagian Header Surat dengan Logo dan Judul -->
        <div class="header">
            <img src="/project_pkl/dist/img/kuningan.png" alt="Logo Pemerintah Kabupaten Kuningan">
            <div>
                <h2>PEMERINTAH KABUPATEN KUNINGAN</h2>
                <h3>KECAMATAN <?php echo $kecamatan; ?><br><?php echo $labelTempat; ?> <?php echo $tempat; ?></h3> <!-- Tampilkan desa atau kelurahan -->
            </div>
        </div>

        <div class="line"></div>

        <!-- Judul dan Nomor Surat -->
        <h4><u>SURAT KETERANGAN DOMISILI</u></h4>
        <h4>No Surat : <?php echo $data['id_pend']; ?>/Ket.Domisili/<?php echo $tanggal; ?></h4>
        <p>Yang bertandatangan di bawah ini Kepala <?php echo $labelTempat; ?> <?php echo $tempat; ?>, Kecamatan <?php echo $kecamatan; ?>, Kabupaten KUNINGAN, dengan ini menerangkan bahwa:</p>

        <!-- Informasi Penduduk -->
        <div class="info">
            <p><strong>NIK</strong>: <?php echo $data['nik']; ?></p>
            <p><strong>Nama</strong>: <?php echo strtoupper($data['nama']); ?></p>
            <p><strong>Jenis Kelamin</ ```php
            <strong>: <?php echo $data['jekel']; ?></p>
            <p><strong>Agama</strong>: <?php echo $data['agama']; ?></p>
            <p><strong>Status Pernikahan</strong>: <?php echo $data['kawin']; ?></p>
            <p><strong>TTL</strong>: <?php echo $data['tempat_lh']; ?>, <?php echo date("d-m-Y", strtotime($data['tgl_lh'])); ?></p>
            <p><strong>RT/RW</strong>: <?php echo $data['rt']; ?>/<?php echo $data['rw']; ?></p>
        </div>

        <p>Adalah benar-benar warga <?php echo !empty($kelurahan) ? "KELURAHAN " . $kelurahan : "DESA " . $desa; ?>, Kecamatan <?php echo $kecamatan; ?>, Kabupaten KUNINGAN.</p>
        <p>Demikian Surat ini dibuat, agar dapat digunakan sebagaimana mestinya.</p>

        <div class="signature" style="text-align: right;">
    <p>Kuningan, <?php echo date("d/m/Y"); ?></p> <!-- Menambahkan tanggal di sini -->
    <p>Kepala <?php echo $labelTempat; ?> <?php echo $tempat; ?></p>
    <p>____________________</p>
    <p>NIP. _____________</p>
</div>
    </div>
</body>
</html>
<?php
        } else {
            echo "<p>Data tidak ditemukan.</p>";
        }
    
?>
