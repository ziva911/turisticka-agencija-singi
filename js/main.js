var slider;

$(document).ready(function(){

	//loadRandomSlide();

	//loadZanrovi("sve");
	
	// loadLocations();
	
	
	
});

function loadRandomSlide(){
	$.ajax({
		url: "php/randomFilm.php",
		method: "GET",
		data: {
			//prazno
		},
		dataType: "JSON",
		success:function(film){
			$("#sliderBar").animate({
				"width": "100%",
				"opacity" : "1"
				}, 4000, function(){
					$("#sliderBar").animate({
					"width": "0%",
					"opacity" : "0.3"
					},700);
					$("#sliderImg").fadeOut(function(){
						$("#sliderImg").attr("src","slike/bioskop/"+film.slika).fadeIn();
						$("#sliderLink").attr("href", film.link);
						setTimeout(loadRandomSlide, 1000);
					});											
				});
		},
		error:function(){
			console.log("Greska u komunikaciji ili nije stigao JSON.");
		}
	});
}

function getHotels() {
	document.getElementById("getHotelsForm").submit();
}
function loadZanrovi(tipZanra){
	/*
		<div class='jedanModel'>
		<a hrml='model.html'>
			<img class='slikaModela' src='slika.png'/>
			<p class='parDetalja'> </p><br/>
			<p class='parOpisa'> </p>						
		</a>
	</div>
	*/
	$.ajax({
		url : "php/filmoviPoZanru.php",
		method: "GET",
		data: {
			"zanr":tipZanra
		},
		dataType: "JSON",
		success: function (objects){
		console.log(objects);
		$("#divZaModele").html("");
		for(var i=0; i<objects.length; i++){
			var str = "<div class='jedanModel'>";
				//str += "<a hrml='#'>"
				str += "<img class='slikaModela' src='slike/bioskop/wallpapers/"+objects[i].Img1+"' data-alt='slike/bioskop/wallpapers/"+objects[i].Img2+"' /> ";
				str += "<p class='parDetalja'>Naziv: "+(objects[i].NazivFilma)+" <br/>Godina: "+objects[i].God+"<br/>Zanr: "+objects[i].Zanr+"<br/>Reditelj: "+objects[i].Reziser+"<br/>";
				str += "Trajanje: "+(objects[i].Trajanje)+" <br/>Uloge: "+objects[i].GlavneUloge+"<br/><br/><u><a href='rezervacijaFilma.php?SifraFilma="+objects[i].SifraFilma+"'> Rezervisite</a><u/> </button></p><br/>";
				//str += "Trajanje: "+(objects[i].Trajanje)+" <br/>Uloge: "+objects[i].GlavneUloge+"<br/><u><a href='rezervacijaFilma.php?SifraFilma="+objects[i].SifraFilma+"'> Rezervisite</a><u/> </button></p><br/>";
				str += "<details class='parOpisa'> <summary> Procitajte detaljnije: </summary><p>"+objects[i].Informacije+"</p></details>	 </div>";
				$("#divZaModele").append(str);
			}
		},
		error:function(){
			console.log("Greska!");
		}
	});
}

$(document).on("mouseenter",".slikaModela",function () {
        var elem = this;
		var pom = $(elem).attr("src");
		$(elem).attr("src", $(elem).attr("data-alt"));
		$(elem).attr("data-alt", pom);
    });
 $(document).on("mouseleave",".slikaModela",function () {
        var elem = this;
		var pom = $(elem).attr("src");
		$(elem).attr("src", $(elem).attr("data-alt"));
		$(elem).attr("data-alt", pom);
    });
	
	
	
function loadLocations(){

	$.ajax({
		url : "json/bioskop/lokacije.json",
		success: function (objects){
		console.log(objects);
		$("#divZaSalone").html("");
		for(var i=0; i<objects.length; i++){
			var str = "<div class='jedanSalon'>";
				str += "<a html='#'>"
				str += "<img class='slikaSalona' src='slike/bioskop/lokacije/"+objects[i].img1+"' data-alt='slike/bioskop/lokacije/"+objects[i].img2+"' /> ";
				str += "<p class='parDetaljaSalon'>Mesto: "+(objects[i].Mesto)+" <br/>Adresa: "+objects[i].Adresa+"<br/>Kontakt: "+objects[i].Kontakt+"<br/>Mail: "+objects[i].Mail+"<br/>Radno vreme: "+objects[i].RadnoVreme+"</p><br/>";
				$("#divZaSalone").append(str);
			}
		},
		error:function(){
			console.log("Greska!");
		}
	});
}	


$(document).on("change","#selZanr",function(){ 
	console.log($(this).val());
	loadZanrovi($(this).val());
});



