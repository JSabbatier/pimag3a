<?php
require_once("panier.php");
class daoPanier
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
		$rs->bindParam(':idpanier',$id);
		
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
		
		return $panier;
	}
	
	public function ajoutPanier($panier)
	{
		$tmp = new Panier;
		$tmp = $panier;
		
		$query="insert into panier (id_commande,qualite,quantite,marquage,prix_negocie,devise) values (:idcmd,:qualite,:quantite,:marquage,:prixNegocie,:devise)";
		$rs=$this->dbh->prepare($query);
		
		
		$rs->bindParam(':idcmd',$tmp->getIdCommande());
		$rs->bindParam(':qualite',$tmp->getQualite());
		$rs->bindParam(':quantite',$tmp->getQuantite());
		$rs->bindParam(':marquage',$tmp->getMarquage());
		$rs->bindParam(':prixNegocie',$tmp->getPrixNegocier());
		$rs->bindParam(':devise',$tmp->getDevise());
		
		$rs->execute();
	}
	
	public function getListOfPanierByCommande($idcommande)
	{
		$query="select id_panier from panier where id_commande=:idcmd";
		$rs=$this->dbh->prepare($query);
		
		$rs->bindParam(':idcmd',$idcommande);
		$rs->execute();
		$panier = new Panier;
		while( $row= $rs->fetch())
		{
			$panier = $this->getPanierById($row['id_panier']);
			$list[]= $panier;
		}
		return $list;
		
	}
	
}
?>