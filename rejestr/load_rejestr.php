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
			if(!$dane = mysql_query("SELECT * FROM `rejestr` WHERE `id`=".$_POST['id']))
				echo('tabela/dane');
			else
			{
				$dane1 = mysql_fetch_row($dane);
				$dane = mysql_query("SELECT `firma` FROM `serwisy` WHERE `id`='".$dane1['10']."'");
				$dane2 = mysql_fetch_row($dane);
			}
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
	echo $dane1['1'].'|'.$dane1['2'].'|'.$dane1['3'].'|'.$dane1['4'].'|'.$dane1['5'].'|'.$dane1['6'].'|'.$dane1['7'].'|'.$dane1['8'].'|'.$dane1['9'].'|'.$dane2['0'].'|'.$dane1['11'].'|'.$dane1['12'].'|'.$dane1['13'].'|'.$dane1['14'].'|'.$dane1['15'].'|'.$dane1['16'].'|'.$dane1['17'].'|'.$dane1['18'].'|'.$dane1['19'].'|'.$dane1['10'].'|'.$dane1['20'].'|'.$dane1['21'].'|'.$dane1['22'].'|'.$dane1['23'].'|'.$dane1['24'].'|'.$dane1['25'].'|'.$dane1['26'].'|'.$dane1['27'].'|'.$dane1['28'].'|'.$dane1['29'].'|'.$dane1['30'].'|'.$dane1['31'].'|';

?>		