<?php
class SurveyMitra {
    private $db;
    private $table_responden = 't_responden_industri';
    private $table_jawaban = 't_jawaban_industri';

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertResponden($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_responden} (survey_id, responden_tanggal, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?)");
        $query->bind_param('issssss', $data['survey_id'], $data['responden_nama'], $data['responden_jabatan'], $data['responden_perusahaan'], $data['responden_email'], $data['responden_hp'], $data['responden_kota']);
        $query->execute();
        return $this->db->insert_id;
    }

    public function insertJawaban($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_jawaban} (responden_industri_id, soal_id, jawaban) VALUES (?, ?, ?)");
        $query->bind_param('iis', $data['responden_industri_id'], $data['soal_id'], $data['jawaban']);
        $query->execute();
    }

    public function getSoalBySurveyId($survey_id) {
        $query = $this->db->prepare("SELECT * FROM m_survey_soal WHERE survey_id = ?");
        $query->bind_param('i', $survey_id);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKategoriById($kategori_id) {
        $query = $this->db->prepare("SELECT * FROM m_kategori WHERE kategori_id = ?");
        $query->bind_param('i', $kategori_id);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_assoc();
    }
}
?>
