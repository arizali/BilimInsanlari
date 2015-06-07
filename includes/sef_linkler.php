<?php
function dost_Linkler($url)
{	
   $url = trim($url);
   $url = tr2utf($url);
   $url = strtolower($url);

   $find = array('<b>', '</b>');
   $url = str_replace ($find, '', $url);

   $url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);

   $find = array('&#305;','&#304;');
   $url = str_replace($find, 'i', $url);
   
   $find =array('&#350;','&#351;');
	$url = str_replace ($find, 's', $url);
   $find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
   $url = str_replace ($find, '-', $url);

   $find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
   $url = str_replace ($find, 'e', $url);

   $find = array('í', 'i', 'ì', 'î', 'ï', 'ı', 'I', 'I', 'Í', 'Ì', 'Î', 'Ï', 'İ');
   $url = str_replace ($find, 'i', $url);

   $find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
   $url = str_replace ($find, 'o', $url);

   $find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
   $url = str_replace ($find, 'a', $url);

   $find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
   $url = str_replace ($find, 'u', $url);

   $find = array('ç', 'Ç');
   $url = str_replace ($find, 'c', $url);

   $find = array('s', 'ş', 'S', 'Ş');
   $url = str_replace ($find, 's', $url);

   $find = array('g', 'ğ', 'G', 'Ğ');
   $url = str_replace ($find, 'g', $url);

   $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

   $repl = array('', '-', '');

   $url = preg_replace ($find, $repl, $url);
   $url = str_replace ('--', '-', $url);

   return $url;
}
function tr2utf($url) {
	$ara = array("'","ç","Ç", "ö","Ö","ı","İ","ş","Ş","ü","Ü","ğ","Ğ");
	$degis = array("-","c", "C", "o", "O", "i", "I", "s", "S", "u", "U","g","G");
	$url = str_replace($ara, $degis, $url);
	return $url;
}
?>