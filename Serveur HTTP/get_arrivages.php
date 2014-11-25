<?php
date_default_timezone_set('Europe/Berlin');
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objArrivage = new DaoArrivage();
$objFournisseur = new DaoFournisseur();
//$arrivage = new Arrivage();
$liste_arrivage = Array();

$liste_arrivage = $objArrivage -> getListeArrivage();
$retour = Array();

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

foreach($liste_arrivage as $arrivage)
{
	$timecour = strtotime($arrivage -> getDate());
	if(((isset($_POST["id_fournisseur"]) && $_POST["id_fournisseur"] == $arrivage -> getIdFournisseur()) || !isset($_POST["id_fournisseur"]))
		&& ((isset($datedebut) && $timecour >= $timedebut) || !isset($_POST["datedebut"]) )
		&& ((isset($datefin) && $timecour <= $timefin) || !isset($_POST["datefin"]) ))
	{
		$fournisseur = $objFournisseur->getFournisseurById($arrivage -> getIdFournisseur());
		$retour["lots"][] = Array(	"id_lot" => $arrivage -> getIdLot(),
									"id_fournisseur" => $arrivage -> getIdFournisseur(),
									"nom_fournisseur" => $fournisseur -> getNomFournisseur(),
									"date" => $arrivage -> getDate(),
									"validite" => $arrivage -> getValidite(),
									"controle" => $arrivage -> getControle(),
									"prix_achat" => $arrivage -> getPrixAchat(),
									"devise" => $arrivage -> getDevise(),
									"taille" => $arrivage -> getTaille(),
									"qualite" => $arrivage -> getQualite(),
									"quantite" => $arrivage -> getQuantite(),									
									"etat" => $arrivage -> getEtat()
									);
	}
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>