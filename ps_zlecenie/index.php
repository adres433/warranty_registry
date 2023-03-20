<?php

require_once('../pdf/mpdf.php');
require_once('../connect.php');
date_default_timezone_set('CET');

$data = date("d.m.Y");
$usterka = nl2br($_POST['usterka']);
$rok = date("Y");
$adres = nl2br($_POST['adres']);
$adres = explode("\n", $adres);
$adres['0'] = "&nbsp;1. ".$adres['0'];
$adres['1'] = "&nbsp;2. ".$adres['1'];
$adres['2'] = "&nbsp;&nbsp;&nbsp;&nbsp;".$adres['2'];
$adres = implode("\n", $adres);
if($_POST['rodzaj'] == '0' || $_POST['rodzaj'] == '2')
{$skraplacz = "<b style='font-size: 3mm;'>W przypadku zabrudzenia skraplacza i uszkodzonej sprężarki naprawa będzie realizowana jako pogwarancyjna. Poinformować o fakcie klienta. Zrobic dokumentacje zdjęciową zabrudzonego skraplacza.</b>";}
else
	$skraplacz = '';

$dane5 = NULL;
if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
	echo('polaczenie');
else
{
	mysql_query('SET NAMES utf8');
	if(!mysql_select_db($baza))
		echo('baza');
	else
	{
		if(!$dane5 = mysql_query("SELECT * FROM `serwisy` WHERE id='".$_POST['serwis']."'"))
			echo('tabela/dane');
	}
	if(!mysql_close($sql_conn))
		echo('zamkniecie');
}
$dane5 = mysql_fetch_array($dane5);

$dane_html = <<<EOT
<html>
	<style>
	*
	{
		margin: 0;
        page-break-after: always;
		page-break-inside: always;
	}
	@page
    {
	    height:297mm;
		width:210mm;
	    page-break-after: always;
		margin: 10mm 10mm 10mm 10mm;
		font-size: 15px;
    }	
	body
	{
		width: 100%;
		margin: 0;
	}
	</style>
	<body>
		<div style='width: 190mm; background: none; height: 277mm;'>
			<div style='text-align: left;'>
				DORA - METAL Sp. z o.o.<br/>
				64-700 Czarnków ul. Chodzieska 27<br/>
				tel 067 / 2552042<br/>
				fax 067 / 2552515<br/>
				email: serwis@dora-metal.pl<br/>
			</div>
			<table style='width: 100%;'>
				<tr>
				<td style='width: 350px;'>
					<img src='images/logo.png'/>
				</td>
					<td>
						ADRESAT<br/>
						{$dane5['nazwisko']} 
						{$dane5['firma']}<br/>
						{$dane5['adres']}<br/>
						{$dane5['kod']}<br/>
						email: {$dane5['email']}<br/>
						Tel. {$dane5['telefon']}<br/>
					</td>
				</tr>
				<tr>
					<td colspan='2' style='text-align: center; font-size: 20px;'>
						<b>ZLECENIE NAPRAWY {$_POST['zlec']} / $rok</b>
					</td>
				</tr>
			</table>
			<br/>
			<table style='width: 100%;'>
				<tr>
					<td style='text-align: center; width: 50%; border: solid .7px black; font-size: 10px;'>
						DANE IDENTYFIKACYJNE SPRZĘTU
					</td>
					<td style='text-align: center; border: solid .7px black; font-size: 10px;'>
						DANE KLIENTA
					</td>
				</tr>
				<tr style="text-align: left; vertical-align: middle;">
					<td style='border: solid .7px black; font-size: 3mm;'>
						&nbsp;<br/>&nbsp;1. Producent<br/>
						&nbsp;2. Nazwa i typ urządzenia<br/>
						&nbsp;3. Numer fabryczny urządzenia<br/>
					</td>
					<td style='border: solid .7px black; font-size: 3mm;'>
						&nbsp;<br/>&nbsp;1. Użytkownik<br/>
						&nbsp;2. ulica, miejscowość<br/>
						&nbsp;3. Osoba kontaktowa<br/>
						&nbsp;4. Telefon kontaktowy<br/>&nbsp;
					</td>
				</tr>
				</tr>
				<tr style="text-align: left; vertical-align: middle;">
					<td style='border: solid .7px black; padding-left: 3mm;'>
						&nbsp;<br/>&nbsp;1. DORA - METAL Sp. z o.o.<br/>
						&nbsp;2. {$_POST['typ']}<br/>
						&nbsp;3. {$_POST['fabryczny']}<br/>
					</td>
					<td style='border: solid .7px black; padding-left: 3mm;'>
						$adres <br/>
						&nbsp;3. {$_POST['kont']}<br/>
						&nbsp;4. {$_POST['tel']}<br/>&nbsp;
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td style='text-align: center; width: 50%; border: solid .7px black; font-size: 10px;'>
						Data przekazania do wykonania
					</td>
					<td style='text-align: center; border: solid .7px black; font-size: 10px;'>
						Opis uszkodzenia
					</td>
				</tr>
				<tr>
					<td style='border: solid .7px black; text-align: center; vertical-align: middle;'>
						$data
					</td>
					<td style='border: solid .7px black;text-align: center; vertical-align: middle;'>
						$usterka<br/><br/>
						$skraplacz
					</td>
				</tr>
			</table>
			<br/><br/>
			<p style='text-align: center; font-size: 3mm;'>
			WAŻNE ! Oczekuję informacji tel. / fax o przeprowadzonej naprawie lub diagnozie, wg umowy do 48 godzin. Proszę o dokładny opis naprawy<br/><br/>
			<b>Ponadto proszę o telefoniczne powiadomienie mnie o terminie, w jakim naprawa zostanie wykonana!!!</b>
			</p>
			<br/><br/>
			<table style='width: 100%;'>
				<tr>
					<td style="text-align: left">
						Czarnków, dn. $data
					</td>
					<td style="text-align: center">
					Podpis zleceniodawcy<br/>
					{$_POST['podpis']}
					</td>
				</tr>
			 </table>
				<div id="footer" style='padding-bottom: 5mm;'>
					<table>
						<tr><td style='text-align: center; font-size: 3mm;'><B>UWAGA ! Zlecenie bez odczytanego i zapisanego nr fabrycznego sprzętu nie będą rozliczane! rozliczenie faktur tylko z załączoną kopią zlecenia i podpisanym potwierdzeniem wykonania usługi na protokole naprawy.</b></td></tr>
					</table>
				</div>
		</div>
	</body>
</html>
EOT;

 
$mpdf=new mPDF('utf-8','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
$mpdf->ignore_invalid_utf8 = true;
$mpdf->SetTitle("Zlecenie nr ".$_POST['zlec']);
$mpdf->SetAuthor($_POST['podpis']);
 
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
 
$mpdf->WriteHTML($dane_html);
         
file_put_contents('zlecenie.pdf', $mpdf->Output('zlecenie.pdf', 'S'));
//echo $dane_html;

//$mpdf->Output();
?>