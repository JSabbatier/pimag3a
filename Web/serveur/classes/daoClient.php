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
		$rs->bindValue(':idClient',$id);
		
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
		$client->setIdClient($id);
		
		return $client;
	}
	
	public function getListeClients()
	{
		$query="select * from client ";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$client= new Client;
		while( $row= $rs->fetch())
		{
			$client = $this->getClientById($row['id_client']);
			$list[]= $client;
		}
		return $list;
	}
	
	public function ajoutClient($client)
	{
		$query="insert into client (nom_client,numero_tel,nom_contact,email_contact,raison,id_commercial,etat,fax) values (:nomClient,:numeroTel,:nomContact,:emailContact,:raison,:idCommercial,:etat,:fax)";
		
		$tmp = new Client;
		$tmp = $client;
		
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':nomClient',$tmp->getNomClient());
		$rs->bindValue(':numeroTel',$tmp->getNumeroTel());
		$rs->bindValue(':nomContact',$tmp->getNomContact());
		$rs->bindValue(':emailContact',$tmp->getEmailContact());
		$rs->bindValue(':raison',$tmp->getRaison());
		$rs->bindValue(':idCommercial',$tmp->getIdCommercial());
		$rs->bindValue(':etat',$tmp->getEtat());
		$rs->bindValue(':fax',$tmp->getFax());
		
		$rs->execute();
		
		return $this->dbh->lastInsertId();
		
	}
	
	public function updateClient($client)
	{
		$tmp = new Client;
		$tmp=$client;
		$query="UPDATE client SET nom_client=:nomClient,numero_tel=:numeroTel,nom_contact=:nomContact,email_contact=:emailContact,raison=:raison,id_commercial=:idCommercial,etat=:etat,fax=:fax WHERE id_client=:idClient";

		$rs = $this->dbh->prepare($query);
		$rs->bindValue(':idClient',$tmp->getIdClient());
		$rs->bindValue(':nomClient',$tmp->getNomClient());
		$rs->bindValue(':nomClient',$tmp->getNomClient());
		$rs->bindValue(':numeroTel',$tmp->getNumeroTel());
		$rs->bindValue(':nomContact',$tmp->getNomContact());
		$rs->bindValue(':emailContact',$tmp->getEmailContact());
		$rs->bindValue(':raison',$tmp->getRaison());
		$rs->bindValue(':idCommercial',$tmp->getIdCommercial());
		$rs->bindValue(':etat',$tmp->getEtat());
		$rs->bindValue(':fax',$tmp->getFax());
		
		echo "id client : ".$tmp->getIdClient();
		
		return $rs->execute();
	}
	
}
?>