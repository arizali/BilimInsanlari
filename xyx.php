<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/stil.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<style type="text/css">
#yorum_gonder { margin:20px; width:630px; }
</style>
<script type="text/javascript" src="javascripts/jquery.js"></script>


</head>

<body>
<div id="yorum_gonder">
<form method="post" action="?">
<div class="w2 fl" id="get_h">
<div class="formwr">
<div>
<label>Adınız Soyadınız</label>
<input type="text" class="uzun300" />
</div>

<div>
<label>Mail Adresiniz</label>
<input type="text" class="uzun300" />
</div>

<div>
<label>Web Siteniz</label>
<input type="text" class="uzun300" />
</div>

</div>
</div>
<div class="w2 fr">
<div class="formwr"><div>
<label id="allmy">Yorumunuz</label>
<textarea id="metin_kutu" class="textall uzun300"></textarea>
</div></div>
</div>
<div class="cb"></div>
<div class="w1 mb">Yorumunuz onaylandıktan sonra sitede görüntülenecektir...</div>
<div class="w1">
<div class="formwr">
<div>
<input type="submit" id="buttonx" value="Yorum Yap" />
</div></div>
</div>
</form>

</div>
<div class="ayrac"></div>
<div class="w1" style="margin:20px;">

<div class="yorum_wrapper">

<div class="w1 db">
<div class="yorum_bilgi">
<img class="img_rz" src="resimler/biyografi/90/4f6dd9ee76732.jpg" alt="" />
<a href="#" class="y_isim">Alper ER</a>
<span class="y_tarih">11.09.2012 23:12 tarihinde</span>


</div>
</div>

<div class="w1">
<div class="yorum_mesaj"></div>
</div>
<div class="cb"></div>
</div>

</div>
<script type="text/javascript">
$(document).ready(function(){
var vh = $("#get_h").height() - 26 - $("#allmy").height();
$("#metin_kutu").height(vh);
$("#buttonx").width("100%");
});
</script>

</body>
</html>