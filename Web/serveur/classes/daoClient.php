<?php
require_once("client.php");
class DaoClient
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
	
	public function getClientById($id)
	{
		$query="select * from client where id_client=:idClient";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':idclient',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$client = new Client;
		
		$client->setNomClient($row['nom_client']);
		$client->setNumeroTel($row['numeroTel']);
		$client->setAdresseFacturation($row['adresse_facturation']);
		$client->setadresseLivraison($row['adresse_livraison']);
		$client->setEmail($row['email']);
		$client->setContact($row['contact']);
		$client->setType($row['type']);
		
		return $client;
	}
	
	public function getListOfClientByid($id)
	{
		$query="select id_client from client where id_client=:idClient";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindParam(':idcmd',$idcommande);
		$rs->execute();
		$panier = new Client;
		while( $row= $rs->fetch())
		{
			$panier = $this->getListOfClientrByid($row['id_client']);
			$list[]= $client;
		}
		
	}
	
}
?>