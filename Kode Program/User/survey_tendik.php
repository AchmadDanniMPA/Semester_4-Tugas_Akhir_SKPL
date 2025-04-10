<?php
include_once '../Conf/config.php';
include_once '../Model/survey_tendik_model.php';

$survey_id = 2;
$surveyTendik = new SurveyTendik($koneksi);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $responden_data = [
        'survey_id' => $survey_id,
        'responden_nopeg' => $_POST['responden_nopeg'],
        'responden_nama' => $_POST['responden_nama'],
        'responden_unit' => $_POST['responden_unit']
    ];

    $responden_id = $surveyTendik->insertResponden($responden_data);

    foreach ($_POST['jawaban'] as $soal_id => $jawaban) {
        $jawaban_data = [
            'responden_tendik_id' => $responden_id,
            'soal_id' => $soal_id,
            'jawaban' => $jawaban
        ];
        $surveyTendik->insertJawaban($jawaban_data);
    }

    header("Location: thank_you.php");
    exit();
}

$soal_list = $surveyTendik->getSoalBySurveyId($survey_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Tendik 2024</title>

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
                <h3 class="card-title">Survey Tendik 2024</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-info">
                  <h4>Survei Kepuasan Tenaga Kependidikan terhadap Sistem Pengelolaan yang ada di Politeknik Negeri Malang Tahun 2024</h4>
                  <p>
                    Bapak/Ibu yang terhormat, kami mohon kesediaannya untuk mengisi kuesioner kepuasan pengguna terkait dengan kategori yang telah diberikan di Politeknik Negeri Malang dengan memberikan tanda pada kolom yang telah disediakan dengan kriteria sebagai berikut:<br>
                    1: Sangat Tidak Puas; 2: Tidak Puas; 3: Puas ; 4: Sangat Puas<br>
                    Atas perhatiannya kami ucapkan terima kasih.
                  </p>
                </div>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="responden_nopeg">Nomor Pegawai</label>
                    <input type="text" class="form-control" name="responden_nopeg" maxlength="20" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_nama">Nama</label>
                    <input type="text" class="form-control" name="responden_nama" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_unit">Unit</label>
                    <select class="form-control" name="responden_unit" required>
                      <option value="">Pilih</option>
                      <option value="Teknik Mesin">Teknik Mesin</option>
                      <option value="Teknik Elektro">Teknik Elektro</option>
                      <option value="Teknik Sipil">Teknik Sipil</option>
                      <option value="Teknologi Informasi">Teknologi Informasi</option>
                      <option value="Teknik Kimia">Teknik Kimia</option>
                      <option value="Akuntansi">Akuntansi</option>
                      <option value="Administrasi Niaga">Administrasi Niaga</option>
                      <option value="Senat">Senat</option>
                      <option value="Dewan Pengawas">Dewan Pengawas</option>
                      <option value="Dewan Pertimbangan">Dewan Pertimbangan</option>
                      <option value="SPI">SPI</option>
                      <option value="P2MPP">P2MPP</option>
                      <option value="P3M">P3M</option>
                      <option value="BAK">BAK</option>
                      <option value="BPKU">BPKU</option>
                      <option value="UPA Perpustakaan">UPA Perpustakaan</option>
                      <option value="UPA TIK">UPA TIK</option>
                      <option value="UPA Bahasa">UPA Bahasa</option>
                      <option value="UPA PP">UPA PP</option>
                      <option value="UPA PKK">UPA PKK</option>
                      <option value="UPA LUK">UPA LUK</option>
                      <option value="UPA Percetakan dan Penerbitan">UPA Percetakan dan Penerbitan</option>
                    </select>
                  </div>

                  <?php
                  $current_kategori = '';
                  foreach ($soal_list as $soal) {
                    if ($soal['kategori_id'] != $current_kategori) {
                      if ($current_kategori != '') {
                        echo '</div>';
                      }
                      $current_kategori = $soal['kategori_id'];
                      $kategori = $surveyTendik->getKategoriById($current_kategori);
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
                      echo '<a> Sangat Tidak Puas </a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="1" required> 1</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="2"> 2</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="3"> 3</a>';
                      echo '<a><input type="radio" name="jawaban[' . $soal['soal_id'] . ']" value="4"> 4</a>';
                      echo '<a> Sangat Puas</a>';
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
