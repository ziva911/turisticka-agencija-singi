<?php 
$modul = $_GET['modul'] ?? '';
$modul_name = modul_name_check($modul);
function modul_name_check($modul){
	return ($modul == '')	? '':'./content/'.$modul.'.php';	
}
?>
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
include("templates/main-content.php");
include("templates/footer.php");
?>

</div>
	</body>
</html>
