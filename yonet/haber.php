<?php 
require_once "../ayar.php"; 
RenderHead(); 
if(!ODurum || $uye_bilgi["uyeTur"]!="admin") { redirect(SURL."cikis.php"); exit(); }
?>
<div class="w1 fl">
<?php 
$q = dbquery("select h.*, u.uyeID, u.uyeAdsoyad from haberler as h
left join uyeler as u on h.haberEkleyen = u.uyeID where h.haberDurum='p' order by h.haberZaman"); 
if(dbrows($q)!=0):
?>

<div class="genisbaslik"><h2 class="baslikbu">Aktifleşmemiş Haberler</h2></div>
<div class="formwr">

<table class="tabloliste" width="610">
<!--<thead>
<tr><th width="610" class="tcl" colspan="3">Başlık</th></tr>
</thead>-->
<?php
echo '<tbody>';
$i = 0;
while($r = dbarray($q)):
$css = "st2";
if($i%2==0){ $css = "st1"; }
?>
<tr class="<?=$css;?>">
<td class="tcl">
<strong class="tbaslik"><?php echo $r["haberBaslik"];?></strong>
<p class="ticerik"><?php echo neat_trim(strip_tags($r["haberKisabilgi"]),20);?></p>
</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=haber&durum=aktif&id=<?php echo $r["haberID"];?>" class="butona">Aktifleştir</a>
<a href="#" class="butona">Düzenle</a>
<a href="./sil.php?icerik=haber&id=<?php echo $r["haberID"];?>" class="butona">Sil</a>
</td>
</tr>
<tr class="<?=$css;?>">
<td class="tcl" colspan="2"><p class="tbilgi">Haber; <strong><?php echo $r["uyeAdsoyad"];?></strong> tarafından, <strong><?php echo date("d.m.Y h:s", $r["haberZaman"]);?></strong> tarihinde eklenmiştir.</p></td>
<tr>
<?php 
$i++;
endwhile;
echo '</tbody>';
?>
</table>

</div>

<div class="ayrac"></div>
<div class="ayrac"></div>

<?php endif; ?>

<?php 
$q = dbquery("select h.*, u.uyeID, u.uyeAdsoyad from haberler as h
left join uyeler as u on h.haberEkleyen = u.uyeID where h.haberDurum='a' order by h.haberZaman"); 
if(dbrows($q)!=0):
?>
<div class="genisbaslik"><h2 class="baslikbu">Haberler</h2></div>
<div class="formwr" id="alllist">

<table class="tabloliste">
<!--<thead>
<tr><th width="610" class="tcl" colspan="3">Başlık</th></tr>
</thead>-->
<?php
echo '<tbody>';
$i = 0;
while($r = dbarray($q)):
$css = "st2";
if($i%2==0){ $css = "st1"; }
?>
<tr class="<?=$css;?>">
<td class="tcl">
<strong class="tbaslik"><?php echo $r["haberBaslik"];?></strong>
<p class="ticerik"><?php echo neat_trim(strip_tags($r["haberKisabilgi"]),20);?></p>
</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=haber&durum=pasif&id=<?php echo $r["haberID"];?>" class="butona">Pasifleştir</a>
<a href="#" class="butona">Düzenle</a>
<a href="./sil.php?icerik=haber&id=<?php echo $r["haberID"];?>" class="butona">Sil</a>
</td>
</tr>
<tr class="<?=$css;?>">
<td class="tcl" colspan="2"><p class="tbilgi">Haber; <strong><?php echo $r["uyeAdsoyad"];?></strong> tarafından, <strong><?php echo date("d.m.Y h:s", $r["haberZaman"]);?></strong> tarihinde eklenmiştir.</p></td>
<tr>
<?php 
$i++;
endwhile;
echo '</tbody>';
?>
</table>


</div>
<?php endif; ?>

<?php 
RenderSag();
RenderFoot(); 
?>