<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoAdresse.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objClient = new DaoClient();
//$client = new Client();
$liste_client = Array();

$objAdresse = new DaoAdresse();
//$adresse = new Adresse();
//$liste_adresse = Array();

$liste_client = $objClient -> getListeClients();
$retour = Array();

foreach($liste_client as $client)
{
	$retour[$client -> getIdClient()] = $client -> getNomClient();
}
header("HTTP/1.1 200 OK");
header('Content-type: application/json');
echo json_encode($retour);
?>
