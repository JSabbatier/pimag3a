<?php

require_once("expedition.php");

class DaoExpedition
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
	
	public function getExpeditionById($id)
	{
		$query="select * from expedition where id=:idExpe";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idExpe',$id);
		
		$rs->execute();
		
		$expe = new Expedition;
		$row= $rs->fetch();
		$expe->setIdCommande($row['id_commande']);
		$expe->setIdExpedition($row['id']);
		$expe->setIdLot($row['id_lot']);
		$expe->setQuantite($row['quantite']);
		
		return $expe;
	}
	
	public function getExpeditionByCommande($idCommande)
	{
		$query="select * from expedition where id=:idExpe";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idExpe',$id);
		
		$rs->execute();
		$list=array();
		
		while($row = $rs->fetch())
		{
			$expe= new Expedition;
			$expe = $this->getExpeditionById($row['id']);
			$list[]= $expe;
			
		}
		return $list;
	}
	public function getExpeditionByLot($idLot)
	{
		$query="select * from expedition where id=:idLot";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idExpe',$id);
		
		$rs->execute();
		$list=array();
		
		while($row = $rs->fetch())
		{
			$expe= new Expedition;
			$expe = $this->getExpeditionById($row['id']);
			$list[]= $expe;
			
		}
		return $list;
		
	}
	public function addExpedition($expedition)
	{
		$tmp = new Expedition;
		$tmp = $expedition;
		$query="insert into expedition (id_commande,id_lot,quantite) values (:idCmd,:idLot,:qte)";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idCmd',$tmp->getIdCommande());
		$rs->bindParam(':idLot',$tmp->getIdLot());
		$rs->bindParam(':qte',$tmp->getQuantite());
		
		$rs->execute();
	}
	public function updateExpedition($expe)
	{
		$tmp = new Expedition;
		$tmp = $expe;
             
		$query="update expedition set (id_commande=:idCmd,id_lot=:idLot,quantite=:qte) where id = :idExpe";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idExpe',$tmp->getIdExpedition());
		$rs->bindParam(':idCmd',$tmp->getIdCommande());
		$rs->bindParam(':idLot',$tmp->getIdLot());
		$rs->bindParam(':qte',$tmp->getQuantite());
		
		$rs->execute();
		
	}
	
}

?>