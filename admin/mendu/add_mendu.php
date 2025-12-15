<?php
// Ambil data penduduk saat form pertama kali dimuat
$penduduk = null;
$agama = '';
$jenis_kelamin = '';

if (isset($_POST['id_pdd']) && $_POST['id_pdd'] !== '') {
    // Ambil data dari tb_pdd berdasarkan id_pdd yang dipilih
    $id_pdd = $_POST['id_pdd'];
    $query_penduduk = "SELECT * FROM tb_pdd WHERE id_pend = '$id_pdd'";
    $result_penduduk = mysqli_query($koneksi, $query_penduduk);
    $penduduk = mysqli_fetch_assoc($result_penduduk);
    $agama = $penduduk['agama'];
    $jenis_kelamin = $penduduk['jekel'];
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <!-- Pilih Penduduk -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Penduduk</label>
                <div class="col-sm-6">
                    <select name="id_pdd" id="id_pdd" class="form-control select2bs4" required onchange="this.form.submit()">
                        <option selected="selected" value="">- Pilih Penduduk -</option>
                        <?php
                        // Ambil data penduduk dari database
                        $query = "SELECT * FROM tb_pdd WHERE status='Ada'";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                            echo "<option value='".$row['id_pend']."' ".($row['id_pend'] == $id_pdd ? 'selected' : '').">
                                ".$row['nik']." - ".$row['nama']."
                            </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Jenis Kelamin (Otomatis Terisi) -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="jk" name="jk" value="<?= isset($penduduk['jekel']) ? $penduduk['jekel'] : '' ?>" readonly>
                </div>
            </div>

            <!-- Agama (Otomatis Terisi) -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="agama" name="agama" value="<?= $agama ?>" readonly>
                </div>
            </div>

            <!-- Tanggal Meninggal -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Meninggal</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="tgl_mendu" name="tgl_mendu" required>
                </div>
            </div>

            <!-- Sebab -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Sebab</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="sebab" name="sebab" placeholder="Penyebab" required>
                </div>
            </div>

            <!-- Tempat Meninggal -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Meninggal</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="tempat_mendu" name="tempat_mendu" placeholder="Tempat Meninggal" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-mendu" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
// Proses simpan data ke tb_mendu
if (isset($_POST['Simpan'])) {
    // Ambil id_pdd dari form
    $id_pdd = $_POST['id_pdd'];

    // Proses simpan data ke tb_mendu
    $sql_simpan = "INSERT INTO tb_mendu (id_pdd, tgl_mendu, sebab, agama, jk, tempat_mendu) VALUES (
        '$id_pdd',
        '".$_POST['tgl_mendu']."',
        '".$_POST['sebab']."',
        '".$_POST['agama']."',
        '".$_POST['jk']."',
        '".$_POST['tempat_mendu']."')";

    // Eksekusi query
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        // Update status penduduk menjadi 'Meninggal'
        $sql_ubah = "UPDATE tb_pdd SET status='Meninggal' WHERE id_pend='$id_pdd'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);

        if ($query_ubah) {
            // Jika berhasil
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'})
            .then((result) => {if (result.value){
                window.location = 'index.php?page=data-mendu';
                }
            })</script>";
        } else {
            // Jika gagal update status
            echo "<script>
            Swal.fire({title: 'Gagal mengupdate status penduduk', text: '".mysqli_error($koneksi)."', icon: 'error', confirmButtonText: 'OK'})
            .then((result) => {if (result.value){
                window.location = 'index.php?page=add-mendu';
                }
            })</script>";
        }
    } else {
        // Jika gagal simpan
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: '".mysqli_error($koneksi)."', icon: 'error', confirmButtonText: 'OK'})
        .then((result) => {if (result.value){
            window.location = 'index.php?page=add-mendu';
            }
        })</script>";
    }
}
?>