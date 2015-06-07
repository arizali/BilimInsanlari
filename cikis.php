<?php 
require_once "ayar.php"; 
createCookie("Bilim_Online", " ",time()-3600);
createCookie("u_lab_it", NULL, time()-3600);
createCookie("u_lab_it_to_me", NULL, time()-3600);	
redirect("index.php");
exit();
?>
