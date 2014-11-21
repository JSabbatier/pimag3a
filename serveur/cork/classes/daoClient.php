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
		$client->setNumeroTel($row['numero_tel']);
		$client->setNomContact($row['nom_contact']);
		$client->setEmailContact($row['email_contact']);
		$client->setRaison($row['raison']);
		$client->setIdCommercial($row['id_commercial']);
		$client->setEtat($row['etat']);
		$client->setFax($row['fax']);
		
		return $client;
	}
	
	public function getListOfClientByid($id)
	{
		$query="select * from client where id_client=:idClient";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindParam(':idcmd',$idcommande);
		$rs->execute();
		$panier = new Client;
		while( $row= $rs->fetch())
		{
			$panier = $this->getListOfClientrByid($row['id_client']);
			$list[]= $client;
		}
		return $list;
	}
	
	public function ajoutClient($client)
	{
		$query="insert into client (nom_client,numeroTel,nom_contact,email_contact,raison,id_commercial,etat,fax) values (:nomClient,:numeroTel,:nomContact,:emailContact,:raison,:idComm,:etat,:fax)";
		
		$tmp = new Client;
		$tmp = $client;
		
		$rs->bindParam(':nomClient',$tmp->getNomClient());
		$rs->bindParam(':numeroTel',$tmp->getNumeroTel());
		$rs->bindParam(':nomContact',$tmp->getNomContact());
		$rs->bindParam(':emailContact',$tmp->getEmailContact());
		$rs->bindParam(':raison',$tmp->getRaison());
		$rs->bindParam(':idComm',$tmp->getIdCommercial());
		$rs->bindParam(':etat',$tmp->getEtat());
		$rs->bindParam(':fax',$tmp->getFax());
		
		$rs->execute();
		
		return $this->dbh->lastInsertId();
		
	}
	
	public function updateClient($client)
	{
		$query="update client set (nom_client=:nomClient,numeroTel=:numeroTel,nom_contact=:nomContact,email_contact=:emailContact,raison=:raison,id_commercial=:idComm,etat=:etat,fax=:=fax) where id_client=id";
		$tmp = new Client;
		$tmp=$client;
		
		$rs->bindParam(':id',$tmp->getIdClient());
		$rs->bindParam(':nomClient',$tmp->getNomClient());
		$rs->bindParam(':numeroTel',$tmp->getNumeroTel());
		$rs->bindParam(':nomContact',$tmp->getNomContact());
		$rs->bindParam(':emailContact',$tmp->getEmailContact());
		$rs->bindParam(':raison',$tmp->getRaison());
		$rs->bindParam(':idComm',$tmp->getIdCommercial());
		$rs->bindParam(':etat',$tmp->getEtat());
		$rs->bindParam(':fax',$tmp->getFax());
		
		$rs->execute();
	}
	
}
?>