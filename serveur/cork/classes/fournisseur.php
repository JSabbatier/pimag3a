<?php
class Fournisseur
{
	private $id;
	private $nom;
	private $adresse;
	private $telephone;
	private $fax;
	private $contact;
	private $raison;
	private $emailContact;
	
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
	public function getIdFournisseur()
	{
		return $this->id;
	}
	public function getNomFournisseur()
	{
		return $this->nom;
	}
	public function getAdresseFournisseur()
	{
		return $this->adresse;
	}
	public function getTelephoneFournisseur()
	{
		return $this->telephone;
	}
	public function getFaxFournisseur()
	{
		return $this->fax;
	}
	public function getContacteFournisseur()
	{
		return $this->contact;
	}
	public function getRaisonFournisseur()
	{
		return $this->raison;
	}
	public function getEmailContactFournisseur()
	{
		return $this->emailContact;
	}
	
	/***********************************************
						setters
	************************************************/
	public function setIdFournisseur($id)
	{
		$this->id=$id;
	}
	public function setNomFournisseur($nom)
	{
		$this->nom=$nom;
	}
	public function setAdresseFournisseur($adresse)
	{
		$this->adresse=$adresse;
	}
	public function setTelephoneFournisseur($tel)
	{
		$this->telephone=$tel;
	}
	public function setFaxFournisseur($fax)
	{
		$this->fax=$fax;
	}
	public function setContacteFournisseur($contact)
	{
		$this->contact=$contact;
	}
	public function setRaisonFournisseur($raison)
	{
		$this->raison=$raison;
	}
	public function setEmailContactFournisseur($email)
	{
		$this->emailContact=$email;
	}
	
}
?>