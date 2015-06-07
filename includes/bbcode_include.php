<?php 
function BBCode($text) {
	$URLSearchString = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
	$text = preg_replace('#\[p\](.*?)\[/p\]#si', '<p>\1</p>', $text);
	$text = preg_replace('#\[strong\](.*?)\[/strong\]#si', '<b>\1</b>', $text);	
	$text = preg_replace('#\[em\](.*?)\[/em\]#si', '<i>\1</i>', $text);
	$text = preg_replace('#\[del\](.*?)\[/del\]#si', '<u>\1</u>', $text);
	$text = preg_replace('#\[h1\](.*?)\[/h1\]#si', '<h1>\1</h1>', $text);
	$text = preg_replace('#\[h2\](.*?)\[/h2\]#si', '<h2>\1</h2>', $text);
	$text = preg_replace('#\[h3\](.*?)\[/h3\]#si', '<h3>\1</h3>', $text);
	$text = preg_replace('#\[h4\](.*?)\[/h4\]#si', '<h4>\1</h4>', $text);
	$text = preg_replace('#\[h5\](.*?)\[/h5\]#si', '<h5>\1</h5>', $text);
	$text = preg_replace('#\[h6\](.*?)\[/h6\]#si', '<h6>\1</h6>', $text);
	$text = preg_replace('#\[ul\](.*?)\[/ul\]#si', '<ul>\1</ul>', $text);
	$text = preg_replace('#\[ol\](.*?)\[/ol\]#si', '<ol>\1</ol>', $text);
	$text = preg_replace('#\[li\](.*?)\[/li\]#si', '<li>\1</li>', $text);
	
	$text = preg_replace('#\[url\]([\r\n]*)(http://|ftp://|https://|ftps://)([^\s\'\"]*?)([\r\n]*)\[/url\]#sie', "'<a href=\'\\2\\3\' target=\'_blank\' title=\'\\2\\3\'>'.trimlink('\\2\\3', 20).(strlen('\\2\\3')>30?substr('\\2\\3', strlen('\\2\\3')-10, strlen('\\2\\3')):'').'</a>'", $text);
	$text = preg_replace('#\[url\]([\r\n]*)([^\s\'\"]*?)([\r\n]*)\[/url\]#sie', "'<a href=\'http://\\2\' target=\'_blank\' title=\'\\2\'>'.trimlink('\\2', 20).(strlen('\\2')>30?substr('\\2', strlen('\\2')-10, strlen('\\2')):'').'</a>'", $text);
	$text = preg_replace('#\[mail\]([\r\n]*)([^\s\'\";:\+]*?)([\r\n]*)\[/mail\]#si', '<a href=\'mailto:\2\'>\2</a>', $text);
	$text = preg_replace('#\[mail=([\r\n]*)([^\s\'\";:\+]*?)\](.*?)([\r\n]*)\[/mail\]#si', '<a href=\'mailto:\2\'>\3</a>', $text);
	$text = preg_replace('#\[small\](.*?)\[/small\]#si', '<span class=\'small\'>\1</span>', $text);
	$text = preg_replace('#\[color=(black|blue|brown|cyan|gray|green|lime|maroon|navy|olive|orange|purple|red|silver|violet|white|yellow)\](.*?)\[/color\]#si', '<span style=\'color:\1\'>\2</span>', $text);
	$text = preg_replace("#\[img\]((http|ftp|https|ftps)://)(.*?)(\.(jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG))\[/img\]#sie","'<img src=\'\\1'.str_replace(array('.php','?','&','='),'','\\3').'\\4\' style=\'border:0px;margin:5px 0px; max-width:600px;\'>'",$text);
	$text = preg_replace("/\[facevideo\]([$URLSearchString]*)\[\/facevideo\]/", '<iframe style="background:none" width="600" height="430" frameborder="0" hspace="0" vspace="0" marginheight="0" scrolling="no" marginwidth="0" src="'.sURL.'fvideo.php?vx=$1"></iframe>', $text);
	$text = preg_replace('#\[daily\](.*?)\[/daily\]#si', '<embed src="http://www.dailymotion.com/swf/\1" type="application/x-shockwave-flash" width="600" height="423" allowFullScreen="true" allowScriptAccess="always"></embed>', $text);
	$text = preg_replace('#\[sevenload\](.*?)\[/sevenload\]#si', '<object type="application/x-shockwave-flash" data="http://tr.sevenload.com/pl/\1/600x408/swf" width="600" height="408"><param name="allowFullscreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="movie" value="http://tr.sevenload.com/pl/\1/600x408/swf" /></object>',$text);	
	$text = preg_replace('#\[uzman\](.*?)\[/uzman\]#si', '<param name="movie" value="http://www.uzmantv.com/getswf/\1" /><param name="WMode" value="Transparent"><param name="allowNetworking" value="all"/><param name="allowScriptAccess" value="always"/><embed src="http://www.uzmantv.com/getswf/\1" wmode="transparent" width="600" allowScriptAccess="always" allowNetworking="all" height=430" name="uzmanPlayer\1" type="application/x-shockwave-flash"/></object>', $text);
	$text = preg_replace('#\[timsah\](.*?)\[/timsah\]#si', '<object width="600" height="430"><param name="movie" value="http://www.timsah.com/getswf/v2/\1"/><param name="WMode" value="Transparent"/><param name="allowFullscreen" value="true"/><param name="scale" value="exactfit"/><param name="allowScriptAccess" value="always"/><embed src="http://www.timsah.com/getswf/v2/\1" wmode="transparent" allowfullscreen="true" scale="exactfit" allowscriptaccess="always" width="600" height="430" name="player" type="application/x-shockwave-flash"/></object>', $text);	
	$qcount = substr_count($text, "[alinti]"); $ccount = substr_count($text, "[code]");
	for ($i=0;$i < $qcount;$i++) $text = preg_replace('#\[alinti\](.*?)\[/alinti\]#si', '<div class=\'quote\'>\1</div>', $text);
	for ($i=0;$i < $ccount;$i++) $text = preg_replace('#\[code\](.*?)\[/code\]#si', '<div class=\'quote\' style=\'width:400px;white-space:nowrap;overflow:auto\'><code style=\'white-space:nowrap\'>\1<br><br><br></code></div>', $text);
	$text = videoBB($text);
	$text = descript($text,false);
	return nl2br($text);
} 

function br2br($metin) {
$metin = str_replace ('<br>', '<br />', $metin);
return $metin;
}

function videoBB($text){
$vcount = substr_count($text, "[video]");
	
for ($i=0;$i < $vcount; $i++) $text = preg_replace('#\[video\](.*?)\[/video\]#si', '<div class="ayrac"></div><iframe width="630" height="427" src="http://www.youtube.com/embed/\1?wmode=opaque" frameborder="0" allowfullscreen></iframe><div class="ayrac"></div>', $text);
return ($text);
}
?>