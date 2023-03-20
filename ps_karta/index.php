<?php
date_default_timezone_set('CET');
include("../pdf/mpdf.php");
include("../connect.php");
$dane = NULL;
if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
	echo('polaczenie');
else
	{
		mysql_query('SET NAMES utf8');
		if(!mysql_select_db($baza))
			echo('baza');
		else
		{
			if(!$dane = mysql_query("SELECT DISTINCT `zlecenia`, `firma` FROM `serwisy` WHERE `id`='".$_POST['serwis']."'"))
				echo('tabela/dane');
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
$dane = mysql_fetch_array($dane);

$gwarancja;
$serwis;
$zlecenie ='';
$czesci =nl2br($_POST['czesci']);
$inne =nl2br($_POST['inne']);
$wysylka =nl2br($_POST['wysylka']);
$usterka =nl2br($_POST['usterka']);
$adres =nl2br($_POST['adres']);
$kupujacy =nl2br($_POST['kupujacy']);
$data = date("d.m.Y");
$rok = Date('Y');

if($_POST['serwis'] != '1' && $_POST['serwis'] != '2' && $_POST['zlec'] != '0' && $dane['zlecenia'] == '1')
	{
		$zlecenie .= 'Zlecenie nr ';
		$zlecenie .= $_POST['zlec'];
	}
else
	$zlecenie = '----------';
if($_POST['serwis'] == '1')
	$serwis = 'Serwis Dora Metal';
else if($_POST['serwis'] == '2')
	$serwis = 'Wysyłka częsci';
else
	$serwis = 'Serwis zewnętrzny: <br/>'.$dane['firma'];

if($dane['zlecenia'] == '0')
	$serwis = $_POST['serzlec'];
$rok = date("Y");
if($_POST['gw'] == '0')
	$gwarancja = 'GWARANCYJNA';
else
	$gwarancja = 'POGWARANCYJNA';
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
        }
		td.naglowki
		{
			font-size: 10px; 
			text-align: center; 
			width: 25%; 
			margin: 0;
			border: .7px solid black;
			border-bottom: .3px dashed black;
		}
		td.dane
		{
			font-size: 15px; 
			text-align: center; 
			margin: 0;
			border: .7px solid black;
			width: 25%;
			border-top: none;
		}
		table
		{
			border-spacing:0px;
            border-collapse: collapse;
			width: 100%;
		}
	</style>

	<body style='width: 100%; margin: 0; padding: 0;'>
		<div style='margin: 0mm 0mm; width: 180mm'>
			<table id='seg1' style='border: 0px;'>
				<tr>
					<td rowspan='3'>
						<img src='images/logo.png'/>
					</td>
					<td style='font-size: 30px; padding-left: 30px;'>
						<b>KARTA NAPRAWY NR {$_POST['nr_karty']} / {$rok}</b><!--  -->
					</td>
				</tr>
				<tr>
					<td style='font-size: 10px;' colspan='2'>
						Nazwa wyrobu, typ:
					</td>
				</tr>
				<tr>
					<td style='font-size: 15px; text-align: center;' colspan='2'>
						<b style=' border-bottom: .8px dashed black;'>{$_POST['wyrob']}</b>	<!-- {$_POST['wyrob']} -->
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td class='naglowki'>
						Nr fabryczny
					</td>
					<td class='naglowki'>
						Nr faktury VAT
					</td>
					<td class='naglowki'>
						Nr karty gwarancyjnej
					</td>
					<td class='naglowki'>
						Data sprzedaży
					</td>
				</tr>
				<tr>
					<td class='dane'>
						<b>{$_POST['fabryczny']}</b>
					</td>
					<td class='dane'>
						<b>{$_POST['faktura']}</b>
					</td>
					<td class='dane'>
						<b>{$_POST['gwarancja']}</b>
					</td>
					<td class='dane'>
						<b>{$_POST['data']}</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Kupujący
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='4' style='height: 15mm;'>
						<b style='font-size: 3mm;'>$kupujacy</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Status naprawy
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='4'>
						<b>$gwarancja</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Miejsce naprawy
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black;'>
						Osoba kontaktowa / tel.
					</td>
					<td class='dane' colspan='3' style='border: dashed .3px black; border-right: solid .7px black; border-top: none;'>
						<b>{$_POST['kontakt']}</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-bottom: .7px solid black; border-left: solid .7px black;'>
						Adres
					</td>
					<td class='dane' colspan='3' style='border: dashed .3px black; border-bottom: .7px solid black; height: 25mm; border-right: solid .7px black;'>
						<b>$adres</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Opis usterki
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='4' style='height: 25mm;'>
						<b>$usterka</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Serwis
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='3' style='border-right: none;'>
						<b>$serwis</b>
					</td>
					<td class='dane' colspan='1' style='border-left: dashed .3px black;'>
						<b>$zlecenie</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='3' style='border-right: none;'>
						Części zamienne
					</td>
					<td class='naglowki' colspan='1' style='border-left: dashed .3px black;'>
						Wysłać do:</b>
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='3' style='width: 70%; text-align: left;'>
						<b style='font-size: 3mm;'>$czesci</b>
					</td>
					<td class='dane' colspan='1' style='width: 30%;'>
						<b style='font-size: 3mm;'>$wysylka</b>
					</td>
				</tr>
				<tr>
					<td class='naglowki' colspan='4'>
						Inne zalecenia
					</td>
				</tr>
				<tr>
					<td class='dane' colspan='4' style='height: 15mm;'>
						<b>$inne</b>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black; width: 5mm;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; width: 15mm; font-size: 10px;'>
						Imię i nazwisko
					</td>
					<td class='naglowki' style='border: dashed .3px black; width: 5mm'>
						Data
					</td>
					<td class='naglowki' style='border: dashed .3px black; width: 15mm'>
						Podpis
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-right: solid .7px black; width: 140mm'>
						Uwagi
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black; height: 10mm;'>
						Wstawił
					</td>
					<td class='dane' style='border: dashed .3px black;'>
						<b>{$_POST['podpis']}</b>
					</td>
					<td class='dane' style='border: dashed .3px black;'>
						<b>$data</b>
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-right: solid .7px black;'>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black; height: 10mm;'>
						Zatwierdził
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-right: solid .7px black;'>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td colspan='5' class='naglowki'  style='border: none; border-left: solid .7px black; border-right: solid .7px black;'>
						Przebieg realizacji
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black; height: 10mm;'>
						Wysyłka części
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-right: solid .7px black;'>
						&nbsp;
					</td>
				</tr>
				<tr>
					<td class='naglowki' style='border: dashed .3px black; border-left: solid .7px black; border-bottom: solid .7px black; height: 10mm;'>
						Wysyłka części
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-bottom: solid .7px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-bottom: solid .7px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-bottom: solid .7px black;'>
						&nbsp;
					</td>
					<td class='naglowki' style='border: dashed .3px black; border-right: solid .7px black; border-bottom: solid .7px black;'>
						&nbsp;
					</td>
				</tr>
				<tr>
			</table>

			<htmlpagefooter name="footer">
				<div id="footer" style='padding-bottom: 5mm'>
					<table>
						<tr><td>KF Nr do Pj-7.2-03/MS</td></tr>
					</table>
				</div>
			</htmlpagefooter>
			<sethtmlpagefooter name="footer" value="on" />
		</div>
	</body>
</html>
EOT;

 
$mpdf=new mPDF('utf-8','A4','','' , 0 , 0 , 0 , 0 , 0 , 0);
$mpdf->ignore_invalid_utf8 = true;
$mpdf->SetTitle("Karta naprawy nr ".$_POST['nr_karty']);
$mpdf->SetAuthor($_POST['podpis']);
 
$mpdf->SetDisplayMode('fullpage');
 
$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
 
$mpdf->WriteHTML($dane_html);
         
file_put_contents('karta.pdf', $mpdf->Output('karta.pdf', 'S'));
//echo $dane_html;

//$mpdf->Output();

?>