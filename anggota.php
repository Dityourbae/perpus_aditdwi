<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Petugas</title>
        <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    </head>
    <body>
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
    $query_insert = mysqli_query($koneksi,"INSERT INTO anggota 
    VALUES('','$nis','$nama','$jk','$tmpt_lahir','$tgl_lahir','$kelas','$jurusan','$tlp','$alamat')");
        if($query_insert)
        {
            ?>
                <div class="alert alert-success">
                    Data Berhasil Disimpan
                </div>
            <?php
            header('refresh:1; URL=http://localhost/perpustakaan/admin.php?page=anggota');
        }
        else
        {
            ?>
                <div class="alert alert-danger">
                    Data GAGAL Disimpan !!!!!!!!!
                </div>
            <?php
        }
    }
    //// End of proses insert /////////////////////////////////////////////////////////
    ?>
    <center><h1 class="mt-4 mb-3">Data Anggota</h1></center>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#tambahanggota">
    Tambah Data
    </button>
    <table class="table table-dark">

        <tr class="text-center">
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Tmpt lahir</th>
            <th>Tgl Lahir</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Tlp</td>
            <th>Alamat</th>
            <th>--Action--</th>
        </tr>
        <?php
            //$query = mysqli_query($koneksi,"SELECT * FROM anggota");
            $query = mysqli_query($koneksi,"SELECT anggota.id_anggota, anggota.nis, anggota.nama, anggota.jk, 
        anggota.tempat_lahir,anggota.tanggal_lahir, anggota.id_kelas, anggota.id_jurusan, anggota.nomor_telepon, 
        anggota.alamat, kelas.id_kelas, kelas.nama_kelas, jurusan.id_jurusan, jurusan.nama_jurusan
        FROM anggota
        JOIN kelas ON anggota.id_kelas = kelas.id_kelas
        JOIN jurusan ON anggota.id_jurusan = jurusan.id_jurusan");
            $no = 1;
            foreach ($query as $row) {
        ?>
        <tr>
            <td align="center" valign="middle"><?php echo $no; ?></td>
            <td valign="middle"><?php echo $row['nis']; ?></td>
            <td valign="middle"><?php echo $row['nama']; ?></td>
            <td align="center" valign="middle"><?php echo $row['jk']=="L"?"Laki-laki":"Perempuan"; ?></td>
            <td valign="middle"><?php echo $row['tempat_lahir']; ?></td>
            <td valign="middle"><?php echo $row['tanggal_lahir']; ?></td>
            <td valign="middle"><?php echo $row['id_kelas']; ?></td>
            <td valign="middle">
        <?php
            if ($row['id_jurusan']=='1') {
                echo "Rekayasa Perangkat Lunak";
            }elseif($row['id_jurusan']=='2'){
                echo "Teknik Kendaraan Ringan";
            }elseif($row['id_jurusan']=='3'){
                echo "Teknik Instalasi Listrik";
            }else{
                echo "Audio Video";
            }
        ?>
            <?php echo $row['id_jurusan']; ?>
        </td>
            <td valign="middle"><?php echo $row['nomor_telepon']; ?></td>
            <td valign="middle"><?php echo $row['alamat']; ?></td>
            <td valign="middle">
                <a href="?page=anggota-delete&delete=&id=<?php echo $row['id_anggota'];?>">
                    <button class="btn btn-danger">Hapus<i class="fas fa-trash-alt"></i></button>
                </a>
                <a href="?page=anggota-edit&edit=&id=<?php echo $row['id_anggota'];?>">
                    <button class="btn btn-warning">Edit<i class="fas fa-edit"></i></button>
                </a>
            </td>
        </tr>
        <?php
        $no++;
        }
        ?>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="tambahanggota" tabindex="-1" aria-labelledby="tambahanggotaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahanggotaLabel">Form Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nis" placeholder="Nomor Induk Siswa" required>
                    </div>
                    <div class="form-group mt-2">
                        <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group mt-2">
                    <select class="form-control" name="id_kelas" required>
                        <option value="">--Pilih Kelas--</option>
                        <?php
                            $query_kelas = mysqli_query($koneksi,"SELECT * FROM kelas");
                            foreach ($query_kelas as $kelas) {
                                ?>
                                <option value="<?php echo $kelas['id_kelas']?>"><?php echo $kelas['nama_kelas']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="id_jurusan" required>
                        <option value="">--Pilih Jurusan--</option>
                        <?php
                            $query_jurusan = mysqli_query($koneksi,"SELECT * FROM jurusan");
                            foreach ($query_jurusan as $jurusan) {
                                ?>
                                <option value="<?php echo $jurusan['id_jurusan']?>"><?php echo $jurusan['nama_jurusan']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                    <div class="form-group mt-2">
                        <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group mt-2">
                    <div class="input-group">
                        <input class="form-control" type="date" name="tanggal_lahir">
                    </div>
                    <div class="form-group mt-2">
                        <select class="form-control" name="jk">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <input class="form-control" type="text" name="nomor_telepon" placeholder="Nomor Telepon">
                    </div>
                    <div class="form-group mt-2">
                        <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            </div>
        </div>
    </div>