<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if($request->request == "login")
{
	$idreq = mysql_query("SELECT `password`, `md5rem`, `state`, `id` FROM `".PREFIX."_users` WHERE `login` = '".$request->login."'");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			//if($req['password'] == md5($request->password)) // Using md5; probably in future md5+sha1
			if($req['password'] == $request->password) // Temporary for easy testing
			{

				$_SESSION['logged'] = 1;
				$_SESSION['login'] = $request->login;
				$_SESSION['state'] = $req['state'];
				$_SESSION['id'] = $req['id'];
				if($request->rem)
				{
					$md5 = md5(time());
					$md5x = implode(";",array($req['md5rem'],$md5));
					$idreq = mysql_query("UPDATE `".PREFIX."_users` SET `md5rem` = '".$md5x."' WHERE `login` = '".$request->login."'");
					setcookie('logged',$md5, time()*2);
				}

				echo 'OK';
			}
			else echo 'ERROR: Has≥o nieprawid≥owe';
		}
		else echo 'ERROR: Brak takiego loginu w bazie';
	}
}


/*
 * What you have to send in data:
 * 
 * $request = 'login';
 * $password;
 * $login;
 * 
 * What I send back:
 * 
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description 
 */

if($request->request == "logout")
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
	session_destroy();
	
	echo "OK";
}

/*
 * What you have to send in data:
 *
 * $request = 'logout';
 *
 * What I send back:
 *
 * 'OK' if was successful
 */

if($request->request == "active")
{
	$idreq = mysql_query("SELECT `state` FROM `".PREFIX."_users` WHERE `aid` = '".$request->active."'"); // Query about state of user with given activation code
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			if($req['state'] == 1)
			{
				$idreq = mysql_query("UPDATE `".PREFIX."_users` SET `state` ='0', `aid` = NULL WHERE `aid` = '".$request->active."'");
				if(!$idreq) echo "Error: ".mysql_error();
				else echo "OK";
			}
			elseif($req['active'] == 0) {echo "ERROR: Konto juz zosta≥o aktywowane";}
		}
		else echo "ERROR: B≥Ídny kod aktywacyjny";
	}
}

/*
 * What you have to send in data:
 *
 * $request = 'active';
 * $active; (possesed from GET request)
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "resend")
{
	$idreq = mysql_query("SELECT `aid`, `email` FROM `".PREFIX."_users` WHERE `login` = '".$_SESSION['login']."'");
	if(!$idreq) echo "Error: ".mysql_error();
	$req = mysql_fetch_assoc($idreq);
	$tresc =
	'<html><head><title>Aktywacja konta</title></head>
            <body>
            <p>Witaj '.$_SESSION['login'].'!</p>
            <h3><a href="'.ADRES.'/login.php?active='.$req['aid'].'">Kliknij tutaj</a> aby aktywowa∆í√° swoje konto.</h3>
            </body></html>';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($req['email'], 'Aktywacja Konta', $tresc, $headers);
	echo "OK";
}

/*
 * What you have to send in data:
 *
 * $request = 'resend';
 *
 * What I send back:
 *
 * 'OK' if was successful
 */

mysql_close($sqlcon);

?>
