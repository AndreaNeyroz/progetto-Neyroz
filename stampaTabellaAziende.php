<?php
    // 1. Controllo sessione e login
    include("checkLogin.php");
    
    if(!$logged) { 
        header("location: login_utenti.php"); 
        exit(); 
    }
    
    include("inc/datiConnessione.php");

    // Definiamo il nome da visualizzare per evitare il "Warning: Undefined array key"
    $nomeUtente = $_SESSION['username'] ?? 'Utente'; 
    if (isset($_SESSION['nome']) && isset($_SESSION['cognome'])) {
        $nomeUtente = trim($_SESSION['nome'] . " " . $_SESSION['cognome']);
    } elseif (isset($_SESSION['nome'])) {
        $nomeUtente = $_SESSION['nome'];
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aziende Partner - Recruiting Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #0d6efd;
            --light-bg: #f4f7f6;
        }
        body { background-color: var(--light-bg); padding-top: 30px; font-family: 'Segoe UI', sans-serif; }
        .action-bar { 
            background: white; padding: 15px 25px; border-radius: 15px; border: 1px solid #e0e0e0; 
            display: flex; justify-content: center; gap: 15px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .table-container {
            background: white; padding: 35px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;
        }
        .table thead th {
            background-color: #212529; color: white; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; padding: 15px; border: none;
        }
        .table tbody td { padding: 15px; vertical-align: middle; }
        .btn-detail { background-color: var(--primary-blue); color: white; border-radius: 8px; transition: all 0.3s; font-weight: 600; text-decoration: none; }
        .btn-detail:hover { background-color: #0b5ed7; transform: scale(1.05); color: white; }
        .map-link { color: inherit; text-decoration: none; transition: 0.2s; display: block; }
        .map-link:hover { color: var(--primary-blue); }
    </style>
</head>
<body class="container">

    <div class="action-bar">
        <a href="Home.php" class="btn btn-outline-dark px-4"><i class="bi bi-house-door"></i> Home</a>
        <?php if(isset($_SESSION['tipo']) && strcasecmp(trim($_SESSION['tipo']), 'Azienda') == 0): ?>
            <a href="stampaTabellaCandidati.php" class="btn btn-primary px-4"><i class="bi bi-people"></i> Candidati</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-danger px-4"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Le aziende presenti: </h3>
                <p class="text-muted mb-0">Benvenuto, <strong><?php echo htmlspecialchars($nomeUtente); ?></strong>.</p>
            </div>
            <span class="badge bg-success"></span>
        </div>

        <hr class="mb-4">

        <?php
        try {
            include("inc/startConn.php");
            
            $sql = "SELECT a.*, u.email 
                    FROM Aziende a 
                    JOIN utenti u ON a.FkidUtenti = u.id 
                    ORDER BY a.nomeAzienda ASC";
            
            $res = $conn->query($sql);
            
            if($res->rowCount() > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-hover'>";
                echo "<thead>
                        <tr>
                            <th>Azienda</th>
                            <th>Ragione Sociale</th>
                            <th>Indirizzo (Maps)</th>
                            <th>Contatti</th>
                            <th class='text-center'>Dettagli</th>
                        </tr>
                      </thead>
                      <tbody>";
                
                while($r = $res->fetch(PDO::FETCH_ASSOC)) {
                    $via = $r['ind_via'];
                    $civico = $r['ind_civ']; 
                    $cap = $r['cap'];       
                    $citta = $r['ind_citta'];
                    $indirizzoCompleto = "$via $civico, $cap $citta";
                    
                    echo "<tr>
                            <td><div class='fw-bold text-dark'>".htmlspecialchars($r['nomeAzienda'])."</div></td>
                            <td><span class='badge bg-light text-dark border'>".htmlspecialchars($r['ragioneSociale'])."</span></td>
                            <td>
                                <a href='https://www.google.com/maps/search/?api=1&query=".urlencode($indirizzoCompleto)."' 
                                   target='_blank' class='map-link'>
                                    <i class='bi bi-geo-alt-fill text-danger me-1'></i>
                                    ".htmlspecialchars($via)." ".htmlspecialchars($civico)."<br>
                                    <small class='text-muted'>".htmlspecialchars($cap)." - ".htmlspecialchars($citta)."</small>
                                </a>
                            </td>
                            <td>
                                <a href='mailto:".htmlspecialchars($r['email'])."' class='text-decoration-none'>
                                    <i class='bi bi-envelope-at me-1'></i>".htmlspecialchars($r['email'])."
                                </a>
                            </td>
                            <td class='text-center'>
                                <a href='visualizzaAzienda.php?cf=".urlencode($r['codA'])."' class='btn btn-sm btn-detail px-3'>Dettagli</a>
                            </td>
                          </tr>";
                } // Fine del while
                echo "</tbody></table></div>";
            } else {
                echo "<div class='alert alert-info text-center'>Nessuna azienda partner trovata.</div>";
            }
            
        } catch(PDOException $e) { 
            echo "<div class='alert alert-danger'>Errore database: " . $e->getMessage() . "</div>"; 
        } // Fine del catch
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>