<?php
require_once("commandeFournisseur.php");
class daoCommandeFournisseur
{
	public function __construct()
	{
        //Récupération des variables issues du connect.php
        global $dsn;
        global $username;
        global $password;
         
        $this->dsn = $dsn;
        $this->pwd = $password;
        $this->username = $username;
 
        //Tentative de connexion       
        try
        {
            $this->dbh = new PDO($this->dsn, $this->username, $this->pwd);
        }
        catch (PDOException $e)
        {
            die( "Erreur ! : " . $e->getMessage() );
        }
    }	
	
	private function getCommandeFournisseurByIdFournisseur($id)
	{
		$query="select * from commande_fournisseur where id_fournisseur=:idFournisseur";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idFournisseur',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$commandeFournisseur = new CommandeFournisseur;
		
		$commandeFournisseur->setIdCmdFourniseur($row['id_cmd_fournisseur']);
		$commandeFournisseur->setDtCommande($row['dt_commande']);
		$commandeFournisseur->setDtLivraison($row['dt_livraison']);
		$commandeFournisseur->setEtat($row['etat']);
		
		return $commandeFournisseur;
	}
	
	public function getCommandeFournisseurByIdCmdFournisseur($id)
	{
		$query="select * from commande_fournisseur where id_cmd_fournisseur=:idCmdFournisseur";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idCmdFournisseur',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$commandeFournisseur = new CommandeFournisseur;
		$commandeFournisseur->setIdCmdFournisseur($id);
		$commandeFournisseur->setIdFournisseur($row['id_fournisseur']);
		$commandeFournisseur->setDtCommande($row['dt_commande']);
		$commandeFournisseur->setDtLivraison($row['dt_livraison']);
		$commandeFournisseur->setEtat($row['etat']);
		
		return $commandeFournisseur;
	}
	
	public function ajoutCommandeFournisseur($commandeFournisseur)
	{
		$tmp = new CommandeFournisseur;
		$tmp = $commandeFournisseur;
		
		$query="insert into commande_fournisseur (id_commande,qualite,quantite,marquage,prix_negocie,devise) values (:idcmd,:qualite,:quantite,:marquage,:prixNegocie,:devise)";
		$rs=$this->dbh->prepare($query);
		
		
		$rs->bindParam(':idcmd',$tmp->getIdCommande());
		$rs->bindParam(':qualite',$tmp->getQualite());
		$rs->bindParam(':quantite',$tmp->getQuantite());
		$rs->bindParam(':marquage',$tmp->getMarquage());
		$rs->bindParam(':prixNegocie',$tmp->getPrixNegocie());
		$rs->bindParam(':devise',$tmp->getDevise());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function getListOfCommandeFournisseurByIdFournisseur($idFournisseur)
	{
		$query="select * from commande_fournisseur where id_cmd_fournisseur=:idCmdFournisseur";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindParam(':idCmdFournisseur',$idCmdFournisseur);
		$rs->execute();
		$commandeFournisseur = new CommandeFournisseur;
		while( $row= $rs->fetch())
		{
			$commandeFournisseur = $this->getCommandeFournisseurByIdFournisseur($row['id_fournisseur']);
			$list[]= $commandeFournisseur;
		}
		return $list;
		
	}
	
	public function getListeCommandesFournisseur()
	{
		$query="select * from commande_fournisseur";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$list = array();
		$commandeFournisseur = new CommandeFournisseur;
		while( $row= $rs->fetch())
		{
			$commandeFournisseur = $this->getCommandeFournisseurByIdCmdFournisseur($row['id_cmd_fournisseur']);
			$list[]= $commandeFournisseur;
		}
		return $list;
	}
	public function updateCmdFournisseur($cmdFournisseur)
	{
		$commande = new CommandeFournisseur;
		$commande=$cmdFournisseur;
		$query="update commande_fournisseur set id_fournisseur=:idFour, dt_commande=:dtCmd,dt_livraison=:dtLivr,etat=:etat where id_cmd_fournisseur=:id";
		
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$commande->getIdCmdFournisseur());
		$rs->bindValue(':idFour',$commande->getIdFournisseur());
		$rs->bindValue(':dtCmd',$commande->getDtCommande());
		$rs->bindValue(':dtLivr',$commande->getDtLivraison());
		$rs->bindValue(':etat',$commande->getEtat());
		
		
		$rs->execute();
	}
	
}
?>