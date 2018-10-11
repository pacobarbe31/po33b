<!DOCTYPE html>
<?php
include 'init.php';

// Instanciation des DAO
$voitureDAO = new VoitureDAO();

// Récupère la liste des services
$voitures = $voitureDAO->findAll();

// Récupère l'ID dans l'URL ou à défaut dans le formulaire
$id = null;
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
$submit = isset($_POST['submit']);

if ($submit) {
// Formulaire soumi
// 
// Récupère les données du formulaire
    $marque = isset($_POST['marque']) ? $_POST['marque'] : '';
    $modele = isset($_POST['modele']) ? $_POST['modele'] : '';
   
// NOTA : underscore interdits dans les id, class et name HTML
    $voiture = new Voiture(array(
        'id' => $id,
        'marque' => $marque,
        'modele' => $modele
    ));

// Modifie l'enregistrement dans la BD
    $nb = $voitureDAO->update($voiture);
    header('Location: index.php');
} else {
// Formulaire non soumi
// 
// Récupère la voiture à modifier
    $voiture = $voitureDAO->find($id);
}
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>po33 - DAO avec voitures et MAJ</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <h1>po33 - DAO avec voitures et MAJ</h1>
        <p>Exemple de classe métier utilisant un DAO en MAJ</p>
        <h2>Modifier une voiture</h2>
        <form action="modifier.php" method="post">
            <p>Marque<br/>
                <input type="text" name="marque" id="marque" value="<?php echo $voiture->get_marque(); ?>"/>
                <br/>
            <p>Modele<br/>
                <input type="text" name="modele" id="modele" value="<?php echo $voiture->get_modele(); ?>"/>
                <br/>
            <p><input type="hidden" name="id" id="id" value="<?php echo $voiture->get_id(); ?>"/>
                <br/>
            <p><input type="submit" name="submit" value="OK"/></p>
        </form>

        <br />
        <p>Retourner à la <a href="index.php">Page d'accueil</a></p>
    </body>
</html>