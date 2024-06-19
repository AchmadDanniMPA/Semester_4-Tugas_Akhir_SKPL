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
/*dosen & tendik*/
(1, 'Sistem Pengelolaan SDM'),
(2, 'Sistem Pengelolaan Keuangan'),
(3, 'Sistem Pengelolaan Sarana Prasarana'),
(4, 'Sistem Pengelolaan Kegiatan Penelitian'),
(5, 'Sistem Pengelolaan Kegiatan Pengabdian'),
/*mahasiswa*/
(6, 'Kondisi Sarana Prasarana'),
(7, 'Kemampuan Tenaga Pengajar untuk Kegiatan Akademik'),
(8, 'Layanan Masalah Akademik dan Non_Akademik'),
(9, 'Keadilan Perlakuan Akademik'),
(10, 'Layanan Keuangan dan Prestasi Mahasiswa'),
(11, 'Transparansi Informasi dan Layanan Akademik'),
/*ortu*/
(12, 'Layanan Informasi Polinema'),
(13, 'Kemajuan Mahasiswa sebagai hasil Pengajaran di Polinema'),
(14, 'Layanan Keluhan Akademik dan Pasca Kelulusan'),
/*mitra*/
(15, 'Etika (Ethics)'),
(16, 'Kepemimpinan (Leaderships)'),
(17, 'Etos Kerja (Work Ethic)'),
(18, 'Kemampuan Berkomunikasi (Communication Skill)'),
(19, 'Kerjasama Tim (Teamwork)'),
(20, 'Keahlian Bidang Ilmu (Technical Skill)'),
(21, 'Kemampuan Berbahasa Asing (Foreign Language Skill Ability)'),
(22, 'Penggunaan Teknologi Informasi (Information Technology Skill Ability)'),
(23, 'Pengembangan Diri (Self-Development)'),
/*alumni*/
(24, 'Alumni'),
/*semuanya saran dan kritik*/
(25, 'Saran & Kritik(Suggestion & Advice)');

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
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(1, 25, 1, 'Isian', 'Tuliskan saran-saran atau masukan maupun kritik anda di sini.');

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
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(2, 25, 1, 'Isian', 'Tuliskan saran-saran atau masukan maupun kritik anda di sini.');

/*mahasiswa*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 6, 1, 'Rating', 'Ruang kuliah tertata dengan bersih dan rapi'),
(3, 6, 2, 'Rating', 'Ruang kuliah sejuk dan nyaman'),
(3, 6, 3, 'Rating', 'Sarana pembelajaran yang tersedia di ruangan kuliah'),
(3, 6, 4, 'Rating', 'Kelengkapan sarana di Perpustakaan Polinema'),
(3, 6, 5, 'Rating', 'Kelengkapan sarana di laboratorium/bengkel/studio Polinema yang sesuai dengan kebutuhan keilmuan bagi mahasiswa'),
(3, 6, 6, 'Rating', 'Ketersediaan buku referensi yang di perpustakaan Polinema'),
(3, 6, 7, 'Rating', 'Kondisi fasilitas kamar kecil yang bersih dan cukup'),
(3, 6, 8, 'Rating', 'Kondisi fasilitas parkir yang aman dan cukup'),
(3, 6, 9, 'Rating', 'Kondisi fasilitas ibadah yang dapat dipergunakan oleh mahasiswa Polinema');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 7, 1, 'Rating', 'Kejelasan materi perkuliahan yang diberikan dosen'),
(3, 7, 2, 'Rating', 'Ketersediaan waktu tanya jawab pada saat perkuliahan yang diberikan dosen'),
(3, 7, 3, 'Rating', 'Kualitas bahan ajar suplemen yang diberikan kepada mahasiswa untuk melengkapi materi perkuliahan'),
(3, 7, 4, 'Rating', 'Dosen memberikan hasil ujian dengan nilai yang obyektif'),
(3, 7, 5, 'Rating', 'Dosen datang tepat waktu saat perkuliahan'),
(3, 7, 6, 'Rating', 'Dosen memiliki keahlian yang memadai'),
(3, 7, 7, 'Rating', 'Kualitas Rencana Pembelajaran Semester yang dibuat oleh Dosen'),
(3, 7, 8, 'Rating', 'Kemampuan dosen dalam membimbing PKL, LA, dan atau Skripsi'),
(3, 7, 9, 'Rating', 'Kemampuan staf akademik dalam memberikan pelayanan administrasi kemahasiswaan'),
(3, 7, 10, 'Rating', 'Kualitas staf akademik dalam memenuhi kepentingan mahasiswa');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 8, 1, 'Rating', 'Pelayanan dosen pembina akademik kepada mahasiswa'),
(3, 8, 2, 'Rating', 'Penyediaan beasiswa bagi mahasiswa yang tidak mampu'),
(3, 8, 3, 'Rating', 'Pelayanan bantuan masalah akademik oleh Polinema kepada mahasiswa'),
(3, 8, 4, 'Rating', 'Penyediaan waktu oleh Direktur Polinema beserta jajarannya kepada orang tua mahasiswa untuk berkonsultasi'),
(3, 8, 5, 'Rating', 'Pelayanan bantuan pengobatan bagi mahasiswa yang sakit oleh Polinema'),
(3, 8, 6, 'Rating', 'Pelayanan bantuan asuransi kecelakaan oleh Polinema kepada mahasiswa'),
(3, 8, 7, 'Rating', 'Pelayanan yang santun oleh staf administrasi akademik kepada mahasiswa'),
(3, 8, 8, 'Rating', 'Pelayanan dosen Pembimbing Akademik yang ditugaskan oleh Polinema untuk penananganan masalah/keluhan yang bersifat akademik dan non-akademik'),
(3, 8, 9, 'Rating', 'Pengembalian hasil pekerjaan atau tugas oleh dosen kepada mahasiswa'),
(3, 8, 10, 'Rating', 'Efektifitas dosen dalam mengelola waktu pengajaran');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 9, 1, 'Rating', 'Keadilan pemberian sanksi bagi mahasiswa yang melanggar aturan Polinema'),
(3, 9, 2, 'Rating', 'Kepedulian Polinema dalam memahami kepentingan dan kesulitan mahasiswa'),
(3, 9, 3, 'Rating', 'Sosialisasi transparansi besaran UKT');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 10, 1, 'Rating', 'Sosialisasi transparansi perkembangan dan penerimaan beasiswa bidikmisi'),
(3, 10, 2, 'Rating', 'Layanan monitoring oleh Polinema terhadap kemajuan prestasi mahasiswa melalui dosen pembina akademik'),
(3, 10, 3, 'Rating', 'Kesediaan dosen dalam membantu mahasiswa yang mengalami kesulitan bidang akademik/mata kuliah'),
(3, 10, 4, 'Rating', 'Keterbukaan dan sikap kooperatif oleh dosen kepada mahasiswa'),
(3, 10, 5, 'Rating', 'Upaya Polinema dalam pengembangan minat dan bakat mahasiswa'),
(3, 10, 6, 'Rating', 'Fasilitas Polinema dalam bentuk uji kompetensi profesi'),
(3, 10, 7, 'Rating', 'Layanan informasi sistem perkuliahan oleh Polinema dalam bentuk buku pedoman akademik');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 11, 1, 'Rating', 'Layanan informasi terkait pelaksanaan PKL, LA, atau Skripsi dalam bentuk buku pedoman'),
(3, 11, 2, 'Rating', 'Layanan informasi akademik dan layanan non-akademik dalam bentuk website (online)'),
(3, 11, 3, 'Rating', 'Transparansi layanan informasi akademik dan non-akademik'),
(3, 11, 4, 'Rating', 'Pemberian informasi terkait peluang karier/lowongan pekerjaan'),
(3, 11, 5, 'Rating', 'Polinema memberikan respon positif pada setiap pengaduan mahasiswa'),
(3, 11, 6, 'Rating', 'Polinema berusaha transparan dalam menjelaskan penggunaan dana kemahasiswaan'),
(3, 11, 7, 'Rating', 'Dosen pengajar matakuliah selalu mengajar sesuai jadwal yang telah diatur');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(3, 25, 1, 'Isian', 'Tuliskan saran-saran atau masukan maupun kritik anda di sini.');

/*ortu*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(4, 6, 1, 'Rating', 'Ketersediaan sarana dan prasarana Polinema'),
(4, 6, 2, 'Rating', 'Keramahan pegawai Polinema'),
(4, 6, 3, 'Rating', 'Kemudahan dalam adminsitrasi keuangan');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(4, 12, 1, 'Rating', 'Penjelasan yang diberikan pihak Polinema atas pertanyaan dari orang tua atau wali mahasiswa'),
(4, 12, 2, 'Rating', 'Komunikasi yang diberikan pihak Polinema (khususnya Ketua Jurusan/Koordinator Program Studi/Dosen Pembina Akademik) dengan orang tua atau wali mahasiswa'),
(4, 12, 3, 'Rating', 'Informasi tentang hasil pembelajaran di Polinema');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(4, 13, 1, 'Rating', 'Kurikulum dan sistem pembelajaran di Polinema'),
(4, 13, 2, 'Rating', 'Suasana kehidupan kampus yang berakhlak'),
(4, 13, 3, 'Rating', 'Pejamin keamanan dan keselamatan mahasiswa'),
(4, 13, 4, 'Rating', 'Kesesuaian biaya pendidikan dengan kualitas belajar mahasiswa');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(4, 14, 1, 'Rating', 'Ketersediaan informasi tentang peluang mendapatkan pekerjaan setelah lulus kuliah'),
(4, 14, 2, 'Rating', 'Tanggapan dan kecepatan menangani keluhan dari orang tua atau wali');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(4, 25, 1, 'Isian', 'Tuliskan saran-saran atau masukan maupun kritik anda di sini.');

/*mitra*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 15, 1, 'Rating', 'Alumni Polinema memiliki etika yang baik dan sesuai di lingkungan kerja (Polinema alumni have good and appropriate ethics in the work environment)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 16, 1, 'Rating', 'Alumni Polinema memiliki jiwa kepemimpinan yang kuat dan mampu menerapkannya di lingkungan kerja (Polinema alumni have a strong leadership skill and are able to apply it in the work environment)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 17, 1, 'Rating', 'Alumni Polinema memiliki etos kerja yang kuat dan bermanfaat di lingkungan kerja (Polinema alumni have a strong work ethic which is applied in the work environment)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 18, 1, 'Rating', 'Alumni Polinema memiliki kemampuan berkomunikasi yang baik dan efektif di lingkungan pekerjaan (Polinema alumni have good and effective communication skills in the work environment)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 19, 1, 'Rating', 'Alumni Polinema mampu melakukan kerjasama tim yang baik dalam melakukan pekerjaan (Polinema alumni are able to carry out good teamwork in carrying out work)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 20, 1, 'Rating', 'Alumni Polinema memiliki kemampuan teknis yang baik sesuai bidang ilmu dari kuliah di Polinema (Polinema alumni have good technical skills according to the field of knowledge they studied at Polinema)'),
(5, 20, 2, 'Rating', 'Alumni Polinema menggunakan keahlian teknis sesuai bidang ilmu kuliah yang dipelajari di Polinema untuk menunjang pekerjaan (Polinema alumni use technical skills according to the field which has been studied at Polinema to support their work)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 21, 1, 'Rating', 'Alumni Polinema memiliki keterampilan berbahasa asing yang baik dalam menunjang kegiatan yang terkait pekerjaan (Polinema alumni have good foreign language skills to support work-related activities)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 22, 1, 'Rating', 'Alumni Polinema memiliki keterampilan dalam menggunakan perangkat teknologi informasi yang baik untuk menunjang pekerjaan (Polinema alumni have skills to use information technology tools to support their work)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 23, 1, 'Rating', 'Alumni Polinema selalu melakukan pengembangan diri dan mampu menerapkannya untuk peningkatan kualitas pekerjaan mereka (Polinema alumni always carry out self-development and are able to apply it to improve their quality of work)');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(5, 25, 1, 'Isian', 'Tuliskan saran-saran anda untuk kemajuan Polinema dalam menyediakan kualitas alumni yang unggul (Please state your suggestions for improvement of Polinema especially in providing high-quality alumni).');

/*alumni*/
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(6, 24, 1, 'Rating', 'Polinema telah menyediakan Ikatan Keluarga Alumni (IKA) sebagai wadah persatuan alumni secara optimal'),
(6, 24, 2, 'Rating', 'Kegiatan yang dilakukan antara Polinema dengan IKA Polinema telah membawa dampak nyata bagi alumni'),
(6, 24, 3, 'Rating', 'Kegiatan yang dilakukan antara Polinema dengan IKA Polinema telah membawa dampak nyata bagi alumni baru (fresh graduate)'),
(6, 24, 4, 'Rating', 'Kegiatan yang dilakukan antara Polinema dengan IKA Polinema telah membawa dampak nyata bagi mahasiswa yang masih aktif'),
(6, 24, 5, 'Rating', 'Polinema melaksanakan tracer study secara optimal'),
(6, 24, 6, 'Rating', 'Polinema melalui IKA Polinema berperan secara aktif mengajak kepada alumni untuk bergabung ke dalam IKA Polinema'),
(6, 24, 7, 'Rating', 'Polinema melalui IKA Polinema berperan secara aktif mengajak kepada alumni fresh graduate untuk bergabung ke dalam IKA Polinema'),
(6, 24, 8, 'Rating', 'Polinema melalui IKA Polinema menyediakan website sebagai media informasi alumni'),
(6, 24, 9, 'Rating', 'Polinema memastikan kegiatan IKA Polinema sesuai rencana kerja'),
(6, 24, 10, 'Rating', 'Fasilitas akademik yang diberikan Polinema mendukung alumni dalam berkinerja baik di tempat kerja'),
(6, 24, 11, 'Rating', 'Fasilitas non-akademik yang diberikan Polinema mendukung alumni dalam berkinerja baik di tempat kerja'),
(6, 24, 12, 'Rating', 'Pembelajaran yang diberikan Polinema menunjang alumni dalam mendapatkan pekerjaan baik sebagai pegawai maupun berwirausaha'),
(6, 24, 13, 'Rating', 'Fasilitas layanan alumni berupa legalisir dilaksanakan dengan cara yang efisien dan tidak merepotkan alumni');
INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama) VALUES
(6, 25, 1, 'Isian', 'Tuliskan saran-saran atau masukan maupun kritik anda di sini.');

/*insert jawaban, data dosen dan tendik*/
