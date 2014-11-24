<?php
/*	require_once("classes/daodepart.php");
	require_once("connect.php");

	$objdepart = new Daodepart();
	$depart = new depart();
	$detail_depart = new Array();
*/

require_once("pdf_gen_dep.php");
$etat = $_GET["etat"];

if ($etat == "checked"){

	$depart = Array();
	$seuil = Array();
	$panier = Array();
	$bouchon = Array();

	$retour = Array();

	$depart["dateDep"] = "2014-01-15 15:10";//$depart -> getNomdepart();
	$depart["dateCont"] = "2014-01-15 13:30";//$depart -> getNomdepart();
	$depart["dateLiv"] = "2014-01-15 13:30";//$depart -> getNomdepart();
	$depart["numDep"] = 123456;//$depart -> getNomdepart();
	$depart["numCli"] = 654321;//$depart -> getNomdepart();
	$depart["nomCli"] = "love client";//$depart -> getAdressedepart();
	$depart["nomCom"] = "love commercial";//$depart -> getAdressedepart();
	$depart["nomContact"] = "love contact";//$depart -> getAdressedepart();
	$depart["codebarre"] = "12345678904";//$depart -> getNumeroFaxdepart();

	$seuil["long"]["min"] = 0.5;
	$seuil["long"]["max"] = 0.5;
	$seuil["diam1"]["min"] = 23.5;
	$seuil["diam1"]["max"] = 24.5;
	$seuil["diam2"]["min"] = 23.5;
	$seuil["diam2"]["max"] = 24.5;
	$seuil["ovali"] = 0.7;
	$seuil["humi"]["min"] = 4;
	$seuil["humi"]["max"] = 6;
	$seuil["diam_comp"] = 90;
	$seuil["capil"] = 1;
	$seuil["tcai"] = 2;

	$retour ["depart"] = $depart;
	$retour ["seuil"] = $seuil;
//---------------------------------------------------------------------------------------------------------

		$panier["numPan"] = 456;//$depart -> getNumeroTeldepart();
		$panier["qualite"] = 5;//$depart -> getNumeroTeldepart();
		$panier["quantite"] = 150000;//$depart -> getNumeroFaxdepart();
		$panier["longueur"] = 39;//$depart -> getNumeroFaxdepart();
		$panier["origine"] = 1234;//$depart -> getNumeroFaxdepart();
		$panier["tcai"] = 1;//$depart -> getNumeroFaxdepart();
		$panier["gout"] = "oui";//$depart -> getNumeroFaxdepart();
		$panier["capil"] = 0.7;//$depart -> getNumeroFaxdepart();
		$panier["derog"] = "non";//$depart -> getNumeroFaxdepart();
		$panier["bouchon"]= Array();

		for ($j = 1; $j<9; $j++){
			$bouchon["id"] = $j;
			$bouchon["long"] = 39;
			$bouchon["diam1"] = 24;
			$bouchon["diam2"] = 24;
			$bouchon["ovali"] = 0.5;
			$bouchon["humi"] = 5;
			$bouchon["diam_comp"] = 95;
			
			$panier["bouchon"][] = $bouchon;
		}
		

		$retour["panier"][] = $panier;



		$panier["numPan"] = 123;//$depart -> getNumeroTeldepart();
		$panier["qualite"] = 5;//$depart -> getNumeroTeldepart();
		$panier["quantite"] = 150000;//$depart -> getNumeroFaxdepart();
		$panier["longueur"] = 44;//$depart -> getNumeroFaxdepart();
		$panier["origine"] = 5678;//$depart -> getNumeroFaxdepart();
		$panier["tcai"] = 1;//$depart -> getNumeroFaxdepart();
		$panier["gout"] = "non";//$depart -> getNumeroFaxdepart();
		$panier["capil"] = 0.7;//$depart -> getNumeroFaxdepart();
		$panier["derog"] = "non";//$depart -> getNumeroFaxdepart();
		$panier["bouchon"]= Array();

		for ($j = 1; $j<9; $j++){
			$bouchon["id"] = $j;
			$bouchon["long"] = 45;
			$bouchon["diam1"] = 24;
			$bouchon["diam2"] = 24;
			$bouchon["ovali"] = 0.5;
			$bouchon["humi"] = 5;
			$bouchon["diam_comp"] = 95;
			
			$panier["bouchon"][] = $bouchon;
		}
		

		$retour["panier"][] = $panier;
	
//-----------------------------------------------------------------------------------------------------------------
	for ($i = 1; $i<2; $i++){
		$panier["numPan"] = $i;//$depart -> getNumeroTeldepart();
		$panier["qualite"] = 5;//$depart -> getNumeroTeldepart();
		$panier["quantite"] = 150000;//$depart -> getNumeroFaxdepart();
		$panier["longueur"] = 44;//$depart -> getNumeroFaxdepart();
		$panier["origine"] = 44;//$depart -> getNumeroFaxdepart();
		$panier["tcai"] = 1;//$depart -> getNumeroFaxdepart();
		$panier["gout"] = "non";//$depart -> getNumeroFaxdepart();
		$panier["capil"] = 0.7;//$depart -> getNumeroFaxdepart();
		$panier["derog"] = "oui";//$depart -> getNumeroFaxdepart();
		$panier["bouchon"]= Array();

		for ($j = 1; $j<9; $j++){
			$bouchon["id"] = $i.$j;
			$bouchon["long"] = 44;
			$bouchon["diam1"] = 23.95;
			$bouchon["diam2"] = 24.05;
			$bouchon["ovali"] = abs($bouchon["diam1"]-$bouchon["diam2"]);
			$bouchon["humi"] = 5;
			$bouchon["diam_comp"] = 95;
			
			$panier["bouchon"][] = $bouchon;
		}


		$retour["panier"][] = $panier;
	}

	pdf_gen(json_encode($retour));
}else{
	echo "Commande non contrôlée";
}
?>
