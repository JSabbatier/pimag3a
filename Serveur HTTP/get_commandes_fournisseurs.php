<?php
date_default_timezone_set('Europe/Berlin');
require_once("../../../../mdacosta/www/pima3a/classes/daoCommandeFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoPanier.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objCommande = new DaoCommandeFournisseur();
$liste_commande = Array();
$objPanier = new DaoPanier();
$liste_panniers = Array();

$liste_commande = $objCommande -> getListeCommandesFournisseur();

$retour = Array();
if (isset($_POST["id_client"]))
{
	$id = $_POST["id_client"];
	if (is_numeric($id))
	{
		$id_client = intval($id);
		$client = $objClient -> getClientById($id_client);
	}
	else
	{
		$retour_txt = "ID is not numeric";
		$retour_code = "400 Bad Request";
		$error = "yes";
	}
}
if(isset($_POST["datedebut"]))
{
	list($day,$mon,$year) = explode('/', $_POST["datedebut"]);
	$datedebut = "$year-$mon-$day";
	$timedebut = strtotime($datedebut);
}
if(isset($_POST["datefin"]))
{
	list($day,$mon,$year) = explode('/', $_POST["datefin"]);
	$datefin = "$year-$mon-$day";
	$timefin = strtotime($datefin);
}

foreach($liste_commande as $commande)
{
	$timecour = strtotime($commande -> getDtCommande());
	if(((isset($_POST["id_fournisseur"]) && $_POST["id_fournisseur"] == $commande -> getIdFournisseur()) || !isset($_POST["id_fournisseur"]))
		&& ((isset($datedebut) && $timecour >= $timedebut) || !isset($_POST["datedebut"]) )
		&& ((isset($datefin) && $timecour <= $timefin) || !isset($_POST["datefin"]) ))
	{
		$liste_paniers = $objPanier -> getListeOfPanierByCommandeFournisseur($commande -> getIdCmdFournisseur());
		
		//$panier = $objPanier -> getPanierById($commande -> getIdCmdFournisseur());			
		$panier = Array();
		foreach($liste_paniers as $panier_cour)
		{
			if ($panier_cour->getIdCommandeFournisseur() == $commande -> getIdCmdFournisseur())
			{
				$panier[] = Array(	"id_panier" => $panier_cour->getIdPanier(),
									"id_commande_fournisseur" =>  $panier_cour->getIdCommandeFournisseur(),
									"qualite" =>  $panier_cour->getQualite(),
									"quantite" =>  $panier_cour->getQuantite(),
									"longueur" =>  $panier_cour->getLongueur(),
									"marquage" =>  $panier_cour->getMarquage(),
									"prix" =>  $panier_cour->getPrixNegocie(),
									"devise" =>  $panier_cour->getDevise(),
									"controle" =>  $panier_cour->getControle()
								);
			}
		}
		$retour["commandes"][] = Array(	"id_commande" => $commande -> getIdCmdFournisseur(),
									"id_fournisseur" => $commande -> getIdFournisseur(),
									"date_commande" => $commande -> getDtCommande(),
									"date_livraison" => $commande -> getDtLivraison(),
									"etat" => $commande -> getEtat(),
									"paniers" => $panier
									);
	}
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
echo json_encode($retour);
?>