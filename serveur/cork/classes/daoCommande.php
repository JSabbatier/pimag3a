<?php

require_once("commande.php");
class DaoCommande
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
	
//	public function;
	
	public function getCommandeById($idCommande)
	{
		$query="select * from commande where id_commande=:idCommande";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id_commande',$idCommande);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$client = new Commande;
		
		$client->setIdClient($row['id_commande']);
		$client->setDtCommande($row['dt_commande']);
		$client->setDtLivraisonSouhaite($row['dt_livraison_souhaite']);
		$client->setDtLivraisonReel($row['dt_livraison_reel']);
		$client->setDelaiPaiment($row['delai_paiment']);
		$client->setIdCommercial($row['id_commercial']);
		$client->setCodeBarre($row['code_barre']);
		
		return $commande;
	}

	public function getCommandeByCodeBarre($codeBarre)
	{
		$query="select * from commande where code_barre=:codeBarre";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':code_barre',$codeBarre);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$client = new Commande;
		
		$client->setIdCommande($row['id_commande']);
		$client->setIdClient($row['id_client']);
		$client->setDtCommande($row['dt_commande']);
		$client->setDtLivraisonSouhaite($row['dt_livraison_souhaite']);
		$client->setDtLivraisonReel($row['dt_livraison_reel']);
		$client->setDelaiPaiment($row['delai_paiment']);
		$client->setIdCommercial($row['id_commercial']);
		
		return $commande;
	}	
	
		public function ajoutCommande($commande)
	{
		$tmp = new commande;
		$tmp = $commande;
		
		$query="insert into commande (id_arrivage,tca_fournisseur,tca_interne,gout) values (:idcmd,:tca_fournisseur,:tca_interne,:gout)";
		$rs=$this->dbh->prepare($query);	
		
		$rs->bindParam(':id_commande',$tmp->getIdCommande());
		$rs->bindParam(':id_client',$tmp->getIdClient());
		$rs->bindParam(':dt_commande',$tmp->getCommande());
		$rs->bindParam(':dt_livraison_souhaite',$tmp->getDtLivraisonSouhaite());
		$rs->bindParam(':dt_livraison_reel',$tmp->getDtLivraisonReel());
		$rs->bindParam(':delai_paiment',$tmp->getDelaiPaiment());
		$rs->bindParam(':id_commercial',$tmp->getIdCommercial());
		$rs->bindParam(':code_barre',$tmp->getCodeBarre());
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateCommande($commande)
	{
		//mise a jour d'un opérateur
             
		$tmp = new Commande;
		$tmp= $commande;
		 
		$query = "UPDATE commande SET id_client=:idClient, dt_commande=:dtCommande, dt_livraison_souhaite=:dtLivraisonSouhaite, dt_livraison_reel=:dtLivraisonReel, delai_paiment=:delaiPaiment, id_commercial=:idCommercial, code_barre=:codeBarre where id_commande=:idCommande";
		 
		$queryPrepared = $this->dbh->prepare($query);
		$queryPrepared->bindParam(':id_commande',$tmp->getIdCommande());
		$queryPrepared->bindParam(':id_client',$tmp->getIdClient());
		$queryPrepared->bindParam(':dt_commande',$tmp->getDtCommande());
		$queryPrepared->bindParam(':dt_livraison_souhaite',$tmp->getDtLivraisonSouhaite());
		$queryPrepared->bindParam(':dt_livraison_reel',$tmp->getDtLivraisonReel());
		$queryPrepared->bindParam(':delai_paiment',$tmp->getDelaiPaiment());
		$queryPrepared->bindParam(':id_commercial',$tmp->getIdCommercial());
		$queryPrepared->bindParam(':code_barre',$tmp->getCodeBarre());
		 
		return $queryPrepared->execute();
			
	}
	
}
?>