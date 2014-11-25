// JavaScript Document

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
	
var QueryString = function () {
	  // This function is anonymous, is executed immediately and 
	  // the return value is assigned to QueryString!
	  var query_string = {};
	  var query = window.location.search.substring(1);
	  var vars = query.split("&");
	  for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
			// If first entry with this name
		if (typeof query_string[pair[0]] === "undefined") {
		  query_string[pair[0]] = pair[1];
			// If second entry with this name
		} else if (typeof query_string[pair[0]] === "string") {
		  var arr = [ query_string[pair[0]], pair[1] ];
		  query_string[pair[0]] = arr;
			// If third or later entry with this name
		} else {
		  query_string[pair[0]].push(pair[1]);
		}
	  } 
		return query_string;
} ();

var myLot=QueryString.idLot;
$("#idArrivage").val(myLot);

	$("#envoyer").click(function (e)
	{
		e.preventDefault();
		$.ajax({			  
		  url: 'http://perso.imerir.com/jloeve/pimag3a/service/controle_depart.php',
		  dataType: 'json',
		  type: 'POST', 
		  data: myjson})	
			 });