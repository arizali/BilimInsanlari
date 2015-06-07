<?php 
//bilgilendirme
if(isset($_GET["durum"])) {
switch($_GET["durum"]) {
case "eklemebasarili":
$durum_bilgisi = "Biyografi ekleme işi başarı ile sonuçlandı...";
?>
<script type="text/javascript">
$(document).ready(function(){ 
$('body').append('<div id="bilgilendirme" style="position:absolute; text-align:center; font-weight:bolder; text-shadow:1px 1px 1px #0C6; background:green; color:white; font-size:19px; width:100%; height:60px; line-height:60px; left:0px; top:0px; z-index:10000;"><?=$durum_bilgisi;?></div>');
setTimeout(function(){ 
		$('#bilgilendirme').fadeOut(); 
		}, 2000); 
});
</script>
<?php
break;

}
}
?>