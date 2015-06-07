<?php 
require_once "ayar.php"; 
$sef = stripinput($_GET["sef"]);
$q = dbquery("select * from biyografiler where AdSef='$sef'");
if(dbrows($q)!=1) { redirect(SURL."404"); exit(); }
$haber_bilgisi = dbarray($q);
dbquery("update biyografiler set Hit = (Hit+1) where ID='".$haber_bilgisi["ID"]."' limit 1");

$sayfa_ozellikleri["baslik"] = "Bilim İnsanları » Biyografiler »".$haber_bilgisi["AdSoyad"];
$sayfa_ozellikleri["baslik2"] = "Bilim İnsanları » ".$haber_bilgisi["AdSoyad"];
$sayfa_ozellikleri["facebook"] = true;
$sayfa_ozellikleri["url"] = LinkOlustur("biyografi", array("sef"=>$haber_bilgisi["AdSef"]));;
$sayfa_ozellikleri["resim"] = SURL."resimler/biyografi/310b/".$haber_bilgisi["Resim"];
$sayfa_ozellikleri["aciklama"] = $haber_bilgisi["AdSoyad"]."; ".$haber_bilgisi["Dogum"]." tarihinde doğdu, ".$haber_bilgisi["Olum"]." tarihinde öldü. ".$haber_bilgisi["Ulke"]." vatandaşı idi. Uzmanlık alanları: ".implode(", ",unserialize($haber_bilgisi["Uzmanlik"]))." idi. Biyografisinin tamamı okumak için başlığa tıklayınız..";

$yorum_hata = false;
$yorum_hata_mesaj = array();
if(isset($_POST["YorumYap"])) {
$yorum_ad = stripinput($_POST["AdSoyad"]);  
$yorum_mail = stripinput($_POST["Mail"]);  
$yorum_web = stripinput($_POST["Web"]);  
$yorum_metin = stripinput($_POST["YorumMesaj"]);  

if(strlen(str_replace(" ", "",$yorum_ad))<4 || strlen(str_replace(" ", "",$yorum_ad))>30) {
$yorum_hata = true;
$yorum_hata_mesaj[] = "Ad soyad 4 karakter ile 30 karakter arasında olmalıdır.";
} 
if(strlen(str_replace(" ", "",$yorum_metin))<10) {
$yorum_hata = true;
$yorum_hata_mesaj[] = "Yorumunuz en az 10 karakter olmalıdır.";
}
if(!isValidUrl($yorum_web) && $yorum_web!="http://") {
$yorum_hata = true;
$yorum_hata_mesaj[] = "Geçersiz bir url girdiniz.";
} 
if(!isEmail($yorum_mail)) {
$yorum_hata = true;
$yorum_hata_mesaj[] = "Geçersiz bir mail adresi girdiniz.";
} 
if(!$yorum_hata) {
dbquery("insert into yorumlar values ('','".$haber_bilgisi["ID"]."','0','b','$yorum_ad','$yorum_mail','$yorum_web','$yorum_metin','".time()."','pasif','0','0')");	
redirect(LinkOlustur("biyografi", array("sef"=>$haber_bilgisi["AdSef"])));
exit();
}
}

RenderHead(); 
?>
<div class="w1 fl">

<div class="genisbaslik"><h2 class="baslikbu"><?=$haber_bilgisi["AdSoyad"];?></h2><a class="tumu" href="#">Sonraki »</a></div>
<div class="ayrac"></div>
<div class="icerikalani">
<div class="descbox">
<img class="ccres" src="<?=SURL."resimler/biyografi/310b/".$haber_bilgisi["Resim"];?>" alt="<?=$haber_bilgisi["AdSoyad"];?>" />
<?php 
$baknu = dbquery("select * from icatlar where icatSahip='".$haber_bilgisi["ID"]."'"); 
if(dbrows($baknu)>0) {
?>
<div class="ayrac"></div>
<div class="bloks">
<h2 class="blokbaslik">Bilim Dünyasına Kazandırdıkları</h2>
<div class="blokic">
<?php 
	echo '<ul class="icatlist">';
	while($baknut = dbarray($baknu)):
	echo '<li><a href="'.LinkOlustur("icat", array("id"=>$baknut["icatID"], "sef"=>$baknut["icatSef"])).'"><span class="bspanad">'.$baknut["icatBaslik"].'</span><span class="bspanhit"><strong>'.$baknut["icatHit"].'</strong> hit</span></a></li>';
	endwhile;	
	echo '</ul>';
?>
</div>
<div class="blokalt"></div>
</div>
<?php } ?>
</div>
<?=stripslashes($haber_bilgisi["Hakkinda"]);?>
<div class="cl"></div>
</div>

<div class="w1">

<div class="genisbaslik"><h2 class="baslikbu" style="font-size:15px;">Yorumlar</h2></div>
<div class="ayrac"></div>
<?php 
YorumGoster($haber_bilgisi["ID"]);
?>

<div class="ayrac"></div>
<div class="genisbaslik"><h2 class="baslikbu" style="font-size:15px;">Yorum Yap</h2></div>
<div class="ayrac"></div>
<?php 
if($yorum_hata) {
echo implode("<br /><br />", $yorum_hata_mesaj);
echo '<div class="ayrac"></div>';
} 
?>
<div id="yorum_gonder">
<form method="post" action="#yorum_gonder">
<div class="w2 fl" id="get_h">
<div class="formwr">
<div>
<label>Adınız Soyadınız</label>
<input name="AdSoyad" type="text" class="uzun300" value="<?=@$yorum_ad; ?>" />
</div>

<div>
<label>Mail Adresiniz</label> 
<input name="Mail" type="text" class="uzun300" value="<?=@$yorum_mail; ?>" />
</div>

<div>
<label>Web Siteniz</label>
<input name="Web" type="text" class="uzun300" value="<?=@$yorum_web; ?>" />
</div>

</div>
</div>
<div class="w2 fr">
<div class="formwr"><div>
<label id="allmy">Yorumunuz / Eklemek İstedikleriniz</label>
<textarea id="metin_kutu" name="YorumMesaj" class="textall uzun300"><?=@$yorum_metin; ?></textarea>
</div></div>
</div>
<div class="cb"></div>
<div class="w1 mb">Yorumunuz onaylandıktan sonra sitede görüntülenecektir...</div>
<div class="w1">
<div class="formwr">
<div>
<input type="submit" id="buttonx" name="YorumYap" value="Yorum Yap" />
</div></div>
</div>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
var vh = $("#get_h").height() - 26 - $("#allmy").height();
$("#metin_kutu").height(vh);
$("#buttonx").width("100%");
});
</script>

</div>

<?php 
RenderSag();
RenderFoot(); 
?>