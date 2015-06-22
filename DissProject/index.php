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
	<link rel="stylesheet" href="template/css/buttons.css">
</head>
<body>
    <?php include_once("nav.html"); ?>
    <div class="container note-size">
    	<div class="space"></div>

    	<div class="note">
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments">65</div>
				</div>
			</div>
			<div class="note-copright">Marcin Konieczny</div>
			<img src="getImage.php?id=3" class="img-responsive img-rounded">
			<div class="note-rank">
				<button class="button button-primary button-circle button-small button-longshadow"><i class="fa fa-plus"></i></button>
				<button class="button button-3d button-box button-small button-jumbo"><i class="fa fa-plus"></i></button>
				<button class="button button-circle button-tiny"><i class="fa fa-plus"></i></button>
				 564 
				<button class="button button-primary button-circle button-small button-longshadow"><i class="fa fa-minus"></i></button>
				<button class="button button-3d button-box button-small button-jumbo"><i class="fa fa-minus"></i></button>
				<button class="button button-circle button-tiny"><i class="fa fa-minus"></i></button>
			</div>

		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments">65</div>
				</div>
			</div>
			<div class="note-copright">Marcin Konieczny</div>
			<img src="getImage.php?id=1" class="img-responsive img-rounded">
			<div class="note-rank">
				<button type="button" class="btn btn-default">+</button>
				564
				<button type="button" class="btn btn-default">-</button>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments">65</div>
				</div>
			</div>
			<div class="note-copright">Marcin Konieczny</div>
			<img src="getImage.php?id=1" class="img-responsive img-rounded">
			<div class="note-rank">
				<button type="button" class="btn btn-default">+</button>
				564
				<button type="button" class="btn btn-default">-</button>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments">65</div>
				</div>
			</div>
			<div class="note-copright">Marcin Konieczny</div>
			<img src="getImage.php?id=1" class="img-responsive img-rounded">
			<div class="note-rank">
				<button type="button" class="btn btn-default">+</button>
				564
				<button type="button" class="btn btn-default">-</button>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div style="notes-pagination">
			<nav>
	  			<ul class="pagination">
	    			<li>
	      				<a href="#" aria-label="Previous">
	        				<span aria-hidden="true">&laquo;</span>
	      				</a>
	    			</li>
				    <li><a href="#">1</a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
	    			<li>
				     	<a href="#" aria-label="Next">
				        	<span aria-hidden="true">&raquo;</span>
				     	</a>
				    </li>
	 			</ul>
			</nav>
		</div>
    </div>

    <?php include_once("resources.html"); ?>
</body>
</html>