<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_pdd WHERE id_pend='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
	
}
?>
<style>
    input, select {
        text-transform: uppercase;
    }
</style>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <!-- memperbarui data pengguna -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Sistem</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id_pend" name="id_pend" value="<?php echo $data_cek['id_pend']; ?>" readonly />
                </div>
            </div>

            <div class="form-group row">
    <label class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-6">
        <input type="hidden" name="nik" value="<?php echo strtoupper($data_cek['nik']); ?>" />
        <input type="text" class="form-control" value="<?php echo strtoupper($data_cek['nik']); ?>" readonly />
    </div>
</div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo strtoupper($data_cek['nama']); ?>" required />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">TTL</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="tempat_lh" name="tempat_lh" value="KUNINGAN" readonly />
                </div>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="tgl_lh" name="tgl_lh" value="<?php echo $data_cek['tgl_lh']; ?>" required />
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
    <label class="col-sm-2 col-form-label">Kecamatan</label>
    <div class="col-sm-6">
    <select name="kecamatan" id="kecamatan" class="form-control" onchange="updateDesaKelurahan()" required>
		<option value="">- Pilih Kecamatan -</option>
                        <option value="Ciawigebang" <?php echo ($data_cek['kecamatan'] == "Ciawigebang") ? "selected" : ""; ?>>Ciawigebang</option>
						<option value="Cibeureum" <?php echo ($data_cek['kecamatan'] == "Cibeureum") ? "selected" : ""; ?>>Cibeureum</option>
                        <option value="Cibingbin"<?php echo ($data_cek['kecamatan'] == "Cibingbin") ? "selected" : ""; ?>>Cibingbin</option>
                        <option value="Cidahu"<?php echo ($data_cek['kecamatan'] == "Cidahu") ? "selected" : ""; ?>>Cidahu</option>
                        <option value="Cigandamekar"<?php echo ($data_cek['kecamatan'] == "Cigandamekar") ? "selected" : ""; ?>>Cigandamekar</option>
                        <option value="Cigugur"<?php echo ($data_cek['kecamatan'] == "Cigugur") ? "selected" : ""; ?>>Cigugur</option>
                        <option value="Cilebak"<?php echo ($data_cek['kecamatan'] == "Cilebak") ? "selected" : ""; ?>>Cilebak</option>
                        <option value="Cilimus"<?php echo ($data_cek['kecamatan'] == "Cilimus") ? "selected" : ""; ?>>Cilimus</option>
                        <option value="Cimahi"<?php echo ($data_cek['kecamatan'] == "Cimahi") ? "selected" : ""; ?>>Cimahi</option>
                        <option value="Ciniru"<?php echo ($data_cek['kecamatan'] == "Ciniru") ? "selected" : ""; ?>>Ciniru</option>
                        <option value="Cipicung"<?php echo ($data_cek['kecamatan'] == "Cipicung") ? "selected" : ""; ?>>Cipicung</option>
                        <option value="Ciwaru"<?php echo ($data_cek['kecamatan'] == "Ciwaru") ? "selected" : ""; ?>>Ciwaru</option>
                        <option value="Darma"<?php echo ($data_cek['kecamatan'] == "Darma") ? "selected" : ""; ?>>Darma</option>
                        <option value="Garawangi"<?php echo ($data_cek['kecamatan'] == "Garawangi") ? "selected" : ""; ?>>Garawangi</option>
                        <option value="Hantara"<?php echo ($data_cek['kecamatan'] == "Hantara") ? "selected" : ""; ?>>Hantara</option>
						<option value="Jalaksana" <?php echo ($data_cek['kecamatan'] == "Jalaksana") ? "selected" : ""; ?>>Jalaksana</option>
                        <option value="Japara"<?php echo ($data_cek['kecamatan'] == "Japara") ? "selected" : ""; ?>>Japara</option>
                        <option value="Kadugede"<?php echo ($data_cek['kecamatan'] == "Kadugede") ? "selected" : ""; ?>>Kadugede</option>
                        <option value="Kalimanggis"<?php echo ($data_cek['kecamatan'] == "Kalimanggis") ? "selected" : ""; ?>>Kalimanggis</option>
                        <option value="Karangkancana"<?php echo ($data_cek['kecamatan'] == "Karangkancana") ? "selected" : ""; ?>>Karangkancana</option>
                        <option value="Kramatmulya"<?php echo ($data_cek['kecamatan'] == "Kramatmulya") ? "selected" : ""; ?>>Kramatmulya</option>
                        <option value="Kuningan"<?php echo ($data_cek['kecamatan'] == "Kuningan") ? "selected" : ""; ?>>Kuningan</option>
                        <option value="Lebakwangi"<?php echo ($data_cek['kecamatan'] == "Lebakwangi") ? "selected" : ""; ?>>Lebakwangi</option>
                        <option value="Luragung"<?php echo ($data_cek['kecamatan'] == "Luragung") ? "selected" : ""; ?>>Luragung</option>
                        <option value="Maleber"<?php echo ($data_cek['kecamatan'] == "Maleber") ? "selected" : ""; ?>>Maleber</option>
                        <option value="Mandirancan"<?php echo ($data_cek['kecamatan'] == "Mandirancan") ? "selected" : ""; ?>>Mandirancan</option>
                        <option value="Nusaherang"<?php echo ($data_cek['kecamatan'] == "Nusaherang") ? "selected" : ""; ?>>Nusaherang</option>
                        <option value="Pancalang"<?php echo ($data_cek['kecamatan'] == "Pancalang") ? "selected" : ""; ?>>Pancalang</option>
                        <option value="Pasawahan"<?php echo ($data_cek['kecamatan'] == "Pasawahan") ? "selected" : ""; ?>>Pasawahan</option>
                        <option value="Selajambe"<?php echo ($data_cek['kecamatan'] == "Selajambe") ? "selected" : ""; ?>>Selajambe</option>
                        <option value="Subang"<?php echo ($data_cek['kecamatan'] == "Subang") ? "selected" : ""; ?>>Subang</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Desa</label>
    <div class="col-sm-6">
        <select name="desa" id="desa" class="form-control" data-selected="<?php echo $data_cek['desa']; ?>" required>
            <option value="">- Pilih Desa -</option>
            <?php foreach ($desaData as $desa): ?>
                <option value="<?= $desa ?>" <?php echo ($desa == $data_cek['desa']) ? "selected" : ""; ?>>
                    <?= $desa ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-6">
        <select name="kelurahan" id="kelurahan" class="form-control" data-selected="<?php echo $data_cek['kelurahan']; ?>" required>
            <option value="">- Pilih Kelurahan -</option>
            <?php foreach ($kelurahanData as $kelurahan): ?>
                <option value="<?= $kelurahan ?>" <?php echo ($kelurahan == $data_cek['kelurahan']) ? "selected" : ""; ?>>
                    <?= $kelurahan ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>



			<div class="form-group row">
    <label class="col-sm-2 col-form-label">RT</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" id="rt" name="rt" value="<?php echo strtoupper($data_cek['rt']); ?>" maxlength="3" required pattern="\d{3}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
    </div>
    <label class="col-sm-1 col-form-label">RW</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" id="rw" name="rw" value="<?php echo strtoupper($data_cek['rw']); ?>" maxlength="3" required pattern="\d{3}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
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
                <label class="col-sm-2 col-form-label">Status Perkawinan</label>
                <div class="col-sm-3">
                    <select name="kawin" id="kawin" class="form-control">
                        <option value="">-- Pilih Status --</option>
                        <option value="Sudah" <?php echo ($data_cek['kawin'] == "Sudah") ? "selected" : ""; ?>>SUDAH</option>
                        <option value="Belum" <?php echo ($data_cek['kawin'] == "Belum") ? "selected" : ""; ?>>BELUM</option>
                        <option value="Cerai Mati" <?php echo ($data_cek['kawin'] == "Cerai Mati") ? "selected" : ""; ?>>CERAI MATI</option>
                        <option value="Cerai Hidup" <?php echo ($data_cek['kawin'] == "Cerai Hidup") ? "selected" : ""; ?>>CERAI HIDUP</option>
                    </select>
                </div>
            </div>
			

            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Pekerjaan</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo strtoupper($data_cek['pekerjaan']); ?>" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" />
    </div>
</div>


        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-pend" title="Kembali" class="btn btn-secondary">BATAL</a>
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
    function updateDesaKelurahan() {
    const kecamatanSelect = document.getElementById("kecamatan");
    const desaSelect = document.getElementById("desa");
    const kelurahanSelect = document.getElementById("kelurahan");

    const selectedKecamatan = kecamatanSelect.value;

    // Ambil nilai data sebelumnya (misal dari hidden input atau atribut dataset)
    const previousDesa = desaSelect.getAttribute("data-selected") || "";
    const previousKelurahan = kelurahanSelect.getAttribute("data-selected") || "";

    // Kosongkan pilihan desa dan kelurahan sebelumnya
    desaSelect.innerHTML = '<option value="">- Pilih Desa -</option>';
    kelurahanSelect.innerHTML = '<option value="">- Pilih Kelurahan -</option>';

    // Menonaktifkan elemen desa dan kelurahan
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

                // Pilih otomatis desa sebelumnya jika ada
                if (desa === previousDesa) {
                    option.selected = true;
                }
            });
        }

        // Menambahkan Kelurahan
        if (data.Kelurahan && data.Kelurahan.length > 0) {
            data.Kelurahan.forEach(kelurahan => {
                const option = document.createElement("option");
                option.value = kelurahan;
                option.textContent = kelurahan;
                kelurahanSelect.appendChild(option);

                // Pilih otomatis kelurahan sebelumnya jika ada
                if (kelurahan === previousKelurahan) {
                    option.selected = true;
                }
            });
        }

        // Atur status aktif/nonaktif berdasarkan data sebelumnya
        if (previousDesa) {
            kelurahanSelect.disabled = true; // Nonaktifkan kelurahan jika desa dipilih sebelumnya
        } else if (previousKelurahan) {
            desaSelect.disabled = true; // Nonaktifkan desa jika kelurahan dipilih sebelumnya
        }
    }

    // Event listener untuk desa
    desaSelect.addEventListener('change', function() {
        if (desaSelect.value) {
            kelurahanSelect.disabled = true; // Nonaktifkan kelurahan jika desa dipilih
        } else {
            kelurahanSelect.disabled = false; // Aktifkan kelurahan jika desa tidak dipilih
        }
    });

    // Event listener untuk kelurahan
    kelurahanSelect.addEventListener('change', function() {
        if (kelurahanSelect.value) {
            desaSelect.disabled = true; // Nonaktifkan desa jika kelurahan dipilih
        } else {
            desaSelect.disabled = false; // Aktifkan desa jika kelurahan tidak dipilih
        }
    });
}

// Panggil fungsi updateDesaKelurahan saat halaman dimuat
window.onload = function() {
    updateDesaKelurahan();
};



    function validateForm() {
    const rt = document.getElementById('rt').value;
    const rw = document.getElementById('rw').value;
    let isValid = true;

    // Clear previous error messages
    document.getElementById('rt-error').textContent = '';
    document.getElementById('rw-error').textContent = '';
    
    // Hide previous error messages
    document.getElementById('rt-error').style.display = 'none';
    document.getElementById('rw-error').style.display = 'none';

    // Validate RT
    if (rt.length !== 3) {
        document.getElementById('rt-error').textContent = 'RT harus terdiri dari 3 digit.👿';
        document.getElementById('rt-error').style.display = 'block'; // Show error message
        isValid = false;
    }

    // Validate RW
    if (rw.length !== 3) {
        document.getElementById('rw-error').textContent = 'RW harus terdiri dari 3 digit.👿';
        document.getElementById('rw-error').style.display = 'block'; // Show error message
        isValid = false;
    }

    return isValid;
}

</script>


<?php
if (isset($_POST['Ubah'])) {
    // Validasi RT, RW
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
     // Sanitasi input lainnya
     $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
     $tgl_lh = mysqli_real_escape_string($koneksi, $_POST['tgl_lh']);
     $jekel = mysqli_real_escape_string($koneksi, $_POST['jekel']);
     $desa = !empty($_POST['desa']) ? "'" . mysqli_real_escape_string($koneksi, $_POST['desa']) . "'" : "NULL";
     $kelurahan = !empty($_POST['kelurahan']) ? "'" . mysqli_real_escape_string($koneksi, $_POST['kelurahan']) . "'" : "NULL";     
     $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
     $kawin = mysqli_real_escape_string($koneksi, $_POST['kawin']);
     $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
   if (strlen($rt) !== 3) {
        echo "<script>alert('RT harus 3 digit. Silakan periksa kembali.');</script>";
    } elseif (strlen($rw) !== 3) {
        echo "<script>alert('RW harus 3 digit. Silakan periksa kembali.');</script>";
    } else {
       // Query Update
    $sql_ubah = "UPDATE tb_pdd SET 
    nama='$nama',
    tempat_lh='KUNINGAN',
    tgl_lh='$tgl_lh',
    jekel='$jekel',
    kecamatan='" . mysqli_real_escape_string($koneksi, $_POST['kecamatan']) . "',
    desa=$desa,
    kelurahan=$kelurahan,
    rt='$rt',
    rw='$rw',
    agama='$agama',
    kawin='$kawin',
    pekerjaan='$pekerjaan'
    WHERE id_pend='" . mysqli_real_escape_string($koneksi, $_POST['id_pend']) . "'";

    
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    
    if ($query_ubah) {
        echo "Data berhasil diperbarui";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
    


        if ($query_ubah) {
            echo "<script>
                Swal.fire({
                    title: 'Ubah Data Berhasil',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'index.php?page=data-pend';
                    }
                });
            </script>";
        } else {
            echo "<script>alert('Ubah Data Gagal!');</script>";
        }
    }
}
?>
