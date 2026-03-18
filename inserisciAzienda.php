<html>
  <head>
  </head>
  <body>
    <?php
      // controllo se è arrivato qualcosa come parametro
      // controllo se NON è stato settato "is set" il parametro "codA"
      if(!isset($_GET["codA"])) {
        echo "<h2 style='color:red;'>ATTENZIONE codice azienda NON SETTATO</h2>";
      } else { // è stato settato
        $codA = $_GET["codA"];
        // controllo se il contenuto del parametro è vuoto
        if(empty($codA)) {
          echo "<h2 style='color:red;'>ATTENZIONE codice azienda MANCANTE</h2>";
        } else { // è settato e non è vuoto

        include("inc/datiConnessione.inc");
       
        try{
          include("inc/startConn.inc");
   
          $sql = "SELECT * FROM Aziende WHERE codA=$codA";
          $results = $conn->query($sql);
          $nLibri = $results->rowCount();
          if($nLibri == 0)
              echo "<h2 style='color:red;'>ATTENZIONE codize azienda NON TROVATO</h2>";
          else if($nLibri == 1) {
              // con la fetch estraggo semplicemenre il prossimo elemento nel formato specificato dal parametro
              $Aziende = $results->fetch(PDO::FETCH_ASSOC);
              // nome azienda
              echo "<h1>.$Aziende[nomeAzienda].</h1>"; 
              echo "<h1>$Aziende[ragioneSociale] ($Aziende[email])</h1>";
	
              echo "</i></h2>";
			  
			  echo "<img src='img/".$libro["FKLibro"]."-".$libro["NOrd"].".".$libro["Estensione"]."'/>";
                 
              /*
              scrivete voi il codice per mostrare i dettagli del libro
              Titolo come titolo della pagina
              Dettagli libro
              Dettagli autore
              etc...
              */
              }
            // se saltano fuori exception legate alla connessione dal database le gestisco qui
          } catch(PDOException $e) {
              // stampando il messaggio di errore
              echo "<h2 style='color:red; font-weight:bold'>".$e->getMessage()."</h2>";
          } 
        }

      }



     
    ?>
  </body>
</html>