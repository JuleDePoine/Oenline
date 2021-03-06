<?php

require_once("MySQLDAOs.php");
require_once("MySQLConnexion.php");
require_once("MySQLORM.php");
require_once("ORM.php");
require_once("ConnexionBDD.php");

class ModeleOenline
{
	private $bdd=NULL;

	private $aAspectDAO=NULL;
	private $aGoutDAO=NULL;
	private $aOdeurDAO=NULL;
	private $appellationDAO=NULL;
	private $boucheDAO=NULL;
	private $cepageDAO=NULL;
	private $constitueDAO=NULL;
	private $coursDAO=NULL;
	private $domaineDAO=NULL;
	private $gouteDAO=NULL;
	private $groupeDAO=NULL;
	private $membreDAO=NULL;
	private $nezDAO=NULL;
	private $partieDAO=NULL;
	private $sentDAO=NULL;
	private $typeVinDAO=NULL;
	private $vinDAO=NULL;
	private $voitDAO=NULL;
	private $vueDAO=NULL;

	private $orm=NULL;

	public function __construct($hote, $id, $mdp, $bdd)
	{
		$this->bdd=new MySQLConnexion($hote, $id, $mdp, $bdd);
		$this->bdd->connecter();

		$this->aAspectDAO=new MySQLAAspectDAO($this->bdd);
		$this->aGoutDAO=new MySQLAGoutDAO($this->bdd);
		$this->aOdeurDAO=new MySQLAOdeurDAO($this->bdd);
		$this->appellationDAO=new MySQLAppellationDAO($this->bdd);
		$this->boucheDAO=new MySQLBoucheDAO($this->bdd);
		$this->cepageDAO=new MySQLCepageDAO($this->bdd);
		$this->constitueDAO=new MySQLConstitueDAO($this->bdd);
		$this->coursDAO=new MySQLCoursDAO($this->bdd);
		$this->domaineDAO=new MySQLDomaineDAO($this->bdd);
		$this->gouteDAO=new MySQLGouteDAO($this->bdd);
		$this->groupeDAO=new MySQLGroupeDAO($this->bdd);
		$this->membreDAO=new MySQLMembreDAO($this->bdd);
		$this->nezDAO=new MySQLNezDAO($this->bdd);
		$this->partieDAO=new MySQLPartieDAO($this->bdd);
		$this->sentDAO=new MySQLSentDAO($this->bdd);
		$this->typeVinDAO=new MySQLTypeVinDAO($this->bdd);
		$this->vinDAO=new MySQLVinDAO($this->bdd);
		$this->voitDAO=new MySQLVoitDAO($this->bdd);
		$this->vueDAO=new MySQLVueDAO($this->bdd);

		$this->orm=new MySQLORM($this->bdd, $this->vinDAO, $this->constitueDAO, $this->domaineDAO, $this->cepageDAO, $this->boucheDAO, $this->aGoutDAO, $this->vueDAO, $this->aAspectDAO, $this->nezDAO, $this->aOdeurDAO, $this->gouteDAO, $this->sentDAO, $this->voitDAO, $this->membreDAO, $this->partieDAO);
	}

	public function __destruct()
	{
		$this->bdd->deconnecter();
	}

	//ajouter un vin, avec son domaine, son appellation... ses cépages, ses vues, ses nez, ses bouches
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $vues, $nezz, $bouches)
	{
		return $this->orm->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $vues, $nezz, $bouches);
	}

	//ajoute une partie avec ses voit, sent, goute
	public function ajouterPartie($partie, $vin, $membre, $vues, $nezz, $bouches)
	{
		return $this->orm->ajouterPartie($partie, $vin, $membre, $vues, $nezz, $bouches);
	}

	//ajoute un domaine
	public function ajouterDomaine($domaine)
	{
		$this->domaineDAO->ajouter($domaine);
	}

	//ajoute un cépage
	public function ajouterCepage($cepage)
	{
		$this->cepageDAO->ajouter($cepage);
	}

	//ajouter des cepages à un vin
	public function ajouterCepagesVin($vin, $cepages)
	{
		$this->orm->ajouterCepagesVin($vin, $cepages);
	}

	//supprime un vin, ainsi que les nostitue, aAspect, aOdeur, aGout qui le concernent
	public function supprimerVin($vin)
	{
		$this->orm->supprimerVin($vin);
	}

	//supprime une partie avec toutes ses dépendances (voit, sent, goute)
	public function supprimerPartie($partie)
	{
		$this->orm->supprimerPartie($partie);
	}

	//retourne un tableau de tous les cepages
	public function trouverCepages()
	{
		return $this->cepageDAO->trouverTout();
	}

	//retourne tous les vins
	public function trouverVins()
	{
		return $this->vinDAO->trouverTout();
	}

	//retourne tous les types de vins
	public function trouverTypesVins()
	{
		return $this->typeVinDAO->trouverTout();
	}

	//retourne toutes les appellations
	public function trouverAppellations()
	{
		return $this->appellationDAO->trouverTout();
	}

	//retourne tous les domaines
	public function trouverDomaines()
	{
		return $this->domaineDAO->trouverTout();
	}

	//retourne toutes les vues
	public function trouverVues()
	{
		return $this->vueDAO->trouverTout();
	}

	//retourne tous les nez
	public function trouverNez()
	{
		return $this->nezDAO->trouverTout();
	}

	//retourne toutes les bouches
	public function trouverBouches()
	{
		return $this->boucheDAO->trouverTout();
	}

	//retourne tous les membres
	public function trouverMembres()
	{
		return $this->membreDAO->trouverTout();
	}

	//retourne un tableau de toutes les parties
	public function trouverParties()
	{
		return $this->partieDAO->trouverTout();
	}

	//retourne un tableau de tous les cours
	public function trouverCours()
	{
		return $this->coursDAO->trouverTout();
	}


	//retourne les vins contenant $nomDomaine dans le nom de domaine
	public function trouverVinsParNomDeDomaine($nomDomaine)
	{
		return $this->orm->trouverVinsParNomDeDomaine($nomDomaine);
	}

	//retourne les vins contenant le cepage $cepage
	public function trouverVinsParCepage($cepage)
	{
		return $this->orm->trouverVinsParCepage($cepage);
	}

	//retourne les vins contenant l'appellation $appellation
	public function trouverVinsParAppellation($appellation)
	{
		return $this->vinDAO->trouverParIdAppellation($appellation->idAppellation);
	}

	//retourne les vins contenant le type de vin $typeVin
	public function trouverVinsParTypeVin($typeVin)
	{
		return $this->vinDAO->trouverParIdTypeVin($typeVin->idTypeVin);
	}

	//retourne les vins contenant $nomVin dans le nom
	public function trouverVinsParNom($nomVin)
	{
		return $this->vinDAO->rechercherParNom($nomVin);
	}

	public function trouverCepagesParVin($vin)
	{
		return $this->orm->trouverCepagesParVin($vin);
	}

	public function trouverDomainesParVin($vin)
	{
		return $this->domaineDAO->trouverParId($vin->idDomaine);
	}

	public function trouverAppellationsParVin($vin)
	{
		return $this->appellationDAO->trouverParId($vin->idAppellation);
	}

	public function trouverTypesVinsParVin($vin)
	{
		return $this->typeVinDAO->trouverParId($vin->idTypeVin);
	}

	public function trouverGoutsVin($vin)
	{
		return $this->orm->trouverGoutsVin($vin);
	}

	public function trouverVuesVin($vin)
	{
		return $this->orm->trouverVuesVin($vin);
	}

	public function trouverNezVin($vin)
	{
		return $this->orm->trouverNezVin($vin);
	}

	public function trouverGoutsPartie($partie)
	{
		return $this->orm->trouverGoutsPartie($partie);
	}

	public function trouverNezPartie($partie)
	{
		return $this->orm->trouverNezPartie($partie);
	}

	public function trouverVuesPartie($partie)
	{
		return $this->orm->trouverVuesPartie($partie);
	}


}

?>