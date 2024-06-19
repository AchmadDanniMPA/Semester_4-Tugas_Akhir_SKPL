CREATE DATABASE PemWebTugasAkhir;

USE PemWebTugasAkhir;

CREATE TABLE m_user (
    user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(20),
    nama varchar(50),
    password varchar(255)
);
INSERT INTO m_user (user_id, username, nama, password) VALUES (NULL, 'admin', 'Admin', '$2y$10$d2qc0eQYRZwu6ufvbMJ8YOKzDYpRNl0tEII8Plo7y4a1zCaCxByq2');
CREATE TABLE m_kategori (
    kategori_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    kategori_nama varchar(255)
);
CREATE TABLE m_survey (
    survey_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
    survey_tanggal datetime
);
CREATE TABLE m_survey_soal (
    soal_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id int,
    kategori_id int,
    no_urut int,
    soal_jenis enum('Rating','Isian'),
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

/*m_survey*/
INSERT INTO m_survey (survey_id, survey_jenis, survey_kode, survey_nama, survey_deskripsi, survey_tanggal) VALUES
(1, 'Dosen', 'DSN001', 'Survey Dosen 2024', 'Survey Dosen 2024', CURDATE()),
(2, 'Tendik', 'TND001', 'Survey Tendik 2024', 'Survey Tendik 2024', CURDATE()),
(3, 'Mahasiswa', 'MHS001', 'Survey Mahasiswa 2024', 'Survey Mahasiswa 2024', CURDATE()),
(4, 'Orang Tua', 'ORT001', 'Survey Orang Tua 2024', 'Survey Orang Tua 2024', CURDATE()),
(5, 'Kepuasan Mitra', 'KPM001', 'Survey Kepuasan Mitra 2024', 'Survey Kepuasan Mitra 2024', CURDATE()),
(6, 'Alumni', 'ALM001', 'Survey Alumni 2024', 'Survey Alumni 2024', CURDATE());

/*m_kategori*/
INSERT INTO m_kategori (kategori_id, kategori_nama) VALUES
(1, 'Sistem Pengelolaan SDM'),
(2, 'Sistem Pengelolaan Keuangan'),
(3, 'Sistem Pengelolaan Sarana Prasarana'),
(4, 'Sistem Pengelolaan Kegiatan Penelitian'),
(5, 'Sistem Pengelolaan Kegiatan Pengabdian'),
(6, 'Kondisi Sarana Prasarana'),
(7, 'Kemampuan Tenaga Pengajar untuk Kegiatan Akademik'),
(8, 'Layanan Masalah Akademik dan Non_Akademik'),
(9, 'Keadilan Perlakuan Akademik'),
(10, 'Layanan Keuangan dan Prestasi Mahasiswa'),
(11, 'Transparansi Informasi dan Layanan Akademik'),
(12, 'Layanan Informasi Polinema'),
(13, 'Kemajuan Mahasiswa sebagai hasil Pengajaran di Polinema'),
(14, 'Layanan Keluhan Akademik dan Pasca Kelulusan'),
(15, 'Pelacakan Pengguna Lulusan Polinema (Tracing of Polinema Alumni User)'),
(16, 'Etika (Ethics)'),
(17, 'Kepemimpinan (Leaderships)'),
(18, 'Etos Kerja (Work Ethic)'),
(19, 'Kemampuan Berkomunikasi (Communication Skill)'),
(20, 'Kerjasama Tim (Teamwork)'),
(21, 'Keahlian Bidang Ilmu (Technical Skill)'),
(22, 'Kemampuan Berbahasa Asing (Foreign Language Skill Ability)'),
(23, 'Penggunaan Teknologi Informasi (Information Technology Skill Ability)'),
(24, 'Pengembangan Diri (Self-Development)'),
(25, 'Alumni');

/*m_survey_soal
Dosen*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 1, 1, 'Rating', 'Pengelola sumber daya manusia mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(1, 1, 2, 'Rating', 'Pengelola sumber daya manusia dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(1, 1, 3, 'Rating', 'Pengelola sumber daya manusia ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(1, 1, 4, 'Rating', 'Pengelola sumber daya manusia dapat dipercaya dalam menjaga data pelanggan'),
(1, 1, 5, 'Rating', 'Pengelola sumber daya manusia mudah ditemui'),
(1, 1, 6, 'Rating', 'Pengelola sumber daya manusia memberikan informasi yang cepat dan akurat'),
(1, 1, 7, 'Rating', 'Pengelola sumber daya manusia tanggap mendengarkan saran dan keluhan pelanggan'),
(1, 1, 8, 'Rating', 'Pengelola sumber daya manusia jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(1, 1, 9, 'Rating', 'Pengelola sumber daya manusia menggunakan bahasa yang mudah dipahami dan sopan dalam memberikan pelayanan sesuai dengan kebutuhan'),
(1, 1, 10, 'Rating', 'Pengelola sumber daya melaksanakan pengelolaan dan layanan kepegawaian sesuai dengan sistem dan prosedur yang ditetapkan');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 2, 1, 'Rating', 'Pengelola keuangan mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(1, 2, 2, 'Rating', 'Pengelola keuangan dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(1, 2, 3, 'Rating', 'Pengelola keuangan ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(1, 2, 4, 'Rating', 'Pengelola keuangan dapat dipercaya dalam menjaga data pelanggan'),
(1, 2, 5, 'Rating', 'Pengelola keuangan mudah ditemui'),
(1, 2, 6, 'Rating', 'Pengelola keuangan memberikan informasi yang cepat dan akurat'),
(1, 2, 7, 'Rating', 'Pengelola keuangan tanggap mendengarkan saran dan keluhan pelanggan'),
(1, 2, 8, 'Rating', 'Pengelola keuangan jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(1, 2, 9, 'Rating', 'Pengelola keuangan menggunakan bahasa yang mudah dipahami dan sopan dalam memberikan pelayanan sesuai dengan kebutuhan'),
(1, 2, 10, 'Rating', 'Pengelola keuangan melaksanakan pengelolaan dan layanan keuangan sesuai dengan sistem dan prosedur yang ditetapkan');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 3, 1, 'Rating', 'Pengelola sarana dan prasarana mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(1, 3, 2, 'Rating', 'Pengelola sarana dan prasarana dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(1, 3, 3, 'Rating', 'Pengelola sarana dan prasarana ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(1, 3, 4, 'Rating', 'Pengelola sarana dan prasarana dapat dipercaya dalam menjaga data pelanggan'),
(1, 3, 5, 'Rating', 'Pengelola sarana dan prasarana mudah ditemui'),
(1, 3, 6, 'Rating', 'Pengelola sarana dan prasarana memberikan informasi yang cepat dan akurat'),
(1, 3, 7, 'Rating', 'Pengelola sarana dan prasarana tanggap mendengarkan saran dan keluhan pelanggan'),
(1, 3, 8, 'Rating', 'Pengelola sarana dan prasarana jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(1, 3, 9, 'Rating', 'Sarana dan prasarana di Polinema sangat mendukung pelaksanaan aktivitas pembelajaran dan perkantoran');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 4, 1, 'Rating', 'P3M Polinema menyediakan informasi tentang kegiatan penelitian'),
(1, 4, 2, 'Rating', 'P3M Polinema menyediakan pelayanan untuk melakukan kegiatan penelitian'),
(1, 4, 3, 'Rating', 'P3M Polinema menyediakan buku panduan dan renstra penelitian'),
(1, 4, 4, 'Rating', 'P3M Polinema menyediakan Sistem Informasi untuk melaksanakan penelitian'),
(1, 4, 5, 'Rating', 'P3M Polinema melakukan monitoring dan evaluasi terhadap pelaksanaan penelitian'),
(1, 4, 6, 'Rating', 'P3M Polinema melakukan evaluasi terhadap hasil penelitian'),
(1, 4, 7, 'Rating', 'P3M melakukan pengelolaan dana penelitian dan dengan mempertimbangkan jurusan-jurusan dan dosen-dosen yang ada di Polinema'),
(1, 4, 8, 'Rating', 'P3M Polinema memberikan beberapa skema penelitian yang berbeda sebagai alternatif pilihan untuk para peneliti dengan anggaran yang disesuaikan setiap skema penelitian'),
(1, 4, 9, 'Rating', 'P3M Polinema menyediakan kesempatan bimbingan penyusunan proposal penelitian dan laporan akhir'),
(1, 4, 10, 'Rating', 'P3M Polinema memberikan pelatihan dan pendampingan penulisan proposal penelitian tingkat nasional'),
(1, 4, 11, 'Rating', 'P3M Polinema menyelenggarakan konferensi nasional/internasional sebagai salah satu media diseminasi luaran penelitian'),
(1, 4, 12, 'Rating', 'P3M Polinema mendorong partisipasi aktif para peneliti untuk mempublikasikan artikel di jurnal, pengajuan HKI (Hak Kekayaan Intelektual) melalui sentra KI'),
(1, 4, 13, 'Rating', 'Polinema melalui Bidang 1 mendanai konferensi nasional/internasional bagi peneliti untuk mendiseminasi hasil penelitian');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 5, 1, 'Rating', 'P3M Polinema menyediakan informasi tentang kegiatan PkM'),
(1, 5, 2, 'Rating', 'P3M Polinema menyediakan pelayanan untuk melakukan kegiatan PkM'),
(1, 5, 3, 'Rating', 'P3M Polinema menyediakan buku panduan dan renstra PkM'),
(1, 5, 4, 'Rating', 'P3M Polinema menyediakan Sistem Informasi untuk melaksanakan PkM'),
(1, 5, 5, 'Rating', 'P3M Polinema melakukan monitoring dan evaluasi terhadap pelaksanaan PkM'),
(1, 5, 6, 'Rating', 'P3M Polinema melakukan evaluasi terhadap hasil pelaksanaan PkM'),
(1, 5, 7, 'Rating', 'P3M Polinema melakukan pengelolaan dana PkM dengan mempertimbangkan jurusan-jurusan dan dosen-dosen yang ada di Polinema'),
(1, 5, 8, 'Rating', 'P3M Polinema memberikan beberapa skema PkM yang berbeda sebagai alternatif pilihan untuk para pelaksana kegiatan dengan anggaran yang disesuaikan setiap skema PkM'),
(1, 5, 9, 'Rating', 'P3M Polinema menyediakan kesempatan bimbingan penyusunan proposal PkM dan laporan akhir'),
(1, 5, 10, 'Rating', 'P3M Polinema memberikan pelatihan dan pendampingan penulisan proposal PkM kompetisi tingkat nasional'),
(1, 5, 11, 'Rating', 'P3M Polinema menyelenggarakan konferensi nasional/internasional sebagai salah satu media diseminasi luaran PkM'),
(1, 5, 12, 'Rating', 'P3M Polinema mendorong partisipasi aktif para pelaksana PkM untuk mempublikasikan artikel di jurnal, pengajuan HKI (Hak Kekayaan Intelektual) melalui sentra KI'),
(1, 5, 13, 'Rating', 'Polinema melalui Bidang 1 mendanai konferensi nasional/internasional bagi pelaksana kegiatan PkM untuk mendiseminasi hasil PkM');
/*Tendik*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 1, 1, 'Rating', 'Pengelola sumber daya manusia mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(2, 1, 2, 'Rating', 'Pengelola sumber daya manusia dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(2, 1, 3, 'Rating', 'Pengelola sumber daya manusia ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(2, 1, 4, 'Rating', 'Pengelola sumber daya manusia dapat dipercaya dalam menjaga data pelanggan'),
(2, 1, 5, 'Rating', 'Pengelola sumber daya manusia mudah ditemui'),
(2, 1, 6, 'Rating', 'Pengelola sumber daya manusia memberikan informasi yang cepat dan akurat'),
(2, 1, 7, 'Rating', 'Pengelola sumber daya manusia tanggap mendengarkan saran dan keluhan pelanggan'),
(2, 1, 8, 'Rating', 'Pengelola sumber daya manusia jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(2, 1, 9, 'Rating', 'Pengelola sumber daya manusia menggunakan bahasa yang mudah dipahami dan sopan dalam memberikan pelayanan sesuai dengan kebutuhan'),
(2, 1, 10, 'Rating', 'Pengelola sumber daya melaksanakan pengelolaan dan layanan kepegawaian sesuai dengan sistem dan prosedur yang ditetapkan');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 2, 1, 'Rating', 'Pengelola keuangan mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(2, 2, 2, 'Rating', 'Pengelola keuangan dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(2, 2, 3, 'Rating', 'Pengelola keuangan ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(2, 2, 4, 'Rating', 'Pengelola keuangan dapat dipercaya dalam menjaga data pelanggan'),
(2, 2, 5, 'Rating', 'Pengelola keuangan mudah ditemui'),
(2, 2, 6, 'Rating', 'Pengelola keuangan memberikan informasi yang cepat dan akurat'),
(2, 2, 7, 'Rating', 'Pengelola keuangan tanggap mendengarkan saran dan keluhan pelanggan'),
(2, 2, 8, 'Rating', 'Pengelola keuangan jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(2, 2, 9, 'Rating', 'Pengelola keuangan menggunakan bahasa yang mudah dipahami dan sopan dalam memberikan pelayanan sesuai dengan kebutuhan'),
(2, 2, 10, 'Rating', 'Pengelola keuangan melaksanakan pengelolaan dan layanan keuangan sesuai dengan sistem dan prosedur yang ditetapkan');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 3, 1, 'Rating', 'Pengelola sarana dan prasarana mempunyai ketrampilan dalam menggunakan sumber daya alat yang tersedia'),
(2, 3, 2, 'Rating', 'Pengelola sarana dan prasarana dibekali pengetahuan dalam menjalankan pelayanan yang diberikan'),
(2, 3, 3, 'Rating', 'Pengelola sarana dan prasarana ramah dalam memberikan pelayanan sesuai dengan kebutuhan'),
(2, 3, 4, 'Rating', 'Pengelola sarana dan prasarana dapat dipercaya dalam menjaga data pelanggan'),
(2, 3, 5, 'Rating', 'Pengelola sarana dan prasarana mudah ditemui'),
(2, 3, 6, 'Rating', 'Pengelola sarana dan prasarana memberikan informasi yang cepat dan akurat'),
(2, 3, 7, 'Rating', 'Pengelola sarana dan prasarana tanggap mendengarkan saran dan keluhan pelanggan'),
(2, 3, 8, 'Rating', 'Pengelola sarana dan prasarana jujur dan bertanggung jawab terhadap pelayanan yang diberikan'),
(2, 3, 9, 'Rating', 'Sarana dan prasarana di Polinema sangat mendukung pelaksanaan aktivitas pembelajaran dan perkantoran');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 4, 1, 'Rating', 'P3M Polinema menyediakan informasi tentang kegiatan penelitian'),
(2, 4, 2, 'Rating', 'P3M Polinema menyediakan pelayanan untuk melakukan kegiatan penelitian'),
(2, 4, 3, 'Rating', 'P3M Polinema menyediakan buku panduan dan renstra penelitian'),
(2, 4, 4, 'Rating', 'P3M Polinema menyediakan Sistem Informasi untuk melaksanakan penelitian'),
(2, 4, 5, 'Rating', 'P3M Polinema melakukan monitoring dan evaluasi terhadap pelaksanaan penelitian'),
(2, 4, 6, 'Rating', 'P3M Polinema melakukan evaluasi terhadap hasil penelitian'),
(2, 4, 7, 'Rating', 'P3M melakukan pengelolaan dana penelitian dan dengan mempertimbangkan jurusan-jurusan dan dosen-dosen yang ada di Polinema'),
(2, 4, 8, 'Rating', 'P3M Polinema memberikan beberapa skema penelitian yang berbeda sebagai alternatif pilihan untuk para peneliti dengan anggaran yang disesuaikan setiap skema penelitian'),
(2, 4, 9, 'Rating', 'P3M Polinema menyediakan kesempatan bimbingan penyusunan proposal penelitian dan laporan akhir'),
(2, 4, 10, 'Rating', 'P3M Polinema memberikan pelatihan dan pendampingan penulisan proposal penelitian tingkat nasional'),
(2, 4, 11, 'Rating', 'P3M Polinema menyelenggarakan konferensi nasional/internasional sebagai salah satu media diseminasi luaran penelitian'),
(2, 4, 12, 'Rating', 'P3M Polinema mendorong partisipasi aktif para peneliti untuk mempublikasikan artikel di jurnal, pengajuan HKI (Hak Kekayaan Intelektual) melalui sentra KI'),
(2, 4, 13, 'Rating', 'Polinema melalui Bidang 1 mendanai konferensi nasional/internasional bagi peneliti untuk mendiseminasi hasil penelitian');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 5, 1, 'Rating', 'P3M Polinema menyediakan informasi tentang kegiatan PkM'),
(2, 5, 2, 'Rating', 'P3M Polinema menyediakan pelayanan untuk melakukan kegiatan PkM'),
(2, 5, 3, 'Rating', 'P3M Polinema menyediakan buku panduan dan renstra PkM'),
(2, 5, 4, 'Rating', 'P3M Polinema menyediakan Sistem Informasi untuk melaksanakan PkM'),
(2, 5, 5, 'Rating', 'P3M Polinema melakukan monitoring dan evaluasi terhadap pelaksanaan PkM'),
(2, 5, 6, 'Rating', 'P3M Polinema melakukan evaluasi terhadap hasil pelaksanaan PkM'),
(2, 5, 7, 'Rating', 'P3M Polinema melakukan pengelolaan dana PkM dengan mempertimbangkan jurusan-jurusan dan dosen-dosen yang ada di Polinema'),
(2, 5, 8, 'Rating', 'P3M Polinema memberikan beberapa skema PkM yang berbeda sebagai alternatif pilihan untuk para pelaksana kegiatan dengan anggaran yang disesuaikan setiap skema PkM'),
(2, 5, 9, 'Rating', 'P3M Polinema menyediakan kesempatan bimbingan penyusunan proposal PkM dan laporan akhir'),
(2, 5, 10, 'Rating', 'P3M Polinema memberikan pelatihan dan pendampingan penulisan proposal PkM kompetisi tingkat nasional'),
(2, 5, 11, 'Rating', 'P3M Polinema menyelenggarakan konferensi nasional/internasional sebagai salah satu media diseminasi luaran PkM'),
(2, 5, 12, 'Rating', 'P3M Polinema mendorong partisipasi aktif para pelaksana PkM untuk mempublikasikan artikel di jurnal, pengajuan HKI (Hak Kekayaan Intelektual) melalui sentra KI'),
(2, 5, 13, 'Rating', 'Polinema melalui Bidang 1 mendanai konferensi nasional/internasional bagi pelaksana kegiatan PkM untuk mendiseminasi hasil PkM');
/*mahasiswa*/

/*ortu*/

/*mitra*/

/*alumni*/

/*insert jawaban, data dosen dan tendik*/
