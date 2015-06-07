<?php 
require_once "ayar.php"; 
RenderHead(); 
?>
<div class="w1 fl">
<?php RenderManset(); ?>
<a href="http://www.webmasterturk.com" title="Webmaster"><img src="wmturk.png" alt="WebmasterTürk"/></a>

<div class="ayrac"></div>

<div class="genisbaslik"><h2 class="baslikbu">Son Eklenen Biyografiler</h2><a class="tumu" href="#">Tümünü Göster</a></div>
<div class="ayrac"></div>
<div class="w1y">
<div class="w1x">

<?php 
$q = dbquery("select * from biyografiler order by Eklenme desc limit 0,20"); 
if(dbrows($q)>0) {
	while($r = dbarray($q)):
	$ozellik=array();
	$ozellik["AdSoyad"] = $r["AdSoyad"];
	$ozellik["Resim"] = $r["Resim"];
	$ozellik["DTarih"] = $r["Dogum"];
	$ozellik["OTarih"] = $r["Olum"];
	$ozellik["Sehir"] = $r["Ulke"];
	$ozellik["Link"] = LinkOlustur("biyografi", array("sef"=>$r["AdSef"]));
	BiyoBox($ozellik);
	endwhile;	
	}
?>


</div>
</div>
<?php 
RenderSag();
RenderFoot(); 
?>