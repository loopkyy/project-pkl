<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" placeholder="Nama user" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-4">
                    <select name="level" id="level" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-pengguna" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    include "inc/koneksi.php"; // Hubungkan ke database

    // Ambil dan bersihkan input
    $nama_pengguna = trim($_POST['nama_pengguna']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $level = trim($_POST['level']);

    // Validasi bahwa semua field harus diisi
    if (empty($nama_pengguna) || empty($username) || empty($password) || empty($level)) {
        echo "<script>
            Swal.fire({
                title: 'Tambah Data Gagal',
                text: 'Semua field harus diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-pengguna';
                }
            })</script>";
    } elseif ($username === $password) { // Cek apakah password sama dengan username
        echo "<script>
            Swal.fire({
                title: 'Tambah Data Gagal',
                text: 'Password tidak boleh sama dengan Username!',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-pengguna';
                }
            })</script>";
    } else {
        // Cek apakah password sudah ada dalam database
        $sql_check_password = "SELECT * FROM tb_pengguna WHERE password = '$password'";
        $result = mysqli_query($koneksi, $sql_check_password);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                Swal.fire({
                    title: 'Tambah Data Gagal',
                    text: 'Password sudah digunakan oleh pengguna lain!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=add-pengguna';
                    }
                })</script>";
        } else {
            // Siapkan pernyataan SQL
            $sql_simpan = "INSERT INTO tb_pengguna (nama_pengguna, username, password, level) VALUES (
                '$nama_pengguna',
                '$username',
                '$password',  -- Menyimpan password dalam bentuk teks biasa
                '$level')";
            
            // Eksekusi kueri
            $query_simpan = mysqli_query($koneksi, $sql_simpan);
            mysqli_close($koneksi);

            if ($query_simpan) {
                echo "<script>
                    Swal.fire({
                        title: 'Tambah Data Berhasil',
                        text: '',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=data-pengguna';
                        }
                    })</script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Tambah Data Gagal',
                        text: '',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=add-pengguna';
                        }
                    })</script>";
            }
        }
    }
}
?>
