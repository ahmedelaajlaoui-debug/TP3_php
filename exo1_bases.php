<?php  
require('config.php');

$dateAujourdhui = date('d/m/Y');
$dateCible = new DateTime('2027-08-11');
$diff = (new DateTime('today'))->diff($dateCible);
$nbJours = $diff->invert === 0 ? $diff->days : 0;
$testJ = 21;
$testM = 4; 
$testA = 2027;
$estValide = checkdate($testM, $testJ, $testA);
$jourSaisi   = 29;
$moisSaisi   = 2;
$anneeSaisie = 2026;
$dateSaisieValide = checkdate((int)$moisSaisi, (int)$jourSaisi, (int)$anneeSaisie);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier PHP - Exercices</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            padding: 30px 15px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 850px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 10px;
            padding: 22px 26px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #3b82f6;
        }

        .card h2 {
            font-size: 1.15rem;
            color: #1e3a8a;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .content {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        pre {
            background: #0f172a;
            color: #f8fafc;
            padding: 14px 18px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: "Fira Code", Consolas, Monaco, monospace;
            font-size: 0.9rem;
            margin: 10px 0;
            line-height: 1.5;
        }

        .badge {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .valid {
            color: #16a34a;
            font-weight: bold;
        }

        .invalid {
            color: #dc2626;
            font-weight: bold;
        }

        .date-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .date-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px;
        }

        .date-box h3 {
            font-size: 0.8rem;
            color: #475569;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-weight: 700;
        }

        .date-box p {
            font-size: 0.92rem;
            color: #1e293b;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Exercice 1.1 -->
    <div class="card">
        <h2>Exercice 1.1 : Noms de variables</h2>
        <div class="content">
            <?php
            echo '$x : déclaration valide <br>';
            echo '$_x : déclaration valide <br>';
            echo '$2x : déclaration invalide (commence par un chiffre) <br>';
            echo '$x-y : déclaration invalide (contient un tiret "-") <br>';
            echo '$Prix_HT : déclaration valide <br>';
            echo '$prix ht : déclaration invalide (contient un espace) <br>';
            echo '$état : déclaration valide (PHP accepte les caractères accentués en UTF-8, bien que déconseillé) <br>';

            echo "<br><strong>Le langage PHP est sensible à la casse :</strong><br>";
            echo "donc A majuscule != a minuscule.<br>";
            $A = 2;
            $a = 3;
            echo "A = $A <br>";
            echo "a = $a <br>";
            ?>
        </div>
    </div>

    <!-- Exercice 1.2 -->
    <div class="card">
        <h2>Exercice 1.2 : Constantes</h2>
        <div class="content">
            <?php
            echo "Établissement : " . ETABLISSEMENT . "<br>";
            echo "Note minimale : " . NOTE_MIN . "<br>";
            echo "Note maximale : " . NOTE_MAX . "<br>";
            echo "Seuil de validation : " . SEUIL . "<br>";
            ?>
        </div>
    </div>

    <!-- Exercice 1.3 -->
    <div class="card">
        <h2>Exercice 1.3 : Calcul</h2>
        <div class="content">
            <?php
            $prix_ht = 60;
            $tva = 20;
            $prix_ttc = $prix_ht * (1 + $tva / 100);
            echo "Le prix TTC du produit est de <strong>$prix_ttc €</strong>.<br>";
            ?>
        </div>
    </div>

    <!-- Exercice 1.4 -->
    <div class="card">
        <h2>Exercice 1.4 : Types et conversions</h2>
        <div class="content">
            <pre><?php
            $test = 42;
            $test = (string) $test;
            var_dump($test);
            
            echo "\n--- Prédictions booléens ---\n";
            echo "0      -> false\n";
            echo "0.0    -> false\n";
            echo "'0'    -> false\n";
            echo "''     -> false\n";
            echo "'abc'  -> true\n";
            echo "[]     -> false\n";
            echo "null   -> false\n\n";

            var_dump((bool) 0);       
            var_dump((bool) 0.0);     
            var_dump((bool) "0");    
            var_dump((bool) "");      
            var_dump((bool) "abc");   
            var_dump((bool) []);     
            var_dump((bool) null);    

            echo "\n--- Casts d'entiers et de flottants ---\n";
            echo "(int) 3.9       --> 3\n";
            echo "(int) '12abc'   --> 12\n";
            echo "(float) '1.5e3' --> 1500.0\n";
            echo "(int) True      --> 1\n\n";

            var_dump((int) 3.9);         
            var_dump((int) "12abc");     
            var_dump((float) "1.5e3");  
            var_dump((int) true);        

            echo "\n--- Notations de 255 ---\n";
            $decimal     = 255;
            $hexadecimal = 0xFF;   
            $octal       = 0o377;  
            $binaire     = 0b11111111; 

            echo "Décimal     : $decimal\n";
            echo "Hexadécimal : $hexadecimal\n";
            echo "Octal       : $octal\n";
            echo "Binaire     : $binaire\n";
            ?></pre>
        </div>
    </div>

    <!-- Exercice 1.5 -->
    <div class="card">
        <h2>Exercice 1.5 : Chaînes de caractères</h2>
        <div class="content">
            <pre><?php
            $traitees = "égales à";
            $ici = 2;

            echo 'Ahmed a dit : "J\'ai réussi"' . "\n";
            echo 'Voulez-vous supprimer C:\*.*?' . "\n";
            echo 'Ceci n\'affichera pas \n de nouvelle ligne' . "\n";
            echo 'Les variables ne seront pas $traitees $ici' . "\n";
            echo "Les variables seront $traitees $ici\n";

            echo "\n--- Parcours lettre par lettre ---\n";
            $chaine = "*Bonjour les développeurs*";
           
            $nv_chaine = trim($chaine, '*');
            echo "$nv_chaine \n";
            $longueur = strlen($nv_chaine);

            for ($i = 0; $i < $longueur; $i++) {
                echo $nv_chaine[$i] . "\n";
            }
            ?></pre>
        </div>
    </div>

    <!-- Exercice : Manipulation des Dates -->
    <div class="card">
        <h2>Exercice : Manipulation des Dates</h2>
        <div class="content">
            <div class="date-section">
                <div class="date-box">
                    <h3>Date courante</h3>
                    <p>Aujourd'hui : <strong><?= $dateAujourdhui ?></strong></p>
                </div>

                <div class="date-box">
                    <h3>Compte</h3>
                    <p>Jours restants avant le <?= $dateCible->format('d/m/Y') ?> : <strong><?= $nbJours ?> jour(s)</strong></p>
                </div>

                <div class="date-box">
                    <h3>Contrôle <?= "{$testJ}/0{$testM}/{$testA}" ?></h3>
                    <p>Résultat : <?= $estValide ? '<span class="valid">Valide</span>' : '<span class="invalid">Invalide</span>' ?></p>
                </div>

                <div class="date-box">
                    <h3>Contrôle <?= "{$jourSaisi}/{$moisSaisi}/{$anneeSaisie}" ?></h3>
                    <p>Résultat : <?= $dateSaisieValide ? '<span class="valid">Valide</span>' : '<span class="invalid">Invalide</span>' ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>