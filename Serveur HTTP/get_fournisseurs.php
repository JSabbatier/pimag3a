<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();
$liste_Fournisseur = Array();

$liste_fournisseur = $objFournisseur -> getListeFournisseurs();
$retour = Array();

foreach($liste_fournisseur as $tmp)
{
	$fournisseur = $tmp;
	$retour[$fournisseur -> getIdFournisseur()] = Array(	"nom" => $fournisseur -> getNomFournisseur(),
															"adresse" => $fournisseur -> getAdresseFournisseur(),
															"telephone" => $fournisseur -> getTelephoneFournisseur(),
															"fax" => $fournisseur -> getFaxFournisseur(),
															"contact" => $fournisseur -> getContactFournisseur(),
															"mail" => $fournisseur -> getEmailContactFournisseur(),
															"raison" => $fournisseur -> getRaisonFournisseur(),
															"etat" => $fournisseur -> getEtatFournisseur());
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>
