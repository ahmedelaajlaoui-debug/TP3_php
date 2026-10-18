<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif et Enregistrement CSV</title>
</head>
<body>
<?php
const NOTE_MIN = 0;
const NOTE_MAX = 20;

$erreurs = [];

if (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math'])) {
    $erreurs[] = "Le formulaire n'a pas été soumis correctement.";
} else {
    if (empty(trim($_POST['nom']))) {
        $erreurs[] = "Le nom de l'étudiant est obligatoire.";
    }

    if ($_POST['note_info'] === '' || (empty($_POST['note_info']) && $_POST['note_info'] !== '0')) {
        $erreurs[] = "La note d'informatique est requise.";
    }

    if ($_POST['note_math'] === '' || (empty($_POST['note_math']) && $_POST['note_math'] !== '0')) {
        $erreurs[] = "La note de mathématiques est requise.";
    }

    if (empty($erreurs)) {
        if (!is_numeric($_POST['note_info']) || !is_numeric($_POST['note_math'])) {
            $erreurs[] = "Les notes doivent être des valeurs numériques.";
        } else {
            $note_info = (float)$_POST['note_info'];
            $note_math = (float)$_POST['note_math'];

            if ($note_info < NOTE_MIN || $note_info > NOTE_MAX) {
                $erreurs[] = "La note d'informatique doit être comprise entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
            }

            if ($note_math < NOTE_MIN || $note_math > NOTE_MAX) {
                $erreurs[] = "La note de mathématiques doit être comprise entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
            }
        }
    }
}

if (!empty($erreurs)) {
    echo "<h3>Erreur(s) rencontrée(s) :</h3><ul>";
    foreach ($erreurs as $erreur) {
        echo "<li style='color: red;'>" . htmlspecialchars($erreur) . "</li>";
    }
    echo "</ul>";
    echo '<p><a href="saisie.html">Retourner au formulaire</a></p>';
} else {
    $nom = trim($_POST['nom']);
    $moyenne = round(($note_info + $note_math) / 2, 2);

    $fichierChemin = 'data/notes.csv';

    $descripteur = fopen($fichierChemin, 'a');

    if ($descripteur !== false) {
        $ligne = [$nom, $note_info, $note_math, $moyenne];

        fputcsv($descripteur, $ligne, ';');

        fclose($descripteur);

        echo "<p style='color: green; font-weight: bold;'>Enregistrement ajouté avec succès dans <code>data/notes.csv</code> !</p>";
    } else {
        echo "<p style='color: red;'>Impossible d'ouvrir le fichier CSV. Vérifiez que le dossier 'data' existe et dispose des droits d'écriture.</p>";
    }

    echo "<h2>Récapitulatif de l'étudiant</h2>";
    echo "<ul>";
    echo "<li>Nom : " . htmlspecialchars($nom) . "</li>";
    echo "<li>Note Informatique : " . htmlspecialchars((string)$note_info) . " / 20</li>";
    echo "<li>Note Mathématiques : " . htmlspecialchars((string)$note_math) . " / 20</li>";
    echo "<li>Moyenne : <strong>{$moyenne} / 20</strong></li>";
    echo "</ul>";
    echo '<p><a href="saisie.html">Ajouter un autre apprenant</a></p>';
}
?>
</body>
</html>