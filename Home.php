<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiting Pro - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .navbar-custom { background-color: #000; border-bottom: 3px solid #0dcaf0; }
        .navbar-brand span { color: #0dcaf0; }
        
        .centered-content {
            min-height: calc(100vh - 150px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .img-container { max-width: 350px; width: 90%; }
        .img-container img { width: 100%; height: auto; border-radius: 30px;}
        .welcome-text { font-weight: 800; color: #333; letter-spacing: -1px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="Home.php"><span>RECRUITING</span>PRO</a>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if(isset($_SESSION['loggato'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="stampaTabellaAziende.php">Visualizza le aziende</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="stampaTabellaCandidati.php">Visualizza gli utenti</a>
                    </li>
                <?php endif; ?>
            </ul>
            
            <div class="d-flex align-items-center">
                <?php if(!isset($_SESSION['loggato'])): ?>
                    <a href="login_utenti.php" class="btn btn-outline-light btn-sm me-2 rounded-pill px-3">Accedi</a>
                    <a href="registrazione.php" class="btn btn-info btn-sm rounded-pill px-3 fw-bold">Registrati</a>
                <?php else: ?>
                    <span class="text-white me-3 small">Benvenuto, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></span>
                    <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Esci</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="centered-content">
        <div class="img-container mb-4">
            <img src="immagini/LogoRecruitingPRO.png" alt="Logo Recruiting PRO">
        </div>
        
        <h1 class="welcome-text display-4 mb-4">Costruisci il tuo futuro.</h1>
        
        <div class="mt-2">
            <?php if(!isset($_SESSION['loggato'])): ?>
                <a href="registrazione.php" class="btn btn-info btn-lg rounded-pill px-5 fw-bold shadow">Inizia Ora</a>
            
            <?php else: ?>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="stampaTabellaCandidati.php" class="btn btn-info btn-lg rounded-pill px-5 fw-bold shadow">Visualizza Candidati</a>
                    <a href="stampaTabellaAziende.php" class="btn btn-outline-dark btn-lg rounded-pill px-5 fw-bold">Vedi Aziende</a>
                </div>
                
                <p class="mt-4 text-muted small">Accesso autorizzato per: <strong><?php echo $_SESSION['username']; ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>