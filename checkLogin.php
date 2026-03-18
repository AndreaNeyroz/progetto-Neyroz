<?php
session_start();
include("inc/datiConnessione.php");
try{
    include("inc/startConn.php");
    $errors = array();
    $empty = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

    function controlla($campo, $messaggio_errore, & $errors){

        if(isset($_SESSION[$campo]) && trim($_SESSION[$campo]) != "") {
            return true;
        }
        else {
            $errors[$campo] = $messaggio_errore;
            return false;
        }
    }

    /*
     *
     * Validiamo l'input ricevuto dal client
     * 
     * Dal client ci aspettiamo: 
     * - nome
     * - cognome
     * - username
     * - email
     * - password(hash)
     * 
     * Tutti i campi sono obbligatori, in più dobbiamo controllare che l'email sia formalmente corretta
     * 
     */

    controlla("username", "Username non trovato", $errors);
    controlla("password", "Password non trovata", $errors);


    if(count($errors) > 0)
		$logged = false;
    else if(strlen($_SESSION["password"]) != 64 || $_SESSION["password"] === hash('sha256', ''))
        $logged = false;
    else {

		$salt = hash('sha256', rand());

		$salt_div = str_split($salt, strlen($salt)/2);
		
		$saved_pwd = hash('sha256', $salt_div[0].$_POST['password'].$salt_div[1]);

		/*
		 *
		 *Eseguiamo la query per il check dell'utente del db 
		 * 
		 */
		 
		$sql = "SELECT * FROM utenti WHERE username = '$_SESSION[username]'";
		$results = $conn->query($sql);
		if($results->rowCount() != 1)
			$logged = false;
		else {
			$utenteLoggato = $results->fetch(PDO::FETCH_ASSOC);
	 
			if($utenteLoggato["password"] == $saved_pwd)
			 $logged = true;
			else
			 $logged = false;
		}
	}
	

}catch(PDOException $e) {
    // stampando il messaggio di errore
    echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
}
?>