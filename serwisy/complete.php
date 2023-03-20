<?php
include('../connect.php');
$dane = NULL;
$dane1 = NULL;
if(!isset($_GET['term']) || $_GET['term'] == '' || $_GET['term'] == '001')
{
			if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
				echo('polaczenie');
			else
			{
				if(!mysql_select_db($baza))
					echo('baza');
				else
				{
					mysql_query('SET NAMES utf8');
					if(!$dane = mysql_query("SELECT * FROM `serwisy`"))
						echo('tabela/dane');
					else
						$dane1 = mysql_query("SELECT MAX(id) FROM `serwisy`");
				}
				if(!mysql_close($sql_conn))
					echo('zamkniecie');
			}
}
else
{
			if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
				echo('polaczenie');
			else
			{
				if(!mysql_select_db($baza))
					echo('baza');
				else
				{
					mysql_query('SET NAMES utf8');
					if(!$dane = mysql_query("SELECT * FROM `serwisy` WHERE `firma` LIKE '%".$_GET['term']."%'"))
						echo('tabela/dane');
					else
						$dane1 = mysql_query("SELECT MAX(id) FROM `serwisy` WHERE `firma` LIKE '%".$_GET['term']."%'");
				}
				if(!mysql_close($sql_conn))
					echo('zamkniecie');
			}
}
			$dane1 = mysql_fetch_array($dane1)['0'];
			echo "[";
while($row = mysql_fetch_array($dane))
{
	$order = array("\r\n", "\n", "\r");
	$str = str_replace($order, '', $row['firma']);
	echo "{";
	echo "\"value\" : \"".$str."\", ";
	echo "\"id\" : \"".$row['id']."\"";
	if($dane1 == $row['id']) echo "}"; else echo "},";
}
echo "]";
?>