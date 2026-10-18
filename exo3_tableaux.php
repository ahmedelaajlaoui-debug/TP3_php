<?php

define('ETABLISSEMENT', 'FSSM');
require 'includes/entete_inc.php';
require 'includes/menu_inc.php';
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

$modules = ["WEP2", "C", "RO"];

const SEUIL = 10;

function mention(float $note): string
{
    if ($note >= 16) {
        return 'Très bien';
    } elseif ($note >= 14) {
        return 'Bien';
    } elseif ($note >= 12) {
        return 'Assez bien';
    } elseif ($note >= SEUIL) {
        return 'Passable';
    } else {
        return "Ajourné";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices 3.1, 3.2 et 3.3 - PHP</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Inter", "Segoe UI", Roboto, sans-serif;
            background: radial-gradient(circle at top, #f8fafc, #edf2f7 85%);
            color: #334155;
            min-height: 100vh;
            padding: 50px 20px 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1.6;
        }

        h2 {
            width: 100%;
            max-width: 760px;
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin: 35px 0 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.01em;
        }

        h2::before {
            content: "";
            display: inline-block;
            width: 5px;
            height: 20px;
            border-radius: 999px;
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
        }

        pre {
            width: 100%;
            max-width: 760px;
            background: #090d16;
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 22px 24px;
            font-size: 0.88rem;
            line-height: 1.65;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.12),
                        0 4px 6px -2px rgba(15, 23, 42, 0.06);
            white-space: pre-wrap;
            word-break: break-word;
            font-family: "JetBrains Mono", "SF Mono", Consolas, Menlo, monospace;
            position: relative;
        }

        table {
            width: 100%;
            max-width: 760px;
            border-collapse: separate;
            border-spacing: 0;
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            margin-bottom: 28px;
            box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06),
                        0 2px 4px -1px rgba(15, 23, 42, 0.04);
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 16px 24px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 14px 24px;
            font-size: 0.93rem;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.15s ease;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover td {
            background-color: #f8fafc;
        }

        td:nth-child(2) {
            font-variant-numeric: tabular-nums;
            font-weight: 600;
            color: #0f172a;
        }

        .inf-seuil td {
            background-color: #fff5f5;
            color: #be123c;
        }

        .inf-seuil:hover td {
            background-color: #ffe4e6;
        }

        .inf-seuil td:nth-child(2),
        .inf-seuil td:nth-child(3) {
            font-weight: 700;
            color: #e11d48;
        }

        body {
            white-space: pre-line;
        }

        pre, table, h2 {
            white-space: normal;
        }

        pre {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>

<h2>Exercice 3.1 : Déclaration et Affichage des Modules</h2>
<pre><?php
echo "--- Affichage avec foreach ---\n";
foreach ($modules as $module) {
    echo "- " . $module . "\n";
}

echo "\n--- Affichage par indices ---\n";
for ($i = 0; $i < count($modules); $i++) {
    echo "Indice $i : " . $modules[$i] . "\n";
}
?></pre>

<h2>Exercice 3.2 : Tableau des Résultats</h2>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Note</th>
            <th>Mention</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($notes as $nom => $note): ?>
            <tr class="<?= $note < SEUIL ? 'inf-seuil' : '' ?>">
                <td><?= htmlspecialchars($nom) ?></td>
                <td><?= $note ?> / 20</td>
                <td><?= mention($note) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Exercice 3.3 : Statistiques</h2>
<pre><?php
$sommeManuelle = 0;
$nbNotes = 0;
$noteMaxManuelle = null;
$noteMinManuelle = null;

foreach ($notes as $note) {
    $sommeManuelle += $note;
    $nbNotes++;

    if ($noteMaxManuelle === null || $note > $noteMaxManuelle) {
        $noteMaxManuelle = $note;
    }
    if ($noteMinManuelle === null || $note < $noteMinManuelle) {
        $noteMinManuelle = $note;
    }
}
$moyenneManuelle = $nbNotes > 0 ? ($sommeManuelle / $nbNotes) : 0;


echo "Somme         : " . $sommeManuelle . "\n";
echo "Nombre        : " . $nbNotes . "\n";
echo "Moyenne       : " . round($moyenneManuelle, 2) . "\n";
echo "Note max      : " . $noteMaxManuelle . "\n";
echo "Note min      : " . $noteMinManuelle . "\n\n";
$sommeNative = array_sum($notes);
$nbNative = count($notes);
$moyenneNative = $nbNative > 0 ? ($sommeNative / $nbNative) : 0;
$noteMaxNative = max($notes);
$noteMinNative = min($notes);

echo "array_sum()   : " . $sommeNative . "\n";
echo "count()       : " . $nbNative . "\n";
echo "Moyenne       : " . round($moyenneNative, 2) . "\n";
echo "max()         : " . $noteMaxNative . "\n";
echo "min()         : " . $noteMinNative . "\n\n";


$effectifs = [
    'Très bien'  => 0,
    'Bien'       => 0,
    'Assez bien' => 0,
    'Passable'   => 0,
    'Ajourné'    => 0,
];

foreach ($notes as $note) {
    $m = mention($note);
    if (isset($effectifs[$m])) {
        $effectifs[$m]++;
    }
}

echo "--- 3. Effectifs par Mention ---\n";
print_r($effectifs);
?></pre>
<?php



function afficher(array $tab): void
{
    foreach ($tab as $nom => $note) {
        echo "- " . str_pad($nom, 10) . " : " . $note . "\n";
    }
    echo "\n";
}

$tab1 = $notes;
ksort($tab1);
echo "=== 1. Tri par noms croissants (ksort) ===\n";
afficher($tab1);

$tab2 = $notes;
arsort($tab2);
echo "=== 2. Tri par notes décroissantes (arsort) ===\n";
afficher($tab2);

$tab3 = $notes;
krsort($tab3);
echo "=== 3. Tri par noms décroissants (krsort) ===\n";
afficher($tab3);

$tab4 = $notes;
asort($tab4);
echo "=== 4. Tri par notes croissantes (asort) ===\n";
afficher($tab4);
echo " Exercice 3.5 : Opérateurs de tableaux";

$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

echo "Résultat de \$a + \$b ===\n";
print_r($a + $b);

echo "\nRésultat de \$a == \$b ===   ";
var_dump($a == $b);

echo "\nRésultat de \$a === \$b ===  ";
var_dump($a === $b);
?>
<?php
include 'includes/pied_inc.php';
?>
</body>
</html>