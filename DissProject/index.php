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
<body ng-controller="globalCtrl">
    <?php include_once("nav.html"); ?>
	<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" ng-if="session.ban > -1">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  		<strong>Uwaga!</strong> Dostałeś bana od USER. Kategoria bana to CATEGORY. Opis: DESCRIPTION.
		Nie możesz teraz komentować ani dodawać nowych dissów.
	</div>
    <div ng-view></div>
    <?php include_once("resources.html"); ?>

	<!-- Config -->
	<script src="resources/js/dissApp.js"></script>
	<!-- Controllers -->
	<script src="resources/js/controllers/globalCtrl.js"></script>
	<script src="resources/js/controllers/notesDAO.js"></script>
	<script src="resources/js/controllers/logOutCtrl.js"></script>
	<script src="resources/js/controllers/notesCommandsCtrl.js"></script>
	<script src="resources/js/controllers/addNewDissCtrl.js"></script>
	<script src="resources/js/controllers/showNoteCtrl.js"></script>
	<script src="resources/js/controllers/logInCtrl.js"></script>
	<script src="resources/js/controllers/registerCtrl.js"></script>
	<script src="resources/js/controllers/activationCtrl.js"></script>
	<script src="resources/js/controllers/showUserCtrl.js"></script>
	<!-- DAO -->
	<script src="resources/js/DAO/noteDAO.js"></script>
	<script src="resources/js/DAO/notesDAO.js"></script>
	<script src="resources/js/DAO/userDAO.js"></script>

</body>
</html>
