<?php
require_once("mesureD.php");
class DaoMesureD
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
	
	
	public function getMesureDById($id)
	{
		$query="select * from mesure_d where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$mesure = new MesureD;
		$mesure->setId($id);
		$mesure->setIdPanier($row['id_arrivage']);
		$mesure->setCapilarite($row['capilarite']);
		$mesure->setTCAInterne($row['tca_interne']);
		$mesure->setGout($row['gout']);
		
		return $mesure;
	}
	
	public function ajoutmesure($mesure)
	{
		$tmp = new mesureD;
		$tmp = $mesure;

		$query="insert into mesure_d (id_panier, tca_interne,capilarite, gout) values (:id,:id_panier,:tca_interne,:gout)";
		$rs=$this->dbh->prepare($query);	
		
		$rs->bindParam(':id',$tmp->getId());
		$rs->bindParam(':id_panier',$tmp->getIdarrivage());
		$rs->bindParam(':capilarite',$tmp->getCapilarite());
		$rs->bindParam(':tca_interne',$tmp->getTCAInterne());
		$rs->bindParam(':gout',$tmp->getGout());
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateMesure($mesure)
	{

             
		$tmp = new MesureD;
		$tmp = $mesure;
		 
		$query = "UPDATE mesure_D SET id_arrivage=:id_arrivage, capilarite=:capi, tca_interne=:tca_interne, gout=:gout where id=:id";
		 
		$queryPrepared = $this->dbh->prepare($query);
		$queryPrepared->bindParam(':id',$tmp->getId());
		$queryPrepared->bindParam(':id_arrivage',$tmp->getIdArrivage());
		$queryPrepared->bindParam(':capi',$tmp->getCapilarite());
		$queryPrepared->bindParam(':tca_interne',$tmp->getTCAInterne());
		$queryPrepared->bindParam(':gout',$tmp->getGout());
		 
		return $queryPrepared->execute();
			
	}
}
?>