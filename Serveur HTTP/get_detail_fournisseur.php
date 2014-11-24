<?php
require_once("../dao/classes/daoFournisseur.php");
require_once("../dao/connect.php");
$retour = Array();
if (isset($_POST["id_fournisseur"]))
{
	$id = $_POST["id_fournisseur"];
	if (is_numeric($id))
	{
		$id = intval($id);
	}

	$objFournisseur = new DaoFournisseur();
	$fournisseur = new Fournisseur();
	$detail_fournisseur = Array();

	$fournisseur = $objFournisseur -> getFournisseurById($id);
	if(!$fournisseur)
		$retour = "Wrong ID";
	else
	{
		$retour["nom_fournisseur"] = $fournisseur -> getNomFournisseur();
		$retour["adresse"] = $fournisseur -> getAdresseFournisseur();
		$retour["numero"] = $fournisseur -> getTelephoneFournisseur();
		$retour["fax"] = $fournisseur -> getFaxFournisseur();
		$retour["contact"] = $fournisseur -> getContacteFournisseur();
		$retour["mail"] = $fournisseur -> getEmailContactFournisseur();
		$retour["raison"] = $fournisseur -> getRaisonFournisseur();
	}

}
else
$retour = "No ID";

header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>
