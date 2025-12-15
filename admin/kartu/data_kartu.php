<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data KK
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-kartu" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NO KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>Anggota KK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("select * from tb_kk");
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo strtoupper($data['no_kk']); ?></td>
                        <td><?php echo strtoupper($data['kepala']); ?></td>
                        <td>
    <?php 
    // Cek apakah kelurahan ada
    if (!empty($data['kelurahan'])) {
        // Jika kelurahan ada, tampilkan kelurahan
        echo strtoupper($data['kelurahan']);
    } else {
        // Jika kelurahan tidak ada, tampilkan desa
        echo strtoupper($data['desa']);
    }
    ?> RT 
    <?php echo strtoupper($data['rt']); ?>/ RW 
    <?php echo strtoupper($data['rw']); ?>.
</td>
                        <td>
                            <a href="?page=anggota&kode=<?php echo $data['id_kk']; ?>" title="Anggota KK"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-users"></i>
                            </a>
                        </td>
                        <td>
                            <a href="?page=edit-kartu&kode=<?php echo $data['id_kk']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('<?php echo $data['id_kk']; ?>')" title="Hapus" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i>
</a>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus data ini,Data yang dihapus tidak bisa dikembalikan😡😡",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "?page=del-kartu&kode=" + id;
        }
    });
}
</script>

                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <!-- Footer content if needed -->
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
