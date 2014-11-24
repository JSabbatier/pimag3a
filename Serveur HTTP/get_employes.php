<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoEmploye.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objEmploye = new DaoEmployes();
$employe = new Employe();
$liste_employe = Array();

$liste_employe = $objEmploye -> getListeEmploye();
$retour = Array();

foreach($liste_employe as $tmp)
{
	$employe = $tmp;
	$retour[$employe -> getIdEmploye()] = $employe -> getNomEmploye();
}

header("HTTP/1.1 200 OK");
header('Content-type: application/json');
echo json_encode($retour);
?>
