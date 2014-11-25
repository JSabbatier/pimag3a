<?php
require_once("connect.php");
require_once("classes/daoMesureD.php");
require_once("classes/mesureD.php");
require_once("classes/daoBouchonD.php");
require_once("classes/bouchonD.php");

$debug=true;



if(isset($dedug) && $debug==false)
{
	//obtain the request method
	$methodUsed=$_SERVER["REQUEST_METHOD"];
	//test if it isn't a POST method)
	if($methodUsed != "POST")
	{
		//send the header with the code 405 which is a bad method request
		header("HTTP/1.1 405 bad method");
		die("<h1>error 405 - bad method</h1><br><h2> please use a POST method not $methodUsed</h2>");
	}
	//check on the headers are if the client use use a json type
	$headers=apache_request_headers();
}
else
{
	$jsonTest="";
}
	
if((isset($headers['Content-Type']) && $headers['Content-Type']=="application/json") or $debug==true)
{
	

	$mesureD = new MesureD;
	$objMesureD = new DaoMesureD;
	$bouchon = new BouchonD;
	$objBouchonD = new DaoBouchonD;
	echo "apres declaration des objets<br>";
	
	if(isset($dedug) && $debug==false)
	{
		//get the stream on which the json is
		$serverRequest = file_get_contents("php://input");
		//convert the json got from the stream into an object
		$req=json_decode($serverRequest);
	}
	else
	{
		$req=json_decode($jsonTest);
		echo "json decode effectué<br><pre>";
		echo "la valeur de id du panier".$req->mesure->panier."<br>";
		//print_r($req);
		echo "</pre>";
	}
	
	$mesureD->setIdPanier($req->mesure->panier);
	$mesureD->setGout($req->mesure->gout);
	$mesureD->setTCAFournisseur($req->mesure->capi);
	$mesureD->setTCAInterne($req->mesure->tcai);
	
	$idMesure= $objMesureD->ajoutmesureA($mesureD);
	echo "l'idMesure: $idMesure";
	$i=0;
	foreach($req->bouchon as $tmp)
	{
		
			$bouchon->setDiametre1BouchonD($tmp->diam1);
			$bouchon->setDiametre2BouchonD($tmp->diam2);
			
			isset($tmp->diam_comp)?$bouchon->setDiametreCompresseBouchonD($tmp->diam_comp) :$bouchon->setDiametreCompresseBouchonD(0) ;
			isset($tmp->humi)? $bouchon->setHumiditeBouchonD($tmp->humi):$bouchon->setHumiditeBouchonD(0);
			
			
			$bouchon->setLongueurBouchonD($tmp->long);
			$bouchon->setIdArrivageBouchonD($idMesure);
			
			if(isset($debug) && $debug==true)
			{
				echo"<br><pre><h1> bouchon numero $i</h1><br>";
				$i++;
				print_r($bouchon);
				echo "</pre><br>";
			}
			else
				$objBouchonD->ajoutBouchonD($bouchon);
				
				
	}
	 header("HTTP/1.1 200 OK");
	 
}
else
	header("HTTP/1.1 204 not a Json type");


?>