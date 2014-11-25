<?php 

class Employe
{
	private $idEmploye;
	private $nom;
	private $prenom;
	private $tel;
	private $role;
	private $adresse;
	private $fax;
	private $email;
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
	public function getIdEmploye()
	{
		return $this->idEmploye;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getTel()
	{
		return $this->tel;
	}
	public function getRole()
	{
		return $this->role;
	}
	public function getAdresse()
	{
		return $this->adresse;
	}
	public function getFax()
	{
		return $this->fax;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getEtat()
	{
		return $this->etat;
	}
	
		
	/***********************************************
						setters
	************************************************/
	public function setIdEmploye($idEmploye)
	{
		$this->idEmploye=$idEmploye;
	}
	public function setNom($nom)
	{
		$this->nom=$nom;
	}
	public function setPrenom($prenom)
	{
		$this->prenom=$prenom;
	}
	public function setTel($tel)
	{
		$this->tel=$tel;
	}
	public function setRole($role)
	{
		$this->role=$role;
	}
	public function setAdresse($adresse)
	{
		$this->adresse=$adresse;
	}
	public function setFax($fax)
	{
		$this->fax=$fax;
	}
	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function setEtat($etat)
	{
		$this->etat=$etat;
	}
}
?>