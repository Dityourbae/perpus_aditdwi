<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI Perpustakaan SMK Taruna Bangsa</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <style>
        video{
            position : fixed;
            z-index: -100;
        }
        .kotak-luar{
            height: 763px;
            background : white;
            opacity: 0.9;
            
        }
        .kotak-login{
            background : white;
            opacity: 0.8;
            border-radius : 20px;
        }
        button{
            width : 100%;
        }
        
    </style>
</head>
<body>
    <div class="container-fluid">
        <video width="100%" autoplay muted>
            <source src="bg.mp4" type="video/mp4">
        </video>
        <div class="row">
            <div class="col-4">
                <img src="title.png" width="100%" alt="">
            </div>
            <div class="col-4">
                <div class="kotak-luar">
                    <div class="kotak-login p-5">
                    <center><img src="logo-login.jpg" width="200px" alt="logo-login"></center>
                        <center><h1 class="mt-5">SI Perpustakaan<br>SMK Taruna Bangsa</h1></center>
                        <form action="" method="post">
                            <div class="form-group mt-5 mb-3">
                                <!-- <label for="username">Username</label> -->
                                <input class="form-control" type="text" id="username" name="username" placeholder="username" required>
                            </div>
                            <div class="form-group mb-3">
                                <!-- <label for="password">Password</label> -->
                                <input class="form-control" type="password" id="password" name="password" placeholder="password" required>
                            </div>
                            <div class="form-group">
                                <center><button class="btn btn-primary" name="login" type="submit">LOGIN</button></center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
    <?php
    include('koneksi.php');
        if (isset($_POST['login'])) {
            echo $username = $_POST['username'];
            echo $password = $_POST['password'];
            
            $query = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username = '$username' && password = '$password'");
            foreach ($query as $row) {
                $nama = $row['nama'];
                $jabatan = $row['jabatan'];
            }
           if (mysqli_num_rows($query)>0) {
               session_start();
               $_SESSION['status'] = "login";
               $_SESSION['nama'] = $nama;
               $_SESSION['jabatan'] = $jabatan;
                ?>
                <script>
                   alert('Anda Berhasil Login !!!!')
                   window.location.href='http://localhost/perpustakaan/admin.php?page=anggota';
                </script>
                <?php
           }else{
               ?>
               <script>
                   alert('Username atau Password anda salah !!!!')
               </script>
               <?php
           }
        }
    ?>
</body>
</html>