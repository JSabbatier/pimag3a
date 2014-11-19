<?php
class Expedition
{
	private $id;
	private $idCommande;
	private $idLot;
	private $quantite;
	
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
	public function getIdExpedition()
	{
		return $this->id;
	}
	public function getIdCommande()
	{
		return $this->idCommande;
	}
	public function getIdLot()
	{
		return $this->idLot;
	}
	public function getQuantite()
	{
		return $this->quantite;
	}
	/***********************************************
						setters
	************************************************/
	public function setIdExpedition()
	{
		$this->id;
	}
	public function setIdCommande()
	{
		 $this->idCommande;
	}
	public function setIdLot()
	{
		return $this->idLot;
	}
	public function setQuantite()
	{
		return $this->quantite;
	}
}

?>