<?php
	$sadrzajHotel = file_get_contents("./dbMock/hotels_table.json");
	$nizHotela = json_decode($sadrzajHotel);
    $sadrzajHotel = '';
	
	$filtriraniHoteli = array();
if(isset($_GET['destination'])){
	
	$destination = $_GET['destination'];

	$sadrzajDesto = file_get_contents("./dbMock/destinations_table.json");
    $nizDesto = json_decode($sadrzajDesto);
    $sadrzajDesto = '';
	$destinacija = null;
    foreach ($nizDesto as $desto){
        if($destination == $desto->destinacija_code) {
            $destinacija = $desto;
            break;
        }
    }
	// print_r($nizHotela[0]);
		foreach ($nizHotela as $hotel){
    		if($destinacija->destinacija == $hotel->hotel_destinacija){
				array_push($filtriraniHoteli, $hotel);
			}
		}

	} else {
		$filtriraniHoteli = $nizHotela;
	}
?>

<div id='destinacije'>
	<h2>Destinacije u ponudi</h2>
	<h5>(Odaberite željenu destinaciju)</h5>
	<form id="getHotelsForm" action="" method="get">
	<select name="destination" id="destinacijeSelect" onchange="getHotels()">
		<option value="not-selected" disabled selected> Odaberite destinaciju </option>
		<option value="grcka"> Grčka </option>
		<option value="turska"> Turska </option>
		<option value="egipat"> Egipat </option>
		<option value="crna-gora"> Crna Gora </option>
		<option value="spanija"> Španija </option>
		<option value="italija"> Italija </option>
	</select>
	</form>
	<div id='hoteliContainer'>
<?php
	foreach ($filtriraniHoteli as $hotel) {
									
			echo "<div class='jedanHotel'>";
			echo "<img class='slikaHotela' src='./content/images/".$hotel->hotel_img."'/> ";
			echo "<div  class='parDetalja'>
					<p>Naziv hotela: ".($hotel->hotel_ime)."</p>
					<p>Broj zvezdica: ".$hotel->broj_zvezdica."</p>";
			echo "<p>Destinacija: ".$hotel->hotel_destinacija."</p>";
			echo "<p>Cena noćenja: ".$hotel->dnevna_cena."</p>";
			echo '<p class="rezButton">';
			echo "<a href='rezervacijaHotela.php?hotel_id=".$hotel->hotel_id."'>Rezervišite</a></p></div>";
			echo "<details class='details'>".'<summary class="detailsButton"> Za više detealja: </summary><p>'.$hotel->hotel_info.'</p></details>	 </div>';
	} 
?>		
    </div>
</div>
