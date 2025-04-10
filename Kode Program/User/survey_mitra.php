<?php
include_once '../Conf/config.php';
include_once '../Model/survey_mitra_model.php';

$survey_id = 5;
$surveyMitra = new SurveyMitra($koneksi);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $responden_data = [
        'survey_id' => $survey_id,
        'responden_nama' => $_POST['responden_nama'],
        'responden_jabatan' => $_POST['responden_jabatan'],
        'responden_perusahaan' => $_POST['responden_perusahaan'],
        'responden_email' => $_POST['responden_email'],
        'responden_hp' => $_POST['responden_hp'],
        'responden_kota' => $_POST['responden_kota']
    ];

    $responden_id = $surveyMitra->insertResponden($responden_data);

    foreach ($_POST['jawaban'] as $soal_id => $jawaban) {
        $jawaban_data = [
            'responden_industri_id' => $responden_id,
            'soal_id' => $soal_id,
            'jawaban' => $jawaban
        ];
        $surveyMitra->insertJawaban($jawaban_data);
    }

    header("Location: thank_you.php");
    exit();
}

$soal_list = $surveyMitra->getSoalBySurveyId($survey_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Mitra 2024</title>

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
                <h3 class="card-title">Survey Mitra 2024</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-info">
                  <h4>Survei Kepuasan Mitra terhadap Sistem Pengelolaan yang ada di Politeknik Negeri Malang Tahun 2024 (Partner Satisfaction Survey with the Management System at the Malang State Polytechnic in 2024)</h4>
                  <p>
                    Bapak/Ibu yang terhormat, kami mohon kesediaannya untuk mengisi kuesioner kepuasan pengguna terkait dengan kategori yang telah diberikan di Politeknik Negeri Malang dengan memberikan tanda pada kolom yang telah disediakan dengan kriteria sebagai berikut:<br>
                    1: Sangat Tidak Puas; 2: Tidak Puas; 3: Puas ; 4: Sangat Puas<br>
                    Atas perhatiannya kami ucapkan terima kasih.<br>
                    (Dear Sir/Madam, we ask for your willingness to fill out the user satisfaction questionnaire related to the categories given at the Malang State Polytechnic by ticking the column provided with the following criteria:<br>
                    1: Very Dissatisfied; 2: Dissatisfied; 3: Satisfied ; 4: Very Satisfied<br>
                    Thank you for your attention.)
                  </p>
                </div>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="responden_nama">Nama (Name)</label>
                    <input type="text" class="form-control" name="responden_nama" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_jabatan">Jabatan (Position)</label>
                    <input type="text" class="form-control" name="responden_jabatan" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_perusahaan">Perusahaan/Institusi (Company/Institution)</label>
                    <input type="text" class="form-control" name="responden_perusahaan" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_email">Email</label>
                    <input type="email" class="form-control" name="responden_email" maxlength="100" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_hp">Nomor Telepon (Phone Number)</label>
                    <input type="text" class="form-control" name="responden_hp" maxlength="20" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_kota">Kota (City)</label>
                    <input type="text" class="form-control" name="responden_kota" maxlength="50" required>
                  </div>

                  <?php
                  $current_kategori = '';
                  foreach ($soal_list as $soal) {
                    if ($soal['kategori_id'] != $current_kategori) {
                      if ($current_kategori != '') {
                        echo '</div>';
                      }
                      $current_kategori = $soal['kategori_id'];
                      $kategori = $surveyMitra->getKategoriById($current_kategori);
                      echo '<div class="card">';
                      echo '<div class="card-header">';
                      echo '<h4 class="card-title font-weight-bold">' . $kategori['kategori_nama'] . '</h4>';
                      echo '</div>';
                      echo '<div class="card-body">';
                    }
                    echo '<div class="form-group">';
                    echo '<a><b>' . $soal['soal_nama'] . '</b></a>';
                    if ($soal['soal_jenis'] == 'Rating') {
                      echo '<div>';
                      echo '<a> Sangat Tidak Puas (Very Dissatisfied) </a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="1" required> 1</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="2"> 2</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="3"> 3</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="4"> 4</a>';
                      echo '<a> Sangat Puas (Very Satisfied) </a>';
                      echo '</div>';
                    } elseif ($soal['soal_jenis'] == 'Isian') {
                      echo '<input type="text" class="form-control" name="jawaban[' . $soal['soal_id'] . ']" maxlength="255">';
                    }
                    echo '</div>';
                  }
                  if ($current_kategori != '') {
                    echo '</div>';
                    echo '</div>';
                  }
                  ?>
                  <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
              </div>
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
