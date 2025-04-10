<?php
include_once '../Conf/config.php';
$query = "SELECT survey_id, survey_nama FROM m_survey ORDER BY survey_id ASC";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Kepuasan Pelanggan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include '../Layouts/header.php'; ?>
  
  <!-- Main Sidebar Container -->
  <?php include '../Layouts/sidebarUser.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include '../Layouts/breadcrumb.php'; ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Survey</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  <?php
                  while($row = $result->fetch_assoc()) {
                    $surveyId = $row['survey_id'];
                    $surveyFile = "";
                    switch ($surveyId) {
                      case 1:
                        $surveyFile = "survey_dosen.php";
                        break;
                      case 2:
                        $surveyFile = "survey_tendik.php";
                        break;
                      case 3:
                        $surveyFile = "survey_mahasiswa.php";
                        break;
                      case 4:
                        $surveyFile = "survey_ortu.php";
                        break;
                      case 5:
                        $surveyFile = "survey_mitra.php";
                        break;
                      case 6:
                        $surveyFile = "survey_alumni.php";
                        break;
                    }
                    echo '<li class="list-group-item"><a href="' . $surveyFile . '?id=' . $surveyId . '">' . $row['survey_nama'] . '</a></li>';
                  }
                  ?>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include '../Layouts/footer.php'; ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Template/dist/js/adminlte.min.js"></script>
</body>
</html>
