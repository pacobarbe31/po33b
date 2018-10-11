<?php
//
// po32 : liste des voitures en PDF avec DAO
//
include 'init.php';
// Instanciation du DAO des voitures
$voitureDAO = new VoitureDAO();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>po32 - DAO avec voitures</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>
    <body>
        <h1>po32 - DAO avec voitures</h1>

        <h2>Toutes les voitures</h2>
        <?php
        $voitures = $voitureDAO->findAll();
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Marque</th>";
        echo "<th>Modèle</th>";
        echo "<th>Modification</th>";
        echo "<th>Supprimer</th>";
        echo "</tr>";
        foreach ($voitures as $voiture) {
            echo "<tr>";
            echo "<td>" . $voiture->get_id() . "</td>";
            echo "<td>" . $voiture->get_marque() . "</td>";
            echo "<td>" . $voiture->get_modele() . "</td>";
            echo '<td><a href="modifier.php?id=' . $voiture->get_id() . '">Modifier</a></td>';
            echo '<td><a href=supprimer.php?id=' . $voiture->get_id() . '">Supprimer</a></td>';
            echo "</tr>";
        }
        echo "</table>";
        ?>
        
        <p><a href="ajouter.php">Ajouter</a> une (belle) voiture</p><br />
        
        <h2>La voiture dont l'ID est 5</h2>
        <?php
        $voiture = $voitureDAO->find(5);
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Marque</th>";
        echo "<th>Modèle</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $voiture->get_id() . "</td>";
        echo "<td>" . $voiture->get_marque() . "</td>";
        echo "<td>" . $voiture->get_modele() . "</td>";
        echo "</tr>";
        echo "</table>";
        ?>

        <p>Liste des voitures en <a href="page2.php">PDF</a></p>

    </body>
</html>
