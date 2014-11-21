<?php
require_once("classes/daoClient.php");
require_once("connect.php");

if (isset($_POST["id_client"])
{
	$id = $_POST["id_client"]
}
if (is_numeric($id))
{
	$id = intval($id)
}

$objClient = new DaoClient();
$client = new Client();
$detail_client = Array();

$client = $objClient -> getClientById($id);
$retour = Array();

$retour["nom_client"] = $client -> getNomClient();
$retour["numero_tel"] = $client -> getNumeroTelClient();
$retour["adresse"] = $client -> getAdresseClient();
$retour["fax"] = $client -> getNumeroFaxClient();

echo json_encode($retour);
?>
