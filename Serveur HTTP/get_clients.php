<?php
require_once("classes/daoClient.php");
require_once("connect.php");

$objClient = new DaoClient();
$client = new Client();
$liste_client = Array();

$liste_client = $objClient -> getListeClient();
$retour = Array();

foreach($liste_client as $tmp)
{
	$client = $tmp;
	$retour[$client -> getIdClient()] = $client -> getNomClient();
}
header("HTTP/1.1 200 OK");
echo json_encode($retour);
?>
