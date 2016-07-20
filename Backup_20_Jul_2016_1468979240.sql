DROP TABLE tbl_disposisi;

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(5) NOT NULL AUTO_INCREMENT,
  `tujuan` varchar(250) NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO tbl_disposisi VALUES("5","Kesiswaan","Kirimkan siswa kelas 12 untuk mengikuti kegiatan Pameran Bursa Kerja Untuk Percepatan Tenaga Kerja / Job Fair Tahun 2016 ","Penting","2016-05-17","Segera Laksanakan","6","1");
INSERT INTO tbl_disposisi VALUES("6","Panitia Zakat Fitrah","Segera koordinasi pembagian zakat fitrah","Biasa","2016-07-15","Semua siswa wajib membayar zakat fitrah disekolah","5","1");
INSERT INTO tbl_disposisi VALUES("7","Bendahara Sekolah","Segera siapkan berkas-berkas yang diperlukan","Perhatian Batas Waktu","2016-07-17","Segera Laksanakan","4","1");



DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kepsek` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","SMK AL - Husna Loceret Nganjuk","Jalan Raya Kediri Gg. Kwagean No. 04 Loceret Telp/Fax. (0358) 329806 Nganjuk 64471","M. Rudianto","-","http://www.smkalhusnaloceret.sch.id","info@smkalhusnaloceret.sch.id","logo.png","1");



DROP TABLE tbl_klasifikasi;

CREATE TABLE `tbl_klasifikasi` (
  `id_klasifikasi` int(4) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO tbl_klasifikasi VALUES("1","A","Pendidikan","Pendidikan Sekolah Menengah Kejuruan","1");
INSERT INTO tbl_klasifikasi VALUES("2","B","Sarana","Bangunan Sekolah dan Sarana Pendukung Lainnya","1");
INSERT INTO tbl_klasifikasi VALUES("3","C","Kurikulum","Kurikulum 2016","1");
INSERT INTO tbl_klasifikasi VALUES("4","D","Kegiatan","Ekstrakurikuler","1");
INSERT INTO tbl_klasifikasi VALUES("5","E","Administrasi","Administrasi Keuangan","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` text NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","5","5","5","1");



DROP TABLE tbl_surat_keluar;

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("3","1","Orang Tua/Wali Murid","420/ 052/SMK -AH/XI/2015","Surat edaran untuk mengikuti Apel Gelar FKPPI (Forum Komunikasi Putra Putri Purnawirawan dan Putra-Putri TNI Polri.","D","2015-11-23","2016-07-17","2649-IMG_20160611_103634.jpg","Segera","1");
INSERT INTO tbl_surat_keluar VALUES("4","2","Guru","420 / 015 /SMK-AH/VIII/2015","Surat undangan bapak/ibu guru untuk mengikuti kegiatan SHolat Idhul Adha dan pemotongan hewan qurban di SMK AL-Husna Loceret Nganjuk pada Kamis 24 September 2015jam 06.30 sampai selesai.","C","2015-08-28","2016-07-17","1243-IMG_20160611_103638.jpg","Wajib Mengikuti","1");
INSERT INTO tbl_surat_keluar VALUES("5","3","H. Riza Fachri, S.Kom.","421 / 056 / SMK-AH / XII /2015","Surat tugas untuk mengikuti kegiatan Penganugerahan Bursa Kerja Khusus SMK pada hari Selasa tanggal 8 Desember 2015 di Gedhung Subha Nugraha Dinas Dikpora Jatim Jl. Gentengkali No. 33 Surabaya.","C","2015-12-07","2016-07-17","662-IMG_20160611_103638.jpg","Penting","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `kode` varchar(30) NOT NULL,
  `indeks` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=2091 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("4","1","074 / BAZNAS.JTM / IV / 2016","Badan Amil Zakat Nasional Provinsi Jawa Timur","Surat pemberitahuan resalisasi bantuan senilai RP. 800.000,- (Delapan Ratus Ribu Rupiah) dari BAZNAS. Diharapkan untuk segera menghubungi BAZNAS  Provinsi Jawa Timur  untuk pencairan dana dan membawa surat keterangan penggunaan dana bantuan beasiswa BAZNAZ Provinsi Jawa Timur dari sekolah, kwitansi dan fotocopy Kartu Pelajar","B","A","2016-04-07","2016-07-17","6313-IMG_20160611_103621.jpg","Penting","1");
INSERT INTO tbl_surat_masuk VALUES("5","2","001/PPH/VI/2016","Pondok Pesantren Hidayatullah Nganjuk","Surat edaran permohonan zakat fitrah. ","E","A","2016-06-09","2016-07-17","277-IMG_20160611_103623.jpg","-","1");
INSERT INTO tbl_surat_masuk VALUES("6","3","560/ 402.1/411.203/2016","Dinas Sosila Tenaga Kerja Dan Transmigrasi Nganjuk","Surat undangan untuk mengikuti kegiatan Pameran Bursa Kerja Untuk Percepatan Tenaga Kerja / Job Fair Tahun 2016 yang akan dilaksanakan pada Senin & Selasa 16 dan 17 Mei 2016 jam 08.00 - 15.00 WIB bertempat di Gedung Juang 45 Jl. Dr. Soetomo No 45 Nganjuk","E","A","2016-05-12","2016-07-17","7570-IMG_20160611_103627.jpg","Penting","1");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","M. Rudianto","-","1");
INSERT INTO tbl_user VALUES("18","dodik","82b00125c2ec05d38220ed4e1774e084","Dodik Meiloyan","-","2");
INSERT INTO tbl_user VALUES("20","disposisi","13bb8b589473803f26a02e338f949b8c","Petugas Disposisi","-","3");



