<?php
session_start();
$logged = false;
$utenteLoggato = null;

if(isset($_SESSION['loggato']) && $_SESSION['loggato'] === true) {
    $logged = true;
    $utenteLoggato = [
        'nome' => $_SESSION['nome'] ?? "Utente", 
        'cognome' => $_SESSION['cognome'] ?? "",
        'tipoAccount' => $_SESSION['tipo'] ?? "Candidato"
    ];
}
?>