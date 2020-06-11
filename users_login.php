<head>
	<link rel="stylesheet" href="style.css">
</head>

<?php
include 'functions.php';

//Korábban létrejött sessiont megsemmisítjük
session_start();
session_destroy();


//Lekérdezzük a felhasználókat
$sql = "SELECT * FROM hibajegyusers";
$eredmeny = mysqli_query($kapcsolat, $sql) or die(mysqli_error(($kapcsolat)));
?>

<form action="users.php" method="post">
	<table class="paleBlueRows" align="center">
		<thead>
			<tr>
				<th>Bejelentkezési felület</th>
			</tr>
		</thead>
		<tr>
			<td align="center"> Felhasználónév: <br>
				<?php echo "<select id='userName' name='userName' width='200px'>";
				echo "<option></option>";

				while ($row = mysqli_fetch_array($eredmeny)) {
					echo "<option value='" . $row['userName'] . "'>" . $row['userName'] . "</option>";
				}
				echo "</select></td></tr>";
				?>

		<tr>
			<td align="center">
				<label for="fname">Új felhasználó létrehozása: <br> </label>
				<input type="text" id="userNameNew" name="userNameNew" width="200px"></td>
		</tr>

		<tr>
			<td><label for="pwd">Jelszó:<br></label><input type="password"></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" value="Bejelentkezés">
		</tr>
		</td>
	</table>
</form>