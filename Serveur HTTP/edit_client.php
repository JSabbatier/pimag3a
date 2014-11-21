<?php
require_once("classes/daoClient.php");
require_once("classes/daoAdresse.php");
require_once("connect.php");

$retour_txt = "OK";
$retour_code = 200;
if (isset($_POST["id_client"])
{
	$id = $_POST["id_client"]
	if (is_numeric($id))
	{
		$id = intval($id)
	}
	else
	{
		$retour_txt = "ID is not numeric";
		$retour_code = 400;
	}
}
else 
{
	$retour_txt = "No ID given";
	$retour_code = 400;
}

if (isset($_POST["operation"])
{
	$operation = $_POST["operation"];
}
else 
{
	$retour_txt = "No operation given";
	$retour_code = 400;
}

$objClient = new DaoClient();
$client = new Client();
$detail_client = Array();
$objAdresse = new DaoAdresse();
$adresse = new Adresse();

$client = $objClient -> getClientById($id);
$retour = Array();

if ($operation == "ajouter")
{
	// Ajout client
	$client -> setNomClient($_POST["nom"]);
	$client -> setNumeroTel($_POST["tel"]);
	$client -> setNomContact($_POST["contact"]);
	$client -> setEmailContact($_POST["mail"]);
	$client -> setRaison($_POST["raison"]);
	$client -> setIdCommercial($_POST["raison"]);
	$client -> setEtat($_POST["etat"]);
	$id_client = $objClient -> ajoutClient($client);
	
	$adresse = new Adresse();
	$adresse -> setIdClient($id_client);
	$adresse -> setAdresse($_POST["adresse_f"]);
	$adresse -> setNom("facturation");
	$objAdresse -> ajoutAdresse($adresse);
	
	$adresse -> setIdClient($id_client);
	$adresse -> setAdresse($_POST["adresse_l"]);
	$adresse -> setNom("livraison1");
	$objAdresse -> ajoutAdresse($adresse);	
	$retour_txt = "User created";
	$retour_code = 201;
}
else if ($operation == "modifier")
{
	// Modification client
	$retour_txt = "User updated";
	$retour_code = 201;
}
else if ($operation == "supprimer")
{
	// Suppression client (état)
}
else if ($operation == "masquer")
{
	// masquage client (état)
}


$retour["nom_client"] = $client -> getNomClient();
$retour["numero_tel"] = $client -> getNumeroTel();
$retour["fax"] = $client -> getNumeroFaxClient();

echo json_encode($retour);
?>
