<?php 
require_once "ayar.php"; 
if(!ODurum){ redirect(SURL); exit(); }
RenderHead(); 
$kat_listesi = array("icat"=>"İcat", "kesif"=>"Keşif");
$kat_listesi2 = array("icat", "kesif");
$hata = false;
$hatametin = array();
$opt_tt = "";
$opt_html = "";
$opt_html_yazar = "";
if(isset($_POST["IcatEkle"])) {
//print_r($_POST);

$i1 = stripinput($_POST["Baslik"]);
$i1s = dost_Linkler($_POST["Baslik"]);
$i2 = stripinput($_POST["Kisabilgi"]);
$i4 = stripinput($_POST["katsec"]);
$i9 = stripinput($_POST["yazarsec"]);
$i6 = addslashes($_POST["icerikTXT"]);
if(strlen(str_replace(" ","",$i1))<3 ) { $hata = true; $hatametin[]= "İcat başlığı yazmadınız...";}
if(strlen(str_replace(" ","",$i2))<10 ) { $hata = true; $hatametin[]= "İcat bilgi en az 10 karakter olmalıdır...";}
if(strlen(str_replace(" ","",$i6))<30 ) { $hata = true; $hatametin[]= "İcat metni çok kısa...";}
if(!in_array($i4, $kat_listesi2)) { $hata = true; $hatametin[]= "Kategori seçmediniz...";}
if(!in_array($i9, $tum_yazarlar_liste_n)) { $hata = true; $hatametin[]= "Yazar seçmediniz...";}
if(!$hata) {
$resim_sonuc = ResimYukle($_FILES["fotograf"], "icat");
if($resim_sonuc["hata"]=="yok") { 
$yen = $resim_sonuc["resim"]; 
$durum = "p";
if($uye_bilgi["uyeTur"] == "admin") {
$durum = "a";
}

$sonuc = dbquery("insert into icatlar values ('','$i4','$i1', '$i1s', '$i9', '$i2', '$i6', '".$uye_bilgi["uyeID"]."', '".time()."', '0', '$yen','$durum')");
redirect("iekle.php?durum=eklemebasarili");
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


foreach($tum_yazarlar_liste as $yazar) {
if(@$i9==$yazar["ID"]) {$opt_html_yazar.= '<option selected="selected" value="'.$yazar["ID"].'">'.$yazar["Ad"].'</option>'; } 
else {$opt_html_yazar .= '<option value="'.$yazar["ID"].'">'.$yazar["Ad"].'</option>'; } 
}

?>
<div class="w1 fl">
<?php
if($hata) { echo implode("<br /><br />",  $hatametin);}
 // RenderManset(); ?>

<div class="genisbaslik"><h2 class="baslikbu">İcat/Keşif Ekle</h2></div>
<div class="ayrac"></div>
<div class="formwr">
<form method="post" enctype="multipart/form-data" action="?">
<div><label>Başlık</label><input type="text" value="<?=@$i1;?>" class="uzun310" name="Baslik" /></div>
<div><label>Bulan Kişi</label><select class="uzun315 select" name="yazarsec"><option>Seçiniz</option><?=@$opt_html_yazar;?></select></div>
<div><label>Kısa açıklama</label><input name="Kisabilgi" type="text" value="<?=@$i2;?>" class="uzunfull"/></div>
<div><label>İçerik Türü</label><select class="uzun315 select" name="katsec"><option>Seçiniz</option><?=@$opt_html;?></select></div>
<div><label>Fotoğraf</label><input type="file" id="fileinput" class="uzun310" name="fotograf" /></div>
<div><textarea id="hakkinda" name="icerikTXT"><?=stripslashes(@$i6);?></textarea></div>
<div><input type="submit" value="İcat Ekle" name="IcatEkle" /></div>


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