<?php
/*	require_once("classes/daoArrivage.php");
	require_once("connect.php");

	$objArrivage = new DaoArrivage();
	$arrivage = new Arrivage();
	$detail_Arrivage = new Array();
*/

require_once("pdf_gen.php");
$etat = $_GET["etat"];

if ($etat == "checked"){

	$arrivage = Array();
	$seuil = Array();
	$bouchon = Array();

	$retour = Array();

	$arrivage["dateArr"] = "2014-01-15 15:10";//$arrivage -> getNomArrivage();
	$arrivage["dateCont"] = "2014-01-15 13:30";//$arrivage -> getNomArrivage();
	$arrivage["numArr"] = 123456;//$arrivage -> getNomArrivage();
	$arrivage["nomFour"] = "Love Bouchon";//$arrivage -> getAdresseArrivage();
	$arrivage["qualite"] = 5;//$arrivage -> getNumeroTelArrivage();
	$arrivage["numTrac"] = 456789;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["quantite"] = 150000;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["longueur"] = 44;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["tcaf"] = 5;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["tcai"] = 1;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["gout"] = "oui";//$arrivage -> getNumeroFaxArrivage();
	$arrivage["derog"] = "oui";//$arrivage -> getNumeroFaxArrivage();
	$arrivage["codebarre"] = "12345678904";//$arrivage -> getNumeroFaxArrivage();

	$seuil["long"]["min"] = 43.5;
	$seuil["long"]["max"] = 44.5;
	$seuil["diam1"]["min"] = 23.5;
	$seuil["diam1"]["max"] = 24.5;
	$seuil["diam2"]["min"] = 23.5;
	$seuil["diam2"]["max"] = 24.5;
	$seuil["ovali"] = 0.7;
	$seuil["humi"]["min"] = 4;
	$seuil["humi"]["max"] = 6;
	$seuil["diam_comp"] = 90;
	$seuil["tcaf"] = 2;
	$seuil["tcai"] = 2;

	$retour ["arrivage"] = $arrivage;
	$retour ["seuil"] = $seuil;

	for ($i = 1; $i<17; $i++){
		$bouchon["id"] = $i;
		$bouchon["long"] = 44;
		$bouchon["diam1"] = 24;
		$bouchon["diam2"] = 24;
		$bouchon["ovali"] = 0.5;
		$bouchon["humi"] = 5;
		$bouchon["diam_comp"] = 95;
		
	$retour ["bouchon"][] = $bouchon;
		
	}

	pdf_gen(json_encode($retour));
}else{
	echo "Commande non contrôlée";
}
?>
