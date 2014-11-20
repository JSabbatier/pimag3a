<?php
class Fournisseur
{
	private $id;
	private $nom;
	private $adresse;
	private $telephone;
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
}
?>