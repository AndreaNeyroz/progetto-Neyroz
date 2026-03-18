<?php
	include("checkLogin.php");
	if(!$logged)
		header("location: login.php");
	// else
	echo "<p>Bentornato, $utenteLoggato[nome] $utenteLoggato[cognome]</p>";
	echo "<br>";
	echo "<a href='logout.php'>Logout</a>";
    
?>