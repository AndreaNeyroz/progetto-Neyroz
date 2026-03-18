<html>
  <head>
	<title>Aziende</title>
	<link rel='css/styles.css' />
  </head>
  <body>
    <h1>Aziende</h1>
	<nav>
		<ul>
			<a href='index.php'><li>Home</li></a>
			<a href='aziende.php'><li>Aziende</li></a>
			<a href='annunci.php'><li>Annunci</li></a>
			<a href='login.php'><li>Login</li></a>
		</ul>
	</nav>
	
    <?php
	include ("inc/datiConnessione.php");
     
      try {
        include ("inc/startConn.php");
	?>
		<!-- modulo di tipo get; action indica la pagina di destinazione del modulo. # manda questa pagina del modulo a me stesso-->
		<form method="get" action="#">
		
		</select>
		
		<?php
		
        $sql = "SELECT * FROM Aziende";
		if(isset($_GET["nomeAzienda"]) && $_GET["nomeAzienda"]!="all")
			$sql = $sql . " WHERE nomeAzienda = '".$_GET["nomeAzienda"]."'";
		
		
		echo $sql;
		
        // il metodo query() esegue il codice SQL, il metodo restituisce un DataSet
        $results = $conn->query($sql); // conn.query(sql);
        // della classe DataSet esiste il metodo rowCount()
        $nAziende = $results->rowCount();
        if($nAziende == 0)
            echo "<h2>NON sono presenti aziende</h2>";
        else if($nAziende == 1)
            echo "<h2>E' presente 1 sola azienda</h2>";
        else
            echo "<h2>Sono presenti ".$results->rowCount()." aziende</h2>";
        // stampo i tag per la Tabella
        /*
        tag utili:
          table -> Tabella (che racchiude righe)
          tr    -> table row (riga che racchiude i dati)
          th    -> table header (intestazione - grassetto e centrato)
          td    -> table data (dato normale)
        */
        if($nAziende != 0) {
            echo "<table>";
            echo "  <tr>
                        <th>CodA</th>
                        <th>nomeAzienda</th>
                        <th>ragioneSociale</th>
                        <th>ind_via</th>
                        <th>ind_civ</th>
                        <th>ind_citta</th>
                        <th>email</th>
						<th>cap</th>
                    </tr>";
            // il metodo fetchAll() restituisce un array indicizzato di record. Ogni record è rappresentato da un array del tipo definito nel parametro (es: PDO::FETCH_ASSOC)
            // le chiavi dell'array associativo sono i nomi dei campi della tabella risultante dalla query
            $tab = $results->fetchAll(PDO::FETCH_ASSOC);
       
            // alternativa con il for classico
            //  for($i=0; $i<count($tab); $i++) {
            //    $riga = $tab[$i];
   
            $i = 0;
            // con un foreach scorro tutti i record della Tabella
            foreach($tab as $riga) {
                // stampo la riga con i dati
                echo "<tr ";
                // se è pari cambio lo sfondo in grigio chiaro
                if($i%2==0)
                    echo "bgcolor='lightgray'";
                // stampo i dati nella riga
                // all'ISBN metto un link ad una pagina "visualizzaLibro" a cui passo il parametro isbn del libro cliccato
                echo ">
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
            // aggiorno il contatore
            $i++;
            }
            echo "</table>";
        }
      // se saltano fuori exception legate alla connessione dal database le gestisco qui
      } catch(PDOException $e) {
        // stampando il messaggio di errore
        echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
      }
    ?>
  </body>
</html>