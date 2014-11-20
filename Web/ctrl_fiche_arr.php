<?php
	require_once("classes/daoArrivage.php");
	require_once("connect.php");

	$objArrivage = new DaoArrivage();
	$arrivage = new Arrivage();
	$detail_Arrivage = new Array();

	$arrivage = $objArrivage -> getArrivageById($id);
	$retour = new Array();

	$retour["nom_Arrivage"] = $arrivage -> getNomArrivage();
	$retour["adresse"] = $arrivage -> getAdresseArrivage();
	$retour["numero_tel"] = $arrivage -> getNumeroTelArrivage();
	$retour["fax"] = $arrivage -> getNumeroFaxArrivage();

	echo json_encode($retour);
?>
