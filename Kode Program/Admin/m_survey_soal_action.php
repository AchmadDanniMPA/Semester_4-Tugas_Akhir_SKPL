<?php
include_once('../Conf/config.php');
include_once('../Model/m_survey_soal_model.php');
$act = $_GET['act'];
$soalModel = new MSurveySoal($koneksi);
$response = ['status' => 'error', 'message' => 'An error occurred'];
if ($act == 'add') {
  $data = [
    'survey_id' => $_POST['survey_id'],
    'kategori_id' => $_POST['kategori_id'],
    'no_urut' => $_POST['no_urut'],
    'soal_jenis' => $_POST['soal_jenis'],
    'soal_nama' => $_POST['soal_nama']
  ];
  if ($soalModel->insertSoal($data)) {
    $response = ['status' => 'success', 'message' => 'Soal berhasil ditambahkan'];
  }
} elseif ($act == 'edit') {
  $id = $_GET['id'];
  $data = [
    'no_urut' => $_POST['no_urut'],
    'soal_jenis' => $_POST['soal_jenis'],
    'soal_nama' => $_POST['soal_nama'],
    'kategori_id' => $_POST['kategori_id']
  ];
  if ($soalModel->updateSoal($id, $data)) {
    $response = ['status' => 'success', 'message' => 'Soal berhasil diperbarui'];
  }
} elseif ($act == 'delete') {
  $id = $_GET['id'];
  if ($soalModel->deleteSoal($id)) {
    $response = ['status' => 'success', 'message' => 'Soal berhasil dihapus'];
  }
}
header('Content-Type: application/json');
echo json_encode($response);
?>
