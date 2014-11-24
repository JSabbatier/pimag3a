<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoPanier.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objArrivage = new DaoArrivage();
$liste_arrivage = Array();
$objArrivage = new DaoPanier();
$liste_panniers = Array();

$liste_arrivage = $objArrivage -> getListeArrivage();
$retour = Array();

if(isset($POST["datedebut"]))
{
	list($day,$mon,$year) = explode('/', $POST["datedebut"]);
	$datedebut = "$year-$mon-$day";
	$timedebut = strtotime($datedebut);
}
if(isset($POST["datefin"]))
{
	list($day,$mon,$year) = explode('/', $POST["datefin"]);
	$datefin = "$year-$mon-$day";
	$timefin = strtotime($datefin);
}

foreach($liste_arrivage as $arrivage)
{
	$timecour = strtotime($arrivage -> getDtCommande());
	if(((isset($_POST["id_fournisseur"]) && $_POST["id_fournisseur"] == $arrivage -> getIdFournisseur()) || !isset($_POST["id_fournisseur"]))
		&& ((isset($datedebut) && $timecour >= $timedebut) || !isset($_POST["datedebut"]) )
		&& ((isset($datefin) && $timecour <= $timefin) || !isset($_POST["datefin"]) ))
	{
		$liste_paniers = $objPanier -> getListeOfPanierByCommande($client -> getIdClient());
									
		foreach($liste_paniers as $panier)
		{
			$panier[] = Array("id_panier" => $panier->getId());
		}
		$retour["commandes"][] = Array(	"id_commande" => $arrivage -> getIdCmdFournisseur(),
									"id_fournisseur" => $arrivage -> getIdArrivage(),
									"date_commande" => $arrivage -> getDtCommande(),
									"date_livraison" => $arrivage -> getDtLivraison(),
									"etat" => $arrivage -> getEtat(),
									"paniers" => $panier
									);
	}
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
echo json_encode($retour);
?>