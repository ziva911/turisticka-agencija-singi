<?php
class Rezervacija{
	private $id;	
	private $ime;
	private $prezime;
	private $broj;
	private $datum;
	private $duzina;
	private $cena;
	
	public function __construct($id, $ime, $prezime, $broj, $datum, $duzina, $cena){
		$this->id = $id;
		$this->ime = $ime;
		$this->prezime = $prezime;
		$this->broj = $broj;
		$this->datum = $datum;
		$this->duzina = $duzina;
		$this->cena = $cena;
	}

	public function __get($smthng){
		return $this->$smthng;
	}
	public function __set($smthng, $value){
		$this->$smthng = $value;
	}

	public function __toString(){
		return "Hotel: ".$this->id.", Ime putnika: ".$this->ime.", Prezime putnika: ".$this->prezime.", Broj Mesta: ".$this->broj.", Datum: ".$this->datum.", Dužina trajanja: ".$this->duzina.", Cena aranzmana: ".$this->cena."</hr>";
	}

	public function ispis(){
        return '{"hotel":"'.$this->id.'","ime":"'.$this->ime.'","prezime":"'.$this->prezime.'","broj":"'.$this->broj.'","datum":"'.$this->datum.'","duzina":"'.$this->duzina.'","cena":"'.$this->cena.'"}';
	}

}
?>