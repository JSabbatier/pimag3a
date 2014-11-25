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
		$rs->bindValue(':idExpe',$id);
		
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
		$rs->bindValue(':idExpe',$id);
		
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
		$rs->bindValue(':idExpe',$id);
		
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
	public function ajoutExpedition($expedition)
	{
		$tmp = new Expedition;
		$tmp = $expedition;
		$query="insert into expedition (id_commande,id_lot,quantite) values (:idCmd,:idLot,:qte)";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idCmd',$tmp->getIdCommande());
		$rs->bindValue(':idLot',$tmp->getIdLot());
		$rs->bindValue(':qte',$tmp->getQuantite());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateExpedition($expe)
	{
		$tmp = new Expedition;
		$tmp = $expe;
             
		$query="update expedition set id_commande=:idCmd,id_lot=:idLot,quantite=:qte where id = :idExpe";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idExpe',$tmp->getIdExpedition());
		$rs->bindValue(':idCmd',$tmp->getIdCommande());
		$rs->bindValue(':idLot',$tmp->getIdLot());
		$rs->bindValue(':qte',$tmp->getQuantite());
		
		$rs->execute();
		
	}
	
}

?>