<?php

require_once("connect.php");
require_once("classes/daoMesureA.php");
require_once("classes/mesureA.php");
require_once("classes/daoBouchonA.php");
require_once("classes/bouchonA.php");

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
	$jsonTest="{
	\"arrivage\": {
		\"idArrivage\": \"89\",
		\"tcaf\": \"98\",
		\"tcai\": \"498\",
		\"gout\": \"oui\"
	},
	\"bouchon\": [
		{
			\"long\": \"6816\",
			\"diam1\": \"1\",
			\"diam2\": \"61\",
			\"humi\": \"0\",
			\"diam_comp\": \"0\"
		},
		{
			\"long\": \"156\",
			\"diam1\": \"1\",
			\"diam2\": \"351\",
			\"humi\": \"0\",
			\"diam_comp\": \"0\"
		},
		{
			\"long\": \"351\",
			\"diam1\": \"351\",
			\"diam2\": \"35\",
			\"humi\": \"0\",
			\"diam_comp\": \"0\"
		},
		{
			\"long\": \"135\",
			\"diam1\": \"135\",
			\"diam2\": \"1\",
			\"humi\": \"0\",
			\"diam_comp\": \"0\"
		},
		{
			\"long\": \"351\",
			\"diam1\": \"351\",
			\"diam2\": \"35123\",
			\"humi\": \"0\",
			\"diam_comp\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\",
			\"humi\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\",
			\"humi\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\",
			\"humi\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\",
			\"humi\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\",
			\"humi\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		},
		{
			\"long\": \"0\",
			\"diam1\": \"0\",
			\"diam2\": \"0\"
		}
	]
}";
	
if((isset($headers['Content-Type']) && $headers['Content-Type']=="application/json") or $debug==true)
{
	

	$mesureA = new MesureA;
	$objMesureA = new DaoMesureA;
	$bouchon = new BouchonA;
	$objBouchonA = new DaoBouchonA;
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
		echo "la valeur de id".$req->arrivage->idArrivage."<br>";
		//print_r($req);
		echo "</pre>";
	}
	
	$mesureA->setIdArrivage($req->arrivage->idArrivage);
	$mesureA->setGout($req->arrivage->gout);
	$mesureA->setTCAFournisseur($req->arrivage->tcaf);
	$mesureA->setTCAInterne($req->arrivage->tcai);
	
	$idMesure= $objMesureA->ajoutmesureA($mesureA);
	echo "l'idMesure: $idMesure";
	$i=0;
	foreach($req->bouchon as $tmp)
	{
		
			$bouchon->setDiametre1BouchonA($tmp->diam1);
			$bouchon->setDiametre2BouchonA($tmp->diam2);
			
			isset($tmp->diam_comp)?$bouchon->setDiametreCompresseBouchonA($tmp->diam_comp) :$bouchon->setDiametreCompresseBouchonA(0) ;
			isset($tmp->humi)? $bouchon->setHumiditeBouchonA($tmp->humi):$bouchon->setHumiditeBouchonA(0);
			
			
			$bouchon->setLongueurBouchonA($tmp->long);
			$bouchon->setIdArrivageBouchonA($idMesure);
			
			if(isset($debug) && $debug==true)
			{
				echo"<br><pre><h1> bouchon numero $i</h1><br>";
				$i++;
				print_r($bouchon);
				echo "</pre><br>";
			}
			else
				$objBouchonA->ajoutBouchonA($bouchon);
				
				
	}
	 header("HTTP/1.1 200 OK");
	 
}
else
	header("HTTP/1.1 204 not a Json type");
?>