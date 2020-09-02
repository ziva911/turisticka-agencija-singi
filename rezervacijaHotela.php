<html>
	<head>
		<script src='js/jquery-3.4.1.min.js'></script>
		<script src="./js/main.js"></script>
		<link href="./css/style.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
		<div id='big-wrapper'>
<?php
include("templates/header.php");
include("templates/navigation.php");

if( isset($_POST['hotel_id']) && 
    isset($_POST['ime-putnika']) && 
    isset($_POST['prezime-putnika']) && 
    isset($_POST['broj-mesta']) && 
    isset($_POST['datum']) &&
    isset($_POST['duzina-trajanja']) ) {

    include("./config/classes.php");

	$hotel_id = $_POST['hotel_id'];
	$ime = $_POST['ime-putnika'];
	$prezime = $_POST['prezime-putnika'];
	$broj = $_POST['broj-mesta'];
	$datum = $_POST['datum'];
    $duzina = $_POST['duzina-trajanja'];
    
    $sadrzajHotel = file_get_contents("./dbMock/hotels_table.json");
    $nizHotela = json_decode($sadrzajHotel);
    $sadrzajHotel = '';
    foreach ($nizHotela as $hotel){
        if($hotel_id == $hotel->hotel_id) {
            $trazeni_hotel = $hotel;
            break;
        }
    }

    $sadrzajDesto = file_get_contents("./dbMock/destinations_table.json");
    $nizDesto = json_decode($sadrzajDesto);
    $sadrzajDesto = '';
    $destinacija = null;

    foreach ($nizDesto as $desto){
        if($trazeni_hotel->hotel_destinacija == $desto->destinacija) {
            $destinacija = $desto;
            break;
        }
    }
    
    $cena = $destinacija->cena_putovanja + $duzina * $trazeni_hotel->dnevna_cena;
    $rez = new Rezervacija($hotel_id, $ime, $prezime, $broj, $datum, $duzina, $cena);
    $txt = $rez->ispis();
    if(file_get_contents("./dbMock/reservations_table.json") != '') $txt = ",\n".$txt;

	file_put_contents("./dbMock/reservations_table.json", $txt , FILE_APPEND | LOCK_EX);
	
    echo "<div id='rezervacije'>";
    echo "<h2>Uspešno Obavljena Rezervacija</h2><div id='reservacijaRacun'>";
echo "<div class='formElem'>
        <label class='formLabel'>Sifra Hotela:</label>
        <label class='formValue'>$hotel_id</label>
    </div>";
    echo "<div class='formElem'>
    <label class='formLabel'>Ime putnika: </label>
    <label class='formValue'>$ime</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Prezime putnika: </label>
<label class='formValue'>$prezime</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Broj Mesta: </label>
<label class='formValue'>$broj</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Datum: </label>
<label class='formValue'>$datum</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Dužina trajanja(u danima): </label>
<label class='formValue'>$duzina</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Cena jednog aranžmana: </label>
<label class='formValue'>$cena rsd</label>
</div>";
echo "<div class='formElem'>
<label class='formLabel'>Ukupno za platiti:</label>
<label class='formValue'>",$cena * $broj," rsd</label>
</div>";
/*	echo "<p> Sifra Hotela: $hotel_id<br/>
			Ime putnika: $ime<br/>
			Prezime putnika: $prezime<br/>
			Broj Mesta: $broj<br/>
			Datum: $datum<br/>
			Dužina trajanja: $broj<br/>
			Cena jednog aranžmana: $cena<br/>
            Ukupno za platiti:",$cena * $broj,"<br/></p>";*/
    echo '<button onclick="location.href = '."'./index.php'".'">U redu</button></div></div>';
} else {

    if(isset($_GET['hotel_id'])) {
  	    $sadrzajHotel = file_get_contents("./dbMock/hotels_table.json");
        $nizHotela = json_decode($sadrzajHotel);
        $sadrzajHotel = '';
        $hotel_id = $_GET['hotel_id'];
        foreach ($nizHotela as $hotel) {
            if($hotel_id == $hotel->hotel_id) {
                $trazeni_hotel = $hotel;
                break;
            }
        }
        $destinacija = null;
        $sadrzajDesto = file_get_contents("./dbMock/destinations_table.json");
        $nizDesto = json_decode($sadrzajDesto);
        $sadrzajDesto = '';
        foreach ($nizDesto as $desto) {
            if($trazeni_hotel->hotel_destinacija == $desto->destinacija) {
                $destinacija = $desto;
                break;
            }
        }
?>
	
	<form id="rezForm" action="" method="post">
    <h1> Podaci za rezervaciju: </h1>
        <h3>Vaši podaci:</h3>
        <div class="formElem">
            <label class="formLabel">Ime:</label>
            <input type='text' name='ime-putnika' required></input>
        </div>
        <div class="formElem">
            <label class="formLabel">Prezime:</label>
            <input type='text' name='prezime-putnika' required></input>
        </div>
        <h3>Podaci o hotelu:</h3>
        <div class="formElem">
            <label class="formLabel">Ime hotela:</label>
            <label class="formValue"><?php echo $trazeni_hotel->hotel_ime;?></label>
        </div>
            <input type='text' name='hotel_id' value='<?php echo $trazeni_hotel->hotel_id;?>' hidden> </input><br>
        <div class="formElem">
            <label class="formLabel">Destinacija:</label>
            <label class="formValue"><?php echo $trazeni_hotel->hotel_destinacija;?></label>
        </div>
        <div class="formElem">
            <label class="formLabel">Broj zvezdica:</label>
            <label class="formValue"><?php echo $trazeni_hotel->broj_zvezdica;?></label>
        </div>
        <div class="formElem">
            <label class="formLabel">Cena jednog noćenja:</label>
            <label class="formValue"><?php echo $trazeni_hotel->dnevna_cena.' rsd';?></label>            
        </div>
        <div class="formElem">
            <label class="formLabel">Cena avionske karte:</label>
            <label class="formValue"><?php echo $destinacija->cena_putovanja.' rsd';?></label>            
        </div>
        <div class="formElem">
            <label class="formLabel">Željeni broj mesta:</label>
		    <select name='broj-mesta'>
            <?php
            for ($i=1; $i <= 20; $i++) {
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
            </select>
        </div>
        <div class="formElem">
            <label class="formLabel">Željeni datum rezervacije:</label>
            <input type='date' name='datum' required></input>
        </div>
        <div class="formElem">
            <label>Dužina u danima:</label>
		    <select name='duzina-trajanja'>
            <?php
            for ($i=1; $i <= 14; $i++) {
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
            ?>
            </select>
        </div>
        
		<button> Potvrdi rezervaciju </button>
	</form>
<?php 
} else {
        header("Location: ./templates/error404.php");
    }
}

include("templates/footer.php");
?>

    </div>
    </body>
</html>