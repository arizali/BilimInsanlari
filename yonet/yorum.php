<?php 
require_once "../ayar.php"; 
RenderHead(); 
if(!ODurum || $uye_bilgi["uyeTur"]!="admin") { redirect(SURL."cikis.php"); exit(); }
?>
<div class="w1 fl">
<?php 
$q = dbquery("select * from yorumlar where yDurum='pasif' order by yZaman desc"); 
if(dbrows($q)!=0):
?>

<div class="genisbaslik"><h2 class="baslikbu">Aktifleşmemiş Yorumlar</h2></div>
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
<p class="ticerik" style="font-size:14px; line-height:17px;"><?php echo nl2br(stripinput($r["yMesaj"]));?></p>
<div class="ayrac5"></div>
<p class="ticerik">Yorum; <strong><?php echo $r["yYapan"];?></strong> (<a href="mailto:<?php echo $r["yMail"];?>">mail</a> | <a href="<?php echo $r["yWeb"];?>">web</a>) tarafından yapılmıştır<br />Yorum Zamanı: <strong><?php echo date("d.m.Y h:s", $r["yZaman"]);?></strong> tarihinde eklenmiştir.</p>

</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=yorum&durum=aktif&id=<?php echo $r["yID"];?>" class="butona">Aktifleştir</a>
<a href="./sil.php?icerik=yorum&id=<?php echo $r["yID"];?>" class="butona">Sil</a>
</td>
</tr>
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
$q = dbquery("select * from yorumlar where yDurum='aktif' order by yZaman desc"); 
if(dbrows($q)!=0):
?>

<div class="genisbaslik"><h2 class="baslikbu">Yorumlar</h2></div>
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
<p class="ticerik" style="font-size:14px; line-height:17px;"><?php echo nl2br(stripinput($r["yMesaj"]));?></p>
<div class="ayrac5"></div>
<p class="ticerik">Yorum; <strong><?php echo $r["yYapan"];?></strong> (<a href="mailto:<?php echo $r["yMail"];?>">mail</a> | <a href="<?php echo $r["yWeb"];?>">web</a>) tarafından yapılmıştır<br />Yorum Zamanı: <strong><?php echo date("d.m.Y h:s", $r["yZaman"]);?></strong> tarihinde eklenmiştir.</p>

</td>
<td width="100" class="tcc">
<a href="./ap.php?icerik=yorum&durum=pasif&id=<?php echo $r["yID"];?>" class="butona">Pasifleştir</a>
<a href="./sil.php?icerik=yorum&id=<?php echo $r["yID"];?>" class="butona">Sil</a>
</td>
</tr>
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