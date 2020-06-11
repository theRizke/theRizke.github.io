<head>
	<link rel="stylesheet" href="style.css">
</head>
<?php
include 'functions.php';
//Korábbi sessiont megszüntetjük
session_start();
session_destroy();

// Kiépítjük az összeköttetést


// Legördülő menüből kiválasztjuk a a dolgozót
?>
<table class="paleBlueRows" align="center">
	<form action="emp.php" method="post">

		<?php
		$sql = "SELECT * FROM hibajegyemp";
		$eredmeny = mysqli_query($kapcsolat, $sql) or die(mysqli_error(($kapcsolat))); ?>
		<thead>
			<tr>
				<th>Válaszd ki munkatársat</th>
			</tr>
		</thead>
		<tr>
			<td>
				<?php
				echo "<select id='empName' name='empName'>";
				echo "<option></option>";
				while ($row = mysqli_fetch_array($eredmeny)) {
					echo "<option value='" . $row['empName'] . "'>" . $row['empName'] . "</option>";
				}
				echo "</select><br>";
				?>
			</td>
		</tr>
		<tr>
			<td><label for="pwd">Jelszó:<br></label><input type="password"></td>
		</tr>
		<tr>
			<td><input type="submit" value="Bejelentkezés"></td>
		</tr>
	</form>
</table>