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
		$rs->bindValue(':idCommande',$idCommande);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$commande = new Commande;
		
		$commande->setIdCommande($row['id_commande']);
		$commande->setDtCommande($row['dt_commande']);
		$commande->setDtLivraisonSouhaite($row['dt_livraison_souhaite']);
		$commande->setDtLivraisonReel($row['dt_livraison_reel']);
		$commande->setDelaiPaiment($row['delai_paiement']);
		$commande->setIdCommercial($row['id_commercial']);
		$commande->setCodeBarre($row['code_barre']);
		
		
		$commande->setEtat($row['etat']);
		$commande->setIdClient($row['id_client']);
		
		return $commande;
	}
	
	public function getListeCommandes()
	{
		$query="select * from commande";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$list = array();
		$commande = new Commande;
		
		while( $row = $rs->fetch() )
		{
			
			$commande = $this->getCommandeById($row['id_commande']);
			$list[] = $commande;
		}
		return $list;
		
	}

	public function getCommandeByCodeBarre($codeBarre)
	{
		$query="select * from commande where code_barre=:codeBarre";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':code_barre',$codeBarre);
		
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
		
		$rs->bindValue(':id_commande',$tmp->getIdCommande());
		$rs->bindValue(':id_client',$tmp->getIdClient());
		$rs->bindValue(':dt_commande',$tmp->getCommande());
		$rs->bindValue(':dt_livraison_souhaite',$tmp->getDtLivraisonSouhaite());
		$rs->bindValue(':dt_livraison_reel',$tmp->getDtLivraisonReel());
		$rs->bindValue(':delai_paiment',$tmp->getDelaiPaiment());
		$rs->bindValue(':id_commercial',$tmp->getIdCommercial());
		$rs->bindValue(':code_barre',$tmp->getCodeBarre());
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
		$queryPrepared->bindValue(':id_commande',$tmp->getIdCommande());
		$queryPrepared->bindValue(':id_client',$tmp->getIdClient());
		$queryPrepared->bindValue(':dt_commande',$tmp->getDtCommande());
		$queryPrepared->bindValue(':dt_livraison_souhaite',$tmp->getDtLivraisonSouhaite());
		$queryPrepared->bindValue(':dt_livraison_reel',$tmp->getDtLivraisonReel());
		$queryPrepared->bindValue(':delai_paiment',$tmp->getDelaiPaiment());
		$queryPrepared->bindValue(':id_commercial',$tmp->getIdCommercial());
		$queryPrepared->bindValue(':code_barre',$tmp->getCodeBarre());
		 
		return $queryPrepared->execute();
			
	}
	
}
?>