<?php
require_once("classes/daoFournisseur.php");
require_once("connect.php");

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();
$detail_fournisseur = new Array();

$fournisseur = $objFournisseur -> getFournisseurById($id);
$retour = new Array();

$retour["nom_fournisseur"] = $fournisseur -> getNomFournisseur();
$retour["adresse"] = $fournisseur -> getAdresseFournisseur();
$retour["numero_tel"] = $fournisseur -> getNumeroTelFournisseur();
$retour["fax"] = $fournisseur -> getNumeroFaxFournisseur();

echo json_encode($retour);
?>
