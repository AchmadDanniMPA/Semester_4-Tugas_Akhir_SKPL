<?php
include_once('../Conf/config.php');
include_once('../Model/m_survey_model.php');
$id = $_GET['id'];
$surveyModel = new MSurvey($koneksi);
$survey = $surveyModel->getSurveyById($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Survey</title>
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
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
          <div class="card-body">
            <form action="m_survey_action.php?act=edit&id=<?php echo $id; ?>" method="post">
              <div class="form-group">
                <label for="survey_jenis">Jenis Survey</label>
                <select name="survey_jenis" id="survey_jenis" class="form-control">
                  <option value="Mahasiswa" <?php if($survey['survey_jenis'] == 'Mahasiswa') echo 'selected'; ?>>Mahasiswa</option>
                  <option value="Orang Tua" <?php if($survey['survey_jenis'] == 'Orang Tua') echo 'selected'; ?>>Orang Tua</option>
                  <option value="Kepuasan Mitra" <?php if($survey['survey_jenis'] == 'Kepuasan Mitra') echo 'selected'; ?>>Kepuasan Mitra</option>
                  <option value="Alumni" <?php if($survey['survey_jenis'] == 'Alumni') echo 'selected'; ?>>Alumni</option>
                  <option value="Dosen" <?php if($survey['survey_jenis'] == 'Dosen') echo 'selected'; ?>>Dosen</option>
                  <option value="Tendik" <?php if($survey['survey_jenis'] == 'Tendik') echo 'selected'; ?>>Tendik</option>
                </select>
              </div>
              <div class="form-group">
                <label for="survey_kode">Kode Survey</label>
                <input type="text" name="survey_kode" id="survey_kode" class="form-control" value="<?php echo $survey['survey_kode']; ?>">
              </div>
              <div class="form-group">
                <label for="survey_nama">Nama Survey</label>
                <input type="text" name="survey_nama" id="survey_nama" class="form-control" value="<?php echo $survey['survey_nama']; ?>">
              </div>
              <div class="form-group">
                <label for="survey_deskripsi">Deskripsi Survey</label>
                <textarea name="survey_deskripsi" id="survey_deskripsi" class="form-control" rows="3"><?php echo $survey['survey_deskripsi']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="survey_tanggal">Tanggal Survey</label>
                <input type="datetime-local" name="survey_tanggal" id="survey_tanggal" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($survey['survey_tanggal'])); ?>">
              </div>
              <button type="submit" class="btn btn-primary">Edit</button>
              <a href="m_survey.php" class="btn btn-secondary">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('../Layouts/footer.php'); ?>
</div>
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Template/dist/js/adminlte.min.js"></script>
</body>
</html>
