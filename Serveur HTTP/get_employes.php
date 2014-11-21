<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoEmploye.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objEmploye = new DaoEmploye();
$employe = new Employe();
$liste_employe = Array();

$liste_employe = $objEmploye -> getListeEmploye();
$retour = Array();

foreach($liste_employe as $tmp)
{
	$employe = $tmp;
	$retour[$employe -> getIdEmploye()] = $employe -> getNomEmploye();
}

echo json_encode($retour);
?>
