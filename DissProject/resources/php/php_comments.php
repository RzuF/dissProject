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
	
	if($request->commentText == "")
	{
		echo "ERROR: Pole tekst nie mo�e by� puste\n";
		$uploadOk = false;
	}
	
	if ($uploadOk)
	{
		$idreq = mysql_query("INSERT INTO `".PREFIX."_comments`(`id`, `text`, `author`, `date`, `note`, `author_ip`) VALUES ('', '".htmlentities($request->dissText)."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '".$request->id."', '".$_SERVER['REMOTE_ADDR']."')");
		$l_id = mysql_insert_id();
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK: $l_id";		
	}		
}

/*
 * What you have to send in data:
 *
 * $request = 'add';
 * $id; (note ID)
 *
 * What I send back:
 *
 * 'OK: ID' if was successful & ID inserted item
 * 'ERROR:' if was not
 * 		+ error description
 */

if($request->request == "addAnon")
{
	// In future!
}

/*
 * What you have to send in data:
 *
 * $request = 'addAnon';
 * $id; (note ID)
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
		$idreq = mysql_query("DELETE FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'");
		if(!$idreq) echo 'Error!'.mysql_error();
		else echo "OK";
	}
	else echo "ERROR: Nie masz takich uprawnie�";
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

if($request->request == "rate")
{
	$idreq = mysql_query("SELECT `plus`, `minus` FROM `".PREFIX."_notes` WHERE `id` = '".$request->id."'");
	if(!$idreq) echo "Error: ".mysql_error();
	else
	{
		if($req = mysql_fetch_assoc($idreq))
		{
			$userAdded = FALSE;
			foreach(explode(";", $req['plus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;
			foreach(explode(";", $req['minus']) as $i) if($i == $_SERVER['REMOTE_ADDR']) $userAdded = TRUE;

			if(!$userAdded)
			{
				if($request->type == "plus")
				{
					$idreq = mysql_query("UPDATE `".PREFIX."_comments` SET `plus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` + 1 WHERE `id` = '".$request->id."'");
					if(!$idreq) $text .= "Error: ".mysql_error();
					else echo "OK";
				}
				elseif($request->type == "minus")
				{
					$idreq = mysql_query("UPDATE `".PREFIX."_comments` SET `minus` = '".implode(";",array($req['minus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` - 1 WHERE `id` = '".$request->id."'");
					if(!$idreq) $text .= "Error: ".mysql_error();
					else echo "OK";
				}
			}
			else
			{
				echo "ERROR: Ju� oceni�e� ten diss";
			}
		}
		else
		{
			echo "ERROR: Brak dissa o takim ID";
		}
	}
	die();
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