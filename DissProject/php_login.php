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
			else echo 'ERROR: Password not valid!';
		}
		else echo 'ERROR: There is no such a login i DB!';
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

?>