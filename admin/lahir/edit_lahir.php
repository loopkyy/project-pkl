<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_lahir WHERE id_lahir='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}

?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No Sistem</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="id_lahir" name="id_lahir" value="<?php echo $data_cek['id_lahir']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_cek['nama']; ?>"
					 required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tgl Lahir</label>
				<div class="col-sm-3">
					<input type="date" class="form-control" id="tgl_lh" name="tgl_lh" value="<?php echo $data_cek['tgl_lh']; ?>"
					 required>
				</div>
			</div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-6">
                    <select name="agama" id="agama" class="form-control" required>
                        <option value="">- Pilih Agama -</option>
                        <option value="Islam" <?php echo ($data_cek['agama'] == "Islam") ? "selected" : ""; ?>>Islam</option>
                        <option value="Kristen" <?php echo ($data_cek['agama'] == "Kristen") ? "selected" : ""; ?>>Kristen</option>
                        <option value="Hindu" <?php echo ($data_cek['agama'] == "Hindu") ? "selected" : ""; ?>>Hindu</option>
                        <option value="Buddha" <?php echo ($data_cek['agama'] == "Buddha") ? "selected" : ""; ?>>Buddha</option>
                        <option value="Konghucu" <?php echo ($data_cek['agama'] == "Konghucu") ? "selected" : ""; ?>>Konghucu</option>
                        <option value="Lainnya" <?php echo ($data_cek['agama'] == "Lainnya") ? "selected" : ""; ?>>Lainnya</option>
                    </select>
                </div>
            </div>

			<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-3">
        <select name="jekel" id="jekel" class="form-control" required>
            <option value="">-- Pilih jekel --</option>
            <option value="LAKI-LAKI" <?php echo ($data_cek['jekel'] == "LAKI-LAKI") ? "selected" : ""; ?>>Laki-Laki</option>
            <option value="PEREMPUAN" <?php echo ($data_cek['jekel'] == "PEREMPUAN") ? "selected" : ""; ?>>Perempuan</option>
        </select>
    </div>
</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Keluarga</label>
				<div class="col-sm-6">
					<select name="id_kk" id="id_kk" class="form-control select2bs4" required>
						<option selected="">- Pilih -</option>
						<?php
                        // ambil data dari database
                        $query = "select * from tb_kk";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $row['id_kk'] ?>" <?=$data_cek[
						 'id_kk']==$row[ 'id_kk'] ? "selected" : null ?>>
							<?php echo $row['no_kk'] ?>
							-
							<?php echo $row['kepala'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-lahir" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    // Ambil data kecamatan, desa, rt, rw, dan kelurahan berdasarkan id_kk yang dipilih
    $id_kk = $_POST['id_kk'];
    $sql_kk = "SELECT kec, desa, rt, rw, kelurahan FROM tb_kk WHERE id_kk='$id_kk'";
    $query_kk = mysqli_query($koneksi, $sql_kk);
    $data_kk = mysqli_fetch_array($query_kk);
    // Update data di tb_lahir
    $sql_ubah = "UPDATE tb_lahir SET 
        nama='" . $_POST['nama'] . "',
        tgl_lh='" . $_POST['tgl_lh'] . "',
        jekel='" . $_POST['jekel'] . "',
        id_kk='$id_kk',
        agama='" . $_POST['agama'] . "'
        WHERE id_lahir='" . $_POST['id_lahir'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    // Update data di tb_anggota
    $sql_ubah_anggota = "UPDATE tb_anggota SET 
        id_kk='$id_kk',
        hubungan='Anak' -- sesuaikan sesuai kebutuhan
        WHERE id_lahir='" . $_POST['id_lahir'] . "'";
    $query_ubah_anggota = mysqli_query($koneksi, $sql_ubah_anggota);

    // Update data di tb_pdd dengan kecamatan, desa, kelurahan, rt, rw, dan tempat_lh
$sql_ubah_pdd = "UPDATE tb_pdd SET 
nama='" . $_POST['nama'] . "',
tgl_lh='" . $_POST['tgl_lh'] . "',
jekel='" . $_POST['jekel'] . "',
kecamatan='" . $data_kk['kec'] . "',
desa='" . $data_kk['desa'] . "',
kelurahan='" . $data_kk['kelurahan'] . "',  
rt='" . $data_kk['rt'] . "',
rw='" . $data_kk['rw'] . "',
agama='" . $_POST['agama'] . "',
pekerjaan='Belum Bekerja',
kawin='Belum Kawin',
tempat_lh='Kuningan'  // Menambahkan tempat_lh dengan nilai 'Kuningan'
WHERE nama='" . $_POST['nama'] . "'";
$query_ubah_pdd = mysqli_query($koneksi, $sql_ubah_pdd);

    mysqli_close($koneksi);

    // Cek apakah semua query berhasil
    if ($query_ubah && $query_ubah_anggota && $query_ubah_pdd) {
        echo "<script>
            Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=data-lahir';
                }
            })</script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=data-lahir';
                }
            })</script>";
    }
}
?>

