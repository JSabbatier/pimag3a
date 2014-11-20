<?php 

class Arrivage
{
	private $idLot;
	private $date;
	private $idFournisseur;
	private $qualite;
	private $quantite;
	private $numeroTracabilite;
	private $validite;
	private $prixAchat;
	private $devise;
	private $codebarre;
	private $etat;
	private $controle;
	
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
	public function getIdLot()
	{
		return $this->idLot;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getIdFournisseur()
	{
		return $this->idFournisseur;
	}
	public function getQualite()
	{
		return $this->dtQualite;
	}
	public function getQuantite()
	{
		return $this->quantite;
	}
	public function getNumerotracabilite()
	{
		return $this->numeroTracabilite;
	}
	public function getValidite()
	{
		return $this->validite;
	}
	public function getPrixAchat()
	{
		return $this->prixAchat;
	}
	public function getControle()
	{
		return $this->controle;
	}
	public function getDevise()
	{
		return $this->devise;
	}
	public function getCodeBarre()
	{
		return $this->codebarre;
	}
	public function getEtat()
	{
		return $this->etat;
	}
	
		
	/***********************************************
						setters
	************************************************/
	public function setIdLot($idLot)
	{
		$this->idLot=$idLot;
	}
	public function setDate($date)
	{
		$this->date=$date;
	}
	public function setIdFournisseur($idFournisseur)
	{
		$this->idFournisseur=$idFournisseur;
	}
	public function setQualite($qualite)
	{
		$this->qualite=$qualite;
	}
	public function setQuantite($quantite)
	{
		$this->quantite=$quantite;
	}
	public function setNumeroTracabilite($numeroTracabilite)
	{
		$this->numeroTracabilite=$numeroTracabilite;
	}
	public function setValidite($validite)
	{
		$this->validite=$validite;
	}
	public function setPrixAchat($prixAchat)
	{
		$this->prixAchat=$prixAchat;
	}	
	public function setDevise($devise)
	{
		$this->devise=$devise;
	}
	public function setCodeBarre($codeBarre)
	{
		$this->codeBarre=$codeBarre;
	}
	public function setEtat($etat)
	{
		$this->etat=$etat;
	}
	public function setControle($controle)
	{
		$this->controle=$controle;
	}
}
?>