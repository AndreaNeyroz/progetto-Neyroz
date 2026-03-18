<!DOCTYPE html>
<html lang="en">
<head>
<title>Job Recruiting Platform</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="file.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
</head>
<body>

<!-- barra di navigazione/MENU -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">HOME</a>
	<a href="#SIGN-IN" class="w3-bar-item w3-button w3-padding-large w3-hide-small">SIGN-IN</a>
	<a href="#LOGIN" class="w3-bar-item w3-button w3-padding-large w3-hide-small">LOGIN</a>
    <a href="#AZIENDE" class="w3-bar-item w3-button w3-padding-large w3-hide-small">AZIENDE</a>
    <a href="#CONTATTI" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CONTATTACI</a>
<!--
   <a href="stampaTabellaCandidati.php">
   <button type="button" class="w3-button w3-white w3-border">Vai alla pagina</button>
-->
	</a>
    <div class="w3-dropdown-hover w3-hide-small">
      </div>
    </div>
    <a href="javascript:void(0)" class=<i class="fa fa-search"></i></a>
  </div>
</div>

<!-- i tasti all'inizio interagiscono qua -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#NOI" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">HOME</a>
  <a href="#LOGIN" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">LOGIN</a>
  <a href="#SIGN-IN" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">SIGN-IN</a>
  <a href="#AZIENDE" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">AZIENDE</a>
  <a href="#CONTATTI" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTATTI</a>
<!--  
	<a href="stampaTabellaCandidati.php">
		<button type="button" class="w3-button w3-white w3-border">Tabella Candidati</button>
	</a>
-->


</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:50px">

  <!-- Automatic Slideshow Images -->
  <div class="mySlides w3-display-container w3-center">
    <img src="immagini/iconaValigia.png" style="width:3%">

  </div>
  
  <!-- chi siamo + foto collaboratori -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="NOI">
    <h2 class="w3-wide">CHI SIAMO</h2>
    <p class="w3-justify">Il nostro sito ti aiuterà a trovare lavoro più facilmente tramite la funzionalità di metterti in contatto con la azienda che preferisci. Buon lavoro!</p>
    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <p>Ezio Greggio</p>
        <img src="immagini/greggio.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Karim Musa - Yotobi</p>
        <img src="immagini/yotobi.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Paolo Bonolis</p>
        <img src="immagini/bonolis.jpg" class="w3-round" alt="Random Name" style="width:60%">
      </div>
    </div>
  </div>
  
  <!-- SIGN IN  -->
   <form action="/action_page.php" target="_blank">
  <div class="w3-black" id="SIGN-IN">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">SIGN-IN</h2>
      <p class="w3-opacity w3-center"><i>Registrati!</i></p><br>
		<ul class="w3-ul w3-border w3-white w3-text-grey">
		<input class="w3-input w3-border" type="nome" placeholder="Nome" required name="Nome">
        <input class="w3-input w3-border" type="cognome" placeholder="Cognome" required name="Cognome">
        <input class="w3-input w3-border" type="username" placeholder="Username" required name="Username">
        <input class="w3-input w3-border" type="email" placeholder="Email" required name="Email">
        <input class="w3-input w3-border" type="password" placeholder="Password" required name="Password">
		<button class="w3-button w3-black w3-section w3-right" type="submit">INVIA</button>
      </ul>

      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">

        </div>
      </div>
	  </form>
  <!-- LOGIN -->
   <form action="/action_page.php" target="_blank">
  <div class="w3-black" id="LOGIN">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">LOGIN</h2>
      <p class="w3-opacity w3-center"><i>Accedi!</i></p><br>

      <ul class="w3-ul w3-border w3-white w3-text-grey">
        <input class="w3-input w3-border" type="username" placeholder="Username" required name="Username">
        <input class="w3-input w3-border" type="password" placeholder="Password" required name="Password">
		<button class="w3-button w3-black w3-section w3-right" type="submit">INVIA</button>
      </ul>

      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">

        </div>
      </div>
	</form>
    <!-- aziende -->

    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="AZIENDE">
    <h2 class="w3-wide">LE AZIENDE CHE COLLABORANO CON NOI</h2>
    <div class="w3-row w3-padding-32">
      <div class="w3-third">
        <p>Mitsubishi</p>
        <img src="immagini/mitsubishi.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Microsoft</p>
        <img src="immagini/microsoft.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
      </div>
      <div class="w3-third">
        <p>Eni</p>
        <img src="immagini/eni.png" class="w3-round" alt="Random Name" style="width:60%">
      </div>
    </div>
  </div>
  

  

  

  <!-- sezione contatti -->
  <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="CONTATTI">
    <h2 class="w3-wide w3-center">CONTATTACI!</h2>
    <div class="w3-row w3-padding-32">
      <div class="w3-col m6 w3-large w3-margin-bottom">
        <i class="fa fa-map-marker" style="width:30px"></i> ITALIA, MANZETTI<br>
        <i class="fa fa-phone" style="width:30px"></i> Telefono: +36 123 456 7890<br>
        <i class="fa fa-envelope" style="width:30px"> </i> Email: mail@mail.com<br>
      </div>
      <div class="w3-col m6">
        <form action="/action_page.php" target="_blank">
          <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Nome" required name="Nome">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
            </div>
          </div>
          <input class="w3-input w3-border" type="text" placeholder="Messaggio" required name="Messaggio">
          <button class="w3-button w3-section w3-right" type="submit">INVIA</button>
        </form>
      </div>
    </div>
  </div>
  



<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>