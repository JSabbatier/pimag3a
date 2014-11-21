<?php 
class MesureA
{
	private $id;
	private $id_arrivage;
	private $tca_fournisseur;
	private $tca_interne;
	private $gout;
	
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
	public function getId()
	{
		return $this->id;
	}
	public function getIdArrivage()
	{
		return $this->id_arrivage;
	}
	public function getTCAFournisseur()
	{
		return $this->tca_fournisseur;
	}
	public function getTCAInterne()
	{
		return $this->tca_interne;
	}
	public function getGout()
	{
		return $this->gout;
	}
		
	/***********************************************
						setters
	************************************************/
	public function setId($id)
	{
		$this->id=$id;
	}
	public function setIdArrivage($idArrivage)
	{
		$this->idArrivage=$idArrivage;
	}
	public function setTCAFournisseur($tca_fournisseur)
	{
		$this->tca_fournisseur=$tca_fournisseur;
	}
	public function setTCAInterne($tca_interne)
	{
		$this->tca_interne=$tca_interne;
	}
	public function setGout($gout)
	{
		$this->gout=$gout;
	}
	
}
?>