<div id="mansethaber">
<!---Ust Manşet-->
<div class="ustlinkaa">
<ul class="usts">
<li><a id="bd_m" href="javascript:void(0);" onClick="GosterX('BD');" class="aktifs">Bilim Dünyasından Haberler</a></li>
<li><a id="b_m" href="javascript:void(0);" onClick="GosterX('B');">İcat, Buluş ve Keşifler</a></li>
<li><a id="tg_m"  href="javascript:void(0);" onClick="GosterX('TG');">Teknolojik Gelişmeler</a></li>
</ul>
<div style="clear:left;"></div>

</div>

<!---Ust Manşet-->
<?php 
$list_html_xx = "";
$list_html_gx = "";
$qx = dbquery("select * from haberler where haberKategori='diger' order by haberZaman desc limit 0,10"); 
while($sonx = dbarray($qx)):
$list_html_xx .= '<li><a title="'.$sonx["haberBaslik"].'" href="'.LinkOlustur("haber", array("tur"=>"diger","id"=>$sonx["haberID"], "sef"=>$sonx["haberSef"])).'" onmouseover="MansetGoster('.$sonx["haberID"].',\'tg\');" id="linkgid_'.$sonx["haberID"].'">'.$sonx["haberBaslik"].'</a></li>';
$list_html_gx .= '
<div class="gosterim" id="gid_'.$sonx["haberID"].'" style="display:none;">
<img src="resimler/haber/310/'.$sonx["haberResim"].'" class="airesim" alt="'.$sonx["haberBaslik"].'" />
<div class="descv"><a title="'.$sonx["haberBaslik"].'" href="'.LinkOlustur("haber", array("tur"=>"diger","id"=>$sonx["haberID"], "sef"=>$sonx["haberSef"])).'">
<span class="h2b">'.$sonx["haberBaslik"].'</span>
<span class="h2c">'.$sonx["haberKisabilgi"].'</span>
</a></div></div>';
endwhile; 

$list_html_xy = "";
$list_html_gy = "";
$qy = dbquery("select * from icatlar order by icatZaman desc limit 0,10"); 
while($sony = dbarray($qy)):
$list_html_xy .= '<li><a title="'.$sony["icatBaslik"].'" href="'.LinkOlustur("icat", array("id"=>$sony["icatID"], "sef"=>$sony["icatSef"])).'" onmouseover="MansetGosterI('.$sony["icatID"].',\'b\');" id="linkgidi_'.$sony["icatID"].'">'.$sony["icatBaslik"].'</a></li>';
$list_html_gy .= '
<div class="gosterim" id="gidi_'.$sony["icatID"].'" style="display:none;">
<img src="resimler/icat/310/'.$sony["icatResim"].'" class="airesim" alt="'.$sony["icatBaslik"].'" />
<div class="descv"><a title="'.$sony["icatBaslik"].'" href="'.LinkOlustur("icat", array("id"=>$sony["icatID"], "sef"=>$sony["icatSef"])).'">
<span class="h2b">'.$sony["icatBaslik"].'</span>
<span class="h2c">'.$sony["icatKisabilgi"].'</span>
</a></div></div>';
endwhile; 
 
$list_html_x = "";
$list_html_g = "";
$q = dbquery("select * from haberler where haberKategori='bd' order by haberZaman desc limit 0,10"); 
while($son = dbarray($q)):
$list_html_x .= '<li><a title="'.$son["haberBaslik"].'" href="'.LinkOlustur("haber", array("tur"=>"bd","id"=>$son["haberID"], "sef"=>$son["haberSef"])).'" onmouseover="MansetGoster('.$son["haberID"].',\'bd\');" id="linkgid_'.$son["haberID"].'">'.$son["haberBaslik"].'</a></li>';
$list_html_g .= '
<div class="gosterim" id="gid_'.$son["haberID"].'" style="display:none;">
<img src="resimler/haber/310/'.$son["haberResim"].'" class="airesim" alt="'.$son["haberBaslik"].'" />
<div class="descv"><a title="'.$son["haberBaslik"].'" href="'.LinkOlustur("haber", array("tur"=>"bd","id"=>$son["haberID"], "sef"=>$son["haberSef"])).'">
<span class="h2b">'.$son["haberBaslik"].'</span>
<span class="h2c">'.$son["haberKisabilgi"].'</span>
</a></div></div>';
endwhile; 
?>

<!---Alt Manşet-->
<div class="alticerik" id="haber_bd">

<div class="w2 fl">
<?=$list_html_g;?>
</div>

<div class="w2 fr">
<div class="gosterim_link">
<ul class="alts"><?=$list_html_x;?>
</ul>
</div>
</div>
<div class="cb"></div>
</div>

<div class="alticerik" id="haber_tg" style="display:none;">

<div class="w2 fl">
<?=$list_html_gx; ?>
</div>
<div class="w2 fr">
<div class="gosterim_link"><ul class="alts"><?=$list_html_xx;?></ul></div>
</div>

<div class="cb"></div>
</div>



<div class="alticerik" id="haber_b" style="display:none;">

<div class="w2 fl">
<?=$list_html_gy; ?>
</div>

<div class="w2 fr">
<div class="gosterim_link">
<ul class="alts"><?=$list_html_xy;?>
</ul>
</div>

</div>
<div class="cb"></div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#haber_bd .gosterim").first().show();
	$("#haber_bd .gosterim_link .alts li a").first().addClass("suanki");	
});
function GosterX(tur) {
if(tur==="BD") {
$(".ustlinkaa .usts li a").each(function(){
$(this).removeClass("aktifs");
});	
$("#haber_b, #haber_tg").hide();
$("#haber_bd").show();
$("#bd_m").addClass("aktifs");

	$("#haber_bd .gosterim").first().show();
	$("#haber_bd .gosterim_link .alts li a").first().addClass("suanki");	
} else if(tur==="TG") {
$(".ustlinkaa .usts li a").each(function(){
$(this).removeClass("aktifs");
});	
$("#tg_m").addClass("aktifs");
	
$("#haber_b, #haber_bd").hide();
$("#haber_tg").show();
	$("#haber_tg .gosterim").first().show();
	$("#haber_tg .gosterim_link .alts li a").first().addClass("suanki");	
} else if(tur==="B") {
$(".ustlinkaa .usts li a").each(function(){
$(this).removeClass("aktifs");
});	
$("#b_m").addClass("aktifs");
$("#haber_tg, #haber_bd").hide();
$("#haber_b").show();
	$("#haber_b .gosterim").first().show();
	$("#haber_b .gosterim_link .alts li a").first().addClass("suanki");	
} else { return false; }
}
function MansetGoster(id, wr) {
$("#haber_"+wr+" .gosterim").each(function(){
$(this).hide();
$('#gid_' + id).show();
});
$("#haber_"+wr+" .gosterim_link .alts li a").each(function(){
$(this).removeClass("suanki");
$('#linkgid_' + id).addClass("suanki");
});
	
}
function MansetGosterI(id, wr) {
$("#haber_"+wr+" .gosterim").each(function(){
$(this).hide();
$('#gidi_' + id).show();
});
$("#haber_"+wr+" .gosterim_link .alts li a").each(function(){
$(this).removeClass("suanki");
$('#linkgidi_' + id).addClass("suanki");
});
	
}
</script>
<div class="ayrac"></div>
<div class="ayrac"></div>