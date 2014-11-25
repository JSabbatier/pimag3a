<?php 

class CommandeFournisseur
{
	private $id_cmd_fournisseur;
	private $idFournisseur;
	private $dt_commande;
	private $dt_livraison;
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
	public function getIdCmdFournisseur()
	{
		return $this->id_cmd_fournisseur;
	}
	public function getIdFournisseur()
	{
		return $this->idFournisseur;
	}
	public function getDtCommande()
	{
		return $this->dt_commande;
	}
	public function getDtLivraison()
	{
		return $this->dt_livraison;
	}
	public function getEtat()
	{
		return $this->etat;
	}
			
	/***********************************************
						setters
	************************************************/
	public function setIdCmdFournisseur($id_cmd_fournisseur)
	{
		$this->id_cmd_fournisseur=$id_cmd_fournisseur;
	}
	public function setIdFournisseur($idFournisseur)
	{
		$this->idFournisseur=$idFournisseur;
	}
	public function setDtCommande($dt_commande)
	{
		$this->dt_commande=$dt_commande;
	}
	public function setDtLivraison($dt_livraison)
	{
		$this->dt_livraison=$dt_livraison;
	}
	public function setEtat($etat)
	{
		$this->etat=$etat;
	}

}
?>