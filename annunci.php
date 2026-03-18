<html>
  <head>
	<title>Annunci</title>
	<link rel='css/styles.css' />
  </head>
  <body>
    <h1>Annunci di lavoro</h1>
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
		
        $sql = "SELECT * FROM ((Annunci_lavoro INNER JOIN Settori ON (FKCodSett=CodSett)) INNER JOIN Aziende ON (FKCodA=CodA)) INNER JOIN Contratti ON (FKCodC = CodC)";
		if(isset($_GET["nomeAzienda"]) && $_GET["nomeAzienda"]!="all")
			$sql = $sql . " WHERE nomeAzienda = '".$_GET["nomeAzienda"]."'";
		
		
		echo $sql;
		
        // il metodo query() esegue il codice SQL, il metodo restituisce un DataSet
        $results = $conn->query($sql); // conn.query(sql);
        // della classe DataSet esiste il metodo rowCount()
		
        $nAnnunci = $results->rowCount();
        if($nAnnunci == 0)
            echo "<h2>NON sono presenti annunci di lavoro</h2>";
        else if($nAnnunci == 1)
            echo "<h2>E' presente 1 solo annuncio di lavoro</h2>";
        else
            echo "<h2>Sono presenti ".$results->rowCount()." annunci di lavoro</h2>";
        // stampo i tag per la Tabella
        /*
        tag utili:
          table -> Tabella (che racchiude righe)
          tr    -> table row (riga che racchiude i dati)
          th    -> table header (intestazione - grassetto e centrato)
          td    -> table data (dato normale)
        */
        if($nAnnunci != 0) {
            echo "<table>";
            echo "  <tr>
                        <th>Cod annuncio</th>
                        <th>Titolo</th>
                        <th>Requisiti</th>
                        <th>Descrizione</th>
                        <th>Durata contratto</th>
                        <th>RAL</th>
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
                        <a href='visualizzaAnnuncio.php?cf=".$riga["codAnl"]."'>
                        ".$riga["codAnl"]."
                        </a>
                    </td>
                    <td>".$riga["titolo"]."</td>
                    <td>".$riga["requisiti"]."</td>
                    <td>".$riga["descrizione"]."</td>
                    <td>".$riga["durataContrattoGiorni"]."</td>
					<td>".$riga["Ral"]."</td>
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