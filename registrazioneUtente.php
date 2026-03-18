<?php
include("inc/datiConnessione.php");
try{
    include("inc/startConn.php");
    $errors = array();
    $empty = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";

    function controlla($campo, $messaggio_errore, & $errors){

        if(isset($_POST[$campo]) && trim($_POST[$campo]) != "") {
            return true;
        }
        else {
            $errors[] = $messaggio_errore;
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

    controlla("nome", "E necessario inserire un nome", $errors);
    controlla("cognome", "E necessario inserire un cognome", $errors);
    if(controlla("email", "E necessario inserire una email", $errors)){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email: " . $_POST['email'] . " non è valida\n";
        }
    }
    controlla("password", "E necessario inserire una password", $errors);


    if(count($errors) > 0){
        die(var_dump($errors));
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
        die("Hash password non valido");
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

    $sql = "INSERT INTO utenti (nome, cognome, username, email, password, salt) VALUE ('$_POST[nome]', '$_POST[cognome]', '$_POST[username]', '$_POST[email]', '$saved_pwd', '$salt')";

    $results = $conn->query($sql);
	
	header("Location: profile.php");

}catch(PDOException $e) {
    // stampando il messaggio di errore
    echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
}
?>