<?php 

class Client
{
	private $idClient;
	private $nomClient;
	private $numeroTel;
	private $adresseFacturation;
	private $adresseLivraison;
	private $email;
	private $contact;
	private $type;
	
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
	public function getAdressefacturation()
	{
		return $this->adressefacturation;
	}
	public function getAdresseLivraison()
	{
		return $this->adresseLivraison;
	}	
	public function getEmail()
	{
		return $this->email;
	}
	public function getContact()
	{
		return $this->contact;
	}
	public function getType()
	{
		return $this->type;
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
	public function setAdressefacturation($adressefacturation)
	{
		$this->adressefacturation=$adressefacturation;
	}
	public function setAdresseLivraison($adresseLivraison)
	{
		$this->adresseLivraison=$adresseLivraison;
	}
	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function setContact($contact)
	{
		$this->contact=$contact;
	}
	public function setType($type)
	{
		$this->type=$type;
	}
	
}
?>