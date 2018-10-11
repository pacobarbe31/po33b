<?php

/**
 * Classe DAO VoitureDAO
 *
 * @author jef
 */
class VoitureDAO extends DAO {

    /**
     * Constructeur
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Lecture d'une voiture par son ID
     * @param type $id_voiture
     * @return \Voiture
     * @throws Exception
     */
    function find($id_voiture) {
        $sql = "select * from voiture where id= :id_voiture";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":id_voiture" => $id_voiture));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $voiture = new Voiture($row);
        // Retourne l'objet métier
        return $voiture;
    }

// function find()

    /**
     * Lecture de toutes les voitures
     * @return array
     * @throws Exception
     */
    function findAll() {
        $sql = "select * from voiture";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $voitures = array();
        foreach ($rows as $row) {
            $voitures[] = new Voiture($row);
        }
        // Retourne un tableau d'objets "voiture"
        return $voitures;
    }

// function findAll()

    function update(Voiture $voiture) {
        $sql = "update voiture set marque=:marque, modele=:modele where id=:id";
        $params = array(
            ":id" => $voiture->get_id(),
            ":marque" => $voiture->get_marque(),
            ":modele" => $voiture->get_modele(),
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
    }

// function delete()

    function delete(Voiture $voiture) {
        $sql = "delete from voiture where id=:id";
        $params = array(
            ":id" => $voiture->get_id()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de suppression
    }

    function insert(Voiture $voiture) {
        $sql = "insert into voiture (marque,modele) ";
        $sql .= "values (:marque,:modele)";
        $params = array(
            ":marque" => $voiture->get_marque(),
            ":modele" => $voiture->get_modele()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
    }

// insert()
}

// Class VoitureDAO