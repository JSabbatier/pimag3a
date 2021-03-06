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
		$query="select * from arrivage where id_lot=:idLot";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idLot',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		$arrivage = new Arrivage;

		$arrivage->setIdLot($row['id_lot']);		
		$arrivage->setCodeBarre($row['code_barre']);
		$arrivage->setControle($row['controle']);
		$arrivage->setDate($row['date_arrivage']);
		$arrivage->setDevise($row['devise']);
		$arrivage->setEtat($row['etat']);
		$arrivage->setIdFournisseur($row['id_fournisseur']);
		$arrivage->setNumeroTracabilite($row['numero_tracabilite']);
		$arrivage->setPrixAchat($row['prix_achat']);
		$arrivage->setQualite($row['qualite']);
		$arrivage->setQuantite($row['quantite']);
		$arrivage->setValidite($row['validite']);
		$arrivage->setTaille($row['taille']);
		$arrivage->setStock($row['stock']);
		
		return $arrivage;
		
	}
	
	public function ajoutArrivage($arrivage)
	{
		$tmp = new Arrivage;
		$tmp = $arrivage;
		$query="insert into arrivage (date_arrivage,id_fournisseur,qualite,quantite,numero_tracabilite,validite,prix_achat,devise,code_barre,etat,controle,taille,stock) values(:ladate,:id_fournisseur,:qualite,:quantite,:numero_tracabilite,:validite,:prix_achat,:devise,:code_barre,:etat,:controle,:taille,:stock)";
		
		$rs=$this->dbh->prepare($query);
		
		$rs->bindValue(':controle', $tmp->getControle());
		$rs->bindValue(':ladate',$tmp->getDate());
		$rs->bindValue(':id_fournisseur',$tmp->getIdFournisseur());
		$rs->bindValue(':qualite',$tmp->getQualite());
		$rs->bindValue(':quantite',$tmp->getQuantite());
		$rs->bindValue(':numero_tracabilite',$tmp->getNumerotracabilite());
		$rs->bindValue(':validite',$tmp->getValidite());
		$rs->bindValue(':prix_achat',$tmp->getPrixAchat());
		$rs->bindValue(':devise',$tmp->getdevise());
		$rs->bindValue(':code_barre',$tmp->getCodeBarre());
		$rs->bindValue(':etat',$tmp->getEtat());
		$rs->bindValue(':taille',$tmp->getTaille());	
		$rs->bindValue(':stock',$tmp->getQuantite());
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function getListeArrivage()
	{
		$query="select * from arrivage ";
		$rs=$this->dbh->prepare($query);
		
		$rs->execute();
		$arrivage= new Arrivage;
		while( $row= $rs->fetch())
		{
			$arrivage = $this->getArrivageById($row['id_lot']);
			$list[]= $arrivage;
		}
		return $list;
	}
	
	public function updateArrivage($arrivage)
	{
		$tmp = new Arrivage;
		$tmp = $arrivage;
		$query="update arrivage SET date_arrivage=:ladate,id_fournisseur=:id_fournisseur,qualite=:qualite,quantite=:quantite,numero_tracabilite=:numero_tracabilite,validite=:validite,prix_achat=:prix_achat,devise=:devise,code_barre=:code_barre,etat=:etat,controle=:controle, taille=:taille,stock=:stock where id_lot=:id";
		
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':id', $tmp->getIdLot());
		$rs->bindValue(':controle', $tmp->getControle());
		$rs->bindValue(':ladate',$tmp->getDate());
		$rs->bindValue(':id_fournisseur',$tmp->getIdFournisseur());
		$rs->bindValue(':qualite',$tmp->getQualite());
		$rs->bindValue(':quantite',$tmp->getQuantite());
		$rs->bindValue(':numero_tracabilite',$tmp->getNumerotracabilite());
		$rs->bindValue(':validite',$tmp->getValidite());
		$rs->bindValue(':prix_achat',$tmp->getPrixAchat());
		$rs->bindValue(':devise',$tmp->getdevise());
		$rs->bindValue(':code_barre',$tmp->getCodeBarre());
		$rs->bindValue(':etat',$tmp->getEtat());
		$rs->bindValue(':taille',$tmp->getTaille());
		$rs->bindValue(':stock',$tmp->getStock());
		
		$rs->execute();
	}
	
	public function decreaseStock($qte,$idLot)
	{
		$arrivage = new Arrivage;
		$arrivage = $this->getArrivageById($idLot);
		
		$query="update arrivage SET stock=:stock where id_lot=:id";
		
		$rs=$this->dbh->prepare($query);
		$nouvelleQté= $tmp->getControle() - $qte;
		$rs->bindValue(':id', $idLot);
		$rs->bindValue(':stock', $nouvelleQté);
		$rs->execute();
	}
	
	public function getListeArrivagesByTailleAndQuality($taille,$qualite)
	{
		$query="select * from arrivage where qualite=:qual and taille=:taille";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':qual', $qualite);
		$rs->bindValue(':taille', $taille);
		$rs->execute();
		$list = array();
		$arrivage= new Arrivage;
		while( $row=$rs->fetch())
		{
			$arrivage= $this->getArrivageById($row['id_lot']);
			$list[]=$arrivage;
		}
		return $list;
	}
	
	public function getStockByTailleAndQualite($qualite,$taille)
	{
		$query="select sum(stock) as stock from arrivage where qualite=:qual and taille=:taille group by qualite,taille";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':qual', $qualite);
		$rs->bindValue(':taille', $taille);
		$rs->execute();
		return $row['stock'];
		
	}
	
}
?>