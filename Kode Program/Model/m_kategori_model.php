<?php
class MKategori {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCategories() {
        $query = "SELECT * FROM m_kategori";
        return $this->db->query($query);
    }

    public function getCategoryById($id) {
        $query = $this->db->prepare("SELECT * FROM m_kategori WHERE kategori_id = ?");
        $query->bind_param('i', $id);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function insertCategory($kategori_nama) {
        $query = $this->db->prepare("INSERT INTO m_kategori (kategori_nama) VALUES (?)");
        $query->bind_param('s', $kategori_nama);
        return $query->execute();
    }

    public function updateCategory($id, $kategori_nama) {
        $query = $this->db->prepare("UPDATE m_kategori SET kategori_nama = ? WHERE kategori_id = ?");
        $query->bind_param('si', $kategori_nama, $id);
        return $query->execute();
    }

    public function deleteCategory($id) {
        $query = $this->db->prepare("DELETE FROM m_kategori WHERE kategori_id = ?");
        $query->bind_param('i', $id);
        return $query->execute();
    }
}
?>
