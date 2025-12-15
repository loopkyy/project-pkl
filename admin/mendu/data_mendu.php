<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Kematian</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-mendu" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Tempat Meninggal</th>
                        <th>Tanggal</th>
                        <th>Sebab</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php
$no = 1;
$sql = $koneksi->query("SELECT p.id_pend, p.nik, p.nama, m.jk AS jenis_kelamin, m.agama, m.tgl_mendu, m.sebab, m.tempat_mendu, m.id_mendu 
                        FROM tb_mendu m 
                        INNER JOIN tb_pdd p ON p.id_pend = m.id_pdd");

while ($data = $sql->fetch_assoc()) {
?>

<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data['nik']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['jenis_kelamin']; ?></td> <!-- Jenis Kelamin dari tb_mendu -->
    <td><?php echo $data['agama']; ?></td> <!-- Agama dari tb_mendu -->
    <td><?php echo $data['tempat_mendu']; ?></td>
    <td><?php echo $data['tgl_mendu']; ?></td>
    <td><?php echo $data['sebab']; ?></td>
    <td>
        <a href="?page=edit-mendu&kode=<?php echo $data['id_mendu']; ?>" title="Ubah" class="btn btn-success btn-sm">
            <i class="fa fa-edit"></i>
        </a>
        <a href="?page=del-mendu&kode=<?php echo $data['id_pend']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
           title="Hapus" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
<?php
}
?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
