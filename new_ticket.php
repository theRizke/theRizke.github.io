<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php
include 'functions.php';

//A megkapott adatokat egy változóba rakjuk
	$nev= $_POST['userName'];
	$id= $_POST['userID'];

	echo "Kedves <b> $nev,</b> töltsd ki az űrlapot! <br><br>";	
?>

	<form name="new_ticket" action="submit_ticket.php" method="post"> 
		<label>Jegy típusa: </label>
			<select id='type' name='type' width='300px' ><option value="hiba">Hiba</option><option value="kérés">Kérés</option></select><br>
		<label>Probléma leírása <br></label>
			<input type="text" id="userNameNew" name="comment" style="width: 300px height: 100px; "> </tr></td>
			<input type="hidden" name="userName" value=" <?php echo $nev ?> ">
			<input type="hidden" name="userID" value=" <?php echo $id ?> ">
			<input type="hidden" name="tipus" value="new">
		<input type="submit" name="submit" value="Beküldés">
	</form>

	<form action="users.php" method="post">
		<input type="hidden" name="userName" value="<?php echo $_POST['userName'] ?> ">
		<input type="hidden" name="userNew" value="">
		<input type="submit" name="submit" value="Vissza">
	</form>

