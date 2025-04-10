<?php
include_once('../Conf/config.php');
include_once('../Model/m_survey_model.php');
$act = $_GET['act'];
$surveyModel = new MSurvey($koneksi);
if ($act == 'add') {
  $data = [
    'survey_jenis' => $_POST['survey_jenis'],
    'survey_kode' => $_POST['survey_kode'],
    'survey_nama' => $_POST['survey_nama'],
    'survey_deskripsi' => $_POST['survey_deskripsi'],
    'survey_tanggal' => $_POST['survey_tanggal']
  ];
  $surveyModel->insertSurvey($data);
  header('Location: m_survey.php');
} elseif ($act == 'edit') {
  $id = $_GET['id'];
  $data = [
    'survey_jenis' => $_POST['survey_jenis'],
    'survey_kode' => $_POST['survey_kode'],
    'survey_nama' => $_POST['survey_nama'],
    'survey_deskripsi' => $_POST['survey_deskripsi'],
    'survey_tanggal' => $_POST['survey_tanggal']
  ];
  $surveyModel->updateSurvey($id, $data);
  header('Location: m_survey.php');
} elseif ($act == 'delete') {
  $id = $_GET['id'];
  $surveyModel->deleteSurvey($id);
  header('Location: m_survey.php');
}
?>
