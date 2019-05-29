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
        }
    </script>
    <meta charset="UTF-8">
    <title>Page Prof</title>
    <link rel="stylesheet" href="{{asset('stylenav.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <scrip src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/core.js"></scrip>
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}
<!-- Compiled and minified CSS Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
    <script>
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });
    </script>
</head>
<body>
<nav class="nav-extended" id="na">
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo"><img src="logoDept.png" class="animated fadeInLeft"></a>
        <a href="#" class="sidenav-trigger" data-target="mobile-nav" id="men"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/mdresp">Modules responsable</a></li>
            <li><a href="/md">Modules enseignés</a></li>
            <li><a href="/des">Descriptif de la filière</a></li>
            <li><a href="/liste">Liste des etudiants</a></li>
            <li><a href="/affecter">État des enseignements</a></li>
        </ul>
    </div>
    <div class="nav-wrapper">
        <ul class="right hide-on-med-and-down">
            <li><a href="/nt">Saisir notes</a></li>
            <li><a href="/abs">Saisir l'absence</a></li>
            <li><a href="/affecterresp">Affecter les responsables de filières</a></li>
        </ul>
    </div>
    <div class="nav-content">
        <span class="nav-title animated fadeInUp">Bonjour Monsieur le chef de département:</span>
        </a>
    </div>
</nav>

<ul class="sidenav" id="mobile-nav">
    <li><a>Modules responsable</a></li>
    <li><a>Modules enseignés</a></li>
    <li><a>Descriptif de la filière</a></li>
    <li><a href="/liste">Liste des etudiants</a></li>
    <li><a>État des enseignements</a></li>
    <li><a>Saisir notes</a></li>
    <li><a>Saisir l'absence</a></li>
    <li><a>Affecter les responsables de filières</a>
</ul>



{{--afficher la liste des etudiants--}}
<?php
try { $i=$name; ?>
<h4 class="animated slideInDown">Voici la liste des etudiants selon les modules:</h4>
<ul class="collapsible">
    <li>
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
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="deleteetudiant/{{$e->id}}">supprimer</a> </td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)
                    @if(($e->idm)=='2')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="deleteetudiant/{{$e->id}}">supprimer</a> </td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)
                    @if(($e->idm)=='3')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="deleteetudiant/{{$e->id}}">supprimer</a> </td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)
                    @if(($e->idm)=='4')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="deleteetudiant/{{$e->id}}">supprimer</a></td></tr>
                        {{--<tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><form action="/liste" method="post" > <button name="{{$e->id}}" >supprimer</button></form></td></tr>--}}
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>supprimer/modifier</th></tr>
                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='5')
                        <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td><a href="deleteetudiant/{{$e->id}}">supprimer</a></td></tr>
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
        <tr><td>Module n: {{$m->id}}</td><td>{{$m->nom}}</td></tr>
    @endforeach
    </tbody>
</table>


<?php
} catch (Exception $e) {}?>



{{--afficher les modules--}}
<?php
try { $i=$na; ?>

<h4 class="animated slideInDown">Voici la liste des modules que vous enseigner:</h4>

<table class="striped">
    <thead>
    <tr><th>ID_Module</th><th>Nom du module</th></tr>
    </thead>

    <tbody>

    @foreach ($module as $m)
        <tr><td>Module n: {{$m->id}}</td><td>{{$m->nom}}</td></tr>
    @endforeach
    </tbody>
</table>


<?php
} catch (Exception $e) {}?>







{{--saisir absences--}}
<?php
try { $i=$absence ?>
<h4 class="animated slideInDown">saisie/consultation des absences:</h4>
<ul class="collapsible">
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Applications WEB</div>
        <div class="collapsible-body">
            <table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>
                </thead>

                <tbody>

                @foreach ($etudiant as $e)

                    @if(($e->idm)=='1')
                        @foreach($absence as $a)
                            @if(($a->idm)=='1' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="add/{{$a->id}}/{{$a->nmbrabsence}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='2')
                        @foreach($absence as $a)
                            @if(($a->idm)=='2' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="add/{{$a->id}}/{{$a->nmbrabsence}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='3')
                        @foreach($absence as $a)
                            @if(($a->idm)=='3' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="add/{{$a->id}}/{{$a->nmbrabsence}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='4')
                        @foreach($absence as $a)
                            @if(($a->idm)=='4' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="add/{{$a->id}}/{{$a->nmbrabsence}}">ajouter</a></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>le nombre d'absences</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='5')
                        @foreach($absence as $a)
                            @if(($a->idm)=='5' &&($a->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$a->nmbrabsence}}</td><td><a href="add/{{$a->id}}/{{$a->nmbrabsence}}">ajouter</a></td></tr>
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
    <li class="active">
        <div class="collapsible-header"><i class="material-icons">list</i>Applications WEB</div>
        <div class="collapsible-body">
            <table class="striped" id="note1">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>ajouter l'absence</th></tr>
                </thead>

                <tbody>

                @foreach ($etudiant as $e)

                    @if(($e->idm)=='1')
                        @foreach($note as $n)
                            @if(($n->idm)=='1' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="addn/{{$n->id}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns" id="input1"> <input type="submit" name="" value="confirmer"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
            <button onclick="exportTableToExcel('note1', 'notes_WEB')">Export Table Data To Excel File</button>
        </div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Complexité</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='2')
                        @foreach($note as $n)
                            @if(($n->idm)=='2' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="addn/{{$n->id}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>POO en C++</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>Entrez la nouvelle note</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='3')
                        @foreach($note as $n)
                            @if(($n->idm)=='3' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="addn/{{$n->id}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>UML</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='4')
                        @foreach($note as $n)
                            @if(($n->idm)=='4' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="addn/{{$n->id}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer"></form></td></tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table></div>
    </li>
    <li>
        <div class="collapsible-header"><i class="material-icons">list</i>Recherche opérationnelle</div>
        <div class="collapsible-body"><table class="striped">
                <thead>
                <tr><th>CNE</th><th>Nom</th><th>Prenom</th><th>Note actuelle</th><th>ajouter l'absence</th></tr>

                </thead>

                <tbody>
                @foreach ($etudiant as $e)

                    @if(($e->idm)=='5')
                        @foreach($note as $n)
                            @if(($n->idm)=='5' &&($n->ide)==$e->id )
                                <tr><td>{{$e->CNE}}</td><td>{{$e->nom}}</td><td>{{$e->prenom}}</td><td>{{$n->note}}</td><td><form action="addn/{{$n->id}}" method="post">{{ csrf_field() }}Note: <input type="texte" name="ns"> <input type="submit" name="" value="confirmer"></form></td></tr>
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



{{--affecter enseignement--}}
<?php
try {   $i= $prof; $i=$module ?>

<table >
    <thead>
    <tr><th>Module</th><th>Professeur</th><th>Assuré/non-Assuré</th><th>Affecter</th></tr>

    </thead>

    <tbody>
    @foreach ($module as $m)
        <tr><td>{{$m->nom}}</td><td>@foreach($prof as $p) @if(($m->idm)==($p->id)) {{$p->nom}} {{$p->prenom}} @endif @endforeach</td><td>@if(($m->idm)=='0') Assuré @else non-Assuré @endif</td><td><form action="addaffectation/{{$m->id}}" method="post">{{ csrf_field() }} <input type="texte" name="aa"> <input type="submit" name="" value="affecter"></form></td></tr>
    @endforeach
    </tbody>
</table>
</div>
<?php
} catch (Exception $e) {}?>




{{--affecter resp--}}
<?php
try {   $i= $variable;  ?>

<table >
    <thead>
    <tr><th>Professeur</th><th>Affecter</th></tr>

    </thead>

    <tbody>
    @foreach ($prof as $p)
        <tr><td>{{$p->nom}} {{$p->prenom}}</td><td><a href="addaffectationresp/{{$p->id}}">affecter</a></td></tr>
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

<table >
    <thead>
    <tr><th>Semestre</th><th>Module</th><th>VH</th><th>Coordonnateur</th><th>Specialité</th><th>Grade</th><th>Modifier</th></tr>

    </thead>

    <tbody>
    @foreach ($descriptif as $d)
        <tr><td>{{$d->semestre}}</td><td>{{$d->module}}</td><td>{{$d->VH}}</td><td>{{$d->coordonnateur}}</td><td>{{$d->specialite}}</td><td>{{$d->grade}}</td><td><a href="editdes/{{$d->id}}">modifier</a> </td></tr>
        {{--        <tr><td>{{$p->nom}} {{$p->prenom}}</td><td><form action="addaffectationresp/{{$p->id}}" method="post">{{ csrf_field() }}<input type="submit" name="" value="affecter"></form></td></tr>--}}

    @endforeach
    </tbody>
</table>

</div>
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

</body>
</html>