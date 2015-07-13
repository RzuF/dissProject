<?php

include_once('config.php');

session_start();

try 
{
	$sqlcon = new PDO(DSN.':host='.HOST.';dbname='.DB, USER, PASS);

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
	
	if($request->commentText == "")
	{
		echo "ERROR: Pole tekst nie mo�e by� puste\n";
		$uploadOk = false;
	}
	
	if ($uploadOk)
	{
		try
		{
			$sqlcon->query("INSERT INTO `".PREFIX."_comments`(`id`, `text`, `author`, `date`, `note`, `author_ip`) VALUES ('', '".htmlentities($request->dissText)."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '".$request->id."', '".$_SERVER['REMOTE_ADDR']."')");
			$l_id = $sqlcon->lastInsertId();
				
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
		try
		{
			$sqlcon->query("DELETE FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'");
		
			echo "OK:";
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
	try
	{
		if($req = $sqlcon->query("SELECT `plus`, `minus` FROM `".PREFIX."_comments` WHERE `id` = '".$request->id."'"))
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
						$sqlcon->query("UPDATE `".PREFIX."_comments` SET `plus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` + 1 WHERE `id` = '".$request->id."'");
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
						$sqlcon->query("UPDATE `".PREFIX."_comments` SET `minus` = '".implode(";",array($req['plus'],$_SERVER['REMOTE_ADDR']))."' , `difference` = `difference` - 1 WHERE `id` = '".$request->id."'");
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


mysql_close($sqlcon);

?>