<?php
$tipo = 'Utente'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['opzioni'])) {
    $tipo = $_POST['opzioni'];
}

if (isset($_POST['invia_registrazione'])) {
    $errori = [];
    if ($tipo == 'Utente') {
        $obbligatori = ['nome', 'cognome', 'email', 'codice_fiscale', 'data_nascita', 'username', 'password'];
    } else {
        $obbligatori = ['nome_azienda', 'ragione_sociale', 'email_aziendale', 'via', 'civico', 'citta', 'cap', 'username', 'password'];
    }

    foreach ($obbligatori as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === "") {
            $errori[] = "Il campo $campo è obbligatorio.";
        }
    }

    if (empty($errori)) {
        include('registrazioneUtente.php');
        exit();
    } else {
        echo "<script>alert('Attenzione: compila tutti i campi obbligatori!'); window.history.back();</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Recruiting Pro</title>
    <link rel="stylesheet" href="styleregister.css">
    <style>
        /* Reset e Base */
        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            width: 500px;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            color: #333;
        }

        h1 {
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 800;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Layout a griglia per campi doppi */
        .input-group {
            display: flex;
            gap: 15px;
        }

        .input-box {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .input-box input, .select-custom {
            width: 100%;
            height: 50px;
            background: #f8f9fa;
            border: 2px solid #eee;
            outline: none;
            border-radius: 12px;
            font-size: 16px;
            color: #333;
            padding: 0 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .input-box input:focus, .select-custom:focus {
            border-color: #0dcaf0;
            background: #fff;
            box-shadow: 0 0 10px rgba(13, 202, 240, 0.1);
        }

        .label-tipo {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #555;
            font-size: 0.85rem;
        }

        .select-custom {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
        }

        .btn {
            width: 100%;
            height: 55px;
            background: #000;
            border: none;
            outline: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            font-size: 17px;
            color: #fff;
            font-weight: 700;
            margin-top: 10px;
            transition: transform 0.2s, background 0.3s;
        }

        .btn:hover {
            background: #222;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #0dcaf0;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Per dispositivi mobili */
        @media (max-width: 550px) {
            .wrapper { width: 90%; padding: 25px; }
            .input-group { flex-direction: column; gap: 0; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Registrati</h1>
            
            <div class="input-box">
                <label class="label-tipo">Tipo Account</label>
                <select name="opzioni" class="select-custom" onchange="this.form.submit()">
                    <option value="Utente" <?php if($tipo == 'Utente') echo 'selected'; ?>>Utente Privato</option>
                    <option value="Azienda" <?php if($tipo == 'Azienda') echo 'selected'; ?>>Azienda </option>
                </select>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 25px;">

            <?php if ($tipo == 'Utente'): ?>
                <div class="input-group">
                    <div class="input-box"><input type='text' name='nome' placeholder="Nome" required/></div>
                    <div class="input-box"><input type='text' name='cognome' placeholder="Cognome" required/></div>
                </div>
                <div class="input-box"><input type='email' name='email' placeholder="Email personale" required/></div>
                <div class="input-box"><input type='text' name='codice_fiscale' placeholder="Codice Fiscale" required/></div>
                
                <div class="input-group">
                    <div class="input-box">
                        <label class="label-tipo">Data di Nascita</label>
                        <input type='date' name='data_nascita' required/>
                    </div>
                    <div class="input-box">
                        <label class="label-tipo">Genere</label>
                        <select name="genere" class="select-custom" required>
                            <option value="M">Maschio</option>
                            <option value="F">Femmina</option>
                        </select>
                    </div>
                </div>

                <div class="input-box"><input type='tel' name='telefono' placeholder="Telefono / Cellulare"/></div>
                <div class="input-box"><input type='url' name='link_cv' placeholder="Link al tuo CV (es. LinkedIn o Drive)"/></div>
                <div class="input-box"><input type='text' name='esperienze' placeholder="Breve sintesi esperienze"/></div>

            <?php else: ?>
                <div class="input-box"><input type='text' name='nome_azienda' placeholder="Nome Azienda" required/></div>
                <div class="input-box"><input type='text' name='ragione_sociale' placeholder="Ragione Sociale" required/></div>
                <div class="input-box"><input type='email' name='email_aziendale' placeholder="Email Aziendale" required/></div>
                
                <div class="input-group">
                    <div class="input-box" style="flex: 3;"><input type='text' name='via' placeholder="Via / Piazza" required/></div>
                    <div class="input-box" style="flex: 1;"><input type='text' name='civico' placeholder="N°" required/></div>
                </div>

                <div class="input-group">
                    <div class="input-box" style="flex: 2;"><input type='text' name='citta' placeholder="Città" required/></div>
                    <div class="input-box" style="flex: 1;"><input type='text' name='cap' placeholder="CAP" required/></div>
                </div>
            <?php endif; ?>

            <div style="margin-top: 10px; border-top: 1px dashed #ddd; padding-top: 20px;">
                <div class="input-group">
                    <div class="input-box"><input type='text' name='username' placeholder="Scegli Username" required/></div>
                    <div class="input-box"><input type='password' name='password' placeholder="Scegli Password" required/></div>
                </div>
            </div>

            <button type="submit" name="invia_registrazione" class="btn">CREA ACCOUNT</button>

            <div class="login-link">
                <p>Hai già un account? <a href="login_utenti.php">Accedi qui</a></p>
            </div>
        </form>
    </div>
</body>
</html>