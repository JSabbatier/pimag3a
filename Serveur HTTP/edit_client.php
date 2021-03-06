<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoAdresse.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objClient = new DaoClient();
$client = new Client();

$objAdresse = new DaoAdresse();
$adresse = new Adresse();
$listeAdresse = Array();

$retour = Array();
$error = "no";
$retour_txt = "defaut";
$retour_code = "400 Bad Request";

if (isset($_POST["id_client"]))
{
	$id = $_POST["id_client"];
	if (is_numeric($id))
	{
		$id_client = intval($id);
		$client = $objClient -> getClientById($id_client);
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
		// Ajout client
		$client -> setNomClient($_POST["nom"]);
		$client -> setNumeroTel($_POST["tel"]);
		$client -> setNomContact($_POST["contact"]);
		$client -> setEmailContact($_POST["mail"]);
		$client -> setRaison($_POST["raison"]);
		$client -> setIdCommercial($_POST["commercial"]);
		$client -> setFax($_POST["fax"]);
		$client -> setEtat("actif");
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
		$retour_code = "201 Created";
	}
	else if ($operation == "modifier")
	{
		// Modification client
		if(isset($_POST["nom"]))
			$client -> setNomClient($_POST["nom"]);
		if(isset($_POST["tel"]))
			$client -> setNumeroTel($_POST["tel"]);
		if(isset($_POST["fax"]))
			$client -> setFax($_POST["fax"]);
		if(isset($_POST["contact"]))
			$client -> setNomContact($_POST["contact"]);
		if(isset($_POST["mail"]))
			$client -> setEmailContact($_POST["mail"]);
		if(isset($_POST["raison"]))
			$client -> setRaison($_POST["raison"]);
		if(isset($_POST["commercial"]) && is_numeric($_POST["commercial"]))
			$client -> setIdCommercial($_POST["commercial"]);
		if(isset($_POST["etat"]))
			$client -> setEtat($_POST["etat"]);
		if(isset($_POST["adresse_f"]))
		{
			$adresse = new Adresse();		
			$listeAdresse = $objAdresse -> getListeAdresseByIdClient($id_client);
			foreach($listeAdresse as $adresse)
			{
				if ($adresse->getNom() == "facturation")
				{
					$adresse -> setAdresse($_POST["adresse_f"]);
					$objAdresse -> updateAdresse($adresse);
				}
			}
		}
		if(isset($_POST["adresse_l"]))
		{
			$adresse = new Adresse();		
			$listeAdresse = $objAdresse -> getListeAdresseByIdClient($id_client);
			foreach($listeAdresse as $adresse)
			{
				if ($adresse->getNom() != "facturation")
				{
					$adresse -> setAdresse($_POST["adresse_l"]);
					$objAdresse -> updateAdresse($adresse);
				}
			}
		}
		$objClient -> updateClient($client);
		$retour_txt = "User updated";
		$retour_code = "200 OK";
	}
	else if ($operation == "supprimer")
	{
		// Suppression client (état)
		$client -> setEtat("supprime");
		$objClient -> updateClient($client);	
		$retour_txt = "User deleted";
		$retour_code = "200 OK";
		
	}
	else if ($operation == "masquer")
	{
		// masquage client (état)
		$client -> setEtat("masque");
		$objClient -> updateClient($client);	
		$retour_txt = "User hidden";
		$retour_code = "200 OK";
	}
	else if ($operation == "activer")
	{
		// masquage client (état)
		$client -> setEtat("actif");
		$objClient -> updateClient($client);	
		$retour_txt = "User activated";
		$retour_code = "200 OK";
	}
}

header("HTTP/1.1 ".$retour_code);
echo json_encode($retour_txt);
?>
