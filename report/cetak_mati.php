<?php
include "../inc/koneksi.php";

if (isset($_POST['Cetak'])) {
    $id = $_POST['mendu'];
}

// Set tanggal
$tanggal = date("m/y");
$tgl = date("d/m/y");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cetak Surat Keterangan Kematian</title>
</head>
<body>
    <div style="border: 2px solid black; padding: 20px; margin: 20px;">
    <center>
        <h2>PEMERINTAH KABUPATEN Kuningan</h2>

        <?php
        // Ambil data dari tb_mendu berdasarkan ID
        $sql_tampil = "SELECT * FROM tb_mendu WHERE id_mendu='$id'";
        $query_tampil = mysqli_query($koneksi, $sql_tampil);
        $data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH);

        // Periksa apakah data dari tb_mendu ditemukan
        if ($data) {
            $id_pdd = $data['id_pdd']; // Mengambil id_pdd dari tb_mendu
            
            // Ambil kecamatan, desa, dan kelurahan dari tb_pdd berdasarkan id_pend
            $sql_pdd = "SELECT kecamatan, desa, kelurahan, nama FROM tb_pdd WHERE id_pend='$id_pdd'";
            $query_pdd = mysqli_query($koneksi, $sql_pdd);
            $data_pdd = mysqli_fetch_array($query_pdd, MYSQLI_BOTH);

            // Jika data dari tb_pdd ditemukan, tampilkan kecamatan dan desa/kelurahan
            if ($data_pdd) {
                $tempat = !empty($data['tempat_mendu']) ? $data['tempat_mendu'] : $data_pdd['desa'];
                $labelTempat = !empty($data['tempat_mendu']) ? "TEMPAT" : "DESA"; // Tentukan label yang akan ditampilkan
                echo "<h3>KECAMATAN " . $data_pdd['kecamatan'] . "</h3>";
                echo "<h3>DESA " . strtoupper($data_pdd['desa']) . "</h3>";
                if (!empty($data_pdd['kelurahan'])) {
                    echo "<h3>KELURAHAN " . strtoupper($data_pdd['kelurahan']) . "</h3>";
                }
            } else {
                echo "<h3>KECAMATAN [Data tidak ditemukan]<br>DESA/KELURAHAN [Data tidak ditemukan]</h3>";
            }
        } else {
            echo "<p>Data tidak ditemukan untuk ID kematian yang diminta.</p>";
        }
        ?>

        <p>________________________________________________________________________</p>
    </center>

    <?php if ($data && $data_pdd): ?>
        <center>
            <h4><u>SURAT KETERANGAN KEMATIAN</u></h4>
            <h4>No Surat: <?php echo $data['id_mendu']; ?>/Ket.Kematian/<?php echo $tanggal; ?></h4>
        </center>

        <p>Yang bertandatangan di bawah ini Kepala <?php echo !empty($data_pdd['kelurahan']) ? "KELURAHAN" : "DESA"; ?> <?php echo strtoupper(!empty($data_pdd['kelurahan']) ? $data_pdd['kelurahan'] : $data_pdd['desa']); ?>, dengan ini menerangkan bahwa:</p>
        <table>
            <tbody>
                <tr>
                    <td>Nama Penduduk</td>
                    <td>:</td>
                    <td><?php echo $data_pdd['nama']; ?></td> <!-- Menampilkan nama dari tb_pdd -->
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo $data['jk']; ?></td> <!-- Mengambil jenis kelamin dari tb_mendu -->
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?php echo $data['agama']; ?></td> <!-- Mengambil agama dari tb_mendu -->
                </tr>
                <tr>
                    <td>Tanggal Meninggal</td>
                    <td>:</td>
                    <td><?php echo date("d-m-Y", strtotime($data['tgl_mendu'])); ?></td>
                </tr>
                <tr>
                    <td>Tempat Meninggal</td>
                    <td>:</td>
                    <td><?php echo $data['tempat_mendu']; ?></td> <!-- Mengambil tempat meninggal dari tb_mendu -->
                </tr>
                <tr>
                    <td>Sebab</td>
                    <td>:</td>
                    <td><?php echo $data['sebab']; ?></td> <!-- Mengambil sebab dari tb_mendu -->
                </tr>
            </tbody>
        </table>

        <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

        <div style="text-align: right;">
            <p>Kuningan, <?php echo $tgl; ?></p>
            <p>Kepala <?php echo !empty($data_pdd['kelurahan']) ? "KELURAHAN" : "DESA"; ?> <?php echo strtoupper(!empty($data_pdd['kelurahan']) ? $data_pdd['kelurahan'] : $data_pdd['desa']); ?></p>
            <br><br>
            <p>(____________________)</p>
        </div>
    <?php endif; ?>
    </div>
</body>
</html>