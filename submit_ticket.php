<head>
  <link rel="stylesheet" href="style.css">
</head>

<?php
include 'functions.php';

    //Ha új jegy jön létre
    if($_POST['tipus'] == 'new') {
        $userName = $_POST['userName'];
        $_POST['comment']; 
        $comment = $_POST['comment'];
        $type = $_POST['type']; 
        $userid= $_POST['userID'];

    //következő ticketid meghatározása
        $sql_ticketID = "SELECT * FROM tickets ORDER BY ticketID DESC LIMIT 1";
        $lefutott_ticketID = mysqli_query($kapcsolat, $sql_ticketID) or die(mysqli_error(($kapcsolat)));
        $ticketIDArray=mysqli_fetch_assoc($lefutott_ticketID);
        $ticketID = $ticketIDArray['ticketID'];
        $ticketID++;
    //ticket rögzítése a táblába
        $SQL_newticket = "INSERT INTO tickets (ticketID, usersID, type, comment, date, empID, IsDone) VALUES ('$ticketID','$userid', '$type', '$comment', CURRENT_TIMESTAMP() , '0', 0)";
        $felvitel = mysqli_query($kapcsolat, $SQL_newticket) or die(mysqli_error(($kapcsolat)));
 
        echo "A hibajegy felvételre került <br>";

        $logfile = "log.txt";
        $korabbilog = file_get_contents($logfile);
        $logfile = fopen("log.txt", "w+");
        $log = $korabbilog . $userName . "felhasználó létrehozta a #" . $ticketID . " számú hibajegyet " . date("Y-m-d H:i:s", time()) . "-kor. \n";
        fwrite($logfile, $log);
        fclose($logfile);
?>
        <form action="users.php" method="post">
            <input type="hidden" name="userName" value=" <?php echo $userName ?> ">
            <input type="submit" name="submit" value="Vissza">
        </form>
<?php
    }
    //Ha a dolgozó szerkeszti a jegyet
    else if($_POST['tipus'] == 'emp_edit') {
        $ticketID = $_POST['ticketID'];
        $comment = $_POST['comment'];
        $IsDone = $_POST['isDone'];
        $type = $_POST['type'];
        $sql_update = "UPDATE tickets SET comment='$comment', type='$type', date=CURRENT_TIMESTAMP(), IsDone='$IsDone'  WHERE (ticketID = '$ticketID')";
        $update = mysqli_query($kapcsolat, $sql_update) or die(mysqli_error(($kapcsolat)));
        echo "A módosítás elkészült.";

        $logfile = "log.txt";
        $korabbilog = file_get_contents($logfile);
        $logfile = fopen("log.txt", "w+");
        $log = $korabbilog . $ticketID . " számú hibajegyet módosította a munkatárs " . date("Y-m-d H:i:s", time()) . "-kor. \n";
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

    //Ha módosítottuk a ticketet
    else {
        $ticketID = $_POST['ticketID'];
        $comment= $_POST['comment'];
        $type= $_POST['type'];

        $sql_update = "UPDATE tickets SET comment='$comment', type='$type', date=CURRENT_TIMESTAMP(), IsDone=0  WHERE (ticketID = '$ticketID')";
        $update = mysqli_query($kapcsolat, $sql_update) or die(mysqli_error(($kapcsolat)));
    
        echo "Módosítás elkészült!"; 
        
        $logfile = "log.txt";
        $korabbilog = file_get_contents($logfile);
        $logfile = fopen("log.txt", "w+");
        $log = $korabbilog . $ticketID . " számú hibajegyet módosította a felhasználó " . date("Y-m-d H:i:s", time()) . "-kor. \n";
        fwrite($logfile, $log);
        fclose($logfile);
        
        ?>

        <form action="users.php" method="post">
            <input type="hidden" name="userName" value="<?php echo $_POST['userName'] ?> ">
            <input type="hidden" name="userNew" value=" ">
            <input type="submit" name="submit" value="Vissza">
        </form>
<?php } ?>
