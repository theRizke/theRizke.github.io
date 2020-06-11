<head>
	<link rel="stylesheet" href="style.css">
</head>

<?php
include 'functions.php';

session_start();

//Ha korábban még nem jelentkezett be, a session érték a névre változik
if ((empty($_SESSION['empName']))) {
	$_SESSION['empName'] = $_POST['empName'];
}

// Ha nem választottunk ki bejelentkezésnél senkit
if (($_SESSION['empName']) === "" && empty($_SESSION['empName'])) {
	echo "Nem választottál ki munkatársat. <br>"; ?>
	<form action="emp_login.php" method="post">
		<input type="submit" name="submit" value="Vissza">
	</form>

<?php
}

//Ha kiválasztotta a nevet
else {

	$empName = $_SESSION['empName'];
	echo "Üdv <b>$empName</b>! <br>";

	$logfile = "log.txt";
	$korabbilog = file_get_contents($logfile);
	$logfile = fopen("log.txt", "w+");
	$log = $korabbilog . $empName . " munkatárs bejelentkezett " . date("Y-m-d H:i:s", time()) . "-kor. \n";
	fwrite($logfile, $log);
	fclose($logfile);

?>
	<form action="index.php">
		<input type="submit" value="Kijelentkezés" />
	</form>

	<?php
	echo "Saját hibajegyeim: <br>";


	//empID lekérdezése
	$sql_empidLekerdezes = "SELECT empID FROM hibajegyemp WHERE empName = '$empName'";
	$empidLekerdezes = mysqli_query($kapcsolat, $sql_empidLekerdezes) or die(mysqli_error(($kapcsolat)));
	$empidArray = mysqli_fetch_array($empidLekerdezes);
	$empID = $empidArray['empID'];



	// Jegyek betoltese
	$sql_ticket = "SELECT * FROM tickets INNER JOIN hibajegyemp ON tickets.empID=hibajegyemp.empID WHERE (hibajegyemp.empName='$empName')";
	$ticket = mysqli_query($kapcsolat, $sql_ticket) or die(mysqli_error(($kapcsolat)));
	?>

	<form action="edit_ticket.php" method="post">
		<table class="blueTable">
			<thead align="center">
				<tr>
					<th></th>
					<th>ticketID</th>
					<th>FelhasználóID</th>
					<th>Típus</th>
					<th>Leírás</th>
					<th>Dátum</th>
					<th>Állapot</th>
				</tr>
			</thead>
			<?php
			while ($ticketTomb = mysqli_fetch_array($ticket)) {
				$ticketID = $ticketTomb['ticketID'];
				$usersID = $ticketTomb['usersID'];
				$type = $ticketTomb['type'];
				$comment = $ticketTomb['comment'];
				$date = $ticketTomb['date'];
				$isDone = allapot($ticketTomb['IsDone']);


			?>
				<tr align="center">
					<td><input type="radio" name="kod" value="<?php echo $ticketID ?>"></td>
					<td> #<?php echo $ticketID ?></td>
					<td width="50px"> #<?php echo $usersID ?></td>
					<td> <?php echo $type ?></td>
					<td width="50%"> <?php echo $comment ?></td>
					<td> <?php echo $date ?></td>
					<td> <?php echo $isDone ?></td>

				</tr>
			<?php } ?>
		</table>
		<input type="hidden" name="empID" value="<?php echo $empID ?> ">
		<input type="submit" name="modify" value="Szerkesztés">
	</form>

	<form action="tickets.php" method=post>
		<input type="hidden" name="empID" value="<?php echo $empID ?> ">
		<input type="submit" name="modify" value="Új feladat kiválasztása">
	</form>

<?php

}
?>