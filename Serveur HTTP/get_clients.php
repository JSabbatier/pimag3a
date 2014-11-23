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
	$liste_adresse = $objAdresse -> getListeAdresseByIdClient($client -> getIdClient());
	$retour[$client -> getIdClient()] = Array(	"nom" => $client -> getNomClient(),
												"numero" => $client -> getNumeroTel(),
												"fax" => $client -> getFax(),
												"contact" => $client -> getNomContact(),
												"mail" => $client -> getEmailContact(),
												"raison" => $client -> getRaison(),
												"commercial" => $client -> getIdCommercial(),
												"adresse_f" => "adresse facturation",
												"adresse_l" => Array()
												);	

	foreach($liste_adresse as $adresse)
	{
		($adresse);
		if ($adresse->getNom() == "facturation")
		{
			$retour[$client -> getIdClient()]["adresse_f"] = $adresse->getAdresse();
		}
		else //if (strstr($adresse->getNom(), "livraison"))
		{
			//echo $adresse->getNom();
			$retour[$client -> getIdClient()]["adresse_l"][$adresse->getNom()] = $adresse->getAdresse();
		}
	}
}
header("HTTP/1.1 200 OK")
echo json_encode($retour);
?>
