<?php
date_default_timezone_set('Europe/Berlin');
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objArrivage = new DaoArrivage();
//$arrivage = new Arrivage();
$liste_arrivage = Array();

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
	$timecour = strtotime($arrivage -> getDate());
	if(((isset($_POST["id_fournisseur"]) && $_POST["id_fournisseur"] == $arrivage -> getIdFournisseur()) || !isset($_POST["id_fournisseur"]))
		&& ((isset($datedebut) && $timecour >= $timedebut) || !isset($_POST["datedebut"]) )
		&& ((isset($datefin) && $timecour <= $timefin) || !isset($_POST["datefin"]) ))
	{
		$retour["lots"][] = Array(	"id_lot" => $arrivage -> getIdLot(),
									"id_fournisseur" => $arrivage -> getIdFournisseur(),
									"date" => $arrivage -> getDate(),
									"validite" => $arrivage -> getValidite(),
									"controle" => $arrivage -> getControle(),
									"prix_achat" => $arrivage -> getPrixAchat(),
									"taille" => $arrivage -> getTaille(),
									"qualite" => $arrivage -> getQualite()
									);
	}
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>