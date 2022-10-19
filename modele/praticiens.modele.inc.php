<?php

include_once 'bd.inc.php';

/**
 * Renvoie les numéros, noms et prénoms de tous les praticiens
 *
 * @return array un tableau de tableau avec les informations
 */
function getAllNomPraticiens(): array
{

    try {
        $monPdo = connexionPDO();
        $req = 'SELECT PRA_NUM, PRA_NOM, PRA_PRENOM FROM praticien ORDER BY PRA_NOM';
        $res = $monPdo->query($req);
        $result = $res->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

/**
 * Fournie toutes les informations en fonction de l'ID du praticien
 *
 * @param integer $prat identifiant du praticien
 * @return array|false si le praticien existe, renvoie un tableau sinon faux
 */
function getAllInformationsPraticien(int $prat): mixed
{

    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT * FROM praticien WHERE PRA_NUM = :prat');
        $req->bindValue(':prat', $prat, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
