<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);


if($request->request == "add")
{
	$uploadOk = true;
	
	if($request->dissName == "")
	{
		echo "ERROR: Pole tytuł nie może być puste";
		$uploadOk = false;
	}
	
	if($request->dissText == "")
	{
		echo "ERROR: Pole tekst nie może być puste";
		$uploadOk = false;
	}
	
	$idreq = mysql_query("SELECT id FROM ".PREFIX."_notes WHERE text = '".$request->dissText."'");
	if(!$idreq) echo 'Error!'.mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			echo "ERROR: Taki diss juz istnieje";
			$uploadOk = false;
		}
	}
	
	$idreq = mysql_query("SELECT last_action FROM ".PREFIX."_users WHERE id = ".$_SESSION['id']);
	if(!$idreq) echo 'Error!'.mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			$format = 'Y-m-d H:i:s';
			$date = DateTime::createFromFormat($format, $req['last_action']);
			$dateNow = new DateTime();
			if($date->diff($dateNow)->format("%i") < 1)
			{
				echo "ERROR: Musisz poczekać ".$date->diff($dateNow)->format("%s")." sekund zanim będziesz mógł dodac kolejnego dissa";
				$uploadOk = false;
			}
		}
	}
	
	if ($uploadOk)
	{
		$idreq = mysql_query("INSERT INTO `".PREFIX."_notes`(`id`, `title`, `text`, `author`, `date`, `state`, `tags`) VALUES ('', '".htmlentities($request->dissName)."', '".$request->dissText."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '0', '".$request->dissTags."')"); // Put 'diss' into DB
		$l_id = mysql_insert_id();
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK: $l_id";		
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
		$idreq = mysql_query("DELETE FROM `".PREFIX."_notes` WHERE `id` = '".$request->id."'");
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK";
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
		$idreq = mysql_query("UPDATE `".PREFIX."_notes` SET `state` = '3' WHERE `id` = '".$request->id."'");
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK";
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
		$idreq = mysql_query("UPDATE `".PREFIX."_notes` SET `state` = '1' WHERE `id` = '".$request->id."'");
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK";
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
	$idreq = mysql_query("SELECT a.title, a.difference, a.date, b.login, a.tags FROM ".PREFIX."_notes a LEFT JOIN ".PREFIX."_users b ON a.author = b.id WHERE a.id = "  . $request->id);
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		$req = mysql_fetch_assoc($idreq);
		$arr[] = $req;
		echo $json_response = json_encode($arr);
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
	$idreq = mysql_query("SELECT `plus`, `minus` FROM `".PREFIX."_notes` WHERE `id` = '".$request->id."'");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		//echo "debug#1";
		if($req = mysql_fetch_assoc($idreq))
		{
			//echo "debug#2";
			$userAdded = FALSE;
			foreach(explode(";", $req['plus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;
			foreach(explode(";", $req['minus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;
	
			if(!$userAdded)
			{
				//echo "debug#3";
				if($request->type == "plus")
				{
					//echo "debug#4a";
					$idreq = mysql_query("UPDATE `".PREFIX."_notes` SET `plus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` + 1 WHERE `id` = '".$request->id."'");
					if(!$idreq) echo "Error: ".mysql_error();
					else echo "plus";
				}
				elseif($request->type == "minus")
				{
					//echo "debug#4b";
					$idreq = mysql_query("UPDATE `".PREFIX."_notes` SET `minus` = '".implode(";",array($req['minus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` - 1 WHERE `id` = '".$request->id."'");
					if(!$idreq) echo "Error: ".mysql_error();
					else echo "minus";
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
	//die();
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

mysql_close($sqlcon);

?>
