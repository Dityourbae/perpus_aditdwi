<?php

if(isset($_GET['delete'])){
    include('koneksi.php');
        $id = $_GET['id'];
        $query_delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota = '$id'");

        //Jika quey delete berhasil maka munculkan notifikasi dan refresh halaman
        if($query_delete){
            ?>
            <div class="alert alert-warning">
            Data Berhasil Dihapus !!!!!!!!!!
            </div>
            <?php
            header("Refresh:1; URL=http://localhost/perpustakaan/admin.php?page=anggota");
        }
    }
    