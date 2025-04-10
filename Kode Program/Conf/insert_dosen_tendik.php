<?php
include_once 'config.php';

function insertJawabanDosen($db, $responden_id, $survey_id, $soal_ids) {
    foreach ($soal_ids as $soal_id) {
        $jawaban = rand(1, 4);
        $query = $db->prepare("INSERT INTO t_jawaban_dosen (responden_dosen_id, soal_id, jawaban) VALUES (?, ?, ?)");
        $query->bind_param('iis', $responden_id, $soal_id, $jawaban);
        $query->execute();
    }
}

function insertJawabanTendik($db, $responden_id, $survey_id, $soal_ids) {
    foreach ($soal_ids as $soal_id) {
        $jawaban = rand(1, 4);
        $query = $db->prepare("INSERT INTO t_jawaban_tendik (responden_tendik_id, soal_id, jawaban) VALUES (?, ?, ?)");
        $query->bind_param('iis', $responden_id, $soal_id, $jawaban);
        $query->execute();
    }
}

function getSoalIds($db, $survey_id) {
    $query = $db->prepare("SELECT soal_id FROM m_survey_soal WHERE survey_id = ? AND soal_jenis = 'Rating'");
    $query->bind_param('i', $survey_id);
    $query->execute();
    $result = $query->get_result();
    $soal_ids = [];
    while ($row = $result->fetch_assoc()) {
        $soal_ids[] = $row['soal_id'];
    }
    return $soal_ids;
}

$survey_id_dosen = 1;
$survey_id_tendik = 2;
$soal_ids_dosen = getSoalIds($koneksi, $survey_id_dosen);
$soal_ids_tendik = getSoalIds($koneksi, $survey_id_tendik);

$responden_dosen_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];
$responden_tendik_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25];

foreach ($responden_dosen_ids as $responden_id) {
    insertJawabanDosen($koneksi, $responden_id, $survey_id_dosen, $soal_ids_dosen);
}

foreach ($responden_tendik_ids as $responden_id) {
    insertJawabanTendik($koneksi, $responden_id, $survey_id_tendik, $soal_ids_tendik);
}

echo "Data jawaban berhasil dimasukkan.";
?>
