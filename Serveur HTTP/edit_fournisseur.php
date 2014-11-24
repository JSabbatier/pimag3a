<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objFournisseur = new DaoFournisseur();
$fournisseur = new Fournisseur();

$retour = Array();
$error = "no";
$retour_txt = "defaut";
$retour_code = "400 Bad Request";

if (isset($_POST["id_fournisseur"]))
{
	$id = $_POST["id_fournisseur"];
	if (is_numeric($id))
	{
		$id_fournisseur = intval($id);
		$fournisseur = $objFournisseur -> getFournisseurById($id_fournisseur);
	}
	else
	{
		$retour_txt = "ID is not numeric";
		$retour_code = "400 Bad Request";
		$error = "yes";
	}
}
else 
{
	$retour_txt = "No ID given";
	$error = "no";
}

if (isset($_POST["operation"]))
{
	$operation = $_POST["operation"];
}
else 
{
	$retour_txt = "No operation given";
	$retour_code = "400 Bad Request";
		$error = "yes";
}

if ($error == "no")
{
	if ($operation == "ajouter")
	{
		// Ajout fournisseur
		$fournisseur -> setNomFournisseur($_POST["nom"]);
		$fournisseur -> setRaisonFournisseur($_POST["raison"]);
		$fournisseur -> setTelephoneFournisseur($_POST["tel"]);
		$fournisseur -> setContacteFournisseur($_POST["contact"]);
		$fournisseur -> setEmailContactFournisseur($_POST["mail"]);
		$fournisseur -> setFaxFournisseur($_POST["fax"]);
		$fournisseur -> setEtatFournisseur("actif");
		$fournisseur -> setAdresseFournisseur($_POST["adresse"]);
		$id_fournisseur = $objFournisseur -> ajoutFournisseur($fournisseur);
		
		$retour_txt = "Fournisseur created";
		$retour_code = "201 Created";
	}
	else if ($operation == "modifier")
	{
		// Modification fournisseur
		if(isset($_POST["nom"]))
			$fournisseur -> setNomFournisseur($_POST["nom"]);
		if(isset($_POST["raison"]))
			$fournisseur -> setRaisonFournisseur($_POST["raison"]);
		if(isset($_POST["tel"]))
			$fournisseur -> setTelephoneFournisseur($_POST["tel"]);
		if(isset($_POST["fax"]))
			$fournisseur -> setFaxFournisseur($_POST["fax"]);
		if(isset($_POST["contact"]))
			$fournisseur -> setContacteFournisseur($_POST["contact"]);
		if(isset($_POST["mail"]))
			$fournisseur -> setEmailContactFournisseur($_POST["mail"]);
		if(isset($_POST["etat"]))
			$fournisseur -> setEtatFournisseur($_POST["etat"]);
		if(isset($_POST["adresse"]))		
			$fournisseur -> setAdresseFournisseur($_POST["adresse"]);
		$objFournisseur -> updateFournisseur($fournisseur);
		$retour_txt = "Fournisseur updated";
		$retour_code = "200 OK";
	}
	else if ($operation == "supprimer")
	{
		// Suppression fournisseur (état)
		$fournisseur -> setEtatFournisseur("supprime");
		$objFournisseur -> updateFournisseur($fournisseur);	
		$retour_txt = "User deleted";
		$retour_code = "200 OK";
		
	}
	else if ($operation == "masquer")
	{
		// masquage fournisseur (état)
		$fournisseur -> setEtatFournisseur("masque");
		$objFournisseur -> updateFournisseur($fournisseur);	
		$retour_txt = "User hidden";
		$retour_code = "200 OK";
	}
	else if ($operation == "activer")
	{
		// masquage fournisseur (état)
		$fournisseur -> setEtatFournisseur("actif");
		$objFournisseur -> updateFournisseur($fournisseur);	
		$retour_txt = "User activated";
		$retour_code = "200 OK";
	}
	else if ($operation == "help")
	{
		// masquage fournisseur (état)
		$fournisseur -> setEtatFournisseur("actif");
		$objFournisseur -> updateFournisseur($fournisseur);	
		$retour_txt = "User activated";
		$retour_code = "200 OK";
	}
}

header("HTTP/1.1 ".$retour_code);
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour_txt);
?>
