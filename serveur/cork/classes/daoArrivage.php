<?php
require_once("arrivage.php");
class DaoArrivage
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
	
	
	public function getArrivageById($id)
	{
		$query="select * from arrivage where id_lot=:id";
		$rs->dbh->prepare($query);
		$rs->bindParam(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		$arrivage = new Arrivage;
		
		$arrivage->setCodeBarre($row['code_barre']);
		$arrivage->setControle($row['controle']);
		$arrivage->setDate($row['date']);
		$arrivage->setDevise($row['devise']);
		$arrivage->setEtat($row['etat']);
		$arrivage->setIdFournisseur($row['id_fournisseur']);
		$arrivage->setNumeroTracabilite($row['numero_tracabilite']);
		$arrivage->setPrixAchat($row['prix_achat']);
		$arrivage->setQualite($row['qualite']);
		$arrivage->setQuantite($row['quantite']);
		$arrivage->setValidite($row['validite']);
		
		return $arrivage;
		
	}
	
	public function ajoutArrivage($arrivage)
	{
		$tmp = new Arrivage;
		$tmp = $arrivage;
		$query="insert into arrivage (date,id_fournisseur,qualite,quantite,numero_tracabilite,validite,prix_achat,devise,code_barre,etat,controle) values(:date,:id_fournisseur,:qualite,:quantite,:numero_tracabilite,:validite,:prix_achat,:devise,:code_barre,:etat,:controle)";
		$rs->dbh->prepare($query);
		
		$rs->bindParam(':controle', $tmp->getControle());
		$rs->bindParam(':date',$tmp->getDate());
		$rs->bindParam(':id_fournisseur',$tmp->getIdFournisseur());
		$rs->bindParam(':qualite',$tmp->getQualite());
		$rs->bindParam(':quantite',$tmp->getQuantite());
		$rs->bindParam(':numero_tracabilite',$tmp->getNumerotracabilite());
		$rs->bindParam(':validite',$tmp->getValidite());
		$rs->bindParam(':prix_achat',$tmp->getPrixAchat());
		$rs->bindParam(':devise',$tmp->getdevise());
		$rs->bindParam(':code_barre',$tmp->getCodeBarre());
		$rs->bindParam(':etat',$tmp->getEtat());
		
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function updateArrivage($arrivage)
	{
		$tmp = new Arrivage;
		$tmp = $arrivage;
		$query="update arrivage SET (date=:date,id_fournisseur=:id_fournisseur,qualite=:qualite,quantite=:quantite,numero_tracabilite=:numero_tracabilite,validite=:validite,prix_achat=:prix_achat,devise=:devise,code_barre=:code_barre,etat=:etat,controle=:controle) where id_lot=:id";
		$rs->dbh->prepare($query);
		$rs->bindParam(':id', $tmp->getIdLot());
		$rs->bindParam(':controle', $tmp->getControle());
		$rs->bindParam(':date',$tmp->getDate());
		$rs->bindParam(':id_fournisseur',$tmp->getIdFournisseur());
		$rs->bindParam(':qualite',$tmp->getQualite());
		$rs->bindParam(':quantite',$tmp->getQuantite());
		$rs->bindParam(':numero_tracabilite',$tmp->getNumerotracabilite());
		$rs->bindParam(':validite',$tmp->getValidite());
		$rs->bindParam(':prix_achat',$tmp->getPrixAchat());
		$rs->bindParam(':devise',$tmp->getdevise());
		$rs->bindParam(':code_barre',$tmp->getCodeBarre());
		$rs->bindParam(':etat',$tmp->getEtat());
		
		$rs->execute();
	}
	
}
?>