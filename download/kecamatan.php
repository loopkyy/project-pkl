<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data kecamatan yang memiliki data di tb_pdd
$sql_kecamatan = $koneksi->query("SELECT DISTINCT kecamatan FROM tb_pdd WHERE kecamatan IS NOT NULL AND kecamatan != ''");
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Pilih Kecamatan untuk Desa dan Kelurahan
        </h3>
    </div>
    <div class="card-body">
        <form id="kecamatanForm">
            <div class="form-group">
                <label for="kecamatan">Pilih Kecamatan:</label>
                <select id="kecamatan" name="kecamatan" class="form-control">
                    <option value="">-- Pilih Kecamatan --</option>
                    <?php while ($data = $sql_kecamatan->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($data['kecamatan']); ?>">
                            <?php echo strtoupper(htmlspecialchars($data['kecamatan'])); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-success" onclick="goToDesa()">
                    <i class="fa fa-home"></i> Ke Desa
                </button>
                <button type="button" class="btn btn-info" onclick="goToKelurahan()">
                    <i class="fa fa-building"></i> Ke Kelurahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function goToDesa() {
        const kecamatanSelect = document.getElementById('kecamatan');
        const selectedKecamatan = kecamatanSelect.value;

        if (selectedKecamatan) {
            const url = 'index.php?page=desa&kecamatan=' + encodeURIComponent(selectedKecamatan);
            console.log('Redirecting to:', url); // Debugging
            window.location.href = url;
        } else {
            alert('Silakan pilih kecamatan terlebih dahulu.');
        }
    }

    function goToKelurahan() {
        const kecamatanSelect = document.getElementById('kecamatan');
        const selectedKecamatan = kecamatanSelect.value;

        if (selectedKecamatan) {
            const url = 'index.php?page=kelurahan&kecamatan=' + encodeURIComponent(selectedKecamatan);
            console.log('Redirecting to:', url); // Debugging
            window.location.href = url;
        } else {
            alert('Silakan pilih kecamatan terlebih dahulu.');
        }
    }
</script>