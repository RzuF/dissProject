<?php
session_start();
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="pl" ng-app="dissApp">
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
<body ng-controller="sessionCtrl">
    <?php include_once("nav.html"); ?>
    <div ng-view>
  		<!-- This DIV loads templates depending upon route. -->
  	</div>

    <?php include_once("resources.html"); ?>
    <script src="resources/js/dissApp.js"></script>
</body>
</html>
