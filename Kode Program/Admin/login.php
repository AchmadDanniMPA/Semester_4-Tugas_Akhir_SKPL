<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In Admin</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../Template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../Template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b></b>Log In Admin</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Log in untuk memulai sesi</p>
      <form action="../Conf/autentikasi.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name='password'>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <div class="col-4">
            <a href="../index.php" class="btn btn-secondary btn-block float-right">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- jQuery -->
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Template/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../Template/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>
<?php
if (isset($_GET['error'])) {
  $err = $_GET['error'];
  if ($err == 1) {
      echo "
      <script>
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        icon: 'warning',
        title: 'Login Gagal Password Salah.'
      })
      </script>";
  } elseif ($err == 2) {
      echo "
      <script>
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-center',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        icon: 'warning',
        title: 'Login Gagal Pengguna Tidak Ditemukan Di Database.'
      })
      </script>";
  } elseif ($err == 3) {
    echo "
    <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-center',
      showConfirmButton: false,
      timer: 3000
    });
    Toast.fire({
      icon: 'warning',
      title: 'Login Gagal Silahkan Input Username & Password.'
    })
    </script>";
  }
}
?>
</html>
