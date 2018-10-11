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
    $nb = $voitureDAO->delete($voiture);
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
        <title>po33 - DAO avec voitures et suppression</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <h1>po33 - DAO avec voitures et suppression</h1>
        <p>Exemple de classe métier utilisant un DAO en suppression</p>
        <h2>Etes-vous sûr de vouloir supprimer une belle <?php echo $voiture->get_marque(); ?> ?</h2>
        <form action="supprimer.php" method="post">
            <p>Marque<br/>
                <input type="text" name="marque" id="marque" disabled="disabled" value="<?php echo $voiture->get_marque(); ?>"/>
                <br/>
            <p>Modele<br/>
                <input type="text" name="modele" id="modele" disabled="disabled" value="<?php echo $voiture->get_modele(); ?>"/>
                <br/>
            <p><input type="hidden" name="id" id="id" value="<?php echo $voiture->get_id(); ?>"/>
                <br/>
            <p><input type="submit" name="submit" value="SUPPRIMER"/></p>
        </form>

        <br />
        <p>Retourner à la <a href="index.php">Page d'accueil</a></p>
    </body>
</html>