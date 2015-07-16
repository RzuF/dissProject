<?php

include_once('config.php');
include_once('functions.php');

session_start();

/*$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();*/

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


if($request->request == "add")
{
	$uploadOk = true;
	
	//echo $_SESSION['id'];
	
	echo "#1";
	if($request->dissName == "")
	{
		echo "ERROR: Pole tytuł nie może być puste";
		$uploadOk = false;
		die();
	}
	
	echo "#2";
	if($request->dissText == "")
	{
		echo "ERROR: Pole tekst nie może być puste";
		$uploadOk = false;
		die();
	}
	
	try 
	{
		echo "#3";
		if($req = $sqlcon->query("SELECT id FROM ".PREFIX."_notes WHERE text = '".$request->dissText."'")->fetch())
		{
			echo "ERROR: Taki diss juz istnieje";
			$uploadOk = false;
			die();
		}
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	try 
	{
		echo "#4";
		if($req = $sqlcon->query("SELECT last_action FROM ".PREFIX."_users WHERE id = ".$_SESSION['id'])->fetch());
		{
			$format = 'Y-m-d H:i:s';
			$date = DateTime::createFromFormat($format, $req['last_action']);
			$dateNow = new DateTime();
			echo "#5";
			if($date->diff($dateNow)->format("%i") < 1)
			{
				echo "ERROR: Musisz poczekać ".(60 - $date->diff($dateNow)->format("%s"))." sekund zanim będziesz mógł dodac kolejnego dissa";
				$uploadOk = false;
				die();
			}
		}			
	}
	catch (PDOException $e)
	{
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	
	echo $uploadOk;
	
	if ($uploadOk)
	{
		try 
		{
			//echo "INSERT INTO `".PREFIX."_notes`(`id`, `title`, `text`, `author`, `date`, `state`, `tags`) VALUES ('', '".htmlentities($request->dissName)."', '".$request->dissText."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '0', '".$request->dissTags."')";
			echo "#6";
			$sqlcon->query("INSERT INTO ".PREFIX."_notes(title, text, author, date, state, tags) VALUES ('".htmlentities($request->dissName)."', '".$request->dissText."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '4', '".$request->dissTags."')"); // Put 'diss' into DB
			$l_id = $sqlcon->lastInsertId();
			echo "#7";
			//createImage($request->dissText, $l_id);
			
			$sqlcon->query("UPDATE ".PREFIX."_users SET last_action = '".date('Y-m-d H:i:s')."' WHERE id = ".$_SESSION['id']);
			$sqlcon->query("UPDATE ".PREFIX."_notes SET state = 0 WHERE id = $l_id");
			
			echo "OK: $l_id";
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
 * $request = 'add';
 * $dissName;
 * $dissText;
 * $dissTags;
 *
 * What I send back:
 *
 * 'OK: ID' if was successful & ID inserted item
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "delete")
{
	if($_SESSION['state'] > 2)
	{
		try
		{
			$sqlcon->query("DELETE FROM `".PREFIX."_notes` WHERE `id` = '".$request->id."'");
				
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
 * $request = 'delete';
 * $id;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "move2main")
{
	if($_SESSION['state'] > 2)
	{
		try
		{
			$sqlcon->query("UPDATE `".PREFIX."_notes` SET `state` = '3' WHERE `id` = '".$request->id."'");
		
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
 * $request = 'move2main';
 * $id;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "move2mainFAST")
{
	if($_SESSION['state'] > 2)
	{
		try
		{
			$sqlcon->query("UPDATE `".PREFIX."_notes` SET `state` = '1' WHERE `id` = '".$request->id."'");
		
			echo "OK";
		}
		catch (PDOException $e)
		{
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	else echo "ERROR: Nie masz takich uprawnie�";
}

/*
 * What you have to send in data:
 *
 * $request = 'move2mainFAST';
 * $id;
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "show")
{
	try
	{
		$req = $sqlcon->query("SELECT a.title, a.difference, a.date, b.login, a.tags, (SELECT COUNT(*) FROM ".PREFIX."_comments c WHERE c.note = a.id) AS comments  FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.id = "  . $request->id)->fetch();
	
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
 * $request = 'show';
 * $id;
 *
 * What I send back:
 *
 * JSON encoded data
 */

if($request->request == "rate")
{
	try
	{
		if($req = $sqlcon->query("SELECT `plus`, `minus` FROM `".PREFIX."_notes` WHERE `id` = '".$request->id."'")->fetch())
		{
			$userAdded = FALSE;
			foreach(explode(";", $req['plus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;
			foreach(explode(";", $req['minus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;
	
			if(!$userAdded)
			{
				if($request->type == "plus")
				{
					try
					{
						$sqlcon->query("UPDATE `".PREFIX."_notes` SET `plus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` + 1 WHERE `id` = '".$request->id."'");
						echo "plus";
					}
					catch (PDOException $e)
					{
						print "Error!: " . $e->getMessage() . "<br/>";
						die();
					}
				}
				elseif($request->type == "minus")
				{
				try
					{
						$sqlcon->query("UPDATE `".PREFIX."_notes` SET `minus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` - 1 WHERE `id` = '".$request->id."'");
						echo "minus";
					}
					catch (PDOException $e)
					{
						print "Error!: " . $e->getMessage() . "<br/>";
						die();
					}
				}
				else echo "ERROR#1";
			}
			else
			{				
				echo "ERROR: Już oceniłeś ten diss";
			}
		}
		else
		{
			echo "ERROR: Brak dissa o takim ID";
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
 * $request = 'rate';
 * $id;
 * $type = 'plus' || $type = 'minus'
 *
 * What I send back:
 *
 * 'OK' if was successful
 * 'ERROR:' if was not
 * 		+ error description
 */

$sqlcon = null;

?>
