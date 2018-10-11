<?php
include 'init.php';

// Instanciation des DAO
$voitureDAO = new VoitureDAO();

// Récupère la liste des services
$voitures = $voitureDAO->findAll();

$submit = isset($_POST['submit']);

if ($submit) {
// Formulaire soumi
// 
// Récupère les données du formulaire
    $marque = isset($_POST['marque']) ? $_POST['marque'] : '';
    $modele = isset($_POST['modele']) ? $_POST['modele'] : '';
   
// NOTA : underscore interdits dans les id, class et name HTML
    $voiture = new Voiture(array(
        'marque' => $marque,
        'modele' => $modele
    ));

// Modifie l'enregistrement dans la BD
    $nb = $voitureDAO->insert($voiture);
    header('Location: index.php');
} else {

}
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>po33 - DAO avec voitures et insertion</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <h1>po33 - DAO avec voitures et insertion</h1>
        <p>Exemple de classe métier utilisant un DAO en insertion</p>
        <h2>Ajouter une (belle) voiture</h2>
        <form action="ajouter.php" method="post">
            <p>Marque<br/>
                <input type="text" name="marque" id="marque" value="Marque"/>
                <br/>
            <p>Modele<br/>
                <input type="text" name="modele" id="modele" value="Modele"/>
                <br/>
            <p><input type="submit" name="submit" value="AJOUTER"/></p>
        </form>

        <br />
        <p>Retourner à la <a href="index.php">Page d'accueil</a></p>
    </body>
</html>