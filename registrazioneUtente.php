<?php
try {
    include("inc/startConn.php");
    
    // Recupero tipo e email
    $tipo = $_POST['opzioni'];
    $email = ($tipo == "Utente") ? $_POST['email'] : $_POST['email_aziendale'];

    // Hashing Password (Server-side)
    $pass_chiaro = $_POST['password'];
    $pass_hash_client = hash('sha256', $pass_chiaro); 
    $salt = hash('sha256', (string)rand());
    $salt_div = str_split($salt, strlen($salt)/2);
    $final_pwd = hash('sha256', $salt_div[0] . $pass_hash_client . $salt_div[1]);

    $conn->beginTransaction();

    // 1. Tabella utenti
    $n_padre = ($tipo == "Utente") ? $_POST['nome'] : $_POST['nome_azienda'];
    $c_padre = ($tipo == "Utente") ? $_POST['cognome'] : "Azienda";

    $stmtU = $conn->prepare("INSERT INTO utenti (nome, cognome, username, email, password, salt) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtU->execute([$n_padre, $c_padre, $_POST['username'], $email, $final_pwd, $salt]);
    
    $last_id = $conn->lastInsertId();

    // 2. Tabelle Figlie
    if ($tipo == "Utente") {
        $gen = (strtolower($_POST['genere']) == "m") ? "m" : "f";
        $stmtC = $conn->prepare("INSERT INTO Candidati (codF, link_CV, dataNascita, genere, esperienze, numeroTelefono, FkidUtenti) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtC->execute([$_POST['codice_fiscale'], $_POST['link_cv'], $_POST['data_nascita'], $gen, $_POST['esperienze'], $_POST['telefono'], $last_id]);
    } else {
        $stmtA = $conn->prepare("INSERT INTO Aziende (nomeAzienda, ragioneSociale, ind_via, ind_civ, ind_citta, cap, FkidUtenti) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtA->execute([$_POST['nome_azienda'], $_POST['ragione_sociale'], $_POST['via'], $_POST['civico'], $_POST['citta'], $_POST['cap'], $last_id]);
    }

    $conn->commit();

    // Messaggio finale invece del reindirizzamento per evitare loop
    echo "<div style='color:white; text-align:center; padding:50px; background:#222; font-family:sans-serif;'>";
    echo "<h2>Registrazione completata con successo!</h2>";
    echo "<p>Benvenuto, " . htmlspecialchars($_POST['username']) . "</p>";
    echo "<a href='login_utenti.php' style='color:cyan;'>Clicca qui per andare al Login</a>";
    echo "</div>";

} catch (Exception $e) {
    if (isset($conn)) $conn->rollBack();
    die("Errore critico: " . $e->getMessage());
}
?>