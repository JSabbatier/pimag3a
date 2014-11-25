<?php
require_once("../../../../mdacosta/www/pima3a/classes/daoClient.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoAdresse.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

if (isset($_POST["id_client"]))
{
	$id = $_POST["id_client"];
}
if (is_numeric($id))
{
	$id = intval($id);
}

$objClient = new DaoClient();
$client = new Client();
$detail_client = Array();

$objAdresse = new DaoAdresse();

$client = $objClient -> getClientById($id);

	$liste_adresse = $objAdresse -> getListeAdresseByIdClient($client -> getIdClient());
	$retour = Array(	"nom" => $client -> getNomClient(),
						"numero" => $client -> getNumeroTel(),
						"fax" => $client -> getFax(),
						"contact" => $client -> getNomContact(),
						"mail" => $client -> getEmailContact(),
						"raison" => $client -> getRaison(),
						"commercial" => $client -> getIdCommercial(),
						"etat" => $client -> getEtat(),
						"adresse_f" => "adresse facturation",
						"adresse_l" => Array()
					);	
					
	foreach($liste_adresse as $adresse)
	{
		if ($adresse->getNom() == "facturation")
		{
			$retour[$client -> getIdClient()]["adresse_f"] = $adresse->getAdresse();
		}
		else //if (strstr($adresse->getNom(), "livraison"))
		{
			//echo $adresse->getNom();
			$retour[$client -> getIdClient()]["adresse_l"][] = Array("id" => $adresse->getIdAdresse(),
																	"nom" => $adresse->getNom(),
																	"adresse" => $adresse->getAdresse()
																	);
		}
	}

echo json_encode($retour);
?>
