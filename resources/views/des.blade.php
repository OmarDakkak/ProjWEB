<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/core.js"></script>
    <!-- Compiled and minified CSS Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
        $(document).ready(function() {
            M.updateTextFields();
        });
    </script>
</head>
<body>


    <div class="row">
        <form class="col s12" action="/envoyerdesc/{{$id}}/{{$identite}}/{{$role}}" method="post">
            {{csrf_field() }}
            <div class="row">
                <div class="input-field col s6">
                    <input id="Module" name="m" type="text" value="<?php echo"$Module"; ?>" class="validate">
                    <label for="Module">Module:</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="v" value="<?php echo"$VH"; ?>" id="VH" type="text" class="validate">
                    <label for="VH">VH:</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="c" value="<?php echo"$Coordonnateur"; ?>" id="Cor" class="validate">
                    <label for="Cor">Coordonnateur:</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="s" value="<?php echo"$Specialite"; ?>" id="sp" class="validate">
                    <label for="sp">Specialité:</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="g" value="<?php echo"$Grade"; ?>" id="gr" class="validate">
                    <label for="gr">Grade:</label>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action" style="background-color: #771da6 ">Submit
                    <i class="material-icons right">send</i>
                </button>

            </div>

</body>
</html>
<?php ?>
