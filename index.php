<?php
ob_start(); // Memulai output buffering
session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION["ses_username"]) || $_SESSION["ses_username"] == "") {
    header("location: login.php"); // Jika belum login, redirect ke halaman login
    exit;
} else {
    // Mengambil data pengguna dari sesi
    $data_id = $_SESSION["ses_id"];
    $data_nama = $_SESSION["ses_nama"];
    $data_user = $_SESSION["ses_username"];
    $data_level = $_SESSION["ses_level"];
}

// Koneksi ke database
include "inc/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bps</title>
    <link rel="icon" href="dist/img/bps_.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Alert -->
    <script src="plugins/alert.js"></script>
    <link rel="stylesheet" href="dist/css/sidebar.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-red navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars text-white"></i>
                    </a>
                </li>
            </ul>

            <!-- Form Pencarian -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <span class="nav-link text-white" id="dateTime"></span> <!-- Menampilkan tanggal dan waktu -->
                </li>
            </ul>

            <script>
                // Fungsi untuk memperbarui tanggal dan waktu
                function updateDateTime() {
                    const dateTimeElement = document.getElementById('dateTime');
                    const now = new Date();
                    const options = {
                        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                        hour: '2-digit', minute: '2-digit', second: '2-digit'
                    };
                    dateTimeElement.innerHTML = now.toLocaleDateString('id-ID', options);
                }

                setInterval(updateDateTime, 1000); // Memperbarui setiap detik
            </script>
            <style>
    .main-footer {
        background-color:rgba(255, 255, 255, 0.74); /*Ganti warna footer */
        color: #212529; /* warna teks */
    }
</style>
            <style>
                
    .main-sidebar {
        background-color:rgb(69, 69, 70); /* Ganti dengan sidebar */
    }
</style>
<style>
    .main-header {
        background-color:rgba(215, 25, 11, 0.84); /* Ganti warna NAVBAR*/
    }
</style>
            <style>
                /* Menghindari efek hover pada DateTime */
                #dateTime {
                    color: white;
                    text-decoration: none;
                }

                #dateTime:hover {
                    color: white;  /* Memastikan warna tetap sama saat hover */
                }
            </style>
        </nav>

        <!-- Kontainer Sidebar Utama -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php" class="brand-link">
                <img src="dist/img/bps_.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                <span class="brand-text">BPS</span>
            </a>

            <div class="sidebar">
                <!-- Sidebar user (opsional) -->
                <div class="user-panel mt-2 pb-2 mb-2 d-flex">
                    <div class="image">
                        <img src="dist/img/admin.ico">
                    </div>
                    <div class="info">
                        <a href="index.php" class="d-block">
                            <?php 
                            // Menampilkan nama pengguna atau "Pengunjung"
                            if ($data_level == "Administrator") {
                                echo $data_nama; // Nama admin
                            } else {
                                echo "Pengunjung"; // Teks untuk user
                            }
                            ?>
                        </a>
                        <span class="badge badge-success">
                            <?php 
                            // Menampilkan level pengguna
                            if ($data_level == "Administrator") {
                                echo $data_level; // Level admin
                            } else {
                                echo "User  "; // Teks untuk user
                            }
                            ?>
                        </span>
                    </div>
                </div>
                <!-- Menu Sidebar -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if ($data_level == "Administrator") { ?>
                            <!-- Menu untuk Administrator -->
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Kelola Data <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="?page=data-pend" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data Penduduk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=data-kartu" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data Kartu Keluarga</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Sirkulasi Penduduk
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="?page=data-lahir" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data Lahir</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=data-mendu" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data Meninggal</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">Setting</li>

                            <li class="nav-item">
                                <a href="?page=data-pengguna" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Pengguna Sistem</p>
                                </a>
                            </li>

                        <?php } elseif ($data_level == "user") { // Pastikan ini sesuai dengan level yang disimpan ?>
                            <!-- Menu untuk User -->
                            <li class="nav-item">
                                <a href="index.php" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Download
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="?page=suket-domisili" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Su-Ket Domisili</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=suket-lahir" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Su-Ket Kelahiran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=suket-mati" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Su-Ket Kematian</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=download" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data desa/kelurahan </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="?page=kk" class="nav-link">
                                            <i class="nav-icon far fa-circle text-warning"></i>
                                            <p>Data KK</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <?php } ?>
                        
                        <!-- Opsi Logout untuk Semua Level -->
                        <li class="nav-item">
                            <a href="#" class="nav-link bubble-effect" id="logoutLink">
                                <i class="nav-icon fas fa-arrow-circle-right"></i>
                                <p>
                                    <?php
                                    // Memeriksa level pengguna
                                    if ($_SESSION["ses_level"] == "admin") {
                                        echo "Logout"; // Teks untuk admin
                                    } else {
                                        echo "Keluar"; // Teks untuk user
                                    }
                                    ?>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Tambahkan script SweetAlert di bagian akhir halaman -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    // Menangani klik pada link logout
                    document.getElementById('logoutLink').addEventListener('click', function(event) {
                        event.preventDefault(); // Mencegah link default untuk berfungsi

                        // Menggunakan SweetAlert untuk konfirmasi logout
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: 'Anda akan keluar.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, keluar!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jika pengguna mengkonfirmasi, redirect ke logout.php
                                window.location.href = 'logout.php';
                            }
                        });
                    });
                </script>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            </section>

            <!-- Konten Utama -->
            <section class="content">
                <!-- /. WEB DINAMIS DISINI -->
                <div class="container-fluid">

                    <?php 
                    if (isset($_GET['page'])) {
                        // Mengambil dan membersihkan parameter 'page'
                        $hal = htmlspecialchars($_GET['page']);
                    
                        switch ($hal) {
                            // Pengguna
                            case 'data-pengguna':
                                include "admin/pengguna/data_pengguna.php";
                                break;
                            case 'add-pengguna':
                                include "admin/pengguna/add_pengguna.php";
                                break;
                            case 'edit-pengguna':
                                include "admin/pengguna/edit_pengguna.php";
                                break;
                            case 'del-pengguna':
                                include "admin/pengguna/del_pengguna.php";
                                break;

                            // Kartu KK
                            case 'data-kartu':
                                include "admin/kartu/data_kartu.php";
                                break;
                            case 'add-kartu':
                                include "admin/kartu/add_kartu.php";
                                break;
                            case 'edit-kartu':
                                include "admin/kartu/edit_kartu.php";
                                break;
                            case 'anggota':
                                include "admin/kartu/anggota.php";
                                break;
                            case 'del-anggota':
                                include "admin/kartu/del_anggota.php";
                                break;
                            case 'del-kartu':
                                include "admin/kartu/del_kartu.php";
                                break;
                           

                            // Penduduk
                            case 'data-pend':
                                include "admin/pend/data_pend.php";
                                break;
                            case 'add-pend':
                                include "admin/pend/add_pend.php";
                                break;
                            case 'edit-pend':
                                include "admin/pend/edit_pend.php";
                                break;
                            case 'del-pend':
                                include "admin/pend/del_pend.php";
                                break;
                            case 'view-pend':
                                include "admin/pend/view_pend.php";
                                break;

                            // Lahir
                            case 'data-lahir':
                                include "admin/lahir/data_lahir.php";
                                break;
                            case 'add-lahir':
                                include "admin/lahir/add_lahir.php";
                                break;
                            case 'edit-lahir':
                                include "admin/lahir/edit_lahir.php";
                                break;
                            case 'del-lahir':
                                include "admin/lahir/del_lahir.php";
                                break;

                            // Mendu
                            case 'data-mendu':
                                include "admin/mendu/data_mendu.php";
                                break;
                            case 'add-mendu':
                                include "admin/mendu/add_mendu.php";
                                break;
                            case 'edit-mendu':
                                include "admin/mendu/edit_mendu.php";
                                break;
                            case 'del-mendu':
                                include "admin/mendu/del_mendu.php";
                                break;

                            // Download
                            case 'download':
                                include "download/kecamatan.php"; // Halaman untuk kecamatan
                                break;
                            case 'desa':
                                include "download/desa.php"; // Halaman untuk desa
                                break;
                            case 'kelurahan':
                                include "download/kelurahan.php"; // Halaman untuk kelurahan
                                break;
                            case 'view-desa':
                                include "download/view_desa.php"; // Halaman untuk melihat detail desa
                                break;
                            case 'view-kelurahan':
                                include "download/view_kelurahan.php"; // Halaman untuk melihat detail kelurahan
                                break;
                            case 'view-kk':
                                include "download/view_kk.php";
                                break;
                            case 'dowload-desa': // Pastikan ini sesuai
                                include "download/dowload_desa.php"; // Halaman untuk mengunduh data desa
                                break;
                            case 'dowload-kelurahan': // Pastikan ini sesuai
                                include "download/dowload_kelurahan.php"; // Pastikan path ini benar
                                break;
                            case 'download-kk':
                                include "download/download_kk.php";
                                break;
                            case 'kk':
                                include "download/kk.php";
                                break;
                            // Suket
                            case 'suket-domisili':
                                include "surat/suket_domisili.php";
                                break;
                            case 'suket-lahir':
                                include "surat/suket_lahir.php";
                                break;
                            case 'suket-mati':
                                include "surat/suket_mati.php";
                                break;
                            case 'suket-datang':
                                include "surat/suket_datang.php";
                                break;
                            case 'suket-pindah':
                                include "surat/suket_pindah.php";
                                break;

                            // Default
                            default:
                                echo "<center><h1> ERROR: Halaman tidak ditemukan!</h1></center>";
                                break;        
                        }
                    } else {
                        // Jika tidak ada parameter 'page', tampilkan halaman default
                        include "home/admin.php"; // Ganti dengan halaman default Anda
                    }
                    ?>

                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                Copyright &copy;
                <a target="_blank" href="index.php">
                    <strong> Project_Pkl</strong>
                </a>
                All rights reserved.
            </div>
            <b>PROJECT PKL 2024/2025</b>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Konten sidebar kontrol di sini -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE untuk tujuan demo -->
    <script src="dist/js/demo.js"></script>
    <!-- script halaman -->
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable(); // Menginisialisasi DataTable
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
<?php	
ob_end_flush(); // Mengakhiri output buffering
?>
    <script>
        $(function() {
            // Menginisialisasi Elemen Select2
            $('.select2').select2()

            // Menginisialisasi Elemen Select2 dengan tema Bootstrap4
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>

</body>

</html>