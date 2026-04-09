<?php
session_start();

// 1. Se l'utente è già loggato, lo rimandiamo alla Home
if (isset($_SESSION["loggato"]) && $_SESSION["loggato"] === true) {
    header("location: Home.php");
    exit();
}

// 2. Recupero messaggi di errore e dati temporanei dalla sessione
$errore_output = "";
$username_precedente = "";

if (isset($_SESSION["errors"])) {
    // Trasformiamo l'array di errori in una stringa leggibile
    $errore_output = implode("<br>", $_SESSION["errors"]);
    $username_precedente = $_SESSION["temp_username"] ?? "";
    
    // Puliamo la sessione per non mostrare l'errore al prossimo refresh manuale
    unset($_SESSION["errors"]);
    unset($_SESSION["temp_username"]);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Recruiting Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0dcaf0;
            --dark-color: #000;
            --bg-color: #f0f2f5;
            --white: #ffffff;
        }

        body {
            background: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: var(--white);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 30px;
            color: var(--dark-color);
        }

        .error-banner {
            background: #fff5f5;
            color: #ff4d4d;
            border: 1px solid #ffebeb;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: #555;
        }

        .input-box input {
            width: 100%;
            height: 50px;
            background: #f8f9fa;
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 0 15px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
            font-size: 1rem;
        }

        .input-box input:focus {
            border-color: var(--primary-color);
            background: var(--white);
            box-shadow: 0 0 8px rgba(13, 202, 240, 0.1);
        }

        .btn-login {
            width: 100%;
            height: 55px;
            background: var(--dark-color);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #222;
            transform: translateY(-2px);
        }

        .footer-links {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #777;
        }

        .footer-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>Login</h1>

        <?php if ($errore_output !== ""): ?>
            <div class="error-banner">
                <strong>Attenzione:</strong><br>
                <?php echo $errore_output; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login_utenti.php">
            <div class="input-box">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" 
                       value="<?php echo htmlspecialchars($username_precedente); ?>" required>
            </div>
            
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" name="invia_login" class="btn-login">Accedi</button>
            
            <div class="footer-links">
                <p>Non hai un account? <a href="registrazione.php">Registrati ora</a></p>
                <p><a href="Home.php" style="font-size: 0.8rem; font-weight: 400;">Torna alla Home</a></p>
            </div>
        </form>
    </div>

</body>
</html>