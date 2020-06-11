<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php
include 'functions.php';

		session_start();
		
		if (empty($_POST['userName']) && empty($_POST['userNameNew']) && empty($_SESSION['userName']))
		{
			echo "Nem választottál ki felhasználót! <br>";
			exit();
		}

		//Elindítjük a sessiont
			
			
			if( (empty($_SESSION['userName']) && ($_POST['userName']) === ""))
				{
					//Ha ez az első belépés újonnan létrehozott felhasználóval, akkor átadjuk a sessionnek
					$_SESSION['userName'] = $_POST['userNameNew'];
				}
			if( (empty($_SESSION['userName']) && (!empty($_POST['userName'])))	)
				{
					//Ha ez az első belépés új felhasználóval, akkor átadjuk a sessionnek
					$_SESSION['userName'] = $_POST['userName'];
				}

	//Ha új felhasználó jött létre			
	if (!empty($_POST['userNameNew'])) 
		{
			$nev = $_POST['userNameNew'];
	
			//Meghatározzuk az új felhasználó ID-ját
				$sql_sorszam = "SELECT * FROM hibajegyusers ORDER BY userID DESC LIMIT 1";
				$sorszam = mysqli_query($kapcsolat, $sql_sorszam) or die(mysqli_error(($kapcsolat)));
				$idNew=mysqli_fetch_assoc($sorszam);
				$id = $idNew['userID'];
				$id++;

			//Hozzáadjuk a felhasználót a táblához
				$sql_hozzaad = "INSERT INTO hibajegyusers (userID, userName) VALUES ('$id', '$nev')";
				$hozzaad = mysqli_query($kapcsolat, $sql_hozzaad) or die(mysqli_error(($kapcsolat)));
				echo "Új felhasználó létrejött. <br><br>";

				$logfile = "log.txt";
				$korabbilog = file_get_contents($logfile);
				$logfile = fopen("log.txt", "w+");
				$log = $korabbilog . $nev . " felhasználó létrejött és bejelentkezett " . date("Y-m-d H:i:s", time()) . "-kor. \n";
				fwrite($logfile, $log);
				fclose($logfile);
	

		}
	//Ha létező felhasználóval jelentkezett be	
	else {

		$nev = $_SESSION['userName'];
		$logfile = "log.txt";
		$korabbilog = file_get_contents($logfile);
		$logfile = fopen("log.txt", "w+");
		$log = $korabbilog . $nev . " felhasználó bejelentkezett " . date("Y-m-d H:i:s", time()) . "-kor. \n";
		fwrite($logfile, $log);
		fclose($logfile);	
	
	}
		
	 // Logolás
	

	//A felhasználó ID-jának lekérdezése
		$sql_idLekerdezes = "SELECT userID FROM hibajegyusers WHERE userName = '$nev'";
		$idLekerdezes = mysqli_query($kapcsolat, $sql_idLekerdezes) or die(mysqli_error(($kapcsolat)));
		$idArray = mysqli_fetch_array($idLekerdezes);
		$id= $idArray['userID'];
			
		echo "Bejelentkezve, mint <b>$nev</b>.<br>";

		
		//Új jegy létrehozása GOMB
		?>
			<form name="new_ticket" action="new_ticket.php" method="post">
				<input type="hidden" name="userName" value=" <?php echo $nev ?> ">
				<input type="hidden" name="userID" value=" <?php echo $id ?> ">
				<input type="submit" name="letrehozas"  value="Új jegy létrehozása">
			</form>


		<?php		
		//Táblázat létrehozása a felhasználó hibajegyeinek
			$sql_ticket = "SELECT * FROM tickets INNER JOIN hibajegyusers ON tickets.usersID=hibajegyusers.userID WHERE (hibajegyusers.userName='$nev')";
			$ticket = mysqli_query($kapcsolat, $sql_ticket) or die(mysqli_error(($kapcsolat)));
		?>
	
			<form name="edit_ticket" action="edit_ticket.php" method="post">
				<table class="blueTable">
					<thead>
						<tr align="center"><th>#</th><th>ticketID</th><th>Típus</th><th>Leírás</th><th>Létrehozás ideje</th><th>Állapot</th></tr>
					</thead>
			<?php
				while ($ticketTomb = mysqli_fetch_array($ticket)) 
					{
					$ticketID= $ticketTomb['ticketID'];
					$type= $ticketTomb['type'];
					$comment= $ticketTomb['comment'];
					$date= $ticketTomb['date'];
					$isDone= allapot($ticketTomb['IsDone']);    
?>
				<tr align="center">
					<td width="50px"> <input name="kod" type="radio" value="<?php echo $ticketID ?>" ></td>
					<td> #<?php echo $ticketID ?></td>
					<td> <?php echo $type ?></td>
					<td width="500px"> <?php echo $comment ?></td>
					<td> <?php echo $date ?></td>
					<td> <?php echo $isDone ?></td>			
				</tr>
<?php
					}

 ?>
				</table>
				<input type="hidden" name="userName" value=" <?php echo $nev ?> ">
				<input name="modify" type="submit" value="Módosítás">
				<input name="modify" type="submit"  value="Törlés" >
			</form>

			<form action="index.php">
    			<input type="submit" value="Kijelentkezés" />
			</form>
