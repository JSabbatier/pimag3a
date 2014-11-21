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
		$query="select * from commandeFournisseur where id_fournisseur=:idFournisseur";
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
		$query="select * from commandeFournisseur where id_cmdFournisseur=:idCmdFournisseur";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idCmdFournisseur',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$commandeFournisseur = new CommandeFournisseur;
		
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
		
		$query="insert into commandeFournisseur (id_commande,qualite,quantite,marquage,prix_negocie,devise) values (:idcmd,:qualite,:quantite,:marquage,:prixNegocie,:devise)";
		$rs=$this->dbh->prepare($query);
		
		
		$rs->bindParam(':idcmd',$tmp->getIdCommande());
		$rs->bindParam(':qualite',$tmp->getQualite());
		$rs->bindParam(':quantite',$tmp->getQuantite());
		$rs->bindParam(':marquage',$tmp->getMarquage());
		$rs->bindParam(':prixNegocie',$tmp->getPrixNegocier());
		$rs->bindParam(':devise',$tmp->getDevise());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function getListOfCommandeFournisseurByIdFournisseur($idFournisseur)
	{
		$query="select id_fournisseur from commandeFournisseur where id_cmd_fournisseur=:idCmdFournisseur";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindParam(':idCmdFournisseur',$idCmdFournisseur);
		$rs->execute();
		$commandeFournisseur = new CommandeFournisseur;
		while( $row= $rs->fetch())
		{
			$commandeFournisseur = $this->getCommandeFournisseurByIdFournisseur($row['id_fournisseur']);
			$list[]= $commandeFournisseur;
		}
		
	}
	
}
?>