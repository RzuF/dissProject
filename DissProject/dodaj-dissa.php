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

    <div class="add-note">
    	<div class="page-header">
        <h1>Dodaj dissa:</h1>
    	</div>
    	<div class="alert alert-info" role="alert">Gdy dodajesz dissa będąc zajerestrowanym masz możliwość podlądu jego ocen i komentarzy. Te kilka z wielu możliwości zajerestrowanych użytkowników. Jeśli chcesz dowiedzieć się więcej <b><a href="#" class="alert-link">kliknij.</a></b></div>

    	<form action='add.php' method='post' id='add'>
    		<div class="form-group">
            	<label for="word" class="control-label">Tytuł:</label>
            	<input type="text" id="word" class="form-control" name="dissName" id="dissName">
            </div>
            <div class="form-group">
            	<label for="word" class="control-label">Żródło:</label>
            	<input type="text" class="form-control">
            </div>
            <div class="form-group">
	            <label for="word" class="control-label">Tagi:</label>
	            <input type="text" class="form-control">
	        </div>
	        <div class="form-group">
	            <label for="mainText" class="control-label" name="dissText" id="dissText">Tekst:</label>
	            <textarea class="form-control"></textarea>
	        </div>
	        <div class="form-group">
	        	<button type="submit" name"submit" id="submit" class="form-control btn btn-default">Dodaj</button>
	        </div>
        </form>
	</div> <!-- END NOTE -->
    <?php include_once("resources.html"); ?>
</body>
</html>