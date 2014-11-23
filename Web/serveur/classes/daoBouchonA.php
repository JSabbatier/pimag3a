<?php
require_once("bouchonA.php");
class DaoBouchonA
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
	
	
	public function getBouchonAById($id)
	{
		$query="select * from bouchon_A where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$id);
		$rs->execute();
		
		$row= $rs->fetch();
		
		$bouchonA= new BouchonA;
		
		$bouchonA->setDiametre1BouchonA($row['diametre1']);
		$bouchonA->setDiametre2BouchonA($row['diametre2']);
		$bouchonA->setDiametreCompresseBouchonA($row['diametre_compresse']);
		$bouchonA->setHumiditeBouchonA($row['humidite']);
		$bouchonA->setIdArrivageBouchonA($row['id']);
		$bouchonA->setIdBouchonA($row['id_arrivage']);
		$bouchonA->setLongueurBouchonA($row['longueur']);
		
		return $bouchonA;
	}
	public function getlistBouchonAByIdArrivage($idArrivage)
	{
		$query="select * from bouchon_A where id_arrivage=:idArrivage";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idArrivage',$idArrivage);
		$rs->execute();
		$bouchon = new BouchonA;
		$list = array();
		while($row= $rs->fetch())
		{
			$bouchon = $this->getBouchonAById($row['id']);
			$list[]= $bouchon;
		}
		return $list;
	}
	
	public function ajoutBouchonA($bouchonA)
	{
		$query= "insert into bouchon_A (id_arrivage,longueur,diametre1,diametre2,diametre_compresse,humidite) values (:idArrivage,:long,:dia1,:dia2,:diaComp,:humi)";
		$tmp = new BouchonA;
		$tmp = $bouchonA;
		$rs=$this->dbh->prepare($query);
		
		$rs->bindValue(':idArrivage',$tmp->getIdArrivageBouchonA());
		$rs->bindValue(':long',$tmp->getLongueurBouchonA());
		$rs->bindValue(':dia1',$tmp->getDiametre1BouchonA());
		$rs->bindValue(':dia2',$tmp->getDiametre2BouchonA());
		$rs->bindValue(':diaComp',$tmp->getDiametreCompresseBouchonA());
		$rs->bindValue(':humi',$tmp->getHumiditeBouchonA());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateBouchonA($bouchon)
	{
		$tmp = new BouchonA;
		$tmp = $bouchon;
		$query= "update bouchon_A set (id_arrivage=:idArrivage,longueur=:long,diametre1=:dia1,diametre2=:dia2,diametre_compresse=:diaComp,humidite=:humi) where id=:id";
		$rs->bindValue(':id',$tmp->getIdBouchonA());
		$rs->bindValue(':idArrivage',$tmp->getIdArrivageBouchonA());
		$rs->bindValue(':long',$tmp->getLongueurBouchonA());
		$rs->bindValue(':dia1',$tmp->getDiametre1BouchonA());
		$rs->bindValue(':dia2',$tmp->getDiametre2BouchonA());
		$rs->bindValue(':diaComp',$tmp->getDiametreCompresseBouchonA());
		$rs->bindValue(':humi',$tmp->getHumiditeBouchonA());
		
		return $rs->execute();
	}
	
}

?>