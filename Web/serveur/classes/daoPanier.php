<?php
require_once("panier.php");
class DaoPanier
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
	
	public function getPanierById($id)
	{
		$query="select * from panier where id_panier=:idpanier";
		$rs=$this->dbh->prepare($query);
		$rs->bindValue(':idpanier',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$panier = new Panier;
		
		$panier->setDevise($row['devise']);
		$panier->setIdCommande($row['id_commande']);
		$panier->setIdPanier($row['id_panier']);
		$panier->setMarquage($row['marquage']);
		$panier->setPrixNegocier($row['prix_negocie']);
		$panier->setQualite($row['qualite']);
		$panier->setQuantite($row['quantite']);
		$panier->setControle($row['controle']);
		$panier->setLongueur($row['longueur']);
		$panier->setIdCmommandeFournisseur($row['id_commande_fournisseur']);
		$panier->setTaille($row['taille']);
		
		return $panier;
	}
	
	public function ajoutPanier($panier)
	{
		$tmp = new Panier;
		$tmp = $panier;
		
		$query="insert into panier (id_commande,qualite,quantite,longeur,marquage,prix_negocie,devise,controle,id_commande_fournisseur,taille) values (:idcmd,:qualite,:quantite,:longueur,:marquage,:prixNegocie,:devise,:controle,:idCmdF,:taille)";
		$rs=$this->dbh->prepare($query);
		
		
		$rs->bindValue(':taille',$tmp->getTaille());
		$rs->bindValue(':idcmd',$tmp->getIdCommande());
		$rs->bindValue(':qualite',$tmp->getQualite());
		$rs->bindValue(':longueur',$tmp->getLongueur());
		$rs->bindValue(':quantite',$tmp->getQuantite());
		$rs->bindValue(':marquage',$tmp->getMarquage());
		$rs->bindValue(':prixNegocie',$tmp->getPrixNegocier());
		$rs->bindValue(':devise',$tmp->getDevise());
		$rs->bindValue(':controle',$tmp->getControle());
		$rs->bindValue(':idCmF',$tmp->getIdCommandeFournisseur());
		
		
		$rs->execute();
		return $this->dbh->lastInsertId();
	}
	
	public function getListeOfPanierByCommande($idcommande)
	{
		$query="select * from panier where id_commande=:idcmd";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindValue(':idcmd',$idcommande);
		$rs->execute();
		$panier = new Panier;
		while( $row= $rs->fetch())
		{
			$panier = $this->getPanierById($row['id_panier']);
			$list[]= $panier;
		}
		return $list;
		
	}
	public function updatePanier($panier)
	{
		$tmp = new Panier;
		$tmp = $panier;
		$query="update panier set(id_commande=:idcmd,qualite=:qualite,quantite=:quantite,longeur=:longueur,marquage=:marquage,prix_negocie=:prixNegocie,devise=:devise,controle=:controle,id_commande_fournisseur=:idCmdF,taille=:taille) where id_panier=:id";
		
		$rs=$this->dbh->prepare($query);
		
		
		$rs->bindValue(':taille',$tmp->getTaille());
		$rs->bindValue(':idcmd',$tmp->getIdCommande());
		$rs->bindValue(':qualite',$tmp->getQualite());
		$rs->bindValue(':longueur',$tmp->getLongueur());
		$rs->bindValue(':quantite',$tmp->getQuantite());
		$rs->bindValue(':marquage',$tmp->getMarquage());
		$rs->bindValue(':prixNegocie',$tmp->getPrixNegocier());
		$rs->bindValue(':devise',$tmp->getDevise());
		$rs->bindValue(':controle',$tmp->getControle());
		$rs->bindValue(':idCmF',$tmp->getIdCommandeFournisseur());
		$rs->execute();
	}
	
}
?>