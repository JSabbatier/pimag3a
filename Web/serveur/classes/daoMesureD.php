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
		$rs->bindValue(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$mesure = new MesureD;
		$mesure->setId($id);
		$mesure->setIdPanier($row['id_panier']);
		$mesure->setCapilarite($row['capilarite']);
		$mesure->setTCAInterne($row['tca_interne']);
		$mesure->setGout($row['gout']);
		
		return $mesure;
	}
	
	public function ajoutMesureD($mesure)
	{
		$tmp = new mesureD;
		$tmp = $mesure;

		$query="insert into mesure_D (id_panier, tca_interne,capilarite, gout) values (:id_panier,:tca_interne,:capilarite,:gout)";
		$rs=$this->dbh->prepare($query);	
		

		$rs->bindValue(':id_panier',$tmp->getIdpanier());
		$rs->bindValue(':capilarite',$tmp->getCapilarite());
		$rs->bindValue(':tca_interne',$tmp->getTCAInterne());
		$rs->bindValue(':gout',$tmp->getGout());
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateMesure($mesure)
	{

             
		$tmp = new MesureD;
		$tmp = $mesure;
		 
		$query = "UPDATE mesure_D SET id_panier=:id_panier, capilarite=:capilarite, tca_interne=:tca_interne, gout=:gout where id=:id";
		 
		$queryPrepared = $this->dbh->prepare($query);
		$queryPrepared->bindValue(':id',$tmp->getId());
		$queryPrepared->bindValue(':id_panier',$tmp->getIdPanier());
		$queryPrepared->bindValue(':capilarite',$tmp->getCapilarite());
		$queryPrepared->bindValue(':tca_interne',$tmp->getTCAInterne());
		$queryPrepared->bindValue(':gout',$tmp->getGout());
		 
		return $queryPrepared->execute();
			
	}
}
?>