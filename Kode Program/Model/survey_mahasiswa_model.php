<?php
class SurveyMahasiswa {
    private $db;
    private $table_responden = 't_responden_mahasiswa';
    private $table_jawaban = 't_jawaban_mahasiswa';

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertResponden($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_responden} (survey_id, responden_tanggal, responden_nim, responden_nama, responden_prodi, responden_email, responden_hp, tahun_masuk) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?)");
        $query->bind_param('isssssi', $data['survey_id'], $data['responden_nim'], $data['responden_nama'], $data['responden_prodi'], $data['responden_email'], $data['responden_hp'], $data['tahun_masuk']);
        $query->execute();
        return $this->db->insert_id;
    }

    public function insertJawaban($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_jawaban} (responden_mahasiswa_id, soal_id, jawaban) VALUES (?, ?, ?)");
        $query->bind_param('iis', $data['responden_mahasiswa_id'], $data['soal_id'], $data['jawaban']);
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
