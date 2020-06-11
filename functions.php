<?php
// Kiépítjük az összeköttetést
$kapcsolat = mysqli_connect("localhost", "root", "");
// Kiválasztjuk az adatbázist
mysqli_select_db($kapcsolat,"hibajegyteszt");

function allapot($allapot) {
  if ($allapot == '0') {return "\u{274C}";}
  else { return "	\u{2714}\u{FE0F}";}

}

?>