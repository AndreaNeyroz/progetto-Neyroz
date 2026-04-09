<?php
session_start();
include("inc/datiConnessione.php");

try {
    include("inc/startConn.php");
    $errors = array();

    /**
     * Funzione di validazione campi
     */
    function controlla_campo($campo, $messaggio_errore, &$errors) {
        if (isset($_POST[$campo]) && trim($_POST[$campo]) !== "") {
            return true;
        } else {
            $errors[$campo] = $messaggio_errore;
            return false;
        }
    }

    // 1. Verifichiamo l'invio dei dati
    $user_ok = controlla_campo("username", "È necessario inserire lo username", $errors);
    $pass_ok = controlla_campo("password", "È necessario inserire la password", $errors);

    if (!$user_ok || !$pass_ok) {
        $_SESSION["errors"] = $errors;
        $_SESSION["temp_username"] = $_POST["username"] ?? "";
        header("Location: login.php");
        exit();
    }

    $username = trim($_POST["username"]);
    $password_in_chiaro = $_POST["password"];

    // 2. Cerchiamo l'utente nel database
    $sql = "SELECT * FROM utenti WHERE username = :user LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user', $username);
    $stmt->execute();
    $utente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utente) {
        $salt = $utente['salt'];
        $password_db = $utente['password'];

        // 3. Hashing della password (Server-side)
        $password_hash_client = hash('sha256', $password_in_chiaro);
        $salt_div = str_split($salt, strlen($salt) / 2);
        $password_da_verificare = hash('sha256', $salt_div[0] . $password_hash_client . $salt_div[1]);

        // 4. Confronto finale
        if ($password_da_verificare === $password_db) {
            
            // --- LOGIN SUCCESS ---
            // Pulizia preventiva della sessione
            session_unset();
            
            $_SESSION["loggato"] = true;
            $_SESSION["id_utente"] = $utente['id'];
            $_SESSION["username"] = $utente['username'];
            $_SESSION["tipo"] = $utente['tipoAccount'];
            
            // 5. RECUPERO NOME E COGNOME (per evitare l'errore Undefined Key)
            // Se è un utente normale, cerchiamo in tabella Candidati/DatiPersonali 
            // Se è un'azienda, cerchiamo il nome dell'azienda
            if (strcasecmp($utente['tipoAccount'], 'Utente') == 0) {
                // Esempio: cerchi nella tabella dove salvi i nomi dei candidati
                // Adattare i nomi delle colonne 'nome' e 'cognome' al tuo DB
                $_SESSION["nome"] = $utente['nome'] ?? 'Utente';
                $_SESSION["cognome"] = $utente['cognome'] ?? '';
            } else {
                // È un'azienda: usiamo il nome azienda come "nome" e stringa vuota come "cognome"
                // Adattare la colonna 'nomeAzienda' al tuo DB
                $_SESSION["nome"] = $utente['nomeAzienda'] ?? $utente['username'];
                $_SESSION["cognome"] = ""; 
            }

            header("Location: Home.php");
            exit();

        } else {
            $errors[] = "Password errata.";
        }
    } else {
        $errors[] = "Username non trovato.";
    }

    // Gestione errore autenticazione
    $_SESSION["errors"] = $errors;
    $_SESSION["temp_username"] = $username;
    header("Location: login.php");
    exit();

} catch (PDOException $e) {
    $_SESSION["errors"] = ["Errore di connessione al database."];
    header("Location: login.php");
    exit();
}