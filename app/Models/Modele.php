<?php
//acces au Modele parent pour l heritage
namespace App\Models;
use CodeIgniter\Model;

//=========================================================================================
//définition d'une classe Modele (meme nom que votre fichier Modele.php) 
//héritée de Modele et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================
class Modele extends Model {

//==========================
// Code du modele
//==========================

//=========================================================================
// Fonction 1
// récupère les données BDD dans une fonction getBillets
// Renvoie la liste de tous les billets, triés par identifiant décroissant
//=========================================================================
public function getindex($login,$mdp) {  
    $db = db_connect();
    $sql = "SELECT login, id FROM Visiteur WHERE login = ? AND mdp = ? ";
    $resultat = $db->query($sql, [$login,$mdp]);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function gettestfiche($id,$mois) { 
    $db = db_connect();
    $sql = "SELECT mois FROM FicheFrais WHERE idVisiteur = ? AND mois = ? ";
    $resultat = $db->query($sql, [$id,$mois]);
    $resultat = $resultat->getResult();
    return $resultat;
}

//public function verificationFrais($id,$mois) { 
//    $db = db_connect();
//    $sql = "SELECT * FROM lignefraisforfait WHERE idVisiteur = ? AND mois = ?";
//    $resultat = $db->query($sql, [$id,$mois]);
//    $resultat = $resultat->getResult();
//    return $resultat;
//    }


//public function verificationHorsFrais($id,$mois) { 
//    $db = db_connect();
//    $sql = "SELECT * FROM hors_frais WHERE idVisiteur = ? AND mois = ?", [$id, $mois];
//    $resultat = $db->query($sql, [$id,$mois]);
//    $resultat = $resultat->getResult();
//    return $resultat;
//    }


public function creationfrais($id,$mois,$idfraitforfait,$quantite) { 
    $db = db_connect();
    $sql = "INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (?, ?, ?, ?)";
    $resultat = $db->query($sql, [$id,$mois,$idfraitforfait,$quantite]);
  //  $resultat = $resultat->getResult();
    return $resultat;
}

public function creationfichefrais($id,$mois,$date) { 
    $db = db_connect();
    $sql = "INSERT INTO FicheFrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (?, ?, 0, 0, ?, 'CR')";
    $resultat = $db->query($sql, [$id,$mois,$date]);
    //$resultat = $resultat->getResult();
    return $resultat;
}

public function creationfichehorsfrais($libelle, $date, $montant) { 
    $db = db_connect();
    $sql = "INSERT INTO LigneFraisHorsForfait (id, idVisiteur, mois , libelle, date, montant) VALUES (?, ?, ?, ?, ?, ?)";
    $resultat = $db->query($sql, [$libelle, $date, $montant]);
    //$resultat = $resultat->getResult();
    return $resultat;
}


public function getmois($mois_selectionne) { 
    $db = db_connect();
    $sql = "SELECT * FROM FicheFrais WHERE MONTH(date) = $mois_selectionne";
    $resultat = $db->query($sql, [$mois_selectionne]);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function getall() { 
    $db = db_connect();
    $sql = "SELECT * FROM FicheFrais";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}

public function getListeFdfAll() { 
    $db = db_connect();
    $sql = "SELECT * FROM fiches_de_frais";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}

public function getListeFdfPartiel($mois) { 
    $db = db_connect();
    $sql = "SELECT * FROM fiches_de_frais WHERE MONTH(date) = $mois";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function lignefraisforfaisupdate($montant, $idfraisforfait, $mois, $idvisiteur) {
    $db = db_connect();
    $sql = "update lignefraisforfait set quantite=? where idFraisForfait=? and mois=? and idVisiteur=?";
    $resultat = $db->query($sql, [$montant, $idfraisforfait, $mois, $idvisiteur]);
    //$resultat = $resultat->getResult();
    return $resultat;

}
public function getlignefraishorsforfaisupdate($idvisiteur, $mois, $libelle, $date, $montant) {
    $db = db_connect();
    //$sql = "update lignefraishorsforfait set montant=? where id=? and mois=? and idVisiteur=?";
    $sql = "INSERT INTO LigneFraisHorsForfait(idVisiteur, mois, libelle, date, montant) VALUES (?, ?, ?, ?, ?)";
    $resultat = $db->query($sql,[$idvisiteur, $mois,$libelle, $date, $montant]);
    //$resultat = $resultat->getResult();
    return $resultat;

}
public function consultation($mois, $idvisiteur) {
    $db = db_connect();
    $sql = "SELECT * FROM LigneFraisForfait WHERE  mois=? and idVisiteur=?";
    $resultat = $db->query($sql,[$mois, $idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function consultationhorsforfait($mois, $idvisiteur) {
    $db = db_connect();
    $sql = "SELECT * FROM LigneFraisHorsForfait WHERE mois=? and idVisiteur=?";
    $resultat = $db->query($sql,[$mois, $idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}

public function selectmois($idvisiteur) {
    $db = db_connect();
    $sql = "SELECT mois FROM FicheFrais WHERE idVisiteur=?";
    $resultat = $db->query($sql,[$idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}

}

?>
