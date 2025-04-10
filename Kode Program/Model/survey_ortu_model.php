<?php
class SurveyOrtu {
    private $db;
    private $table_responden = 't_responden_ortu';
    private $table_jawaban = 't_jawaban_ortu';

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertResponden($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_responden} (survey_id, responden_tanggal, responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, tahun_masuk, mahasiswa_prodi) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('ississssssis', $data['survey_id'], $data['responden_nama'], $data['responden_jk'], $data['responden_umur'], $data['responden_hp'], $data['responden_pendidikan'], $data['responden_pekerjaan'], $data['responden_penghasilan'], $data['mahasiswa_nim'], $data['mahasiswa_nama'], $data['tahun_masuk'], $data['mahasiswa_prodi']);
        $query->execute();
        return $this->db->insert_id;
    }

    public function insertJawaban($data) {
        $query = $this->db->prepare("INSERT INTO {$this->table_jawaban} (responden_ortu_id, soal_id, jawaban) VALUES (?, ?, ?)");
        $query->bind_param('iis', $data['responden_ortu_id'], $data['soal_id'], $data['jawaban']);
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
