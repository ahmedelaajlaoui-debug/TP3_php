<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: profil.php");
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginSaisi = trim($_POST['login'] ?? '');

    if (!empty($loginSaisi)) {
        $_SESSION['login'] = $loginSaisi;

        setcookie("dernier_login", $loginSaisi, time() + 86400, "/");

        header("Location: profil.php");
        exit;
    } else {
        $erreur = "Veuillez entrer un identifiant.";
    }
}

$loginMemoire = $_COOKIE['dernier_login'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            padding: 32px 28px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 360px;
            border: 1px solid #e2e8f0;
        }

        h2 {
            font-size: 1.35rem;
            color: #0f172a;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .erreur {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.88rem;
            margin-bottom: 16px;
            border: 1px solid #fecdd3;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            margin-bottom: 18px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        button {
            width: 100%;
            background: #2563eb;
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
        }

        button:hover {
            background: #1d4ed8;
        }

        button:active {
            transform: scale(0.99);
        }

        .info-cookie {
            margin-top: 15px;
            font-size: 0.78rem;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Connexion</h2>

    <?php if (!empty($erreur)): ?>
        <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <label for="login">Votre Login :</label>
        <input 
            type="text" 
            id="login" 
            name="login" 
            value="<?= htmlspecialchars($loginMemoire) ?>" 
            placeholder="Ex: Ahmed" 
            required 
            autofocus
        >
        <button type="submit">Se connecter</button>
    </form>

    <?php if (!empty($loginMemoire)): ?>
        <p class="info-cookie">Identifiant mémorisé depuis votre dernière visite.</p>
    <?php endif; ?>
</div>

</body>
</html>