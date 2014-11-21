<?php
    include("header.php"); 
?>
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Saisie | <strong>Client</strong></h2>
                    <hr>
                    <form method="POST" action="http://perso.imerir.com/jloeve/pimag3a/service/edit_client.php">
                        <table>
                            <tr><td>Nom client: </td><td><input type="texte" name="nom"></td></tr>
                            <tr><td>Téléphone: </td><td><input type="texte" name="tel"></td></tr>
                            <tr><td>Fax: </td><td><input type="texte" name="fax"></td></tr>
                            <tr><td>Adresse facturation: </td><td><input type="texte" name="adresse_f"></td></tr>
                            <tr><td>Adresse livraison: </td><td><input type="texte" name="adresse_l"></td></tr>
                            <tr><td>Nom contact: </td><td><input type="texte" name="contact"></td></tr>
                            <tr><td>Mail contact: </td><td><input type="texte" name="mail"></td></tr>
                            <tr><td>Raison sociale: </td><td><input type="texte" name="raison"></td></tr>
                            <tr><td>Nom commercial: </td><td><input type="texte" name="commercial"></td></tr>
                            <tr><td><input type="hidden" name="id_commercial" value="1"><input type="hidden" name="operation" value="ajouter"></td><td><input type="submit"></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Saisie | <strong>Employes</strong></h2>
                    <hr>
                    <form method="POST" action="http://perso.imerir.com/jloeve/pimag3a/service/edit_employe.php">
                        <table>
                            <tr><td>Nom employé: </td><td><input type="texte" name="nom"></td></tr>
                            <tr><td>Prénom employé: </td><td><input type="texte" name="prenom"></td></tr>
                            <tr><td>Téléphone: </td><td><input type="texte" name="tel"></td></tr>
                            <tr><td>Rôle: </td><td><input type="texte" name="role"></td></tr>
                            <tr><td>Adresse: </td><td><input type="texte" name="adresse"></td></tr>
                            <tr><td>Fax: </td><td><input type="texte" name="fax"></td></tr>
                            <tr><td>Mail: </td><td><input type="texte" name="mail"></td></tr>
                            <tr><td><input type="hidden" name="operation" value="ajouter"></td><td><input type="submit"></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Saisie | <strong>Fournisseur</strong></h2>
                    <hr>
                    <form method="POST" action="http://perso.imerir.com/jloeve/pimag3a/service/edit_fournisseur.php">
                        <table>
                            <tr><td>Nom fournisseur: </td><td><input type="texte" name="nom"></td></tr>
                            <tr><td>Téléphone: </td><td><input type="texte" name="tel"></td></tr>
                            <tr><td>Fax: </td><td><input type="texte" name="fax"></td></tr>
                            <tr><td>Adresse: </td><td><input type="texte" name="adresse_f"></td></tr>
                            <tr><td>Nom contact: </td><td><input type="texte" name="contact"></td></tr>
                            <tr><td>Mail contact: </td><td><input type="texte" name="mail"></td></tr>
                            <tr><td>Raison sociale: </td><td><input type="texte" name="raison"></td></tr>
                            <tr><td>Nom commercial: </td><td><input type="texte" name="commercial"></td></tr>
                            <tr><td><input type="hidden" name="id_commercial" value="1"><input type="hidden" name="operation" value="ajouter"></td><td><input type="submit"></td></tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        

    </div>
    <!-- /.container -->


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })


    </script>

</body>

</html>
