<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background: #f8fafc; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        a { color: #dc2626; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <h2>Bienvenue sur votre profil</h2>
    <p>Bonjour, <strong><?= htmlspecialchars($_SESSION['login']) ?></strong> !</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</div>

</body>
</html>