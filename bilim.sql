CREATE TABLE biyografiler (
  ID mediumint(9) NOT NULL,
  Turk enum('evet','hayir') NOT NULL DEFAULT 'hayir',
  AdSoyad varchar(255) NOT NULL,
  AdSef varchar(255) NOT NULL,
  Dogum varchar(20) NOT NULL,
  Olum varchar(20) NOT NULL,
  Ulke varchar(200) NOT NULL,
  Uzmanlik text NOT NULL,
  Hakkinda text NOT NULL,
  Resim varchar(250) NOT NULL DEFAULT 'resimyok.png',
  Eklenme int(11) NOT NULL,
  Ekleyen mediumint(9) NOT NULL,
  Hit int(11) NOT NULL DEFAULT '0',
  Durum enum('a','p') NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE haberler (
  haberID mediumint(9) NOT NULL,
  haberKategori enum('bd','tt','diger') NOT NULL,
  haberBaslik varchar(255) NOT NULL,
  haberSef varchar(255) NOT NULL,
  haberKisabilgi varchar(255) NOT NULL,
  haberMetin text NOT NULL,
  haberEkleyen mediumint(9) NOT NULL,
  haberZaman int(11) NOT NULL,
  haberHit int(11) NOT NULL DEFAULT '0',
  haberResim varchar(200) NOT NULL DEFAULT 'resimyok.png',
  haberDurum enum('a','p') NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE icatlar (
  icatID mediumint(9) NOT NULL,
  icatTur enum('icat','kesif') NOT NULL,
  icatBaslik varchar(255) NOT NULL,
  icatSef varchar(255) NOT NULL,
  icatSahip mediumint(9) NOT NULL,
  icatKisabilgi varchar(255) NOT NULL,
  icatMetin text NOT NULL,
  icatEkleyen mediumint(9) NOT NULL,
  icatZaman int(11) NOT NULL,
  icatHit int(11) NOT NULL DEFAULT '0',
  icatResim varchar(200) NOT NULL DEFAULT 'resimyok.png',
  icatDurum enum('a','p') NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE uyeler (
  uyeID mediumint(9) NOT NULL,
  uyeAdi varchar(100) NOT NULL,
  uyeSifre varchar(150) NOT NULL,
  uyeAdsoyad varchar(200) NOT NULL,
  uyeMail varchar(150) NOT NULL,
  uyeTur enum('admin','uye','editor') NOT NULL DEFAULT 'uye',
  uyeResim varchar(150) NOT NULL DEFAULT 'resimyok.png',
  uyeZaman int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE yorumlar (
  yID mediumint(9) NOT NULL,
  ycID mediumint(9) NOT NULL,
  yUye mediumint(9) NOT NULL DEFAULT '0',
  yTur enum('i','h','b','s') NOT NULL DEFAULT 'b',
  yYapan varchar(120) NOT NULL,
  yMail varchar(150) NOT NULL,
  yWeb varchar(150) NOT NULL,
  yMesaj text NOT NULL,
  yZaman int(11) NOT NULL,
  yDurum enum('aktif','pasif') NOT NULL DEFAULT 'pasif',
  yBegen mediumint(9) NOT NULL DEFAULT '0',
  yBegenme mediumint(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE biyografiler
  ADD PRIMARY KEY (ID), ADD UNIQUE KEY AdSoyad (AdSoyad,AdSef);

ALTER TABLE haberler
  ADD PRIMARY KEY (haberID);

ALTER TABLE icatlar
  ADD PRIMARY KEY (icatID);

ALTER TABLE uyeler
  ADD PRIMARY KEY (uyeID), ADD UNIQUE KEY uyeAdi (uyeAdi);

ALTER TABLE yorumlar
  ADD PRIMARY KEY (yID);


ALTER TABLE biyografiler
  MODIFY ID mediumint(9) NOT NULL AUTO_INCREMENT;
ALTER TABLE haberler
  MODIFY haberID mediumint(9) NOT NULL AUTO_INCREMENT;
ALTER TABLE icatlar
  MODIFY icatID mediumint(9) NOT NULL AUTO_INCREMENT;
ALTER TABLE uyeler
  MODIFY uyeID mediumint(9) NOT NULL AUTO_INCREMENT;
ALTER TABLE yorumlar
  MODIFY yID mediumint(9) NOT NULL AUTO_INCREMENT;
  
 INSERT INTO uyeler (uyeID, uyeAdi, uyeSifre, uyeAdsoyad, uyeMail, uyeTur, uyeResim, uyeZaman) VALUES
(1, 'webmaster', '50a9c7dbf0fa09e8969978317dca12e8', 'Deneme Üye', 'deneme@mail.com', 'admin', 'resimyok.png', 2147483647); 
  
  