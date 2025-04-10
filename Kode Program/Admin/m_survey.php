<?php
include_once('../Conf/config.php');
include_once('../Model/m_survey_model.php');
include_once('../Conf/cek_login.php');
include_once('../Conf/config.php');
$surveyModel = new MSurvey($koneksi);
$surveys = $surveyModel->getAllSurveys();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Survey</title>
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include('../Layouts/header.php'); ?>
  <?php include('../Layouts/sidebar.php'); ?>
  <div class="content-wrapper">
    <?php include('../Layouts/breadcrumb.php'); ?>
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Survey</h3>
            <div class="card-tools">
              <a href="m_survey_form.php" class="btn btn-primary">+Tambah Survey</a>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#kelolaKategoriModal">Kelola Kategori</button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Kode Survey</th>
                  <th>Nama Survey</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $surveys->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['survey_kode']; ?></td>
                    <td><?php echo $row['survey_nama']; ?></td>
                    <td><?php echo $row['survey_deskripsi']; ?></td>
                    <td><?php echo $row['survey_tanggal']; ?></td>
                    <td>
                      <a href="m_survey_edit.php?id=<?php echo $row['survey_id']; ?>" class="btn btn-warning">Edit</a>
                      <a href="m_survey_soal.php?survey_id=<?php echo $row['survey_id']; ?>" class="btn btn-info">Kelola</a>
                      <a href="m_survey_action.php?act=delete&id=<?php echo $row['survey_id']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('../Layouts/footer.php'); ?>
</div>
<div class="modal fade" id="kelolaKategoriModal" tabindex="-1" aria-labelledby="kelolaKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kelolaKategoriModalLabel">Kelola Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="kelola_kategori.php" frameborder="0" style="width: 100%; height: 500px;"></iframe>
      </div>
    </div>
  </div>
</div>
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Template/dist/js/adminlte.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
