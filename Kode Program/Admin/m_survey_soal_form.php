<?php 
$menu = 'm_survey_soal'; 
include_once('../Model/m_survey_soal_model.php');
include_once('../Conf/cek_login.php');
include_once('../Conf/config.php');
$survey_id = $_GET['survey_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form - Survey Soal</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include_once('../Layouts/header.php'); ?>
  <?php include_once('../Layouts/sidebar.php'); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Survey Soal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Survey Soal</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">      
      <?php 
        $act = (isset($_GET['act']))? $_GET['act'] : '';

        if($act == 'tambah'){
      ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Soal Survey</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form action="m_survey_soal_action.php?act=simpan&survey_id=<?php echo $survey_id; ?>" method="post" id="form-tambah">
            <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
            <div class="form-group">
              <label for="kategori_id">Kategori ID</label>
              <input required type="text" name="kategori_id" id="kategori_id" class="form-control">
            </div>
            <div class="form-group">
              <label for="no_urut">No Urut</label>
              <input required type="text" name="no_urut" id="no_urut" class="form-control">
            </div>
            <div class="form-group">
              <label for="soal_jenis">Jenis Soal</label>
              <select required class="form-control" id="soal_jenis" name="soal_jenis">
                <option value="Rating">Rating</option>
                <option value="Isian">Isian</option>
              </select>
            </div>
            <div class="form-group">
              <label for="soal_nama">Nama Soal</label>
              <input required type="text" name="soal_nama" id="soal_nama" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              <a href="m_survey_soal.php?survey_id=<?php echo $survey_id; ?>" class="btn btn-warning">Kembali</a>
            </div>
          </form>
        </div>
      </div>
      <?php } else if($act == 'edit') { ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Soal Survey</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <?php 
            $id = $_GET['id'];

            $survey_soal = new MSurveySoal($koneksi);
            $data = $survey_soal->getDataById($id);
            $data = $data->fetch_assoc();
          ?>
          <form action="m_survey_soal_action.php?act=edit&id=<?php echo $id; ?>&survey_id=<?php echo $survey_id; ?>" method="post">
            <div class="form-group">
              <label for="kategori_id">Kategori ID</label>
              <input type="text" name="kategori_id" id="kategori_id" class="form-control" value="<?php echo $data['kategori_id']?>">
            </div>
            <div class="form-group">
              <label for="no_urut">No Urut</label>
              <input type="text" name="no_urut" id="no_urut" class="form-control" value="<?php echo $data['no_urut']?>">
            </div>
            <div class="form-group">
              <label for="soal_jenis">Jenis Soal</label>
              <select required class="form-control" id="soal_jenis" name="soal_jenis">
                <option value="Rating" <?php if($data['soal_jenis'] == 'Rating') echo 'selected'; ?>>Rating</option>
                <option value="Isian" <?php if($data['soal_jenis'] == 'Isian') echo 'selected'; ?>>Isian</option>
              </select>
            </div>
            <div class="form-group">
              <label for="soal_nama">Nama Soal</label>
              <input type="text" name="soal_nama" id="soal_nama" class="form-control" value="<?php echo $data['soal_nama']?>">
            </div>
            <div class="form-group">
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              <a href="m_survey_soal.php?survey_id=<?php echo $survey_id; ?>" class="btn btn-warning">Kembali</a>
            </div>
          </form>
        </div>
      </div>
      <?php }?>
    </section>
  </div>
  <?php include_once('../Layouts/footer.php'); ?>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Template/dist/js/adminlte.min.js"></script>
<!-- jQuery Validation -->
<script src="../Template/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../Template/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="../Template/plugins/jquery-validation/localization/messages_id.js"></script>
<script>
  $(document).ready(function(){
    $('#form-tambah').validate({
      rules: {
        kategori_id: {
          required: true,
        },
        no_urut: {
          required: true,
        },
        soal_jenis: {
          required: true,
        },
        soal_nama: {
          required: true,
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });     
  });
</script>
</body>
</html>
