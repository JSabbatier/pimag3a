<?php 

class Commande
{
	private $idCommande;
	private $idClient;
	private $dtCommande;
	private $dtLivraisonSouhaite;
	private $dtLivraisonReel;
	private $delaiPaiment;
	private $idCommercial;
	private $codeBarre;
	private $etat;
	
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
	public function getIdCommande()
	{
		return $this->idCommande;
	}
	public function getIdClient()
	{
		return $this->idClient;
	}
	public function getDtCommande()
	{
		return $this->dtCommande;
	}
	public function getDtLivraisonSouhaite()
	{
		return $this->dtLivraisonSouhaite;
	}
	public function getDtLivraisonReel()
	{
		return $this->dtLivraisonReel;
	}
	public function getDelaiPaiment()
	{
		return $this->delaiPaiment;
	}
	public function getIdCommercial()
	{
		return $this->idCommercial;
	}
	
	public function codeBarre()
	{
		return $this->codeBarre;
	}
	public function getEtat()
	{
		return $this->etat;
	}
	
		
	/***********************************************
						setters
	************************************************/
	public function setIdCommande($idpanier)
	{
		$this->idCommande=$idpanier;
	}
	public function setIdClient($idClient)
	{
		$this->idClient=$idClient;
	}
	public function setDtCommande($dtCommande)
	{
		$this->dtCommande=$dtCommande;
	}
	public function setDtLivraisonSouhaite($dtLivraisonSouhaite)
	{
		$this->dtLivraisonSouhaite=$dtLivraisonSouhaite;
	}
	public function setDtLivraisonReel($dtLivraisonReel)
	{
		$this->dtLivraisonReel=$dtLivraisonReel;
	}
	public function setDelaiPaiment($delaiPaiment)
	{
		$this->delaiPaiment=$delaiPaiment;
	}
	public function setIdCommercial($idCommercial)
	{
		$this->idCommercial=$idCommercial;
	}
	public function setCodeBarre($codeBarre)
	{
		$this->codeBarre=$codeBarre;
	}
	public function setEtat($etat)
	{
		$this->etat=$etat;
	}
}
?>