<style>
    input, select {
        text-transform: uppercase;
    }
</style>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

        <div class="form-group row">
    <label class="col-sm-2 col-form-label">No KK</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="no_kk" name="no_kk" placeholder="No KK (16 digit)" required maxlength="16" 
               oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="No KK harus terdiri dari 16 digit dan hanya angka">
        <small id="noKKError" class="text-danger" style="display:none;">* No KK harus diisi 16 digit</small>
    </div>
</div>

          <!-- Dropdown untuk memilih kepala keluarga -->
          <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kepala Keluarga</label>
    <div class="col-sm-6">
        <select class="form-control" id="kepala" name="kepala" required>
            <option value="">Pilih Kepala Keluarga</option> <!-- Opsi default -->
            <?php
                // Query untuk mengambil nama yang belum pernah digunakan sebagai kepala keluarga
                $sql_kepala = "
                    SELECT nama 
                    FROM tb_pdd 
                    WHERE nama NOT IN (
                        SELECT kepala FROM tb_kk
                    )
                ";
                $result_kepala = mysqli_query($koneksi, $sql_kepala);

                // Mengecek apakah query berhasil
                if ($result_kepala) {
                    // Mengisi dropdown dengan data dari database
                    while ($row = mysqli_fetch_assoc($result_kepala)) {
                        // Menampilkan nama sebagai value dan juga teks
                        echo "<option value='{$row['nama']}'>{$row['nama']}</option>";
                    }
                } else {
                    echo "<option value=''>Data tidak tersedia</option>"; // Menampilkan opsi jika query gagal
                }
            ?>
        </select>
    </div>
</div>



            <!-- Dropdown untuk memilih Kecamatan -->
            <div class="form-group row">
    <label class="col-sm-2 col-form-label">Kecamatan</label>
    <div class="col-sm-6">
    <select name="kec" id="kecamatan" class="form-control" onchange="updateDesaKelurahan()" required>
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

            <div class="form-group row" id="desa-container">
    <label class="col-sm-2 col-form-label">Desa</label>
    <div class="col-sm-6">
        <select name="desa" id="desa" class="form-control" required>
            <option value="">- Pilih Desa -</option>
        </select>
    </div>
</div>

<!-- Pilih Kelurahan -->
<div class="form-group row" id="kelurahan-container">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-6">
        <select name="kelurahan" id="kelurahan" class="form-control" required>
            <option value="">- Pilih Kelurahan -</option>
        </select>
    </div>
    </div>

            <div class="form-group row">
    <label class="col-sm-2 col-form-label">RT/RW</label>
    <div class="col-sm-3">
        <input type="text" class="form-control" id="rt" name="rt" placeholder="RT (3 digit)" required maxlength="3" 
               oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="RT harus terdiri dari 3 digit dan hanya angka">
        <small id="rtError" class="text-danger" style="display:none;">* RT harus diisi 3 digit</small>
    </div>
    <div class="col-sm-3">
        <input type="text" class="form-control" id="rw" name="rw" placeholder="RW (3 digit)" required maxlength="3" 
               oninput="this.value = this.value.replace(/[^0-9]/g, '');" title="RW harus terdiri dari 3 digit dan hanya angka">
        <small id="rwError" class="text-danger" style="display:none;">* RW harus diisi 3 digit</small>
    </div>
</div>


        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-kartu" title="Kembali" class="btn btn-secondary">Batal</a>
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
        var noKK = document.getElementById("no_kk").value;
        var rt = document.getElementById("rt").value;
        var rw = document.getElementById("rw").value;
        var noKKError = document.getElementById("noKKError");
        var rtError = document.getElementById("rtError");
        var rwError = document.getElementById("rwError");
        var isValid = true;

        // Validasi No KK
        if (noKK.length !== 16) {
            noKKError.style.display = "block";  // Tampilkan pesan error No KK
            isValid = false;
        } else {
            noKKError.style.display = "none";  // Sembunyikan pesan error No KK jika valid
        }

        // Validasi RT
        if (rt.length !== 3) {
            rtError.style.display = "block";  // Tampilkan pesan error RT
            isValid = false;
        } else {
            rtError.style.display = "none";  // Sembunyikan pesan error RT jika valid
        }

        // Validasi RW
        if (rw.length !== 3) {
            rwError.style.display = "block";  // Tampilkan pesan error RW
            isValid = false;
        } else {
            rwError.style.display = "none";  // Sembunyikan pesan error RW jika valid
        }

        return isValid;  // Return true hanya jika semua validasi lolos
    }

    // Event listener untuk validasi saat form disubmit
    document.querySelector("form").addEventListener("submit", function(e) {
        if (!validateForm()) {
            e.preventDefault();  // Mencegah submit jika validasi gagal
        }
    });
</script>

<?php
if (isset($_POST['Simpan'])) {
    // Ambil data dari form
    $no_kk = $_POST['no_kk'];
    $kepala = $_POST['kepala'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $kec = $_POST['kec'];
    
    // Cek apakah kelurahan diisi
    $kelurahan = !empty($_POST['kelurahan']) ? $_POST['kelurahan'] : NULL; // Jika tidak diisi, set ke NULL
    $desa = !empty($_POST['desa']) ? $_POST['desa'] : NULL; // Jika tidak diisi, set ke NULL

    // Cek apakah No KK sudah ada di database
    $sql_check_no_kk = "SELECT * FROM tb_kk WHERE no_kk='$no_kk'";
    $result_check_no_kk = mysqli_query($koneksi, $sql_check_no_kk);

    if (mysqli_num_rows($result_check_no_kk) > 0) {
        // Jika No KK sudah ada, tampilkan pesan kesalahan
        echo "<script>
        Swal.fire({title: 'No KK sudah terdaftar!',text: '',icon: 'error',confirmButtonText: 'OK'
        })</script>";
    } else {
        // Jika No KK belum ada, lanjutkan untuk menyimpan data
        if (!empty($kelurahan)) {
            // Jika kelurahan diisi, simpan kelurahan dan kosongkan desa
            $sql_simpan = "INSERT INTO tb_kk (no_kk, kepala, desa, rt, rw, kec, kelurahan) VALUES (
                '$no_kk',
                '$kepala',
                NULL,  -- Kosongkan desa
                '$rt',
                '$rw',
                '$kec',
                '$kelurahan')";
        } else {
            // Jika kelurahan tidak diisi, simpan desa dan kosongkan kelurahan
            $sql_simpan = "INSERT INTO tb_kk (no_kk, kepala, desa, rt, rw, kec, kelurahan) VALUES (
                '$no_kk',
                '$kepala',
                '$desa',  -- Simpan desa
                '$rt',
                '$rw',
                '$kec',
                NULL)";  // Kosongkan kelurahan
        }

        // Eksekusi query untuk menyimpan data kepala keluarga
        $query_simpan = mysqli_query($koneksi, $sql_simpan);

        // Jika penyimpanan kepala keluarga berhasil, lanjutkan untuk menyimpan anggota
        if ($query_simpan) {
            // Ambil id_kk yang baru saja disimpan
            $id_kk = mysqli_insert_id($koneksi);

            // Ambil id_pend berdasarkan nama kepala keluarga
            $sql_pdd = "SELECT id_pend FROM tb_pdd WHERE nama='$kepala'";
            $result_pdd = mysqli_query($koneksi, $sql_pdd);
            $row_pdd = mysqli_fetch_assoc($result_pdd);

            // Pastikan untuk memeriksa apakah hasilnya ada
            if ($row_pdd) {
                $id_pend = $row_pdd['id_pend']; // Menggunakan 'id_pend' yang benar
            } else {
                echo "<script>
                Swal.fire({title: 'Kepala keluarga tidak ditemukan!',text: '',icon: 'error',confirmButtonText: 'OK'
                })</script>";
            }

            // Tampilkan pesan sukses dan arahkan kembali ke halaman data
            echo "<script>
            Swal.fire({
                title: 'Data berhasil disimpan!',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?page=data-kartu'; // Arahkan ke halaman data-kartu
                }
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal menyimpan kepala keluarga!',text: '',icon: 'error',confirmButtonText: 'OK'
            }) </script>";
        }
    }
}
?>