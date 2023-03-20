<?php
include('../connect.php');
date_default_timezone_set("CET");

@mysql_connect($serwer.":".$port, $login, $haslo);
@mysql_select_db($baza);
$z_bazy = @mysql_query("SELECT * FROM `rejestr` ORDER BY `id`");

$dane = <<<EOT
Nr PG; Data zgłoszenia reklamacji; Data załatwienia reklamacji; Czas realizacji; Nazwa urządzenia; Rodzaj urządzenia; Typ urządzenia; Nr fabryczny; Zgłaszający; Użytkownik; Rodzaj naprawy; Serwis; Nr zlecenia; Rodzaj uszkodzenia; Status reklamacji; Zwrot części; Koszt dojazdu; Koszt pracy; Koszt części; Koszt materiałów pomocniczych; Koszt wysyłki części; Koszty razem; Nr faktury; Nr karty gwarancyjnej; Data sprzedaży; Kupujący; Osoba do kontaktu; Telefon; Adres naprawy; Części zamienne; Adres do wysyłki; Inne zalecenia;
EOT;

$dane .= PHP_EOL;
while($a = @mysql_fetch_row($z_bazy))
{
	$i=0;
	while($i < count($a))
	{
			$dane .= <<<EOT
			{$a[$i]};
EOT;

	if($i == 2)
	{
		$dane .= round((strtotime($a[$i]) - strtotime($a[$i-1]))/(60*60*24));
		$dane .= "; ";
	}
	else if($i == 19)
	{
		$dane .= $a[$i]+$a[$i-1]+$a[$i-2]+$a[$i-3]+$a[$i-4];
		$dane .= "; ";
	}
		++$i;
	}
	$dane .= PHP_EOL;

}

//echo $dane;
$data = date("Y");
$dane= mb_convert_encoding($dane, 'UTF-8', 'ISO-8859-1'); 
//$dane = iconv("ISO-8859-1", "cp1250", $dane);
file_put_contents('rejestr_reklamacji_urzadzen.csv', $dane);
//@mysql_query("TRUNCATE rejestr");
?>