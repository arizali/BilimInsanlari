<?php 
require_once "../ayar.php"; 
if(!ODurum || $uye_bilgi["uyeTur"]!="admin") { redirect(SURL."cikis.php"); exit(); }

if(!in_array($_GET["icerik"],array("biyografi","haber","icat","yorum")) || !isNum($_GET["id"]) ) { redirect(SURL); exit(); }
$id = stripinput($_GET["id"]);
switch($_GET["icerik"]) {
case "biyografi":

$sorgu = dbquery("select Resim from biyografiler where ID='$id'");
if(dbrows($sorgu)==1) {
$bul = dbarray($sorgu);
if($bul["Resim"]!="resimyok.png") {
unlink(ANADIZIN."resimler/biyografi/32/".$bul["Resim"]);
unlink(ANADIZIN."resimler/biyografi/90/".$bul["Resim"]);
unlink(ANADIZIN."resimler/biyografi/310/".$bul["Resim"]);
unlink(ANADIZIN."resimler/biyografi/310b/".$bul["Resim"]);
unlink(ANADIZIN."resimler/biyografi/orj/".$bul["Resim"]);

}
$sonuc = dbquery("delete from biyografiler where ID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/biyografi.php"); exit();}
else { redirect(SURL); exit(); }
} else { redirect(SURL); exit(); }

break;

case "icat":

$sorgu = dbquery("select icatResim from icatlar where icatID='$id'");
if(dbrows($sorgu)==1) {
$bul = dbarray($sorgu);
if($bul["icatResim"]!="resimyok.png") {
unlink(ANADIZIN."resimler/icat/32/".$bul["icatResim"]);
unlink(ANADIZIN."resimler/icat/90/".$bul["icatResim"]);
unlink(ANADIZIN."resimler/icat/310/".$bul["icatResim"]);
unlink(ANADIZIN."resimler/icat/310b/".$bul["icatResim"]);
unlink(ANADIZIN."resimler/icat/orj/".$bul["icatResim"]);
}
$sonuc = dbquery("delete from icatlar where icatID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/icat.php"); exit();}
else { redirect(SURL); exit(); }
} else { redirect(SURL); exit(); }

break;

case "haber":

$sorgu = dbquery("select haberResim from haberler where haberID='$id'");
if(dbrows($sorgu)==1) {
$bul = dbarray($sorgu);
if($bul["haberResim"]!="resimyok.png") {
unlink(ANADIZIN."resimler/icat/32/".$bul["haberResim"]);
unlink(ANADIZIN."resimler/icat/90/".$bul["haberResim"]);
unlink(ANADIZIN."resimler/icat/310/".$bul["haberResim"]);
unlink(ANADIZIN."resimler/icat/310b/".$bul["haberResim"]);
unlink(ANADIZIN."resimler/icat/orj/".$bul["haberResim"]);
}
$sonuc = dbquery("delete from haberler where haberID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/haber.php"); exit();}
else { redirect(SURL); exit(); }
} else { redirect(SURL); exit(); }

break;

case "yorum":
$sonuc = dbquery("delete from yorumlar where yID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/yorum.php"); exit();}
else { redirect(SURL); exit(); }
break;

}

?>