<?php 
require_once "ayar.php"; 
if(!ODurum) { redirect(SURL); exit(); } 
RenderHead(); 
$hata = false;
$hatametin = array();
$opt_tt = "";
$opt_html = "";

if(isset($_POST["BiyoEkle"])) {
//print_r($_POST);

$i1 = stripinput($_POST["AdSoyad"]);
$i1s = dost_Linkler($_POST["AdSoyad"]);
$i2 = stripinput($_POST["dogum"]);
$i3 = stripinput($_POST["olum"]);
$i4 = stripinput($_POST["ulkesec"]);
$turk = "hayir"; 
if($i4=="Türkiye") { $turk = "evet"; }
$i5 = (@$_POST["uzmanlik"]);
$i6 = addslashes($_POST["hakkindaTXT"]);
$d_reg = '/^\d{1,2}\/\d{1,2}\/\d/';
if(strlen(str_replace(" ","",$i1))<3 ) { $hata = true; $hatametin[]= "Biyografi sahibinin adını girmediniz...";}
if(strlen(str_replace(" ","",$i6))<30 ) { $hata = true; $hatametin[]= "Hakkında kısmında verdiğiniz bilgi yeterli değildir...";}
if(!in_array($i4, $ulkeler_listesi)) { $hata = true; $hatametin[]= "Ülke seçmediniz...";}
if(!is_array($i5)) { $hata = true; $hatametin[]= "Uzmanlık seçmediniz...";}
if(!preg_match($d_reg ,$i2) || !preg_match($d_reg ,$i3) ) { $hata = true; $hatametin[]= "Doğum ya da ölüm tarihi hatalı... <br />Format: DD/MM/YYYY olmalı"; }
if(!$hata) {
$resim_sonuc = ResimYukle($_FILES["fotograf"]);
if($resim_sonuc["hata"]=="yok") { 
$yen = $resim_sonuc["resim"]; 
$durum = "p";
if($uye_bilgi["uyeTur"] == "admin") {
$durum = "a";
}

$sonuc = dbquery("insert into biyografiler values ('','$turk','$i1', '$i1s', '$i2', '$i3', '$i4', '".serialize($i5)."','$i6','$yen','".time()."','".$uye_bilgi["uyeID"]."','0','$durum')");
redirect("ekle.php?durum=eklemebasarili");
exit();
} else {
$hata = true; $hatametin[]= "Resim yüklenmesi sırasında bir hata oluştu...";
}
}
if(is_array($i5)) {
foreach($i5 as $ii) {
	$opt_tt .= '<option value="'.$ii.'" class="selected">'.$ii.'</option>'; 
}
}

}
foreach($ulkeler_listesi as $ulkeler) {
if(@$i4==$ulkeler) {$opt_html .= '<option selected="selected" value="'.$ulkeler.'">'.$ulkeler.'</option>'; } 
else {$opt_html .= '<option value="'.$ulkeler.'">'.$ulkeler.'</option>'; } 
}

?>
<div class="w1 fl">
<?php
if($hata) { echo implode("<br /><br />",  $hatametin);}
 // RenderManset(); ?>

<div class="genisbaslik"><h2 class="baslikbu">Biyografi Ekle</h2></div>
<div class="ayrac"></div>
<div class="formwr">
<form method="post" enctype="multipart/form-data" action="?">
<div><label>Bilim Adamı</label><input type="text" value="<?=@$i1;?>" class="uzun310" name="AdSoyad" /></div>
<div><label>Doğum / Ölüm Tarihi</label><input type="text" value="<?=@$i2;?>" class="uzun145 mr" name="dogum" /><input value="<?=@$i3;?>" type="text" class="uzun145" name="olum" /></div>
<div><label>Ülke</label><select class="uzun315 select" name="ulkesec"><option>Seçiniz</option><option value="Türkiye">Türkiye</option><?=@$opt_html;?></select></div>
<div><label>Uzmanlık Alanı</label><select id="uzmanlik" name="uzmanlik"><?=@$opt_tt;?></select>
</div>
<div><label>Fotoğraf</label><input type="file" id="fileinput" class="uzun310" name="fotograf" /></div>


<div><textarea id="hakkinda" name="hakkindaTXT"><?=stripslashes(@$i6);?></textarea></div>
<div><input type="submit" value="Biyografiyi Ekle" name="BiyoEkle" /></div>


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

        <script type="text/javascript">
            $(document).ready(function(){                
                $("#uzmanlik").fcbkcomplete({
                    json_url: "data.txt",
			        complete_text: "Bir bilim dalı giriniz...",
                    addontab: true,                   
                    maxitems: 3,
                    input_min_size: 0,
                    height: 10,
                    cache: true,
                    newel: true,
                    select_all_text: "seç",
                });
            });
        </script>
</div>
<?php 
RenderSag();
RenderFoot(); 
?>