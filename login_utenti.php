<?php
include("inc/datiConnessione.php");
try{
    include("inc/startConn.php");
    $errors = array();
    $empty = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

    function controlla1($campo, $messaggio_errore, & $errors){

        if(isset($_POST[$campo]) && trim($_POST[$campo]) != "") {
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

    if(controlla1("username", "E necessario inserire uno username", $errors))
		$_SESSION["username"] = $_POST["username"];
    controlla1("password", "E necessario inserire una password", $errors);


    if(count($errors) > 0){
        // var_dump($errors);
		$_SESSION["errors"] = $errors;
		header("Location: login.php");
    }

    /*
     *
     * Dopo aver verificato la correttezza dei dati ricevuti dal client
     * 
     * Generiamo il salt casualmente
     * 
     * Lo concateniamo all'hash ricevuto
     * 
     * Generiamo l'hash finale
     * 
     */

    if(strlen($_POST["password"]) != 64 || $_POST["password"] === hash('sha256', '')){
        array_push($_SESSION["errors"]["HashError"], "Hash password non valido");
		header("Location: login.php");
    }

    $salt = hash('sha256', rand());

    //var_dump($_POST);

    echo "<br>Salt:" . $salt;

    $salt_div = str_split($salt, strlen($salt)/2);
    
    $saved_pwd = hash('sha256', $salt_div[0].$_POST['password'].$salt_div[1]);

    /*
     *
     *Eseguiamo la query per inserire l'utente del db 
     * 
     */
	 
	$_SESSION["password"] = $_POST["password"];

    include("checkLogin.php");
	
	if($logged)
		header("Location: profile.php");
	
	//else
	array_push($errors, "Dati utente cambiati!");
	$_SESSION["errors"] = $errors;
	$_SESSION["username"] = $_POST["username"];
	header("Location: login.php");
	

}catch(PDOException $e) {
    // stampando il messaggio di errore
    echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
}
?>