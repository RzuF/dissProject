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
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700italic,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="resources/css/style.css">
	<link rel="stylesheet" type="text/css" href="resources/css/password-validation.css">
</head>
<body ng-app="dissApp">
    <?php include_once("nav.html"); ?>

    <div ng-view>
  		<!-- This DIV loads templates depending upon route. -->
  	</div>

    <?php include_once("resources.html"); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.3/angular-route.min.js"></script> 
    <script src="resources/js/rank.js"></script>
    <script src="resources/js/views/dissApp.js"></script>
</body>
</html>