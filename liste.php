<?php
$cheminFichier = 'data/notes.csv';

if (!file_exists($cheminFichier)) {
    die("<p style='color: red;'>Erreur : le fichier <code>{$cheminFichier}</code> n'existe pas. Veuillez d'abord saisir des apprenants.</p>");
}

function determinerMention(float $moyenne): string
{
    if ($moyenne >= 16) return 'Très bien';
    if ($moyenne >= 14) return 'Bien';
    if ($moyenne >= 12) return 'Assez bien';
    if ($moyenne >= 10) return 'Passable';
    return 'Ajourné';
}

$debutCsv = microtime(true);
$lignesCsv = [];
$sommeCsv = 0;
$nbCsv = 0;

$handleCsv = fopen($cheminFichier, 'r');
if ($handleCsv !== false) {
    while (($data = fgetcsv($handleCsv, 1000, ';')) !== false) {
        if (count($data) >= 4) {
            $moyenne = (float)$data[3];
            $sommeCsv += $moyenne;
            $nbCsv++;
            $lignesCsv[] = [
                'nom'     => trim($data[0]),
                'info'    => (float)$data[1],
                'math'    => (float)$data[2],
                'moyenne' => $moyenne,
                'mention' => determinerMention($moyenne)
            ];
        }
    }
    fclose($handleCsv);
}
$tempsCsv = round((microtime(true) - $debutCsv) * 1000, 3);
$moyenneGenCsv = $nbCsv > 0 ? round($sommeCsv / $nbCsv, 2) : 0;


$debutBasNiveau = microtime(true);
$lignesBasNiveau = [];
$sommeBasNiveau = 0;
$nbBasNiveau = 0;

$handleBasNiveau = fopen($cheminFichier, 'r');
if ($handleBasNiveau !== false) {
    while (!feof($handleBasNiveau)) {
        $ligne = fgets($handleBasNiveau);
        if ($ligne === false || trim($ligne) === '') {
            continue;
        }
        $data = explode(';', trim($ligne));
        if (count($data) >= 4) {
            $moyenne = (float)$data[3];
            $sommeBasNiveau += $moyenne;
            $nbBasNiveau++;
            $lignesBasNiveau[] = [
                'nom'     => trim($data[0]),
                'info'    => (float)$data[1],
                'math'    => (float)$data[2],
                'moyenne' => $moyenne,
                'mention' => determinerMention($moyenne)
            ];
        }
    }
    fclose($handleBasNiveau);
}
$tempsBasNiveau = round((microtime(true) - $debutBasNiveau) * 1000, 3);
$moyenneGenBasNiveau = $nbBasNiveau > 0 ? round($sommeBasNiveau / $nbBasNiveau, 2) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Comparaison simultanée des deux lectures CSV</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            padding: 30px 20px;
        }
        h1 {
            text-align: center;
            font-size: 1.6rem;
            color: #0f172a;
            margin-bottom: 25px;
        }
        .container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .colonne {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            flex: 1 1 500px;
            max-width: 600px;
        }
        .colonne h2 {
            font-size: 1.15rem;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            color: #2563eb;
        }
        .badge {
            display: inline-block;
            font-size: 0.75rem;
            background: #e0e7ff;
            color: #3730a3;
            padding: 3px 8px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            text-align: left;
            font-size: 0.9rem;
        }
        th { background: #f8fafc; font-weight: 600; color: #475569; }
        .ajourne td { background-color: #fee2e2; color: #991b1b; font-weight: 600; }
        .stats-box {
            margin-top: 15px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<h1>Comparaison des deux méthodes de lecture en simultané</h1>

<div class="container">
    <div class="colonne">
        <h2>Méthode 1 : fgetcsv</h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Info</th>
                    <th>Math</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignesCsv as $e): ?>
                    <tr class="<?= $e['moyenne'] < 10 ? 'ajourne' : '' ?>">
                        <td><?= htmlspecialchars($e['nom']) ?></td>
                        <td><?= $e['info'] ?></td>
                        <td><?= $e['math'] ?></td>
                        <td><strong><?= $e['moyenne'] ?></strong></td>
                        <td><?= htmlspecialchars($e['mention']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="stats-box">
            <p>Étudiants lus : <strong><?= $nbCsv ?></strong></p>
            <p>Moyenne de classe : <strong><?= $moyenneGenCsv ?> / 20</strong></p>
            <p>Temps d'exécution : <strong><?= $tempsCsv ?> ms</strong></p>
        </div>
    </div>

    <
    <div class="colonne">
        <h2>Méthode 2 : Bas niveau </h2>
        

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Info</th>
                    <th>Math</th>
                    <th>Moyenne</th>
                    <th>Mention</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignesBasNiveau as $e): ?>
                    <tr class="<?= $e['moyenne'] < 10 ? 'ajourne' : '' ?>">
                        <td><?= htmlspecialchars($e['nom']) ?></td>
                        <td><?= $e['info'] ?></td>
                        <td><?= $e['math'] ?></td>
                        <td><strong><?= $e['moyenne'] ?></strong></td>
                        <td><?= htmlspecialchars($e['mention']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="stats-box">
            <p>Étudiants lus : <strong><?= $nbBasNiveau ?></strong></p>
            <p>Moyenne de classe : <strong><?= $moyenneGenBasNiveau ?> / 20</strong></p>
            <p>Temps d'exécution : <strong><?= $tempsBasNiveau ?> ms</strong></p>
        </div>
    </div>
</div>

</body>
</html>