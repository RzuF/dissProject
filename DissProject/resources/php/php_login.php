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
				
				$idreq = mysql_query("UPDATE ".PREFIX."_users SET visits = visits + 1 WHERE id = ".$req['id']);

				echo 'OK';
			}
			else echo 'ERROR: Hasło nieprawidłowe.';
		}
		else echo 'ERROR: Brak takiego loginu w bazie.';
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
			elseif($req['active'] == 0) {echo "ERROR: Konto juz zosta³o aktywowane";}
		}
		else echo "ERROR: B³êdny kod aktywacyjny";
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
            <h3><a href="'.ADRES.'/login.php?active='.$req['aid'].'">Kliknij tutaj</a> aby aktywowaÆ’Ã¡ swoje konto.</h3>
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

if($request->request == "session")
	echo $json_response = json_encode($_SESSION);

/*
 * What you have to send in data:
 *
 * $request = 'session';
 *
 * What I send back:
 *
 * JSON encoded array
 */

if($request->request == "register")
{
	$idreq = mysql_query("SELECT `login` FROM `".PREFIX."_users` WHERE `login` = '".$request->login."'"); // Zapytanie do bazy czy istnieje taki login
	if(!$idreq) echo "Error: ".mysql_error();
	if($request->password != $request->password2)
		echo "ERROR: Hasła do siebie nie pasują";
	elseif($req = mysql_fetch_assoc($idreq))
		echo "ERROR: Login jest już zajęty";
	elseif(!(strpos($request->email, '@') !== FALSE))
		echo "ERROR: Błędny adres email";
	elseif($request->login == "" || $request->password == "")
		echo "ERROR: Hasło/Login nie mogą być puste";
	elseif($resp == null || !$resp->success)
		echo "ERROR: Nieprawidłowy token";
	else{
	
		$uppercase = preg_match('@[A-Z]@', $request->password);
		$lowercase = preg_match('@[a-z]@', $request->password);
		$number    = preg_match('@[0-9]@', $request->password);
		if(!$uppercase || !$lowercase || !$number || strlen($request->password) < 8)
			echo "ERROR: Hasło musi mieć conajmniej jedną wielką litere, jedną małą litere, jedną cyfrę i więcej niż 7 znaków";
		else
		{
			$aid = time(); // Pobranie ciągu cyfr, które posłużą nam za link aktywacyjny
			$name = isset($request->name) ? htmlentities($request->name) : "";
			$city = isset($request->city) ? htmlentities($request->city) : "";
			$age = isset($request->age) ? $request->age : "";
			$description = isset($request->description) ? htmlentities($request->description) : "";
			$sex = isset($request->sex) ? $request->sex : 0;
	
			$idreq = mysql_query("INSERT INTO `".PREFIX."_users`(`id`, `login`, `password`, `data`, `email`, `state`, `aid`, `ranga`, `name`, `age`, `city`, `description`, `sex`) 
					VALUES ('', '".htmlentities($request->login)."', '".$request->password."', '".date('Y-m-d H:i:s')."', '".htmlentities($request->email)."', '1', '".$aid."', '0', '$name', '$age', '$city', '$description', '$sex')");
	
	
			if(!$idreq) echo "Error: ".mysql_error();
			else
			{
				$tresc = // Treść emaila z aktywacją
				'<html><head><title>Aktywacja konta</title></head>
                    <body>
                    <p>Witaj '.$request->login.'!</p>
                    <h3><a href="'.ADRES.'/login.php?active='.$aid.'">Kliknij tutaj</a> aby aktywować swoje konto.</h3>
                    </body></html>';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($request->email, 'Aktywacja Konta', $tresc, $headers);
				
				echo "OK";
			}
		}
	}
}

/*
 * What you have to send in data:
 *
 * $request = 'register';
 * $login;
 * $password;
 * $password2;
 * $email;
 * $resp -> Token from Google!
 * 
 * Optional:
 * $name;
 * $age;
 * $city;
 * $description;
 * $sex -> 0 - not set; 1 - female; 2 - male; 
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "userInfo")
{
	$idreq = mysql_query("SELECT login, name, age, city, description, image, sex FROM ".PREFIX."_users WHERE id = ".$request->id); // Zapytanie do bazy czy istnieje taki login
	if(!$idreq) echo "Error: ".mysql_error();
	else 
	{
		$arr = array();
		
		while($req = mysql_fetch_assoc($idreq))
		{
			$arr[] = $req;
		}
		
		echo $json_response = json_encode($arr);
	}
}

/*
 * What you have to send in data:
 *
 * $request = 'userInfo';
 * $id;
 *
 * What I send back:
 *
 * JSON encoded array
 */

if($request->request == "changeData")
{
		if(isset($request->password))
		{
			$idreq = mysql_query("SELECT password FROM ".PREFIX."_users WHERE id = ".$request->id);
			if(!$idreq) echo "Error: ".mysql_error();
			else
			{
				if($req = mysql_fetch_assoc($idreq))
				{
					if($request->password == $req['password'])
					{
						
						if($request->newPassword == $request->newPassword2)
						{
							$idreq = mysql_query("UPDATE ".PREFIX."_users SET password = '".$request->newPassword."', name = '".$request->name."', age = '".$request->age."', city = '".$request->city."', description = '".$request->description."', sex = '".$request->sex."' WHERE id = ".$request->id);
							if(!$idreq) echo "Error: ".mysql_error();
							else echo "OK";
						}
						else echo "ERROR: Hasła nie pasują do siebie";
					}
					else echo "ERROR: Podane hasło jest nieprawidłowe";
				}
				else echo "ERROR: Brak użytkownika o takim ID";
			}
		}
		else
		{
			$idreq = mysql_query("UPDATE ".PREFIX."_users SET name = '".$request->name."', age = '".$request->age."', city = '".$request->city."', description = '".$request->description."', sex = '".$request->sex."' WHERE id = ".$request->id);
			if(!$idreq) echo "Error: ".mysql_error();
			else echo "OK";
		}
}

mysql_close($sqlcon);

?>
