<?php
class MSurveySoal {
    private $db;
    protected $table = 'm_survey_soal';

    public function __construct($db) {
        $this->db = $db;
    }

    public function getSoalsBySurveyId($survey_id) {
        $query = $this->db->prepare("SELECT m_survey_soal.*, m_kategori.kategori_nama FROM {$this->table} LEFT JOIN m_kategori ON m_survey_soal.kategori_id = m_kategori.kategori_id WHERE survey_id = ?");
        $query->bind_param('i', $survey_id);
        $query->execute();
        return $query->get_result();
    }

    public function insertSoal($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table} (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('iiiss', $data['survey_id'], $data['kategori_id'], $data['no_urut'], $data['soal_jenis'], $data['soal_nama']);
        return $query->execute();
    }

    public function updateSoal($id, $data) {
        $query = $this->db->prepare("UPDATE {$this->table} SET no_urut = ?, soal_jenis = ?, soal_nama = ?, kategori_id = ? WHERE soal_id = ?");
        $query->bind_param('issii', $data['no_urut'], $data['soal_jenis'], $data['soal_nama'], $data['kategori_id'], $id);
        return $query->execute();
    }

    public function deleteSoal($id) {
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE soal_id = ?");
        $query->bind_param('i', $id);
        return $query->execute();
    }
}
?>
