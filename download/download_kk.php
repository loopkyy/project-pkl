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

// Ambil parameter id_kk dari URL dan sanitasi input
$id_kk = isset($_GET['id_kk']) ? mysqli_real_escape_string($koneksi, $_GET['id_kk']) : '';

if (empty($id_kk)) {
    die("ID Kartu Keluarga tidak ditemukan.");
}

// Query untuk mendapatkan data anggota berdasarkan id_kk
$sql = "SELECT k.no_kk, p.nama, p.desa, p.kelurahan, p.kecamatan, a.hubungan, p.status 
        FROM tb_kk k 
        INNER JOIN tb_anggota a ON k.id_kk = a.id_kk 
        INNER JOIN tb_pdd p ON a.id_pend = p.id_pend 
        WHERE k.id_kk = '$id_kk'";
$result = $koneksi->query($sql);

if (!$result) {
    die("Query gagal: " . $koneksi->error);
}

// Buat instance baru dari TCPDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); // Mengubah orientasi ke Landscape
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Data Anggota Kartu Keluarga');
$pdf->SetSubject('Data Anggota Kartu Keluarga');
$pdf->SetKeywords('TCPDF, PDF, anggota, Kartu Keluarga');
$pdf->AddPage();

// Judul
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Data Anggota Kartu Keluarga', 0, 1, 'C');

// Header tabel
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(40, 10, 'No KK', 1);
$pdf->Cell(70, 10, 'Nama', 1);
$pdf->Cell(70, 10, 'Alamat', 1);
$pdf->Cell(40, 10, 'Kecamatan', 1);
$pdf->Cell(40, 10, 'Hubungan', 1);
$pdf->Cell(30, 10, 'Status', 1); // Tambahkan kolom Status
$pdf->Ln();

// Tampilkan data dalam PDF
$pdf->SetFont('helvetica', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alamat = htmlspecialchars($row['desa']);
        if (!empty($row['kelurahan'])) {
            $alamat .= ' ' . htmlspecialchars($row['kelurahan']);
        }
        
        $pdf->Cell(40, 10, htmlspecialchars($row['no_kk']), 1);
        $pdf->Cell(70, 10, htmlspecialchars($row['nama']), 1);
        $pdf->Cell(70, 10, $alamat, 1);
        $pdf->Cell(40, 10, htmlspecialchars($row['kecamatan']), 1);
        $pdf->Cell(40, 10, htmlspecialchars($row['hubungan']), 1);
        $pdf->Cell(30, 10, htmlspecialchars($row['status']), 1); // Tampilkan status
        $pdf->Ln();
    }
} else {
    // Jika tidak ada data
    $pdf->Cell(0, 10, 'Tidak ada data untuk Kartu Keluarga ini.', 1, 1, 'C');
}

// Bersihkan output buffer
if (ob_get_length()) {
    ob_end_clean();
}

// Output PDF ke browser
$pdf->Output('Data_Anggota_KK_' . htmlspecialchars($id_kk) . '.pdf ', 'I');

// Tutup koneksi database
mysqli_close($koneksi);
?>