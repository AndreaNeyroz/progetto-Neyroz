<html>
  <head>
    <title>Aziende</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <h1>Aziende</h1>
    <nav>
        <ul>
            <li><a href='index.php'>Home</a></li>
            <li><a href='aziende.php'>Aziende</a></li>
            <li><a href='annunci.php'>Annunci</a></li>
            <li><a href='registrazione.php'>Sign in</a></li>
            <li><a href='login.php'>Login</a></li>
        </ul>
    </nav>
    
    <?php
    include ("inc/datiConnessione.php");
     
    try {
        include ("inc/startConn.php");
    ?>
        <form method="get" action="#">
            </form>
        
        <?php
        /* MODIFICA FONDAMENTALE: 
           Uso INNER JOIN per unire 'Aziende' e 'utenti' 
           e recuperare il campo 'email' che manca nella tabella Aziende.
        */
        $sql = "SELECT Aziende.*, utenti.email 
                FROM Aziende 
                INNER JOIN utenti ON Aziende.FkidUtenti = utenti.id";

        if(isset($_GET["nomeAzienda"]) && $_GET["nomeAzienda"] != "all") {
            // Usiamo quote() per evitare SQL Injection
            $sql .= " WHERE Aziende.nomeAzienda = " . $conn->quote($_GET["nomeAzienda"]);
        }
        
        // Debug: puoi decommentare la riga sotto per vedere la query prodotta
        // echo $sql;

        $results = $conn->query($sql);
        $nAziende = $results->rowCount();

        if($nAziende == 0)
            echo "<h2>NON sono presenti aziende</h2>";
        else if($nAziende == 1)
            echo "<h2>E' presente 1 sola azienda</h2>";
        else
            echo "<h2>Sono presenti ".$nAziende." aziende</h2>";

        if($nAziende != 0) {
            echo "<table border='1'>";
            echo "  <tr>
                        <th>CodA</th>
                        <th>Nome Azienda</th>
                        <th>Ragione Sociale</th>
                        <th>Via</th>
                        <th>Civ</th>
                        <th>Città</th>
                        <th>Email</th>
                        <th>CAP</th>
                    </tr>";

            $tab = $results->fetchAll(PDO::FETCH_ASSOC);
            $i = 0;

            foreach($tab as $riga) {
                $colore = ($i % 2 == 0) ? "bgcolor='lightgray'" : "";
                
                echo "<tr $colore>
                        <td>                           
                            <a href='visualizzaAzienda.php?cf=".$riga["codA"]."'>
                                ".$riga["codA"]."
                            </a>
                        </td>
                        <td>".$riga["nomeAzienda"]."</td>
                        <td>".$riga["ragioneSociale"]."</td>
                        <td>".$riga["ind_via"]."</td>
                        <td>".$riga["ind_civ"]."</td>
                        <td>".$riga["ind_citta"]."</td>
                        <td><a href='mailto:".$riga["email"]."'>".$riga["email"]."</a></td>
                        <td>".$riga["cap"]."</td>
                      </tr>";
                $i++;
            }
            echo "</table>";
        }

      } catch(PDOException $e) {
        echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
      }
    ?>
  </body>
</html>