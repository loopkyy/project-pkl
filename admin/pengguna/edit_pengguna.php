<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_pengguna WHERE id_pengguna='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type='hidden' class="form-control" name="id_pengguna" value="<?php echo $data_cek['id_pengguna']; ?>" readonly />

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?php echo $data_cek['nama_pengguna']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $data_cek['username']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-4">
                    <select name="level" id="level" class="form-control">
                        <option value="">-- Pilih Level --</option>
                        <option value="Administrator" <?php if ($data_cek['level'] == "Administrator") echo "selected"; ?>>Administrator</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-pengguna" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    // Cek apakah ada perubahan data
    $is_changed = false;

    // Cek perubahan nama pengguna
    if ($_POST['nama_pengguna'] != $data_cek['nama_pengguna']) {
        $is_changed = true;
    }

    // Cek perubahan username
    if ($_POST['username'] != $data_cek['username']) {
        $is_changed = true;
    }

    // Cek perubahan level
    if ($_POST['level'] != $data_cek['level']) {
        $is_changed = true;
    }

    if ($is_changed) {
        // Menyiapkan query untuk update jika ada perubahan
        $sql_ubah = "UPDATE tb_pengguna SET
            nama_pengguna='" . mysqli_real_escape_string($koneksi, $_POST['nama_pengguna']) . "',
            username='" . mysqli_real_escape_string($koneksi, $_POST['username']) . "',
            level='" . mysqli_real_escape_string($koneksi, $_POST['level']) . "'
            WHERE id_pengguna='" . mysqli_real_escape_string($koneksi, $_POST['id_pengguna']) . "'";

        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);

        if ($query_ubah) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil diubah.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'index.php?page=data-pengguna';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data gagal diubah.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'index.php?page=data-pengguna';
                    }
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Tidak ada perubahan',
                text: 'Data tidak diubah karena tidak ada perubahan yang dilakukan.',
                icon: 'info',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'index.php?page=data-pengguna';
                }
            });
        </script>";
    }
}
?>
