<?php
if (!defined('ETABLISSEMENT')) {
    define('ETABLISSEMENT', 'FSSM');
}

const NOTE_MIN = 0;
const NOTE_MAX = 20;

$erreurs = [];
$succes = false;
$nom = '';
$note_info = 0.0;
$note_math = 0.0;
$moyenne = 0.0;

// Traitement des données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math'])) {
        $erreurs[] = "Le formulaire n'a pas été soumis correctement.";
    } else {
        $nom = trim($_POST['nom']);

        if (empty($nom)) {
            $erreurs[] = "Le nom de l'étudiant est obligatoire.";
        }

        if ($_POST['note_info'] === '' || (!is_numeric($_POST['note_info']))) {
            $erreurs[] = "La note d'informatique doit être un nombre valide.";
        } else {
            $note_info = (float)$_POST['note_info'];
            if ($note_info < NOTE_MIN || $note_info > NOTE_MAX) {
                $erreurs[] = "La note d'informatique doit être entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
            }
        }

        if ($_POST['note_math'] === '' || (!is_numeric($_POST['note_math']))) {
            $erreurs[] = "La note de mathématiques doit être un nombre valide.";
        } else {
            $note_math = (float)$_POST['note_math'];
            if ($note_math < NOTE_MIN || $note_math > NOTE_MAX) {
                $erreurs[] = "La note de mathématiques doit être entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
            }
        }

        // Si aucune erreur, enregistrement dans le CSV
        if (empty($erreurs)) {
            $moyenne = round(($note_info + $note_math) / 2, 2);

            if (!is_dir('data')) {
                mkdir('data', 0777, true);
            }

            $fichier = fopen('data/notes.csv', 'a');
            if ($fichier !== false) {
                fputcsv($fichier, [$nom, $note_info, $note_math, $moyenne], ';');
                fclose($fichier);
                $succes = true;
            } else {
                $erreurs[] = "Impossible d'accéder au fichier CSV en écriture.";
            }
        }
    }
} else {
    $erreurs[] = "Aucune donnée n'a été reçue via la méthode POST.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ETABLISSEMENT ?> - Gestion des Notes</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            max-width: 760px;
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            text-align: center;
        }
        header h1 {
            color: #0f172a;
            font-size: 1.8rem;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            width: 100%;
            max-width: 760px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .erreur-box {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .erreur-box ul {
            margin-left: 20px;
            margin-top: 8px;
        }
        .succes-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin-top: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { padding: 12px 18px; text-align: left; }
        th { background: #f1f5f9; color: #475569; font-size: 0.85rem; }
        td { border-bottom: 1px solid #f1f5f9; }
        tbody tr:last-child td { border-bottom: none; }
        .liens {
            margin-top: 25px;
            display: flex;
            gap: 15px;
        }
        .liens a {
            text-decoration: none;
            color: #2563eb;
            font-weight: 600;
        }
        .liens a:hover { text-decoration: underline; }
        footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #64748b;
            text-align: center;
            width: 100%;
            max-width: 760px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenue à : <?= ETABLISSEMENT ?></h1>
</header>

<main class="card">
    <?php if (!empty($erreurs)): ?>
        <div class="erreur-box">
            <strong>Erreur(s) lors du traitement :</strong>
            <ul>
                <?php foreach ($erreurs as $erreur): ?>
                    <li><?= htmlspecialchars($erreur) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($succes): ?>
        <div class="succes-box">
            Données validées et enregistrées avec succès dans <code>data/notes.csv</code> !
        </div>

        <h2>Récapitulatif de la saisie</h2>
        <table>
            <tr>
                <th>Nom</th>
                <td><?= htmlspecialchars($nom) ?></td>
            </tr>
            <tr>
                <th>Note Informatique</th>
                <td><?= $note_info ?> / 20</td>
            </tr>
            <tr>
                <th>Note Mathématiques</th>
                <td><?= $note_math ?> / 20</td>
            </tr>
            <tr>
                <th>Moyenne</th>
                <td><strong><?= $moyenne ?> / 20</strong></td>
            </tr>
        </table>
    <?php endif; ?>

    <div class="liens">
        <a href="saisie.html">&larr; Saisir un autre étudiant</a>
        <a href="liste.php">Consulter la liste complète &rarr;</a>
    </div>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> - <?= ETABLISSEMENT ?></p>
</footer>

</body>
</html>