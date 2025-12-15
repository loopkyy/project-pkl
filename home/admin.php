<?php
// Mengambil jumlah penduduk dengan status "Ada"
$sql = $koneksi->query("SELECT COUNT(id_pend) as pend FROM tb_pdd WHERE status='Ada'");
while ($data = $sql->fetch_assoc()) {
    $pend = $data['pend'];
}

// Mengambil jumlah kartu keluarga
$sql = $koneksi->query("SELECT COUNT(id_kk) as kartu FROM tb_kk");
while ($data = $sql->fetch_assoc()) {
    $kartu = $data['kartu'];
}

// Mengambil jumlah kelahiran
$sql = $koneksi->query("SELECT COUNT(id_lahir) as lahir FROM tb_lahir");
while ($data = $sql->fetch_assoc()) {
    $lahir = $data['lahir'];
}

// Mengambil jumlah kematian
$sql = $koneksi->query("SELECT COUNT(id_mendu) as mendu FROM tb_mendu");
while ($data = $sql->fetch_assoc()) {
    $mendu = $data['mendu'];
}
?>

<div class="row">
    <!-- Jumlah Penduduk -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $pend; ?></h3>
                <p>Penduduk</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <?php if ($data_level == "Administrator") { ?>
                <a href="index.php?page=data-pend" class="small-box-footer">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } else { ?>
                <a href="#" class="small-box-footer" style="pointer-events: none; cursor: default;">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- Jumlah Kartu Keluarga -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $kartu; ?></h3>
                <p>Kartu Keluarga</p>
            </div>
            <div class="icon">
                <i class="ion ion-card"></i>
            </div>
            <?php if ($data_level == "Administrator") { ?>
                <a href="index.php?page=data-kartu" class="small-box-footer">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } else { ?>
                <a href="#" class="small-box-footer" style="pointer-events: none; cursor: default;">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- Jumlah Kelahiran -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $lahir; ?></h3>
                <p>Lahir</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
            <?php if ($data_level == "Administrator") { ?>
                <a href="index.php?page=data-lahir" class="small-box-footer">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } else { ?>
                <a href="#" class="small-box-footer" style="pointer-events: none; cursor: default;">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } ?>
        </div>
    </div>

    <!-- Jumlah Kematian -->
    <div class="col-lg-3 col -6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $mendu; ?></h3>
                <p>Meninggal</p>
            </div>
            <div class="icon">
                <i class="fas fa-skull"></i>
            </div>
            <?php if ($data_level == "Administrator") { ?>
                <a href="index.php?page=data-mendu" class="small-box-footer">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } else { ?>
                <a href="#" class="small-box-footer" style="pointer-events: none; cursor: default;">Selengkapnya
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Tambahkan CDN Plotly.js -->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<!-- Area untuk Grafik -->
<div class="row mt-4">
    <!-- Grafik 1: Bar Chart -->
    <div class="col-lg-4 col-md-4 col-12">
        <div id="barChart" style="width: 100%; height: 300px;"></div>
    </div>
    <!-- Grafik 2: Line Chart -->
    <div class="col-lg-4 col-md-4 col-12">
        <div id="lineChart" style="width: 100%; height: 300px;"></div>
    </div>
    <!-- Grafik 3: Pie Chart -->
    <div class="col-lg-4 col-md-4 col-12">
        <div id="pieChart" style="width: 100%; height: 300px;"></div>
    </div>
</div>

<script>
    // Grafik Bar
    var barData = [{
        x: ['Penduduk', 'Kartu Keluarga', 'Lahir', 'Meninggal'],
        y: [<?php echo $pend; ?>, <?php echo $kartu; ?>, <?php echo $lahir; ?>, <?php echo $mendu; ?>],
        type: 'bar',
        marker: {
            color: ['rgba(54, 162, 235, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(255, 99, 132, 0.7)']
        }
    }];

    var barLayout = {
        title: 'Grafik Bar',
        xaxis: { title: 'Kategori' },
        yaxis: { title: 'Jumlah' }
    };

    Plotly.newPlot('barChart', barData, barLayout);

    // Grafik Line
    var lineData = [{
        x: ['Penduduk', 'Kartu Keluarga', 'Lahir', 'Meninggal'],
        y: [<?php echo $pend; ?>, <?php echo $kartu; ?>, <?php echo $lahir; ?>, <?php echo $mendu; ?>],
        mode: 'lines+markers',
        type: 'scatter',
        marker: { size: 5 },
        line: { width: 2 }
    }];

    var lineLayout = {
        title: 'Grafik Line',
        xaxis: { title: 'Kategori' },
        yaxis: { title: 'Jumlah' }
    };

    Plotly.newPlot('lineChart', lineData, lineLayout);

    // Grafik Pie
    var pieData = [{
        labels: ['Penduduk', 'Kartu Keluarga', 'Lahir', 'Meninggal'],
        values: [<?php echo $pend; ?>, <?php echo $kartu; ?>, <?php echo $lahir; ?>, <?php echo $mendu; ?>],
        type: 'pie'
    }];

    var pieLayout = {
        title: 'Grafik Pie'
    };

    Plotly.newPlot('pieChart', pieData, pieLayout);
</script>