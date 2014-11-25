<?php
    include("header.php"); 
?>
         <div class="row">
            <div class="box">
                <div class="col-lg-12">
                   <hr>
                    <h2 class="intro-text text-center">Approvisionnement | <strong>Arrivage</strong></h2>
                    <hr>
                    <br>
                    <input type="button" id="afficher" class="btn btn-default" onClick="afficherArrivages();communicate(arr,'get_arrivages.php');" value="Afficher">
                    <input type="button" id="arrajout" class="btn btn-info" onClick="addarr('a');actionarr('a');$('#tabeditarr').slideDown('slow');" value="Ajouter">
                    <br>
                    <div id="jsonTestA"></div>
                    <br>
                    <table id="tabeditarr" border="1" style="display:none;" ><tr><td>Informations</td></td></tr>
                        <tr><td>Date:</td>
                            <td><div class="input-append date" id="dt_arr" data-date="25/11/2014" data-date-format="dd/mm/yyyy">
                                            <input class="span2" size="16" type="text" id="tabeditarrdate" readonly>
                                            <span id="tabeditarrspandate" class="add-on"><button class="btn btn-default btn-xs" id="tabeditarrbtndate"><span class="glyphicon glyphicon-calendar"></span></button></span>
                                          </div></td></tr>
                        <tr><td>Nom fournisseur:</td><td><select id="tabeditarrfour"></select></td></tr>
                        <tr><td>Qualité:</td><td>
                                            <select id="tabeditarrqualite">
                                                <option value="1">1</option>  
                                                <option value="2">2</option>  
                                                <option value="3">3</option>  
                                                <option value="4">4</option>  
                                                <option value="5">5</option>  
                                                <option value="6">6</option>  
                                                <option value="7">7</option>  
                                                <option value="8">8</option>                                            
                                            </select></td></tr>
                        <tr><td>Quantité:</td><td><input id="tabeditarrquantite" type="number" step="10000" value="0" min="0" ></td></tr>
                        <tr><td>Validité:</td><td><input id="tabeditarrvalidite" type="text"></td></tr>
                        <tr><td>Prix achat:</td><td><input id="tabeditarrprix" type="number" step="10" value="0" min="0" ></td></tr>
                        <tr><td>Devise:</td><td>
                                            <select id="devise">
                                              <option value="€">€</option>
                                              <option value="$">$</option>
                                              <option value="£">£</option>
                                            </select></td></tr>
                        <tr><td>Longueur:</td><td>
                                            <select id="tabeditarrlong">
                                              <option value="38">38</option>
                                              <option value="44">44</option>
                                              <option value="49">49</option>
                                            </select></td></tr>
                        <tr><td>Contrôle:</td><td>
                                            <select id="tabeditarrcontrole">
                                              <option value="OK">OK</option>
                                              <option value="OKD">OKD</option>
                                              <option value="NOK">NOK</option>
                                            </select></td></tr>
                        <tr><td><input type="hidden" id="tabeditarridarr"></td>
                            <td><input type="button" id="tabeditarrbtnvalid" class="btn btn-default" onclick="actionarr('m')">
                                <input type="hidden" id="tabeditarrope" >
                                <input type="button" class="btn btn-danger" onclick="$('#tabeditarr').slideUp('slow');" value="Annuler"></td></tr>
                    </table>

                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                   <hr>
                    <h2 class="intro-text text-center">Approvisionnement | <strong>Commandes Fournisseurs</strong></h2>
                    <hr>
                       <button class="btn btn-default" id="afficher" onClick="afficherCommandesF()">Afficher</button>
                        <div id="jsonTestCF"></div>                        
                        <div id="jsonTestP"></div> 
                </div>
            </div>
        </div>
    <!-- /.container -->
    <?php include("footer.php"); ?>

<script src="datepicker/js/bootstrap-datepicker.js"></script>
<script>

        $(function(){
                $('#dt_arr').datepicker();
                $('#dt_souhaite').datepicker();
                $('#dt_reelle').datepicker();
            
        });

var userData;
var fournisseurs;

function communicate (method, keyword){
         $.ajax({
                type: "POST",
                url: "http://perso.imerir.com/jloeve/pimag3a/service/" + keyword
            }).done(function( msg ) {getFournisseurs();method(msg);});
}

       
/*---------------------------------------
---------------Arrivage------------------
---------------------------------------*/ 
function arr (data) {
            //userData = JSONParse(data);
            userData = data;
            /*$("#divarr").empty();
            $("#divarr").append("<table id='tabarr' width='100%' border='1'><tr><td align='center'>Action</td><td align='center'>Etat</td><td align='center'>Statut</td><td align='center'>Nom</td><td align='center'>Téléphone</td><td align='center'>Fax</td><td align='center'>Contact</td><td align='center'>Mail</td><td align='center'>Commercial</td><td align='center'>Facturation</td><td align='center'>Livraison</td></tr></table>");
    
            $.each(userData, function (key, value){
                $("#tabarr").append("<tr><td align='center'><button class='btn btn-primary btn-xs' onarrck='editarr(\"a\", \""+key+"\");'><span class='glyphicon glyphicon-pencil'></span></button><button class='btn btn-danger btn-xs' onarrck='etatarr(\""+key+"\", \"supprimer\");'><span class='glyphicon glyphicon-remove'></span></button><button class='btn btn-warning btn-xs' onarrck='etatarr(\""+key+"\", \"masquer\");'><span class='glyphicon glyphicon-eye-close'></span></button><button class='btn btn-success btn-xs' onarrck='etatarr(\""+key+"\", \"activer\");'><span class='glyphicon glyphicon-eye-open'></span></button></td><td align='center'>"+value["etat"]+"</td><td align='center'>"+value["raison"]+"</td><td align='center'>"+value["nom"]+"</td><td align='center'>"+value["numero"]+"</td><td align='center'>"+value["fax"]+"</td><td align='center'>"+value["contact"]+"</td><td align='center'>"+value["mail"]+"</td><td align='center'>"+value["commercial"]+"</td><td align='center'>"+value["adresse_f"]+"</td><td align='center'>"++"</td></tr>");
            });*/
}
function actionarr(param){

    if (param=="m"){
        if ($('#tabeditarrope').val() == "modifier"){
            editarr(param);
        }else if ($('#tabeditarrope').val() == "ajouter"){
            addarr();
        }
        
    }else if (param == 'a'){
        getFournisseurs();
    }
}
function getFournisseurs(){
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/get_fournisseurs.php"
        }).done(function( msg ) {fournisseurs=msg;
                                $("#tabeditarrfour").empty();
                                $.each(fournisseurs, function (key, value){
                                    $("#tabeditarrfour").append(new Option(value["nom"], key));
                                });});
}
function addarr(action){
    if (action=="a"){
        console.log("addarr("+action+")");
            $('#tabeditarr').slideDown('slow');

            $('#tabeditarrope').val("ajouter");
            $('#tabeditarrbtnvalid').val("Ajouter");
            $('#tabeditarrbtndate').show();

            $('#tabeditarrdate').val("");
            $('#tabeditarrqualite').val("");
            $('#tabeditarridarr').val("");
            $('#tabeditarrvalidite').val("");
            $('#tabeditarrquantite').val("");
            $('#tabeditarrprix').val("");
            $('#devise').val("");
            $('#tabeditarrlong').val("")
            $('#tabeditarrcontrole').val("");



    }else{

        $('#tabeditarr').slideUp('slow');
            
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_arrivage.php",
            data: { date : $('#tabeditarrdate').val(),
                    qualite : $('#tabeditarrqualite').val(),
                    id_fournisseur : $('#tabeditarrfour').val(),
                    validite : $('#tabeditarrvalidite').val(),
                    quantite : $('#tabeditarrquantite').val(),
                    prix : $('#tabeditarrprix').val(),
                    devise : $('#devise').val(),
                    taille : $('#tabeditarrlong').val(),
                    controle : $('#tabeditarrcontrole').val(),
                    operation : 'ajouter'}
        }).done(function( msg ) {communicate(arr, "get_arrivages.php");});
    }

}
function editarr(action, idarr){
    if (action == "a"){
        console.log("editarr("+action+")");
            $('#tabeditarr').slideDown('slow');

            $('#tabeditarrdate').val(userData.lots[idarr].date);
            $('#tabeditarrqualite').val(userData.lots[idarr].qualite);

            $('#tabeditarrbtndate').hide();
            
            $('#tabeditarrfour option[value="'+userData.lots[idarr].id_fournisseur+'"]').prop('selected', true);
            $('#tabeditarridarr').val(userData.lots[idarr].id_lot);
            $('#tabeditarrvalidite').val(userData.lots[idarr].validite);
            $('#tabeditarrquantite').val(userData.lots[idarr].quantite);
            $('#tabeditarrprix').val(userData.lots[idarr].prix_achat);
            $('#devise').val(userData.lots[idarr].devise);
            $('#tabeditarrlong').val(userData.lots[idarr].taille)
            $('#tabeditarrcontrole').val(userData.lots[idarr].controle);
            $('#tabeditarrope').val("modifier");
            $('#tabeditarrbtnvalid').val("Mettre à jour");

        }else{

            $('#tabeditarr').slideUp('slow');
            $.ajax({
                type: "POST",
                url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_arrivage.php",
                data: { qualite : $('#tabeditarrqualite').val(),
                        id_fournisseur : $('#tabeditarrfour').val(),
                        id_arrivage : $('#tabeditarridarr').val(),
                        validite : $('#tabeditarrvalidite').val(),
                        quantite : $('#tabeditarrquantite').val(),
                        prix : $('#tabeditarrprix').val(),
                        devise : $('#devise').val(),
                        taille : $('#tabeditarrlong').val(),
                        controle : $('#tabeditarrcontrole').val(),
                        operation : 'modifier'}
            }).done(function( msg ) {communicate(arr, "get_arrivages.php");});
        }
}
function etatarr(idarr, etat){
    $.ajax({
        type: "POST",
        url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_arrivage.php",
        data: { id_arr : idarr,
                operation : etat}
    }).done(function( msg ) {communicate(arr, "get_arrivages.php");});
}  



/**************************************Commande***************************************************/

    </script>
</body>
</html>