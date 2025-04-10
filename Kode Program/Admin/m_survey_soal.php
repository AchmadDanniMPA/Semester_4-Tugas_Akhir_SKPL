<?php
include_once('../Conf/config.php');
include_once('../Model/m_survey_soal_model.php');
include_once('../Model/m_survey_model.php');
include_once('../Conf/cek_login.php');
include_once('../Conf/config.php');
$survey_id = $_GET['survey_id'];
$soalModel = new MSurveySoal($koneksi);
$surveyModel = new MSurvey($koneksi);
$soals = $soalModel->getSoalsBySurveyId($survey_id);
$survey = $surveyModel->getSurveyById($survey_id);
$survey_nama = $survey['survey_nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Soal Survey</title>
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
            <h3 class="card-title">Daftar Soal <?php echo $survey_nama; ?></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSoalModal">+Tambah Soal</button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No Urut</th>
                  <th>Jenis Soal</th>
                  <th>Nama Soal</th>
                  <th>Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $soals->fetch_assoc()): ?>
                  <tr>
                    <td><?php echo $row['no_urut']; ?></td>
                    <td><?php echo $row['soal_jenis']; ?></td>
                    <td><?php echo $row['soal_nama']; ?></td>
                    <td><?php echo $row['kategori_nama']; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSoalModal<?php echo $row['soal_id']; ?>">Edit</button>
                      <button type="button" class="btn btn-danger" onclick="deleteSoal(<?php echo $row['soal_id']; ?>)">Hapus</button>
                    </td>
                  </tr>
                  <div class="modal fade" id="editSoalModal<?php echo $row['soal_id']; ?>" tabindex="-1" aria-labelledby="editSoalModalLabel<?php echo $row['soal_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editSoalModalLabel<?php echo $row['soal_id']; ?>">Edit Soal</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="editSoalForm<?php echo $row['soal_id']; ?>" onsubmit="event.preventDefault(); editSoal(<?php echo $row['soal_id']; ?>);">
                            <div class="form-group">
                              <label for="no_urut<?php echo $row['soal_id']; ?>">No Urut</label>
                              <input type="text" name="no_urut" id="no_urut<?php echo $row['soal_id']; ?>" class="form-control" value="<?php echo $row['no_urut']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="soal_jenis<?php echo $row['soal_id']; ?>">Jenis Soal</label>
                              <select name="soal_jenis" id="soal_jenis<?php echo $row['soal_id']; ?>" class="form-control" required>
                                <option value="Isian" <?php if($row['soal_jenis'] == 'Isian') echo 'selected'; ?>>Isian</option>
                                <option value="Rating" <?php if($row['soal_jenis'] == 'Rating') echo 'selected'; ?>>Rating</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="soal_nama<?php echo $row['soal_id']; ?>">Nama Soal</label>
                              <input type="text" name="soal_nama" id="soal_nama<?php echo $row['soal_id']; ?>" class="form-control" value="<?php echo $row['soal_nama']; ?>" required>
                            </div>
                            <div class="form-group">
                              <label for="kategori_id<?php echo $row['soal_id']; ?>">Kategori</label>
                              <select name="kategori_id" id="kategori_id<?php echo $row['soal_id']; ?>" class="form-control" required>
                                <?php
                                include_once('../Model/m_kategori_model.php');
                                $kategoriModel = new MKategori($koneksi);
                                $categories = $kategoriModel->getAllCategories();
                                while ($cat = $categories->fetch_assoc()):
                                ?>
                                  <option value="<?php echo $cat['kategori_id']; ?>" <?php if($cat['kategori_id'] == $row['kategori_id']) echo 'selected'; ?>><?php echo $cat['kategori_nama']; ?></option>
                                <?php endwhile; ?>
                              </select>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Edit</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <a href="m_survey.php" class="btn btn-secondary">Kembali</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<div class="modal fade" id="tambahSoalModal" tabindex="-1" aria-labelledby="tambahSoalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahSoalModalLabel">Tambah Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambahSoalForm" onsubmit="event.preventDefault(); tambahSoal();">
          <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
          <div class="form-group">
            <label for="no_urut">No Urut</label>
            <input type="text" name="no_urut" id="no_urut" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="soal_jenis">Jenis Soal</label>
            <select name="soal_jenis" id="soal_jenis" class="form-control" required>
              <option value="Isian">Isian</option>
              <option value="Rating">Rating</option>
            </select>
          </div>
          <div class="form-group">
            <label for="soal_nama">Nama Soal</label>
            <input type="text" name="soal_nama" id="soal_nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
              <?php
              include_once('../Model/m_kategori_model.php');
              $kategoriModel = new MKategori($koneksi);
              $categories = $kategoriModel->getAllCategories();
              while ($cat = $categories->fetch_assoc()):
              ?>
                <option value="<?php echo $cat['kategori_id']; ?>"><?php echo $cat['kategori_nama']; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Template/dist/js/adminlte.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function tambahSoal() {
  var form = $('#tambahSoalForm');
  $.ajax({
    type: 'POST',
    url: 'm_survey_soal_action.php?act=add',
    data: form.serialize(),
    success: function(response) {
      if (response.status == 'success') {
        $('#tambahSoalModal').modal('hide');
        location.reload();
      } else {
        alert(response.message);
      }
    }
  });
}
function editSoal(id) {
  var form = $('#editSoalForm' + id);
  $.ajax({
    type: 'POST',
    url: 'm_survey_soal_action.php?act=edit&id=' + id,
    data: form.serialize(),
    success: function(response) {
      if (response.status == 'success') {
        $('#editSoalModal' + id).modal('hide');
        location.reload();
      } else {
        alert(response.message);
      }
    }
  });
}
function deleteSoal(id) {
  if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
    $.ajax({
      type: 'GET',
      url: 'm_survey_soal_action.php?act=delete&id=' + id,
      success: function(response) {
        if (response.status == 'success') {
          location.reload();
        } else {
          alert(response.message);
        }
      }
    });
  }
}
</script>
</body>
</html>
