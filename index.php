<head>
  <link rel="stylesheet" href="style.css">
</head>
<?php session_start();
	session_destroy(); ?>
<table class="paleBlueRows" align="center">
<thead>
    <tr>
        <th>Hibajegykezelő bejelentkezés</th>
    </tr>
</thead>
  <tr><td><img src="login.png" height="200px" width="200px"></img></td></tr>
    <tr margin="30px">
        <td ><a href="users_login.php">FELHASZNÁLÓ</a></td>
    </tr>
    <tr margin="30px">
        <td><a href="emp_login.php">MUNKATÁRS</a></td>
    </tr>
</table>