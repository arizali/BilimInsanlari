<?php 
require_once "../ayar.php"; 
RenderHead(); 
if(!ODurum || $uye_bilgi["uyeTur"]!="admin") { redirect(SURL."cikis.php"); exit(); }
?>
<div class="w1 fl">
<?php 
$q = dbquery("select b.*, u.uyeID, u.uyeAdsoyad from biyografiler as b
left join uyeler as u on b.Ekleyen = u.uyeID where b.Durum='p' order by b.Eklenme"); 
if(dbrows($q)!=0):
?>

<div class="genisbaslik"><h2 class="baslikbu">Pasif Biyografiler</h2></div>
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
<img class="imres" src="<?php echo SURL;?>resimler/biyografi/90/<?php echo $r["Resim"];?>" />
<strong class="tbaslik"><?php echo $r["AdSoyad"];?></strong>
<small class="ttarih">(<?php echo $r["Dogum"];?> - <?php echo $r["Olum"];?>) / <?php echo $r["Ulke"];?></small>
<p class="ticerik"><?php echo neat_trim(strip_tags($r["Hakkinda"]),20);?></p>
<div class="cl"></div>
</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=biyografi&durum=aktif&id=<?php echo $r["ID"];?>" class="butona">Aktifleştir</a>
<a href="#" class="butona">Düzenle</a>
<a href="./sil.php?icerik=biyografi&id=<?php echo $r["ID"];?>" class="butona">Sil</a>
</td>
</tr>
<tr class="<?=$css;?>">
<td class="tcl" colspan="2"><p class="tbilgi">Biyografi; <strong><?php echo $r["uyeAdsoyad"];?></strong> tarafından, <strong><?php echo date("d.m.Y h:s", $r["Eklenme"]);?></strong> tarihinde eklenmiştir.</p></td>
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

<div class="genisbaslik"><h2 class="baslikbu">Aktif Biyografiler</h2></div>
<div class="formwr" id="alllist">
<?php 
$q = dbquery("select b.*, u.uyeID, u.uyeAdsoyad from biyografiler as b
left join uyeler as u on b.Ekleyen = u.uyeID where b.Durum='a' order by b.Eklenme"); 
if(dbrows($q)!=0):
?>
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
<img class="imres" src="<?php echo SURL;?>resimler/biyografi/90/<?php echo $r["Resim"];?>" />
<strong class="tbaslik"><?php echo $r["AdSoyad"];?></strong>
<small class="ttarih">(<?php echo $r["Dogum"];?> - <?php echo $r["Olum"];?>) / <?php echo $r["Ulke"];?></small>
<p class="ticerik"><?php echo neat_trim(strip_tags($r["Hakkinda"]),20);?></p>
<div class="cl"></div>
</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=biyografi&durum=pasif&id=<?php echo $r["ID"];?>" class="butona">Pasifleştir</a>
<a href="#" class="butona">Düzenle</a>
<a href="./sil.php?icerik=biyografi&id=<?php echo $r["ID"];?>" class="butona">Sil</a>
</td>
</tr>
<tr class="<?=$css;?>">
<td class="tcl" colspan="2"><p class="tbilgi">Biyografi; <strong><?php echo $r["uyeAdsoyad"];?></strong> tarafından, <strong><?php echo date("d.m.Y h:s", $r["Eklenme"]);?></strong> tarihinde eklenmiştir.</p></td>
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