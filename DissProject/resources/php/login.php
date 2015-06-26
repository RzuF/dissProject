<?php

include_once('config.php');
include_once("nav.php");

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

if($_GET['out'] == 1) // logout
{	
	$_SESSION['logged'] = 0;
	$idreq = mysql_query('SELECT `login`, `md5rem` FROM `'.PREFIX.'_users` WHERE `md5rem` LIKE \'%'.$_COOKIE['logged'].'%\''); // removing md5rem string from DB (for 'remember me' function) 
	if(!$idreq) echo "Error: ".mysql_error();
	if($req = mysql_fetch_assoc($idreq))
	{
		$md5 = str_replace(";;", ';', str_replace($_COOKIE['logged'], '', $req['md5rem']));
	}
	if(($_COOKIE['logged'] != 'not logged') || ($_COOKIE['logged'] != 0)) $idreq = mysql_query('UPDATE `'.PREFIX.'_users` SET `md5rem` = \''.$md5.'\' WHERE `login` = \''.$_SESSION['login'].'\'');
	$_SESSION = array(); // removing session data
	$_COOKIE['logged'] = 'not logged'; // changing cookie
	setcookie('logged','not logged', time()*2);
	session_destroy();  // destroying session
	echo '<script language="javascript"> setTimeout(\'location.href="index.php"\',5); </script>';
}

if($_GET['active'])  // Check if user want to activate account
{
	$idreq = mysql_query("SELECT `state` FROM `".PREFIX."_users` WHERE `aid` = '".$_GET['active']."'"); // Query about state of user with given activation code
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			if($req['state'] == 1)
			{
				$idreq = mysql_query("UPDATE `".PREFIX."_users` SET `state` ='0', `aid` = NULL WHERE `aid` = '".$_GET['active']."'");
				if(!$idreq) echo "Error: ".mysql_error();
				else echo '<span id=\'activeSuccess\'>' . 'Twoje konto zosta≥o aktywowane pomyúlnie.' . '</span>';
			}
			elseif($req['active']==0) {echo '<script language="javascript"> setTimeout(\'location.href="index.php"\',5); </script>';}
			//else echo '<span id=\'error\'>' . 'Twoje konto zosta≥o dezaktywowane.' . '</span>';
		}
		else echo '<span id=\'error\'>' . 'B≥Ídny kod aktywacyjny.' . '</span>';
	}
}

elseif($_POST['go'] == 1) // Check if sb requested logging procedure
{
	$idreq = mysql_query("SELECT `password`, `md5rem`, `state`, `id` FROM `".PREFIX."_users` WHERE `login` = '".$_POST['login']."'");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			//if($req['password'] == md5($_POST['psswd'])) // Using md5; probably in future md5+sha1
			if($req['password'] == $_POST['psswd']) // Temporary for easy testing
			{

				$_SESSION['logged'] = 1;
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['state'] = $req['state'];
				$_SESSION['id'] = $req['id'];
				if($_POST['rem'])
				{
					$md5 = md5(time());
					$md5x = implode(";",array($req['md5rem'],$md5));
					$idreq = mysql_query('UPDATE `'.PREFIX.'_users` SET `md5rem` = \''.$md5x.'\' WHERE `login` = \''.$_POST['login'].'\'');
					setcookie('logged',$md5, time()*2);
				}

				echo '<script language="javascript"> setTimeout(\'location.href="index.php"\',5); </script>';
			}
			else echo '<span id=\'error\'>' . 'Nieprawid≥owe has≥o!' . '</span>';
		}
		else echo '<span id=\'error\'>' . 'Nieprawid≥owy login!' . '</span>';
	}
}

elseif($_SESSION['login'] && $_GET['amail']==1) // check if logged user want to resend activation mail 
{
	$idreq = mysql_query("SELECT `aid`, `email` FROM `".PREFIX."_users` WHERE `login` = '".$_SESSION['login']."'");
	if(!$idreq) echo "Error: ".mysql_error();
	$req = mysql_fetch_assoc($idreq);
	$tresc =
	'<html><head><title>Aktywacja konta</title></head>
            <body>
            <p>Witaj '.$_SESSION['login'].'!</p>
            <h3><a href="'.ADRES.'/login.php?active='.$req['aid'].'">Kliknij tutaj</a> aby aktywowaƒá swoje konto.</h3>
            </body></html>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($req['email'], 'Aktywacja Konta', $tresc, $headers);
	echo '<span id=\'sendSuccess\'>' . 'Link zosta≥ wys≥any ponownie, sprawdü swÛj email aby aktywowaÊ konto.' . '</span>';


}

else
{
	include_once('index.php');
}

/* if(!$_SESSION['logged'])
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
} */

//include_once("index.php");


mysql_close($sqlcon);

//include_once('template.php');

?>