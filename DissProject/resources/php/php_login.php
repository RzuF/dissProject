<?php

include_once('config.php');

session_start();

try
{
	$sqlcon = new PDO(DSN, USER, PASS);

}
catch (PDOException $e)
{
	print "Connection Error!: " . $e->getMessage() . "<br/>";
	die();
}

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

/*$request->request = "giveBan";
$request->id = 1;
$request->minutes = 100000000;*/

if($request->request == "login")
{
	try
	{
		if($req = $sqlcon->query("SELECT `password`, `md5rem`, `state`, `id` FROM `".PREFIX."_users` WHERE `login` = '".$request->login."'")->fetch())
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

				$sqlcon->query("UPDATE ".PREFIX."_users SET visits = visits + 1 WHERE id = ".$req['id']);

				echo 'OK';
			}
			else echo 'ERROR: Hasło nieprawidłowe.';
		}
		else echo 'ERROR: Brak takiego loginu w bazie.';
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
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
	try
	{
		if($req = $sqlcon->query("DELETE FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'")->fetch())
		{
			$md5 = str_replace(";;", ';', str_replace($_COOKIE['logged'], '', $req['md5rem']));
		}
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		//die();
	}

	if(($_COOKIE['logged'] != 'not logged') || ($_COOKIE['logged'] != 0)) $sqlcon->query('UPDATE `'.PREFIX.'_users` SET `md5rem` = \''.$md5.'\' WHERE `login` = \''.$_SESSION['login'].'\'');
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
	try
	{
		if($req = $sqlcon->query("DELETE FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'")->fetch())
			{
				if($req['state'] == 1)
				{
					$idreq = mysql_query("UPDATE `".PREFIX."_users` SET `state` ='0', `aid` = NULL WHERE `aid` = '".$request->active."'");
					if(!$idreq) echo "Error: ".mysql_error();
					else echo "OK";

					try
					{
						$sqlcon->query("UPDATE `".PREFIX."_users` SET `state` ='0', `aid` = NULL WHERE `aid` = '".$request->active."'");
						echo "OK";
					}
					catch (PDOException $e)
					{
						print "Error!: " . $e->getMessage() . "<br/>";
						//die();
					}
				}
				elseif($req['active'] == 0) {echo "ERROR: Konto juz zostało aktywowane";}
			}
			else echo "ERROR: Błędny kod aktywacyjny";
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
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
	try
	{
		$req = $sqlcon->query("SELECT `aid`, `email` FROM `".PREFIX."_users` WHERE `login` = '".$_SESSION['login']."'")->fetch();

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
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
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
	try
	{
		if($request->password != $request->password2)
			echo "ERROR: Hasła do siebie nie pasują";
		elseif(!(strpos($request->email, '@') !== FALSE))
			echo "ERROR: Błędny adres email";
		elseif($request->login == "" || $request->password == "")
			echo "ERROR: Hasło/Login nie mogą być puste";
		elseif($resp == null || !$resp->success)
			echo "ERROR: Nieprawidłowy token";
		elseif($req = $sqlcon->query("SELECT `login` FROM `".PREFIX."_users` WHERE `login` = '".$request->login."'")->fetch())
			echo "ERROR: Login jest już zajęty";
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

				try
				{
					$sqlcon->query("INSERT INTO `".PREFIX."_users`(`id`, `login`, `password`, `data`, `email`, `state`, `aid`, `ranga`, `name`, `age`, `city`, `description`, `sex`)
						VALUES ('', '".htmlentities($request->login)."', '".$request->password."', '".date('Y-m-d H:i:s')."', '".htmlentities($request->email)."', '1', '".$aid."', '0', '$name', '$age', '$city', '$description', '$sex')");

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
				catch (PDOException $e)
				{
					print "Error!: " . $e->getMessage() . "<br/>";
					//die();
				}
			}
		}
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
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
	echo "test";
	try
	{
		$req = $sqlcon->query("SELECT a.login, a.name, a.age, a.city, a.description, a.image, a.date AS dateUserJoin, a.sex, b.date, b.time, b.date AS dateBan, d.login AS author FROM (".PREFIX."_users a LEFT OUTER JOIN ".PREFIX."_bans b ON a.ban = b.id) LEFT OUTER JOIN ".PREFIX."_users d ON b.author = d.id WHERE a.id = ".$request->id)->fetch();

		$arr = array();

		$arr[] = $req;
		echo $json_response = json_encode($arr);
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
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
			try
			{
				if($req = $sqlcon->query("SELECT password FROM ".PREFIX."_users WHERE id = ".$request->id)->fetch())
				{
					if($request->password == $req['password'])
					{

						if($request->newPassword == $request->newPassword2)
						{
							try
							{
								$sqlcon->query("UPDATE ".PREFIX."_users SET password = '".$request->newPassword."', name = '".$request->name."', age = '".$request->age."', city = '".$request->city."', description = '".$request->description."', sex = '".$request->sex."' WHERE id = ".$request->id);
								echo "OK";
							}
							catch (PDOException $e)
							{
								print "Error!: " . $e->getMessage() . "<br/>";
								//die();
							}
						}
						else echo "ERROR: Hasła nie pasują do siebie";
					}
					else echo "ERROR: Podane hasło jest nieprawidłowe";
				}
				else echo "ERROR: Brak użytkownika o takim ID";
			}
			catch (PDOException $e)
			{
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
		else
		{
			try
			{
				$sqlcon->query("UPDATE ".PREFIX."_users SET name = '".$request->name."', age = '".$request->age."', city = '".$request->city."', description = '".$request->description."', sex = '".$request->sex."' WHERE id = ".$request->id);
				echo "OK";
			}
			catch (PDOException $e)
			{
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
}

/*
 * What you have to send in data:
 *
 * $request = 'changeData';
 * $name;
 * $age;
 * $city;
 * $description;
 * $sex;
 * All above previously pulled via request userInfo (DO NOT SEND BLANK DATA!) - unless it was blank previously
 *
 * $password;
 * $newPassword;
 * $newPassword2;
 * 3 above if user wants to also change its password, if not do not send password
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "giveBan")
{
	if($_SESSION['state'] > 2)
	{
		try
		{
			$dateNow = new DateTime();
			$dateNow->add(new DateInterval("PT".$request->minutes."M"));
			$sqlcon->query("INSERT INTO ".PREFIX."_bans (id, date, time, description, author, user, category)
					VALUES ('', '".date('Y-m-d H:i:s')."', '".$dateNow->format('Y-m-d H:i:s')."', '".$request->description."', '".$_SESSION['id']."', '".$request->id."', '".$request->category."'");
			$l_id = $sqlcon->lastInsertId();

			$req = $sqlcon->query("SELECT b.time FROM ".PREFIX."_users a LEFT OUTER JOIN ".PREFIX."_bans b ON a.ban = b.id WHERE a.id = ".$request->id)->fetch();

			/*if(DateTime::createFromFormat('Y-m-d H:i:s', $req['time']) < $dateNow) echo "true";
			else "false";*/

			if(($req['time'] == null || DateTime::createFromFormat('Y-m-d H:i:s', $req['time']) < $dateNow) && $l_id != 0) $sqlcon->query("UPDATE ".PREFIX."_users SET ban = $l_id WHERE id = ". $request->id);

			echo "OK";
		}
		catch (PDOException $e)
		{
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	else echo "ERROR: Nie masz takich uprawnień";
}

/*
 * What you have to send in data:
 *
 * $request = 'giveBan';
 * $id;
 * $minutes;
 * $category;
 * $description;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "removeBan")
{
	if($_SESSION['state'] > 2)
	{
		try
		{
			$sqlcon->query("UPDATE ".PREFIX."_users SET ban = NULL WHERE id = ". $request->id);

			echo "OK";
		}
		catch (PDOException $e)
		{
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	else echo "ERROR: Nie masz takich uprawnień";
}

/*
 * What you have to send in data:
 *
 * $request = 'giveBan';
 * $id;
 * $minutes;
 * $category;
 * $description;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

$sqlcon = null;

?>
