<?php
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tb_kk WHERE id_kk='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<style>
    input, select {
        text-transform: uppercase;
    }
</style>

<div class="container">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fa fa-edit"></i> Ubah Data
            </h3>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">

                <!-- No Sistem -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No Sistem</label>
                    <div class="col-sm-3">
                        <input type='text' class="form-control" id="id_kk" name="id_kk" value="<?php echo $data_cek['id_kk']; ?>" readonly />
                    </div>
                </div>

                <!-- No KK -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No KK</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?php echo $data_cek['no_kk']; ?>" required />
                    </div>
                </div>

                <!-- Kepala Keluarga -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kpl Keluarga</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="kepala" name="kepala" value="<?php echo $data_cek['kepala']; ?>" readonly />
                    </div>
                </div>
                <!-- Kecamatan -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-6">
                        <select name="kec" id="kecamatan" class="form-control" onchange="updateDesaKelurahan()" required>
                            <option value="">- Pilih Kecamatan -</option>
                            <option value="Ciawigebang" <?php echo ($data_cek['kec'] == "Ciawigebang") ? "selected" : ""; ?>>Ciawigebang</option>
                            <option value="Cibeureum" <?php echo ($data_cek['kec'] == "Cibeureum") ? "selected" : ""; ?>>Cibeureum</option>
                            <option value="Cibingbin" <?php echo ($data_cek['kec'] == "Cibingbin") ? "selected" : ""; ?>>Cibingbin</option>
                            <option value="Cidahu" <?php echo ($data_cek['kec'] == "Cidahu") ? "selected" : ""; ?>>Cidahu</option>
                            <option value="Cigandamekar" <?php echo ($data_cek['kec'] == "Cigandamekar") ? "selected" : ""; ?>>Cigandamekar</option>
                            <option value="Cigugur" <?php echo ($data_cek['kec'] == "Cigugur") ? "selected" : ""; ?>>Cigugur</option>
                            <option value="Cilebak" <?php echo ($data_cek['kec'] == "Cilebak") ? "selected" : ""; ?>>Cilebak</option>
                            <option value="Cilimus" <?php echo ($data_cek['kec'] == "Cilimus") ? "selected" : ""; ?>>Cilimus</option>
                            <option value="Cimahi" <?php echo ($data_cek['kec'] == "Cimahi") ? "selected" : ""; ?>>Cimahi</option>
                            <option value="Ciniru" <?php echo ($data_cek['kec'] == "Ciniru") ? "selected" : ""; ?>> Ciniru</option>
                            <option value="Cipicung" <?php echo ($data_cek['kec'] == "Cipicung") ? "selected" : ""; ?>>Cipicung</option>
                            <option value="Ciwaru" <?php echo ($data_cek['kec'] == "Ciwaru") ? "selected" : ""; ?>>Ciwaru</option>
                            <option value="Darma" <?php echo ($data_cek['kec'] == "Darma") ? "selected" : ""; ?>>Darma</option>
                            <option value="Garawangi" <?php echo ($data_cek['kec'] == "Garawangi") ? "selected" : ""; ?>>Garawangi</option>
                            <option value="Hantara" <?php echo ($data_cek['kec'] == "Hantara") ? "selected" : ""; ?>>Hantara</option>
                            <option value="Jalaksana" <?php echo ($data_cek['kec'] == "Jalaksana") ? "selected" : ""; ?>>Jalaksana</option>
                            <option value="Japara" <?php echo ($data_cek['kec'] == "Japara") ? "selected" : ""; ?>>Japara</option>
                            <option value="Kadugede" <?php echo ($data_cek['kec'] == "Kadugede") ? "selected" : ""; ?>>Kadugede</option>
                            <option value="Kalimanggis" <?php echo ($data_cek['kec'] == "Kalimanggis") ? "selected" : ""; ?>>Kalimanggis</option>
                            <option value="Karangkancana" <?php echo ($data_cek['kec'] == "Karangkancana") ? "selected" : ""; ?>>Karangkancana</option>
                            <option value="Kramatmulya" <?php echo ($data_cek['kec'] == "Kramatmulya") ? "selected" : ""; ?>>Kramatmulya</option>
                            <option value="Kuningan" <?php echo ($data_cek['kec'] == "Kuningan") ? "selected" : ""; ?>>Kuningan</option>
                            <option value="Lebakwangi" <?php echo ($data_cek['kec'] == "Lebakwangi") ? "selected" : ""; ?>>Lebakwangi</option>
                            <option value="Luragung" <?php echo ($data_cek['kec'] == "Luragung") ? "selected" : ""; ?>>Luragung</option>
                            <option value="Maleber" <?php echo ($data_cek['kec'] == "Maleber") ? "selected" : ""; ?>>Maleber</option>
                            <option value="Mandirancan" <?php echo ($data_cek['kec'] == "Mandirancan") ? "selected" : ""; ?>>Mandirancan</option>
                            <option value="Nusaherang" <?php echo ($data_cek['kec'] == "Nusaherang") ? "selected" : ""; ?>>Nusaherang</option>
                            <option value="Pancalang" <?php echo ($data_cek['kec'] == "Pancalang") ? "selected" : ""; ?>>Pancalang</option>
                            <option value="Pasawahan" <?php echo ($data_cek['kec'] == "Pasawahan") ? "selected" : ""; ?>>Pasawahan</option>
                            <option value="Selajambe" <?php echo ($data_cek['kec'] == "Selajambe") ? "selected" : ""; ?>>Selajambe</option>
                            <option value="Subang" <?php echo ($data_cek['kec'] == "Subang") ? "selected" : ""; ?>>Subang</option>
                            </select>
                    </div>
                </div>

           <!-- Desa -->
<!-- Desa -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Desa</label>
    <div class="col-sm-6">
        <select name="desa" id="desa" class="form-control" data-selected="<?php echo $data_cek['desa']; ?>">
            <option value="">- Pilih Desa -</option>
            <?php 
            if (isset($desaData[$data_cek['kec']])) {
                foreach ($desaData[$data_cek['kec']]['Desa'] as $desa) : ?>
                    <option value="<?= $desa ?>" <?php echo ($desa == $data_cek['desa']) ? "selected" : ""; ?>>
                        <?= $desa ?>
                    </option>
                <?php endforeach; 
            } ?>
        </select>
    </div>
</div>

<!-- Kelurahan -->
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-6">
        <select name="kelurahan" id="kelurahan" class="form-control" data-selected="<?php echo $data_cek['kelurahan']; ?>">
            <option value="">- Pilih Kelurahan -</option>
            <?php 
            if (isset($kelurahanData[$data_cek['kec']])) {
                foreach ($kelurahanData[$data_cek['kec']]['Kelurahan'] as $kelurahan) : ?>
                    <option value="<?= $kelurahan ?>" <?php echo ($kelurahan == $data_cek['kelurahan']) ? "selected" : ""; ?>>
                        <?= $kelurahan ?>
                    </option>
                <?php endforeach; 
            } ?>
        </select>
    </div>
</div>
                <!-- RT/RW -->
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

           
        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-kartu" title="Kembali" class="btn btn-secondary">BATAL</a>
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

    // Ambil nilai data sebelumnya
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
    }

    // Logika untuk menonaktifkan desa atau kelurahan berdasarkan pilihan sebelumnya
    if (previousKelurahan) {
        desaSelect.disabled = true; // Nonaktifkan desa jika kelurahan dipilih sebelumnya
    } else if (previousDesa) {
        kelurahanSelect.disabled = true; // Nonaktifkan kelurahan jika desa dipilih sebelumnya
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
</script>

<?php
if (isset($_POST['Ubah'])) {
    // Cek jika 'kecamatan' ada dalam POST
    if (!isset($_POST['kec'])) {
        echo "Field kecamatan tidak ada!";
        exit;
    }

    // Ambil dan sanitasi input
    $no_kk = mysqli_real_escape_string($koneksi, $_POST['no_kk']);
    $kepala = mysqli_real_escape_string($koneksi, $_POST['kepala']);
    $kecamatan = mysqli_real_escape_string($koneksi, $_POST['kec']);
    $desa = isset($_POST['desa']) ? mysqli_real_escape_string($koneksi, $_POST['desa']) : ''; // Ambil desa
    $kelurahan = isset($_POST['kelurahan']) ? mysqli_real_escape_string($koneksi, $_POST['kelurahan']) : ''; // Ambil kelurahan
    $rt = mysqli_real_escape_string($koneksi, $_POST['rt']);
    $rw = mysqli_real_escape_string($koneksi, $_POST['rw']);


// Lanjutkan dengan query SQL untuk tabel tb_kk
$sql_ubah_kk = "UPDATE tb_kk SET 
no_kk='$no_kk',
kepala='$kepala',
kec='$kecamatan',
desa='$desa',
kelurahan='$kelurahan',
rt='$rt',
rw='$rw'
WHERE no_kk='$no_kk'"; // Menggunakan id_kk sebagai kriteria

$query_ubah_kk = mysqli_query($koneksi, $sql_ubah_kk);

// Cek apakah kedua query berhasil
if ($query_ubah_kk) {
echo "<script>
Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
}).then((result) => {if (result.value)
    {window.location = 'index.php?page=data-kartu';
    }
})</script>";
} else {
echo "<script>
Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
}).then((result) => { if (result.value) {
    window.location = 'index.php?page=data-kartu';
}
})</script>";
}

mysqli_close($koneksi);
}
?>