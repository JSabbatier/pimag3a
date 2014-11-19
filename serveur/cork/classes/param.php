<?php 

class Param
{
	private $id;
	private $nom;
	private $typeParam;
	private $valInt;
	private $valInt2;
	private $valInt3;
	private $valChar;
	private $valChar2;
	private $valChar3;
	private $valFloat;
	private $valFloat2;
	private $valFloat3;
	
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
	public function getNom()
	{
		return $this->nom;
	}
	public function getTypeParam()
	{
		return $this->typeParam;
	}
	public function getValInt()
	{
		return $this->valInt;
	}
	public function getValInt2()
	{
		return $this->valInt2;
	}
	public function getValInt3()
	{
		return $this->valInt3;
	}
	public function getChar()
	{
		return $this->valChar;
	}
	public function getChar2()
	{
		return $this->valChar2;
	}
	public function getChar3()
	{
		return $this->valChar3;
	}
	public function getFloat()
	{
		return $this->valFloat;
	}
	public function getFloat2()
	{
		return $this->valFloat2;
	}	
	public function getFloat3()
	{
		return $this->valFloat3;
	}		
	/***********************************************
						setters
	************************************************/
	public function setId($idpanier)
	{
		$this->id=$idpanier;
	}
	public function setNom($id)
	{
		$this->nom=$id;
	}
	public function setTypeParam($typeParam)
	{
		$this->typeParam=$typeParam;
	}
	public function setValInt($valInt)
	{
		$this->valInt=$valInt;
	}
	public function setValInt3($valInt2)
	{
		$this->valInt2=$valInt2;
	}
	public function setValInt3($valInt3)
	{
		$this->valInt3=$valInt3;
	}
	public function setChar($valChar)
	{
		$this->valChar=$valChar;
	}
	public function setChar2($valChar2)
	{
		$this->valChar2=$valChar2;
	}
	public function setChar3($valChar3)
	{
		$this->valChar3=$valChar3;
	}
	public function setValFloat($valFloat)
	{
		$this->valFloat=$valFloat;
	}	
	public function setValFloat2($valFloat2)
	{
		$this->valFloat2=$valFloat2;
	}	
	public function setValFloat3($valFloat3)
	{
		$this->valFloat3=$valFloat3;
	}	
}
?>