<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_kk WHERE id_kk='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

    $kk = $data_cek['id_kk'];
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-users"></i> Anggota KK
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type='hidden' class="form-control" id="id_kk" name="id_kk" value="<?php echo $data_cek['id_kk']; ?>" readonly/>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No KK | KPl Keluarga</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?php echo $data_cek['no_kk']; ?>" readonly/>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kepala" name="kepala" value="<?php echo $data_cek['kepala']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" 
    value="<?php 
        // Cek apakah kelurahan ada
        if (!empty($data_cek['kelurahan'])) {
            // Jika kelurahan ada, tampilkan kelurahan
            echo strtoupper($data_cek['kelurahan']);
        } else {
            // Jika kelurahan tidak ada, tampilkan desa
            echo strtoupper($data_cek['desa']);
        }
    ?>, RT <?php echo $data_cek['rt']; ?> RW <?php echo $data_cek['rw']; ?> (Kuningan - <?php echo $data_cek['kec']; ?>)" readonly/>
                </div>
            </div>

            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Anggota</label>
    <div class="col-sm-4">
        <select name="id_pend" id="id_pend" class="form-control select2bs4" required>
            <option selected="selected">- Penduduk -</option>
            <?php
            // Ambil ID anggota yang sudah terdaftar di tb_anggota untuk Kartu Keluarga ini
            $anggota_ids = [];
            $anggota_query = "SELECT id_pend FROM tb_anggota WHERE id_kk='$kk'";
            $anggota_result = mysqli_query($koneksi, $anggota_query);
            while ($anggota_row = mysqli_fetch_assoc($anggota_result)) {
                $anggota_ids[] = $anggota_row['id_pend'];
            }

            // Buat string untuk kondisi WHERE
            $exclude_ids = implode(",", array_map('intval', $anggota_ids)); // Menghindari SQL Injection

            // Ambil penduduk yang statusnya 'Ada' dan tidak terdaftar di tb_anggota
            $query = "SELECT * FROM tb_pdd WHERE status='Ada'";
            if (!empty($exclude_ids)) {
                $query .= " AND id_pend NOT IN ($exclude_ids)";
            }
            $hasil = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_array($hasil)) {
            ?>
            <option value="<?php echo $row['id_pend'] ?>">
                <?php echo $row['nik'] ?> - <?php echo $row['nama'] ?>
            </option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="col-sm-3">
    <select name="hubungan" id="hubungan" class="form-control">
        <option>- Hub Keluarga -</option>
        <option>Kepala Keluarga</option>
        <option>Istri</option>
        <option>Anak</option>
        <option>Kakek</option>
        <option>Nenek</option>
        <option>Menantu</option>
        <option>Cucu</option>
    </select>
</div>
<input type="submit" name="Simpan" value="Tambah" class="btn btn-success">


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jekel</th>
                                <th>Hub Keluarga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $koneksi->query("SELECT p.nik, p.nama, p.jekel, a.hubungan, a.id_anggota FROM tb_pdd p INNER JOIN tb_anggota a ON p.id_pend=a.id_pend WHERE status='Ada' AND id_kk=$kk");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $data['nik']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['jekel']; ?></td>
                                <td><?php echo $data['hubungan']; ?></td>
                                <td>
                                    <!-- Tombol Hapus -->
<a href="#" onclick="confirmDelete('<?php echo $data['id_anggota']; ?>')" title="Hapus" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i>
</a>

<!-- Script SweetAlert -->
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus data ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "?page=del-anggota&kode=" + id;
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
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
    <a href="?page=data-kartu" title="Kembali" class="btn btn-warning">Kembali</a>
</div>
<?php
if (isset($_POST['Simpan'])) {
    // Ambil data dari form
    $id_pend = $_POST['id_pend'];
    $id_kk = $_POST['id_kk'];
    $hubungan = $_POST['hubungan'];

    // Periksa apakah anggota sudah ada di tb_anggota
    $check_sql = "SELECT * FROM tb_anggota WHERE id_pend = '$id_pend'";
    $check_query = mysqli_query($koneksi, $check_sql);
    
    if (mysqli_num_rows($check_query) > 0) {
        // Anggota sudah terdaftar di tempat lain
        echo "<script>
        Swal.fire({title: 'Anggota sudah terdaftar di Kartu Keluarga lain', text: '', icon: 'warning', confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {
            window.location = 'index.php?page=anggota&kode=$id_kk'; }})</script>";
    } else {
        // Cek apakah hubungan yang dipilih adalah "Kepala Keluarga", "Istri", "Kakek", "Nenek", atau "Menantu"
        if (in_array($hubungan, ['Kepala Keluarga', 'Istri', 'Kakek', 'Nenek', 'Menantu'])) {
            // Cek apakah sudah ada anggota dengan hubungan yang sama di tb_anggota untuk Kartu Keluarga ini
            $check_hubungan_sql = "SELECT * FROM tb_anggota WHERE id_kk='$id_kk' AND hubungan='$hubungan'";
            $check_hubungan_query = mysqli_query($koneksi, $check_hubungan_sql);

            if (mysqli_num_rows($check_hubungan_query) > 0) {
                // Jika sudah ada anggota dengan hubungan yang sama, tampilkan pesan kesalahan
                echo "<script>
                Swal.fire({title: 'Hanya boleh ada satu $hubungan per Kartu Keluarga!', text: '', icon: 'warning', confirmButtonText: 'OK'
                }).then((result) => {if (result.value) {
                    window.location = 'index.php?page=anggota&kode=$id_kk'; }})</script>";
                return; // Hentikan eksekusi
            }
        }

        // Tambahkan anggota baru ke tb_anggota
        $sql_simpan = "INSERT INTO tb_anggota (id_kk, id_pend, hubungan) VALUES ('$id_kk', '$id_pend', '$hubungan')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);

      // Jika berhasil menambahkan anggota baru
if ($query_simpan) {
    // Ambil data alamat dari tb_kk
    $data_cek = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_kk WHERE id_kk='$id_kk'"));

    // Tentukan apakah akan mengupdate kolom desa atau kelurahan
    $desa = $data_cek['desa'];
    $kelurahan = $data_cek['kelurahan'];
    $rt = $data_cek['rt'];
    $rw = $data_cek['rw'];
    $kecamatan = $data_cek['kec'];

    // Update alamat penduduk sesuai dengan alamat KK
    $update_alamat_sql = "UPDATE tb_pdd 
        SET desa = '$desa', 
            kelurahan = '$kelurahan', 
            rt = '$rt', 
            rw = '$rw', 
            kecamatan = '$kecamatan' 
        WHERE id_pend = '$id_pend'";

    // Eksekusi query update
    if (mysqli_query($koneksi, $update_alamat_sql)) {
        echo "";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }


            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil dan Alamat Diperbarui', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {
                window.location = 'index.php?page=anggota&kode=$id_kk'; }})</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {
                window.location = 'index.php?page=anggota&kode=$id_kk'; }})</script>";
        }
    }
}
?>