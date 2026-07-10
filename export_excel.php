<?php
include 'koneksi.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_peserta.xls");
header("Pragma: no-cache");
header("Expires: 0");

$query = mysqli_query($conn, "SELECT * FROM data_peserta");

echo "<table border='1'>";
echo "<tr>";
echo "<th>No</th>";
echo "<th>Kode Pendaftaran</th>";
echo "<th>NISN</th>";
echo "<th>NIK</th>";
echo "<th>Nama</th>";

echo "<th>Panggilan</th>";
echo "<th>Tempat Lahir</th>";
echo "<th>Tanggal Lahir</th>";
echo "<th>Status Pendaftaran</th>";
echo "<th>Jenis Kelamin</th>";
echo "<th>Agama</th>";
echo "<th>Suku</th>";
echo "<th>Kondisi Ekonomi</th>";
echo "<th>Kewarganegaraan</th>";
echo "<th>Anak Ke</th>";
echo "<th>Status Anak</th>";
echo "<th>Jumlah Saudara Kandung</th>";
echo "<th>Bahasa</th>";
echo "<th>Alamat Rumah</th>";
echo "<th>Jarak ke Sekolah</th>";
echo "<th>No HP</th>";
echo "<th>Email</th>";
echo "<th>Asal Sekolah</th>";
echo "<th>No Ijazah</th>";
echo "<th>Tanggal Ijazah</th>";
echo "<th>No SHUN</th>";
echo "<th>Tanggal SHUN</th>";
echo "<th>Golongan Darah</th>";
echo "<th>Berat Badan</th>";
echo "<th>Tinggi Badan</th>";
echo "<th>Riwayat Penyakit</th>";
echo "<th>Nama Ayah</th>";
echo "<th>Status Ayah</th>";
echo "<th>Tempat Lahir Ayah</th>";
echo "<th>Tanggal Lahir Ayah</th>";
echo "<th>Pendidikan Ayah</th>";
echo "<th>Pekerjaan Ayah</th>";
echo "<th>Penghasilan Ayah</th>";
echo "<th>Email Ayah</th>";
echo "<th>Nama Wali Ayah</th>";
echo "<th>Alamat Ayah</th>";
echo "<th>No HP Ayah</th>";
echo "<th>Nama Ibu</th>";
echo "<th>Status Ibu</th>";
echo "<th>Tempat Lahir Ibu</th>";
echo "<th>Tanggal Lahir Ibu</th>";
echo "<th>Pendidikan Ibu</th>";
echo "<th>Pekerjaan Ibu</th>";
echo "<th>Penghasilan Ibu</th>";
echo "<th>Email Ibu</th>";
echo "<th>Nama Wali Ibu</th>";
echo "<th>Alamat Ibu</th>";
echo "<th>No HP Ibu</th>";
echo "<th>Jurusan</th>";

echo "<th>Pernyataan 1</th>";
echo "<th>Pernyataan 2</th>";
echo "</tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nisn'] . "</td>";
    echo "<td>" . $row['nik'] . "</td>";
    echo "<td>" . $row['nama'] . "</td>";
    
    echo "<td>" . $row['panggilan'] . "</td>";
    echo "<td>" . $row['tempat_lahir'] . "</td>";
    echo "<td>" . $row['tanggal_lahir'] . "</td>";
    echo "<td>" . $row['status_pendaftaran'] . "</td>";
    echo "<td>" . $row['jenis_kelamin'] . "</td>";
    echo "<td>" . $row['agama'] . "</td>";
    echo "<td>" . $row['suku'] . "</td>";
    echo "<td>" . $row['kondisi_ekonomi'] . "</td>";
    echo "<td>" . $row['kewarganegaraan'] . "</td>";
    echo "<td>" . $row['anak_ke'] . "</td>";
    echo "<td>" . $row['status_anak'] . "</td>";
    echo "<td>" . $row['jumlah_saudara_kandung'] . "</td>";
    echo "<td>" . $row['bahasa'] . "</td>";
    echo "<td>" . $row['alamat_rumah'] . "</td>";
    echo "<td>" . $row['jarak_ke_sekolah'] . "</td>";
    echo "<td>" . $row['no_hp'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['asal_sekolah'] . "</td>";
    echo "<td>" . $row['no_ijazah'] . "</td>";
    echo "<td>" . $row['tanggal_ijazah'] . "</td>";
    echo "<td>" . $row['no_shun'] . "</td>";
    echo "<td>" . $row['tanggal_shun'] . "</td>";
    echo "<td>" . $row['golongan_darah'] . "</td>";
    echo "<td>" . $row['berat_badan'] . "</td>";
    echo "<td>" . $row['tinggi_badan'] . "</td>";
    echo "<td>" . $row['riwayat_penyakit'] . "</td>";
    echo "<td>" . $row['nama_ayah'] . "</td>";
    echo "<td>" . $row['status_ayah'] . "</td>";
    echo "<td>" . $row['tempat_lahir_ayah'] . "</td>";
    echo "<td>" . $row['tanggal_lahir_ayah'] . "</td>";
    echo "<td>" . $row['pendidikan_ayah'] . "</td>";
    echo "<td>" . $row['pekerjaan_ayah'] . "</td>";
    echo "<td>" . $row['penghasilan_ayah'] . "</td>";
    echo "<td>" . $row['email_ayah'] . "</td>";
    echo "<td>" . $row['nama_wali_ayah'] . "</td>";
    echo "<td>" . $row['alamat_ayah'] . "</td>";
    echo "<td>" . $row['no_hp_ayah'] . "</td>";
    echo "<td>" . $row['nama_ibu'] . "</td>";
    echo "<td>" . $row['status_ibu'] . "</td>";
    echo "<td>" . $row['tempat_lahir_ibu'] . "</td>";
    echo "<td>" . $row['tanggal_lahir_ibu'] . "</td>";
    echo "<td>" . $row['pendidikan_ibu'] . "</td>";
    echo "<td>" . $row['pekerjaan_ibu'] . "</td>";
    echo "<td>" . $row['penghasilan_ibu'] . "</td>";
    echo "<td>" . $row['email_ibu'] . "</td>";
    echo "<td>" . $row['nama_wali_ibu'] . "</td>";
    echo "<td>" . $row['alamat_ibu'] . "</td>";
    echo "<td>" . $row['no_hp_ibu'] . "</td>";
    echo "<td>" . $row['jurusan'] . "</td>";
  
    echo "<td>" . ($row['pernyataan1'] ? 'Ya' : 'Tidak') . "</td>";
    echo "<td>" . ($row['pernyataan2'] ? 'Ya' : 'Tidak') . "</td>";
    echo "</tr>";
}

echo "</table>";
exit();
?>
