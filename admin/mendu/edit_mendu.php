<?php

if(isset($_GET['kode'])){
    $sql_cek = "SELECT 
            p.nama, 
            p.jekel AS jekel_pdd, 
            m.jk AS jekel_mendu, 
            m.agama, 
            m.id_mendu, 
            m.tgl_mendu, 
            m.sebab, 
            m.tempat_mendu 
        FROM tb_mendu m 
        JOIN tb_pdd p ON m.id_pdd = p.id_pend 
        WHERE m.id_mendu = '" . $_GET['kode'] . "'";

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

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Sistem</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id_mendu" name="id_mendu" value="<?php echo $data_cek['id_mendu']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_cek['nama']; ?>" readonly required>
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="jk" name="jk" 
               value="<?= htmlspecialchars($penduduk['jk'] ?? 'Belum diisi'); ?>" readonly>
    </div>
</div>

            <!-- Agama -->
            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Agama</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="agama" name="agama" 
               value="<?php echo htmlspecialchars($data_cek['agama'] ?? 'Belum diisi'); ?>" 
               readonly>
    </div>
</div>

            <!-- Tanggal Kematian -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tgl Mendu</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="tgl_mendu" name="tgl_mendu" value="<?php echo $data_cek['tgl_mendu']; ?>" required>
                </div>
            </div>

            <!-- Tempat Mendu -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Mendu</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="tempat_mendu" name="tempat_mendu" value="<?php echo $data_cek['tempat_mendu']; ?>"required>
                </div>
            </div>

            <!-- Sebab -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sebab</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="sebab" name="sebab" value="<?php echo $data_cek['sebab']; ?>" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-mendu" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

   if (isset($_POST['Ubah'])) {
    $sql_ubah = "UPDATE tb_mendu SET 
    tgl_mendu='".$_POST['tgl_mendu']."',
    sebab='".$_POST['sebab']."',
    agama='".$_POST['agama']."',
    jk='".$_POST['jk']."',
    tempat_mendu='".$_POST['tempat_mendu']."'
    WHERE id_mendu='".$_POST['id_mendu']."'";

    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    if (!$query_ubah) {
        die("Error updating record: " . mysqli_error($koneksi));
    }
    mysqli_close($koneksi);



        if ($query_ubah) {
            echo "<script>
            Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=data-mendu';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=data-mendu';
                }
            })</script>";
        }
    }
?>
