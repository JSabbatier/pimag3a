<?php
    include("header.php"); 

?>
  <script src="graph_functions.js" type="text/javascript"></script> 
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Statistiques | <strong>FOURNISSEUR</strong></h2>
                    <hr>
		
					<form id="fournisseur_form" method="post">
						<label> NOM DU FOURNISSEUR*</label> 
        			    <select id="fournisseur" name="fournisseur" placeholder="-- CHOIX --">
        			        <option  value=""></option>
        			     </select>
        			    <br>
						<label> ADRESSE </label> 	<span id="adresse" name="adresse"> </span><br>
						<label> TELEPHONE</label> 	<span id="telephone" name="telephone"> </span><br>
						<label> FAX </label> 		<span id="fax" name="fax"> </span><br>
						<label> MAIL </label> 		<span id="mail" name="mail"> </span><br>
						<br>
						<label> DATE RECEPTION  DE * </label> 	<input type="date" id="dateDebut" name="dateDebut" placeholder="JJ/MM/AAAA" required>
						<label> AU* </label>			<input type="date" id="dateFin" name="dateFin" placeholder="JJ/MM/AAAA" required>
						<input id="submitBtn" type="button" value="Submit">
					</form>
		
					<table id="dataTable" name="dateTable" style="display:none;">
						 <tr>
					       <th >Date</th>
					       <th >Lot</th>
					       <th >Validité</th>
   						</tr>
   					</table>	
   					<br><br>
					<div id="chartdiv" style="width: 100%; height: 400px; "></div>
					<br><br>
					

								<div id="barGraph" 	style="width: 100%; height: 400px; vertical-align:middle; "></div>

								<div id="legenddiv" style="width: 100%; height: 200px; vertical-align:middle float:right; "></div>

                </div>
            </div>
        </div>
            <!-- /.container -->
    <?php include("footer.php"); ?>
