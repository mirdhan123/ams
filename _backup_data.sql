DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","Yayasan Pendidikan dan Sosial Al - Husna","SMK AL - Husna Loceret Nganjuk","Akta Notaris: SLAMET , SH, M.Hum No. 119/2013","Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471","H. Riza Fachri, S.Kom.","-","http://www.smkalhusnaloceret.sch.id","info@smkalhusnaloceret.sch.id","logo.png","1");



DROP TABLE tbl_klasifikasi;

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

INSERT INTO tbl_klasifikasi VALUES("1","420","Pendidikan","Pendidikan","1");
INSERT INTO tbl_klasifikasi VALUES("2","420.1","Pendidikan Khusus Klasifikasi disini Pendidikan Putra/I Irja","Pendidikan Khusus Klasifikasi disini Pendidikan Putra/I Irja","1");
INSERT INTO tbl_klasifikasi VALUES("3","421","Sekolah","Sekolah","1");
INSERT INTO tbl_klasifikasi VALUES("4","421.1","Pra Sekolah","Pra Sekolah","1");
INSERT INTO tbl_klasifikasi VALUES("5","421.2","Sekolah Dasar","Sekolah Dasar","1");
INSERT INTO tbl_klasifikasi VALUES("6","421.3","Sekolah Menengah","Sekolah Menengah","1");
INSERT INTO tbl_klasifikasi VALUES("7","421.4","Sekolah Tinggi","Sekolah Tinggi","1");
INSERT INTO tbl_klasifikasi VALUES("8","421.5","Sekolah Kejuruan","Sekolah Kejuruan","1");
INSERT INTO tbl_klasifikasi VALUES("9","421.6","Kegiatan Sekolah, Dies Natalis Lustrum","Kegiatan Sekolah, Dies Natalis Lustrum","1");
INSERT INTO tbl_klasifikasi VALUES("10","421.7","Kegiatan Pelajar","Kegiatan Pelajar","1");
INSERT INTO tbl_klasifikasi VALUES("11","421.71","Reuni Darmawisata","Reuni Darmawisata","1");
INSERT INTO tbl_klasifikasi VALUES("12","421.72","Pelajar Teladan","Pelajar Teladan","1");
INSERT INTO tbl_klasifikasi VALUES("13","421.73","Resimen Mahasiswa","Resimen Mahasiswa","1");
INSERT INTO tbl_klasifikasi VALUES("14","421.8","Sekolah Pendidikan Luar Biasa","Sekolah Pendidikan Luar Biasa","1");
INSERT INTO tbl_klasifikasi VALUES("15","421.9","PLS / Pemberantasan Buta Huruf","PLS / Pemberantasan Buta Huruf","1");
INSERT INTO tbl_klasifikasi VALUES("16","422","Administrasi Sekolah","Administrasi Sekolah","1");
INSERT INTO tbl_klasifikasi VALUES("17","422.1","Persyaratan Masuk Sekolah, Testing, Ujian,Pendaftaran, Mapras","Persyaratan Masuk Sekolah, Testing, Ujian,Pendaftaran, Mapras","1");
INSERT INTO tbl_klasifikasi VALUES("18","422.2","Tahun Pelajaran","Tahun Pelajaran","1");
INSERT INTO tbl_klasifikasi VALUES("19","422.3","Hari Libur","Hari Libur","1");
INSERT INTO tbl_klasifikasi VALUES("20","422.4","Uang Sekolah, Klasifikasi Disini SPP","Uang Sekolah, Klasifikasi Disini SPP","1");
INSERT INTO tbl_klasifikasi VALUES("21","422.5","Beasiswa","Beasiswa","1");
INSERT INTO tbl_klasifikasi VALUES("22","423","Metode Belajar","Metode Belajar","1");
INSERT INTO tbl_klasifikasi VALUES("23","423.1","Kuliah","Kuliah","1");
INSERT INTO tbl_klasifikasi VALUES("24","423.2","Ceramah, Simposium","Ceramah, Simposium","1");
INSERT INTO tbl_klasifikasi VALUES("25","423.3","Diskusi","Diskusi","1");
INSERT INTO tbl_klasifikasi VALUES("26","423.4","Kuliah Lapangan, Widyawisata, KKN, Studi Tur","Kuliah Lapangan, Widyawisata, KKN, Studi Tur","1");
INSERT INTO tbl_klasifikasi VALUES("27","423.5","Kurikulum","Kurikulum","1");
INSERT INTO tbl_klasifikasi VALUES("28","423.6","Karya Tulis","Karya Tulis","1");
INSERT INTO tbl_klasifikasi VALUES("29","423.7","Ujian","Ujian","1");
INSERT INTO tbl_klasifikasi VALUES("30","424","Tenaga Pengajar, Guru, Dosen, Dekan, Rektor","Tenaga Pengajar, Guru, Dosen, Dekan, Rektor","1");
INSERT INTO tbl_klasifikasi VALUES("31","425","Sarana Pendidikan","Sarana Pendidikan","1");
INSERT INTO tbl_klasifikasi VALUES("32","425.1","Gedung","Gedung","1");
INSERT INTO tbl_klasifikasi VALUES("33","425.11","Gedung Sekolah","Gedung Sekolah","1");
INSERT INTO tbl_klasifikasi VALUES("34","425.12","Kampus","Kampus","1");
INSERT INTO tbl_klasifikasi VALUES("35","425.13","Pusat Kegiatan Mahasiswa","Pusat Kegiatan Mahasiswa","1");
INSERT INTO tbl_klasifikasi VALUES("36","425.2","Buku","Buku","1");
INSERT INTO tbl_klasifikasi VALUES("37","425.3","Perlengkapan Sekolah","Perlengkapan Sekolah","1");
INSERT INTO tbl_klasifikasi VALUES("38","426","Keolahragaan","Keolahragaan","1");
INSERT INTO tbl_klasifikasi VALUES("39","426.1","Cabang Olah Raga","Cabang Olah Raga","1");
INSERT INTO tbl_klasifikasi VALUES("40","426.2","Sarana","Sarana","1");
INSERT INTO tbl_klasifikasi VALUES("41","426.21","Gedung Olah Raga","Gedung Olah Raga","1");
INSERT INTO tbl_klasifikasi VALUES("42","426.22","Stadion","Stadion","1");
INSERT INTO tbl_klasifikasi VALUES("43","426.23","Lapangan","Lapangan","1");
INSERT INTO tbl_klasifikasi VALUES("44","426.24","Kolam renang","Kolam renang","1");
INSERT INTO tbl_klasifikasi VALUES("45","426.3","Pesta Olah Raga, Klasifikasi nya: PON, Porsade, Olimpiade,","Pesta Olah Raga, Klasifikasi nya: PON, Porsade, Olimpiade,","1");
INSERT INTO tbl_klasifikasi VALUES("46","426.4","KONI","KONI","1");
INSERT INTO tbl_klasifikasi VALUES("47","427","Kepramukaan Meliputi: Organisasi dan Kegiatan Remaja","Kepramukaan Meliputi: Organisasi dan Kegiatan Remaja","1");
INSERT INTO tbl_klasifikasi VALUES("48","428","Kepramukaan","Kepramukaan","1");
INSERT INTO tbl_klasifikasi VALUES("49","429","Pendidikan  Kedinasan Untuk Depdagri","Pendidikan  Kedinasan Untuk Depdagri","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `kode_instansi` varchar(10) NOT NULL,
  `klasifikasi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","5","5","SMK-AH","10","1");



DROP TABLE tbl_surat_keluar;

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(10) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("2","1","Siswa","420 / 015 /SMK.AH/VIII/2015","Surat edaran untuk mengikuti kegiatan sholat Idhul Adha di sekolah.","421.6","2015-08-28","2016-07-24","4718-surat keluar 1.jpg","Wajib","5");
INSERT INTO tbl_surat_keluar VALUES("3","2","Darmaji, S.T. (Guru)","421 / 056 /SMK-AH / XII /2015","Surat tugas untuk menghadiri undangan Penganugerahan Bursa Khusus SMK","421","2015-12-07","2016-07-24","7773-surat keluar 2.jpg","-","5");
INSERT INTO tbl_surat_keluar VALUES("4","3","Siswa","421/059/SMK-AH/XII/2015","Surat edaran pelaksanaan praktik kerja industri (Prakerin)","421","2015-12-17","2016-07-24","","Penting","5");
INSERT INTO tbl_surat_keluar VALUES("5","4","Guru","042/067 / SMk-AH/I/2016","Surat undangan rapat dinas koordinasi ujian sekolah\n","421","2016-02-01","2016-07-24","","Wajib Hadir","5");
INSERT INTO tbl_surat_keluar VALUES("11","5","ittuy","tuyt","uytyut","Kode Surat","2016-07-27","2016-07-27","","kguytyu","1");
INSERT INTO tbl_surat_keluar VALUES("12","6","tytryr","yurytryt","ghh","421.6","2016-07-27","2016-07-27","","fgfhfh","1");
INSERT INTO tbl_surat_keluar VALUES("15","7","yutyutu","421 / 7 / SMK-AH / VII / 2016","hjghjgj","421","2016-07-27","2016-07-27","","kjgjghj","1");
INSERT INTO tbl_surat_keluar VALUES("18","8","gjgjhgj","420 / 8 / SMK-AH / VII / 2016","hghjghj","420","2016-07-28","2016-07-28","3207-Form Tugas Akhir AKN (1).docx","ghjghjg","1");
INSERT INTO tbl_surat_keluar VALUES("19","9","kjgjgjhgjh","420 / 9 / SMK-AH / VII / 2016","kjhkjhjk","420","2016-07-28","2016-07-28","9540-Form Tugas Akhir AKN (1).docx","lkhu","1");
INSERT INTO tbl_surat_keluar VALUES("20","10","jghj","420 / 10 / SMK-AH / VII / 2016","ghghj","420","2016-07-28","2016-07-28","8570-Form Tugas Akhir AKN (1).docx","ghfhj","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(10) NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("11","1","001/PPH/VI/2016","Pondok Pesantren Hidayatullah Nganjuk","Permohonan Zakat Fitrah","421.7","A.1","2016-06-09","2016-07-24","601-surat masuk 1.jpg","Penting","","","","0000-00-00","","2","5");
INSERT INTO tbl_surat_masuk VALUES("12","2","074 / BAZNAZ.JTM / IV / 2016","Badan Amil Zakat Nasional Provinsi Jawa Timur","Pencairan Dana Bantuan Sebesar Rp. 800.000,- (Delapan Ratus Ribu Rupiah) dari Baznaz.","422.4","A.2","2016-04-07","2016-07-24","7523-surat masuk 2.jpg","Penting","","","","0000-00-00","","2","5");
INSERT INTO tbl_surat_masuk VALUES("13","3","3 / XI/M.BIG/2016","Musyawarah Guru Mata Pelajaran Bahasa Inggris","Surat edaran pertemuan rutin musyawarah guru mata pelajaran bahasa inggris.","420","A.3","2016-04-19","2016-07-24","","-","","","","0000-00-00","","2","5");
INSERT INTO tbl_surat_masuk VALUES("30","4","fhgfhgfgh","jfhgfgf","lhjkh","420","hgghfgh","2016-07-28","2016-07-28","","kjhkhkj","gjhghjg","gfgh","Biasa","1899-11-30","ghfhg","1","2");
INSERT INTO tbl_surat_masuk VALUES("31","5","hjgjh","gjgh","hhgj","420","ghjg","2016-07-28","2016-07-28","","gjghjgj","hfgh","hghjff","Segera","1899-12-07","ghfhgfh","1","2");
INSERT INTO tbl_surat_masuk VALUES("33","6","hfhfhg","ghfhgf","bhghjgjh","420","fghf","2016-07-28","2016-07-28","","hjgjh","nbnvgfghf","jgkjhgjh","Biasa","2016-07-28","jhghj","1","3");
INSERT INTO tbl_surat_masuk VALUES("34","7","jhghjghj","kjgjgh","hjgjhg","420","jhgjhg","2016-07-28","2016-07-28","6430-Form Tugas Akhir AKN (1).docx","jhghj","","","","0000-00-00","","0","1");
INSERT INTO tbl_surat_masuk VALUES("35","8","hjghjghj","kghj",",hhg","420","hjg","2016-07-28","2016-07-28","","hjghj","","","","0000-00-00","","0","1");
INSERT INTO tbl_surat_masuk VALUES("36","9","hjghjgjh","hhjghjg","jghjghj","420","hghjghj","2016-07-28","2016-07-28","7107-PENGUMUMAN SIDANG TA AKN NGANJUK 2016.docx","gjhghj","","","","0000-00-00","","0","1");
INSERT INTO tbl_surat_masuk VALUES("37","10","kjhkjhjk","jhkjh","hghjghj","420","jhkjh","2016-07-28","2016-07-28","710-Form Tugas Akhir AKN (1).docx","ggjhjghj","","","","0000-00-00","","0","1");
INSERT INTO tbl_surat_masuk VALUES("38","11","hjghjg","jjgjhg","hjkgj","420","g","2016-07-28","2016-07-28","9606-PENGUMUMAN SIDANG TA AKN NGANJUK 2016.docx","hjjkhkj","","","","0000-00-00","","0","1");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","admin","d033e22ae348aeb5660fc2140aec35850c4da997","M. Rudianto","-","1");
INSERT INTO tbl_user VALUES("2","kepsek","82b7283910ac7cb508ea7ecc645e5c944d7fb612","H. Riza Fachri, S.Kom","-","2");
INSERT INTO tbl_user VALUES("3","disposisi","73c3467d32dd78ef01784a53416fffede068b019","Petugas Disposisi","-","3");
