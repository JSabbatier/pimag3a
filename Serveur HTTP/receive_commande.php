<?php
date_default_timezone_set('Europe/Berlin');
require_once("../../../../mdacosta/www/pima3a/connect.php");

require_once("../../../../mdacosta/www/pima3a/classes/commandeFournisseur.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoCommandeFournisseur.php");

require_once("../../../../mdacosta/www/pima3a/classes/arrivage.php");
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");

require_once("../../../../mdacosta/www/pima3a/classes/panier.php");
require_once("../../../../mdacosta/www/pima3a/classes/daopanier.php");

if (isset($_POST['id_commande']))
	$idCmdFournisseur = $_POST['id_commande'];
else
	$idCmdFournisseur = $_GET['id_commande'];

$cmdFournisseur= new CommandeFournisseur;
$objCmdFournisseur = new daoCommandeFournisseur;

$arrivage = new Arrivage;
$objArrivage = new DaoArrivage;

$panier= new Panier;
$objPanier= new DaoPanier;

$listeIDArrivage = array();
$now=time();
$listePanierDeLaCommande= $objPanier->getListeOfPanierByCommandeFournisseur($idCmdFournisseur);
$cmdFournisseur = $objCmdFournisseur->getCommandeFournisseurByIdCmdFournisseur($idCmdFournisseur);
if ($cmdFournisseur -> getEtat() != "recu")
{

	foreach($listePanierDeLaCommande as $tmpPanier)
	{
		$panier=$tmpPanier;
		
		$arrivage->setCodeBarre("");
		$arrivage->setControle("");
		$arrivage->setDate(date("Y-m-d G:i:s",$now));
		$arrivage->setDevise($panier->getDevise());
		$arrivage->setEtat("");
		$arrivage->setIdFournisseur($cmdFournisseur->getIdFournisseur());
		$arrivage->setNumeroTracabilite("");
		$arrivage->setPrixAchat($panier->getPrixNegocie());
		$arrivage->setQualite($panier->getQualite());
		$arrivage->setQuantite($panier->getQuantite());
		$arrivage->setTaille($panier->getLongueur());
		$arrivage->setValidite("");
		
		$listeIDArrivage[] = $objArrivage->ajoutArrivage($arrivage);
	}
	$cmdFournisseur->setEtat("recu");
	$objCmdFournisseur->updateCmdFournisseur($cmdFournisseur);
}
echo json_encode ($listeIDArrivage);


?>