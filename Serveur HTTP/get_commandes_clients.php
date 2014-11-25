<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoCommande.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoPanier.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

date_default_timezone_set('Europe/Berlin');

$objCommande = new DaoCommande();
$liste_commande = Array();
$objPanier = new DaoPanier();
$liste_panniers = Array();
$objClient = new DaoClient();

$liste_commande = $objCommande -> getListeCommandes();
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
	if(((isset($_POST["id_client"]) && $_POST["id_client"] == $commande -> getIdClient()) || !isset($_POST["id_client"]))
		&& ((isset($datedebut) && $timecour >= $timedebut) || !isset($_POST["datedebut"]) )
		&& ((isset($datefin) && $timecour <= $timefin) || !isset($_POST["datefin"]) ))
	{
		$liste_paniers = $objPanier -> getListeOfPanierByCommande($commande -> getIdCommande());
		$panier = Array();							
		foreach($liste_paniers as $panier_cour)
		{
			if ($panier_cour->getIdCommande() == $commande -> getIdCommande())
			{
				$panier[] = Array(	"id_panier" => $panier_cour->getIdPanier(),
						"id_commande_fournisseur" =>  $panier_cour->getIdCommande(),
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
		$retour["commandes"][] = Array(	"id_commande" => $commande -> getIdCommande(),
										"id_client" => $commande -> getIdClient(),
										"id_commercial" => $commande -> getIdCommercial(),
										"date_commande" => $commande -> getDtCommande(),
										"date_livraison_souhaite" => $commande -> getDtLivraisonSouhaite(),
										"date_livraison_reel" => $commande -> getDtLivraisonReel(),
										"delais" => $commande -> getDelaiPaiment(),
										"etat" => $commande -> getEtat(),
										"paniers" => $panier
									);
	}
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
echo json_encode($retour);
?>