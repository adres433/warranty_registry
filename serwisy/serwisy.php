<?php
	include('../connect.php');
	
	if($_POST['co'] != 'usun')
		$a = explode("|", $_POST['dane']);
	
	if($_POST['co'] == 'dodaj')
	{
		$zapytanie_db = "INSERT INTO `serwisy` (`firma`, `nip`, `nazwisko`, `telefon`, `email`, `adres`, `kod`, `wojewodztwo`, `zakres`, `zlecenia`, `certyfikat`, `data_cert`)	VALUES ('".$a['0']."','".$a['1']."','".$a['2']."','".$a['3']."','".$a['4']."','".$a['5']."','".$a['6']."','".$a['7']."','".$a['8']."','".$a['9']."','".$a['10']."','".$a['11']."')";
	}
	if($_POST['co'] == 'zmien')
	{
		$zapytanie_db = "UPDATE `serwisy` SET `firma`='".$a['1']."',`nip`='".$a['2']."',`nazwisko`='".$a['3']."',`telefon`='".$a['4']."',`email`='".$a['5']."',`wojewodztwo`='".$a['8']."',`kod`='".$a['7']."',`adres`='".$a['6']."',`zakres`='".$a['9']."',`zlecenia`='".$a['10']."',`certyfikat`='".$a['11']."',`data_cert`='".$a['12']."' WHERE `id`='".$a['0']."'";
	}
	if($_POST['co'] == 'usun')
		$zapytanie_db = "DELETE FROM `serwisy` WHERE `id`='".$_POST['dane']."'";
		
	if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
		echo('polaczenie');
	else
	{
		mysql_query('SET NAMES utf8');
		if(!mysql_select_db($baza))
			echo('baza');
		else
		{
			if(!$dane = mysql_query($zapytanie_db))
				echo('tabela/dane');
			else
				echo "OK";
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
		?>