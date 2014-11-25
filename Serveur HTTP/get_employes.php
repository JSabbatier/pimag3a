<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoEmploye.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objEmploye = new DaoEmploye();
//$employe = new Employe();
$liste_employe = Array();

$liste_employe = $objEmploye -> getListeEmployes();
$retour = Array();

foreach($liste_employe as $employe)
{
	$retour[$employe -> getIdEmploye()] = Array("nom" => $employe -> getNom(),
												"prenom" => $employe -> getPrenom(),
												"numero" => $employe -> getTel(),
												"fax" => $employe -> getFax(),
												"role" => $employe -> getRole(),
												"mail" => $employe -> getEmail(),
												"etat" => $employe -> getEtat(),
												"adresse" => $employe -> getAdresse()
												);	
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($retour);
?>
