<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoCommande.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoAdresse.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objCommande = new DaoCommande();
$commande = new Commande();

$objAdresse = new DaoAdresse();
$adresse = new Adresse();
$listeAdresse = Array();

$retour = Array();
$error = "no";
$retour_txt = "defaut";
$retour_code = "400 Bad Request";

function ean13_put_digit($digits)
{
	$out = $digits;
   $digits=preg_split("//",$digits,-1,PREG_SPLIT_NO_EMPTY);
   $a=$b=0;
   for($i=0;$i<5;$i++)
   {
	  $a+=(int)array_shift($digits);
	  $b+=(int)array_shift($digits);
   }
   $total=($a*1)+($b*3);
   $nextten=ceil($total/10)*10;
   return $out.$nextten-$total;
}

if (isset($_POST["id_commande"]))
{
	$id = $_POST["id_commande"];
	if (is_numeric($id))
	{
		$id_commande = intval($id);
		$commande = $objCommande -> getCommandeById($id_commande);
	}
	else
	{
		$retour_txt = "ID is not numeric";
		$retour_code = "400 Bad Request";
		$error = "yes";
	}
}
else 
{
	$retour_txt = "No ID given";
	$error = "no";
}

if (isset($_POST["operation"]))
{
	$operation = $_POST["operation"];
}
else 
{
	$retour_txt = "No operation given";
	$retour_code = "400 Bad Request";
		$error = "yes";
}

if ($error == "no")	
{
	if ($operation == "ajouter")
	{
		// Ajout commande
		$commande -> setIdClient($_POST["client"]);
		$commande -> setDtCommande($_POST["date_commande"]);
		$commande -> setDtLivraisonSouhaite($_POST["date_livraison_souhaite"]);
		$commande -> setDelaiPaiement($_POST["delai_paiement"]);
		$commande -> setIdCommercial($_POST["id_commercial"]);
		$commande -> setEtat("actif");
		$id_commande = $objCommande -> ajoutCommande($commande);
		$commande -> setId($id_commande);
		$codebarre =  str_pad($_POST["client"], 4, "0", STR_PAD_LEFT);
		$codebarre .=  str_pad($id_commande, 6, "0", STR_PAD_LEFT);
		$codebarre = ean13_put_digit($codebarre."0");
		$commande -> setCodeBarre($codebarre);
		
		$objAdresse -> updateAdresse($adresse);
			
		$retour_txt = "Commande created";
		$retour_code = "201 Created";
	}
	else if ($operation == "modifier")
	{
		// Modification commande
		if(isset($_POST["nom"]))
			$commande -> setNomCommande($_POST["nom"]);
		if(isset($_POST["tel"]))
			$commande -> setNumeroTel($_POST["tel"]);
		if(isset($_POST["fax"]))
			$commande -> setFax($_POST["fax"]);
		if(isset($_POST["contact"]))
			$commande -> setNomContact($_POST["contact"]);
		if(isset($_POST["mail"]))
			$commande -> setEmailContact($_POST["mail"]);
		if(isset($_POST["raison"]))
			$commande -> setRaison($_POST["raison"]);
		if(isset($_POST["commercial"]) && is_numeric($_POST["commercial"]))
			$commande -> setIdCommercial($_POST["commercial"]);
		if(isset($_POST["etat"]))
			$commande -> setEtat($_POST["etat"]);
		if(isset($_POST["adresse_f"]))
		{
			$adresse = new Adresse();		
			$listeAdresse = $objAdresse -> getListeAdresseByIdCommande($id_commande);
			foreach($listeAdresse as $adresse)
			{
				if ($adresse->getNom() == "facturation")
				{
					$adresse -> setAdresse($_POST["adresse_f"]);
					$objAdresse -> updateAdresse($adresse);
				}
			}
		}
		if(isset($_POST["adresse_l"]))
		{
			$adresse = new Adresse();		
			$listeAdresse = $objAdresse -> getListeAdresseByIdCommande($id_commande);
			foreach($listeAdresse as $adresse)
			{
				if ($adresse->getNom() != "facturation")
				{
					$adresse -> setAdresse($_POST["adresse_l"]);
					$objAdresse -> updateAdresse($adresse);
				}
			}
		}
		$objCommande -> updateCommande($commande);
		$retour_txt = "User updated";
		$retour_code = "200 OK";
	}
	else if ($operation == "supprimer")
	{
		// Suppression commande (état)
		$commande -> setEtat("supprime");
		$objCommande -> updateCommande($commande);	
		$retour_txt = "User deleted";
		$retour_code = "200 OK";
		
	}
	else if ($operation == "masquer")
	{
		// masquage commande (état)
		$commande -> setEtat("masque");
		$objCommande -> updateCommande($commande);	
		$retour_txt = "User hidden";
		$retour_code = "200 OK";
	}
	else if ($operation == "activer")
	{
		// masquage commande (état)
		$commande -> setEtat("actif");
		$objCommande -> updateCommande($commande);	
		$retour_txt = "User activated";
		$retour_code = "200 OK";
	}
}

header("HTTP/1.1 ".$retour_code);
echo json_encode($retour_txt);
?>
