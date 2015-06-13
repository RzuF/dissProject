<?php

include_once('config.php');

session_start();

$sqlcon = mysql_connect(HOST, USER, PASS);
if(!$sqlcon) echo 'Error: '.mysql_error();

$blad = mysql_select_db(DB);
if(!$blad) echo 'Error: '.mysql_error();

if(isset($_POST["submit"]))
{
	if($_POST['dissName'] == "")
	{
		$text .= "<span id='error'>";
		$text .= "B≥πd: Tytu≥ nie moøe byÊ pusty!";
		$text .= "</span>";
		$uploadOk = 0;
	}
	
	if($_POST['dissText'] == "")
	{
		$text .= "<span id='error'>";
		$text .= "B≥πd: Tytu≥ nie moøe byÊ pusty!";
		$text .= "</span>";
		$uploadOk = 0;
	}
	
	if ($uploadOk == 0)
	{
		$text .= "<br><br>
              Diss nie zosta≥ dodany do bazy!";
	}
	
	$idreq = mysql_query("INSERT INTO `".PREFIX."_notes`(`id`, `title`, `source`, `text`, `author`, `date`, `state`) VALUES ('', '".htmlentities($_POST['dissName'])."', '".htmlentities($_POST['dissSource'])."', '".$_POST['dissText']."', '".$_SESSION['id']."', '".date('Y-m-d H:i:s')."', '0')"); // Put 'diss' into DB
	if(!$idreq) echo 'Error!'.mysql_error();
	
	header("Location: ".ADRES."/view.php?id=".$l_id); // Redirect to 'diss'
	$text .= "<span id='uploadSuccess'>Diss dodany pomyslnie!<br><br>Jeøeli nie nastπpi≥o przekierowanie do twojego postu <a href='".ADRES."/view.php?id=".$l_id."'>kliknij tutaj!</a></span>"; // Communicate & hreflink to 'diss'
}

if($_SESSION['logged'])
{
    $text .= 
        "<form action='add.php' method='post' id='add'>
        Tytu≥: <input type=text name=dissName id=dissName></br>
        Tekst: <textarea type=text name=dissText id=dissText></textarea></br>
        èrÛd≥o (opcjonalnie): <input type=text name=dissSource id=dissSource></br>";
    
    if($_SESSION['active'] != 1)
    {
        $text .= 
            "<input type='submit' value='Dodaj' name='submit' id='submit'>
            </form>";
    }
    else
    {
        $text .= 
            "<input type='submit' value='Dodaj' name='submit' id='submit' disabled>
            </form>
            <br><br>";
        $text .= "<span id='error'>";
        $text .= "Tylko aktywowani uøytkownicy mogπ dodawaÊ dissy.";
        $text .= "</span>";
    }
}
else     
{
    $text .= "<span id='error'>";
    $text .= "Tylko zalogowani uøytkownicy mogπ dodawaÊ dissy.";
    $text .= "</span>";
    include_once('login.php');
}

mysql_close($sqlcon);

include_once('template.php');
?>