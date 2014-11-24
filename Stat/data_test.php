<?php
header('Content-Type: application/json');
$json = Array();



if (  (isset ($_POST["id_fournisseur"])) && (isset ($_POST["dateDebut"])) && (isset($_POST["dateFin"])) )
{
	$lots = Array();
	$json["nom_fournisseur"] = "Le bon bouchon";
	
	for ($i = 0; $i<100; $i++){
		$lots["id_lot"] = 79209;
		$lots["date"] 	= "21-03-14";
		$lots["validite"] = "true";
		$lots["prix_achat"] = 852778;
		$lots["taille"] = 44;
		$lots["qualite"] = 1 ;
		$json ["lots"][] = $lots;
	}
	for ($i = 0; $i<300; $i++){
		$lots["id_lot"] = 79209;
		$lots["date"] 	= "21-03-14";
		$lots["validite"] = "false";
		$lots["prix_achat"] = 852778;
		$lots["taille"] = 38;
		$lots["qualite"] = 2 ;
		$json ["lots"][] = $lots;
	}
		for ($i = 0; $i<27; $i++){
		$lots["id_lot"] = 79559;
		$lots["date"] 	= "21-04-14";
		$lots["validite"] = "false";
		$lots["prix_achat"] = 85254478;
		$lots["taille"] = 44;
		$lots["qualite"] = 3 ;
		$json ["lots"][] = $lots;
	}
		
		for ($i = 0; $i<17; $i++){
		$lots["id_lot"] = 79559;
		$lots["date"] 	= "21-04-14";
		$lots["validite"] = "false";
		$lots["prix_achat"] = 85254478;
		$lots["taille"] = 44;
		$lots["qualite"] = 4 ;
		$json ["lots"][] = $lots;
	}
}
else if  (isset ($_POST["id_fournisseur"]))
{

	$json["nom_fournisseur"] = "Le bon bouchon";
	$json["adresse"] = $_POST["id_fournisseur"]." - 12 boulevard de la belle olive";
	$json["numero_tel"] = "0892654578";
	$json["fax"] = "0892654521";
	$json["email"] = "Lebonbouchon@gmail.com";
}

else 
{
	$json["326"]="TesBouchon";
	$json["002"]="Bouchon Imerir";
	$json["003"]="AuBarjotBoucon";
	$json["004"]="VinoBouchon";
}




	echo json_encode($json);
  ?> 