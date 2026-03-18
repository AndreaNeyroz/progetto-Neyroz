<html>
    <head>
        <noscript><style> #loginForm{display:none;}</style></noscript>
    </head>
    <body>
		<?php
		include("checkLogin.php");
		if($logged)
			header("location: profile.php");
			
			
			
			if(isset($_SESSION["errors"])) {
				$errori = $_SESSION["errors"];
				foreach(array_keys($errori) as $k)
					echo "<h2 style='color:red'>Errore: $errori[$k]</h2>";
				$username = $_SESSION["username"];
				session_unset();
				session_destroy();
				session_start();
			}
		?>
        <form id="loginForm" method='post' action='login_utenti.php'>
            <label for="username">Username: </label>
            <input type="text" name='username' value="<?php if(isset($username)) echo $username; ?>">
            <br>
            <label for="password">Password: </label>
            <input id="pwd" type="password" name='password' value="">
            <br>
            <button type='submit'>Login</button>
        </form>

        <noscript>
            <p>Il tuo browser non supporta JavaScript è necessario abilitarlo per proseguire</p>
        </noscript>

        <script>
			// Function to hash string with SHA-256
			async function sha256(message) {
				const msgBuffer = new TextEncoder().encode(message); // encode as UTF-8
				const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer); // hash
				const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
				const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join(''); // convert bytes to hex string
				return hashHex;
			}

			document.getElementById('loginForm').addEventListener('submit', async (e) => {
				e.preventDefault(); // Stop form from submitting immediately
				
				const passwordInput = document.getElementById('pwd');
				const passwordValue = passwordInput.value;
				
				// Hash the password
				const hashed = await sha256(passwordValue);
				
				// Replace with hash
				passwordInput.value = hashed;
				
				console.log('Original hashed before submission:', hashed);
				
				// Submit form
				e.target.submit();      
                e.target.reset();
			});
		</script>
    </body>
</html>

<?php

?>