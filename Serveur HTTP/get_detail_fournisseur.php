<?php
require_once("../dao/classes/daoFournisseur.php");
require_once("../dao/connect.php");

if (isset($_POST["id_fournisseur"])
{
	$id = $_POST["id_fournisseur"]
}
if (is_numeric($id))
{
	$id = intval($id)
}

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();
$detail_fournisseur = Array();

$fournisseur = $objFournisseur -> getFournisseurById($id);
$retour = Array();

$retour["nom_fournisseur"] = $fournisseur -> getNomFournisseur();
$retour["adresse"] = $fournisseur -> getAdresseFournisseur();
$retour["numero_tel"] = $fournisseur -> getNumeroTelFournisseur();
$retour["fax"] = $fournisseur -> getNumeroFaxFournisseur();

echo json_encode($retour);
?>
