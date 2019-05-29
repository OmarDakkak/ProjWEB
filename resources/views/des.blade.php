<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form action="/envoyerdesc/{{$id}}" method="post">
    {{csrf_field() }}
    Module:</br><input type="text" name="m" value="<?php echo"$Module"; ?>"></br>
    VH:</br><input type="text" name="v" value="<?php echo"$VH"; ?>"></br>
    Coordonnateur:</br><input type="text" name="c" value="<?php echo"$Coordonnateur"; ?>"></br>
    Specialité:</br><input type="text" name="s" value="<?php echo"$Specialite"; ?>"></br>
    Grade:</br><input type="text" name="g" value="<?php echo"$Grade"; ?>"></br>
    </br>
    <input type="submit" value="confirmer">
</form>
</body>
</html>
<?php ?>
