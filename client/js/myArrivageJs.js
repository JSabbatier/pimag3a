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

function receptionner(idcmd){

	$.ajax({			  
	  url: 'http://perso.imerir.com/jloeve/pimag3a/service/receive_commande.php?id_commande='+idcmd,
	  type: 'POST'}).done(function(msg){alert('commande reçue');});
}


/**************************Tableau ******************************/

function jsonTableA(msg)		
		{ 		
		data = msg;
        $("#jsonTestA").html('<table><tr><td>Date</td><td>Nom Fournisseur</td><td>Qualité</td><td>Validité</td><td>Prix Achat</td><td>Devise</td><td>Taille des Bouchons</td><td>Selection</td><td>Controle</td></tr></table>');
		
			for(var tok in data.lots)
			{
					var row = $('<tr>');
	
				row.append('<td>' + data.lots[tok].date  + '</td>');
				row.append('<td>' + data.lots[tok].nom_fournisseur + '</td>');
				row.append('<td>' + data.lots[tok].qualite + '</td>');
				row.append('<td>' + data.lots[tok].validite + '</td>');
				row.append('<td>' + data.lots[tok].prix_achat + '</td>');				
				row.append('<td>' + data.lots[tok].devise + '</td>');
				row.append('<td>' + data.lots[tok].taille+ '</td>');
				row.append('<td>' +  '<input type="checkbox" name="selection" value="oui"</label>'+ '</td>');				
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
					row.append('<td>' + '<a href="ControleArr.html?idLot='+data.lots[tok].id_lot+'">Effectuer controle</a>'+'</td></tr>');				 
				}									  														  
				$("#jsonTestA>table").append(row);
			}
}

function jsonTableF(msgF)		
		{ 		
		dataF = msgF;
        $("#jsonTestCF").html('<table><tr><td>Numéro de commande</td><td>Date Commande</td><td>Date Livraison</td><td>Etat</td>><td>Valider la réception</td></tr></table>');
		
			for(var tok in dataF.commandes)
			{
				var row = $('<tr>');
	
				row.append('<td>' + dataF.commandes[tok].id_commande  + '</td>');
				row.append('<td>' + dataF.commandes[tok].date_commande  + '</td>');
				row.append('<td>' + dataF.commandes[tok].date_livraison + '</td>');
				row.append('<td>' + dataF.commandes[tok].etat + '</td></tr>');
				 if(	(dataF.commandes[tok].etat) == "recu") 
					{
						row.append('<td>' +'Déja validée'+'</td>');
					}
				else{
				row.append('<td>' + '<button id="reception" onClick="receptionner('+dataF.commandes[tok].id_commande+')">Recevoir</button>'+'</td></tr>');	}	
				
				$("#jsonTestCF>table").append(row);																	  	
			}
			
			
		$("#jsonTestP").html('<table><tr><td>Commande associée</td><td>longueur</td><td>qualite</td><td>quantite</td><td>marquage</td><td>prix</td><td>devise</td></tr></table>');
		
			for(var tik in dataF.commandes)
			{
			for(var yaya in dataF.commandes[tik].paniers)
				{
					var row2 = $('<tr>');
					
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].id_commande_fournisseur  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].longueur  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].qualite  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].quantite  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].marquage  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].prix  + '</td>');
					row2.append('<td>' + dataF.commandes[tik].paniers[yaya].devise  + '</td>');
					
					$("#jsonTestP>table").append(row2);
				}
			}
		}
		
	



