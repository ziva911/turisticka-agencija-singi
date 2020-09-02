<!-- 
<div id='slider'>
	<div id='sliderBar' ></div>
	<a href="#" id='sliderLink' target='_blank'>
		<img src='images/destinations/slika1.jpg' id='sliderImg'/>  	
	</a>
</div> -->
<?php
switch ($modul){
	case '':
		include (modul_name_check('pocetna'));
	break;
	case 'popularno':
	case 'rezervacije':
	case 'kontakt':
	include ($modul_name);
	break;
	default:
	    include (modul_name_check('error404'));
	break;
}
$filtriraniHoteli = array();
?>