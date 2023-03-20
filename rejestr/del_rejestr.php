<?php
	include('../connect.php');
	$dane = NULL;
	$zapytanie_db = "DELETE FROM `rejestr` WHERE `id`='".$_POST['numer']."'";
	if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
		echo('polaczenie');
	else
	{
		if(!mysql_select_db($baza))
			echo('baza');
		else
		{
			mysql_query('SET NAMES utf8');
			if(!$dane = mysql_query($zapytanie_db))
				echo('tabela/dane'.$dane);
			else
				echo "OK";
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
		?>