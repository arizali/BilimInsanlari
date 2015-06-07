<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# 
                  website: http://ogp.me/ns/website#">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php SayfaBaslik(); ?></title>
<meta name="description" content="<?php SayfaAciklama(); ?>" />
<?php SayfaFacebook(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>css/stil.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo SURL; ?>cc.css" />

<script type="text/javascript" src="<?php echo SURL; ?>javascripts/jquery.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>javascripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>javascripts/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>cc.js"></script>
<script src="<?php echo SURL; ?>javascripts/ckeditor/sample.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
$(function()
{
	var config = {
		skin:'v2',
		height:400,
		toolbar:
		[
			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
			[ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'],
			'/',
			[ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ]
			
		]
	};
	// Initialize the editor.
	// Callback function can be passed and executed after full instance creation.
	$('#hakkinda').ckeditor(config);
});
	//]]>
	</script>
<?php require_once GEREKLI."bilgilendirme.php"; ?>

</head>

<body id="test">
<div id="biwrapper">
<!---Head-->
<div id="header">
<a href="#" id="logo"><img src="<?php echo SURL; ?>images/logo.png" alt="Logo" /></a>
<div id="searcbox"><div class="ustlink"><a href="<?php echo SURL; ?>">Anasayfa</a><a href="#">Proje Hakkında</a><a href="#">Künye</a><a href="#">İletişim</a></div></div>
</div>
<!---Head-->

<!---Navige-->
<div id="navigasyon">
<ul>
<li class="sol"><a href="<?php echo SURL; ?>" title="Anasayfa">Anasayfa</a></li>
<li class="sol"><a href="<?php echo SURL; ?>bilim.php" title="Bilim Nedir?">Bilim</a></li>
<li class="sol"><a href="#">Bilim İnsanları</a></li>
<li class="sol"><a href="#">Bilim Dünyası</a></li>
<li class="sol"><a href="#">Teknoloji ve Tasarım</a></li>
<li class="sol"><a href="#">Buluş, İcat ve Keşifler</a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/delicious.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/stumble.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/technorati.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/vimeo.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/youtube.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/twitter.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/facebook.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/email.png" alt="vimeo" /></a></li>
<li class="sag"><a href="#"><img src="<?php echo SURL; ?>images/sosyal/feed.png" alt="vimeo" /></a></li>
</ul>
<div class="cb"></div>
</div>
<!---Navige-->

<div class="sitemain">
