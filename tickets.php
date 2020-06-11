<head>
  <link rel="stylesheet" href="style.css">
</head>

<?php
include 'functions.php';

    if ($_POST['modify'] == "Új feladat kiválasztása") {

        $sql_ticket = "SELECT * FROM tickets WHERE  (IsDone='false' AND empID='0')";
        $ticket = mysqli_query($kapcsolat, $sql_ticket) or die(mysqli_error(($kapcsolat)));
        echo "<h1><center>Szabad hibajegyek:</center></h1>"
    ?>
            <form action="edit_ticket.php" method="post">
            <table class="blueTable">
                <thead><th></th><th>ticketID</th><th>userID</th><th>Leírás</th><th>Dátum</th></thead>
            <?php
    
                while ($ticketTomb = mysqli_fetch_array($ticket)) 
	                {
  	            // Nevet adunk a mezőknek
		            $ticketID= $ticketTomb['ticketID'];
		            $usersID= $ticketTomb['usersID'];
		            $comment= $ticketTomb['comment'];
		            $date= $ticketTomb['date'];
    
            ?>
	            <tr align="center">
                    <td> <input name="kod" type="radio" value="<?php echo $ticketID ?>" ></td>
                    <td> #<?php echo $ticketID ?></td>
	                <td> #<?php echo $usersID ?></td>
	                <td width="400px"> <?php echo $comment ?></td>
	                <td> <?php echo $date ?></td>
                </tr>

            <?php } 

            $empID=$_POST['empID'];

        ?>
            </table>
                <input type="hidden" name="empID" value="<?php echo $empID ?> ">
                <input type="submit" name="modify" value="Feladat hozzáadása">
            </form>
<?php } 
 
 ?>
