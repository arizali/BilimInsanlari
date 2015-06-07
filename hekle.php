<?php 
require_once "ayar.php"; 
if(!ODurum){ redirect(SURL); exit(); }
RenderHead(); 
$kat_listesi = array("bd"=>"Bilim Dünyası", "tt"=>"Teknoloji ve Tasarım","diger"=>"Diğer");
$kat_listesi2 = array("bd", "tt","diger");
$hata = false;
$hatametin = array();
$opt_tt = "";
$opt_html = "";

if(isset($_POST["HaberEkle"])) {
//print_r($_POST);

$i1 = stripinput($_POST["Baslik"]);
$i1s = dost_Linkler($_POST["Baslik"]);
$i2 = stripinput($_POST["Kisabilgi"]);
$i4 = stripinput($_POST["katsec"]);
$i6 = addslashes($_POST["icerikTXT"]);
if(strlen(str_replace(" ","",$i1))<3 ) { $hata = true; $hatametin[]= "Haber başlığı yazmadınız...";}
if(strlen(str_replace(" ","",$i2))<10 ) { $hata = true; $hatametin[]= "Kısa bilgi en az 10 karakter olmalıdır...";}
if(strlen(str_replace(" ","",$i6))<30 ) { $hata = true; $hatametin[]= "Haber metni çok kısa...";}
if(!in_array($i4, $kat_listesi2)) { $hata = true; $hatametin[]= "Kategori seçmediniz...";}
if(!$hata) {
$resim_sonuc = ResimYukle($_FILES["fotograf"], "haber");
if($resim_sonuc["hata"]=="yok") { 
$yen = $resim_sonuc["resim"]; 
$durum = "p";
if($uye_bilgi["uyeTur"] == "admin") {
$durum = "a";
}
$sonuc = dbquery("insert into haberler values ('','$i4','$i1', '$i1s', '$i2', '$i6', '".$uye_bilgi["uyeID"]."', '".time()."', '0', '$yen','$durum')");
redirect("hekle.php?durum=eklemebasarili");
exit();
} else {
$hata = true; $hatametin[]= "Resim yüklenmesi sırasında bir hata oluştu...";
}
}


}
foreach($kat_listesi as $kat=>$t) {
if(@$i4==$kat) {$opt_html .= '<option selected="selected" value="'.$kat.'">'.$t.'</option>'; } 
else {$opt_html .= '<option value="'.$kat.'">'.$t.'</option>'; } 
}

?>
<div class="w1 fl">
<?php
if($hata) { echo implode("<br /><br />",  $hatametin);}
 // RenderManset(); ?>

<div class="genisbaslik"><h2 class="baslikbu">Haber Ekle</h2></div>
<div class="ayrac"></div>
<div class="formwr">
<form method="post" enctype="multipart/form-data" action="?">
<div><label>Başlık</label><input type="text" value="<?=@$i1;?>" class="uzun310" name="Baslik" /></div>
<div><label>Kısa açıklama</label><input name="Kisabilgi" type="text" value="<?=@$i2;?>" class="uzunfull"/></div>
<div><label>Haber Kategorisi</label><select class="uzun315 select" name="katsec"><option>Seçiniz</option><?=@$opt_html;?></select></div>
<div><label>Fotoğraf</label><input type="file" id="fileinput" class="uzun310" name="fotograf" /></div>
<div><textarea id="hakkinda" name="icerikTXT"><?=stripslashes(@$i6);?></textarea></div>
<div><input type="submit" value="Haber Ekle" name="HaberEkle" /></div>


</form>
<script type="text/javascript">

$(document).ready(function() {
$("#fileinput").change(function() {
var src = $(this).val();
var ext = src.split(".").pop().toLowerCase();
if($.inArray(ext, ["gif","png","jpg","jpeg"]) == -1) {
$(this).val("")	
alert("geçersiz dosya uzantısı!");
} else {	
return true;
}
});
});
function clickFileUpload() {
$("#fileinput").trigger("click");
}
</script>
</div>
<?php 
RenderSag();
RenderFoot(); 
?>