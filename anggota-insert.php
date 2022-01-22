<?php


//Proses insert data
if (isset($_POST['save'])) {
$nis        = $_POST['nis'];
$nama       = $_POST['nama'];
$jk         = $_POST['jk'];
$tmpt_lahir = $_POST['tempat_lahir'];
$tgl_lahir  = $_POST['tanggal_lahir'];
$kelas      = $_POST['id_kelas'];
$jurusan    = $_POST['id_jurusan'];
$tlp        = $_POST['nomor_telepon'];
$alamat     = $_POST['alamat'];
$query_insert = mysqli_query($koneksi, "INSERT INTO anggota VALUES('','$nis','$nama','$jk','$tmpt_lahir','$tgl_lahir','$kelas','$jurusan','$tlp','$alamat')");

//Membuat notifikasi jika berhasil/tidak disimpan datanya
    if($query_insert)
    {
        ?>
            <div class="alert alert-success">
                Data Berhasil Disimpan
            </div>
        <?php
        header('Refresh:1; http://localhost/perpustakaan/admin.php?page=anggota');
    }
    else
    {
        ?>
            <div class="alert alert-danger">
                Data GAGAL Disimpan !!!!!!!!!
            </div>
        <?php
        header('Refresh:1; URL=http://perpustakaan/admin.php?page=anggota');
    }
}
//// End of proses insert /////////////////////////////////////////////////////////
?>