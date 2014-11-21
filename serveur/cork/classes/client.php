<?php 

class Client
{
	private $idClient;
	private $nomClient;
	private $numeroTel;
	private $nomContact;
	private $emailContact;
	private $raison;
	private $idCommercial;
	private $etat;
	private $fax;
	
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
	public function getIdClient()
	{
		return $this->IdClient;
	}
	public function getNomClient()
	{
		return $this->nomClient;
	}
	public function getNumeroTel()
	{
		return $this->numeroTel;
	}
	public function getNomContact()
	{
		return $this->nomContact;
	}
	public function getEmailContact()
	{
		return $this->emailContact;
	}	
	public function getRaison()
	{
		return $this->raison;
	}
	public function getIdCommercial()
	{
		return $this->idCommercial;
	}
	public function getEtat()
	{
		return $this->etat;
	}
	public function getFax()
	{
		return $this->fax;
	}
		
	/***********************************************
						setters
	************************************************/
	public function setIdClient($IdClient)
	{
		$this->IdClient=$IdClient;
	}
	public function setNomClient($nomClient)
	{
		$this->nomClient=$nomClient;
	}
	public function setNumeroTel($numeroTel)
	{
		$this->numeroTel=$numeroTel;
	}
	public function setNomContact($nomContact)
	{
		$this->nomContact=$nomContact;
	}
	public function setEmailContact($emailContact)
	{
		$this->emailContact=$emailContact;
	}
	public function setRaison($raison)
	{
		$this->raison=$raison;
	}
	public function setIdCommercial($idCommercial)
	{
		$this->idCommercial=$idCommercial;
	}
	public function setEtat($etat)
	{
		$this->etat=$etat;
	}
	public function setFax($fax)
	{
		$this->fax=$fax;
	}
	
}
?>