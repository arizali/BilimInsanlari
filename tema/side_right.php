<?php global $uye_bilgi; ?>
</div>

<div class="w2 fr bge4">
<?php if(!ODurum): ?>
<div class="bloks">
<h2 class="blokbaslik">Üye Girişi</h2>
<div class="blokic">
<form method="post" action="?">
<div class="form-div"><label>Kullanıcı Adı</label><input type="text" placeholder="[a-zA-Z0-9]" name="kullaniciadi" /></div>
<div class="form-div"><label>Şifre</label><input type="password" placeholder="[a-zA-Z0-9]" name="kullanicisifre" /></div>
<div class="form-div2"><input type="submit" name="site_giris" value="Siteye Gir" /></div>
</form>
<a class="yeniuyelik" href="<?php echo SURL; ?>uye-ol.php"><img src="<?php echo SURL; ?>images/uyelik.png" alt="yeni üyelik" /></a>
</div>
<div class="blokalt"></div>
</div>
<div class="ayrac"></div>
<?php else: ?>
<div class="bloks">
<h2 class="blokbaslik">Hoşgeldin, <strong style="font-weight:bolder;"><?php echo $uye_bilgi["uyeAdsoyad"]; ?></strong></h2>
<div class="blokic">
<a class="yeniuyelik" href="<?php echo SURL; ?>ekle.php"><img src="<?php echo SURL; ?>images/biyografi-ekle.png" alt="" /></a>
<div class="ayrac"></div>
<a class="yeniuyelik" href="<?php echo SURL; ?>iekle.php"><img src="<?php echo SURL; ?>images/icat-ekle.png" alt="" /></a>
<div class="ayrac"></div>
<a class="yeniuyelik" href="<?php echo SURL; ?>hekle.php"><img src="<?php echo SURL; ?>images/haber-ekle.png" alt="" /></a>
<div class="ayrac"></div>
<a class="yeniuyelik" href="<?php echo SURL; ?>cikis.php"><img src="<?php echo SURL; ?>images/cikis.png" alt="" /></a>
</div>
<div class="blokalt"></div>
</div>
<div class="ayrac"></div>
<?php 
if($uye_bilgi["uyeTur"]=="admin") {
?>
<div class="bloks">
<h2 class="blokbaslik"><strong style="font-weight:bolder;">Yönetim</strong> Paneli</strong></h2>
<div class="blokic">
<a class="yeniuyelik" href="<?php echo SURL; ?>yonet/biyografi.php"><img src="<?php echo SURL; ?>images/cp/biduzenle.png" alt="" /></a>
<div class="ayrac"></div>
<!--<a class="yeniuyelik" href="<?php echo SURL; ?>yonet/uye.php"><img src="<?php echo SURL; ?>images/cp/uyeduzenle.png" alt="" /></a>
<div class="ayrac"></div>-->
<a class="yeniuyelik" href="<?php echo SURL; ?>yonet/icat.php"><img src="<?php echo SURL; ?>images/cp/icatduzenle.png" alt="" /></a>
<div class="ayrac"></div>
<a class="yeniuyelik" href="<?php echo SURL; ?>yonet/haber.php"><img src="<?php echo SURL; ?>images/cp/haberduzenle.png" alt="" /></a>
<div class="ayrac"></div>
<a class="yeniuyelik" href="<?php echo SURL; ?>yonet/yorum.php"><img src="<?php echo SURL; ?>images/cp/yorumyonet.png" alt="" /></a>
</div>
<div class="blokalt"></div>
</div>
<div class="ayrac"></div>

<?php } ?>
<?php endif; ?>
<div class="bloks">
<h2 class="blokbaslik">Popüler Biyografiler</h2>
<div class="blokic">
<?php 
$q = dbquery("select * from biyografiler order by Hit desc limit 0,8"); 
if(dbrows($q)>0) {
	echo '<ul class="biyolist">';
	while($r = dbarray($q)):
	echo '<li><a title="'.$r["AdSoyad"].'" href="'.LinkOlustur("biyografi", array("sef"=>$r["AdSef"])).'"><span class="bspanad">'.$r["AdSoyad"].'</span><span class="bspanhit"><strong>'.$r["Hit"].'</strong> hit</span></a></li>';
	endwhile;	
	echo '</ul>';
	}
?>


</div>
<div class="blokalt"></div>
</div>


<div class="ayrac"></div>
<div class="bloks">
<h2 class="blokbaslik">Facebook Fans</h2>
<div class="blokic">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/all.js#xfbml=1&appId=156957124426424";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="http://www.facebook.com/biliminsanlari" data-width="280" data-show-faces="true" data-border-color="#ffffff" data-stream="false" data-header="false"></div>

</div>
<div class="blokalt"></div>
</div>

<div class="ayrac"></div>
<div class="bloks">
<h2 class="blokbaslik">Popüler İcatlar ve Keşifler</h2>
<div class="blokic">

<?php 
$q = dbquery("select * from icatlar order by icatHit desc limit 0,5"); 
if(dbrows($q)>0) {
	echo '<ul class="icatlist">';
	while($r = dbarray($q)):
	echo '<li><a title="'.$r["icatBaslik"].'" href="'.LinkOlustur("icat", array("id"=>$r["icatID"], "sef"=>$r["icatSef"])).'"><span class="bspanad">'.neat_trim($r["icatBaslik"], 3).'</span><span class="bspanhit"><strong>'.$r["icatHit"].'</strong> hit</span></a></li>';
	endwhile;	
	echo '</ul>';
	}
?>


</div>
<div class="blokalt"></div>
</div>

</div>
<div class="cb"></div>