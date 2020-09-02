


<?php
 	$sadrzajRez = file_get_contents("./dbMock/reservations_table.json");
	 $sadrzajRez = "[".$sadrzajRez."]";
if($sadrzajRez == '[]') {
	echo "<div id='rezervacije'>";
	echo "<h2>Još uvek nema zabeleženih rezervacija pa ni popularnih hotela</h2></div>";
} else {
	echo '<div id="destinacije">
			<h2>Najpopularniji hoteli </h2>
			<div id="hoteliContainer">';
	$nizRezervacija = json_decode($sadrzajRez);
	//print_r($nizRezervacija);
	$asocNiz = array();

	foreach ($nizRezervacija as $hotel) {
		if(!isset($asocNiz[$hotel->hotel])){
			$asocNiz[$hotel->hotel] = intval($hotel->broj);
		} else { 
			$asocNiz[$hotel->hotel] += intval($hotel->broj);
		}
	}	
	arsort($asocNiz);

	$sadrzajHotel = file_get_contents("./dbMock/hotels_table.json");
	$nizHotela = json_decode($sadrzajHotel);
	$sadrzajHotel = '';
	$counter = 0;
	foreach ($asocNiz as $key => $value) {
		if($counter==3) break;
		$counter++;
		foreach($nizHotela as $hotel){
			if($key == $hotel->hotel_id){
				echo "<div class='jedanHotel'>";
				echo "<img class='slikaHotela' src='./content/images/".$hotel->hotel_img."'/> ";
				echo "<div  class='parDetalja'>
						<p>Naziv hotela: ".($hotel->hotel_ime)."</p>";
				echo "<p>Broj zvezdica: ".$hotel->broj_zvezdica."</p>";
				echo "<p>Destinacija: ".$hotel->hotel_destinacija."</p>";
				echo "<p>Cena noćenja: ".$hotel->dnevna_cena."</p>";
				echo "<p> Ukupan broj rezervacija u ovom hotelu: $value </p>";
				echo '<p class="rezButton">';
				echo "<a href='rezervacijaHotela.php?hotel_id=".$hotel->hotel_id."'>Rezervisite</a></p></div></div>";
			break;
			}
		}
		
	}
	echo '</div></div>';	
}
?>
