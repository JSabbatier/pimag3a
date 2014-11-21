<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objClient = new DaoClient();
$client = new Client();
$liste_client = Array();

$liste_client = $objClient -> getListeClients();
$retour = Array();

foreach($liste_client as $tmp)
{
	$client = $tmp;
	$retour[$client -> getIdClient()] = Array(	Array("nom" => $client -> getNomClient()),
												Array("numero" => $client -> getNumeroTel()),
												Array("contact" => $client -> getNomContact()),
												Array("mail" => $client -> getEmailContact()),
												Array("raison" => $client -> getRaison()),
												Array("commercial" => $client -> getIdCommercial()),
												Array("etat" => $client -> getEtat()));
}
header("HTTP/1.1 200 OK");
echo json_encode($retour);
?>
