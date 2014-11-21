<?php
class BouchonA
{
	private $id;
	private $idArrivage;
	private $longueur;
	private $diametre1;
	private $diametre2;
	private $diametreCompresse;
	private $humidite;
	
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
	
	public function getIdBouchonA()
	{
		return $this->id;
	}
	public function getIdArrivageBouchonA()
	{
		return $this->idArrivage;
	}
	public function getLongueurBouchonA()
	{
		return $this->longueur;
	}
	public function getDiametre1BouchonA()
	{
		return $this->diametre1;
	}
	public function getDiametre2BouchonA()
	{
		return $this->diametre2;
	}
	public function getDiametreCompresseBouchonA()
	{
		return $this->diametreCompresse;
	}
	public function getHumiditeBouchonA()
	{
		return $this->humidite;
	}
	/***********************************************
						setters
	************************************************/
	public function setIdBouchonA($id)
	{
		$this->id=$id;
	}
	public function setIdArrivageBouchonA($idArrivage)
	{
		$this->idArrivage=$idArrivage;
	}
	public function setLongueurBouchonA($long)
	{
		$this->longueur=$long;
	}
	public function setDiametre1BouchonA($dia1)
	{
		$this->diametre1=$dia1;
	}
	public function setDiametre2BouchonA($dia2)
	{
		$this->diametre2=$dia2;
	}
	public function setDiametreCompresseBouchonA($diaComp)
	{
		$this->diametreCompresse=$diaComp;
	}
	public function setHumiditeBouchonA($humi)
	{
		$this->humidite=$humi;
	}
}


?>