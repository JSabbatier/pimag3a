// JavaScript Document

var json;

json={ "arrivage": [ { "id": "4", "date": "26", "fournisseur": "66", "qualite": "2", "quantité": "5000", "validite": "oui", "prixAchat": "400", "devise": "£", "tailleB": 44, "Controle": "oui" }, { "id": "1", "date": "26", "fournisseur": "66", "qualite": "2", "quantité": "5000", "validite": "oui", "prixAchat": "400", "devise": "£", "tailleB": 44, "Controle": "oui" } ] };


function jsonTable(data)		
		{ 		
        $("#jsonTest").html('<table><tr><td>Date</td><td>Nom Fournisseur</td><td>Qualité</td><td>Validité</td><td>Prix Achat</td><td>Devise</td><td>Taille des Bouchons</td><td>Selection</td><td>Controle</td></tr></table>');
		
			for(var tok in json.arrivage)
			{
					var row = $('<tr>');
	
				row.append('<td>' + tok.date  + '</td>');
				row.append('<td>' + tok.fournisseur + '</td>');
				row.append('<td>' + tok.qualité + '</td>');
				row.append('<td>' + tok.validite + '</td>');
				row.append('<td>' + tok.prixAchat + '</td>');				
				row.append('<td>' + tok.devise + '</td>');
				row.append('<td>' + tok.tailleB + '</td>');				
				row.append('<td>' + tok.selection + '</td>');	
				row.append('<td>' + tok.controle + '</td>');
																		  
				$("#jsonTest>table").append(row);
			}
	
}