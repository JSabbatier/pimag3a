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
	$retour[$fournisseur -> getIdFournisseur()] = Array(	Array("nom" => $fournisseur -> getNomFournisseur()),
															Array("adresse" => $fournisseur -> getAdresseFournisseur()),
															Array("telephone" => $fournisseur -> getTelephoneFournisseur()),
															Array("fax" => $fournisseur -> getFaxFournisseur()),
															// Array("contact" => $fournisseur -> getContactFournisseur()),
															Array("mail" => $fournisseur -> getEmailContactFournisseur()),
															Array("raison" => $fournisseur -> getRaisonFournisseur()),
															Array("etat" => $fournisseur -> getEtatFournisseur()));
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>
