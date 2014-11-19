<?php
require_once("mesure.php");
class daoMesure
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
	
	
		public function getMesureById($id)
	{
		$query="select * from mesure where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$mesure = new mesure;
		
		$mesure->setIdArrivage($row['id_arrivage']);
		$mesure->setTCAFournisseur($row['tca_fournisseur']);
		$mesure->setTCAInterne($row['tca_interne']);
		$mesure->setGout($row['gout']);
		
		return $mesure;
	}
	
	public function ajoutmesure($mesure)
	{
		$tmp = new mesure;
		$tmp = $mesure;
		
		$query="insert into mesure (id_arrivage,tca_fournisseur,tca_interne,gout) values (:idcmd,:tca_fournisseur,:tca_interne,:gout)";
		$rs=$this->dbh->prepare($query);	
		
		$rs->bindParam(':idcmd',$tmp->getIdarrivage());
		$rs->bindParam(':tca_fournisseur',$tmp->getTCAFournisseur());
		$rs->bindParam(':tca_interne',$tmp->getTCAInterne());
		$rs->bindParam(':gout',$tmp->getgout());
		$rs->execute();
	}
	
	public function updatemesure($mesure)
	{
		
	}
	
}