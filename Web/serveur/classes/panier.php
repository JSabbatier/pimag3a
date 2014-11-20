<?php 

class Panier
{
	private $idPanier;
	private $idCommande;
	private $qualite;
	private $quantite;
	private $marquage;
	private $prixNegoce;
	private $devise;
	
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
	
}
?>