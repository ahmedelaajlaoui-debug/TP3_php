<?php
if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

$resultats = [
    [
        "nom"     => "hamza",
        "notes"   => ["wep" => 16, "Ro" => 14],
        "moyenne" => 15.0
    ],
    [
        "nom"     => "Ahmed",
        "notes"   => ["WEP" => 12.5, "Ro" => 13],
        "moyenne" => 12.75
    ],
    [
        "nom"     => "Sara",
        "notes"   => ["WEP" => 18, "Ro" => 19],
        "moyenne" => 18.5
    ],
    [
        "nom"     => "Hamza",
        "notes"   => ["WEP" => 8, "Ro" => 7.5],
        "moyenne" => 7.75
    ]
];


$jsonEncoded = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$fichierJson = 'data/notes.json';
file_put_contents($fichierJson, $jsonEncoded);

$contenuFichier = file_get_contents($fichierJson);
$donneesDecodees = json_decode($contenuFichier, true); 

$phpSerialized = serialize($resultats);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 5.4 - Sérialisation et JSON</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding: 30px 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            color: #0f172a;
            margin: 25px 0 10px;
            font-size: 1.25rem;
        }
        pre {
            background-color: #0f172a;
            color: #f1f5f9;
            padding: 16px 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: "Courier New", Consolas, monospace;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .info-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>Exercice 5.4 : Sérialisation et JSON</h1>

<h2>1 & 2. Fichier généré dans <code>data/notes.json</code></h2>
<div class="info-card">
    <p>Le fichier a été enregistré avec succès (<?= strlen($jsonEncoded) ?> octets).</p>
</div>

<h2>3. Données relues via <code>json_decode($json, true)</code> et affichées avec <code>print_r()</code></h2>
<pre><?php print_r($donneesDecodees); ?></pre>

<h2>4. Comparaison : <code>json_encode()</code> vs <code>serialize()</code></h2>

<h3>Format JSON (<code>json_encode</code>) :</h3>
<pre><?= htmlspecialchars($jsonEncoded) ?></pre>

<h3>Format Natif PHP (<code>serialize</code>) :</h3>
<pre><?= htmlspecialchars($phpSerialized) ?></pre>

</body>
</html>