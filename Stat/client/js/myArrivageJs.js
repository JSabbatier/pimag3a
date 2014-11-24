// JavaScript Document

var data;

data={ "arrivage": [ { "id": "4", "date": "26", "fournisseur": "66", "qualite": "2", "quantité": "5000", "validite": "oui", "prixAchat": "400", "devise": "£", "tailleB": 44, "Controle": "oui" }, { "id": "1", "date": "26", "fournisseur": "66", "qualite": "2", "quantité": "5000", "validite": "oui", "prixAchat": "400", "devise": "£", "tailleB": 44, "Controle": "oui" } ] };


function jsonTable()		
		{ 		
        $("#jsonTest").html('<table><tr><td>Date</td><td>Nom Fournisseur</td><td>Qualité</td><td>Validité</td><td>Prix Achat</td><td>Devise</td><td>Taille des Bouchons</td><td>Selection</td><td>Controle</td></tr></table>');
		
			for(var tok in data.arrivage)
			{
					var row = $('<tr>');
	
				row.append('<td>' + data.arrivage[tok].date  + '</td>');
				row.append('<td>' + data.arrivage[tok].fournisseur + '</td>');
				row.append('<td>' + data.arrivage[tok].qualite + '</td>');
				row.append('<td>' + data.arrivage[tok].validite + '</td>');
				row.append('<td>' + data.arrivage[tok].prixAchat + '</td>');				
				row.append('<td>' + data.arrivage[tok].devise + '</td>');
				row.append('<td>' + data.arrivage[tok].tailleB + '</td>');				

																		  
				$("#jsonTest>table").append(row);
			}
	
}