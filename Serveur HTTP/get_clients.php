<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objClient = new DaoClient();
$client = new Client();
$liste_client = Array();

$liste_client = $objClient -> getListeClient();
$retour = Array();

foreach($liste_client as $tmp)
{
	$client = $tmp;
	$retour[$client -> getIdClient()] = Array(	Array("nom" => $client -> getNomClient()),
												Array("numero"=> $client -> getNumeroClient()),
												Array("contact"=> $client -> getContactClient()),
												;
}
header("HTTP/1.1 200 OK");
echo json_encode($retour);
?>
