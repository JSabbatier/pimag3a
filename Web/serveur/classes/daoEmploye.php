<?php
require_once("employe.php");
class DaoEmploye
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
	
	public function getEmployeById($id)
	{
		$query="select * from employes where id_employe=:idEmploye";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idEmploye',$id);
		
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$employe = new Employe;
		
		$employe->setIdEmploye($id);
		$employe->setNom($row['nom']);
		$employe->setPrenom($row['prenom']);
		$employe->setTel($row['tel']);
		$employe->setRole($row['role']);
		$employe->setAdresse($row['adresse']);
		$employe->setFax($row['fax']);
		$employe->setEmail($row['mail']);
		$employe->setEtat($row['etat']);
		
		
		
		return $employe;
	}
	
	public function getListeEmployes()
	{
		$query="select * from employes";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$list = array();
		$employe= new Employe;
		while( $row= $rs->fetch())
		{
			$employe = $this->getEmployeById($row['id_employe']);
			$list[]= $employe;
		}
		return $list;
	}
	
	public function ajoutEmploye($employe)
	{
		$query="insert into employes (nom,tel,prenom,mail,role,adresse,fax,etat) values (:nom,:tel,:prenom,:email,:role,:adresse,:fax,:etat)";
		
		$tmp = new Employe;
		$tmp = $employe;
		
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':nom',$tmp->getNom());
		$rs->bindValue(':tel',$tmp->getTel());
		$rs->bindValue(':prenom',$tmp->getPrenom());
		$rs->bindValue(':email',$tmp->getEmail());
		$rs->bindValue(':role',$tmp->getRole());

		$rs->bindValue(':adresse',$tmp->getAdresse());
		$rs->bindValue(':fax',$tmp->getFax());
		$rs->bindValue(':etat',$tmp->getEtat());
		
		$rs->execute();
		
		return $this->dbh->lastInsertId();
		
	}
	
	public function updateEmploye($employe)
	{
		$tmp = new Employe;
		$tmp=$employe;
		$query="UPDATE employes SET nom=:nom,tel=:tel,prenom=:prenom,mail=:email,role=:role,adresse=:adresse,fax=:fax, etat=:etat WHERE id_employe=:idEmploye";

		$rs = $this->dbh->prepare($query);
		$rs->bindValue(':nom',$tmp->getNom());
		$rs->bindValue(':prenom',$tmp->getPrenom());
		$rs->bindValue(':tel',$tmp->getTel());
		$rs->bindValue(':email',$tmp->getEmail());
		$rs->bindValue(':role',$tmp->getRole());
		$rs->bindValue(':adresse',$tmp->getAdresse());
		$rs->bindValue(':fax',$tmp->getFax());
		$rs->bindValue(':etat',$tmp->getEtat());
		$rs->bindValue(':idEmploye',$tmp->getIdEmploye());
		
		return $rs->execute();
	}
	
}
?>