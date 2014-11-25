<?php
    include("header.php"); 
?>
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Administration | <strong>Client</strong></h2>
                    <hr>
                    <input align="center" type="button" id="btnaffcli" class="btn btn-default" onclick='communicate(client, "get_clients.php");' value="Afficher">
                    <input align="center" type="button" id="btnaddcli" class="btn btn-info" onclick="addCli('a')" value="Ajouter">
                    <br>
                    <div id="divcli"></div>
                    <br>
                    <table id="tabeditcli" style="display:none;" border="1"><tr><td align="center">Informations
                    </td>
                    <td align="center">Adresses de livraison <button align="right" onclick="addaddr();" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus" ></span></button></td>
                    </tr><tr><td valign="top">
                        <table id="tabeditcliinfos">
                            <tr>
                                <td>Statut: </td>
                                <td><input type="texte" id="tabeditclirais" name="raison"></td>
                            </tr>
                            <tr>
                                <td>Nom client: </td>
                                <td><input type="texte" id="tabeditclinom" name="nom"></td>
                            </tr>
                            <tr>
                                <td>Téléphone: </td>
                                <td><input type="texte" id="tabeditclitel" name="tel"></td>
                            </tr>
                            <tr>
                                <td>Fax: </td>
                                <td><input type="texte" id="tabeditclifax" name="fax"></td>
                            </tr>
                            <tr>
                                <td>Adresse facturation: </td>
                                <td><input type="texte" id="tabeditcliadrf" name="adresse_f"></td>
                            </tr>
                            <tr>
                                <td>Nom contact: </td>
                                <td><input type="texte" id="tabeditclicontact" name="contact"></td>
                            </tr>
                            <tr>
                                <td>Mail contact: </td>
                                <td><input type="texte" id="tabeditclimail" name="mail"></td>
                            </tr>
                            <tr>
                                <td>Id commercial: </td>
                                <td><input type="texte" id="tabeditclicomm" name="commercial"></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" id="tabeditcliidcli" name="id_client" ><input type="hidden" id="tabeditcliope" name="operation" ></td>
                                <td><input type="button" id="tabeditbtnvalid" class="btn btn-default" onclick="actionCli('m')"></td>
                            </tr>          
                        </table>
                    </td>
                        <td id="tabeditcliaddaddr" valign="top">
                            <table></table>
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                   <hr>
                    <h2 class="intro-text text-center">Administration | <strong>Employes</strong></h2>
                    <hr>
                    <br>
                    <input align="center" type="button" id="btnaffEmp" class="btn btn-default" onclick='communicate(employe, "get_employes.php");' value="Afficher">
                    <input align="center" type="button" id="btnaddEmp" class="btn btn-info" onclick="addEmp('a')" value="Ajouter">
                    <div id="divemp"></div>
                    <br>
                     <table id="tabeditemp" style="display:none;" border="1"><tr><td align="center">Informations</td>
                        </tr><tr><td valign="top">
                        <table id="tabeditempinfos">
                        <tr>
                            <td>Nom: </td>
                            <td><input type="texte" id="tabeditempnom" name="nom"></td>
                        </tr>
                        <tr>
                            <td>Prénom: </td>
                            <td><input type="texte" id="tabeditemppre" name="prenom"></td>
                        </tr>
                        <tr>
                            <td>Téléphone: </td>
                            <td><input type="texte" id="tabeditemptel" name="tel"></td>
                        </tr>
                        <tr>
                            <td>Fax: </td>
                            <td><input type="texte" id="tabeditempfax" name="fax"></td>
                        </tr>
                        <tr>
                            <td>Adresse: </td>
                            <td><input type="texte" id="tabeditempadrf" name="adresse"></td>
                        </tr>
                        <tr>
                            <td>Nom contact: </td>
                            <td><input type="texte" id="tabeditempcontact" name="contact"></td>
                        </tr>
                        <tr>
                            <td>Mail contact: </td>
                            <td><input type="texte" id="tabeditempmail" name="mail"></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" id="tabeditempidemp" name="id_Emp" ><input type="hidden" id="tabeditempope" name="operation" ></td>
                            <td><input type="button" id="tabeditempbtnvalid" class="btn btn-default" onclick="actionEmp('m')"></td>
                        </tr>          
                    </table>
                    </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Administration | <strong>Fournisseur</strong></h2>
                    <hr>
                    <br>
                    <input align="center" type="button" id="btnafffour" class="btn btn-default" onclick='communicate(fournisseur, "get_fournisseurs.php");' value="Afficher">
                    <input align="center" type="button" id="btnaddfour" class="btn btn-info" onclick="addFour('a')" value="Ajouter">
                    <div id="divfour"></div>
                    <br>
                     <table id="tabeditfour" style="display:none;" border="1"><tr><td align="center">Informations</td>
                        </tr><tr><td valign="top">
                        <table id="tabeditfourinfos">
                        <tr>
                            <td>Statut: </td>
                            <td><input type="texte" id="tabeditfourrais" name="raison"></td>
                        </tr>
                        <tr>
                            <td>Nom fournisseur: </td>
                            <td><input type="texte" id="tabeditfournom" name="nom"></td>
                        </tr>
                        <tr>
                            <td>Téléphone: </td>
                            <td><input type="texte" id="tabeditfourtel" name="tel"></td>
                        </tr>
                        <tr>
                            <td>Fax: </td>
                            <td><input type="texte" id="tabeditfourfax" name="fax"></td>
                        </tr>
                        <tr>
                            <td>Adresse: </td>
                            <td><input type="texte" id="tabeditfouradrf" name="adresse"></td>
                        </tr>
                        <tr>
                            <td>Nom contact: </td>
                            <td><input type="texte" id="tabeditfourcontact" name="contact"></td>
                        </tr>
                        <tr>
                            <td>Mail contact: </td>
                            <td><input type="texte" id="tabeditfourmail" name="mail"></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" id="tabeditfouridfour" name="id_four" ><input type="hidden" id="tabeditfourope" name="operation" ></td>
                            <td><input type="button" id="tabeditfourbtnvalid" class="btn btn-default" onclick="actionFour('m')"></td>
                        </tr>          
                    </table>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container -->
    <?php include("footer.php"); ?>

<script>
//var jsondata = '{"1":{"nom":"Py Companie","numero": "0467394215","fax": null,"contact": "cyril","mail": "toto@riri.frz","raison": "sarl","commercial": "0","adresse_f": "adresse facturation","adresse_l": []},"2": {"nom": "Python corp.","numero": "0467394215","fax": null,"contact": "cyril","mail": "toto@riri.frz","raison": "sarl","commercial": "0","adresse_f": "adresse facturation","adresse_l": [{"livraison1": "cest ici","livraison2": "ou bien la"}]}}';
var userData;

function communicate (method, keyword){
    
         $.ajax({
                type: "POST",
                url: "http://perso.imerir.com/jloeve/pimag3a/service/" + keyword
            }).done(function( msg ) {method(msg);});
}
        
function JSONParse(json){
            if (json != ""){
                jsonobj = JSON.parse(json);
                return jsonobj;
            }else{alert('No JSON to parse !');}
}
/*---------------------------------------
---------------EMPLOYES------------------
---------------------------------------*/
function employe(data){
    //userData = JSONParse(data);
    userData = data;
            $("#divemp").empty();
            $("#divemp").append("<table id='tabemp' width='100%' border='1'><tr><td align='center'>Action</td><td align='center'>Etat</td><td align='center'>Prénom</td><td align='center'>Nom</td><td align='center'>Téléphone</td><td align='center'>Fax</td><td align='center'>Contact</td><td align='center'>Mail</td><td align='center'>Adresse</td></tr></table>");
    
            $.each(userData, function (key, value){
                $("#tabemp").append("<tr><td align='center'><button class='btn btn-primary btn-xs' onclick='editemp(\"a\", \""+key+"\");'><span class='glyphicon glyphicon-pencil'></span></button><button class='btn btn-danger btn-xs' onclick='etatemp(\""+key+"\", \"supprimer\");'><span class='glyphicon glyphicon-remove'></span></button><button class='btn btn-warning btn-xs' onclick='etatemp(\""+key+"\", \"masquer\");'><span class='glyphicon glyphicon-eye-close'></span></button><button class='btn btn-success btn-xs' onclick='etatemp(\""+key+"\", \"activer\");'><span class='glyphicon glyphicon-eye-open'></span></button></td><td align='center'>"+value["etat"]+"</td><td align='center'>"+value["prenom"]+"</td><td align='center'>"+value["nom"]+"</td><td align='center'>"+value["numero"]+"</td><td align='center'>"+value["fax"]+"</td><td align='center'>"+value["contact"]+"</td><td align='center'>"+value["mail"]+"</td><td align='center'>"+value["adresse"]+"</td></tr>");
            });
}
function actionemp(param){
    if (param=="m"){
        if ($('#tabeditempope').val() == "modifier"){
            editemp(param);
        }else if ($('#tabeditempope').val() == "ajouter"){
            addemp();
        }
        
    }else if (param == 'add'){
        addemp();
    }
}
function addemp(action){

    if (action=="a"){
        addaddr("1");
        $('#tabeditemp').slideDown('slow');
        $('#tabeditempope').val("ajouter");
        $('#tabeditempbtnvalid').val("Ajouter");


        $('#tabeditemprais').val("");
        $('#tabeditempnom').val("");
        $('#tabeditemptel').val("");
        $('#tabeditempfax').val("");
        $('#tabeditempadrf').val("");
        $('#tabeditempcontact').val("");
        $('#tabeditempmail').val("");
        $('#tabeditempcomm').val("");
        $('#tabeditempidemp').val("");
    }else{

        $('#tabeditemp').slideUp('slow');
            
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_employe.php",
            data: { nom : $('#tabeditempnom').val(),
                    raison : $('#tabeditemprais').val(),
                    tel : $('#tabeditemptel').val(),
                    fax : $('#tabeditempfax').val(),
                    adresse : $('#tabeditempadrf').val(),
                    contact : $('#tabeditempcontact').val(),
                    mail : $('#tabeditempmail').val(),
                    operation : 'ajouter'}
        }).done(function( msg ) {communicate(employe, "get_employes.php");});
    }
}
function editemp(action, idemp){
    if (action == "a"){
        $('#tabeditemp').slideDown('slow');

        $('#tabeditemprais').val(userData[idemp]["raison"]);
        $('#tabeditempnom').val(userData[idemp]["nom"]);
        $('#tabeditemptel').val(userData[idemp]["telephone"]);
        $('#tabeditempfax').val(userData[idemp]["fax"]);
        $('#tabeditempadrf').val(userData[idemp]["adresse"]);
        $('#tabeditempcontact').val(userData[idemp]["contact"]);
        $('#tabeditempmail').val(userData[idemp]["mail"]);
        $('#tabeditempcomm').val(userData[idemp]["commercial"]);
        $('#tabeditempope').val("modifier")
        $('#tabeditempidemp').val(idemp);
        $('#tabeditempbtnvalid').val("Mise à jour");
        
        $('#tabeditempaddaddr').empty();
        $('#tabeditempaddaddr').append('<tr><td align="center">Nom</td><td align="center">Adresse</td></tr>');

        $.each(userData[idemp]["adresse_l"], function (key, value){
                if (userData[idemp].adresse_l[key]["adresse"] != null){
                    $('#tabeditempaddaddr').append('<tr><td><input type="texte" class="tabeditempadr" name="adresse_name" value="'+userData[idemp].adresse_l[key]["nom"]+'"></td><td><input type="texte" class="tabeditempadrl" name="adresse_" value="'+userData[idemp].adresse_l[key]["adresse"]+'"></td></tr>');
                }
        });
    }else{
        var majdata = Array();

        $('#tabeditemp').slideUp('slow');
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_employe.php",
            data: { nom : $('#tabeditempnom').val(),
                    raison : $('#tabeditemprais').val(),
                    tel : $('#tabeditemptel').val(),
                    fax : $('#tabeditempfax').val(),
                    adresse : $('#tabeditempadrf').val(),
                    contact : $('#tabeditempcontact').val(),
                    mail : $('#tabeditempmail').val(),
                    commercial : $('#tabeditempcomm').val(),
                    id_employe : $('#tabeditempidemp').val(),
                    operation : 'modifier'
        }}).done(function( msg ) {communicate(employe, "get_employes.php");});
    }
}
function etatemp(idemp, etat){
    $.ajax({
        type: "POST",
        url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_employe.php",
        data: { id_employe: idemp,
                operation : etat}
    }).done(function( msg ) {communicate(employe, "get_employes.php");});
}
/*---------------------------------------
---------------FOURNISSEUR---------------
---------------------------------------*/
function fournisseur(data){
    //userData = JSONParse(data);
    userData = data;
            $("#divfour").empty();
            $("#divfour").append("<table id='tabfour' width='100%' border='1'><tr><td align='center'>Action</td><td align='center'>Etat</td><td align='center'>Statut</td><td align='center'>Nom</td><td align='center'>Téléphone</td><td align='center'>Fax</td><td align='center'>Contact</td><td align='center'>Mail</td><td align='center'>Adresse</td></tr></table>");
    
            $.each(userData, function (key, value){
                $("#tabfour").append("<tr><td align='center'><button class='btn btn-primary btn-xs' onclick='editFour(\"a\", \""+key+"\");'><span class='glyphicon glyphicon-pencil'></span></button><button class='btn btn-danger btn-xs' onclick='etatFour(\""+key+"\", \"supprimer\");'><span class='glyphicon glyphicon-remove'></span></button><button class='btn btn-warning btn-xs' onclick='etatFour(\""+key+"\", \"masquer\");'><span class='glyphicon glyphicon-eye-close'></span></button><button class='btn btn-success btn-xs' onclick='etatFour(\""+key+"\", \"activer\");'><span class='glyphicon glyphicon-eye-open'></span></button></td><td align='center'>"+value["etat"]+"</td><td align='center'>"+value["raison"]+"</td><td align='center'>"+value["nom"]+"</td><td align='center'>"+value["telephone"]+"</td><td align='center'>"+value["fax"]+"</td><td align='center'>"+value["contact"]+"</td><td align='center'>"+value["mail"]+"</td><td align='center'>"+value["adresse"]+"</td></tr>");
            });
}
function actionFour(param){
    if (param=="m"){
        if ($('#tabeditfourope').val() == "modifier"){
            editFour(param);
        }else if ($('#tabeditfourope').val() == "ajouter"){
            addFour();
        }
        
    }else if (param == 'add'){
        addFour();
    }
}
function addFour(action){

    if (action=="a"){
        addaddr("1");
        $('#tabeditfour').slideDown('slow');
        $('#tabeditfourope').val("ajouter");
        $('#tabeditfourbtnvalid').val("Ajouter");


        $('#tabeditfourrais').val("");
        $('#tabeditfournom').val("");
        $('#tabeditfourtel').val("");
        $('#tabeditfourfax').val("");
        $('#tabeditfouradrf').val("");
        $('#tabeditfourcontact').val("");
        $('#tabeditfourmail').val("");
        $('#tabeditfourcomm').val("");
        $('#tabeditfouridfour').val("");
    }else{

        $('#tabeditfour').slideUp('slow');
            
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_fournisseur.php",
            data: { nom : $('#tabeditfournom').val(),
                    raison : $('#tabeditfourrais').val(),
                    tel : $('#tabeditfourtel').val(),
                    fax : $('#tabeditfourfax').val(),
                    adresse : $('#tabeditfouradrf').val(),
                    contact : $('#tabeditfourcontact').val(),
                    mail : $('#tabeditfourmail').val(),
                    operation : 'ajouter'}
        }).done(function( msg ) {communicate(fournisseur, "get_fournisseurs.php");});
    }
}
function editFour(action, idfour){
    if (action == "a"){
        $('#tabeditfour').slideDown('slow');

        $('#tabeditfourrais').val(userData[idfour]["raison"]);
        $('#tabeditfournom').val(userData[idfour]["nom"]);
        $('#tabeditfourtel').val(userData[idfour]["telephone"]);
        $('#tabeditfourfax').val(userData[idfour]["fax"]);
        $('#tabeditfouradrf').val(userData[idfour]["adresse"]);
        $('#tabeditfourcontact').val(userData[idfour]["contact"]);
        $('#tabeditfourmail').val(userData[idfour]["mail"]);
        $('#tabeditfourcomm').val(userData[idfour]["commercial"]);
        $('#tabeditfourope').val("modifier")
        $('#tabeditfouridfour').val(idfour);
        $('#tabeditfourbtnvalid').val("Mise à jour");
        
        $('#tabeditfouraddaddr').empty();
        $('#tabeditfouraddaddr').append('<tr><td align="center">Nom</td><td align="center">Adresse</td></tr>');

        $.each(userData[idfour]["adresse_l"], function (key, value){
                if (userData[idfour].adresse_l[key]["adresse"] != null){
                    $('#tabeditfouraddaddr').append('<tr><td><input type="texte" class="tabeditfouradr" name="adresse_name" value="'+userData[idfour].adresse_l[key]["nom"]+'"></td><td><input type="texte" class="tabeditfouradrl" name="adresse_" value="'+userData[idfour].adresse_l[key]["adresse"]+'"></td></tr>');
                }
        });
    }else{
        var majdata = Array();

        $('#tabeditfour').slideUp('slow');
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_fournisseur.php",
            data: { nom : $('#tabeditfournom').val(),
                    raison : $('#tabeditfourrais').val(),
                    tel : $('#tabeditfourtel').val(),
                    fax : $('#tabeditfourfax').val(),
                    adresse : $('#tabeditfouradrf').val(),
                    contact : $('#tabeditfourcontact').val(),
                    mail : $('#tabeditfourmail').val(),
                    commercial : $('#tabeditfourcomm').val(),
                    id_fournisseur : $('#tabeditfouridfour').val(),
                    operation : 'modifier'
        }}).done(function( msg ) {communicate(fournisseur, "get_fournisseurs.php");});
    }
}
function etatFour(idfour, etat){
    $.ajax({
        type: "POST",
        url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_fournisseur.php",
        data: { id_fournisseur: idfour,
                operation : etat}
    }).done(function( msg ) {communicate(fournisseur, "get_fournisseurs.php");});
}
/*---------------------------------------
---------------CLIENT--------------------
---------------------------------------*/ 
function client (data) {
            //userData = JSONParse(data);
            userData = data;
            $("#divcli").empty();
            $("#divcli").append("<table id='tabcli' width='100%' border='1'><tr><td align='center'>Action</td><td align='center'>Etat</td><td align='center'>Statut</td><td align='center'>Nom</td><td align='center'>Téléphone</td><td align='center'>Fax</td><td align='center'>Contact</td><td align='center'>Mail</td><td align='center'>Commercial</td><td align='center'>Facturation</td><td align='center'>Livraison</td></tr></table>");
    
            $.each(userData, function (key, value){
                $("#tabcli").append("<tr><td align='center'><button class='btn btn-primary btn-xs' onclick='editCli(\"a\", \""+key+"\");'><span class='glyphicon glyphicon-pencil'></span></button><button class='btn btn-danger btn-xs' onclick='etatCli(\""+key+"\", \"supprimer\");'><span class='glyphicon glyphicon-remove'></span></button><button class='btn btn-warning btn-xs' onclick='etatCli(\""+key+"\", \"masquer\");'><span class='glyphicon glyphicon-eye-close'></span></button><button class='btn btn-success btn-xs' onclick='etatCli(\""+key+"\", \"activer\");'><span class='glyphicon glyphicon-eye-open'></span></button></td><td align='center'>"+value["etat"]+"</td><td align='center'>"+value["raison"]+"</td><td align='center'>"+value["nom"]+"</td><td align='center'>"+value["numero"]+"</td><td align='center'>"+value["fax"]+"</td><td align='center'>"+value["contact"]+"</td><td align='center'>"+value["mail"]+"</td><td align='center'>"+value["commercial"]+"</td><td align='center'>"+value["adresse_f"]+"</td><td align='center'>"+/*value["adresse_l"]["adresse"]*/" "+"</td></tr>");
            });
}
function actionCli(param){
    if (param=="m"){
        if ($('#tabeditcliope').val() == "modifier"){
            editCli(param);
        }else if ($('#tabeditcliope').val() == "ajouter"){
            addCli();
        }
        
    }else if (param == 'add'){
        addCli();
    }
}
function addCli(action){
    if (action=="a"){
            addaddr("1");
            $('#tabeditcli').slideDown('slow');
            $('#tabeditcliope').val("ajouter");
            $('#tabeditbtnvalid').val("Ajouter");


            $('#tabeditclirais').val("");
            $('#tabeditclinom').val("");
            $('#tabeditclitel').val("");
            $('#tabeditclifax').val("");
            $('#tabeditcliadrf').val("");
            $('#tabeditclicontact').val("");
            $('#tabeditclimail').val("");
            $('#tabeditclicomm').val("");
            $('#tabeditcliidcli').val("");
    }else{

        $('#tabeditcli').slideUp('slow');
            
        $.ajax({
            type: "POST",
            url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_client.php",
            data: { nom : $('#tabeditclinom').val(),
                    raison : $('#tabeditclirais').val(),
                    tel : $('#tabeditclitel').val(),
                    fax : $('#tabeditclifax').val(),
                    adresse_f : $('#tabeditcliadrf').val(),
                    adresse_l : $('#adresse1').val(),
                    contact : $('#tabeditclicontact').val(),
                    mail : $('#tabeditclimail').val(),
                    commercial : $('#tabeditclicomm').val(),
                    operation : 'ajouter'}
        }).done(function( msg ) {communicate(client, "get_clients.php");});
    }
}
function editCli(action, idcli){
    if (action == "a"){
            $('#tabeditcli').slideDown('slow');

            $('#tabeditclirais').val(userData[idcli]["raison"]);
            $('#tabeditclinom').val(userData[idcli]["nom"]);
            $('#tabeditclitel').val(userData[idcli]["numero"]);
            $('#tabeditclifax').val(userData[idcli]["fax"]);
            $('#tabeditcliadrf').val(userData[idcli]["adresse_f"]);
            $('#tabeditclicontact').val(userData[idcli]["contact"]);
            $('#tabeditclimail').val(userData[idcli]["mail"]);
            $('#tabeditclicomm').val(userData[idcli]["commercial"]);
            $('#tabeditcliope').val("modifier")
            $('#tabeditcliidcli').val(idcli);
            $('#tabeditbtnvalid').val("Mise à jour");
            
            $('#tabeditcliaddaddr').empty();
            $('#tabeditcliaddaddr').append('<tr><td align="center">Nom</td><td align="center">Adresse</td></tr>');

            $.each(userData[idcli]["adresse_l"], function (key, value){
                    if (userData[idcli].adresse_l[key]["adresse"] != null){
                        $('#tabeditcliaddaddr').append('<tr><td><input type="texte" class="tabeditcliadr" name="adresse_name" value="'+userData[idcli].adresse_l[key]["nom"]+'"></td><td><input type="texte" class="tabeditcliadrl" name="adresse_" value="'+userData[idcli].adresse_l[key]["adresse"]+'"></td></tr>');
                    }
            });
        }else{
            var majdata = Array();

            $('#tabeditcli').slideUp('slow');
            $.ajax({
                type: "POST",
                url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_client.php",
                data: { nom : $('#tabeditclinom').val(),
                        raison : $('#tabeditclirais').val(),
                        tel : $('#tabeditclitel').val(),
                        fax : $('#tabeditclifax').val(),
                        adresse_f : $('#tabeditcliadrf').val(),
                        contact : $('#tabeditclicontact').val(),
                        mail : $('#tabeditclimail').val(),
                        commercial : $('#tabeditclicomm').val(),
                        id_client : $('#tabeditcliidcli').val(),
                        operation : 'modifier'
            }}).done(function( msg ) {communicate(client, "get_clients.php");});
        }
}
function etatCli(idcli, etat){
    $.ajax({
        type: "POST",
        url: "http://perso.imerir.com/jloeve/pimag3a/service/edit_client.php",
        data: { id_client : idcli,
                operation : etat}
    }).done(function( msg ) {communicate(client, "get_clients.php");});
}
function addaddr(num){

            $('#tabeditcliaddaddr').append('<tr><td><input id="nom'+num+'" type="texte" class="tabeditcliadr" name="adresse_name"></td><td><input id="adresse'+num+'" type="texte" class="tabeditcliadrl" name="adresse_"></td><td align="center"><button class="btn btn-danger btn-xs" onclick="supCli(\""+key+"\");"><span class="glyphicon glyphicon-minus"></span></button></td></tr>');
}                       
       
    </script>
</body>
</html>