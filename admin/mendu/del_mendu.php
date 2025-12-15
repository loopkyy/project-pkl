<?php
if(isset($_GET['kode'])){
    // Hapus data dari tabel tb_mendu
    $sql_hapus = "DELETE FROM tb_mendu WHERE id_pdd='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    // Jika penghapusan berhasil, ubah status di tb_pdd menjadi 'Ada'
    if ($query_hapus) {
        $sql_update = "UPDATE tb_pdd SET status='Ada' WHERE id_pend='".$_GET['kode']."'";
        $query_update = mysqli_query($koneksi, $sql_update);

        // Cek apakah update berhasil
        if ($query_update) {
            echo "<script>
            Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-mendu';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Update Status Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-mendu';
                }
            })</script>";
        }
    } else {
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-mendu';
            }
        })</script>";
    }
}
?>
