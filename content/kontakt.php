<h2 id="kontakt-title"> Kontaktirajte nas </h2>
<div id="kontakt">
<div class="info">
    <h3>Mi se nalazimo u Beogradu.</h3>
    <div>
        <h4>Agencija - centrala</h4>
        <p>Nepostojeće ulice 23</p>
        <p>11000 Beograd, Srbija</p>
        <p>Telefon 011 123 4567</p>
        <p>email: <a href="mailto:toza911@gmail.com"><span>fakeMail@agency.com</span></a></p>
    </div>    
</div>
<div class="info">
<form id="contactForm" action="" method="post">
        <h3>Vaši podaci:</h3>
        <div class="formElem">
            <label class="formLabel">Ime:</label>
            <input type='text'  name="name" id="name" required></input>
        </div>
        <div class="formElem">
            <label class="formLabel">Prezime:</label>
            <input type='text'  name="surname" id="surname" required></input>
		</div>
		<div class="formElem">
            <label class="formLabel">Email:</label>
            <input type='text' name="user-email" id="user-email" required></input>
		</div>
		<div class="formElem">
            <label class="formLabel">Naslov:</label>
            <input type='text'  name="comment-title" id="comment-title" required></input>
		</div>
		<div class="formElem">
            <label class="formLabel">Komentar:</label>
			<textarea rows="10" cols="20" name="comment" id="comment"></textarea>
        </div>
		<button type="reset">Poništi</button>
		<button type="submit" name="submit"> Pošalji </button>
	</form>
	</div>
</div>
<?php
if( isset($_POST['name']) && 
    isset($_POST['surname']) && 
    isset($_POST['user-email']) && 
    isset($_POST['comment-title']) && 
    isset($_POST['comment'])) {

	
	$ime = $_POST['name'];
	$prezime = $_POST['surname'];
	$email = $_POST['user-email'];
	$subject = $_POST['comment-title'];
	$comment = $_POST['comment'];
	
	$email_from = 'toza911@gmail.com';
	$email_subject = "Turisticka agencija - kontakt: ".$subject;
	$email_body =  "Neko od korisnika vam je poslao email \n
					Ime i prezime korisnika: $ime $prezime \n
					email adresa korisnika: $email \n
					Komentar glasi:\n $comment \n";
	$to  = "toza911@gmail.com";
	$headers = "From: $email_from";

	mail($to, $email_subject,$email_body,$headers);
	}
		
?>