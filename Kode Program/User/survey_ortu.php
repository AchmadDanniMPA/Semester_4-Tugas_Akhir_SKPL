<?php
include_once '../Conf/config.php';
include_once '../Model/survey_ortu_model.php';

$survey_id = 4;
$surveyOrtu = new SurveyOrtu($koneksi);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $responden_data = [
        'survey_id' => $survey_id,
        'responden_nama' => $_POST['responden_nama'],
        'responden_jk' => $_POST['responden_jk'],
        'responden_umur' => $_POST['responden_umur'],
        'responden_hp' => $_POST['responden_hp'],
        'responden_pendidikan' => $_POST['responden_pendidikan'],
        'responden_pekerjaan' => $_POST['responden_pekerjaan'],
        'responden_penghasilan' => $_POST['responden_penghasilan'],
        'mahasiswa_nim' => $_POST['mahasiswa_nim'],
        'mahasiswa_nama' => $_POST['mahasiswa_nama'],
        'tahun_masuk' => $_POST['tahun_masuk'],
        'mahasiswa_prodi' => $_POST['mahasiswa_prodi']
    ];

    $responden_id = $surveyOrtu->insertResponden($responden_data);

    foreach ($_POST['jawaban'] as $soal_id => $jawaban) {
        $jawaban_data = [
            'responden_ortu_id' => $responden_id,
            'soal_id' => $soal_id,
            'jawaban' => $jawaban
        ];
        $surveyOrtu->insertJawaban($jawaban_data);
    }

    header("Location: thank_you.php");
    exit();
}

$soal_list = $surveyOrtu->getSoalBySurveyId($survey_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Orang Tua 2024</title>

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
                <h3 class="card-title">Survey Orang Tua 2024</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="alert alert-info">
                  <h4>Survei Kepuasan Orang Tua terhadap Sistem Pengelolaan yang ada di Politeknik Negeri Malang Tahun 2024</h4>
                  <p>
                    Bapak/Ibu yang terhormat, kami mohon kesediaannya untuk mengisi kuesioner kepuasan pengguna terkait dengan kategori yang telah diberikan di Politeknik Negeri Malang dengan memberikan tanda pada kolom yang telah disediakan dengan kriteria sebagai berikut:<br>
                    1: Sangat Tidak Puas; 2: Tidak Puas; 3: Puas ; 4: Sangat Puas<br>
                    Atas perhatiannya kami ucapkan terima kasih.
                  </p>
                </div>
                <form method="post" action="">
                  <div class="form-group">
                    <label for="responden_nama">Nama</label>
                    <input type="text" class="form-control" name="responden_nama" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_jk">Jenis Kelamin</label>
                    <select class="form-control" name="responden_jk" required>
                      <option value="">Pilih</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="responden_umur">Umur</label>
                    <input type="number" class="form-control" name="responden_umur" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_hp">No HP</label>
                    <input type="text" class="form-control" name="responden_hp" maxlength="20" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_pendidikan">Pendidikan Terakhir</label>
                    <input type="text" class="form-control" name="responden_pendidikan" maxlength="30" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control" name="responden_pekerjaan" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="responden_penghasilan">Penghasilan</label>
                    <input type="text" class="form-control" name="responden_penghasilan" maxlength="20" required>
                  </div>
                  <div class="form-group">
                    <label for="mahasiswa_nim">NIM Mahasiswa</label>
                    <input type="text" class="form-control" name="mahasiswa_nim" maxlength="20" required>
                  </div>
                  <div class="form-group">
                    <label for="mahasiswa_nama">Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="mahasiswa_nama" maxlength="50" required>
                  </div>
                  <div class="form-group">
                    <label for="tahun_masuk">Tahun Masuk</label>
                    <input type="year" class="form-control" name="tahun_masuk" required>
                  </div>
                  <div class="form-group">
                    <label for="mahasiswa_prodi">Prodi</label>
                    <select class="form-control" name="mahasiswa_prodi" required>
                      <option value="">Pilih</option>
                      <option value="Teknologi Informasi">Teknologi Informasi</option>
                      <option value="Teknik Elektro">Teknik Elektro</option>
                      <option value="Teknik Sipil">Teknik Sipil</option>
                      <option value="Teknik Mesin">Teknik Mesin</option>
                      <option value="Teknik Kimia">Teknik Kimia</option>
                      <option value="Administrasi Niaga">Administrasi Niaga</option>
                      <option value="Akuntansi">Akuntansi</option>
                      <option value="PSDKU Kediri">PSDKU Kediri</option>
                      <option value="PSDKU Lumajang">PSDKU Lumajang</option>
                      <option value="PSDKU Pamekasan">PSDKU Pamekasan</option>
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
                      $kategori = $surveyOrtu->getKategoriById($current_kategori);
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
