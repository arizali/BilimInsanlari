<?php 
function LinkOlustur($tur="biyografi", $veriler=array()) {
switch($tur) {
case "biyografi":
$link = SURL."biyografi/".$veriler["sef"].".html";
break;

case "haber":
if($veriler["tur"]=="tt") {
$link = SURL."teknolojivetasarim/".$veriler["id"]."/".$veriler["sef"].".html";
} else if($veriler["tur"]=="bd") {
$link = SURL."bilimdunyasi/".$veriler["id"]."/".$veriler["sef"].".html";
} else {
$link = SURL."haber/".$veriler["id"]."/".$veriler["sef"].".html";
}
break;

case "icat":
$link = SURL."icat/".$veriler["id"]."/".$veriler["sef"].".html";
break;
}	
return $link;
}
function ResimYukle($dosya, $klasor="biyografi") {
	$isimm = uniqid();
	$resim = array();
    $handle2 = new Upload($dosya);		
    if ($handle2->uploaded) {
	$handle2->allowed = array( 'image/*');	
	$handle2->file_new_name_body = $isimm;
    $handle2->Process(ANADIZIN."resimler/$klasor/orj/");
    if ($handle2->processed) { 
	$durum = $handle2->file_dst_name;
	
   
   	$handle2->file_new_name_body = $isimm;
	$handle2->image_resize          = true;
	$handle2->image_x               = 310;
    $handle2->image_ratio_y         = true;
	$handle2->Process(ANADIZIN."resimler/$klasor/310b/");
	if ($handle2->processed) {}   
	 
   	$handle2->file_new_name_body = $isimm;
	$handle2->image_resize          = true;
	$handle2->image_ratio_crop      = 'C';
	$handle2->image_x               = 310;
	$handle2->image_y               = 200;
	$handle2->Process(ANADIZIN."resimler/$klasor/310/");
	if ($handle2->processed) {} 
		
	
	$handle2->file_new_name_body = $isimm;
	$handle2->image_resize          = true;
	$handle2->image_ratio_crop      = 'C';
	$handle2->image_x               = 90;
	$handle2->image_y               = 60;
	$handle2->Process(ANADIZIN."resimler/$klasor/90/");
	if ($handle2->processed) {} 
	
	$handle2->file_new_name_body = $isimm;
	$handle2->image_resize          = true;
	$handle2->image_ratio_crop      = 'C';
	$handle2->image_x               = 32;
	$handle2->image_y               = 32;
	$handle2->Process(ANADIZIN."resimler/$klasor/32/");
	if ($handle2->processed) {} 
	
	} else {$durum = "ana";}
	
	

	$handle2-> Clean();
	} else { 
	$durum = "sistem"; 
	}
	
	if(!in_array($durum, array("sistem","ana"))) {
	$resim["resim"] = $durum;
	$resim["hata"] = "yok";
	} else {
	$resim["resim"] = "resimyok.png";
	$resim["hata"] = $durum;
	} 

	return $resim;
}
$ulkeler_listesi = array("ABD", "Afganistan", "Almanya", "Andorra", "Angola", "Antarktika", "Antigua ve Barbuda", "Arjantin", "Arnavutluk", "Avustralya", "Avusturya", "Azerbaycan", "Bahama Adaları", "Bahreyn", "Bangladeş", "Barbados", "Batı Samoa", "Belçika", "Belize", "Benin", "Bermuda", "Beyaz Rusya", "Bhutan", "Birleşik Arap Emirlikleri", "Bolivya", "Bosna Hersek", "Botswana", "Brezilya", "Brunei", "Bulgaristan", "Burkina Faso", "Burundi", "Cape Verde", "Cezayir", "Cibuti", "Çad", "Çek Cumhuriyeti", "Çin", "Danimarka", "Dominik Cumhuriyeti", "Dominika", "Ekvador", "Ekvator Ginesi", "El Salvador", "Eritre", "Ermenistan", "Estonya", "Etiyopya", "Falkland Adaları", "Faroe Adaları", "Fas", "Fiji", "Fildişi Kıyısı", "Filipinler", "Finlandiya", "Fransa", "Gabon", "Gambiya", "Gana", "Gine", "Gine-Bissau", "Grenada", "Grönland", "Guatemala", "Guyana", "Güney Afrika", "Güney Kıbrıs", "Gürcistan", "Haiti", "Hırvatistan", "Hindistan", "Hollanda", "Honduras", "Irak", "İndonezya", "İngiltere", "İran", "İrlanda", "İskoçya", "İspanya", "İsrail", "İsveç", "İsviçre", "İtalya", "İzlanda", "Jamaika", "Japonya", "Kamboçya", "Kamerun", "Kanada", "Katar", "Kazakistan", "Kenya", "Kırgızistan", "Kiribati", "Kolombiya", "Komorlar", "Kongo", "Kongo Demokratik Cumhuriyeti", "Kore Güney", "Kore Kuzey", "Kosta Rika", "Kuveyt", "Kuzey Kıbrıs TC", "Küba", "Laos", "Lesotho", "Letonya", "Liberya", "Libya", "Liechtenstein", "Litvanya", "Lübnan", "Lüksemburg", "Macaristan", "Madagaskar", "Makao", "Makedonya", "Malavi", "Maldiv Adaları", "Malezya", "Mali", "Malta", "Mauritius", "Meksika", "Mısır", "Mo&eth;olistan", "Moldavya", "Monako", "Moritanya", "Mozambik", "Mıanmar", "Namibia", "Nauru", "Nepal", "Nijer", "Nijerya", "Nikaragua", "Norfolk Adası", "Norveç", "Orta Afrika Cumhuriyeti", "Özbekistan", "Pakistan", "Palau Adaları", "Panama", "Papua-Yeni Gine", "Paraguay", "Peru", "Polonya", "Portekiz", "Puerto Rico", "Romanya", "Ruanda", "Rusya Federasyonu", "San Marino", "Santa Kitts ve Nevis", "Santa Lucia", "Santa Vincent ve Grenadines", "Sao Tome", "Senegal", "Seyşeller", "Sierra Leone", "Singapur", "Slovakya", "Slovenya", "Solomon Adalary", "Somali", "Sri Lanka", "Sudan", "Surinam", "Suriye", "Suudi Arabistan", "Svaziland", "Şili", "Tacikistan", "Tanzanya", "Tayland", "Tayvan", "Togo", "Tonga", "Trinidad ve Tobago", "Tunus", "Türkiye", "Türkmenistan", "Uganda", "Ukrayna", "Umman", "Uruguay", "Ürdün", "Vanuatu", "Vatikan", "Venezuela", "Vietnam", "Yemen", "Yeni Kaledonya", "Yeni Zelanda", "Yugoslavya", "Yunanistan", "Zambiya", "Zimbabve", "Diğer");

$array_yeni_bilimler = array();
$bilimler_listesi = array("Matematik Bilimleri", "Fiziki bilimler", "Kimya bilimleri", "Çevre bilimleri","Biyoloji bilimleri","Tıp Bilimleri","Tarım","Ormancılık","Balıkçılık","Veterinerlik","Psikoloji","Ekonomi","Eğitim bilimleri", "Coğrafya", "Hukuk","Diğer Sosyal Bilimler","Tarih","Felsefe","Müzik","Sanat","Diğer Beşeri Bilimler");
foreach($bilimler_listesi as $bilimlerz) {
$array_yeni_bilimler[] = array("key"=>$bilimlerz, "value"=>$bilimlerz);
}

//echo json_encode($array_yeni_bilimler);
$tum_yazarlar_liste = array();
$tum_yazarlar_liste_n = array();
$mucitler = dbquery("select ID, AdSoyad, AdSef from biyografiler order by AdSef asc");
while($oku = dbarray($mucitler)):
$tum_yazarlar_liste_n[] = $oku["ID"];
$tum_yazarlar_liste[] = array("Ad"=>$oku["AdSoyad"],"Sef"=>$oku["AdSef"],"ID"=>$oku["ID"]);
endwhile;
?>