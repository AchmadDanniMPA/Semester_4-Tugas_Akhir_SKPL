<?php
class MSurvey {
    private $db;
    protected $table = 'm_survey';

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllSurveys() {
        $query = "SELECT * FROM {$this->table}";
        return $this->db->query($query);
    }

    public function getSurveyById($id) {
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE survey_id = ?");
        $query->bind_param('i', $id);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function insertSurvey($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table} (survey_jenis, survey_kode, survey_nama, survey_deskripsi, survey_tanggal) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('sssss', $data['survey_jenis'], $data['survey_kode'], $data['survey_nama'], $data['survey_deskripsi'], $data['survey_tanggal']);
        return $query->execute();
    }

    public function updateSurvey($id, $data) {
        $query = $this->db->prepare("UPDATE {$this->table} SET survey_jenis = ?, survey_kode = ?, survey_nama = ?, survey_deskripsi = ?, survey_tanggal = ? WHERE survey_id = ?");
        $query->bind_param('sssssi', $data['survey_jenis'], $data['survey_kode'], $data['survey_nama'], $data['survey_deskripsi'], $data['survey_tanggal'], $id);
        return $query->execute();
    }
}
?>
