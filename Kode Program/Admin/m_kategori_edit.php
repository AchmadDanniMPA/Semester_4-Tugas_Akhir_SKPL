<?php
include('../Conf/config.php');
include('../Model/m_kategori_model.php');
$id = $_GET['id'];
$kategoriModel = new MKategori($koneksi);
$kategori = $kategoriModel->getCategoryById($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <form action="m_kategori_action.php?act=edit&id=<?php echo $id; ?>" method="post">
              <div class="form-group">
                <label for="kategori_nama">Nama Kategori</label>
                <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" value="<?php echo $kategori['kategori_nama']; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Edit</button>
              <a href="kelola_kategori.php" class="btn btn-secondary">Kembali</a>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script src="../Template/plugins/jquery/jquery.min.js"></script>
<script src="../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Template/dist/js/adminlte.min.js"></script>
</body>
</html>
