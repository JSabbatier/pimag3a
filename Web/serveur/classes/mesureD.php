<?php
class MesureD
{
	private $id;
	private $idPanier;
	private $tca_interne;
	private $capilarite;
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
	public function getIdPanier()
	{
		return $this->idPanier;
	}
	public function getCapilarite()
	{
		return $this->capilarite;
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
	public function setIdPanier($idPanier)
	{
		$this->idPanier=$idPanier;
	}
	public function setCapilarite($capi)
	{
		$this->capilarite=$capi;
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