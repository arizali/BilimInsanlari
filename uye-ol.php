<?php 
require_once "ayar.php"; 
$hata_durum = false; $hata_metin = array();
if(isset($_POST["KayitOl"])) {
$kullanici = stripinput($_POST["Kullanici"]);
$adsoyad = stripinput($_POST["AdSoyad"]);
$sifre = stripinput($_POST["Sifre"]);
$sifret = stripinput($_POST["SifreT"]);
$mail = stripinput($_POST["Mail"]);

if(strlen($kullanici)<3 || strlen($kullanici)>15) { $hata_durum = true; $hata_metin[] = "Kullanıcı adı en az 3 en fazla 15 karakter olabilir"; } else { 
$q = dbquery("select * from uyeler where uyeAdi='$kullanici'");
if(dbrows($q)!=0) {$hata_durum = true; $hata_metin[] = "Bu kullanıcı adı sistemde kayıtlı"; }
}
if(strlen($adsoyad)<3 || strlen($adsoyad)>25) { $hata_durum = true; $hata_metin[] = "Adsoyadınız en az 3 en fazla 25 karakter olabilir"; }
if(strlen($sifre)<3 || strlen($sifre)>8) { $hata_durum = true; $hata_metin[] = "Şifreniz en az 3 en fazla 8 karakter olabilir";} else { if($sifre != $sifret) { $hata_durum = true; $hata_metin[] = "Şifrenizin tekrarı aynı değil."; } } 
if(!isEmail($mail)) { $hata_durum = true; $hata_metin[] = "Geçersiz bir mail girdiniz"; } else {
$q = dbquery("select * from uyeler where uyeMail='$mail'");
if(dbrows($q)!=0) {$hata_durum = true; $hata_metin[] = "Bu mail sistemde kayıtlı"; }
}

if(!$hata_durum) {
$sifre = md5(strtolower($sifre));	
$durdur = dbquery("insert into uyeler values('','$kullanici','$sifre','$adsoyad','$mail','uye','resimyok.png','".time()."')");
	if($durdur) {
	createCookie("Bilim_Online", "evet", time()+53600);
	createCookie("u_lab_it", $kullanici, time()+53600);
	createCookie("u_lab_it_to_me", strrev($sifre), time()+53600);
	redirect("bilgilendirme.php?durum=kayit");
	exit();
	}
}
}
RenderHead(); 
?>
<div class="w1 fl">
<div class="genisbaslik"><h2 class="baslikbu">Yeni Üyelik</h2></div>
<div class="ayrac"></div>
<div class="formwr">
<?php 
if($hata_durum) {
echo '<ul class="hata_ul_wr">';
foreach($hata_metin as $hata) {
echo '<li>'.$hata.'</li>';
}	
echo '</ul>';
} 
?>

<form method="post" action="?">
<div><label>Kullanıcı Adı</label><input type="text" value="<?=@$kullanici;?>" class="uzun310" name="Kullanici" /></div>
<div><label>Adınız Soyadınız</label><input type="text" value="<?=@$adsoyad;?>" class="uzun310" name="AdSoyad" /></div>
<div><label>Şifre / Şifre Tek.</label><input type="text" value="<?=@$sifre;?>" class="uzun145 mr" name="Sifre" /><input value="<?=@$sifret;?>" type="text" class="uzun145" name="SifreT" /></div>
<div><label>Mail Adresiniz</label><input type="text" value="<?=@$mail;?>" class="uzun310" name="Mail" /></div>

<div><input type="submit" value="Kayıt Ol" name="KayitOl" /></div>

</form>
</div>
<?php 
RenderSag();
RenderFoot(); 
?>