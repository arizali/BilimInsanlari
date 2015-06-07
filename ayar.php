<?php
//if(eregi('^/community/',$path) == 1) { if (preg_match('#^/community/#i', $path)) {
//error_reporting(0);
if (preg_match("/ayar.php/i", $_SERVER['PHP_SELF'])) die("tek başına çalışmaz...");

// If register_globals is turned off, extract super globals (php 4.2.0+)
if (ini_get('register_globals') != 1) {
	if ((isset($_POST) == true) && (is_array($_POST) == true)) extract($_POST, EXTR_OVERWRITE);
	if ((isset($_GET) == true) && (is_array($_GET) == true)) extract($_GET, EXTR_OVERWRITE);
}

foreach ($_GET as $check_url) { 
if (!is_array($check_url)) { 
$check_url = str_replace("\"", "", $check_url); 
if ((preg_match("/<[^>]*script*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*object*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*iframe*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*applet*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*meta*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*style*\"?[^>]*>/i", $check_url)) || (preg_match("/<[^>]*form*\"?[^>]*>/i", $check_url)) || (preg_match("/\([^>]*\"?[^)]*\)/i", $check_url)) || (preg_match("/\"/i", $check_url))) { 
die (); 
} 
} 
}
unset($check_url);

/*AnaDizin*/
$seviye = ""; $i = 0;
while (!file_exists($seviye."dbayar.php")) { 
	$seviye .= "../"; $i++;
	if ($i == 10) { die("Ayar Dosyaniz Bulunamadi"); }
}
define("ANADIZIN", $seviye);
define("GEREKLI", ANADIZIN."includes/");
require_once ANADIZIN."dbayar.php";
require_once GEREKLI."mysql_include.php";

define("KP_SELF", basename($_SERVER['PHP_SELF']));
$link = dbconnect($dbhost, $dbkullanici, $dbsifre, $dbadi);

/*$qsistemsorgusu = dbquery("select * from ".PRFX."sistem where sistem_w='a'");
$sistem_secenekleri = dbarray($qsistemsorgusu);*/
$mysqlsorgusayisi=0;
// Sanitise $_SERVER globals
$_SERVER['PHP_SELF'] = cleanurl($_SERVER['PHP_SELF']);
$_SERVER['QUERY_STRING'] = isset($_SERVER['QUERY_STRING']) ? cleanurl($_SERVER['QUERY_STRING']) : "";
$_SERVER['REQUEST_URI'] = isset($_SERVER['REQUEST_URI']) ? cleanurl($_SERVER['REQUEST_URI']) : "";
$PHP_SELF = cleanurl($_SERVER['PHP_SELF']);
// Genel Sistem Tanýmlamalarý

require_once GEREKLI."sef_linkler.php";
require_once GEREKLI."cache_include.php";
require_once GEREKLI."depokey.php";
require_once GEREKLI."upload_include.php";
require_once GEREKLI."definitions.php";
require_once GEREKLI."theme_include.php";

define("KULLANICI", $_SERVER['REMOTE_ADDR']);
define("QUOTES_GPC", (ini_get('magic_quotes_gpc') ? TRUE : FALSE));

function redirect($location, $type="header") {
	if ($type == "header") {
		header("Location: ".$location);
	} else {
		echo "<script type='text/javascript'>document.location.href='".$location."'</script>\n";
	}
}
function utime (){
    $time = explode( " ", microtime());
    $usec = (double)$time[0];
    $sec = (double)$time[1];
    return $sec + $usec;
}

function cleanurl($url) {
	$bad_entities = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")");
	$safe_entities = array("&amp;", "", "", "", "", "", "", "", "");
	$url = str_replace($bad_entities, $safe_entities, $url);
	return $url;
}

// Strip Input Function, prevents HTML in unwanted places
function stripinput($text) {
	if (QUOTES_GPC) $text = stripslashes($text);
	$search = array("\"", "'", "\\", '\"', "\'", "<", ">", "&nbsp;");
	$replace = array("&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;", " ");
	$text = str_replace($search, $replace, $text);
	return $text;
}

// stripslash function, only stripslashes if magic_quotes_gpc is on
function stripslash($text) {
	if (QUOTES_GPC) $text = stripslashes($text);
	return $text;
}

// stripslash function, add correct number of slashes depending on quotes_gpc
function addslash($text) {
	if (!QUOTES_GPC) {
		$text = addslashes(addslashes($text));
	} else {
		$text = addslashes($text);
	}
	return $text;
}
function isNum($value) {
	return (preg_match("/^[0-9]+$/", $value));
}

function isEmail($email) { 
      return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
    }
function isAlnum($text) {
$aValid = array('-', '_');

if(!ctype_alnum(str_replace($aValid, '', $text))) {
return false;
} else {
return true;
}

}
function isValidUrl($url) {
if (!preg_match('|^\S+://\S+\.\S+.+$|i', $url)) {
return false;
} 
else {
return true;
}
}	
function trimlink($text, $length) {
	$dec = array("\"", "'", "\\", '\"', "\'", "<", ">");
	$enc = array("&quot;", "&#39;", "&#92;", "&quot;", "&#39;", "&lt;", "&gt;");
	$text = str_replace($enc, $dec, $text);
	if (strlen($text) > $length) $text = substr($text, 0, ($length-3))."...";
	$text = str_replace($dec, $enc, $text);
	return $text;
}


function createCookie($name, $value='', $maxage=0, $path='', $domain='', $secure=false, $HTTPOnly=false)
    {
        $ob = ini_get('output_buffering');

        // Abort the method if headers have already been sent, except when output buffering has been enabled
        if ( headers_sent() && (bool) $ob === false || strtolower($ob) == 'off' )
            return false;

        if ( !empty($domain) )
        {
            // Fix the domain to accept domains with and without 'www.'.
            if ( strtolower( substr($domain, 0, 4) ) == 'www.' ) $domain = substr($domain, 4);
            // Add the dot prefix to ensure compatibility with subdomains
            if ( substr($domain, 0, 1) != '.' ) $domain = '.'.$domain;

            // Remove port information.
            $port = strpos($domain, ':');

            if ( $port !== false ) $domain = substr($domain, 0, $port);
        }

        // Prevent "headers already sent" error with utf8 support (BOM)
        //if ( utf8_support ) header('Content-Type: text/html; charset=utf-8');

        header('Set-Cookie: '.rawurlencode($name).'='.rawurlencode($value)
                                    .(empty($domain) ? '' : '; Domain='.$domain)
                                    .(empty($maxage) ? '' : '; Max-Age='.$maxage)
                                    .(empty($path) ? '' : '; Path='.$path)
                                    .(!$secure ? '' : '; Secure')
                                    .(!$HTTPOnly ? '' : '; HttpOnly'), false);
        return true;
    } 
	
	
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}	


function neat_trim($string, $kelime=20) {
if(strlen(implode(' ',array_slice(explode(' ',$string),0,$kelime))) > 120) {
return implode(' ',array_slice(explode(' ',$string),0,($kelime - 5))); 
} else {
return implode(' ',array_slice(explode(' ',$string),0,$kelime)); 
}
}

function curPageURL($adres=false) {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  if(!$adres) $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  else $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/";
 } else {
  if(!$adres) $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  else $pageURL .= $_SERVER["SERVER_NAME"]."/";
 }
 return $pageURL;
}

$ogrenci_bilgi = array();

if(isset($_COOKIE["Bilim_Online"]) && $_COOKIE["Bilim_Online"]=="evet") {
	$uyead = stripinput($_COOKIE["u_lab_it"]);
	$sifre = strrev(stripinput($_COOKIE["u_lab_it_to_me"]));
	
	$q = dbquery("select * from uyeler where uyeAdi='$uyead' and uyeSifre = '$sifre'");
	if(dbrows($q)==1) { $uye_bilgi = dbarray($q); define("ODurum", true); } else {
	
	createCookie("Bilim_Online", " ",time()-3600);
	createCookie("u_lab_it", NULL, time()-3600);
	createCookie("u_lab_it_to_me", NULL, time()-3600);}
	} else {
	define("ODurum", false);	
	createCookie("Bilim_Online", " ",time()-3600);
	createCookie("u_lab_it", NULL, time()-3600);
	createCookie("u_lab_it_to_me", NULL, time()-3600);	}
ob_start();
$sayfa_start = utime();

$giris_hatasi = false;	
if(isset($_POST["site_giris"])) {
	$uyead = stripinput(strtolower($_POST["kullaniciadi"]));
	$sifre = stripinput($_POST["kullanicisifre"]);
	if(strlen($uyead)>4 && strlen($sifre)>3 ) {
	$sifre = md5(strtolower($sifre));	
	$q = dbquery("select * from uyeler where uyeAdi='$uyead' and uyeSifre = '$sifre'");
	if(dbrows($q)==1) {
	$uye_bilgi22 = dbarray($q);
	
	createCookie("Bilim_Online", "evet", time()+53600);
	createCookie("u_lab_it", $uye_bilgi22["uyeAdi"], time()+53600);
	createCookie("u_lab_it_to_me", strrev($uye_bilgi22["uyeSifre"]), time()+53600);
	redirect("bilgilendirme.php?durum=kullanici&hata=yok");
	exit();
	} else {
	redirect("bilgilendirme.php?durum=kullanici&hata=bulunamadi");
	exit();
	}	
	} else { 	
	redirect("bilgilendirme.php?durum=kullanici&hata=eksik");
	exit();}
}
$sayfa_ozellikleri = array();
?>