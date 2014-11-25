// JavaScript Document

var data;
var dataF

/**************AJAX************************/

function afficherArrivages(){

	$.ajax({			  
	  url: 'http://perso.imerir.com/jloeve/pimag3a/service/get_arrivages.php',
	  dataType: 'json',
	  type: 'POST'}).done(function(msg){jsonTableA(msg);});
}

function afficherCommandesF(){

	$.ajax({			  
	  url: 'http://perso.imerir.com/jloeve/pimag3a/service/get_commandes_fournisseurs.php',
	  dataType: 'json',
	  type: 'POST'}).done(function(msgF){jsonTableF(msgF);});
}

/**************************Tableau ******************************/

function jsonTableA(msg)		
		{ 		
		data = msg;
        $("#jsonTestA").html('<table border="1" width="100%"><tr><td>Action</td><td>Date</td><td>Nom Fournisseur</td><td>Qualité</td><td>Quantité</td><td>Validité</td><td>Prix Achat</td><td>Devise</td><td>Taille des Bouchons</td><td>Controle</td></tr></table>');
		var i = 0;
			for(var tok in data.lots)
			{
				var row = $('<tr>');

				row.append('<td><button class=\'btn btn-primary btn-xs\' onclick=\'editarr(\"a\", \"'+i+'\");\'><span class=\'glyphicon glyphicon-pencil\'></span></button><button class=\'btn btn-warning btn-xs\' onclick=\'etatarr(\"'+data.lots[tok].id_lot+'\", \"masquer\");\'><span class=\'glyphicon glyphicon-eye-close\'></span></button><button class=\'btn btn-success btn-xs\' onclick=\'etatarr(\"'+data.lots[tok].id_lot+'\", \"activer\");\'><span class=\'glyphicon glyphicon-eye-open\'></span></button></td>');
				row.append('<td>' + data.lots[tok].date  + '</td>');
				row.append('<td>' + data.lots[tok].nom_fournisseur + '</td>');
				row.append('<td>' + data.lots[tok].qualite + '</td>');
				row.append('<td>' + data.lots[tok].quantite + '</td>');
				row.append('<td>' + data.lots[tok].validite + '</td>');
				row.append('<td>' + data.lots[tok].prix_achat + '</td>');				
				row.append('<td>' + data.lots[tok].devise + '</td>');
				row.append('<td>' + data.lots[tok].taille+ '</td>');			
				if(	(data.lots[tok].controle) == "OK") 
					{
						row.append('<td>' +'Valide'+'</td>');
					}
				else if ( (data.lots[tok].controle) =="OKD")
					{
						row.append('<td>' +'Derogation'+'</td>');
					}
				else
				{
					row.append('<td>' + '<a href="ControleArr.html?idLot='+data.lots[tok].id_lot+'">Effectuer controle</a></li>'+'</td>');				 
				}									  														  
				$("#jsonTestA>table").append(row);
				i++;
			}
}

function jsonTableF(msgF)		
		{ 		
		dataF = msgF;
        $("#jsonTestCF").html('<table border="1" width="100%"><tr><td>Date Commande</td><td>Date Livraison</td><td>Etat</td></tr></table>');
		
			for(var tok in dataF.commandes)
			{
				var row = $('<tr>');
	
				row.append('<td>' + dataF.commandes[tok].date_commande  + '</td>');
				row.append('<td>' + dataF.commandes[tok].date_livraison + '</td>');
				row.append('<td>' + dataF.commandes[tok].etat + '</td>');	
																					  
				$("#jsonTestCF>table").append(row);
				
			}
			
		$("#jsonTestP").html('<table border="1" width="100%"><tr><td>longueur</td><td>qualite</td><td>quantite</td><td>marquage</td><td>prix</td><td>devise</td><td>controle</td></tr></table>');
			for(var yaya in dataF.commandes[tok].paniers)
				{

					var row = $('<tr>');

					row.append('<td>' + dataF.commandes[tok].paniers[yaya].longueur  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].qualite  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].quantite  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].marquage  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].prix  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].devise  + '</td>');
					row.append('<td>' + dataF.commandes[tok].paniers[yaya].controle  + '</td>');
				}
				
				$("#jsonTestP>table").append(row);
				
}



