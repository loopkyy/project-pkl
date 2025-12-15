<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * from tb_pdd where id_pend ='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-user"></i> Detail Penduduk
        </h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table">
            <tbody>
                <tr>
                    <td style="width: 150px">
                        <b>NIK</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['nik']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>Nama</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['nama']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>TTL</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['tempat_lh']); ?>
                        /
                        <?php echo strtoupper($data_cek['tgl_lh']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>Jenis Kelamin</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['jekel']); ?>
                    </td>
                </tr>
                <tr>
                <td style="width: 150px">
    <b>Alamat</b>
</td>
<td>:
    <?php 
    // Cek apakah kelurahan ada
    if (!empty($data_cek['kelurahan'])) {
        // Jika kelurahan ada, tampilkan kelurahan
        echo strtoupper($data_cek['kelurahan']) . ", ";
    } else {
        // Jika kelurahan tidak ada, tampilkan desa
        echo strtoupper($data_cek['desa']) . ", ";
    }
    // Tampilkan kecamatan, RT, dan RW
    echo strtoupper($data_cek['kecamatan']) . ", RT " . strtoupper($data_cek['rt']) . "/ RW " . strtoupper($data_cek['rw']);
    ?>
</td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>Agama</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['agama']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>Status Kawin</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['kawin']); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px">
                        <b>Pekerjaan</b>
                    </td>
                    <td>:
                        <?php echo strtoupper($data_cek['pekerjaan']); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <a href="?page=data-pend" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
