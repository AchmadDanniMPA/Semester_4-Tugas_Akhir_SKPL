<?php
require '../vendor/autoload.php';
include_once 'config.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sql = "
SELECT 
    r.responden_nama AS 'Nama Responden', 
    r.responden_unit AS 'Unit',
    MAX(CASE WHEN j.soal_id = 1 THEN j.jawaban END) AS 'jawaban1',
    MAX(CASE WHEN j.soal_id = 2 THEN j.jawaban END) AS 'jawaban2',
    MAX(CASE WHEN j.soal_id = 3 THEN j.jawaban END) AS 'jawaban3',
    MAX(CASE WHEN j.soal_id = 4 THEN j.jawaban END) AS 'jawaban4',
    MAX(CASE WHEN j.soal_id = 5 THEN j.jawaban END) AS 'jawaban5',
    MAX(CASE WHEN j.soal_id = 6 THEN j.jawaban END) AS 'jawaban6',
    MAX(CASE WHEN j.soal_id = 7 THEN j.jawaban END) AS 'jawaban7',
    MAX(CASE WHEN j.soal_id = 8 THEN j.jawaban END) AS 'jawaban8',
    MAX(CASE WHEN j.soal_id = 9 THEN j.jawaban END) AS 'jawaban9',
    MAX(CASE WHEN j.soal_id = 10 THEN j.jawaban END) AS 'jawaban10',
    MAX(CASE WHEN j.soal_id = 11 THEN j.jawaban END) AS 'jawaban11',
    MAX(CASE WHEN j.soal_id = 12 THEN j.jawaban END) AS 'jawaban12',
    MAX(CASE WHEN j.soal_id = 13 THEN j.jawaban END) AS 'jawaban13',
    MAX(CASE WHEN j.soal_id = 14 THEN j.jawaban END) AS 'jawaban14',
    MAX(CASE WHEN j.soal_id = 15 THEN j.jawaban END) AS 'jawaban15',
    MAX(CASE WHEN j.soal_id = 16 THEN j.jawaban END) AS 'jawaban16',
    MAX(CASE WHEN j.soal_id = 17 THEN j.jawaban END) AS 'jawaban17',
    MAX(CASE WHEN j.soal_id = 18 THEN j.jawaban END) AS 'jawaban18',
    MAX(CASE WHEN j.soal_id = 19 THEN j.jawaban END) AS 'jawaban19',
    MAX(CASE WHEN j.soal_id = 20 THEN j.jawaban END) AS 'jawaban20',
    MAX(CASE WHEN j.soal_id = 21 THEN j.jawaban END) AS 'jawaban21',
    MAX(CASE WHEN j.soal_id = 22 THEN j.jawaban END) AS 'jawaban22',
    MAX(CASE WHEN j.soal_id = 23 THEN j.jawaban END) AS 'jawaban23',
    MAX(CASE WHEN j.soal_id = 24 THEN j.jawaban END) AS 'jawaban24',
    MAX(CASE WHEN j.soal_id = 25 THEN j.jawaban END) AS 'jawaban25',
    MAX(CASE WHEN j.soal_id = 26 THEN j.jawaban END) AS 'jawaban26',
    MAX(CASE WHEN j.soal_id = 27 THEN j.jawaban END) AS 'jawaban27',
    MAX(CASE WHEN j.soal_id = 28 THEN j.jawaban END) AS 'jawaban28',
    MAX(CASE WHEN j.soal_id = 29 THEN j.jawaban END) AS 'jawaban29',
    MAX(CASE WHEN j.soal_id = 30 THEN j.jawaban END) AS 'jawaban30',
    MAX(CASE WHEN j.soal_id = 31 THEN j.jawaban END) AS 'jawaban31',
    MAX(CASE WHEN j.soal_id = 32 THEN j.jawaban END) AS 'jawaban32',
    MAX(CASE WHEN j.soal_id = 33 THEN j.jawaban END) AS 'jawaban33',
    MAX(CASE WHEN j.soal_id = 34 THEN j.jawaban END) AS 'jawaban34',
    MAX(CASE WHEN j.soal_id = 35 THEN j.jawaban END) AS 'jawaban35',
    MAX(CASE WHEN j.soal_id = 36 THEN j.jawaban END) AS 'jawaban36',
    MAX(CASE WHEN j.soal_id = 37 THEN j.jawaban END) AS 'jawaban37',
    MAX(CASE WHEN j.soal_id = 38 THEN j.jawaban END) AS 'jawaban38',
    MAX(CASE WHEN j.soal_id = 39 THEN j.jawaban END) AS 'jawaban39',
    MAX(CASE WHEN j.soal_id = 40 THEN j.jawaban END) AS 'jawaban40',
    MAX(CASE WHEN j.soal_id = 41 THEN j.jawaban END) AS 'jawaban41',
    MAX(CASE WHEN j.soal_id = 42 THEN j.jawaban END) AS 'jawaban42',
    MAX(CASE WHEN j.soal_id = 43 THEN j.jawaban END) AS 'jawaban43',
    MAX(CASE WHEN j.soal_id = 44 THEN j.jawaban END) AS 'jawaban44',
    MAX(CASE WHEN j.soal_id = 45 THEN j.jawaban END) AS 'jawaban45',
    MAX(CASE WHEN j.soal_id = 46 THEN j.jawaban END) AS 'jawaban46',
    MAX(CASE WHEN j.soal_id = 47 THEN j.jawaban END) AS 'jawaban47',
    MAX(CASE WHEN j.soal_id = 48 THEN j.jawaban END) AS 'jawaban48',
    MAX(CASE WHEN j.soal_id = 49 THEN j.jawaban END) AS 'jawaban49',
    MAX(CASE WHEN j.soal_id = 50 THEN j.jawaban END) AS 'jawaban50',
    MAX(CASE WHEN j.soal_id = 51 THEN j.jawaban END) AS 'jawaban51',
    MAX(CASE WHEN j.soal_id = 52 THEN j.jawaban END) AS 'jawaban52',
    MAX(CASE WHEN j.soal_id = 53 THEN j.jawaban END) AS 'jawaban53',
    MAX(CASE WHEN j.soal_id = 54 THEN j.jawaban END) AS 'jawaban54',
    MAX(CASE WHEN j.soal_id = 55 THEN j.jawaban END) AS 'jawaban55'
FROM (
    SELECT 
        responden_dosen_id AS responden_id, 
        responden_nama, 
        responden_unit 
    FROM t_responden_dosen
    UNION ALL
    SELECT 
        responden_tendik_id AS responden_id, 
        responden_nama, 
        responden_unit 
    FROM t_responden_tendik
) r
LEFT JOIN (
    SELECT 
        responden_dosen_id AS responden_id, 
        soal_id, 
        jawaban 
    FROM t_jawaban_dosen
    UNION ALL
    SELECT 
        responden_tendik_id AS responden_id, 
        soal_id, 
        jawaban 
    FROM t_jawaban_tendik
) j ON r.responden_id = j.responden_id
GROUP BY r.responden_nama, r.responden_unit
ORDER BY r.responden_unit, r.responden_nama";

$result = $koneksi->query($sql);
$headers = [
    'Nama Responden', 'Unit', 
    'jawaban1', 'jawaban2', 'jawaban3', 'jawaban4', 'jawaban5', 
    'jawaban6', 'jawaban7', 'jawaban8', 'jawaban9', 'jawaban10',
    'jawaban11', 'jawaban12', 'jawaban13', 'jawaban14', 'jawaban15',
    'jawaban16', 'jawaban17', 'jawaban18', 'jawaban19', 'jawaban20',
    'jawaban21', 'jawaban22', 'jawaban23', 'jawaban24', 'jawaban25',
    'jawaban26', 'jawaban27', 'jawaban28', 'jawaban29', 'jawaban30',
    'jawaban31', 'jawaban32', 'jawaban33', 'jawaban34', 'jawaban35',
    'jawaban36', 'jawaban37', 'jawaban38', 'jawaban39', 'jawaban40',
    'jawaban41', 'jawaban42', 'jawaban43', 'jawaban44', 'jawaban45',
    'jawaban46', 'jawaban47', 'jawaban48', 'jawaban49', 'jawaban50',
    'jawaban51', 'jawaban52', 'jawaban53', 'jawaban54', 'jawaban55'
];
$sheet->fromArray($headers, NULL, 'A1');
$row_num = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->fromArray($row, NULL, 'A' . $row_num);
    $row_num++;
}
$writer = new Xlsx($spreadsheet);
$writer->save('responden_survey.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="responden_survey.xlsx"');
$writer->save('php://output');
exit;
