<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Penduduk
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-pend" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>No KK</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $no = 1;
    // Ambil semua data penduduk
    $sql = $koneksi->query("SELECT p.id_pend, p.nik, p.nama, p.jekel, p.desa, p.kelurahan, p.rt, p.rw, p.status, a.id_kk, k.no_kk, k.kepala 
        FROM tb_pdd p 
        LEFT JOIN tb_anggota a ON p.id_pend = a.id_pend 
        LEFT JOIN tb_kk k ON a.id_kk = k.id_kk");

    // Cek apakah query berhasil
    if ($sql) {
        while ($data = $sql->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo strtoupper($data['nik']); ?></td>
                <td><?php echo strtoupper($data['nama']); ?></td>
                <td><?php echo strtoupper($data['jekel']); ?></td>
                <td>
                    <?php 
                    // Tampilkan alamat dengan kelurahan atau desa
                    $alamat = !empty($data['kelurahan']) ? strtoupper($data['kelurahan']) : strtoupper($data['desa']);
                    echo $alamat . ", RT " . strtoupper($data['rt']) . "/RW " . strtoupper($data['rw']) . ".";
                    ?>
                </td>
                <td><?php echo strtoupper($data['no_kk']); ?> - <?php echo strtoupper($data['kepala']); ?></td>
                <td><?php echo strtoupper($data['status']); ?></td>
                <td>
                    <div class="button-group" style="display: flex; gap: 10px;">
                        <a href="?page=view-pend&kode=<?php echo $data['id_pend']; ?>" title="Detail" class="btn btn-info btn-sm">
                            <i class="fa fa-user"></i>
                        </a>
                        <a href="?page=edit-pend&kode=<?php echo $data['id_pend']; ?>" title="Ubah" class="btn btn-success btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" onclick="confirmDelete('<?php echo $data['id_pend']; ?>')" title="Hapus" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
    <?php
        }
    } else {
        // Tampilkan pesan jika query gagal
        echo "<tr><td colspan='8'>Data tidak ditemukan.</td></tr>";
    }
    ?>
</tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus penduduk ini. Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "?page=del-pend&kode=" + id;
        }
    });
}
</script>