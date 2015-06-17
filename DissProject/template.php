<?php

include_once('config.php');

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Błąd '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Błąd '.mysql_error();

session_start();

if($_COOKIE['logged'])
{
	//$idreq = mysql_query(rsql('login', 'lol_users', 'md5rem\''.$_COOKIE['logged'].'\''));
	$idreq = mysql_query('SELECT `login`, `id`, `active` FROM `'.PREFIX.'_users` WHERE `md5rem` LIKE \'%'.$_COOKIE['logged'].'%\'');
	if(!$idreq) echo "Error: ".mysql_error();
	if($req = mysql_fetch_assoc($idreq))
	{
		$_SESSION['logged'] = 1;
		$_SESSION['login'] = $req['login'];
		$_SESSION['id'] = $req['id'];
		$_SESSION['active'] = $req['active'];

		//$_SESSION['agree'] = 1;
	}
}

if($_GET['agree'] == "Potwierdzam")
{
	setcookie('agree','1', time()*2);
	$_COOKIE['agree'] = '1';
}

?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="RzuF" content="Autor strony" />
	<title>Dupeczki.org - grzeczne miejsce dla niegrzecznych dziewczynek :></title>
	<link rel="stylesheet" type="text/css" href="style.css" /> 
    <link rel="icon" href="favicon.ico"/>
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    if(FB == 1) echo '<meta property="fb:admins" content="'.FB_ID.'"/>';
    elseif(FB == 2) echo '<meta property="fb:app_id" content="'.FB_ID.'"/>';
    ?>
    
    <script>
function add(id) {       
//document.getElementById(id).innerHTML = "Test";

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if(xmlhttp.responseText == "OK") {
                
                var myI = document.getElementById("div_"+id).innerHTML;
                myI++;
                document.getElementById("div_"+id).innerHTML = myI;
                }
                
                //else alert("Już głosowałeś!");
                }
            }
        
        xmlhttp.open("GET","view.php?addJS="+id,true);
        xmlhttp.send();    
        
}
</script>
    
</head>

<body>
<div class="all">
<div id="container">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

    <div id="logo">  
        <?php echo '<a href='.ADRES.'>' ?><div class="banner"></div></a>
        <div id="fb_like_top"><?php echo '<div class="fb-like" data-href="https://www.facebook.com/www.dupeczki.org" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div>' ?></div>
        <div id="login">
		    <?php
            if($_SESSION['logged'] == 1)
            {
                echo 'Witaj '.$_SESSION['login'].'!<br><br>';
                //echo '<a href=add.php>Kliknij tutaj</a> by dodać post<br>';
                //echo '<a href=unchecked.php>Poczekalnia</a><br><br>';
                echo '<a href="user.php?id='.$_SESSION['id'].'">Pokaż</a> mój profil<br>';
                echo '<a href="user.php?do=edit">Edytuj</a> swój profil<br><br>';
                if($_SESSION['active'] > 3) echo '<a href="admin.php">Panel admina</a><br><br>';
                echo '<a href=login.php?out=1>Wyloguj się</a>';
            }
            else
            {
                if($_SESSION['page'] != "login.php")
                {
                    echo "<form action=\"login.php\" method=\"post\" id='login'>
					    <input type=\"text\" name=\"login\" id=\"login\" placeholder='Login'>
					    <input type=\"password\" name=\"psswd\" id=\"psswd\" placeholder='Hasło'><br>
					    <input type=\"checkbox\" name=\"rem\" id=\"rem\" value=1> <span id='r_me'>Zapamiętaj mnie</span>
					    <input type=\"hidden\" name=\"go\" value=\"1\">
					    <input type=\"submit\" name=\"sumbit\" id=\"submit\" value=\"Zaloguj\">        
					    </form>
                        <center>Nie masz konta?<br>
                        <a href=reg.php>Zarejestruj się!</a></center>";
                }
            }
            ?>
        </div>
        <ul id="menu">
          <li><?php $tmp = explode('.', $_SESSION['page']); if($tmp[0] == "index" || $tmp[0] == "unchecked" || $tmp[0] == "top10") echo '<a href="'.$tmp[0].'.php?cat=2">' ; else echo '<a href="index.php?cat=2">' ;?><img src="male.png" id="male"/></a></li>
          <li><?php $tmp = explode('.', $_SESSION['page']); if($tmp[0] == "index" || $tmp[0] == "unchecked" || $tmp[0] == "top10") echo '<a href="'.$tmp[0].'.php?cat=1">' ; else echo '<a href="index.php?cat=1">' ;?><img src="female.png" id="female"/></a></li>
          <li><a href="top10.php">Top 10</a></li>
          <?php if($_SESSION['logged'] == 1) echo '<li><a href="add.php">Dodaj</a></li>' ?>
          <li class="last"><a href="unchecked.php">Poczekalnia</a></li>
        </ul>
    </div>

	<div id="ad_top">
	<?php include('ad1.php'); ?>
	</div>
    
    <div id="main">
	    <div id="left" class="sidebar">
	    <?php include('ad2.php'); ?>
	    </div>
    
        <div id="content" class="content">
	    <?php
	    if($_COOKIE['agree'] == '1') echo $text;
        else
        {
            echo '<div id="post"><center>
                 Aby móc przeglądać treści zawarte na tej stronie musisz mieć 18 lat.<br>Dodatkowo wykorzystujemy pliki cookies oraz inne podobne technologie aby nasz serwis lepiej spełniał Państwa oczekiwania. Można zablokować zapisywanie cookies, zmieniając ustawienia przeglądarki.<br>
                 Kliknij w poniższy przycisk, by potwierdzić swój wiek i to, że zapoznałeś się z zasadami Cookies.<br>
                 <form action="'.$_SESSION['page'].'" method=get><input type=submit name=agree value="Potwierdzam"></form>
                 </center>
                 </div>';
        }        
        
        mysql_close($sqlcon);
	    ?>
	    </div>

	    <div id="right" class="sidebar">
	    <?php include('ad3.php'); ?>
	    </div>	    
    </div>
    </div>
    
    <div id="footer">
    <div id="f_container">
		<div class=sidebar id="fb"><div class="fb-like-box" data-href="https://www.facebook.com/www.dupeczki.org" data-colorscheme="dark" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" data-width="600" id="fb-likebox"></div></div>
        <div id="bottom_menu" class=sidebar>
        <ul>
        <li><a href="regulamin.php">Regulamin</a></li>
        <li><a href="faq.php">FAQ</a></li>
        <li class=last ><a href="polityka.php">Polityka</a></li>
        </ul>
        </div>
    </div>
    <div id="fAD"><?php include_once('bottomAD.php'); ?></div><br/><br/>
    <center><span id="rzuf">Site script by <a href="http://www.rzuf.ovh">RzuF</a></span></center>
    </div>
    
</div>
</body>