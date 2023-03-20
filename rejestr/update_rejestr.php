<?php
	include('../connect.php');
	
	$danee = $_POST['dane'].$_POST['dane1'].$_POST['dane2'];

	$a = explode("|", $danee);

	$zapytanie_db = "UPDATE `rejestr` SET `id`='".$a['0']."',`zgloszenie`='".$a['1']."',`zalatwienie`='".$a['2']."',`nazwa`='".$a['3']."',`rodzaj`='".$a['4']."',`typ`='".$a['5']."',`fabryczny`='".$a['6']."',`zglaszajacy`='".$a['7']."',`uzytkownik`='".$a['8']."',`naprawa`='".$a['9']."',`serwis`='".$a['10']."',`zlecenie`='".$a['11']."',`uszkodzenie`='".$a['12']."',`status`='".$a['13']."',`zwrot`='".$a['14']."',`dojazd`='".$a['15']."',`praca`='".$a['16']."',`czesci`='".$a['17']."',`materialy`='".$a['18']."',`wysylka`='".$a['19']."',`faktura`='".$a['20']."',`karta`='".$a['21']."',`sprzedaz`='".$a['22']."',`kupujacy`='".$a['23']."',`osoba`='".$a['24']."',`telefon`='".$a['25']."',`adres`='".$a['26']."',`czesci_wys`='".$a['27']."',`czesci_adr`='".$a['28']."',`inne`='".$a['29']."',`wystawil`='".$a['30']."',`co_uszkodzone`='".$a['31']."' WHERE `id`='".$a['0']."'";

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
				echo('tabela/dane'.$dane);
			else
				echo "OK";
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
?>