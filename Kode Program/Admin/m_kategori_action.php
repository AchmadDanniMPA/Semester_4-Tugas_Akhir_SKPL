<?php
include_once('../Conf/config.php');
include_once('../Model/m_kategori_model.php');
$act = $_GET['act'];
$kategoriModel = new MKategori($koneksi);
$response = ['status' => 'error', 'message' => 'An error occurred'];
if ($act == 'add') {
  $kategori_nama = $_POST['kategori_nama'];
  if ($kategoriModel->insertCategory($kategori_nama)) {
    $response = ['status' => 'success', 'message' => 'Kategori berhasil ditambahkan'];
  }
} elseif ($act == 'edit') {
  $id = $_GET['id'];
  $kategori_nama = $_POST['kategori_nama'];
  if ($kategoriModel->updateCategory($id, $kategori_nama)) {
    $response = ['status' => 'success', 'message' => 'Kategori berhasil diperbarui'];
  }
} elseif ($act == 'delete') {
  $id = $_GET['id'];
  if ($kategoriModel->deleteCategory($id)) {
    $response = ['status' => 'success', 'message' => 'Kategori berhasil dihapus'];
  }
}
header('Content-Type: application/json');
echo json_encode($response);
?>
