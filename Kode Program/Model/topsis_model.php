<?php
class Topsis {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getDataJawaban() {
        $query = "
            SELECT r.nama, r.unit, 
                   MAX(IF(j.soal_id = 1, j.jawaban, NULL)) AS jawaban1,
                   MAX(IF(j.soal_id = 2, j.jawaban, NULL)) AS jawaban2,
                   MAX(IF(j.soal_id = 3, j.jawaban, NULL)) AS jawaban3,
                   MAX(IF(j.soal_id = 4, j.jawaban, NULL)) AS jawaban4,
                   MAX(IF(j.soal_id = 5, j.jawaban, NULL)) AS jawaban5,
                   MAX(IF(j.soal_id = 6, j.jawaban, NULL)) AS jawaban6,
                   MAX(IF(j.soal_id = 7, j.jawaban, NULL)) AS jawaban7,
                   MAX(IF(j.soal_id = 8, j.jawaban, NULL)) AS jawaban8,
                   MAX(IF(j.soal_id = 9, j.jawaban, NULL)) AS jawaban9,
                   MAX(IF(j.soal_id = 10, j.jawaban, NULL)) AS jawaban10,
                   MAX(IF(j.soal_id = 11, j.jawaban, NULL)) AS jawaban11,
                   MAX(IF(j.soal_id = 12, j.jawaban, NULL)) AS jawaban12,
                   MAX(IF(j.soal_id = 13, j.jawaban, NULL)) AS jawaban13,
                   MAX(IF(j.soal_id = 14, j.jawaban, NULL)) AS jawaban14,
                   MAX(IF(j.soal_id = 15, j.jawaban, NULL)) AS jawaban15,
                   MAX(IF(j.soal_id = 16, j.jawaban, NULL)) AS jawaban16,
                   MAX(IF(j.soal_id = 17, j.jawaban, NULL)) AS jawaban17,
                   MAX(IF(j.soal_id = 18, j.jawaban, NULL)) AS jawaban18,
                   MAX(IF(j.soal_id = 19, j.jawaban, NULL)) AS jawaban19,
                   MAX(IF(j.soal_id = 20, j.jawaban, NULL)) AS jawaban20,
                   MAX(IF(j.soal_id = 21, j.jawaban, NULL)) AS jawaban21,
                   MAX(IF(j.soal_id = 22, j.jawaban, NULL)) AS jawaban22,
                   MAX(IF(j.soal_id = 23, j.jawaban, NULL)) AS jawaban23,
                   MAX(IF(j.soal_id = 24, j.jawaban, NULL)) AS jawaban24,
                   MAX(IF(j.soal_id = 25, j.jawaban, NULL)) AS jawaban25,
                   MAX(IF(j.soal_id = 26, j.jawaban, NULL)) AS jawaban26,
                   MAX(IF(j.soal_id = 27, j.jawaban, NULL)) AS jawaban27,
                   MAX(IF(j.soal_id = 28, j.jawaban, NULL)) AS jawaban28,
                   MAX(IF(j.soal_id = 29, j.jawaban, NULL)) AS jawaban29,
                   MAX(IF(j.soal_id = 30, j.jawaban, NULL)) AS jawaban30,
                   MAX(IF(j.soal_id = 31, j.jawaban, NULL)) AS jawaban31,
                   MAX(IF(j.soal_id = 32, j.jawaban, NULL)) AS jawaban32,
                   MAX(IF(j.soal_id = 33, j.jawaban, NULL)) AS jawaban33,
                   MAX(IF(j.soal_id = 34, j.jawaban, NULL)) AS jawaban34,
                   MAX(IF(j.soal_id = 35, j.jawaban, NULL)) AS jawaban35,
                   MAX(IF(j.soal_id = 36, j.jawaban, NULL)) AS jawaban36,
                   MAX(IF(j.soal_id = 37, j.jawaban, NULL)) AS jawaban37,
                   MAX(IF(j.soal_id = 38, j.jawaban, NULL)) AS jawaban38,
                   MAX(IF(j.soal_id = 39, j.jawaban, NULL)) AS jawaban39,
                   MAX(IF(j.soal_id = 40, j.jawaban, NULL)) AS jawaban40,
                   MAX(IF(j.soal_id = 41, j.jawaban, NULL)) AS jawaban41,
                   MAX(IF(j.soal_id = 42, j.jawaban, NULL)) AS jawaban42,
                   MAX(IF(j.soal_id = 43, j.jawaban, NULL)) AS jawaban43,
                   MAX(IF(j.soal_id = 44, j.jawaban, NULL)) AS jawaban44,
                   MAX(IF(j.soal_id = 45, j.jawaban, NULL)) AS jawaban45,
                   MAX(IF(j.soal_id = 46, j.jawaban, NULL)) AS jawaban46,
                   MAX(IF(j.soal_id = 47, j.jawaban, NULL)) AS jawaban47,
                   MAX(IF(j.soal_id = 48, j.jawaban, NULL)) AS jawaban48,
                   MAX(IF(j.soal_id = 49, j.jawaban, NULL)) AS jawaban49,
                   MAX(IF(j.soal_id = 50, j.jawaban, NULL)) AS jawaban50,
                   MAX(IF(j.soal_id = 51, j.jawaban, NULL)) AS jawaban51,
                   MAX(IF(j.soal_id = 52, j.jawaban, NULL)) AS jawaban52,
                   MAX(IF(j.soal_id = 53, j.jawaban, NULL)) AS jawaban53,
                   MAX(IF(j.soal_id = 54, j.jawaban, NULL)) AS jawaban54,
                   MAX(IF(j.soal_id = 55, j.jawaban, NULL)) AS jawaban55
            FROM (
                SELECT responden_dosen_id AS responden_id, responden_nama AS nama, responden_unit AS unit 
                FROM t_responden_dosen
                UNION ALL
                SELECT responden_tendik_id AS responden_id, responden_nama AS nama, responden_unit AS unit 
                FROM t_responden_tendik
            ) r
            LEFT JOIN (
                SELECT responden_dosen_id AS responden_id, soal_id, jawaban 
                FROM t_jawaban_dosen
                UNION ALL
                SELECT responden_tendik_id AS responden_id, soal_id, jawaban 
                FROM t_jawaban_tendik
            ) j ON r.responden_id = j.responden_id
            GROUP BY r.nama, r.unit
            ORDER BY r.unit, r.nama;
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAveragePerCategory() {
        $query = "
            SELECT responden_unit AS unit, 
                   AVG(jawaban1) AS SDM,
                   AVG(jawaban2) AS Keuangan,
                   AVG(jawaban3) AS SarPras,
                   AVG(jawaban4) AS Penelitian,
                   AVG(jawaban5) AS Pengabdian
            FROM (
                SELECT responden_unit, 
                       AVG(IF(soal_id BETWEEN 1 AND 10, jawaban, NULL)) AS jawaban1,
                       AVG(IF(soal_id BETWEEN 11 AND 20, jawaban, NULL)) AS jawaban2,
                       AVG(IF(soal_id BETWEEN 21 AND 29, jawaban, NULL)) AS jawaban3,
                       AVG(IF(soal_id BETWEEN 30 AND 42, jawaban, NULL)) AS jawaban4,
                       AVG(IF(soal_id BETWEEN 43 AND 55, jawaban, NULL)) AS jawaban5
                FROM (
                    SELECT responden_unit, soal_id, jawaban
                    FROM t_responden_dosen
                    JOIN t_jawaban_dosen ON t_responden_dosen.responden_dosen_id = t_jawaban_dosen.responden_dosen_id
                    UNION ALL
                    SELECT responden_unit, soal_id, jawaban
                    FROM t_responden_tendik
                    JOIN t_jawaban_tendik ON t_responden_tendik.responden_tendik_id = t_jawaban_tendik.responden_tendik_id
                ) r
                GROUP BY responden_unit, soal_id
            ) avg_data
            GROUP BY unit
            ORDER BY unit;
        ";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNormalizedMatrix($avgData, $pembagi) {
        $normalizedMatrix = [];
        foreach ($avgData as $row) {
            $normalizedMatrix[$row['unit']] = [
                'SDM' => $row['SDM'] / $pembagi['SDM'],
                'Keuangan' => $row['Keuangan'] / $pembagi['Keuangan'],
                'SarPras' => $row['SarPras'] / $pembagi['SarPras'],
                'Penelitian' => $row['Penelitian'] / $pembagi['Penelitian'],
                'Pengabdian' => $row['Pengabdian'] / $pembagi['Pengabdian']
            ];
        }
        return $normalizedMatrix;
    }

    public function getWeightedNormalizedMatrix($normalizedMatrix, $weights) {
        $weightedNormalizedMatrix = [];
        foreach ($normalizedMatrix as $unit => $row) {
            $weightedNormalizedMatrix[$unit] = [
                'SDM' => $row['SDM'] * $weights['SDM'],
                'Keuangan' => $row['Keuangan'] * $weights['Keuangan'],
                'SarPras' => $row['SarPras'] * $weights['SarPras'],
                'Penelitian' => $row['Penelitian'] * $weights['Penelitian'],
                'Pengabdian' => $row['Pengabdian'] * $weights['Pengabdian']
            ];
        }
        return $weightedNormalizedMatrix;
    }

    public function getSolusiIdealPositif($weightedNormalizedMatrix) {
        $solusiIdealPositif = [];
        foreach (['SDM', 'Keuangan', 'SarPras', 'Penelitian', 'Pengabdian'] as $kategori) {
            $maxValue = 0;
            foreach ($weightedNormalizedMatrix as $row) {
                if ($row[$kategori] > $maxValue) {
                    $maxValue = $row[$kategori];
                }
            }
            $solusiIdealPositif[$kategori] = $maxValue;
        }
        return $solusiIdealPositif;
    }

    public function getSolusiIdealNegatif($weightedNormalizedMatrix) {
        $solusiIdealNegatif = [];
        foreach (['SDM', 'Keuangan', 'SarPras', 'Penelitian', 'Pengabdian'] as $kategori) {
            $minValue = PHP_INT_MAX;
            foreach ($weightedNormalizedMatrix as $row) {
                if ($row[$kategori] < $minValue) {
                    $minValue = $row[$kategori];
                }
            }
            $solusiIdealNegatif[$kategori] = $minValue;
        }
        return $solusiIdealNegatif;
    }

    public function getJarakSolusiIdeal($weightedNormalizedMatrix, $solusiIdeal, $isPositif) {
        $jarakSolusiIdeal = [];
        foreach ($weightedNormalizedMatrix as $unit => $row) {
            $sumSquares = 0;
            foreach ($row as $kategori => $value) {
                $sumSquares += pow($solusiIdeal[$kategori] - $value, 2);
            }
            $jarakSolusiIdeal[$unit] = sqrt($sumSquares);
        }
        return $jarakSolusiIdeal;
    }

    public function getNilaiPreferensi($jarakSolusiIdealPositif, $jarakSolusiIdealNegatif) {
        $nilaiPreferensi = [];
        foreach ($jarakSolusiIdealPositif as $unit => $jarakPositif) {
            $nilaiPreferensi[$unit] = $jarakSolusiIdealNegatif[$unit] / ($jarakSolusiIdealNegatif[$unit] + $jarakPositif);
        }
        return $nilaiPreferensi;
    }
}
?>
