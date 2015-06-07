<?php 
function RenderHead() {	require_once ANADIZIN."tema/header.php"; }
function RenderManset() {	require_once ANADIZIN."tema/manset.php"; }
function RenderFoot() { require_once ANADIZIN."tema/footer.php"; }
function RenderSag() { 	require_once ANADIZIN."tema/side_right.php"; }
function SayfaBaslik($durum = false){
global $sayfa_ozellikleri; 
if(!$durum) {
if(isset($sayfa_ozellikleri["baslik"]) && !empty($sayfa_ozellikleri["baslik"])) {
echo $sayfa_ozellikleri["baslik"];
} else { echo "Bilim İnsanları"; } 
} else {
if(isset($sayfa_ozellikleri["baslik"]) && !empty($sayfa_ozellikleri["baslik"])) {
return $sayfa_ozellikleri["baslik"];
} else { return "Bilim İnsanları"; } 	
}
}

function SayfaAciklama($durum = false){
global $sayfa_ozellikleri; 
if(!$durum) {
if(isset($sayfa_ozellikleri["aciklama"]) && !empty($sayfa_ozellikleri["aciklama"])) {
echo $sayfa_ozellikleri["aciklama"];
} else { echo "Bu sitede Türkiye ve Dünya'da bilim dünyasına ışık tutmuş bilim adamlarının biyografileri, buluşları, teorileri, araştırmaları hakkında bilgi sahibi olabilirsiniz."; } 
} else {
if(isset($sayfa_ozellikleri["aciklama"]) && !empty($sayfa_ozellikleri["aciklama"])) {
return $sayfa_ozellikleri["aciklama"];
} else { return "Bu sitede Türkiye ve Dünya'da bilim dünyasına ışık tutmuş bilim adamlarının biyografileri, buluşları, teorileri, araştırmaları hakkında bilgi sahibi olabilirsiniz."; } 
} 
}

function SayfaFacebook(){
global $sayfa_ozellikleri; 
if(isset($sayfa_ozellikleri["facebook"]) && $sayfa_ozellikleri["facebook"]) {

echo '<meta property="fb:admins" content="1566066437"/>
<meta property="fb:app_id" content="156957124426424"/>
<meta property="og:title" content="'.$sayfa_ozellikleri["baslik2"].'"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="'.$sayfa_ozellikleri["url"].'"/>
<meta property="og:site_name" content="Bilim İnsanları"/>
<meta property="og:image" content="'.$sayfa_ozellikleri["resim"].'"/>
<meta property="og:description" content="'.SayfaAciklama(true).'" />';
} else { 
echo '<meta property="fb:admins" content="1566066437"/>
<meta property="fb:app_id" content="156957124426424"/>
<meta property="og:title" content="'.SayfaBaslik(true).'"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="http://www.biliminsanlari.com"/>
<meta property="og:site_name" content="Bilim İnsanları"/>
<meta property="og:image" content="http://www.biliminsanlari.com/facelogo.png"/>
<meta property="og:description" content="'.SayfaAciklama(true).'" />';
} 
}



function BiyoBox($biyo=array()) {
echo '<div class="biyobox w2 fl mr"><a href="'.$biyo["Link"].'"><img src="'.SURL.'resimler/biyografi/90/'.$biyo["Resim"].'" class="biyoresim" alt="'.$biyo["AdSoyad"].'" /><span class="biyokim">'.$biyo["AdSoyad"].'</span><span class="dogum">'.$biyo["DTarih"].' - '.$biyo["OTarih"].'</span><span class="sehir">'.$biyo["Sehir"].'</span></a></div>';
}

function YorumGoster($id, $tur ="biyografi") {
switch($tur) {	
case "biyografi":
$yorum_al = dbquery("select * from yorumlar where yTur='b' and ycID='$id' and yDurum='aktif' order by yZaman asc");
break;	
case "icat":
$yorum_al = dbquery("select * from yorumlar where yTur='i' and ycID='$id' and yDurum='aktif' order by yZaman asc");
break;
case "haber":
$yorum_al = dbquery("select * from yorumlar where yTur='h' and ycID='$id' and yDurum='aktif' order by yZaman asc");
break;
case "sayfa":
$yorum_al = dbquery("select * from yorumlar where yTur='s' and ycID='$id' and yDurum='aktif' order by yZaman asc");
break;

}
$toplam_sonuc = dbrows($yorum_al);

if($toplam_sonuc>0) {
$n = 0;
while($r_yorum_al = dbarray($yorum_al)):	
echo '<div class="yorum_wrapper">
<div class="db">
<div class="yorum_bilgi"><a href="'.$r_yorum_al["yWeb"].'" class="y_isim">'.$r_yorum_al["yYapan"].'</a>
<span class="y_tarih">'.date("d.m.Y h:s", $r_yorum_al["yZaman"]).' tarihinde</span>
<img class="img_rz" src="'.get_gravatar($r_yorum_al["yMail"],120).'" alt="" />
</div>
</div>
<div class="yorum_mesaj">'.nl2br($r_yorum_al["yMesaj"]).'</div>
</div>';
if($n!=($toplam_sonuc-1)) echo '<div class="ayrac"></div>';
$n++;
endwhile;
} else { 
echo '<div class="yorum_wrapper">
<div class="db">
<div class="yorum_bilgi"><span class="y_isim">Bilim İnsanları</span>
<span class="y_tarih">'.date("d.m.Y h:s").' tarihinde</span>
<img class="img_rz" src="'.SURL.'images/c.jpg" alt="" />
</div>
</div>
<div class="yorum_mesaj">Lütfen içerik hakkında yorum yaparak sitemizi geliştirmemize yardım ediniz</div>
</div>';

}
}
?>