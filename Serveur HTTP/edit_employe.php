<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoEmploye.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objEmploye = new DaoEmploye();
$employe = new Employe();

$retour = Array();
$error = "no";
$retour_txt = "defaut";
$retour_code = "400 Bad Request";

if (isset($_POST["id_employe"]))
{
	$id = $_POST["id_employe"];
	if (is_numeric($id))
	{
		$id_employe = intval($id);
		$employe = $objEmploye -> getEmployeById($id_employe);
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
		// Ajout employe
		$employe -> setNom($_POST["nom"]);
		$employe -> setPrenom($_POST["prenom"]);
		$employe -> setTel($_POST["tel"]);
		$employe -> setEmail($_POST["mail"]);
		$employe -> setFax($_POST["fax"]);
		$employe -> setRole($_POST["role"]);
		$employe -> setEtat("actif");
		$employe -> setAdresse($_POST["adresse"]);
		$id_employe = $objEmploye -> ajoutEmploye($employe);
		
		$retour_txt = "Employe created";
		$retour_code = "201 Created";
	}
	else if ($operation == "modifier")
	{
		// Modification employe
		if(isset($_POST["nom"]))
			$employe -> setNom($_POST["nom"]);
		if(isset($_POST["prenom"]))
			$employe -> setPrenom($_POST["prenom"]);
		if(isset($_POST["tel"]))
			$employe -> setTel($_POST["tel"]);
		if(isset($_POST["fax"]))
			$employe -> setFax($_POST["fax"]);
		if(isset($_POST["role"]))
			$employe -> setRole($_POST["role"]);
		if(isset($_POST["mail"]))
			$employe -> setEmail($_POST["mail"]);
		if(isset($_POST["etat"]))
			$employe -> setEtat($_POST["etat"]);
		if(isset($_POST["adresse"]))		
			$employe -> setAdresse($_POST["adresse"]);
		$objEmploye -> updateEmploye($employe);
		$retour_txt = "Employe updated";
		$retour_code = "200 OK";
	}
	else if ($operation == "supprimer")
	{
		// Suppression employe (état)
		$employe -> setEtat("supprime");
		$objEmploye -> updateEmploye($employe);	
		$retour_txt = "User deleted";
		$retour_code = "200 OK";
		
	}
	else if ($operation == "masquer")
	{
		// masquage employe (état)
		$employe -> setEtat("masque");
		$objEmploye -> updateEmploye($employe);	
		$retour_txt = "User hidden";
		$retour_code = "200 OK";
	}
	else if ($operation == "activer")
	{
		// masquage employe (état)
		$employe -> setEtat("actif");
		$objEmploye -> updateEmploye($employe);	
		$retour_txt = "User activated";
		$retour_code = "200 OK";
	}
}

header("HTTP/1.1 ".$retour_code);
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour_txt);
?>
