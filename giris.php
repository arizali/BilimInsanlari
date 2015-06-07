<?php require_once "ayar.php"; 
//if()
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bilim İnsanı &gt; Bilgilendirme</title>
<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>css/reset.css" />

<style type="text/css">
html { height:100%; overflow:hidden; }
body { background:#222; }
#ff a{ font-size:11px; text-decoration:none; color:#333; }
#ff a:hover{ font-size:11px; text-decoration:none; color:#111; }
#timer { font-size:10px; }
</style>
<link href='http://fonts.googleapis.com/css?family=Metamorphous&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="<?php echo SURL; ?>javascripts/jquery.js"></script>
<script type="text/javascript">
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", (($(window).height() - this.outerHeight()) / 2) + 
                                                $(window).scrollTop() + "px");
    this.css("left", (($(window).width() - this.outerWidth()) / 2) + 
                                                $(window).scrollLeft() + "px");
    return this;
}
</script>

<script language="javascript" type="text/javascript">
var count =10
var redirect="<?php echo SURL; ?>"

function countDown(){
 if (count <=0){
  window.location = redirect;
 }else{
  count--;
  document.getElementById("timer").innerHTML = count+" sn kaldı."
  setTimeout("countDown()", 1000)
 }
}
</script>
</head>

<body>

<div id="centerall" style="width:700px; margin:10px; padding:10px;">
<a href="<?php echo SURL; ?>" title="Bilim İnsanları"><img src="<?php echo SURL; ?>images/logo.png" alt="Bilim İnsanları" /></a>
<h1 style="font-size:24px; color:#066; font-family: 'Metamorphous', cursive;">Bilgilendirme.</h1>
<div style="margin:10px 0px; line-height:15px; font-family: 'Metamorphous', cursive;" id="ff">
<span>Üye girişiniz başarı ile gerçekleşti anasayfaya yönlendiriliyorsunuz.</span></div>
<span style="display:block; line-height:20px;">Bu sayfa 10sn içersinde sizi yönlendirecektir.</span>
<span id="timer"><script> countDown(); </script> </span>



</div>
</body>
</html>
