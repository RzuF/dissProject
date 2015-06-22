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
    <div class="container note-size">
    	<div class="space"></div>

    	<div class="note">
    		<!-- Note description -->
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
				</div>
				<div class="col-lg-4">
					<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
				</div>
			</div>

			<!-- Note image -->
			<img src="getImage.php?id=1" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
				<div class="input-group">
         			<span class="input-group-btn">
              			<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                			<span class="fa fa-minus"></span>
              			</button>
          			</span>
          			<input type="text" name="quant[2]" class="form-control input-number" value="0" min="0" max="100" disabled>
          			<span class="input-group-btn">
              			<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  	<span class="fa fa-plus"></span>
              			</button>
          			</span>
      			</div>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
    		<!-- Note description -->
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
				</div>
				<div class="col-lg-4">
					<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
				</div>
			</div>

			<!-- Note image -->
			<img src="getImage.php?id=2" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
				<div class="input-group">
         			<span class="input-group-btn">
              			<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                			<span class="fa fa-minus"></span>
              			</button>
          			</span>
          			<input type="text" name="quant[2]" class="form-control input-number" value="0" min="0" max="100" disabled>
          			<span class="input-group-btn">
              			<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  	<span class="fa fa-plus"></span>
              			</button>
          			</span>
      			</div>
			</div>
		</div> <!-- END NOTE -->

		<div class="space"></div>

		<div class="note">
    		<!-- Note description -->
			<div class="row note-title">
				<div class="col-lg-8">
					<div class="note-title-title">Testowy tytuł</div>
				</div>
				<div class="col-lg-4">
					<div class="note-title-comments"><a href="#"><i class="fa fa-comments"></i> 65</a></div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="note-copright"><i class="fa fa-user"></i> Marcin Konieczny</div>
				</div>
				<div class="col-lg-4">
					<div class="note-date"> <i class="fa fa-calendar"></i> 25.06.2015</div>
				</div>
			</div>

			<!-- Note image -->
			<img src="getImage.php?id=3" class="img-responsive img-rounded">

			<!-- Note rank -->
			<div class="note-rank">
				<div class="input-group">
         			<span class="input-group-btn">
              			<button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                			<span class="fa fa-minus"></span>
              			</button>
          			</span>
          			<input type="text" name="quant[2]" class="form-control input-number" value="0" min="0" max="100" disabled>
          			<span class="input-group-btn">
              			<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                  	<span class="fa fa-plus"></span>
              			</button>
          			</span>
      			</div>
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