<?php
// Memulai sesi di bagian atas
session_start();
include "inc/koneksi.php"; // Menghubungkan ke file koneksi database
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | BPS</title>
    <link rel="icon" href="dist/img/bps_.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Tema style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .btn-link {
            color: #dc3545;
            text-decoration: underline;
        }

        .btn-link:hover {
            color: #c82333;
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo"></div>
        <div class="card">
            <div class="card-body login-card-body">
                <center>
                    <img src="dist/img/bps_.png" width=170px />
                    <br><br>
                    <h5><b>Sistem Data Kependudukan Kuningan</b></h5><br>
                </center>

                <div class="form-group">
                    <button id="userLogin" class="btn btn-primary btn-block">Masuk sebagai Pengunjung</button>
                    <button id="adminLogin" class="btn btn-danger btn-block">Login sebagai Administrator</button>
                </div>

                <form id="adminForm" action="" method="post" style="display: none;">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="passwordInput" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <span class="fas fa-eye" id="passwordIcon"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger btn-block btn-flat" name="btnLogin" title="Masuk Sistem">
                                <b>Login</b>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <button type="button" id="backButton" class="btn btn-secondary btn-block btn-flat">Kembali</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>

    <script>
        // JavaScript untuk toggle password
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const passwordIcon = document.querySelector('#passwordIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            passwordIcon.classList.toggle('fa-eye-slash'); // Mengubah ikon mata
        });

        // JavaScript untuk pemilihan jenis login
        document.getElementById('userLogin').addEventListener('click', function() {
            // Mengatur variabel sesi untuk pengguna
            <?php
            $_SESSION["ses_id"] = 1; // Mengatur ID pengguna default atau ambil dari database
            $_SESSION["ses_nama"] = "User   "; // Mengatur nama pengguna default
            $_SESSION["ses_username"] = "user"; // Mengatur username default
            $_SESSION["ses_level"] = "user"; // Mengatur level pengguna
            ?>
            // Redirect ke dashboard pengguna
            window.location.href = 'index.php';
        });

        document.getElementById('adminLogin').addEventListener('click', function() {
            document.getElementById('adminForm').style.display = 'block'; // Menampilkan form login admin
            document.getElementById('userLogin').style.display = 'none'; // Menyembunyikan tombol login pengguna
            document.getElementById('adminLogin').style.display = 'none'; // Menyembunyikan tombol login admin
        });

        document.getElementById('backButton').addEventListener('click', function() {
            document.getElementById('adminForm').style.display = 'none'; // Menyembunyikan form login admin
            document.getElementById('userLogin').style.display = 'block'; // Menampilkan tombol login pengguna
            document.getElementById('adminLogin').style.display = 'block'; // Menampilkan tombol login admin
        });
    </script>
</body>

</html>

<?php
if (isset($_POST['btnLogin'])) {  
    // Menghindari SQL injection
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk login
    $sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username' AND password='$password'";
    $query_login = mysqli_query($koneksi, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
    $jumlah_login = mysqli_num_rows($query_login);

    if ($jumlah_login == 1) {
        // Debugging: Memeriksa apakah data login tersedia
        if ($data_login) {
            $_SESSION["ses_id"] = $data_login["id_pengguna"];
            $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
            $_SESSION["ses_username"] = $data_login["username"];
            $_SESSION["ses_password"] = $data_login["password"];
            $_SESSION["ses_level"] = $data_login["level"];
        }

        // Menampilkan SweetAlert untuk login berhasil
        echo "<script>
        Swal.fire({
            title: 'Login Berhasil',
            text: 'Selamat datang, " . $data_login["nama_pengguna"] . "!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php'; // Redirect ke halaman utama
            }
        })</script>";
    } else {
        // Menampilkan SweetAlert untuk login gagal
        echo "<script>
            Swal.fire({
                title: 'Login Gagal',
                text: 'Username atau password salah.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    // Tetap di form input
                    document.getElementById('adminForm').style.display = 'block'; // Tampilkan form admin
                    document.getElementById('userLogin').style.display = 'none'; // Sembunyikan tombol user
                    document.getElementById('adminLogin').style.display = 'none'; // Sembunyikan tombol admin
                }
            });
        </script>";
    }
}
?>