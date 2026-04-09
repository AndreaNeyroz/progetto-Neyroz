<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Recruiting Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .logout-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 90%;
        }
        h1 {
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="logout-card">
        <div class="mb-4">
        </div>
        <h1>Sessione chiusa</h1>
        <p>Hai effettuato il logout con successo. A presto su Recruiting PRO!</p>
        
        <a href="Home.php" class="btn btn-info btn-lg rounded-pill px-5 fw-bold text-white shadow-sm">
            Torna alla Home
        </a>
    </div>

</body>
</html>