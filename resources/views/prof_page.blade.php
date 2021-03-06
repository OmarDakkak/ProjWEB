<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename?filename+'.xls':'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
            var role= window.location.pathname.split("/").pop();
            if(role == "resp" || role == "chef"){
                M.toast({html:'Les notes ont étés validés avec succès', classes: 'rounded'});}
        }
    </script>

    <meta charset="UTF-8">
    <title>Page Prof</title>
    <link rel="stylesheet" href="{{asset('stylenav.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/core.js"></script>
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}
<!-- Compiled and minified CSS Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
    <script>
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });
    </script>
</head>
<body oncontextmenu="return false;">
<nav class="nav-extended" id="na">
    <div class="nav-wrapper">
{{--        <a href="#!" class="brand-logo"><img src="logoDept.png" class="animated fadeInLeft"></a>--}}
        <a href="#!" class="brand-logo"><img src="{{asset('logoDept.png')}}" class="animated fadeInLeft"></a>
        <a href="#" class="sidenav-trigger" data-target="mobile-nav" id="men"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/mdresp/{{$identite}}/{{$role}}">Modules responsable</a></li>
            <li><a href="/md/{{$identite}}/{{$role}}">Modules enseignés</a></li>
            @if($role!='prof')<li id="resp"><a href="/des/{{$identite}}/{{$role}}">Descriptif de la filière</a></li> @endif
            <li><a href="/liste/{{$identite}}/{{$role}}">Liste des etudiants</a></li>
            @if($role!= 'prof')<li id="resp"><a href="/affecter/{{$identite}}/{{$role}}">État des enseignements</a></li>@endif
        </ul>
    </div>
    <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down" >
            <li><a href="/nt/{{$identite}}/{{$role}}">Saisir notes</a></li>
            <li><a href="/abs/{{$identite}}/{{$role}}">Saisir l'absence</a></li>
           @if($role == 'chef') <li id="chef"><a href="/affecterresp/{{$identite}}/{{$role}}">Affecter les responsables de filières</a></li> @endif
        </ul>

    </div>
    <div class="nav-content">
        <span class="nav-title animated fadeInUp" id="greetings">
            @if($identite=='1')  <?php echo"Bonjour Pr.DADI"; ?> @endif
            @if($identite=='2')  <?php echo"Bonjour Pr.ALLAOUI"; ?>@endif
            @if($identite=='3')  <?php echo"Bonjour Pr.BOUJRAF"; ?>@endif
            @if($identite=='4')  <?php echo"Bonjour Pr.HADDOUCH"; ?>@endif
            @if($identite=='5')  <?php echo"Bonjour Monsieur le chef de département"; ?>@endif
        </span>
        <form action="/logout" method="post">{{ csrf_field() }} <input type="submit" value="Se deconnecter" class="validate tooltipped" data-position="right" data-tooltip="Retourner à la page d'acceuil!"> </form>
    </div>
</nav>

<ul class="sidenav" id="mobile-nav">
    <li><a href="/mdresp/{{$identite}}/{{$role}}">Modules responsable</a></li>
    <li><a href="/md/{{$identite}}/{{$role}}">Modules enseignés</a></li>
    @if($role!='prof')<li><a>Descriptif de la filière</a></li>@endif
    <li><a href="/liste/{{$identite}}/{{$role}}">Liste des etudiants</a></li>
    @if($role!='prof')<li><a href="/affecter/{{$identite}}/{{$role}}">État des enseignements</a></li>@endif
    <li><a href="/nt/{{$identite}}/{{$role}}">Saisir notes</a ></li>
    <li><a href="/abs/{{$identite}}/{{$role}}">Saisir l'absence</a></li>
    @if($role == 'chef')<li><a href="/affecter/{{$identite}}/{{$role}}">Affecter les responsables de filières</a>@endif
</ul>


{{--afficher la liste des etudiants--}}
<?php
try {   $i=$name; ?>
<h4 class="animated slideInDown">Voici la liste des etudiants selon les modules:</h4>
<ul class="collapsible">

        <li class="active" id="mod-1">
            <div class="collapsible-header"><i class="material-icons">list</i>Applications WEB</div>
            <div class="collapsible-body">
                <table class="striped">
                    <thead>
                    <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer</th></tr>
                    </thead>

                    <tbody>

                    {{--                $k={{$e->idm}}--}}
                    @foreach ($etudiant as $e)

                        @if(($e->idm)=='1')
                            <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="/deleteetudiant/{{$e->id}}/{{$identite}}/{{$role}}">supprimer</a> </td></tr>
                            {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
        <li id="mod-2">
            <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
            <div class="collapsible-body"><table class="striped">
                    <thead>
                    <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                    </thead>

                    <tbody>
                    @foreach ($etudiant as $e)
                        @if(($e->idm)=='2')
                            <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="/deleteetudiant/{{$e->id}}/{{$identite}}/{{$role}}">supprimer</a> </td></tr>
                            {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                        @endif
                    @endforeach
                    </tbody>
                </table></div>
        </li>

    <li id="mod-3">
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)
                    @if(($e->idm)=='3')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="/deleteetudiant/{{$e->id}}/{{$identite}}/{{$role}}">supprimer</a> </td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li id="mod-4">
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)
                    @if(($e->idm)=='4')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="/deleteetudiant/{{$e->id}}/{{$identite}}/{{$role}}">supprimer</a></td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li id="mod-5">
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='5')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="/deleteetudiant/{{$e->id}}/{{$identite}}/{{$role}}">supprimer</a></td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
</ul>
<script>
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

</script>
<?php
} catch (Exception $e) {}?>




{{--afficher les modules resp--}}
<?php
try { $i=$moduleresp ?>

<h4 class="animated slideInDown">Voici la liste des modules dont vous êtes responsable:</h4>

            <table class="striped">
                <thead>
                <tr><th>ID_Module</th><th>Nom du module</th></tr>
                </thead>

                <tbody>

                @foreach ($moduleresp as $m)
                    <tr id="mod-{{$m->id}}"><td>Module n: {{$m->id}}</td><td>{{$m->nom}}</td></tr>
                @endforeach
                </tbody>
            </table>


<?php
} catch (Exception $e) {}?>



{{--afficher les modules--}}
<?php
try { $i=$na; ?>

<h4 class="animated slideInDown">Voici la liste des modules que vous enseignez:</h4>

<table class="striped">
    <thead>
    <tr><th>ID_Module</th><th>Nom du module</th></tr>
    </thead>

    <tbody>

    @foreach ($module as $m)
        <tr id="mod-{{$m->id}}"><td>Module n: {{$m->id}}</td><td>{{$m->nom}}</td></tr>
    @endforeach
    </tbody>
</table>


<?php
} catch (Exception $e) {}?>







{{--saisir absences--}}
<?php
try {   $i=$absence ?>
<h4 class="animated slideInDown">saisie/consultation des absences:</h4>
<ul class="collapsible">
    <li class="active" id="mod-1">
        <div class="collapsible-header"><i class="material-icons">list</i>Applications WEB</div>

        <div class="collapsible-body">
            <table class="striped">

                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>
                </thead>

                <tbody>

                @foreach ($etudiantabs as $e)

                    @if(($e->idm)=='1')
                        @foreach($absence as $a)
                            @if(($a->idm)=='1' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="/add/{{$a->id}}/{{$a->nmbrabsence}}/{{$identite}}/{{$role}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>

        </div>
    </li>
    <li id="mod-2">
        <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiantabs as $e)

                    @if(($e->idm)=='2')
                        @foreach($absence as $a)
                            @if(($a->idm)=='2' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="/add/{{$a->id}}/{{$a->nmbrabsence}}/{{$identite}}/{{$role}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li id="mod-3">
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiantabs as $e)

                    @if(($e->idm)=='3')
                        @foreach($absence as $a)
                            @if(($a->idm)=='3' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="/add/{{$a->id}}/{{$a->nmbrabsence}}/{{$identite}}/{{$role}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li id="mod-4">
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiantabs as $e)

                    @if(($e->idm)=='4')
                        @foreach($absence as $a)
                            @if(($a->idm)=='4' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="/add/{{$a->id}}/{{$a->nmbrabsence}}/{{$identite}}/{{$role}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li id="mod-5">
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiantabs as $e)

                    @if(($e->idm)=='5')
                        @foreach($absence as $a)
                            @if(($a->idm)=='5' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="/add/{{$a->id}}/{{$a->nmbrabsence}}/{{$identite}}/{{$role}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
</ul>
<script>
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

</script>
<?php
} catch (Exception $e) {}?>







{{--saisir notes--}}
<?php
try { $i=$note ?>
<h4 class="animated slideInDown">saisie des notes:</h4>
<ul class="collapsible">
    <li class="active" id="mod-1">
        <div class="collapsible-header"><i class="material-icons">list</i>Applications WEB</div>
        <div class="collapsible-body">
            <table class="striped" id="note1">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>
                </thead>

                <tbody>

                @foreach ($etudiant as $e)

                    @if(($e->idm)=='1')
                        @foreach($note as $n)
                            @if(($n->idm)=='1' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="/addn/{{$n->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer" class="validate tooltipped" data-position="right" data-tooltip="Cliquez pour confirmer la note!"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button class="btn tooltipped" data-position="right" data-tooltip="Telecharger le fichier Excel, Veuillez supprimer la colonne E ;)" onclick="exportTableToExcel('note1', 'notes_WEB')" id="excel"><i class="far fa-file-excel"></i>    Fichier Excel</button>
        </div>
    </li>
    <li id="mod-2">
        <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
        <div class="collapsible-body">
            <table class="striped" id="note2">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='2')
                        @foreach($note as $n)
                            @if(($n->idm)=='2' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="/addn/{{$n->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input  type="submit" name="" value="confirmer" class="validate tooltipped" data-position="right" data-tooltip="Cliquez pour confirmer la note!"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button class="btn tooltipped" data-position="right" data-tooltip="Telecharger le fichier Excel, Veuillez supprimer la colonne E ;)"  onclick="exportTableToExcel('note2', 'notes_Complexite')" id="excel"><i class="far fa-file-excel"></i>    Fichier Excel</button>
        </div>
    </li>
    <li id="mod-3">
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body">
            <table class="striped" id="note3">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='3')
                        @foreach($note as $n)
                            @if(($n->idm)=='3' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="/addn/{{$n->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer" class="validate tooltipped" data-position="right" data-tooltip="Cliquez pour confirmer la note!"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button class="btn tooltipped" data-position="right" data-tooltip="Telecharger le fichier Excel, Veuillez supprimer la colonne E ;)"  onclick="exportTableToExcel('note3', 'notes_CPP')" id="excel"><i class="far fa-file-excel"></i>    Fichier Excel</button>
        </div>
    </li>
    <li id="mod-4">
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body">
            <table class="striped" id="note4">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='4')
                        @foreach($note as $n)
                            @if(($n->idm)=='4' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="/addn/{{$n->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer" class="validate tooltipped" data-position="right" data-tooltip="Cliquez pour confirmer la note!"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button class="btn tooltipped" data-position="right" data-tooltip="Telecharger le fichier Excel, Veuillez supprimer la colonne E ;)"  onclick="exportTableToExcel('note4', 'notes_UML')" id="excel"><i class="far fa-file-excel"></i>    Fichier Excel</button>
        </div>
    </li>
    <li id="mod-5">
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body">
            <table class="striped" id="note5">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='5')
                        @foreach($note as $n)
                            @if(($n->idm)=='5' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="/addn/{{$n->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer" class="validate tooltipped" data-position="right" data-tooltip="Cliquez pour confirmer la note!"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button class="btn tooltipped" data-position="right" data-tooltip="Telecharger le fichier Excel, Veuillez supprimer la colonne E ;)"  onclick="exportTableToExcel('note5', 'notes_RO')" id="excel"><i class="far fa-file-excel"></i>    Fichier Excel</button>
        </div>
    </li>
</ul>
<script>
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });

</script>
<?php
} catch (Exception $e) {}?>



{{--affecter enseignement--}}
<?php
try {   $i= $prof; $i=$module ?>
<h4 class="animated slideInDown">Voici l'état des enseignements:</h4>
        <table >
        <thead>
        <tr><th>Module</th><th>Professeur</th><th>Assuré/non-Assuré</th><th>Affecter</th></tr>

        </thead>

        <tbody>
        @foreach ($module as $m)
            <tr><td>{{$m->nom}}</td><td>@foreach($prof as $p) @if(($m->idp)==($p->id)) {{$p->nom}} {{$p->prenom}} @endif @endforeach</td><td>@if(($m->idp)=='0') non-Assuré @else Assuré @endif</td><td><form action="/addaffectation/{{$m->id}}/{{$identite}}/{{$role}}" method="post">{{ csrf_field() }} <input type="texte" name="aa"> <input type="submit" name="" value="affecter"></form></td></tr>
        @endforeach
        </tbody>
       </table>

<?php
} catch (Exception $e) {}?>




{{--affecter resp--}}
<?php
try {   $i= $variable;  ?>
<h4 class="animated slideInDown">Affecter un responsable à la filière:</h4>
<table >
    <thead>
    <tr><th>Professeur</th><th>Affecter</th></tr>

    </thead>

    <tbody>
    @foreach ($prof as $p)
        <tr><td>{{$p->nom}} {{$p->prenom}}</td><td><a href="/addaffectationresp/{{$p->id}}/{{$identite}}/{{$role}}">affecter</a></td></tr>
{{--        <tr><td>{{$p->nom}} {{$p->prenom}}</td><td><form action="addaffectationresp/{{$p->id}}" method="post">{{ csrf_field() }}<input type="submit" name="" value="affecter"></form></td></tr>--}}

    @endforeach
    </tbody>
</table>

</div>
<?php
} catch (Exception $e) {}?>



{{--descritpion--}}
<?php
try {    $i=$namee; ?>

<h4 class="animated slideInDown">Voici le descriptif de la Filière Génie Informatique:</h4>
<table >
    <thead>
    <tr><th>Semestre</th><th>Module</th><th>VH</th><th>Coordonnateur</th><th>Specialité</th><th>Grade</th><th>Modifier</th></tr>

    </thead>

    <tbody>
    @foreach ($descriptif as $d)
        <tr><td>{{$d->semestre}}</td><td>{{$d->module}}</td><td>{{$d->VH}}</td><td>{{$d->coordonnateur}}</td><td>{{$d->specialite}}</td><td>{{$d->grade}}</td><td><a href="/editdes/{{$d->id}}/{{$identite}}/{{$role}}">modifier</a> </td></tr>
        {{--        <tr><td>{{$p->nom}} {{$p->prenom}}</td><td><form action="addaffectationresp/{{$p->id}}" method="post">{{ csrf_field() }}<input type="submit" name="" value="affecter"></form></td></tr>--}}

    @endforeach
    </tbody>
</table>


<?php
} catch (Exception $e) {}?>



<footer class="page-footer" id="footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Département de Mathématiques et informatique</h5>
                <p class="grey-text text-lighten-4">Ceci est une application développée pour faciliter la tâche du chef de département, chefs de filières et corps professoral du DMI en général.</p>

            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2019 Copyright: O. Dakkak and A. Hajjioui
            <a class="grey-text text-lighten-4 right" href="https://ensah.ma/" target="_blank">Site de l'ENSAH</a>
        </div>
    </div>
</footer>
{{--<script>--}}
{{--    var idpr= Number(window.location.pathname.split("/").pop());--}}
{{--    //     var idpr1=Number(document.getElementById('hidden-pa').innerHTML);--}}
{{--    //      Cookies.set('idpr', idpr1, { expires: 7 });--}}
{{--    // const haha = sessionStorage.setItem("idpr", idpr1);--}}
{{--    // Object.freeze(haha);--}}
{{--    // window.name=idpr;--}}
{{--    // const idpr=idpr1;--}}
{{--    // const idpr={--}}
{{--    //     prop: document.getElementById('hidden-pa').innerHTML--}}
{{--    //--}}
{{--    // };--}}

{{--    if(idpr==1){--}}
{{--        var divOne = document.getElementById('mod-3');--}}
{{--        divOne.style.display='none';--}}
{{--        var divtwo = document.getElementById('mod-4');--}}
{{--        divtwo.style.display='none';--}}
{{--        var divthree = document.getElementById('mod-5');--}}
{{--        divthree.style.display='none';--}}
{{--    }--}}
{{--</script>--}}

<script>
    var a=window.location.pathname;
    var b=a.split("/");
    var idpr=Number(b[2]);
    // var idpr= Number(window.location.pathname.split("/").pop());
    //     var idpr1=Number(document.getElementById('hidden-pa').innerHTML);
    //      Cookies.set('idpr', idpr1, { expires: 7 });
    // const haha = sessionStorage.setItem("idpr", idpr1);
    // Object.freeze(haha);
    // window.name=idpr;
    // const idpr=idpr1;
    // const idpr={
    //     prop: document.getElementById('hidden-pa').innerHTML
    //
    // };

    // if(idpr==1){
    // var divOne = document.getElementById('mod-3');
    // divOne.style.display='none';
    // var divtwo = document.getElementById('mod-4');
    // divtwo.style.display='none';
    // var divthree = document.getElementById('mod-5');
    // divthree.style.display='none';
    // }else if(idpr=2){
    //     var divOne = document.getElementById('mod-1');
    //     divOne.style.display='none';
    //     var divtwo = document.getElementById('mod-2');
    //     divtwo.style.display='none';
    //     var divfour = document.getElementById('mod-4');
    //     divfour.style.display='none';
    //     var divfive = document.getElementById('mod-5');
    //     divfive.style.display='none';
    // } else if(idpr=3){
    //     var div1 = document.getElementById('mod-1');
    //     divOne.style.display='none';
    //     var div1 = document.getElementById('mod-2');
    //     divtwo.style.display='none';
    //     var div2 = document.getElementById('mod-3');
    //     div2.style.display='none';
    //     var div3 = document.getElementById('mod-5');
    //     div3.style.display='none';
    // }if(idpr=4){
    //     var divOne = document.getElementById('mod-1');
    //     divOne.style.display='none';
    //     var divtwo = document.getElementById('mod-2');
    //     divtwo.style.display='none';
    //     var divfour = document.getElementById('mod-3');
    //     divfour.style.display='none';
    //     var divfive = document.getElementById('mod-4');
    //     divfive.style.display='none';
    // }
    switch (idpr) {
        case 1:
            var divOne = document.getElementById('mod-3');
            divOne.style.display='none';
            var divtwo = document.getElementById('mod-4');
            divtwo.style.display='none';
            var divthree = document.getElementById('mod-5');
            divthree.style.display='none';
            break;
        case 2:
            var divOne = document.getElementById('mod-1');
            divOne.style.display='none';
            var divtwo = document.getElementById('mod-2');
            divtwo.style.display='none';
            var divfour = document.getElementById('mod-4');
            divfour.style.display='none';
            var divfive = document.getElementById('mod-5');
            divfive.style.display='none';
            break;
        case 3:
            var divOne = document.getElementById('mod-1');
            divOne.style.display='none';
            var divtwo = document.getElementById('mod-2');
            divtwo.style.display='none';
            var divfour = document.getElementById('mod-3');
            divfour.style.display='none';
            var divfive = document.getElementById('mod-4');
            divfive.style.display='none';
            break;
        case 4: var div1 = document.getElementById('mod-1');
            div1.style.display='none';
            var div2 = document.getElementById('mod-2');
            div2.style.display='none';
            var div3 = document.getElementById('mod-3');
            div3.style.display='none';
            var div4 = document.getElementById('mod-5');
            div4.style.display='none';
            break;
    }
</script>
{{--<script>--}}
{{--    var role= window.location.pathname.split("/").pop();--}}
{{--    switch (role) {--}}
{{--        case "prof":--}}
{{--            var li1= document.getElementById("resp");--}}
{{--            li1.style.display='none';--}}
{{--            var li2= document.getElementById("chef");--}}
{{--            li2.style.display='none';--}}
{{--            break;--}}
{{--        case "resp":--}}
{{--            var li1= document.getElementById("chef");--}}
{{--            li1.style.display='none';--}}
{{--            break;--}}
{{--        case "chef":--}}
{{--            var greetings= document.getElementById("greetings");--}}
{{--            greetings.innerHTML = 'Bonjour Monsieur le Chef de département';--}}
{{--            break;--}}
{{--    }--}}

{{--</script>--}}
<script>
    var role= window.location.pathname.split("/").pop();
    var ex= document.getElementById('excel');
    if(role=="chef"){
        ex.innerHTML = "Valider Les notes";
    }else if(role=="resp") {
        ex.innerHTML = "<i class=\"far fa-file-excel\"></i>       Valider / Telecharger ";
    }
</script>
<script>
    document.onkeydown = function(e) {
        if(event.keyCode == 123) {
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
            return false;
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });
</script>
</body>
</html>