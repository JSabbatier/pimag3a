<?php
require_once("adresse.php");
class daoAdresse
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
	
	
	public function getListeAdressebyIdClient()
	{
		$query="select * from adresse ";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$list = array();
		$fourni = new Adresse;
		while($row = $rs->fetch())
		{
			$fourni= $this->getAdresseByIdClient($row['id_adresse']);
			$list[]=$adresse;
		}
		
	}
	public function ajoutAdresse($adresse)
	{
		$query="insert into adresse (id_adresse,id_client,adresse,nom) values (:id_adresse,:id_client,:adresse,:nom)";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id_adresse',$id_adresse);
		$rs->bindParam(':id_client',$id_client);
		$rs->bindParam(':adresse',$adresse);
		$rs->bindParam(':nom',$nom);
		
		$rs->execute();
		return $this->dbh->lastInsertId();
		
		
	}
	public function updateAdresse($adresse)
	{
		$tmp = new Adresse;
		$tmp = $adresse;
             
		$query="update adresse set (id_adresse=:id_adresse,id_client=:id_client,adresse=:adresse,nom=:nom";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':id_adresse',$id_adresse);
		$rs->bindParam(':id_client',$id_client);
		$rs->bindParam(':adresse',$adresse);
		$rs->bindParam(':nom',$nom);
		
		$rs->execute();
	}
}
?>