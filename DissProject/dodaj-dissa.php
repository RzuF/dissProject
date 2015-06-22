<?php
session_start();
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<title>DissProject</title>
	<link rel="stylesheet" type="text/css" href="template/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="template/css/style.css">
</head>
<body>
    <?php include_once("nav.html"); ?>
    <form action='add.php' method='post' id='add'>
        Tytu≥: <input type="text" name="dissName" id="dissName"></br>
        Tekst: <textarea type="text" name="dissText" id="dissText"></textarea></br>
        èrÛd≥o (opcjonalnie): <input type="text" name="dissSource" id="dissSource"></br>
        <input type='submit' value='Dodaj' name='submit' id='submit'>
    </form>
    <?php include_once("resources.html"); ?>
</body>
</html>