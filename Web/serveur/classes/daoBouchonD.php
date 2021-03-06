<?php
require_once("bouchonD.php");
class DaoBouchonD
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
	
	
	public function getBouchonDbyId($id)
	{
		$query="select * from bouchon_D where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$id);
		$rs->execute();
		
		$row= $rs->fetch();
		
		$bouchonD= new BouchonD;
		$bouchonD->setNumTracabiliteBouchonD($row['numero_tracabilite']);
		$bouchonD->setDiametre1BouchonD($row['diametre1']);
		$bouchonD->setDiametre2BouchonD($row['diametre2']);
		$bouchonD->setDiametreCompresseBouchonD($row['diametre_compresse']);
		$bouchonD->setHumiditeBouchonD($row['humidite']);
		$bouchonD->setIdDrrivageBouchonD($row['id']);
		$bouchonD->setIdBouchonD($row['id_panier']);
		$bouchonD->setLongueurBouchonD($row['longueur']);
		
		return $bouchonD;
	}
	
	public function getListBouchonDByIdPanier($idPanier)
	{
		$query="select * from bouchon_D where id_panier=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$idPanier);
		$rs->execute();
		
		
		$list = array();
		$bouchonD= new BouchonD;
		while($row= $rs->fetch())
		{	
			$bouchonD= $this->getBouchonDbyId($row['id']);
			$list[]=$bouchonD;
		}
		return $list;
	}
	
	public function ajoutBouchonD($bouchon)
	{
		$query= "insert into bouchon_D (id_panier, numero_tracabilite, longueur, diametre1, diametre2, diametre_compresse,humidite) values (:idPanier, :numTrac, :long, :dia1, :dia2, :diaComp, :humi)";
		$tmp = new BouchonD;
		$tmp = $bouchon;
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idPanier',$tmp->getIdPanierBouchonD());
		$rs->bindValue(':numTrac',$tmp->getNumTracabiliteBouchonD());
		$rs->bindValue(':long',$tmp->getLongueurBouchonD());
		$rs->bindValue(':dia1',$tmp->getDiametre1BouchonD());
		$rs->bindValue(':dia2',$tmp->getDiametre2BouchonD());
		$rs->bindValue(':diaComp',$tmp->getDiametreCompresse());
		$rs->bindValue(':humi',$tmp->getHumidite());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	public function updateBouchonD($bouchon)
	{
		$tmp = new BouchonD;
		$tmp = $bouchon;
		$query= "update bouchon_D set id_arrivage=:idArrivage,longueur=:long,diametre1=:dia1,diametre2=:dia2,diametre_compresse=:diaComp,humidite=:humi where id=:id";
		$rs->bindValue(':id',$tmp->getIdBouchonD());
		$rs->bindValue(':idPanier',$tmp->getIdDrrivageBouchonD());
		$rs->bindValue(':numTrac',$tmp->getNumTracabiliteBouchonD());
		$rs->bindValue(':long',$tmp->getLongueurBouchonD());
		$rs->bindValue(':dia1',$tmp->getDiametre1BouchonD());
		$rs->bindValue(':dia2',$tmp->getDiametre2BouchonD());
		$rs->bindValue(':diaComp',$tmp->getDiametreCompresse());
		$rs->bindValue(':humi',$tmp->getHumidite());;
		
		return $rs->execute();
	}
	
}
?>