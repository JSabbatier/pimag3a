<?php
require_once("../dao/classes/daoFournisseur.php");
require_once("../dao/connect.php");

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();
$liste_fournisseur = Array();

$liste_fournisseur = $objFournisseur -> getListeFournisseur();
$retour = Array();

foreach($liste_fournisseur as $tmp)
{
	$fournisseur = $tmp;
	$retour[$fournisseur -> getIdFournisseur()] = $fournisseur -> getNomFournisseur();
}

echo json_encode($retour);
?>
