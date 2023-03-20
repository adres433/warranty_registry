<?php
include('../connect.php');
	$dane = NULL;
	if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
		echo('polaczenie');
	else
	{
		if(!mysql_select_db($baza))
			echo('baza');
		else
		{
			mysql_query('SET NAMES utf8');
			if(!$dane = mysql_query("SELECT * FROM `serwisy` WHERE id=".$_POST['id']))
				echo('tabela/dane');
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
	$dane1 = mysql_fetch_row($dane);
	echo $dane1['0'].'|'.$dane1['1'].'|'.$dane1['2'].'|'.$dane1['3'].'|'.$dane1['4'].'|'.$dane1['5'].'|'.$dane1['6'].'|'.$dane1['7'].'|'.$dane1['8'].'|'.$dane1['9'].'|'.$dane1['10'].'|'.$dane1['11'].'|'.$dane1['12'];

?>		