<?php
    include("checkLogin.php");
    
    // Se non è loggato, lo mandiamo al login, ma non controlliamo più se è Azienda
    if(!$logged) {
        header("location: login_utenti.php");
        exit();
    }
    
    include("inc/startConn.php");
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Utenti Registrati - Recruiting Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; padding-top: 30px; }
        .table-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="container">

    <div class="mb-4">
        <a href="Home.php" class="btn btn-outline-secondary">Torna alla Home</a>
    </div>

    <div class="table-container">
        <h3 class="mb-4">Elenco Utenti Registrati</h3>
        <hr>

        <?php
        try {
            // Query per prendere tutti i candidati
            $sql = "SELECT c.*, u.nome, u.cognome, u.email 
                    FROM candidati c 
                    JOIN utenti u ON c.FkidUtenti = u.id";
            
            $res = $conn->query($sql);
            
            if($res->rowCount() > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-hover align-middle'>";
                echo "<thead class='table-dark'>
                        <tr>
                            <th>Nominativo</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th class='text-center'>Azioni</th>
                        </tr>
                      </thead>
                      <tbody>";
                
                while($r = $res->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td class='fw-bold'>".htmlspecialchars($r['nome'] . " " . $r['cognome'])."</td>
                            <td>".htmlspecialchars($r['email'])."</td>
                            <td>".htmlspecialchars($r['numeroTelefono'] ?? 'N/D')."</td>
                            <td class='text-center'>
                                <a href='visualizzaProfilo.php?id=".$r['codC']."' class='btn btn-sm btn-primary'>Dettagli</a>
                            </td>
                          </tr>";
                }
                echo "</tbody></table></div>";
            } else {
                echo "<div class='alert alert-warning'>Nessun utente trovato nel database.</div>";
            }
        } catch(PDOException $e) { 
            echo "Errore: " . $e->getMessage(); 
        }
        ?>
    </div>
</body>
</html>