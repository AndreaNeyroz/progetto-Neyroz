<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1>Tabella Candidati</h1>
    <?php
	include ("inc/datiConnessione.php");
     
	 
      try {
        include ("inc/startConn.php");
	?>
		<!-- modulo di tipo get; action indica la pagina di destinazione del modulo. # manda questa pagina del modulo a me stesso-->
		<form method="get" action="#">
		
		<!-- filtra per genere-->
		<label for ="genere">Genere:</label>
		<select name="genere">
		<!-- &it; corrisponde a '>' mentre &gt; corrisponde a '>' -->
		<option value="all">&lt; Tutti &gt;</option>
		<?php
		$sqlGeneri ="SELECT DISTINCT genere FROM candidati";
		echo $sqlGeneri;
		$resultsGeneri = $conn->query($sqlGeneri);
		$generi = $resultsGeneri->fetchAll(PDO::FETCH_ASSOC);
		foreach($generi as $g) {
			echo "<option";
		// nell'array $_GET trovo tutte le variabili compilate dal modulo di tipo GET 
		// il nome della variabile corrisponde al nome del campo es: <select name="genere"
		// con la funzione isset controllo se la variabile è mai stata settata
			if(isset($_GET["genere"]) && $_GET["genere"]==$g["genere"])
				echo " selected";
			// quindi stampa il genere
			echo ">".$g["genere"]."</option>";
			
		}
		$orderBy = false;
		?>
		</select>
		
		
		<label for="OrdinaPer">Ordina per:</label>
		<select name="ordinaPer">
			<option value "no">&It; Nessun ordinamento &gt:</option>
			<option value="nome ASC"
			<?php
				if(isset($_GET["ordinaPer"])&& $_GET["ordinaPer"]=="nome ASC"){
					echo "selected";
					$orderBy=true;		
			}
			?>>Nome A-Z</option>
			<option value = "nome DESC"
			<?php 
			if (isset($_GET["ordinaPer"])&& $_GET["ordinaPer"]=="nome DESC"){
				echo "selected";
				$orderBy=true;
				}
			?>>Nome Z-A</option>
		</select>
		<input type="submit" value="Invia"/>
		</form>
		
		<?php
		
        $sql = "SELECT * FROM candidati";
		if(isset($_GET["genere"]) && $_GET["genere"]!="all")
			$sql = $sql . " WHERE genere = '".$_GET["genere"]."'";
		
		if($orderBy)
			$sql.=" ORDER BY $_GET[ordinaPer]";
		
		echo $sql;
		
        // il metodo query() esegue il codice SQL, il metodo restituisce un DataSet
        $results = $conn->query($sql); // conn.query(sql);
        // della classe DataSet esiste il metodo rowCount()
        $nCand = $results->rowCount();
        if($nCand == 0)
            echo "<h2>NON sono presenti candidati</h2>";
        else if($nCand == 1)
            echo "<h2>E' presente 1 solo candidato</h2>";
        else
            echo "<h2>Sono presenti ".$results->rowCount()." candidati</h2>";
        // stampo i tag per la Tabella
        /*
        tag utili:
          table -> Tabella (che racchiude righe)
          tr    -> table row (riga che racchiude i dati)
          th    -> table header (intestazione - grassetto e centrato)
          td    -> table data (dato normale)
        */
        if($nCand != 0) {
            echo "<table>";
            echo "  <tr>
                        <th>CF</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Data Di Nascita</th>
                        <th>Genere</th>
                        <th>CV</th>
                        <th>Esperienze</th>
						<th>numeroTelefono</th>
						<th>email</th>
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
                        <a href='visualizzaCandidato.php?cf=".$riga["codF"]."'>
                        ".$riga["codF"]."
                        </a>
                    </td>
                    <td>".$riga["nome"]."</td>
                    <td>".$riga["cognome"]."</td>
                    <td>".$riga["dataNascita"]."</td>
                    <td>".$riga["genere"]."</td>
                    <td>".$riga["link_CV"]."</td>
                    <td>".$riga["esperienze"]."</td>
					<td>".$riga["numeroTelefono"]."</td>
					<td>".$riga["email"]."</td>
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