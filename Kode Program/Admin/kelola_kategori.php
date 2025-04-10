<?php
include_once('../Conf/config.php');
include_once('../Model/m_kategori_model.php');
include_once('../Conf/cek_login.php');
include_once('../Conf/config.php');

$kategoriModel = new MKategori($koneksi);
$categories = $kategoriModel->getAllCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Kategori</title>
  <link rel="stylesheet" href="../Template/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../Template/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Kategori</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategoriModal">
                +Tambah Kategori
              </button>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Kategori</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="kategoriTable">
                <?php while ($row = $categories->fetch_assoc()): ?>
                  <tr id="kategoriRow<?php echo $row['kategori_id']; ?>">
                    <td><?php echo $row['kategori_id']; ?></td>
                    <td><?php echo $row['kategori_nama']; ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editKategoriModal<?php echo $row['kategori_id']; ?>">Edit</button>
                      <button type="button" class="btn btn-danger" onclick="deleteKategori(<?php echo $row['kategori_id']; ?>)">Hapus</button>
                    </td>
                  </tr>
                  <div class="modal fade" id="editKategoriModal<?php echo $row['kategori_id']; ?>" tabindex="-1" aria-labelledby="editKategoriModalLabel<?php echo $row['kategori_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editKategoriModalLabel<?php echo $row['kategori_id']; ?>">Edit Kategori</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="editKategoriForm<?php echo $row['kategori_id']; ?>" onsubmit="event.preventDefault(); editKategori(<?php echo $row['kategori_id']; ?>);">
                            <div class="form-group">
                              <label for="kategori_nama<?php echo $row['kategori_id']; ?>">Nama Kategori</label>
                              <input type="text" name="kategori_nama" id="kategori_nama<?php echo $row['kategori_id']; ?>" class="form-control" value="<?php echo $row['kategori_nama']; ?>" required>
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
        </div>
      </div>
    </section>
  </div>
</div>
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambahKategoriForm" onsubmit="event.preventDefault(); tambahKategori();">
          <div class="form-group">
            <label for="kategori_nama">Nama Kategori</label>
            <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
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
function tambahKategori() {
  var form = $('#tambahKategoriForm');
  $.ajax({
    type: 'POST',
    url: 'm_kategori_action.php?act=add',
    data: form.serialize(),
    success: function(response) {
      if (response.status == 'success') {
        $('#tambahKategoriModal').modal('hide');
        location.reload();
      } else {
        alert(response.message);
      }
    }
  });
}
function editKategori(id) {
  var form = $('#editKategoriForm' + id);
  $.ajax({
    type: 'POST',
    url: 'm_kategori_action.php?act=edit&id=' + id,
    data: form.serialize(),
    success: function(response) {
      if (response.status == 'success') {
        $('#editKategoriModal' + id).modal('hide');
        location.reload();
      } else {
        alert(response.message);
      }
    }
  });
}
function deleteKategori(id) {
  if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
    $.ajax({
      type: 'GET',
      url: 'm_kategori_action.php?act=delete&id=' + id,
      success: function(response) {
        if (response.status == 'success') {
          $('#kategoriRow' + id).remove();
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
