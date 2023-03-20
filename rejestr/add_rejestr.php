<?php
	include('../connect.php');
	$danee = $_POST['dane'].$_POST['dane1'].$_POST['dane2'];
	$a = explode("|", $danee);
	if($a{'0'}) {$id = '`id`,'; $a['0'] = "'".$a['0']."',";}
	else{ $id = ''; $a{'0'} = '';}
	$zapytanie_db = "INSERT INTO `rejestr` (".$id."`zgloszenie`, `zalatwienie`, `nazwa`, `rodzaj`, `typ`, `fabryczny`, `zglaszajacy`, `uzytkownik`, `naprawa`, `serwis`, `zlecenie`, `uszkodzenie`, `status`, `zwrot`, `dojazd`, `praca`, `czesci`, `materialy`, `wysylka`, `faktura`, `karta`, `sprzedaz`, `kupujacy`, `osoba`, `telefon`, `adres`, `czesci_wys`, `czesci_adr`, `inne`, `wystawil`, `co_uszkodzone`)	VALUES (".$a['0']."'".$a['1']."','".$a['2']."','".$a['3']."','".$a['4']."','".$a['5']."','".$a['6']."','".$a['7']."','".$a['8']."','".$a['9']."','".$a['10']."','".$a['11']."','".$a['12']."','".$a['13']."','".$a['14']."','".$a['15']."','".$a['16']."','".$a['17']."','".$a['18']."','".$a['19']."','".$a['20']."','".$a['21']."','".$a['22']."','".$a['23']."','".$a['24']."','".$a['25']."','".$a['26']."','".$a['27']."','".$a['28']."','".$a['29']."','".$a['30']."','".$a['31']."')";
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