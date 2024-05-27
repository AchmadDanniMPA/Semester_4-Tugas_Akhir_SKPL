CREATE DATABASE PemWebTugasAkhir;

USE PemWebTugasAkhir;

CREATE TABLE m_user (
    user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(20),
    nama varchar(50),
    password varchar(255)
);
CREATE TABLE m_kategori (
    kategori_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    kategori_nama varchar(255)
);
CREATE TABLE m_survey (
    survey_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    survey_jenis enum(
        'Mahasiswa', 
        'Orang Tua', 
        'Kepuasan Mitra', 
        'Alumni', 
        'Dosen',
        'Tendik'
    ),
    survey_kode varchar(20),
    survey_nama varchar(50),
    survey_deskripsi text,
    survey_tanggal datetime,
    FOREIGN KEY (user_id) REFERENCES m_user(user_id)
);
CREATE TABLE m_survey_soal (
    soal_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    kategori_id int,
    no_urut int,
    soal_jenis enum('Isian', 'Rating'),
    soal_nama varchar(500),
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id),
    FOREIGN KEY (kategori_id) REFERENCES m_kategori(kategori_id)
);
CREATE TABLE t_responden_dosen (
    responden_dosen_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nip varchar(20),
    responden_nama varchar(50),
    responden_unit varchar(50),
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_dosen (
    jawaban_dosen_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_dosen_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_dosen_id) REFERENCES t_responden_dosen(responden_dosen_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
CREATE TABLE t_responden_tendik (
    responden_tendik_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nopeg varchar(20),
    responden_nama varchar(50),
    responden_unit varchar(50),
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_tendik (
    jawaban_tendik_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_tendik_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_tendik_id) REFERENCES t_responden_tendik(responden_tendik_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
CREATE TABLE t_responden_mahasiswa (
    responden_mahasiswa_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nim varchar(20),
    responden_nama varchar(50),
    responden_prodi varchar(100),
    responden_email varchar(100),
    responden_hp varchar(20),
    tahun_masuk year,
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_mahasiswa (
    jawaban_mahasiswa_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_mahasiswa_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_mahasiswa_id) REFERENCES t_responden_mahasiswa(responden_mahasiswa_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
CREATE TABLE t_responden_alumni (
    responden_alumni_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nim varchar(20),
    responden_nama varchar(50),
    responden_prodi varchar(100),
    responden_email varchar(100),
    responden_hp varchar(20),
    tahun_lulus year,
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_alumni (
    jawaban_alumni_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_alumni_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_alumni_id) REFERENCES t_responden_alumni(responden_alumni_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
CREATE TABLE t_responden_ortu (
    responden_ortu_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nama varchar(50),
    responden_jk enum('L', 'P'),
    responden_umur tinyint,
    responden_hp varchar(20),
    responden_pendidikan varchar(30),
    responden_pekerjaan varchar(50),
    responden_penghasilan varchar(20),
    mahasiswa_nim varchar(20),
    mahasiswa_nama varchar(50),
    mahasiswa_prodi varchar(100),
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_ortu (
    jawaban_ortu_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_ortu_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_ortu_id) REFERENCES t_responden_ortu(responden_ortu_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
CREATE TABLE t_responden_industri (
    responden_industri_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    responden_tanggal datetime,
    responden_nama varchar(50),
    responden_jabatan varchar(50),
    responden_perusahaan varchar(50),
    responden_email varchar(100),
    responden_hp varchar(20),
    responden_kota varchar(50),
    FOREIGN KEY (survey_id) REFERENCES m_survey(survey_id)
);
CREATE TABLE t_jawaban_industri (
    jawaban_industri_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    responden_industri_id int,
    soal_id int,
    jawaban varchar(255),
    FOREIGN KEY (responden_industri_id) REFERENCES t_responden_industri(responden_industri_id),
    FOREIGN KEY (soal_id) REFERENCES m_survey_soal(soal_id)
);
