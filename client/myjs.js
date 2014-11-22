// JavaScript Document
var myjson;
	function test()
	{
		var formData = form2object('testForm', '.', true,
				function(node)
				{
					if (node.id && node.id.match(/callbackTest/))
					{
						return { name: node.id, value: node.innerHTML };
					}
				});

		document.getElementById('testArea').innerHTML = JSON.stringify(formData, null, '\t');
		myjson=JSON.stringify(formData, null, '\t');
	}

	$("#envoyer").click(function (e)
	{
		e.preventDefault();
		$.ajax({			  
		  url: 'http://perso.imerir.com/mdacosta/pima3a/controleArrivage.php',
		  dataType: 'json',
		  type: 'POST', 
		  data: myjson})	
			 });
