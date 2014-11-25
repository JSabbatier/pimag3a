<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoBouchonA.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

if(isset($_POST["id_arrivage"]))
	$id = $_POST["id_arrivage"];
else if(isset($_GET["id_arrivage"]))
	$id = $_GET["id_arrivage"];
else
	die("No id_arrivage");

// $detail_Arrivage = Array();

$arrivage = new Arrivage();
$objArrivage = new DaoArrivage();
$objFournisseur = new DaoFournisseur();
$objBouchonA = new DaoBouchonA();

$arrivage = $objArrivage-> getArrivageById($id);
// les controles :)
/*
$arrivage -> setControle("ok");
$objArrivage-> updateArrivage($Arrivage);
*/
require_once("pdf_gen_arr.php");
$controle = $arrivage -> getControle();

$etat = $_GET["etat"];

if ($controle == ""){

	$arrivage = Array();
	$seuil = Array();
	$bouchon = Array();

	$retour = Array();
	$fournisseur = $objFournisseur->getFournisseurById($arrivage -> getIdFournisseur());
	
	$arrivage["dateArr"] = $arrivage -> getDate();
	$arrivage["dateCont"] = date('Y/m/d h:i:s', time());//"2014-01-15 13:30";//$arrivage -> getNomArrivage();
	$arrivage["numArr"] = $arrivage -> getIdLot();//123456;//$arrivage -> getNomArrivage();
	$arrivage["nomFour"] = $fournisseur -> getNomFournisseur();//"Love Bouchon";//$arrivage -> getAdresseArrivage();
	$arrivage["qualite"] = $arrivage -> getQualite();//5;//$arrivage -> getNumeroTelArrivage();
	$arrivage["numTrac"] = $arrivage -> getDate() . $arrivage -> getIdLot();//456789;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["quantite"] = $arrivage -> getQuantite();//150000;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["longueur"] = $arrivage -> getTaille();//44;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["tcaf"] = 5;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["tcai"] = 1;//$arrivage -> getNumeroFaxArrivage();
	$arrivage["gout"] = "oui";//$arrivage -> getNumeroFaxArrivage();
	$arrivage["derog"] = "oui";//$arrivage -> getNumeroFaxArrivage();
	$arrivage["codebarre"] = "12345678904";//$arrivage -> getNumeroFaxArrivage();

	$seuil["long"]["min"] = $arrivage -> getTaille() - 0.5;
	$seuil["long"]["max"] = $arrivage -> getTaille() + 0.5;
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

	$liste_bouchon = $objBouchonA -> getListeBouchonByIdArrivage();
	foreach($liste_bouchon as $bouchon_cour)
	{
		$bouchon["id"] = $bouchon_cour->getId();
		$bouchon["long"] = $bouchon_cour->getLongueur();
		$bouchon["diam1"] = $bouchon_cour->getDiametre1();
		$bouchon["diam2"] = $bouchon_cour->getDiametre2();
		$bouchon["ovali"] = abs($bouchon["diam1"] - $bouchon["diam2"]);
		$bouchon["humi"] = $bouchon_cour->getHumidite();
		$bouchon["diam_comp"] = $bouchon_cour->getDiametreCompresse();
	}		
	$retour ["bouchon"][] = $bouchon;
		
	}
	//echo json_encode($retour);
	pdf_gen(json_encode($retour));
}else{
	echo "Commande non contrôlée";
}
?>
