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
    <?php include("nav.html"); ?>
    <div class="container">
      <?php if($_SESSION['logged']) 
			echo "hej";
			
			else
			{
				echo
				 "<div id=\"login_form\">
				 <form action=\"login.php\" method=\"post\">
				 <span id=\'login\'>Login:</span> <input type=\"text\" name=\"login\" id=\"login\">
				 <span id=\'psswd\'>Has≥o:</span> <input type=\"password\" name=\"psswd\" id=\"psswd\">
				 <input type=\"checkbox\" name=\"rem\" id=\"rem\" value=1> ZapamiÍtaj mnie
				 <input type=\"hidden\" name=\"go\" value=\"1\">
				 <input type=\"submit\" name=\"sumbit\" id=\"submit\" value=\"Zaloguj\">
				 </form>
				 </div>";
			} ?>
    </div>
    <link href="template/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="template/js/angular.min.js"></script>
	<script src="template/js/bootstrap.min.js"></script>
</body>
</html>