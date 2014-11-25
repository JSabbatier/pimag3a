<?php
require_once("fournisseur.php");
class DaoFournisseur
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
	
	public function getFournisseurById($id)
	{
		$query="select * from fournisseur where id_fournisseur=:idFournisseur";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idFournisseur',$id);
		
		$rs->execute();
		
		$fourni = new Fournisseur;
		$row= $rs->fetch();
		
		$fourni->setAdresseFournisseur($row['adresse']);
		$fourni->setContacteFournisseur($row['contact']);
		$fourni->setEmailContactFournisseur($row['email_contact']);
		$fourni->setFaxFournisseur($row['fax']);
		$fourni->setIdFournisseur($id);
		$fourni->setNomFournisseur($row['nom_fournisseur']);
		$fourni->setRaisonFournisseur($row['raison']);
		$fourni->setTelephoneFournisseur($row['numero_tel']);
		$fourni->setEtatFournisseur($row['etat']);
		
		return $fourni;
	}
	public function getListeFournisseurs()
	{
		$query="select * from fournisseur ";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$list = array();
		$fourni = new Fournisseur;
		while($row = $rs->fetch())
		{
			$fourni= $this->getFournisseurById($row['id_fournisseur']);
			$list[]=$fourni;
		}
		return $list;
	}
	public function ajoutFournisseur($fournisseur)
	{
		$query="insert into fournisseur (adresse,contact,email_contact,fax,nom_fournisseur,raison,numero_tel,etat) values (:adr,:contact,:email,:fax,:nom,:raison,:numTel,:etat)";
		$rs=$this->dbh->prepare($query);
		$tmp= new Fournisseur;
		$tmp = $fournisseur;
		$rs->bindValue(':adr',$tmp->getAdresseFournisseur());
		$rs->bindValue(':contact',$tmp->getContactFournisseur());
		$rs->bindValue(':email',$tmp->getEmailContactFournisseur());
		$rs->bindValue(':fax',$tmp->getFaxFournisseur());
		$rs->bindValue(':nom',$tmp->getNomFournisseur());
		$rs->bindValue(':raison',$tmp->getRaisonFournisseur());
		$rs->bindValue(':numTel',$tmp->getTelephoneFournisseur());
		$rs->bindValue(':etat',$tmp->getEtatFournisseur());
		
		$rs->execute();
		return $this->dbh->lastInsertId();
		
	}
	public function updateFournisseur($fournisseur)
	{
		$tmp = new Fournisseur;
		$tmp = $fournisseur;
             
		$query="update fournisseur set nom_fournisseur=:nomFournisseur,numero_tel=:num,adresse=:adr,fax=:fax,contact=:ctc,email_contact=:email,raison=:raison,etat=:etat where id_fournisseur = :id";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':nomFournisseur',$tmp->getNomFournisseur());
		$rs->bindValue(':num',$tmp->getTelephoneFournisseur());
		$rs->bindValue(':adr',$tmp->getAdresseFournisseur());
		$rs->bindValue(':fax',$tmp->getFaxFournisseur());
		$rs->bindValue(':ctc',$tmp->getContactFournisseur());
		$rs->bindValue(':email',$tmp->getEmailContactFournisseur());
		$rs->bindValue(':raison',$tmp->getRaisonFournisseur());
		$rs->bindValue(':id',$tmp->getIdFournisseur());
		$rs->bindValue(':etat',$tmp->getEtatFournisseur());
		
		$rs->execute();
	}
}
?>