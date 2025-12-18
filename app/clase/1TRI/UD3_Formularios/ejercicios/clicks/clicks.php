<?php
$clicks=0;
if (isset($_POST['submit'])) {
    $clicks=$_POST['clicks'];
    $clicks++;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Has realizado <?=$clicks?> clicks</h1>
<fieldset style="background: antiquewhite;width:70%;margin:10%">
    <legend>Contador de clicks</legend>
    <form action="clicks.php" method="POST">
        <input type="hidden" name="clicks" value="<?=$clicks?>" id="">
        <input type="submit" value="click" name="submit">
    </form>
</fieldset>

</body>
</html>