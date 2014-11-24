//Declaration des url 
//var urldata ='http://localhost/Stat/data_test.php';
var urlfournisseur ='http://perso.imerir.com/jloeve/pimag3a/service/get_nom_fournisseurs.php';
var urlDetailFournisseur =   'http://perso.imerir.com/jloeve/pimag3a/service/get_detail_fournisseur.php';
var urlgetarrivage ='http://perso.imerir.com/jloeve/pimag3a/service/get_arrivages';           
//Declaration des graphes
var chart; // chart Pie
var dataTab; // Tableau de type de lot 

var barGraph; 
var barGraphData;

var chartcolumn;
var legend;
	           
var nbrValide = 0;
var nbrNoValide = 0;
var nbrLot=0;

var $fournisseur =$('#fournisseur');
var $submitBtn 	 =$('#submitBtn');
var $dataTable   =$('#dataTable');

//Tableau de couleur pour le bar graphe
var colorTab=[];
colorTab[1]="#C72C95";
colorTab[2]="#D8E0BD";
colorTab[3]="#B3DBD4";
colorTab[4]="#69A55C";
colorTab[5]="#B5B8D3";
colorTab[6]="#F4E23B";
colorTab[7]="#A4E33B";
colorTab[8]="#F4E73C";


//Formatage des donnees pour le chartPie
chartPieData = [
     {
         "lot": "Conforme",
         "value": 0,
     },
	{
		"lot": "Non conforme",
		"value": 0,
	}
		               
];

	

							       
//Creation du ChartPie
AmCharts.ready(function () 
{
	chart = new AmCharts.AmPieChart();  
	chart.dataProvider = chartPieData;
	chart.titleField = "lot";
    chart.valueField = "value";
    chart.outlineColor = "#FFFFFF";
    chart.outlineAlpha = 0.8;
    chart.titles
    chart.outlineThickness = 2;
    chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
    // this makes the chart 3D
    chart.depth3D = 15;
    chart.angle = 30;

	// this makes the chart 3D
	//chart.validateData();

    // PIE CHART
    chart.animationPlayed	= false; 
    // chart.titles = "Taux de conformité des lots";

    // WRITE
    chart.write("chartdiv");

});

function CheckDate(d) {
      // Cette fonction vérifie le format JJ/MM/AAAA saisi et la validité de la date.
      // Le séparateur est défini dans la variable separateur
      var amin=1950; // année mini
      var currentDate = new Date()
      var amax=currentDate.getFullYear(); // année maxi
      var separateur="/"; // separateur entre jour/mois/annee
      var j=(d.substring(0,2));
      var m=(d.substring(3,5));
      var a=(d.substring(6));
      var ok=1;
      if ( ((isNaN(j))||(j<1)||(j>31)) && (ok==1) ) {
         alert("Le jour n'est pas correct."); ok=0;
      }
      if ( ((isNaN(m))||(m<1)||(m>12)) && (ok==1) ) {
         alert("Le mois n'est pas correct."); ok=0;
      }
      if ( ((isNaN(a))||(a<amin)||(a>amax)) && (ok==1) ) {
         alert("L'année n'est pas correcte."); ok=0;
      }
      if ( ((d.substring(2,3)!=separateur)||(d.substring(5,6)!=separateur)) && (ok==1) ) {
         alert("Les séparateurs doivent être des "+separateur); ok=0;
      }
      if (ok==1) {
         var d2=new Date(a,m-1,j);
         j2=d2.getDate();
         m2=d2.getMonth()+1;
         a2=d2.getFullYear();
         if (a2<=100) {a2=1900+a2}
         if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
            alert("La date "+d+" n'existe pas !");
            ok=0;
         }
      }
      return ok;
   };

//REQUETE CHOIX FOURNISSEUR ET CHANGEMENT DES DONNEES
$(document).ready( function() 
{
	var $fournisseur =$('#fournisseur');
	var $submitBtn 	 =$('#submitBtn');
	var $dataTable = $('#dataTable');
 // chargement des régions
    $.ajax(
    {
        url: urlfournisseur,
        dataType: 'json', // on veut un retour JSON
        success: function(json)
        {
            $.each(json, function(index, value) 
            { // pour chaque noeud JSON
                // on ajoute l option dans la liste
                $fournisseur.append('<option value="'+ index +'">'+ value +'</option>');
            });
        }
    });


	$fournisseur.on ('change', function() 
	{
	    var val = $(this).val(); // on récupère la valeur du fournisseur

		var adresse = $('#adresse');
		var telephone =$('#telephone');
		var fax = $('#fax ');
		var mail =$('#mail');
		if(val != '')
	    { 
	        $.ajax(
	        {
	            url: urlDetailFournisseur,//+"?id_fournisseur="+val,
	            type:'POST',
	            data:'id_fournisseur='+val, // on envoie $_GET['id_region']
	        
	            dataType: 'json',
	            success: function(json) 
	            {
	                    adresse.html(json["adresse"]);
	                    telephone.html(json["numero"]);
	                    fax.html(json["fax"]);  
	                    mail.html(json["email"]); 
	        	}
	   	 	});
	   	}


	});

//Fonction executé lors de l'appui sur le boutton submit
//Effectue une requete POST pour récupérer les données des lots du fournisseur
//Crée les tableau correspondant
	$submitBtn.on('click', function()
	{
		var dateDebut = $('#dateDebut').val();
		var dateFin = $('#dateFin').val();
		var val= $(fournisseur).val();

		if (fournisseur == '' || dateDebut == '' || dateFin == '') 
		{
			alert("Please Fill All Fields");
		}
		else if ( CheckDate(dateDebut)==1 && CheckDate(dateFin)==1)
		{
			$.ajax
			({
				url:  urlgetarrivage,
				data: { 'id_fournisseur':val, 'dateDebut':dateDebut , 'dateFin':dateFin},
				type:'POST',
				dataType: 'json',
				success: function(json) 
				{
					var dataTab =[];
					dataTab["nbrTotalValide"] = 0;
					dataTab["nbrTotalNoValide"] = 0;
					nbrLot=0;

						dataTab[38]=[];
		              	dataTab[44]=[];
		              	dataTab[49]=[];
		              	for (i=1 ; i <= 8 ; i++)
		              	{
		              		dataTab[38][i]=[];
		      				dataTab[38][i]["nbrValide"]= 0;
		      				dataTab[38][i]["nbrNoValide"]=0;
		      				

		              		dataTab[44][i]=[];
		              		dataTab[44][i]["nbrValide"]=[];
		              		dataTab[44][i]["nbrNoValide"]=[];

							
							dataTab[49][i]=[];
							dataTab[49][i]["nbrValide"]=[];
							dataTab[49][i]["nbrNoValide"]=[];
							
		              	}

		            $.each(json["lots"], function(index, value) 
		            {
		             	
		              	$dataTable.append("<tr><td>"+value["date"] +"</td><td>" + value["id_lot"]+"</td><td>"+ value["controle"] +"</td></tr>");

		              	nbrLot = nbrLot + 1;

	              		//Definition du tableau de données des lots
	              		if (dataTab[value['taille']] == undefined)   
	              			dataTab[value['taille']] = [];   
	              		if (dataTab[value['taille']][value['qualite']] == undefined)   
	              			dataTab[value['taille']][value['qualite']] = [];  
		              	
		              	//Incrementation du tableau de lot
		              	if ( (value['controle']== "OK") || (value['controle']== "OKD"))
		              	{ 
		              		if (dataTab[value['taille']][value['qualite']]["nbrValide"] == undefined)
		              			dataTab[value['taille']][value['qualite']]["nbrValide"] = 0;
		               	
		               		dataTab[value['taille']][value['qualite']]["nbrValide"] ++;
		               		dataTab["nbrTotalValide"] =dataTab["nbrTotalValide"]+1;
		              	}
		              	else
		              	{
		              		if (dataTab[value['taille']][value['qualite']]["nbrNoValide"] == undefined)
		              			dataTab[value['taille']][value['qualite']]["nbrNoValide"] = 0;
		               	
		               		dataTab[value['taille']][value['qualite']]["nbrNoValide"] ++;
		               		dataTab["nbrTotalNoValide"] =dataTab["nbrTotalNoValide"] +1;
		              	}

		         	});

		          

					chartPieData = [
     					{
        					 "lot": "Lots conformes",
        					 "value": dataTab["nbrTotalValide"],
     					},
						{
							"lot": "Lots non conformes",
							"value": dataTab["nbrTotalNoValide"],
						}  
					];
					chart.dataProvider = chartPieData;
					chart.validateData();


					var legendconforme = [];
					for (i = 1; i < 9; i++)
					{
						legendconforme [i]= 'qualite '+i+' conforme'; 
					}	
				
					var legendNoConforme = [];
					for (i = 1; i < 9; i++)
					{
						legendNoConforme [i]= 'qualite '+i+' non conforme'; 
					}

					barGraphData = [
						{
							"Taille": 'Conforme - Non conforme \n Taille 38',
							"qualite 1 conforme": dataTab[38][1]["nbrValide"],
							"qualite 2 conforme": dataTab[38][2]["nbrValide"],
							"qualite 3 conforme": dataTab[38][3]["nbrValide"],
							"qualite 4 conforme": dataTab[38][4]["nbrValide"],
							"qualite 5 conforme": dataTab[38][5]["nbrValide"],
							"qualite 6 conforme": dataTab[38][6]["nbrValide"],
							"qualite 7 conforme": dataTab[38][7]["nbrValide"],
							"qualite 8 conforme": dataTab[38][8]["nbrValide"],
							
							"qualite 1 non conforme": dataTab[38][1]["nbrNoValide"],
							"qualite 2 non conforme": dataTab[38][2]["nbrNoValide"],
							"qualite 3 non conforme": dataTab[38][3]["nbrNoValide"],
							"qualite 4 non conforme": dataTab[38][4]["nbrNoValide"],
							"qualite 5 non conforme": dataTab[38][5]["nbrNoValide"],
							"qualite 6 non conforme": dataTab[38][6]["nbrNoValide"],
							"qualite 7 non conforme": dataTab[38][7]["nbrNoValide"],
							"qualite 8 non conforme": dataTab[38][8]["nbrNoValide"]
					
						},
						{
						    "Taille": 'Conforme - Non conforme \n Taille 44',
							"qualite 1 conforme":dataTab[44][1]["nbrValide"],
							"qualite 2 conforme":dataTab[44][2]["nbrValide"],
							"qualite 3 conforme":dataTab[44][3]["nbrValide"],
							"qualite 4 conforme":dataTab[44][4]["nbrValide"],
							"qualite 5 conforme":dataTab[44][5]["nbrValide"],
							"qualite 6 conforme":dataTab[44][6]["nbrValide"],
							"qualite 7 conforme":dataTab[44][7]["nbrValide"],
							"qualite 8 conforme":dataTab[44][8]["nbrValide"],
					
							"qualite 1 non conforme":dataTab[44][1]["nbrNoValide"],
							"qualite 2 non conforme":dataTab[44][2]["nbrNoValide"],
							"qualite 3 non conforme":dataTab[44][3]["nbrNoValide"],
							"qualite 4 non conforme":dataTab[44][4]["nbrNoValide"],
							"qualite 5 non conforme":dataTab[44][5]["nbrNoValide"],
							"qualite 6 non conforme":dataTab[44][6]["nbrNoValide"],
							"qualite 7 non conforme":dataTab[44][7]["nbrNoValide"],
							"qualite 8 non conforme":dataTab[44][8]["nbrNoValide"]
					
						},
						{
							"Taille": 'Conforme - Non conforme \n Taille 49',
							"qualite 1 conforme":dataTab[49][1]["nbrValide"],
							"qualite 2 conforme":dataTab[49][2]["nbrValide"],
							"qualite 3 conforme":dataTab[49][3]["nbrValide"],
							"qualite 4 conforme":dataTab[49][4]["nbrValide"],
							"qualite 5 conforme":dataTab[49][5]["nbrValide"],
							"qualite 6 conforme":dataTab[49][6]["nbrValide"],
							"qualite 7 conforme":dataTab[49][7]["nbrValide"],
							"qualite 8 conforme":dataTab[49][8]["nbrValide"],
							"qualite 1 non conforme":dataTab[49][1]["nbrNoValide"],
							"qualite 2 non conforme":dataTab[49][2]["nbrNoValide"],
							"qualite 3 non conforme":dataTab[49][3]["nbrNoValide"],
							"qualite 4 non conforme":dataTab[49][4]["nbrNoValide"],
							"qualite 5 non conforme":dataTab[49][5]["nbrNoValide"],
							"qualite 6 non conforme":dataTab[49][6]["nbrNoValide"],
							"qualite 7 non conforme":dataTab[49][7]["nbrNoValide"],
							"qualite 8 non conforme":dataTab[49][8]["nbrNoValide"]
					
						}
					];

					
						barGraph = new AmCharts.AmSerialChart();
	                	barGraph.dataProvider = barGraphData;
	                	barGraph.categoryField = "Taille";
	                	barGraph.labelOffset = 5;
	 

	                	barGraph.plotAreaBorderAlpha = 0.2;
						
	                	// AXES
	                	// category
	                	var categoryAxis = barGraph.categoryAxis;
	                	categoryAxis.gridAlpha = 0.2;
	                	categoryAxis.axisAlpha = 0;
	                	categoryAxis.gridPosition = "start";
						
	                	// value
	                	var valueAxis = new AmCharts.ValueAxis();
	                	valueAxis.stackType = "regular";
	                	valueAxis.gridAlpha = 0.1;
	                	valueAxis.axisAlpha = 0;
	                	barGraph.addValueAxis(valueAxis);

	                	
	                	// GRAPHS
					    for (i = 1; i < 9; i++)
						{
						 // first graph
							var graph = new AmCharts.AmGraph();
							graph.title = 'Qualité '+ i + ' conforme';
							graph.labelText = "[[value]]";
							graph.valueField = legendconforme[i];
							graph.type = "column";
							graph.lineAlpha = 0;
							graph.fillAlphas = 1;
							graph.lineColor = colorTab[i];
							graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
							barGraph.addGraph(graph);
						}

	 					// Nouvelle colonne du graphe
						var graph = new AmCharts.AmGraph();
						graph.title = 'Qualité '+ 1 + ' non conforme';
						graph.labelText = "[[value]]";
						graph.valueField = legendNoConforme[1];
						graph.type = "column";
						graph.newStack = true; //Nouvelle colonne du graphe
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = colorTab[1];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						barGraph.addGraph(graph);

					    for (i = 2; i < 9; i++)
						{
							// first graph
						    var graph = new AmCharts.AmGraph();
						    graph.title = 'Qualité '+ i + ' non conforme';
						    graph.labelText = "[[value]]";
						    graph.valueField = legendNoConforme[i];
						    graph.type = "column";
						    graph.lineAlpha = 0;
						    graph.fillAlphas = 1;
						    graph.lineColor = colorTab[i];
						    graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						    barGraph.addGraph(graph);
						}
						// LEGEND
		                var legend = new AmCharts.AmLegend();
		                legend.borderAlpha = 0.2;
		                legend.horizontalGap = 10;
		                legend.align = 'right';
		                barGraph.addLegend(legend,"legenddiv");

						barGraph.depth3D = 25;
                    	barGraph.angle = 30;

                    	 barGraph.write("barGraph");

					

					

				}
			});
		}
	});
		             		
});
					           
// A la sélection d'un fournisseur dans la liste





	       
					                
