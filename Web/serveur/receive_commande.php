<?php
require_once("connect.php");

require_once("classes/commandeFournisseur.php");
require_once("classes/daoCommandeFournisseur.php");

require_once("classes/arrivage.php");
require_once("classes/daoArrivage.php");

require_once("classes/panier.php");
require_once("classes/daopanier.php");

$idCmdFournisseur= $_GET['id_commande'];

$cmdFournisseur= new CommandeFournisseur;
$objCmdFournisseur = new daoCommandeFournisseur;

$arrivage = new Arrivage;
$objArrivage = new DaoArrivage;

$panier= new Panier;
$objPanier= new DaoPanier;

$now=time();
$listePanierDeLaCommande= $objPanier->getListeOfPanierByCommandeFournisseur($idCmdFournisseur);
$cmdFournisseur = $objCmdFournisseur->getCommandeFournisseurByIdCmdFournisseur($idCmdFournisseur);

$listeIDArrivage = array();

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
return $listeIDArrivage;


?>