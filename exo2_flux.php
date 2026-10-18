<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP</title>
    <style>
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 720px;
            background: #ffffff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            white-space: pre-wrap; 
            line-height: 1.6;
        }

        h3 {
            color: #0f172a;
            margin-top: 24px;
            margin-bottom: 12px;
            font-size: 1.15rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
        }

        ul {
            list-style: none;
            padding-left: 0;
            margin: 12px 0;
        }

        li {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 14px;
            margin-bottom: 6px;
        }

        strong {
            color: #2563eb;
        }
    </style>
</head>
<body>

<div class="container">
<?php

require('config.php');

echo "### Exercice 2.1 : `if / elseif / else`";
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

//  du 
$notes = [20, 16, 14.5, 13, 10, 6.5, 5];

echo "<h3>Résultats des mentions (SEUIL = " . SEUIL . ") :</h3>";
echo "<ul>";
foreach ($notes as $n) {
    echo "<li>Note : <strong>$n</strong> &rarr; Mention : <strong>" . mention($n) . "</strong></li>";
}
echo "</ul>";
echo "### Exercice 2.2 : `switch`\n";
$mois = date("m");

switch ($mois) {
    case '1':echo "Janvier\n";
        break;
    case '2': echo "Février\n";
        break;
    case '3': echo "Mars\n";
        break;
    case '4': echo "Avril\n";
        break;
    case '5': echo "Mai\n";
        break;
    case '6': echo "Juin\n";
        break;
    case '7': echo "Juillet\n";
        break;
    case '8': echo "Août\n";
        break;
    case '9': echo "Septembre\n";
        break;
    case '10': echo "Octobre\n";
        break;
    case '11': echo "Novembre\n";
        break;
    case '12': echo "Décembre\n";
        break;
    default: echo "Mois invalide\n";
        break;
}
echo" ### Exercice 2.3 : Boucles\n";
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "\n"; 
}
$i = 0;
while ($i <= 20) {
    if ($i === 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 !== 0) {
        continue;
    }
    echo "$i \n";
}
$i = 1;
while (true) {
    switch ($i) {
        case 5:
            echo "At 5\n";
            break; 
        case 10:
            echo "At 10; quitting\n";
            break 2; 
    }
    $i++;
}
$i = 0;
do {
    if ($i === 10) {
        echo "<strong>$i</strong> ";
    } else {
        echo "$i ";
    }
    $i += 2; } while ($i <= 20);
?>
</div>

</body>
</html>