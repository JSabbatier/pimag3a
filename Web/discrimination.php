<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<script src="jquery-2.1.1.min.js"></script>  
    <script type="text/javascript" src="jquery_barcode/jquery-barcode.js"></script>  

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body onload="document.getElementById('Text0').focus();">

<form action="mail.php" method="POST">


	<table>
		<tr>
			<td>
				Hauteur: 
			</td>
			<td>
				<input id="Text0" type="text" />
			</td>
		</tr>
		<tr>
			<td>
				largeur 1 : 
			</td>
			<td>
				<input id="Text1" type="text" />
			</td>
		</tr>
		<tr>
			<td>
				largeur 2 : 
			</td>
			<td>
				<input id="Text2" type="text" />
			</td>
		</tr>
		<tr>
			<td>
				BarCode : 
			</td>
			<td>
				<input id="Text3" type="text" name="Text3" />
			</td>
		</tr>
	</table>
	<input type="submit">
</form>

    <div id="bcTarget"></div>   
</body>
<script type='text/javascript'>

    $("#bcTarget").barcode("51230967892", "code39",{barWidth:1, barHeight:100}); 

var inputs = $(':input').keypress(function(e){ 
    if (e.which == 13) {
       e.preventDefault();
       var nextInput = inputs.get(inputs.index(this) + 1);
       if (nextInput) {
          nextInput.focus();
       }
    	if(e.target.value.length > 6 ){
    		console.log("Douchette");


			var code = document.getElementById("Text3").value;
			var sum1 = 0; var sum2 = 0;
			for (var i = 1; i < e.target.value.length; i = i + 2){
				sum1 += parseInt(code[i]);
				console.log("impair: " + i + "valeur: " + parseInt(code[i]) + "somme: " + sum1 );
			}

			for (var i = 0; i < e.target.value.length - 1; i = i + 2){
				console.log("pair: " + i + " valeur: " + parseInt(code[i]) + "somme: " + sum2);
				sum2 += parseInt(code[i]);
			}
			
			var checksum_value = 3 * sum1 + sum2;

			var checksum_digit = 10 - (checksum_value % 10);
			if (checksum_digit == 10) 
			    {checksum_digit = 0;}

			console.log("e.target.value.length: " + e.target.value.length);
			console.log("CRC calcule: " + checksum_digit);
			console.log("CRC lu: " + code[e.target.value.length-1]);
			if (checksum_digit == code[e.target.value.length-1])
			{
				console.log("Code barre lu avec succes");
			}else{
				console.log("Echec de lecture du code barre");
			}
			
    	}else{
    		console.log("Pied a coulisse");
    	}
    }
});
</script>
</html>