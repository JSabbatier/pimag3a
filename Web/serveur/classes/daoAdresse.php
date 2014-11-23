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

		
	public function getAdresseByIdClient($id)
	{
		$query= "select * from adresse where id_adresse=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$id);
		
		$adresse = new Adresse;
		$rs->execute();
		
		$row = $rs->fetch();
		
		$adresse->setAdresse($row['adresse']);
		$adresse->setIdAdresse($row['id_adresse']);
		$adresse->setIdClient($row['id_client']);
		$adresse->setNom($row['nom']);
		
		
		
		return $adresse;
		
	}
	
	public function getListeAdressebyIdClient($idClient)
	{
		$query="select * from adresse where id_client=:id ";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id',$idClient);
		
		$rs->execute();
		$list = array();
		$adresse = new Adresse;
		while($row = $rs->fetch())
		{
			$adresse= $this->getAdresseByIdClient($row['id_adresse']);
			$list[]=$adresse;
		}
		return $list;
		
	}
	public function ajoutAdresse($adresse)
	{
		$tmp = new Adresse;
		$tmp = $adresse;
		
		$query="insert into adresse (id_adresse,id_client,adresse,nom) values (:id_adresse,:id_client,:adresse,:nom)";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id_adresse',$tmp->getIdAdresse());
		$rs->bindValue(':id_client',$tmp->getidClient());
		$rs->bindValue(':adresse',$tmp->getAdresse());
		$rs->bindValue(':nom',$tmp->getNom());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
		
		
	}
	public function updateAdresse($adresse)
	{
		$tmp = new Adresse;
		$tmp = $adresse;
             
		$query="update adresse set (id_adresse=:id_adresse,id_client=:id_client,adresse=:adresse,nom=:nom";
		$rs->bindValue(':id_adresse',$tmp->getIdAdresse());
		$rs->bindValue(':id_client',$tmp->getidClient());
		$rs->bindValue(':adresse',$tmp->getAdresse());
		$rs->bindValue(':nom',$tmp->getNom());
		
		$rs->execute();
	}
}
?>