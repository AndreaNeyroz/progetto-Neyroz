<html>
	<head>
	</head>
	<body>
		<p>Registrati</p>
		<form id="loginForm" method='post' action='registrazioneUtente.php'>
			<label> Nome: </label>
			<input type='text' name='nome' value='esempioNome'/>
			<br>
			<label> Cognome: </label>
			<input type='text'name='cognome' value='esempioCognome'/>
			<br>
			<label> Username: </label>
			<input type='text'name='username' value='esempioUsername'/>
			<br>
			<label> Email: </label>
			<input type='email'name='email' value='esempio@mail.com'/> 
			<br>
			<label> Password: </label>
			<input id='pwd' type='password'name='password' value='esempio'/>
			<br>
			<button type='submit'>Registrati</button>
		</form>
		
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