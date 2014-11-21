<?php 

class Adresse
{
	private $id_adresse_adresse;
	private $id_adresse_client;
	private $adresse;
	private $nom;
	
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
	public function getIdAdresse()
	{
		return $this->id_adresse;
	}
	public function getIdAdresseClient()
	{
		return $this->id_adresse_client;
	}
	public function getAdresse()
	{
		return $this->adresse;
	}
	public function getNom()
	{
		return $this->nom;
	}
		
	/***********************************************
						setters
	************************************************/
	public function setIdAdresse($id_adresse)
	{
		$this->id_adresse=$id_adresse;
	}
	public function setIdAdresseClient($id_adresseArrivage)
	{
		$this->id_adresseArrivage=$id_adresseArrivage;
	}
	public function setAdresse($adresse)
	{
		$this->adresse=$adresse;
	}
	public function setNom($nom)
	{
		$this->nom=$nom;
	}
	
}
?>