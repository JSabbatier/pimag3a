<?php
require_once("classes/daoFournisseur.php");
require_once("connect.php");

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();
$liste_fournisseur = new Array();

$liste_fournisseur = $objFournisseur -> getListeFournisseur();
$retour = new Array();

foreach($liste_fournisseur as $tmp)
{
	$fournisseur = $tmp;
	$retour[$fournisseur -> getIdFournisseur()] = $fournisseur -> getNomFournisseur();
}

echo json_encode($retour);
?>
