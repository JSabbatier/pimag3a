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
		$rs->bindParam(':idFournisseur',$id);
		
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
		
		return $fourni;
	}
	public function getListeFournisseur()
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
		
	}
	public function ajoutFournisseur($fournisseur)
	{
		$query="insert into fournisseur (adresse,contact,email_contact,fax,nom_fournisseur,raison,numero_tel) values (:adr,:contact,:email,:fax,:nom,:raison,:numTel)";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':adr',$id);
		$rs->bindParam(':contact',$id);
		$rs->bindParam(':email',$id);
		$rs->bindParam(':fax',$id);
		$rs->bindParam(':nom',$id);
		$rs->bindParam(':raison',$id);
		$rs->bindParam(':numTel',$id);
		
		$rs->execute();
		return $this->dbh->lastInsertId();
		
	}
	public function updateFournisseur($fournisseur)
	{
		$tmp = new Fournisseur;
		$tmp = $fournisseur;
             
		$query="update fournisseur set (nom_fournisseur=:nomFournisseur,numero_tel=:num,adresse=:adr,fax=:fax,contact=:ctc,email_contact=:email,raison=:raison) where id_fournisseur = :id";
		$rs=$this->dbh->prepare($query);
		$rs->bindParam(':nomFournisseur',$tmp->getNomFournisseur());
		$rs->bindParam(':num',$tmp->getNomFournisseur());
		$rs->bindParam(':adr',$tmp->getAdresseFournisseur());
		$rs->bindParam(':fax',$tmp->getFaxFournisseur());
		$rs->bindParam(':ctc',$tmp->getContacteFournisseur());
		$rs->bindParam(':email',$tmp->getEmailContactFournisseur());
		$rs->bindParam(':raison',$tmp->getRaisonFournisseur());
		$rs->bindParam(':id',$tmp->getIdFournisseur());
		
		$rs->execute();
	}
}
?>