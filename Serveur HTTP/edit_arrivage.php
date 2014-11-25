<?php
date_default_timezone_set('Europe/Berlin');
require_once("../../../../mdacosta/www/pima3a/classes/daoArrivage.php");
require_once("../../../../mdacosta/www/pima3a/connect.php");

$objArrivage = new DaoArrivage();
$arrivage = new Arrivage();

$retour = Array();
$error = "no";
$retour_txt = "defaut";
$retour_code = "400 Bad Request";


if(isset($_POST["date"]))
{
	list($day,$mon,$year) = explode('/', $_POST["date"]);
	$_POST["date"] = "$year-$mon-$day 00:00:00";
	//echo "Date : ".$_POST["date"];
}

function ean13_put_digit($digits)
{
	$out = $digits;
   $digits=preg_split("//",$digits,-1,PREG_SPLIT_NO_EMPTY);
   $a=$b=0;
   for($i=0;$i<5;$i++)
   {
	  $a+=(int)array_shift($digits);
	  $b+=(int)array_shift($digits);
   }
   $total=($a*1)+($b*3);
   $nextten=ceil($total/10)*10;
   return $out.$nextten-$total;
}

if (isset($_POST["id_arrivage"]))
{
	$id = $_POST["id_arrivage"];
	if (is_numeric($id))
	{
		$id_arrivage = intval($id);
		$arrivage = $objArrivage -> getArrivageById($id_arrivage);
	}
	else
	{
		$retour_txt = "ID is not numeric";
		$retour_code = "400 Bad Request";
		$error = "yes";
	}
}
else 
{
	$retour_txt = "No ID given";
	$error = "no";
}

if (isset($_POST["operation"]))
{
	$operation = $_POST["operation"];
}
else 
{
	$retour_txt = "No operation given";
	$retour_code = "400 Bad Request";
		$error = "yes";
}

if ($error == "no")	
{
	if ($operation == "ajouter")
	{
		// Ajout arrivage
		$arrivage -> setDate(date('Y/m/d h:i:s', time()));
		$arrivage -> setIdFournisseur($_POST["id_fournisseur"]);
		$arrivage -> setTaille($_POST["taille"]);
		$arrivage -> setQualite($_POST["qualite"]);
		$arrivage -> setQuantite($_POST["quantite"]);
		$arrivage -> setPrixAchat($_POST["prix"]);
		$arrivage -> setDevise($_POST["devise"]);
		$arrivage -> setControle("");
		$arrivage -> setValidite($_POST["validite"]);
		$arrivage -> setEtat("actif");
		$id_arrivage = $objArrivage -> ajoutArrivage($arrivage);
		$arrivage ->  $objArrivage->getArrivageById($id_arrivage);
		
		$codebarre =  str_pad($_POST["id_fournisseur"], 4, "0", STR_PAD_LEFT);
		$codebarre .=  str_pad($id_arrivage, 6, "0", STR_PAD_LEFT);
		$codebarre = ean13_put_digit($codebarre."0");
		$arrivage -> setCodeBarre($codebarre);
		$objArrivage -> updateArrivage($arrivage);
			
		$retour_txt = "Arrivage created";
		$retour_code = "201 Created";
	}
	else if ($operation == "modifier")
	{
		// Modification arrivage
		if(isset($_POST["date"]))
			$arrivage -> setDate($_POST["date"]);
		if(isset($_POST["id_fournisseur"]))
			$arrivage -> setIdFournisseur($_POST["id_fournisseur"]);
		if(isset($_POST["taille"]))
			$arrivage -> setTaille($_POST["taille"]);
		if(isset($_POST["qualite"]))
			$arrivage -> setQualite($_POST["qualite"]);
		if(isset($_POST["quantite"]))
			$arrivage -> setQuantite($_POST["quantite"]);
		if(isset($_POST["prix"]))
			$arrivage -> setPrixAchat($_POST["prix"]);
		if(isset($_POST["devise"]))
			$arrivage -> setDevise($_POST["devise"]);
		if(isset($_POST["controle"]))
			$arrivage -> setControle($_POST["controle"]);			
		if(isset($_POST["validite"]))
			$arrivage -> setValidite($_POST["validite"]);
		
		
		$codebarre =  str_pad($arrivage->getIdFournisseur(), 4, "0", STR_PAD_LEFT);
		$codebarre .=  str_pad($arrivage->getIdLot(), 6, "0", STR_PAD_LEFT);
		$codebarre = ean13_put_digit($codebarre."0");
		$arrivage -> setCodeBarre($codebarre);
		$objArrivage -> updateArrivage($arrivage);
		$retour_txt = "Arrivage updated";
		$retour_code = "200 OK";
	}
	else if ($operation == "supprimer")
	{
		$retour_txt = "Can't delete this";
		$retour_code = "400 Bad Request";
		
	}
	else if ($operation == "masquer")
	{
		// masquage arrivage (état)
		$arrivage -> setEtat("masque");
		$objArrivage -> updateArrivage($arrivage);	
		$retour_txt = "Arrivage hidden";
		$retour_code = "200 OK";
	}
	else if ($operation == "activer")
	{
		// masquage arrivage (état)
		$arrivage -> setEtat("actif");
		$objArrivage -> updateArrivage($arrivage);	
		$retour_txt = "Arrivage activated";
		$retour_code = "200 OK";
	}
}

header("HTTP/1.1 ".$retour_code);
echo json_encode($retour_txt);
?>
