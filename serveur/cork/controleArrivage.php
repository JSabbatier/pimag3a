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
	//test if it isn't a POST method
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
	$jsonTest="{\"arrivage\":{\"id\":4,\"tcaf\":83,\"tcai\":11,\"gout\":\"oui\"},\"bouchon\":[{\"id\":1,\"long\":59.71,\"diam1\":23.85,\"diam2\":24.6,\"humi\":4.76,\"diam_comp\":91.15},{\"id\":2,\"long\":55.63,\"diam1\":23.5,\"diam2\":24.54,\"humi\":5.03,\"diam_comp\":95.83},{\"id\":3,\"long\":56.33,\"diam1\":23.48,\"diam2\":24.4,\"humi\":5.22,\"diam_comp\":97.32},{\"id\":4,\"long\":28.89,\"diam1\":23.76,\"diam2\":23.84,\"humi\":5.14,\"diam_comp\":89.74},{\"id\":5,\"long\":13.93,\"diam1\":24.45,\"diam2\":23.53,\"humi\":5.79,\"diam_comp\":92.91},{\"id\":6,\"long\":93.8,\"diam1\":24.6,\"diam2\":24.46,\"humi\":5.6,\"diam_comp\":99.55},{\"id\":7,\"long\":0.1,\"diam1\":23.62,\"diam2\":24.54,\"humi\":6,\"diam_comp\":92.08},{\"id\":8,\"long\":37.16,\"diam1\":23.94,\"diam2\":23.86,\"humi\":4.6,\"diam_comp\":90.89},{\"id\":9,\"long\":18.2,\"diam1\":24.4,\"diam2\":24.32,\"humi\":4.59,\"diam_comp\":89.89},{\"id\":10,\"long\":63.6,\"diam1\":24.58,\"diam2\":24.56,\"humi\":5.78,\"diam_comp\":88.33},{\"id\":11,\"long\":57.98,\"diam1\":24.54,\"diam2\":23.79,\"humi\":4.64,\"diam_comp\":97.46},{\"id\":12,\"long\":96.89,\"diam1\":23.58,\"diam2\":24.34,\"humi\":4.2,\"diam_comp\":91.02},{\"id\":13,\"long\":18.52,\"diam1\":23.56,\"diam2\":24.54,\"humi\":4.19,\"diam_comp\":93.41},{\"id\":14,\"long\":67.39,\"diam1\":24.16,\"diam2\":23.42,\"humi\":4.52,\"diam_comp\":90.51},{\"id\":15,\"long\":23.72,\"diam1\":24.13,\"diam2\":23.86,\"humi\":4.24,\"diam_comp\":89.74},{\"id\":16,\"long\":2,\"diam1\":23.58,\"diam2\":24.32,\"humi\":4,\"diam_comp\":97.47}]}";
	
if((isset($headers['Content-Type']) && $headers['Content-Type']=="application/json") or $debug==true)
{
	

	$mesureA = new MesureA;
	$objMesureA = new DaoMesureA;
	$bouchon = new BouchonA;
	$objBouchonA = new DaoBouchonA;
	
	if(isset($dedug) && $debug==false)
	{
		//get the stream on which the json is
		$serverRequest = file_get_contents("php://input");
		//convert the json got from the stream into an object
		$req=json_decode($serverRequest);
	}
	else
		$req=json_decode($jsonTest);
	
	//print_r($req);
	$mesureA->setIdArrivage($req->arrivage->id);
	$mesureA->setGout($req->arrivage->gout);
	$mesureA->setTCAFournisseur($req->arrivage->tcaf);
	$mesureA->setTCAInterne($req->arrivage->tcai);
	if(isset($debug) && $debug!=true)
	{
		$i=0;
		echo"<pre>";
		print_r($mesureA);
		$idMesure=0;
		echo "</pre>";
	}
	else
	 $idMesure= $objMesureA->ajoutmesureA($mesureA);
	foreach($req->bouchon as $tmp)
	{
		
			$bouchon->setDiametre1BouchonA($tmp->diam1);
			$bouchon->setDiametre2BouchonA($tmp->diam2);
			$bouchon->setDiametreCompresseBouchonA($tmp->diam_comp);
			$bouchon->setHumiditeBouchonA($tmp->humi);
			$bouchon->setLongueurBouchonA($tmp->long);
			$bouchon->setIdArrivageBouchonA($mesureA);
			
			if(isset($debug) && $debug!=true)
			{
				echo"<pre><h1> bouchon numero $i";
				$i++;
				print_r($bouchon);
				echo "</pre>";
			}
			else
				$objBouchonA->ajoutBouchonA($bouchon);
	}
	 header("HTTP/1.1 200 OK");
}
else
	header("HTTP/1.1 204 not a Json type");
?>