<?php 

class Panier
{
	private $idPanier;
	private $idCommande;
	private $qualite;
	private $quantite;
	private $longueur;
	private $marquage;
	private $prixNegoce;
	private $devise;
	private $controle;
	private $idFournisseurCmd;
	private $taille;
	
	/**********************************************************
                       construtor    
	**********************************************************/
     
    /*constructeur par defaut*/
    public function __construct()
    {

    }
	/***********************************************
						getters
	************************************************/
	public function getIdPanier()
	{
		return $this->idPanier;
	}
	public function getIdCommande()
	{
		return $this->idCommande;
	}
	public function getQualite()
	{
		return $this->qualite;
	}
	public function getQuantite()
	{
		return $this->quantite;
	}
	public function getMarquage()
	{
		return $this->marquage;
	}
	public function getPrixNegocier()
	{
		return $this->prixNegoce;
	}
	public function getDevise()
	{
		return $this->devise;
	}
	public function getControle()
	{
		return $this->controle;	
	}
	public function getIdCommandeFournisseur()
	{
		return $this->idFournisseurCmd;	
	}
	public function getLongueur()
	{
		return $this->longueur;
	}
	public function getTaille()
	{
		return $this->taille;
	}
		
	/***********************************************
						setters
	************************************************/
	public function setIdPanier($idpanier)
	{
		$this->idPanier=$idpanier;
	}
	public function setIdCommande($idCommande)
	{
		$this->idCommande=$idCommande;
	}
	public function setQualite($qualite)
	{
		$this->qualite=$qualite;
	}
	public function setQuantite($quantite)
	{
		$this->quantite=$quantite;
	}
	public function setMarquage($marquage)
	{
		$this->marquage=$marquage;
	}
	public function setPrixNegocier($prixNegocier)
	{
		$this->prixNegoce=$prixNegocier;
	}
		public function setDevise($devise)
	{
		$this->devise=$devise;
	}
		public function setControle($controle)
	{
		$this->controle=$controle;	
	}
	public function setIdCmommandeFournisseur($idcmd)
	{
		$this->idFournisseurCmd=$idcmd;
	}
	public function setLongueur($long)
	{
		$this->longueur=$long;	
	}
	public function setTaille($taille)
	{
		$this->taille=$taille;
	}
	
	
}
?>