<head>
    <link rel="stylesheet" href="style.css">
</head>
<?php
include 'functions.php';

if (($_POST["modify"] == "Módosítás") && (empty($_POST['kod']))) {
    echo "Nem választottál ki hibajegyet!";
    echo "<br><a href='users.php'> Vissza</a>";
    exit();
}

if (($_POST["modify"] == "Szerkesztés") && (empty($_POST['kod']))) {
    echo "Nem választottál ki hibajegyet!";
    echo "<br><a href='emp.php'> Vissza</a>";
    exit();
}

$ticketID = $_POST['kod'];

// HA FELHASZNÁLÓ MÓDOSÍT
if ($_POST["modify"] == "Módosítás") {



    $sql_ticket = "SELECT * FROM tickets WHERE (ticketID='$ticketID')";
    $ticket = mysqli_query($kapcsolat, $sql_ticket) or die(mysqli_error(($kapcsolat)));
    $ticketTomb = mysqli_fetch_array($ticket);
    echo "<b>Hibajegy felhasználói módosítása</b> <br>"
?>
    <table class="blueTable" id="edit">
        <form name="edit_ticket" action="submit_ticket.php" method="post">
            <tr>
                <td><label for="type">Jegy típusa: </label></td>
                <td><select name='type' width='300px'>
                        <option>Hiba</option>
                        <option>Kérés</option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="comment">Leírás: </label></td>
                <td><input type="text" name="comment" value=" <?php echo $ticketTomb['comment'] ?>" "> </td>
                </tr>
                <tr>
                    <input type=" hidden" name="ticketID" value=" <?php echo $ticketID ?> ">
                    <input type="hidden" name="tipus" value="edit">
                <td><input type="submit" name="submit" value="Módosítás"></td>
                <td></td>
            </tr>
        </form>
    </table>
<?php
}

// HA FELHASZNÁLÓ TÖRÖL
else if ($_POST["modify"] == "Törlés") {
    $sql_torles = "DELETE FROM tickets WHERE ticketID = $ticketID";
    $torles = mysqli_query($kapcsolat, $sql_torles) or die(mysqli_error(($kapcsolat)));
    echo "Sikeres törlés.";

    //LOG
    $logfile = "log.txt";
    $korabbilog = file_get_contents($logfile);
    $logfile = fopen("log.txt", "w+");
    $log = $korabbilog . $_POST['userName'] . " törölte a #" . $ticketID . " számú hibajegyet" . date("Y-m-d H:i:s", time()) . "-kor. \n";
    fwrite($logfile, $log);
    fclose($logfile);

?>
    <form action="users.php" method="post">
        <input type="hidden" name="userName" value="<?php echo $_POST['userName'] ?> ">
        <input type="hidden" name="userNew" value=" ">
        <input type="submit" name="submit" value="Vissza">
    </form>
<?php
}

// HA DOLGOZÓ FELADATOT VÁLASZT
else if ($_POST["modify"] == "Feladat hozzáadása") {

    $empID = $_POST['empID'];
    $sql_ticketselect = "UPDATE tickets SET  empID=$empID  WHERE (ticketID = '$ticketID')";
    $ticketselect = mysqli_query($kapcsolat, $sql_ticketselect) or die(mysqli_error(($kapcsolat)));
    echo "Sikeresen hozzáadva a feladatokhoz!";

    $logfile = "log.txt";
    $korabbilog = file_get_contents($logfile);
    $logfile = fopen("log.txt", "w+");
    $log = $korabbilog . $empID . "id-jú munkatárs kiválasztotta feladatnak a #" . $ticketID . " számú hibajegyet " . date("Y-m-d H:i:s", time()) . "-kor. \n";
    fwrite($logfile, $log);
    fclose($logfile);
?>

    <form action="emp.php" method="post">
        <input type="hidden" name="empName" value="<?php echo $_POST['empName'] ?> ">
        <input type="hidden" name="userNew" value=" ">
        <input type="submit" name="submit" value="Vissza">
    </form>
<?php

}


// HA DOLGOZÓ MÓDOSÍT
else {
    $sql_ticket = "SELECT * FROM tickets WHERE (ticketID='$ticketID')";
    $ticket = mysqli_query($kapcsolat, $sql_ticket) or die(mysqli_error(($kapcsolat)));
    $ticketTomb = mysqli_fetch_array($ticket);
    echo "<b>Hibajegy dolgozói módosítása: </b><br>"
?>
    <table class="blueTable" id="edit">
        <form name="edit_emp_ticket" action="submit_ticket.php" method="post">
            <tr>
                <td><label for="type">Típusa: </label></td>
                <td><select name='type' width='300px'>
                        <option><?php echo $ticketTomb['type'] ?></option>
                        <option><?php if ($ticketTomb['type'] == "Kérés") {
                                    echo 'Hiba';
                                } else {
                                    echo 'Kérés';
                                } ?></option>
                    </select></td>
            </tr>
            <tr>
                <td><label for="comment">Tartalom: </label></td>
                <td><input type="text" name="comment" width="400px" value=" <?php echo $ticketTomb['comment'] ?>" "></td>
                    </tr>
                    <tr>
                        <td><label for=" isDone">Állapot: </label></td>
                <td><select name='isDone' width='300px'>
                        <option value="1">Elkészült</option>
                        <option value="0">Nem készült el</option>
                    </select></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="hidden" name="ticketID" value=" <?php echo $ticketID ?> ">
                    <input type="hidden" name="tipus" value="emp_edit">
                    <input type="submit" name="submit" value="Mentés"></td>
            </tr>
        </form>
    </table>
<?php
}
?>