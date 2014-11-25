<?php
class BouchonD
{
	private $id;
	private $id_panier;
	private $numTrac;
	private $longueur;
	private $dia1;
	private $dia2;
	private $diaComp;
	private $humi;

	
	
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
	
	public function getIdBouchonD()
	{
		return $this->id;
	}
	public function getIdPanierBouchonD()
	{
		return $this->id_panier;
	}
	public function getNumTracabiliteBouchonD()
	{
		return $this->numTrac;
	}
	public function getLongueurBouchonD()
	{
		return $this->longueur;
	}
	public function getDiametre1BouchonD()
	{
		return $this->dia1;
	}
	public function getDiametre2BouchonD()
	{
		return $this->dia2;
	}
	public function getDiametreCompresse()
	{
		return $this->diaComp;
	}
	public function getHumidite()
	{
		return $this->humi;
	}
	/***********************************************
						setters
	************************************************/
	
	public function setIdBouchonD($id)
	{
		$this->id=$id;
	}
	public function setIdPanierBouchonD($idpanier)
	{
		$this->id_panier=$idpanier;
	}
	public function setNumTracabiliteBouchonD($numTrac)
	{
		$this->numTrac=$numTrac;
	}
	public function setLongueurBouchonD($longueur)
	{
		$this->longueur=$longueur;
	}
	public function setDiametre1BouchonD($diametre)
	{
		$this->dia1=$diametre;
	}
	public function setDiametre2BouchonD($diametre)
	{
		$this->dia2=$diametre;
	}
	public function setDiametreCompresse($diametre)
	{
		$this->diaComp=$diametre;	
	}
	public function setHumidite($humidite)
	{
		$this->humi=$humidite;
	}
	
}
?>