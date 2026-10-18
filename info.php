<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement GET</title>
</head>
<body>
<?php
if (isset($_GET['nom'], $_GET['prenom'], $_GET['sexe'])) {
    $nom = htmlspecialchars(trim($_GET['nom']));
    $prenom = htmlspecialchars(trim($_GET['prenom']));
    $sexe = $_GET['sexe'];

    $civilite = ($sexe === 'F') ? 'Madame' : 'Monsieur';

    echo "<h2>Bonjour {$civilite} {$prenom} {$nom}</h2>";
} else {
    echo "<p>Veuillez remplire la formulaire.</p>";
}
?>
</body>
</html>