<?php
include "../inc/koneksi.php";

if (isset($_POST['Cetak'])) {
    $id = $_POST['lahir'];
}

// Set tanggal
$tanggal = date("m/y");
$tgl = date("d/m/y");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cetak Surat</title>
</head>
<body>
    <div style="border: 2px solid black; padding: 20px; margin: 20px;">
    <center>
        <h2>PEMERINTAH KABUPATEN Kuningan</h2>

        <?php
        // Ambil data dari tb_lahir berdasarkan ID
        $sql_tampil = "SELECT * FROM tb_lahir WHERE id_lahir='$id'";
        $query_tampil = mysqli_query($koneksi, $sql_tampil);
        $data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH);

        // Periksa apakah data dari tb_lahir ditemukan
        if ($data) {
            $nama = $data['nama'];
            
            // Ambil kecamatan, desa, dan kelurahan dari tb_pdd berdasarkan nama
            $sql_pdd = "SELECT kecamatan, desa, kelurahan FROM tb_pdd WHERE nama='$nama'";
            $query_pdd = mysqli_query($koneksi, $sql_pdd);
            $data_pdd = mysqli_fetch_array($query_pdd, MYSQLI_BOTH);

            // Jika data dari tb_pdd ditemukan, tampilkan kecamatan dan desa/kelurahan
            if ($data_pdd) {
                $tempat = !empty($data_pdd['kelurahan']) ? $data_pdd['kelurahan'] : $data_pdd['desa'];
                $labelTempat = !empty($data_pdd['kelurahan']) ? "KELURAHAN" : "DESA"; // Tentukan label yang akan ditampilkan
                echo "<h3>KECAMATAN " . $data_pdd['kecamatan'] . "<br>" . $labelTempat . " " . strtoupper($tempat) . "</h3>";
            } else {
                echo "<h3>KECAMATAN [Data tidak ditemukan]<br>DESA/KELURAHAN [Data tidak ditemukan]</h3>";
            }
        } else {
            echo "<p>Data tidak ditemukan untuk ID kelahiran yang diminta.</p>";
        }
        ?>

        <p>________________________________________________________________________</p>
    </center>

    <?php if ($data && $data_pdd): ?>
        <center>
            <h4><u>SURAT KETERANGAN KELAHIRAN</u></h4>
            <h4>No Surat: <?php echo $data['id_lahir']; ?>/Ket.Kelahiran/<?php echo $tanggal; ?></h4>
        </center>

        <p>Yang bertandatangan di bawah ini Kepala <?php echo $labelTempat; ?> <?php echo strtoupper($tempat); ?>, Kecamatan <?php echo $data_pdd['kecamatan']; ?>, Kabupaten KUNINGAN, dengan ini menerangkan bahwa:</p>
        <table>
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo $data['jekel']; ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?php echo $data['agama']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo date("d-m-Y", strtotime($data['tgl_lh'])); ?></td>
                </tr>
            </tbody>
        </table>
        
        <p>Telah benar-benar lahir di <?php echo $labelTempat; ?> <?php echo strtoupper($tempat); ?>, Kecamatan <?php echo $data_pdd['kecamatan']; ?>, Kabupaten KUNINGAN</p>
        <p>Demikian surat ini dibuat, agar dapat digunakan sebagaimana mestinya.</p>
        
        <br><br><br><br><br>
        
        <p style="text-align: right; line-height: 1.5; margin-left: 20px;">
    Kuningan, <?php echo date("d/m/Y"); ?><br>
    KEPALA <?php echo $labelTempat; ?> <?php echo strtoupper($tempat); ?><br><br><br><br><br>
    (....................................................)
</p>
    <?php endif; ?>

    <script>
        window.print();
    </script>
</body>
</html>