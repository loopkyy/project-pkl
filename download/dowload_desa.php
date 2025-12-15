<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Bersihkan semua output sebelum header
if (ob_get_length()) {
    ob_end_clean();
}

// Mulai output buffering
ob_start();

require_once('admin/TCPDF/tcpdf.php'); // Pastikan path ini benar

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "penduduk_data");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil parameter kode dari URL dan sanitasi input
$desa = isset($_GET['kode']) ? mysqli_real_escape_string($koneksi, $_GET['kode']) : '';

if (empty($desa)) {
    die("desa tidak ditemukan.");
}

// Query untuk mendapatkan data penduduk di desa tersebut
$sql = "SELECT nik, nama, kecamatan, desa FROM tb_pdd WHERE desa = '$desa'";
$result = $koneksi->query($sql);

if (!$result) {
    die("Query gagal: " . $koneksi->error);
}

// Buat instance baru dari TCPDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Data Penduduk');
$pdf->SetSubject('Data Penduduk desa');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->AddPage();

// Judul
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Data Penduduk desa ' . htmlspecialchars($desa), 0, 1, 'C');

// Header tabel
$pdf->SetFont('helvetica', 'B', 12);
// Sesuaikan lebar kolom
$pdf->Cell(50, 10, 'NIK', 1);       // Lebar kolom NIK diperbesar menjadi 50
$pdf->Cell(70, 10, 'Nama', 1);     // Lebar kolom Nama
$pdf->Cell(40, 10, 'Kecamatan', 1); // Lebar kolom Kecamatan
$pdf->Cell(40, 10, 'desa', 1); // Lebar kolom desa
$pdf->Ln();

// Tampilkan data dalam PDF
$pdf->SetFont('helvetica', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Sesuaikan lebar kolom dengan header
        $pdf->Cell(50, 10, htmlspecialchars($row['nik']), 1);
        $pdf->Cell(70, 10, htmlspecialchars($row['nama']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($row['kecamatan']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($row['desa']), 1);
        $pdf->Ln();
    }
} else {
    // Jika tidak ada data
    $pdf->Cell(0, 10, 'Tidak ada data untuk desa ini.', 1, 1, 'C');
}

// Bersihkan output buffer
if (ob_get_length()) {
    ob_end_clean();
}

// Output PDF ke browser
$pdf->Output('Data_Penduduk_' . htmlspecialchars($desa) . '.pdf', 'I');

// Tutup koneksi database
mysqli_close($koneksi);
?>
