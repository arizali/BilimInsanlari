<?php 
require_once "../ayar.php"; 
if(!ODurum || $uye_bilgi["uyeTur"]!="admin") { redirect(SURL."cikis.php"); exit(); }

if(!in_array($_GET["icerik"],array("biyografi","haber","icat","yorum")) || !isNum($_GET["id"]) || !in_array($_GET["durum"],array("aktif","pasif"))) { redirect(SURL); exit(); }
$id = stripinput($_GET["id"]);
switch($_GET["icerik"]) {
case "biyografi":
switch($_GET["durum"]){
case "aktif":
$sonuc = dbquery("update biyografiler set Durum='a' where ID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/biyografi.php"); exit();}
else{ redirect(SURL); exit(); } 
break;

case "pasif":
$sonuc = dbquery("update biyografiler set Durum='p' where ID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/biyografi.php"); exit();}
else{ redirect(SURL); exit(); } 
break;
}
break;

case "icat":
switch($_GET["durum"]){
case "aktif":
$sonuc = dbquery("update icatlar set icatDurum='a' where icatID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/icat.php"); exit();}
else{ redirect(SURL); exit(); } 
break;

case "pasif":
$sonuc = dbquery("update icatlar set icatDurum='p' where icatID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/icat.php"); exit();}
else{ redirect(SURL); exit(); } 
break;
}
break;

case "haber":
switch($_GET["durum"]){
case "aktif":
$sonuc = dbquery("update haberler set haberDurum='a' where haberID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/haber.php"); exit();}
else{ redirect(SURL); exit(); } 
break;

case "pasif":
$sonuc = dbquery("update haberler set haberDurum='p' where haberID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/haber.php"); exit();}
else{ redirect(SURL); exit(); } 
break;
}
break;

case "yorum":
switch($_GET["durum"]){
case "aktif":
$sonuc = dbquery("update yorumlar set yDurum='aktif' where yID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/yorum.php"); exit();}
else{ redirect(SURL); exit(); } 
break;

case "pasif":
$sonuc = dbquery("update yorumlar set yDurum='pasif' where yID='$id' limit 1");
if($sonuc){redirect(SURL."yonet/yorum.php"); exit();}
else{ redirect(SURL); exit(); } 
break;
}
break;
}

?>