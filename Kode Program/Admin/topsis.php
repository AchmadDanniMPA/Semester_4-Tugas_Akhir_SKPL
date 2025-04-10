<?php
include_once '../Conf/config.php';
include_once '../Model/topsis_model.php';

$topsis = new Topsis($koneksi);
$dataJawaban = $topsis->getDataJawaban();

$avgData = $topsis->getAveragePerCategory();
$pembagi = [];
foreach (['SDM', 'Keuangan', 'SarPras', 'Penelitian', 'Pengabdian'] as $kategori) {
    $sumSquares = 0;
    foreach ($avgData as $unitData) {
        $sumSquares += pow($unitData[$kategori], 2);
    }
    $pembagi[$kategori] = sqrt($sumSquares);
}

$normalizedMatrix = $topsis->getNormalizedMatrix($avgData, $pembagi);
$weights = ['SDM' => 0.3, 'Keuangan' => 0.25, 'SarPras' => 0.2, 'Penelitian' => 0.15, 'Pengabdian' => 0.1];
$weightedNormalizedMatrix = $topsis->getWeightedNormalizedMatrix($normalizedMatrix, $weights);

$solusiIdealPositif = $topsis->getSolusiIdealPositif($weightedNormalizedMatrix);
$solusiIdealNegatif = $topsis->getSolusiIdealNegatif($weightedNormalizedMatrix);

$jarakSolusiIdealPositif = $topsis->getJarakSolusiIdeal($weightedNormalizedMatrix, $solusiIdealPositif, true);
$jarakSolusiIdealNegatif = $topsis->getJarakSolusiIdeal($weightedNormalizedMatrix, $solusiIdealNegatif, false);

$nilaiPreferensi = $topsis->getNilaiPreferensi($jarakSolusiIdealPositif, $jarakSolusiIdealNegatif);
arsort($nilaiPreferensi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TOPSIS</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
  <style>
    .scrollable-table {
      overflow-x: auto;
      white-space: nowrap;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include '../Layouts/header.php'; ?>
  <!-- Main Sidebar Container -->
  <?php include '../Layouts/sidebar.php'; ?>
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
                <h3 class="card-title">Data Jawaban Dosen dan Tenaga Didik</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="scrollable-table">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nama Responden</th>
                        <th>Unit</th>
                        <?php for ($i = 1; $i <= 55; $i++) echo "<th>Jawaban$i</th>"; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dataJawaban as $row): ?>
                      <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['unit']; ?></td>
                        <?php for ($i = 1; $i <= 55; $i++) echo "<td>{$row['jawaban' . $i]}</td>"; ?>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Terkategorisasi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Unit</th>
                      <th>SDM</th>
                      <th>Keuangan</th>
                      <th>Sarana Prasarana</th>
                      <th>Kegiatan Penelitian</th>
                      <th>Kegiatan Pengabdian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($avgData as $row): ?>
                    <tr>
                      <td><?php echo $row['unit']; ?></td>
                      <td><?php echo $row['SDM']; ?></td>
                      <td><?php echo $row['Keuangan']; ?></td>
                      <td><?php echo $row['SarPras']; ?></td>
                      <td><?php echo $row['Penelitian']; ?></td>
                      <td><?php echo $row['Pengabdian']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td><strong>BOBOT</strong></td>
                      <td>30%</td>
                      <td>25%</td>
                      <td>20%</td>
                      <td>15%</td>
                      <td>10%</td>
                    </tr>
                    <tr>
                      <td><strong>PEMBAGI</strong></td>
                      <td><?php echo number_format($pembagi['SDM'], 9); ?></td>
                      <td><?php echo number_format($pembagi['Keuangan'], 9); ?></td>
                      <td><?php echo number_format($pembagi['SarPras'], 9); ?></td>
                      <td><?php echo number_format($pembagi['Penelitian'], 9); ?></td>
                      <td><?php echo number_format($pembagi['Pengabdian'], 9); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Matrix Ternormalisasi (R)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Unit</th>
                      <th>SDM</th>
                      <th>Keuangan</th>
                      <th>Sarana Prasarana</th>
                      <th>Kegiatan Penelitian</th>
                      <th>Kegiatan Pengabdian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($normalizedMatrix as $unit => $values): ?>
                    <tr>
                      <td><?php echo $unit; ?></td>
                      <td><?php echo number_format($values['SDM'], 10); ?></td>
                      <td><?php echo number_format($values['Keuangan'], 10); ?></td>
                      <td><?php echo number_format($values['SarPras'], 10); ?></td>
                      <td><?php echo number_format($values['Penelitian'], 10); ?></td>
                      <td><?php echo number_format($values['Pengabdian'], 10); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Matrix Ternormalisasi Terbobot (Y)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Unit</th>
                      <th>SDM</th>
                      <th>Keuangan</th>
                      <th>Sarana Prasarana</th>
                      <th>Kegiatan Penelitian</th>
                      <th>Kegiatan Pengabdian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($weightedNormalizedMatrix as $unit => $values): ?>
                    <tr>
                      <td><?php echo $unit; ?></td>
                      <td><?php echo number_format($values['SDM'], 10); ?></td>
                      <td><?php echo number_format($values['Keuangan'], 10); ?></td>
                      <td><?php echo number_format($values['SarPras'], 10); ?></td>
                      <td><?php echo number_format($values['Penelitian'], 10); ?></td>
                      <td><?php echo number_format($values['Pengabdian'], 10); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Solusi Ideal Positif (A+)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SDM</th>
                      <th>Keuangan</th>
                      <th>Sarana Prasarana</th>
                      <th>Kegiatan Penelitian</th>
                      <th>Kegiatan Pengabdian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php foreach ($solusiIdealPositif as $value): ?>
                      <td><?php echo number_format($value, 10); ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Solusi Ideal Negatif (A-)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SDM</th>
                      <th>Keuangan</th>
                      <th>Sarana Prasarana</th>
                      <th>Kegiatan Penelitian</th>
                      <th>Kegiatan Pengabdian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php foreach ($solusiIdealNegatif as $value): ?>
                      <td><?php echo number_format($value, 10); ?></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jarak Terhadap Solusi Ideal</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Unit</th>
                      <th>Jarak Terhadap Solusi Ideal Positif</th>
                      <th>Jarak Terhadap Solusi Ideal Negatif</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($jarakSolusiIdealPositif as $unit => $jarakPositif): ?>
                    <tr>
                      <td><?php echo $unit; ?></td>
                      <td><?php echo number_format($jarakPositif, 9); ?></td>
                      <td><?php echo number_format($jarakSolusiIdealNegatif[$unit], 9); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Nilai Preferensi & Ranking</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Unit</th>
                      <th>Nilai Preferensi</th>
                      <th>Ranking</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $ranking = 1;
                    foreach ($nilaiPreferensi as $unit => $nilai): ?>
                    <tr>
                      <td><?php echo $unit; ?></td>
                      <td><?php echo number_format($nilai, 9); ?></td>
                      <td><?php echo $ranking++; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
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
