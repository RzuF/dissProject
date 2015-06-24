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
	<link rel="stylesheet" type="text/css" href="template/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="template/css/style.css">
</head>
<body>
    <?php include_once("nav.html"); ?>
    <div class="container note-size">
    	<div class="space"></div>

    	<div class="box13">
    		<!-- Note description -->
    		<div class="note-informations">
				<div class="row note-title">
					<div class="col-lg-8 col-xs-8">
						<div class="note-title-title">Testowy tytuł</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-8 col-xs-8">
						<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
					</div>
				</div>
			</div>
			<!-- Note image -->
			<img src="getImage.php?id=1" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
					<a href="#" class="action-button shadow animate green"><i class="fa fa-plus"></i></a>
  					<a href="#" class="action-button shadow animate red"><i class="fa fa-minus"></i></a>
  					<div class="note-rank-rank">+43</div>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="box14">
    		<!-- Note description -->
    		<div class="note-informations">
				<div class="row note-title">
					<div class="col-lg-8 col-xs-8">
						<div class="note-title-title">Testowy tytuł</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-8 col-xs-8">
						<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
					</div>
				</div>
			</div>
			<!-- Note image -->
			<img src="getImage.php?id=1" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
					<a href="#" class="action-button shadow animate green"><i class="fa fa-plus"></i></a>
  					<a href="#" class="action-button shadow animate red"><i class="fa fa-minus"></i></a>
  					<div class="note-rank-rank">+43</div>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
    		<!-- Note description -->
    		<div class="note-informations">
				<div class="row note-title">
					<div class="col-lg-8 col-xs-8">
						<div class="note-title-title">Testowy tytuł</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-8 col-xs-8">
						<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
					</div>
					<div class="col-lg-4 col-xs-4">
						<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
					</div>
				</div>
			</div>
			<!-- Note image -->
			<img src="getImage.php?id=3" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
					<a href="#" class="action-button shadow animate green"><i class="fa fa-plus"></i></a>
  					<a href="#" class="action-button shadow animate red"><i class="fa fa-minus"></i></a>
  					<div class="note-rank-rank">+43</div>
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
    <script src="template/js/rank.js"></script>
</body>
</html>