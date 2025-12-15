<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan" required maxlength="16" pattern="\d{16}" title="NIK harus terdiri dari 16 angka" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);">
            </div>
        </div>
</form>

<script>
document.getElementById('nik').addEventListener('input', function() {
    // Hanya izinkan angka dan batasi hingga 16 karakter
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);
});
</script>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Bayi" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tgl Lahir</label>
				<div class="col-sm-3">
					<input type="date" class="form-control" id="tgl_lh" name="tgl_lh" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-3">
					<select name="jekel" id="jekel" class="form-control" required>
						<option value="" disabled selected>- Pilih -</option>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-6">
                    <select name="agama" id="agama" class="form-control" required>
                        <option value="" disabled selected>- Pilih Agama -</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Keluarga</label>
				<div class="col-sm-6">
					<select name="id_kk" id="id_kk" class="form-control select2bs4" required>
						<option value="" disabled selected>- Pilih KK -</option>
						<?php
                        $query = "SELECT * FROM tb_kk";
                        $hasil = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($hasil)) {
                        ?>
						<option value="<?php echo $row['id_kk'] ?>">
							<?php echo $row['no_kk'] ?> - <?php echo $row['kepala'] ?>
						</option>
						<?php
                        }
                        ?>
					</select>
				</div>
			</div>
			<div class="card-footer">
				<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
				<a href="?page=data-lahir" title="Kembali" class="btn btn-secondary">Batal</a>
			</div>
		</div>
	</form>
</div>

<?php
if (isset($_POST['Simpan'])) {
    $nik = $_POST['nik'];
    $id_kk = $_POST['id_kk'];

    // Cek apakah NIK sudah ada di tb_pdd
    $cek_nik = mysqli_query($koneksi, "SELECT * FROM tb_pdd WHERE nik = '$nik'");
    if (mysqli_num_rows($cek_nik) > 0) {
        // Jika NIK sudah ada, tampilkan pesan error
        echo "<script>
        Swal.fire({title: 'Error', text: 'NIK sudah ada di sistem', icon: 'error', confirmButtonText: 'OK'})
            .then((result) => {if (result.value) { window.location = 'index.php?page=add-lahir'; }})
        </script>";
    } else {
       // Ambil kec, desa, rt, rw, dan kelurahan dari tb_kk
$query_kk = "SELECT kec, desa, rt, rw, kelurahan FROM tb_kk WHERE id_kk = '$id_kk'";
$result_kk = mysqli_query($koneksi, $query_kk);
$row_kk = mysqli_fetch_array($result_kk);
$kec = $row_kk['kec'];
$desa = $row_kk['desa'];
$rt = $row_kk['rt'];
$rw = $row_kk['rw'];
$kelurahan = $row_kk['kelurahan']; // Menambahkan pengambilan kelurahan
$pekerjaan = "Belum";
$kawin = "Belum";
       // Insert ke tb_pdd
$sql_pdd = "INSERT INTO tb_pdd (nik, nama, tgl_lh, jekel, kecamatan, desa, kelurahan, rt, rw, agama, pekerjaan, kawin, tempat_lh) VALUES (
    '".$nik."',
    '".$_POST['nama']."',
    '".$_POST['tgl_lh']."',
    '".$_POST['jekel']."',
    '$kec',
    '$desa',
    '$kelurahan',
    '$rt',
    '$rw',
    '".$_POST['agama']."',
    '$pekerjaan',
    '$kawin',
    'Kuningan' 
)";
$query_pdd = mysqli_query($koneksi, $sql_pdd);
        if ($query_pdd) {
            $id_pend = mysqli_insert_id($koneksi);

            // Insert ke tb_lahir
            $sql_simpan = "INSERT INTO tb_lahir (nama, tgl_lh, jekel, id_kk,agama) VALUES (
                '".$_POST['nama']."',
                '".$_POST['tgl_lh']."',
                '".$_POST['jekel']."',
                '$id_kk',
                '".$_POST['agama']."'
            )";
            $query_simpan = mysqli_query($koneksi, $sql_simpan);

            if ($query_simpan) {
                // Insert ke tb_anggota
                $sql_anggota = "INSERT INTO tb_anggota (id_kk, id_pend, hubungan) VALUES (
                    '$id_kk',
                    '$id_pend',
                    'Anak'
                )";
                $query_anggota = mysqli_query($koneksi, $sql_anggota);

                if ($query_anggota) {
                    echo "<script>
                    Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'})
                        .then((result) => {if (result.value) { window.location = 'index.php?page=data-lahir'; }})
                    </script>";
                } else {
                    echo "<script>
                    Swal.fire({title: 'Tambah Data Gagal', text: 'Gagal menyimpan ke tb_anggota', icon: 'error', confirmButtonText: 'OK'})
                        .then((result) => {if (result.value) { window.location = 'index.php?page=add-lahir'; }})
                    </script>";
                }
            } else {
                echo "<script>
                Swal.fire({title: 'Tambah Data Gagal', text: 'Gagal menyimpan ke tb_lahir', icon: 'error', confirmButtonText: 'OK'})
                    .then((result) => {if (result.value) { window.location = 'index.php?page=add-lahir'; }})
                </script>";
            }
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: 'Gagal menyimpan ke tb_pdd', icon: 'error', confirmButtonText: 'OK'})
                .then((result) => {if (result.value) { window.location = 'index.php?page=add-lahir'; }})
            </script>";
        }
    }

    mysqli_close($koneksi);
}
?>
