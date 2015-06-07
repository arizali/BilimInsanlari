<?php	
function SayfalaBunu($sayfa,$toplam, $link="",$g=13) {
$sabit = $g;	
$sayfahtml = '<div id="hs_pagination">';
if($sayfa==1) $sayfahtml .= '<span class="disabled_hs_pagination">Önceki</span>';
else $sayfahtml .=  '<a href="'.$link.($sayfa-1).'">Önceki</a>';
if($g>$toplam) $g = $toplam;
if($sayfa<=$sabit) {
for($i=1;$i<=$g;$i++) {
if($i!=$sayfa) $sayfahtml .=  '<a href="'.$link.($i).'">'.$i.'</a>';
else $sayfahtml .=  '<span class="active_hs_link">'.$i.'</span>';
}
}
if($sayfa>$sabit) {
$basla = $sayfa - 6;
$bitir = $sayfa + 6;
if($bitir>$toplam) $bitir=$toplam;
for($i=$basla;$i<=$bitir;$i++) {
if($i!=$sayfa) $sayfahtml .=  '<a href="'.$link.($i).'">'.$i.'</a>';
else $sayfahtml .=  '<span class="active_hs_link">'.$i.'</span>';
}
}

if($sayfa<$toplam) $sayfahtml .=  '<a href="'.$link.($sayfa+1).'">Sonraki</a>';
else $sayfahtml .=  '<span class="disabled_hs_pagination">Sonraki</span>';

return "</div>".$sayfahtml;
}
?>