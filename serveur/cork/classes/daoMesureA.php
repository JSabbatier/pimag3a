<?php
require_once("mesureA.php");
class daoMesureA
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
	
	
		public function getMesureAById($id)
	{
		$query="select * from mesure where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$mesure = new Mesure;
		
		$mesure->setId($id);
		$mesure->setIdArrivage($row['id_arrivage']);
		$mesure->setTCAFournisseur($row['tca_fournisseur']);
		$mesure->setTCAInterne($row['tca_interne']);
		$mesure->setGout($row['gout']);
		
		return $mesure;
	}
	
	public function ajoutmesureA($mesure)
	{
		$tmp = new Mesure;
		$tmp = $mesure;
		
		$query="insert into mesure (id, id_arrivage, tca_fournisseur, tca_interne,gout) values (:id,:id_arrivage,:tca_fournisseur,:tca_interne,:gout)";
		$rs=$this->dbh->prepare($query);	
		
		$rs->bindParam(':id',$tmp->getId());
		$rs->bindParam(':id_arrivage',$tmp->getIdarrivage());
		$rs->bindParam(':tca_fournisseur',$tmp->getTCAFournisseur());
		$rs->bindParam(':tca_interne',$tmp->getTCAInterne());
		$rs->bindParam(':gout',$tmp->getGout());
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateMesureA($mesureA)
	{
		//mise a jour d'un opérateur
             
		$tmp = new MesureA;
		$tmp= $mesureA;
		 
		$query = "UPDATE mesureA SET id=:id, id_arrivage=:id_arrivage, tca_fournisseur=:tca_fournisseur, tca_interne=:tca_interne, gout=:gout";
		 
		$queryPrepared = $this->dbh->prepare($query);
		$queryPrepared->bindParam(':id',$tmp->getId());
		$queryPrepared->bindParam(':id_arrivage',$tmp->getIdArrivage());
		$queryPrepared->bindParam(':tca_fournisseur',$tmp->getTCAFournisseur());
		$queryPrepared->bindParam(':tca_interne',$tmp->getTCAInterne());
		$queryPrepared->bindParam(':gout',$tmp->getGout());
		 
		return $queryPrepared->execute();
			
	}
	
}