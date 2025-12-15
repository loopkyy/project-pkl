<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>

    <style>
        input, select {
            text-transform: uppercase;
        }
    </style>

    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="card-body">
            <!-- NIK -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK (16 digit)" required maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="NIK harus terdiri dari 16 digit dan hanya angka">
                    <small class="text-danger" id="nik-error"></small>
                </div>
            </div>

            <!-- Nama -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Penduduk" required>
                </div>
            </div>

            <!-- Tempat, Tanggal Lahir -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">TTL</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="tempat_lh" name="tempat_lh" value="Kuningan" readonly required>
                </div>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="tgl_lh" name="tgl_lh" placeholder="Tanggal Lahir" required>
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                    <select name="jekel" id="jekel" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                        <option value="PEREMPUAN">PEREMPUAN</option>
                    </select>
                </div>
            </div>

            <!-- Kecamatan -->
            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kecamatan</label>
    <div class="col-sm-6">
    <select name="kecamatan" id="kecamatan" class="form-control" onchange="updateDesaKelurahan()" required>
            <option value="">- Pilih Kecamatan -</option>
                        <!-- List of Kecamatan options -->
                        <option value="Ciawigebang">Ciawigebang</option>
                        <option value="Cibeureum">Cibeureum</option>
                        <option value="Cibingbin">Cibingbin</option>
                        <option value="Cidahu">Cidahu</option>
                        <option value="Cigandamekar">Cigandamekar</option>
                        <option value="Cigugur">Cigugur</option>
                        <option value="Cilebak">Cilebak</option>
                        <option value="Cilimus">Cilimus</option>
                        <option value="Cimahi">Cimahi</option>
                        <option value="Ciniru">Ciniru</option>
                        <option value="Cipicung">Cipicung</option>
                        <option value="Ciwaru">Ciwaru</option>
                        <option value="Darma">Darma</option>
                        <option value="Garawangi">Garawangi</option>
                        <option value="Hantara">Hantara</option>
                        <option value="Jalaksana">Jalaksana</option>
                        <option value="Japara">Japara</option>
                        <option value="Kadugede">Kadugede</option>
                        <option value="Kalimanggis">Kalimanggis</option>
                        <option value="Karangkancana">Karangkancana</option>
                        <option value="Kramatmulya">Kramatmulya</option>
                        <option value="Kuningan">Kuningan</option>
                        <option value="Lebakwangi">Lebakwangi</option>
                        <option value="Luragung">Luragung</option>
                        <option value="Maleber">Maleber</option>
                        <option value="Mandirancan">Mandirancan</option>
                        <option value="Nusaherang">Nusaherang</option>
                        <option value="Pancalang">Pancalang</option>
                        <option value="Pasawahan">Pasawahan</option>
                        <option value="Selajambe">Selajambe</option>
                        <option value="Subang">Subang</option>
                    </select>
                </div>
            </div>

<!-- Pilih Desa -->
<div class="form-group row" id="desa-container">
    <label class="col-sm-2 col-form-label">Desa</label>
    <div class="col-sm-6">
        <select name="desa" id="desa" class="form-control">
            <option value="">- Pilih Desa -</option>
        </select>
    </div>
</div>

<!-- Pilih Kelurahan -->
<div class="form-group row" id="kelurahan-container">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-6">
        <select name="kelurahan" id="kelurahan" class="form-control">
            <option value="">- Pilih Kelurahan -</option>
        </select>
    </div>
</div>

            <!-- RT / RW -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">RT / RW</label>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT (3 digit)" required maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="Format harus 3 digit, contoh: 001">
                            <small class="text-danger" id="rt-error"></small>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW (3 digit)" required maxlength="3" oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="Format harus 3 digit, contoh: 001">
                            <small class="text-danger" id="rw-error"></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agama -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-6">
                    <select name="agama" id="agama" class="form-control" required>
                        <option value="">- Pilih Agama -</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- Status Perkawinan -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Perkawinan</label>
                <div class="col-sm-3">
                    <select name="kawin" id="kawin" class="form-control" required>
                        <option value="">- Pilih -</option>
                        <option value="Sudah">Sudah</option>
                        <option value="Belum">Belum</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                    </select>
                </div>
            </div>

            <!-- Pekerjaan -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" title="Hanya huruf yang diperbolehkan">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-pend" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
         

<script>
    const desaData = {
        "Ciawigebang": {
            Desa: ["Ciawigebang","Ciawilor","Cigarukgak","Cihaur","Cihirup","Cijagamulya","Cikubangmulya","Ciomas","Ciputat","Dukuhdalem","Geresik","Kadurama","Kapandayan","Karangkamulyan","Keramatmulya","Lebaksiuh","Mekarjaya","Padarama","Pajawanlor","Pamijahan","Pangkalan","Sidaraja","Sukadana","Sukaraja"]},
        "Cibeureum": {
            Desa: ["Cibeureum","Cimara","Kawungsari","Randusari","Sukadana","Sukarapih","Sumurwiru","Tarikolot"]},
        "Cibingbin": {
            Desa: ["Bantarpanjang","Ciangir","Cibingbin","Cipondok","Cisaat","Citenjo","Dukuhbadag","Sindangjawa","Sukaharja","Sukamaju"]},
        "Cidahu": {
            Desa: ["Bunder","Cibulan","Cidahu","Cieurih","Cihideunggirang","Ciheunghilir","Cikeusik","Datar","Jatimulya","Kertawinangun","Legok","Nanggela"]},
        "Cigandamekar" : {
            Desa: ["Babakanjati","Bunigeulis","Cibuntu","Jambugeulis","Karangmuncang","Koreak","Panawuan","Sangkanmulya","Sangkanurip","Timbang"]},    
        "Cigugur": {
            Kelurahan:["Cigadung","Cigugur","Cipari","Sukamulya","Winduherang"],
            Desa: ["Babakanmulya","Cileuleuy","Cisantana","Gunungkeling","Puncak"]},
        "Cilebak": {
            Desa: ["Bungurberes","Cilebak","Cilimusari","Jalatrang","Legokherang","Mandapajaya","Patala"]},
        "Cilimus": {
            Desa: ["Bandorasa kulon","Bandorasa wetan","Bojong","Caracas","Cibeureum","Cilimus","Kaliaren","Linggaindah","Lingarjati","Linggamekar","Sampora","Setianegara"]},
        "Cimahi": {
            Desa: ["Cikeusal","Cileuya","Cimahi","Cimulya","Gunungsari","Kananga","Margamukti","Mekarjaya","Mulyajaya","Sukajaya"]},
        "Ciniru": {
            Desa: ["Cijemit","Ciniru","Cipedes","Gunungmalik","Longklewang","Mungkaldatar","Pamupukan","Pinara","Rambatan"]},
        "Cipicung": {
            Desa: ["Cimaranten","Cipicung","Karoya","Mekarsari","Muncangela","Pamulihan","Salareuma","Sukamukti","Suganangan","Susukan"]},                                
        "Ciwaru":{
            Desa: ["Andamui","Baok","Cilayung","Citikur","Citundun","Ciwaru","Garajati","Karangbaru","Lebakherang","Linggajaya","Sagaranten","Sumberjaya"]},
        "Darma":{
            Desa:["Bakom","Cageur","Cikupa","Cimenga","Cipasung","Darma","Gunungsirah","Jagara","Karanganyar","Karangsari","Kawahmanuk","Paninggaran","Parung","Sagarahiang","Sakerta barat","Sakerta timur","Situsari","Sukarasa","Tugumulya"]},
        "Garawangi":{
            Desa:["Cikananga","Cirukem","Citiusari","Garawangi","Gewok","Kadatuan","Kramatwangi","Kutakembaran","Lengkong","Mancagar","Mekarmulya","Pakembangan","Purwasari","Sukaimut","Sukamulya","Tambakbaya","Tembong"]},
        "Hantara":{
            Desa:["Bunigeulis","Cikondang","Citapen","Hantara","Pakapasan","Girang","Hilir","Pasiragung","Tundagan"]},
        "Jalaksana":{
            Desa:["Babakanmulya","Ciniru","Jalaksana","Maniskidul","Manislor","Nanggerang","Padamenak","Peusing","Sadamatra","Sangkanerang","Sayana","Sembawa","Sidamulya","Sindangbarang","Sukamukti"]},
        "Japara":{
            Desa:["Cengal","Cikeleng","Citapen","Dukuhdalem","Garatengah","Japara","Kalimati","Rajadanu","Singkup","Wano"]},
        "Kadugede":{
            Desa:["Babatan","Bayuning","Ciherang","Ciketak","Cipondok","Cisukadana","Kadugede","Margabakti","Nangka","Sindangjawa","Tinggar","Windujanten"]},
        "Kalimanggis":{
            Desa:["Cipancur","Kalimanggis kulon","Kalimanggis wetan","Kertawana","Partawangunan","Wanasaraya"]},
        "Karangkancana":{
            Desa:["Cihanjoro","Jabranti","Kaduagung","Karangkancana","Margacina","Segong","Simpayjaya","Sukasari","Tanjungkerta"]},
        "Kramatmulya":{
            Desa:["Bojong","Cibentang","Cikaso","Cikubangsari","Cilaja","Ciloa","Gandasoli","Gereba","Kalapa gunung","Kramatmulya","Karangmangu","Pajambon","Ragawacana","Widasari"]},                                       
        "Kuningan":{
            Kelurahan: ["Awirarangan","Cigintung","Cijoho","Ciporang","Cirendang","Citangtu","Kuningan","Purwawinangun","Winduhaji","Windusengkahan"],
            Desa:["Ancaran","Cibinuang", "Karangtawang","Kasturi","Kedungarum","Padarek"]},
        "Lebakwangi":{
            Desa:["Bendungan","Cinagara","Cineumbeuy","Cipetir","Langseb","Lebakwangi","Mancagar","Manggari","Mekarwangi","Pagundan","Pajawankidul","Pasayangan","Sindang"]},
        "Luragung":{
            Desa:["Benda","Cigedang","Cikaduwetan","Cikandang","Cirahayu","Dukuhmaja","Dukuhpicung","Gunungkarung","Luragung landeuh","Luragung tonggoh","Margasari","Panyosongan","Sindangsari","Sindangsuka","Walaharcangeur","Wilanagara"]},
        "Maleber":{
            Desa:["Buniasih","Cikahuripan","Cipakem","Ciporang","Dukuhtengah","Galaherang","Garahaji","Giriwaringin","Karangtengah","Kutamandarakan","Kutaraja","Maleber","Mandalajaya","Mekarsari","Padamulya","Parakan"]},
        "Mandirancan":{
            Desa:["Cirea","Kertawinangun","Mandirancan","Nanggela","Nanggerangjaya","Pakembangan","Randobawagirang","Randobawailir","Salakadomas","Seda","Sukasari","Trijaya"]},
        "Nusaherang":{
            Desa:["Ciasih","Cikadu","Haurkuning","Jambar","Kertawirama","Kertayuga","Nusaherang","Windusari"]},
        "Pancalang":{
            Desa:["Danalampah","Kahiyangan","Mekarjaya","Pancalang","Patalagan","Rajawetan","Sarewu","Silebu","Sindang Kempeng","Sumbakeling","Tanjurbuntu","Tarikolot","Tenjolayar"]},
        "Pasawahan":{
            Desa:["Cibuntu","Cidahu","Cimara","Ciwiru","Kaduela","Padabeunghar","Padamatang","Paniis","Pasawahan","Singkup"]},
        "Selajambe":{
            Desa:["Bagawat","Cantilan","Ciberung","Jamberama","Kutawaringin","Padahurip","Selajambe"]},
        "Sindangagung":{
            Desa:["Babakanreuma","Balong","Dukuhlor","Kaduagung","Kertaungaran","Kertawangunan","Kertayasa","Mekarmukti","Sindangagung","Sindangsari","Taraju","Tirtawangunan"]},
        "Subang":{
            Desa:["Bangunjaya","Gunungaci","Jatisari","Pamulihan","Situgede","Subang","Tangkolo"]},                                   
    };
// Fungsi untuk memperbarui daftar desa/kelurahan berdasarkan kecamatan yang dipilih
function updateDesaKelurahan() {
    const kecamatanSelect = document.getElementById("kecamatan");
    const desaSelect = document.getElementById("desa");
    const kelurahanSelect = document.getElementById("kelurahan");
    
    const selectedKecamatan = kecamatanSelect.value;

    // Kosongkan pilihan desa dan kelurahan sebelumnya
    desaSelect.innerHTML = '<option value="">- Pilih Desa -</option>';
    kelurahanSelect.innerHTML = '<option value="">- Pilih Kelurahan -</option>';

    // Menonaktifkan elemen desa dan kelurahan jika tidak ada pilihan
    desaSelect.disabled = false;
    kelurahanSelect.disabled = false;

    // Jika kecamatan dipilih dan memiliki data
    if (selectedKecamatan && selectedKecamatan in desaData) {
        const data = desaData[selectedKecamatan];

        // Menambahkan Desa
        if (data.Desa && data.Desa.length > 0) {
            data.Desa.forEach(desa => {
                const option = document.createElement("option");
                option.value = desa;
                option.textContent = desa;
                desaSelect.appendChild(option);
            });
        }

        // Menambahkan Kelurahan
        if (data.Kelurahan && data.Kelurahan.length > 0) {
            data.Kelurahan.forEach(kelurahan => {
                const option = document.createElement("option");
                option.value = kelurahan;
                option.textContent = kelurahan;
                kelurahanSelect.appendChild(option);
            });
        }

        // Menonaktifkan desa atau kelurahan jika salah satu dipilih
        desaSelect.addEventListener('change', function() {
            if (desaSelect.value) {
                kelurahanSelect.disabled = true;  // Menonaktifkan kelurahan jika desa dipilih
            } else {
                kelurahanSelect.disabled = false; // Mengaktifkan kelurahan jika desa tidak dipilih
            }
        });

        kelurahanSelect.addEventListener('change', function() {
            if (kelurahanSelect.value) {
                desaSelect.disabled = true; // Menonaktifkan desa jika kelurahan dipilih
            } else {
                desaSelect.disabled = false; // Mengaktifkan desa jika kelurahan tidak dipilih
            }
        });
        
    } else {
        console.log("Data untuk kecamatan ini tidak ditemukan.");
    }
}
function validateForm() {
    const nik = document.getElementById('nik').value;
    const rt = document.getElementById('rt').value;
    const rw = document.getElementById('rw').value;
    const desa = document.getElementById('desa').value;
    const kelurahan = document.getElementById('kelurahan').value;
    let isValid = true;

    // Clear previous error messages
    document.getElementById('nik-error').textContent = '';
    document.getElementById('rt-error').textContent = '';
    document.getElementById('rw-error').textContent = '';

    // Validate NIK
    if (nik.length !== 16) {
        document.getElementById('nik-error').textContent = 'NIK harus terdiri dari 16 digit.👿';
        isValid = false;
    }

    // Validate RT
    if (rt.length !== 3) {
        document.getElementById('rt-error').textContent = 'RT harus terdiri dari 3 digit.👿';
        isValid = false;
    }

    // Validate RW
    if (rw.length !== 3) {
        document.getElementById('rw-error').textContent = 'RW harus terdiri dari 3 digit.👿';
        isValid = false;
    }

    // Validate Desa or Kelurahan
    if (!desa && !kelurahan) {
        alert('Silakan pilih salah satu: Desa atau Kelurahan.'); // Tampilkan alert jika keduanya kosong
        isValid = false;
    }

    return isValid;
}
</script>

<?php
if (isset($_POST['Simpan'])) {
    // Ambil data dari form
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tempat_lh = $_POST['tempat_lh'];
    $tgl_lh = $_POST['tgl_lh'];
    $jekel = $_POST['jekel'];
    $kecamatan = $_POST['kecamatan'];
    $desa = isset($_POST['desa']) ? $_POST['desa'] : ''; // Cek apakah ada
    $kelurahan = isset($_POST['kelurahan']) ? $_POST['kelurahan'] : ''; // Cek apakah ada
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $agama = $_POST['agama'];
    $kawin = $_POST['kawin'];
    $pekerjaan = $_POST['pekerjaan'];

    // Cek apakah NIK sudah ada di database
    $check_sql = "SELECT * FROM tb_pdd WHERE nik = '" . mysqli_real_escape_string($koneksi, $nik) . "'";
    $check_query = mysqli_query($koneksi, $check_sql);

    if (mysqli_num_rows($check_query) > 0) {
        // Jika NIK sudah ada, tampilkan pesan error
        echo "<script>
        Swal.fire({
            title: 'Gagal!',
            text: 'NIK sudah terdaftar. Silakan gunakan NIK yang lain😤',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    } else {
        // Cek apakah salah satu dari desa atau kelurahan diisi
        if (empty($desa) && empty($kelurahan)) {
            echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Silakan pilih salah satu: Desa atau Kelurahan.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
        } else {
            // Jika NIK belum ada dan salah satu dari desa atau kelurahan diisi, simpan data
            $sql_simpan = "INSERT INTO tb_pdd (nik, nama, tempat_lh, tgl_lh, jekel, kecamatan, desa, kelurahan, rt, rw, agama, kawin, pekerjaan, status) VALUES (
                '" . mysqli_real_escape_string($koneksi, $nik) . "',
                '" . mysqli_real_escape_string($koneksi, $nama) . "',
                '" . mysqli_real_escape_string($koneksi, $tempat_lh) . "',
                '" . mysqli_real_escape_string($koneksi, $tgl_lh) . "',
                '" . mysqli_real_escape_string($koneksi, $jekel) . "',
                '" . mysqli_real_escape_string($koneksi, $kecamatan) . "',
                '" . mysqli_real_escape_string($koneksi, $desa) . "',
                '" . mysqli_real_escape_string($koneksi, $kelurahan) . "',
                '" . mysqli_real_escape_string($koneksi, $rt) . "',
                '" . mysqli_real_escape_string($koneksi, $rw) . "',
                '" . mysqli_real_escape_string($koneksi, $agama) . "',
                '" . mysqli_real_escape_string($koneksi, $kawin) . "',
                '" . mysqli_real_escape_string($koneksi, $pekerjaan) . "',
                'Ada')";

            // Eksekusi query
            $query_simpan = mysqli_query($koneksi, $sql_simpan);

            // Tutup koneksi
            mysqli_close($koneksi);

            if ($query_simpan) {
                echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '?page=data-pend';
                });
                </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data gagal disimpan. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
            }
        }
    }
}
?>