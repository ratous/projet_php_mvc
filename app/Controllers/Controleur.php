<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;

//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends BaseController {

//=====================================================================
//Fonction index correspondant au Controleur frontal (ou index.php) en MVC libre
//=====================================================================
public function index() {

	
	if (isset($_POST['etape']) && isset($_POST['kilometres']) && isset($_POST['nuitees']) 
		&& isset($_POST['repas'])) 
	{
		$this->renseignement();
	}
	else if (isset($_POST['date']) && isset($_POST['libelle']) && isset($_POST['montant'])) 
	{
		$this->renseignementhorsforfait();
	}
	else if (isset($_GET['action']) && $_GET['action']=='renseigner_fiche_de_frais') 
	{ 
		
		$this->renseigner(); 
	}
	else if (isset($_GET['action']) && $_GET['action']=='consulter_fiches_de_frais') 
	{
		$this->consulter();
	}
	else if (isset($_POST['Consulter']))
	{
		// premier paramètre 1 indique sql partiel sur le mois
		// deuxième paramètre c'est le mois sélectionné
                $this->consulter();
	}
	else if (isset($_POST['mois'])) {
		$this->consulter();
	}

	# else if (isset($_POST['login']) && (isset($_POST['mdp']))) 
	else if (!empty($_POST['login']) && (!empty($_POST['mdp']))) 
	{	
	 $this->motdp();
	}
	else if (isset($_GET['action'])&& isset($_GET['action'])=='Index') 
	{ 
		$this->accueil(); 
	}
	else $this->accueil();
}
	
public function motdp() {

	$Modele = new \App\Models\Modele();
	
	$login = $_POST['login'];
	$motdp = $_POST['mdp'];
	
	$donnees = $Modele->getindex($login, $motdp);
	
	if (isset($donnees[0]->login)) {
	   $id = $donnees[0]->id;
	   session_start();
	   $_SESSION['id']=$id;
	   $mois = date("F");
	   $donnee2=$Modele->gettestfiche($id, $mois);
	   if (!isset($donnee2[0]->mois)) {
		$Modele->creationfichefrais($id,$mois,date('Y-m-d'));
		$Modele->creationfrais($id,$mois,'KM', 0 );
		$Modele->creationfrais($id,$mois,'NUI', 0 );
		$Modele->creationfrais($id,$mois,'REP', 0 );
		$Modele->creationfrais($id,$mois,'ETP', 0 );
		//$fraisCreer = $Modele->verificationFrais($id, $mois);
                //$horsFraisCreer = $Modele->verificationHorsFrais($id, $mois);
		//if ($fraisCreer && $horsFraisCreer) 
		//	echo "Les modèles de frais et hors frais ont été créés avec succès.";
		// else 
		//	echo "Erreur lors de la création des modèles.";

		}
	   $data['login']=$donnees[0]->login;
	echo view('accueil', $data);
	}
	else echo view('Connexion');
}
	
public function accueil() {

	echo view('Connexion');
}

public function consulter() {
	
	session_start();
	if (isset($_SESSION['id'])) {
		
		$idvisiteur=$_SESSION['id'];
		if (isset($_POST['mois'])) {
		$mois =$_POST['mois'];
	}
		else {
			$mois='';
		}
}
	$Modele = new \App\Models\Modele();

	   $fiches = $Modele->consultation($mois, $idvisiteur);
	   $donnees1 = $Modele->consultationhorsforfait($mois, $idvisiteur);
	

	$data['fiches']=$fiches;
	$data['donnees1']=$donnees1;
	$data['mois']=$mois;

	//print_r($fiches);
	//print_r($donnees1);

    echo view('consulterFiche',$data);

}

public function renseigner() {
	$Modele = new \App\Models\Modele();

//	$id = $_POST['id'];

//	$mois = $_POST['mois'];

//	$idfraitforfait = $_POST['idfraitforfait'];

//	$quantite = $_POST['quantite'];
		
//	if ($id && $mois && $idfraitforfait && $quantite) {
	
//	$donnees = $Modele->creationfrais($id, $mois, $idfraitforfait, $quantite);
//	}
	echo view('renseignerFiche');		
}

public function renseigerhorsforfait() {
	$Modele = new \App\Models\Modele();
		
	$libelle = $_POST['libelle'];
	$date = $_POST['date'];
	$montant = $_POST['montant'];
		
			
	$donnees = $Modele->creationfichehorsfrais($libelle, $date, $montant);
			
	if (isset($donnees[0]->id)) {
		$data['id']=$donnees[0]->id;
		$libelle = $donnees[0]->libelle;
		$date = $donnees[0]->date;
		$montant = $donnees[0]->montant;
		$donnee2=$Modele->creationfichehorsfrais($libelle, $date, $montant);
		echo view('renseigner', $data);
	}
	else {
            	echo view('erreur');
	}
}
		
// Affiche une erreur
public function erreur($msgErreur) {
  echo view('vueErreur.php', $data);
}
public function renseignement() {
	$Modele = new \App\Models\Modele();
	$mois = date("F");
	session_start();
	$idvisiteur =$_SESSION['id'];
	
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['etape'], 'ETP', $mois, $idvisiteur);
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['kilometres'], 'KM', $mois, $idvisiteur);
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['nuitees'], 'NUI', $mois, $idvisiteur);
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['repas'], 'REP', $mois, $idvisiteur);

	$this->renseigner();


}
public function renseignementhorsforfait() {
	$Modele = new \App\Models\Modele();
		/*$mois = date("F");
	session_start();
	$idvisiteur =$_SESSION['id'];

	$donnee2=$Modele->lignefraisforfaisupdate($_POST['date'], 'DAT', $mois, $idvisiteur);
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['libelle'], 'LIB', $mois, $idvisiteur);
	$donnee2=$Modele->lignefraisforfaisupdate($_POST['montant'], 'MTT', $mois, $idvisiteur);
	$this->renseigner();*/

	$libelle = $_POST['libelle'];
	$date = $_POST['date'];
	$montant = $_POST['montant'];
	$mois = date("F");
	session_start();
	$idvisiteur =$_SESSION['id'];
	$donnees=$Modele->getlignefraishorsforfaisupdate($idvisiteur, $mois, $libelle, $date, $montant);



	if (isset($donnees)){
		$data['login'] = $donnees;
		echo view('renseignerFiche', $data);
	}
	else {
		echo view('renseignerFiche');
	}

}
}




?>
