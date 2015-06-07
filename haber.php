<?php 
require_once "ayar.php"; 
$id = stripinput($_GET["id"]);
$sef = stripinput($_GET["sef"]);
$tur_a = array("bilimdunyasi"=>array("c"=>"bd","t"=>"Bilim Dünyasından Haberler") ,"haber"=>array("c"=>"diger","t"=>"Teknoloji Haberleri"), "teknolojivetasarim"=>array("c"=>"tt","t"=>"Teknoloji ve Tasarım")) ;
$tur = $tur_a[stripinput($_GET["tur"])];
$q = dbquery("select * from haberler where haberID='$id' and haberSef='$sef' and haberKategori='".$tur["c"]."'");
if(dbrows($q)!=1) { redirect(SURL."404"); exit(); }
$haber_bilgisi = dbarray($q);
dbquery("update haberler set haberHit = (haberHit+1) where haberID='$id' limit 1");
$sayfa_ozellikleri["baslik"] = "Bilim İnsanları » ".$tur["t"]." »".$haber_bilgisi["haberBaslik"];
$sayfa_ozellikleri["baslik2"] = $tur["t"]." » ".$haber_bilgisi["haberBaslik"];
$sayfa_ozellikleri["facebook"] = true;
$sayfa_ozellikleri["url"] = LinkOlustur("haber", array("tur"=>$tur_a[stripinput($_GET["tur"])]["c"],"id"=>$id, "sef"=>$sef));
$sayfa_ozellikleri["resim"] = SURL."resimler/haber/310b/".$haber_bilgisi["haberResim"];
$sayfa_ozellikleri["aciklama"] = $haber_bilgisi["haberKisabilgi"];
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
dbquery("insert into yorumlar values ('','$id','0','h','$yorum_ad','$yorum_mail','$yorum_web','$yorum_metin','".time()."','aktif','0','0')");	
redirect(LinkOlustur("haber", array("tur"=>$tur_a[stripinput($_GET["tur"])]["c"],"id"=>$id, "sef"=>$sef)));
exit();
}
}

RenderHead(); 
?>
<div class="w1 fl">

<div class="genisbaslik"><h2 class="baslikbu" style="font-size:15px;"><?=$haber_bilgisi["haberBaslik"];?></h2></div>
<div class="ayrac"></div>
<div class="icerikalani">
<div class="descbox"><img class="ccres" src="<?=SURL."resimler/haber/310b/".$haber_bilgisi["haberResim"];?>" alt="<?=$haber_bilgisi["haberBaslik"];?>" />
<div class="ayrac"></div>
<div style=" font-size:10px; padding:5px; background:#eee;">Eklenme Tarihi: <strong><?=date("d.m.Y h:s", $haber_bilgisi["haberZaman"]);?></strong><br />
Okunma: <strong><?=$haber_bilgisi["haberHit"]+1;?></strong>
</div>

</div>
<?php
$pattern = "<p[^>]*>(?:\s+|(?:&nbsp;)+|(?:<br\s*/?>)+)*</p>"; 
 
echo preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '', stripslashes($haber_bilgisi["haberMetin"]));?>
<div class="cl"></div>
</div>
<div class="w1">

<div class="genisbaslik"><h2 class="baslikbu" style="font-size:15px;">Yorumlar</h2></div>
<div class="ayrac"></div>
<?php 
YorumGoster($haber_bilgisi["haberID"], "haber");
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