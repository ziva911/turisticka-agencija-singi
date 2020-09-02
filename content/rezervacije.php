<?php
	$lista = array('Hotel','Ime putnika', 'Prezime putnika', 'Datum', 'Dužina aranžmana', 'Broj mesta', 'Cena jednog aranžmana');
	$sadrzajRez = file_get_contents("./dbMock/reservations_table.json");
	$sadrzajRez = "[".$sadrzajRez."]";
	if($sadrzajRez == '[]') {
		echo "<div id='rezervacije'>";
		echo "<h2>Još uvek nema zabeleženih rezervacija</h2></div>";
	} else {
		$nizRezervacija = json_decode($sadrzajRez);
		$sadrzajRez = '';
		include("./config/classes.php");
		echo "<div id='rezervacije'>";
		echo "<h2>Sve rezervacije</h2>";
		echo "<table id='sveRez'>
				<thead class=''>
					<tr class=''>
						<th>".implode("</th><th>", $lista).'</th>
					</tr>
				</thead>
				<tbody class="">';
	
		$nizObj[]  = (object) array();
		foreach($nizRezervacija as  $value) {
			$instanca = objectMapping($value);
				echo '<tr class="">
						<td>'.$instanca->id.'</td>
						<td>'.$instanca->ime.'</td>
						<td>'.$instanca->prezime.'</td>
						<td>'.$instanca->datum.'</td>
						<td>'.$instanca->duzina.'</td>
						<td>'.$instanca->broj.'</td>
						<td>'.$instanca->cena.'</td>
					</tr>';
		}
	

	echo "
	</tbody>
	  </table>
	</div>";
	}
	function objectMapping($value) {
		return new Rezervacija($value->hotel , $value->ime, $value->prezime, $value->broj, $value->datum, $value->duzina, $value->cena);
	}
?>