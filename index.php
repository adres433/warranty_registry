<?php

include('connect.php');
date_default_timezone_set('CET');

$zapytanko = "SELECT * FROM `rejestr` ORDER BY `id` DESC";

if(isset($_GET['nazwa'])||isset($_GET['typ'])||isset($_GET['serwis'])||isset($_GET['uszkodzenie'])||isset($_GET['uzytkownik'])||isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
{
	$zapytanko = "SELECT * FROM `rejestr` WHERE ";
	if(isset($_GET['nazwa']))
	{
		$zapytanko .= "`nazwa`='".$_GET['nazwa']."'";
		if(isset($_GET['typ'])||isset($_GET['serwis'])||isset($_GET['uszkodzenie'])||isset($_GET['uzytkownik'])||isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['typ']))
	{
		$zapytanko .= "`typ`='".$_GET['typ']."'";
		if(isset($_GET['serwis'])||isset($_GET['uszkodzenie'])||isset($_GET['uzytkownik'])||isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['serwis']))
	{
		$zapytanko .= "`serwis`='".$_GET['serwis']."'";
		if(isset($_GET['uszkodzenie'])||isset($_GET['uzytkownik'])||isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['uszkodzenie']))
	{
		$zapytanko .= "`uszkodzenie`='".$_GET['uszkodzenie']."'";
		if(isset($_GET['uzytkownik'])||isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['uzytkownik']))
	{
		$zapytanko .= "`uzytkownik` LIKE '%".$_GET['uzytkownik']."%'";
		if(isset($_GET['zlecenie'])||isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['zlecenie']))
	{
		$zapytanko .= "`zlecenie`='".$_GET['zlecenie']."'";
		if(isset($_GET['rodzaj'])||isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['rodzaj']))
	{
		$zapytanko .= "`rodzaj`='".$_GET['rodzaj']."'";
		if(isset($_GET['naprawa'])||isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= ' AND ';
		}
	}
	if(isset($_GET['naprawa']))
	{
		$zapytanko .= "`naprawa`='".$_GET['naprawa']."'";
		if(isset($_GET['status'])||isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= " AND ";
		}
	}
	if(isset($_GET['status']))
	{
		$zapytanko .= "`status`='".$_GET['status']."'";		
		if(isset($_GET['pokaz_data1'])||isset($_GET['usterka']))
		{
			$zapytanko .= " AND ";
		}
	}
	if(isset($_GET['usterka']))
	{
		$zapytanko .= "`co_uszkodzone`='".$_GET['usterka']."'";		
		if(isset($_GET['pokaz_data1']))
		{
			$zapytanko .= " AND ";
		}
	}
	if(isset($_GET['pokaz_data1']))
	{
		 $zapytanko .="`zgloszenie` BETWEEN ".str_replace('-', '', $_GET['pokaz_data1'])." AND ".str_replace('-','',$_GET['pokaz_data2']);
	}
	$zap_2 = $zapytanko .= " ORDER BY `id` DESC";
}

?>
<html>
	<head>
		<title>Dora Metal - Rejestr reklamacji urządzeń</title>
		<script type='text/javascript'>
			var ip_klienta ="<?php echo $_SERVER['REMOTE_ADDR']; ?>";
		</script>
		<script src="jquery-mini.js"></script>
		<script src="jquery-ui.js"></script>
		<link rel="stylesheet" href="style/jquery-ui.css" />
		<link rel="stylesheet" href="style/style.css" type="text/css" />
		<link rel="stylesheet" href="style/style_add.css" type="text/css" />
		<script type="text/javascript" src="scripts.js"></script>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-security-policy-unsafe-inline"/>
		
	</head>
	<body>
		<div id='przyciemnij'>&nbsp;</div>
		<table id='tabela_rejestru' style='border-collapse: collapse;'>
			<tr style='border: solid 2px black;'>
				<th class='kom_rej nr_pg' rowspan='2'>
					Nr.<br/>KN
				</th>
				<th class='kom_rej'>
					Data zgłoszenia reklamacji
				</th>
				<th class='kom_rej czas_real' rowspan='2'>
					Czas<br/>realizacji<br/>[DNI]
				<th class='kom_rej' rowspan='2'>
					Nazwa urządzenia
				</th>
				<th class='kom_rej' rowspan='2'>
					Rodzaj urządzenia
				</th>
				<th class='kom_rej'>
					Typ urządzenia
				</th>
				<th class='kom_rej'>
					Zgłaszający
				</th>
				<th class='kom_rej' rowspan='2'>
					Rodzaj<br/>naprawy
				</th>
				<th class='kom_rej' rowspan='2'>
					Serwis
				</th>
				<th class='kom_rej' rowspan='2'>
					Nr zlecenia
				</th>
				<th class='kom_rej' rowspan='2'>
					Rodzaj uszkodzenia
				</th>
				<th class='kom_rej' rowspan='2'>
					Uszkodzenie (faktyczne)
				</th>
				<th class='kom_rej' rowspan='2'>
					Status reklamacji
				</th>
				<th class='kom_rej' rowspan='2'>
					Zwrot części
				</th>
				<th class='kom_rej'>
					Koszt dojazdu [ZŁ]
				</th>
				<th class='kom_rej'>
					Koszt praca [ZŁ]
				</th>
				<th class='kom_rej'>
					Koszt części [ZŁ]
				</th>
				<th class='kom_rej'>
					Koszt materiałów pom. [ZŁ]
				</th>
				<th class='kom_rej'>
					Koszt wysyłki części [ZŁ]
				</th>
				<th>
					LP.
				</th>
			</tr>
			<tr style='border: solid 2px black;'>
				<th class='kom_rej'>
					Data załatwienia zgłoszenia
				</th>
				<th class='kom_rej'>
					Nr fabryczny
				</th>
				<th class='kom_rej'>
					Użytkownik
				</th>
				<th class='kom_rej' colspan='5'>
					Koszt razem [ZŁ]
				</th>
			</tr>
			<tr style='border: solid 2px black; border-top: none;'>
				<td rowspan='2'>&nbsp;</td>
				<td rowspan='2'>
					<!-- <form action='index.php' method='GET'> -->
					<input type='text' autocomplete='off' id='pokaz_data1' name='pokaz_data1' class='data_cal' size='10' value='<?php if(!isset($_GET['pokaz_data1'])) echo Date('Y-m-d'); else echo $_GET['pokaz_data1'] ?>'/>
					<hr/>
					<input type='text' autocomplete='off' id='pokaz_data2' name='pokaz_data2' class='data_cal' size='10' value='<?php if(!isset($_GET['pokaz_data2'])) echo Date('Y-m-d'); else echo $_GET['pokaz_data2'] ?>'/>
					<a href="javascript:;" onclick="sortowanie_data();">Pokaż</a>
					<!-- <a href="javascript:;" onclick="parentNode.submit();">Pokaż</a> -->
					<!-- </form> -->
				</td>
				<td rowspan='2'>&nbsp;</td>
				<td rowspan='2'>
							<?php
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
										$zapytanko1 = str_replace('*', 'DISTINCT `nazwa`', $zapytanko);
										$zapytanko1 = substr($zapytanko1, 0, -18);
										if(!$dane = mysql_query($zapytanko1))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<select id='sor_nazwa' title='Wyświetl wg nazwy urządzenia'>
							<?php
							
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{	
														$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo);
														mysql_query('SET NAMES utf8');
														if(!mysql_select_db($baza))
															echo('baza');
														$zapytanko2 = str_replace('*', 'COUNT(`nazwa`)', $zapytanko);
														if(strlen($zapytanko) >= 43)
															$zapytanko2 = str_replace(' ORDER BY `id` DESC', ' AND `nazwa` = \''.$b['nazwa'], $zapytanko2)."'";
														else
															$zapytanko2 = str_replace(' ORDER BY `id` DESC', ' WHERE `nazwa` = \''.$b['nazwa'], $zapytanko2)."'";
														//$zapytanko2 = substr($zapytanko2, 0, -18);
														$c = mysql_query($zapytanko2);
														$c = mysql_fetch_array($c);
														echo "<option value='".$b['nazwa']."' onclick='javascript: sortowanie1(\"nazwa\", this.value);'>".$b['nazwa']." - ".$c['0']."</option>";
														mysql_close($sql_conn);
													}
												
							
							?></select>
							<?php
								if(isset($_GET['nazwa']))
									echo "<img src='style/images/x.png' class='sor_del' id='naz_del'/>";
							?>
				</td>
				<td rowspan='2'>
							<input type='text' id='sor_rodzaj'  size='6' title='Wyświetl wg rodzaju urządzenia'></input>
							<?php
								if(isset($_GET['rodzaj']))
									echo "<img src='style/images/x.png' class='sor_del' id='rodzaj_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_rodzaj').autocomplete(
									{
										source: [ {"label":"GRZEWCZE", "value":"g"}, {"label":"CHŁODNICZE", "value":"c"}, {"label":"MEBLE", "value":"m"}, {"label":"GRZEWCZE I CHŁODNICZE", "value":"c g"} ],
										minLength: 1 ,
										select: function(g, gg){ sortowanie(g,gg,'rodzaj');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `typ` FROM `rejestr`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_typ' title='Wyświetl wg typu urządzenia'></input>
							<?php
								if(isset($_GET['typ']))
									echo "<img src='style/images/x.png' class='sor_del' id='typ_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_typ').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{
														$dane1 .= "\"".$b['typ']."\", ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);
													echo $dane3;
												?> ],
										minLength: 2 ,
										select: function(g, gg){ sortowanie(g,gg,'typ');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `uzytkownik` FROM `rejestr`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_uzytkownik' title='Wyświetl wg uzytkownika'></input>
							<?php
								if(isset($_GET['uzytkownik']))
									echo "<img src='style/images/x.png' class='sor_del' id='uzyt_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_uzytkownik').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{											
														$order = array("\r\n", "\n", "\r");
														$dane1 .= "{\"value\":\"".urlencode($b['uzytkownik'])."\", \"label\":\"".str_replace($order, '', $b['uzytkownik'])."\"}, ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);
													echo $dane3;
												?> ],
										minLength: 2,
										select: function(g, gg){ sortowanie(g,gg,'uzytkownik');}
									}
								);
							$('#sor_uzytkownik').keypress(function( event ) 
								{
									if ( event.which == 13 ) 
										{
											sortowanie1('uzytkownik', $('#sor_uzytkownik').val());
										}
								});
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<input type='text' id='sor_naprawa' size='6' title='Wyświetl wg rodzaju naprawy'></input>
							<?php
								if(isset($_GET['naprawa']))
									echo "<img src='style/images/x.png' class='sor_del' id='nap_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_naprawa').autocomplete(
									{
										source: [ {"label":"GWARANCYJNA", "value":"0"}, {"label":"POGWARANCYJNA", "value":"1"} ],
										minLength: 2 ,
										select: function(g, gg){ sortowanie(g,gg,'naprawa');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2' id='sor_ser_dbcl'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `firma`, `id`, `nazwisko` FROM `serwisy`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_serwis' title='Wyświetl wg serwisu'></input>
							<?php
								if(isset($_GET['serwis']))
									echo "<img src='style/images/x.png' class='sor_del' id='ser_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_serwis').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{
														$dane1 .= "{'label':'<b>".$b['nazwisko']."</b> ".nl2br($b['firma'])."', 'value':'".$b['id']."'}, ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);
													echo $dane3;
												?> ],
										minLength: 2 ,
										select: function(g, gg){ sortowanie(g,gg,'serwis');}
									}
								);
							
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `zlecenie` FROM `rejestr`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_zlec' title='Wyświetl wg nr zlecenia'></input>
							<?php
								if(isset($_GET['zlecenie']))
									echo "<img src='style/images/x.png' class='sor_del' id='zlec_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_zlec').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{
														$dane1 .= "\"".$b['zlecenie']."\", ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);
													echo $dane3;
												?> ],
										minLength: 1 ,
										select: function(g, gg){ sortowanie(g,gg,'zlecenie');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `uszkodzenie` FROM `rejestr`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_uszk' title='Wyświetl wg rodzaju uszkodzenia'></input>
							<?php
								if(isset($_GET['uszkodzenie']))
									echo "<img src='style/images/x.png' class='sor_del' id='usz_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_uszk').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{											
														$order = array("\r\n", "\n", "\r");
														$dane1 .= "{\"value\":\"".urlencode($b['uszkodzenie'])."\", \"label\":\"".str_replace($order, '', $b['uszkodzenie'])."\"}, ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);	
													echo $dane3;
												?> ],
										minLength: 1 ,
										select: function(g, gg){ sortowanie(g,gg,'uszkodzenie');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<?php
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
										if(!$dane = mysql_query("SELECT DISTINCT `co_uszkodzone` FROM `rejestr`"))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
							?>
							<input type='text' id='sor_uste' title='Wyświetl wg usterki'></input>
							<?php
								if(isset($_GET['usterka']))
									echo "<img src='style/images/x.png' class='sor_del' id='uste_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_uste').autocomplete(
									{
										source: [ <?php
													$dane1 ='';
													while($b = mysql_fetch_assoc($dane))
													{											
														$order = array("\r\n", "\n", "\r");
														$dane1 .= "{\"value\":\"".urlencode($b['co_uszkodzone'])."\", \"label\":\"".str_replace($order, '', $b['co_uszkodzone'])."\"}, ";
													}
													$dane3 = substr($dane1,0,strlen($dane1)-2);	
													echo $dane3;
												?> ],
										minLength: 1 ,
										select: function(g, gg){ sortowanie(g,gg,'usterka');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>
							<input type='text' id='sor_stat' title='Wyświetl wg statusu reklamacji'></input>
							<?php
								if(isset($_GET['status']))
									echo "<img src='style/images/x.png' class='sor_del' id='stat_del'/>";
							?>
							<script type='text/javascript'>
							$('#sor_stat').autocomplete(
									{
										source: [ {"value":"0", "label":"W REALIZACJI"}, {"value":"1", "label":"WYKONANE"}],
										minLength: 1 ,
										select: function(g, gg){ sortowanie(g,gg,'status');}
									}
								);
							</script>&nbsp;
				</td>
				<td rowspan='2'>&nbsp;</td>
				<td>
							<?php
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
										$zap_query="SELECT SUM(`dojazd`) FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", "SUM(`dojazd`)", $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
				<td>
							<?php
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
										$zap_query="SELECT SUM(`praca`) FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", "SUM(`praca`)", $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
				<td>
							<?php
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
										$zap_query="SELECT SUM(`czesci`) FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", "SUM(`czesci`)", $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
				<td>
							<?php
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
										$zap_query="SELECT SUM(`materialy`) FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", "SUM(`materialy`)", $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
				<td>
							<?php
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
										$zap_query="SELECT SUM(`wysylka`) FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", "SUM(`wysylka`)", $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
				<td rowspan='2'>&nbsp;</td>
			</tr>
			<tr style='border: solid 2px black; border-top: none;'>
				<td colspan='5'>
							<?php
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
										$zap_parts = "SUM(`wysylka`)+SUM(`materialy`)+SUM(`czesci`)+SUM(`praca`)+SUM(`dojazd`)";
										$zap_query="SELECT ".$zap_parts." FROM `rejestr`";
										if(isset($zap_2))
										{
											$zap_query = str_replace("*", $zap_parts, $zap_2);
										}
										if(!$dane = mysql_query($zap_query))
											echo('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										echo('zamkniecie');
								}
								$dane = mysql_result($dane, 0);
								echo "<b style='color: blue;'>".round($dane, 2)."<b/>";
							?>
				</td>
			</tr>
			<!-- 
				SZKIELET DO WSTAWIANIA DANYCH
			-->
		<?php
			$dane = NULL;
			$lp = $ostatni_nr = 0;
			if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
				blad_bazy('polaczenie');
			else
			{
		mysql_query('SET NAMES utf8');
				if(!mysql_select_db($baza))
					blad_bazy('baza');
				else
				{
					if(!$dane = mysql_query($zapytanko))
						blad_bazy('tabela/dane');
					else
						$ostatni_nr = mysql_query("SELECT max(`id`) FROM `rejestr`");
				}
				if(!mysql_close($sql_conn))
					blad_bazy('zamkniecie');
			}

			function blad_bazy($ktory)
			{
				?>
					<div id='bg_alert'>
						<div id='alert'>
							<p class='tresc_alert'>
								Błąd bazy danych - <?php echo $ktory; ?>
							</p>
							<p class='tresc_alert'>
								Przepraszamy wystąpił błąd bazy danych.
							</p>
							<br/>
							<a href='#' onclick="document.getElementById('bg_alert').style.display = 'none'">
								<p id='przycisk_alert'>
								Zamknij
								</p>
							</a>
						</div>
					</div> 
				<?php
			}
			$ostatni_nr = mysql_fetch_array($ostatni_nr);
			$ostatni_nr = $ostatni_nr['0'];
			$ii = 0;
			while($wiersz = mysql_fetch_row($dane))
			{ 
				if ($ii == 1) 
					{
						$kolor_wiersza = "style = 'background: #cfcfcf'";
						--$ii;
					} 
				else 
					{
						$kolor_wiersza = "style = ''";
						++$ii;
					}?>
				<tr <?php echo $kolor_wiersza." id='wid_".$wiersz['0']."'" ?>>
					<td class='kom_rej nr_pg' rowspan='2' title='Nr KN'>
						<?php echo $wiersz['0']; ?>
					</td>
					<td class='kom_rej' title='Data zgłoszenia reklamacji'>
						<?php 
							echo $wiersz['1'];
						?>
					</td> 
					<td class='kom_rej czas_real' rowspan='2' title='Czas realizacji'>
						<?php 
						if($wiersz['13'] == '1')
							echo (round((strtotime($wiersz['2']) - strtotime($wiersz['1']))/(60*60*24))+1); 
						else
							echo (round((strtotime(Date("Y-m-d")) - strtotime($wiersz['1']))/(60*60*24))+1); 
						?>
					</td>
					<td class='kom_rej' rowspan='2' title='Nazwa urządzenia'>
						<?php echo $wiersz['3']; ?>
					</td>
					<td class='kom_rej czas_real' rowspan='2' title='Rodzaj urządzenia'>
						<?php echo $wiersz['4']; ?>
					</td>
					<td class='kom_rej' title='Typ urządzenia'>
						<?php echo $wiersz['5']; ?>
					</td>
					<td class='kom_rej' title='Zgłaszający'>
						<?php echo $wiersz['7']; ?>
					</td>
					<td class='kom_rej czas_real' rowspan='2' title='Rodzaj naprawy'>
						<?php 
							switch($wiersz['9'])
							{
								case 0:
									echo "GW";
									break;
								case 1:
									echo "PGW";
									break;
							}
						?>
					</td>
					<td class='kom_rej' rowspan='2' title='Serwis'>
						<?php
							$dane5 = NULL;
							if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
								blad_bazy('polaczenie');
							else
							{
						mysql_query('SET NAMES utf8');
								if(!mysql_select_db($baza))
									blad_bazy('baza');
								else
								{
									if(!$dane5 = mysql_query("SELECT `firma`, `nazwisko` FROM `serwisy` WHERE id='".$wiersz['10']."'"))
										blad_bazy('tabela/dane');
								}
								if(!mysql_close($sql_conn))
									blad_bazy('zamkniecie');
							}
								$dane5 = mysql_fetch_array($dane5);
								echo $dane5['nazwisko']." ".$dane5['firma'];
						?>
					</td>
					<td class='kom_rej' rowspan='2' title='Nr zlecenia'>
						<?php echo $wiersz['11']; ?>
					</td>
					<td class='kom_rej' rowspan='2' title='Rodzaj uszkodzenia'>
						<?php echo $wiersz['12']; ?>
					</td>
					<td class='kom_rej' rowspan='2' title='Usterka'>
						<?php echo $wiersz['31']; ?>
					</td>
					<td class='kom_rej' rowspan='2' title='Status reklamacji'>
						<?php
							switch($wiersz['13'])
							{
								case 0:
									echo "W REALIZACJI";
									break;
								case 1:
									echo "WYKONANE";
									break;
							}
						?>
					</td>
					<td class='kom_rej' rowspan='2' title='Zwrot części'>
						<?php echo $wiersz['14']; ?>
					</td>
					<td class='kom_rej' title='Koszty dojazdu'>
						<?php echo $wiersz['15']; ?>
					</td>
					<td class='kom_rej' title='Koszty praca'>
						<?php echo $wiersz['16']; ?>
					</td>
					<td class='kom_rej' title='Koszty części'>
						<?php echo $wiersz['17']; ?>
					</td>
					<td class='kom_rej' title='Koszty materiałów pomocniczych'>
						<?php echo $wiersz['18']; ?>
					</td>
					<td class='kom_rej' title='Koszty wysyłki części'>
						<?php echo $wiersz['19']; ?>
					</td>
					<td title='Liczba porządkowa' rowspan='2'>
						<?php echo ++$lp; ?>
					</td>
				</tr>
				<tr <?php echo $kolor_wiersza." id='awid_".$wiersz['0']."'" ?>>
					<td class='kom_rej' title='Data załatwienia reklamacji'>
						<?php 
						if($wiersz['13'] == '1')
							echo $wiersz['2']; 
						else
							echo Date("Y-m-d");
						?>
					</td>
					<td class='kom_rej' title='Nr fabryczny'>
						<?php echo $wiersz['6']; ?>
					</td>
					<td class='kom_rej' title='Użytkownik'>
						<?php echo $wiersz['8']; ?>
					</td>
					<td class='kom_rej' colspan='5' title='Całkowity koszt naprawy'>
						<?php echo($wiersz['15']+$wiersz['16']+$wiersz['17']+$wiersz['18']+$wiersz['19']); ?>
					</td>
				</tr>
				<script>
				var wid_kolor = '';
					$(document).ready
					(
						function()
						{
							$('#wid_'+<?php echo "'".$wiersz['0']."'"; ?>).click
								(
									function()
								{
									$('#b_edytuj').click();
									$('#nr_id').val(<?php echo "'".$wiersz['0']."'"; ?>);
									$('#b_wczytaj').click();									
								}
								).hover
								(
										function ()
										{
												var lll = this.id;
												wid_kolor = $(this).css('background-color');
												$(this).css('background', '#FAFF94');
												if(lll.charAt(0) == 'a')
													lll = lll.substring(1, lll.lenght);
												else
													lll = 'a'+lll;
												$('#'+lll).css('background', '#FAFF94');
										},
										function ()
										{
												var lll = this.id;
												$(this).css('background', wid_kolor);
												if(lll.charAt(0) == 'a')
													lll = lll.substring(1, lll.lenght);
												else
													lll = 'a'+lll;
												$('#'+lll).css('background', wid_kolor);
										}
								);
							$('#awid_'+<?php echo "'".$wiersz['0']."'"; ?>).click
								(
									function()
								{
									edytuj('b_edytuj');
									$('#nr_id').val(<?php echo "'".$wiersz['0']."'"; ?>);
									$('#b_wczytaj').click();									
								}
								).hover
								(
										function ()
										{
												var lll = this.id;
												wid_kolor = $(this).css('background-color');
												$(this).css('background', '#FAFF94');
												if(lll.charAt(0) == 'a')
													lll = lll.substring(1, lll.lenght);
												else
													lll = 'a'+lll;
												$('#'+lll).css('background', '#FAFF94');
										},
										function ()
										{
												var lll = this.id;
												$(this).css('background', wid_kolor);
												if(lll.charAt(0) == 'a')
													lll = lll.substring(1, lll.lenght);
												else
													lll = 'a'+lll;
												$('#'+lll).css('background', wid_kolor);
										}
								);
						}
					);
				</script>
			<?php }
		?>
			</table>

			<div id='menu'>
				<a href='javascript:' id='b_dodaj' onclick='javascript: dodaj(this.id);'><span><img src='style/images/add.png' alt='DODAJ'/></span></a>
				<a href='javascript:' id='b_edytuj' onclick='javascript: edytuj(this.id);'><span><img src='style/images/edit.png'alt='EDYTUJ'/></span></a>
				<a href='javascript:' id='b_usun' onclick='javascript: usun();'><span><img src='style/images/del.png'alt='USUŃ'/></span></a>
				<a href='javascript:' id='b_opcje'><span><img src='style/images/options.png'alt='OPCJE'/></span></a>
				<a href="http://system.dora-metal.pl" id='zamknij'><span><img src='style/images/close.png'alt='ZAMKNIJ'/></span></a>
			</div>
			<div id='menu1'>
			</div>
			<div id='kontener_form'>
				<form id='formularz_rejestru' action='#' onsubmit='javascript: return false'>
					<div id='form_rejestr'>
						<br/>
						REJESTR:<br/>
						<table>
							<tr>
								<th>Nr KN</th>
								<td><input type='text' autocomplete='off' id='nr_id' size='4' value="<?php echo ++$ostatni_nr; ?>"/> / <script type='text/javascript'>document.write(rok.substring(3, 5));</script><button id='b_wczytaj' class='button' >Wczytaj</button><input type='hidden' id='ostatni_nr_id' value='<?php echo --$ostatni_nr; ?>'/></td>
							</tr>
							<tr>
								<th>Data zgłoszenia:</th>
								<td><input type='text' autocomplete='off' id='d_zgl' class='data_cal' size='10' value='<?php echo Date('Y-m-d'); ?>'/>&nbsp;[rrrr-mm-dd]</td>
							</tr>
							<tr>
								<th>Data załatwienia:</th>
								<td><input type='text' autocomplete='off' id='d_zal' class='data_cal' size='10' value='<?php echo Date('Y-m-d'); ?>'/>&nbsp;[rrrr-mm-dd]</td>
							</tr>
							<tr>
								<th>Nazwa urządzenia:</th>
								<td><input type='text' autocomplete='off' id='nazwa'/></td>
							</tr>
								<?php
									$dane2 = NULL;
									if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
										blad_bazy('polaczenie');
									else
									{
										mysql_query('SET NAMES utf8');
										if(!mysql_select_db($baza))
											blad_bazy('baza');
										else
										{
											if(!$dane2 = mysql_query("SELECT DISTINCT `nazwa` FROM `rejestr`"))
												blad_bazy('tabela/dane');
										}
										if(!mysql_close($sql_conn))
											blad_bazy('zamkniecie');
									}
								?>
							<script>
									$('#nazwa').autocomplete(
									{
										source: [ <?php
													$dane3 ='';
													while($b = mysql_fetch_assoc($dane2))
													{
														$dane3 .= "\"".$b['nazwa']."\", ";
													}
													$dane3 = substr($dane3,0,strlen($dane3)-2);
													echo $dane3;
												?> ],
													minLength: 2 
									}
								);
							</script>
							<tr>
								<th>Rodzaj urządzenia:</th>
								<td>
									<select type='text' autocomplete='off' id='rodzaj'>
										<option value='0'>CHŁODNICZE</option>
										<option value='1'>GRZEWCZE</option>
										<option value='2'>GRZEWCZE I CHŁODNICZE</option>
										<option value='3'>MEBLE</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Typ urządzenia:</th>
								<td><input type='text' autocomplete='off' id='typ'/></td>
							</tr>
								<?php
									$dane2 = NULL;
									if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
										blad_bazy('polaczenie');
									else
									{
										mysql_query('SET NAMES utf8');
										if(!mysql_select_db($baza))
											blad_bazy('baza');
										else
										{
											if(!$dane2 = mysql_query("SELECT DISTINCT `typ` FROM `rejestr`"))
												blad_bazy('tabela/dane');
										}
										if(!mysql_close($sql_conn))
											blad_bazy('zamkniecie');
									}
								?>
							<script>
								$('#typ').autocomplete(
									{
										source: [ <?php
													$dane3 ='';
													while($b = mysql_fetch_assoc($dane2))
													{
														$dane3 .= "\"".$b['typ']."\", ";
													}
													$dane3 = substr($dane3,0,strlen($dane3)-2);
													echo $dane3;
												?> ],
										minLength: 3 
									}
								);
							</script>
							<tr>
								<th>Nr fabryczny:</th>
								<td><input type='text' autocomplete='off' id='fabryczny'/></td>
							</tr>
							<tr>
								<th>Zgłaszający:</th>
								<td>
									<input type='text' autocomplete='off' id='zglaszajacy'/>
									<div style='position: fixed;'>
										<div id='przyklady_zglaszajacy' style='z-index: 30;position: absolute;top: 2px; left: 00px; width: auto; background: gray; max-height: 200px; overflow-y: auto;'>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<th>Użytkownik:</th>
								<td class='dlugi_text uzytkownikk'><textarea class='uzytkownikk' id='uzytkownik'></textarea></td>
							</tr
							<tr>
								<th>Rodzaj naprawy:</th>
								<td>
									<select id='naprawa'>
										<option value='0' selected>GWARANCYJNA</option>
										<option value='1'>PO GWARANCYJNA</option>
									</select>
								</td>
							</tr>
							<?php
								$dane = NULL;
								if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
									blad_bazy('polaczenie');
								else
								{
									mysql_query('SET NAMES utf8');
									if(!mysql_select_db($baza))
										blad_bazy('baza');
									else
									{
										if(!$dane = mysql_query("SELECT * FROM `serwisy`"))
											blad_bazy('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										blad_bazy('zamkniecie');
								}
							?>
							<tr>
								<th>Serwis:</th>
								<td>
									<input id='serwis'>
										<!-- <script>
											$('#serwis').autocomplete(
												{
													source: 'serwisy/complete.php',
													minLength: 2,
													select: function(event, ui) {$('#ukryte_id').val(ui.item.id); if(ui.item.id == '1') $('#zlecenie').val('0'); else if(ui.item.id == '2') $('#zlecenie').val('0'); else $('#zlecenie').val($('#zlecenie_aktualne').val()); }
												}
											);
										</script> -->										
										<?php
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
													if(!$dane = mysql_query("SELECT DISTINCT `firma`, `id`, `nazwisko` FROM `serwisy`"))
														echo('tabela/dane');
												}
												if(!mysql_close($sql_conn))
													echo('zamkniecie');
											}
										?>
										<script type='text/javascript'>
										$('#serwis').autocomplete(
												{
													source: [ <?php
																$dane1 ='';
																while($b = mysql_fetch_assoc($dane))
																{
																	$dane1 .= "{'value':'".$b['nazwisko']." ".nl2br($b['firma'])."', 'id':'".$b['id']."'}, ";
																}
																$dane3 = substr($dane1,0,strlen($dane1)-2);
																echo $dane3;
															?> ],
													minLength: 2 ,
													select: function(event, ui) 
																{
																	$('#ukryte_id').val(ui.item.id); 
																	if(ui.item.id == '1') 
																		$('#zlecenie').val('0'); 
																	else if(ui.item.id == '2') 
																		$('#zlecenie').val('0'); 
																	else 
																	{
																		if($('#zlecenie_wczytane').val() != '0' && !($('#b_zapisz').attr('onclick').indexOf('zapisz_wszystko()') != -1))
																			$('#zlecenie').val($('#zlecenie_wczytane').val());
																		else
																			$('#zlecenie').val($('#zlecenie_aktualne').val());
																	}
																}
												}
											);
										</script>
									</input>
									<input type='hidden' id='ukryte_id'></input>
								</td>
							</tr>
							<?php
								$dane = NULL;
								if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
									blad_bazy('polaczenie');
								else
								{
									mysql_query('SET NAMES utf8');
									if(!mysql_select_db($baza))
										blad_bazy('baza');
									else
									{
										if(!$dane = mysql_query("SELECT max(`zlecenie`) FROM `rejestr`"))
											blad_bazy('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										blad_bazy('zamkniecie');

									$dane = mysql_fetch_row($dane);
								}
							?>
							<tr>
								<th>Nr zlecenia:</th>
								<td><input type='text' autocomplete='off' id='zlecenie' value='<?php echo ++$dane['0']; ?>'/><input type='hidden' autocomplete='off' id='zlecenie_aktualne' value='<?php echo $dane['0']; ?>'/><input type='hidden' autocomplete='off' id='zlecenie_wczytane' value=''/></td>
							</tr>
							<tr>
								<th>Rodzaj uszkodzenia:</th>
								<td class='dlugi_text'><textarea id='uszkodzenie'></textarea></td>
							</tr>
								<?php
									$dane = NULL;
									if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
										blad_bazy('polaczenie');
									else
									{
										mysql_query('SET NAMES utf8');
										if(!mysql_select_db($baza))
											blad_bazy('baza');
										else
										{
											if(!$dane2 = mysql_query("SELECT DISTINCT `uszkodzenie` FROM `rejestr`"))
												blad_bazy('tabela/dane');
										}
										if(!mysql_close($sql_conn))
											blad_bazy('zamkniecie');
									}
								?>
							<script>
								$('#uszkodzenie').autocomplete(
									{
										source: [ <?php
													$dane3 ='';
													while($b = mysql_fetch_assoc($dane2))
													{											
														$order = array("\r\n", "\n", "\r");
														$dane3 .= "{\"value\":\"".str_replace($order, '', $b['uszkodzenie'])."\", \"label\":\"".str_replace($order, '', $b['uszkodzenie'])."\"}, ";
													}
													$dane3 = substr($dane3,0,strlen($dane3)-2);
													echo $dane3;
												?> ],
										minLength: 3,
									}
								);
							</script>
							<tr>
								<th>Status reklamacji:</th>
								<td>
									<select id='status'>
										<option value='0' >W REALIZACJI</option>
										<option value='1'selected='selected'>WYKONANE</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Uszkodzenie (faktyczne):</th>
								<td class='dlugi_text uzytkownikk'><textarea class='uzytkownikk' id='co_uszkodzone'></textarea></td>
								<?php
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
													if(!$dane = mysql_query("SELECT DISTINCT `co_uszkodzone` FROM `rejestr`"))
														echo('tabela/dane');
												}
												if(!mysql_close($sql_conn))
													echo('zamkniecie');
											}
										?>
										<script type='text/javascript'>
										$('#co_uszkodzone').autocomplete(
												{
													source: [ <?php
																$dane1 ='';
																while($b = mysql_fetch_assoc($dane))
																{
																	$dane1 .= "{'value':'".$b['co_uszkodzone']."'}, ";
																}
																$dane3 = substr($dane1,0,strlen($dane1)-2);
																echo $dane3;
															?> ],
													minLength: 2
												}
											);
										</script>
							</tr>
							<tr>
								<th>Zwrot części:</th>
								<td>
									<select id='zwrot'>
										<option value='0'>NIE ZWRÓCONE</option>
										<option value='1'>ZWRÓCONE</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Koszt dojazdu:</th>
								<td><input type='text' autocomplete='off' id='dojazd'/> ZŁ</td>
							</tr>
							<tr>
								<th>Koszt praca:</th>
								<td><input type='text' autocomplete='off' id='praca'/> ZŁ</td>
							</tr>
							<tr>
								<th>Koszt części:</th>
								<td><input type='text' autocomplete='off' id='czesci'/> ZŁ</td>
							</tr>
							<tr>
								<th>Koszt mat. pomoc.:</th>
								<td><input type='text' autocomplete='off' id='materialy'/> ZŁ</td>
							</tr>
							<tr>
								<th>Koszt wys. części:</th>
								<td><input type='text' autocomplete='off' id='wysylka'/> ZŁ</td>
							</tr>
						</table>
					</div>
					<div id='form_karta'>
						<br/>
						KARTA NAPRAWY:
						<br/>
						<p>
							Karta naprawy wymaga dodatkowych danych...
						</p>
						<br/>
						<table>
							<tr>
								<th>Faktura VAT:</th>
								<td><input type='text' autocomplete='off' id='faktura'/></td>
							</tr>
							<tr>
								<th style='width: 130px;'>Nr karty gwarancyjnej:</th>
								<td><input type='text' autocomplete='off' id='karta'/></td>
							</tr>
							<tr>
								<th>Data sprzedaży:</th>
								<td><input type='text' autocomplete='off' id='d_spr' class='data_cal' size='10' value='<?php echo Date('Y-m-d'); ?>'/>&nbsp;[rrrr-mm-dd]</td>
							</tr>
							<tr>
								<th>Kupujący:</th>
								<td><input autocomplete='off' id='kupujacy'></td>
							</tr>
							<tr>
								<th>Osoba do kontaktu:</th>
								<td><input type='text' autocomplete='off' id='telefon'/></td>
							</tr>
							<tr>
								<th>Telefon kontaktowy:</th>
								<td><input type='text' autocomplete='off' id='telefon1'/></td>
							</tr>
							<tr>
								<th>Adres naprawy:</th>
								<td class='dlugi_text'>
									<textarea id='adres'></textarea>
								</td>
							</tr>
							<tr>
								<th>Części zamienne:</th>
								<td class='dlugi_text'  style='height: 110px;'>							
									<textarea id='czesci_wys' style='height: 110px;'></textarea>
									<div style='position: fixed;'>
										<div id='przyklady_czesci' style='z-index: 25; position: absolute; top: 2px; left: -500px; width: 500px; background: gray; max-height: 200px; overflow-y: auto;'>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<th>Adres do wysyłki:</th>
								<td class='dlugi_text'>
									<textarea id='czesci_adr'></textarea>
								</td>
							</tr>
							<tr>
								<th>Inne zalecenia:</th>
								<td class='dlugi_text'><textarea id='inne'></textarea></td>
							</tr>
							<tr>
								<th>Wystawiający:</th>
								<td>
									<input type='text' id='wystawil' autocomplete='off' ></input>
								</td>
								<?php
									$dane2 = NULL;
									if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
										blad_bazy('polaczenie');
									else
									{
										mysql_query('SET NAMES utf8');
										if(!mysql_select_db($baza))
											blad_bazy('baza');
										else
										{
											if(!$dane2 = mysql_query("SELECT DISTINCT `wystawil` FROM `rejestr`"))
												blad_bazy('tabela/dane');
										}
										if(!mysql_close($sql_conn))
											blad_bazy('zamkniecie');
									}
								?>
							<script>
								$('#wystawil').autocomplete(
									{
										source: [ <?php
													$dane3 ='';
													while($b = mysql_fetch_assoc($dane2))
													{
														$dane3 .= "\"".$b['wystawil']."\", ";
													}
													$dane3 = substr($dane3,0,strlen($dane3)-2);
													echo $dane3;
												?> ],
										minLength: 1 
									}
								);
							</script>
							</tr>
						</table>
					</div>
					<div id='przyciski'>
						<p>
						<?php
						$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
						if($REMOTE_ADDR != '192.168.2.113' && $REMOTE_ADDR != '192.168.2.199')
						{
							echo "<button class='button' id='#' onclick='javascript: void();'>BRAK DOSTĘPU</button>";
						}
						else
							echo "<button class='button' id='b_zapisz' onclick='javascript: zapisz_wszystko();'>ZAPISZ W REJESTRZE</button>";
						?>
						<button class='button' id='b_karta'>KARTA NAPRAWY</button>
						<button class='button' id='b_zlecenie'>ZLECENIE</button>
						</p>
					</div>
				</form>
			</div>
			<div id='kontener_serwisy'>
	<div id='serwisy_form'>
		<form>
			<table>
				<tr>
					<th colspan='2' style='text-align: center; height: 50px;'>
						<b>Dodaj serwis:</b><br/>
					</th>
				</tr>
							<?php
								$dane = NULL;
								if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
									blad_bazy('polaczenie');
								else
								{
									mysql_query('SET NAMES utf8');
									if(!mysql_select_db($baza))
										blad_bazy('baza');
									else
									{
										if(!$dane = mysql_query("SELECT max(`id`) FROM `serwisy`"))
											blad_bazy('tabela/dane');
									}
									if(!mysql_close($sql_conn))
										blad_bazy('zamkniecie');

									$dane = mysql_fetch_row($dane);
								}
							?>
				<tr>
					<th>
						Identyfikator:
					</th>
					<td>
						<input type='text' id='ident_nr' disabled='on' value='<?php echo ++$dane['0']; ?>'></input>
					</td>
				</tr>
				<tr>
					<th>
						Nazwa firmy:
					</th>
					<td>
						<textarea style='position: static !important;;' id='firma'></textarea>
					</td>
				</tr>									
				<?php
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
							if(!$dane = mysql_query("SELECT DISTINCT `firma`, `id`, `nazwisko` FROM `serwisy`"))
								echo('tabela/dane');
						}
						if(!mysql_close($sql_conn))
							echo('zamkniecie');
					}
				?>
				<script type='text/javascript'>
				$('#firma').autocomplete(
						{
							source: [ <?php
										$dane1 ='';
										while($b = mysql_fetch_assoc($dane))
										{
											$dane1 .= "{'value':'".$b['nazwisko']." ".nl2br($b['firma'])."', 'id':'".$b['id']."'}, ";
										}
										$dane3 = substr($dane1,0,strlen($dane1)-2);
										echo $dane3;
									?> ],
							minLength: 2 ,
							select: function(event, ui) {$('#ident_nr').val(ui.item.id) }
						}
					);
				</script>
				<tr>
					<th>
						NIP:
					</th>
					<td>
						<input type='text' id='nip'/>
					</td>
				</tr>
				<tr>
					<th>
						Osoba odpowiedzialna:
					</th>
					<td>
						<input type='text' id='nazwisko'/>
					</td>
				</tr>
				<tr>
					<th>
						Telefon:
					</th>
					<td>
						<input type='text' id='telefon_serw'/>
					</td>
				</tr>
				<tr>
					<th>
						E-mail:
					</th>
					<td>
						<input type='text' id='email'/>
					</td>
				</tr>
				<tr>
					<th>
						Ulica:
					</th>
					<td>
						<input type='text' id='adres_serw'/>
					</td>
				</tr>
				<tr>
					<th>
						Kod pocztowy, miasto:
					</th>
					<td>
						<input type='text' id='kod'/>
					</td>
				</tr>
				<tr>
					<th>
						Województwo:
					</th>
					<td>
						<select id='wojewodztwo'>
							<option value='0'>Dolnośląskie</option>
							<option value='1'>Kujawsko - pomorskie</option>
							<option value='2'>Lubelskie</option>
							<option value='3'>Lubuskie</option>
							<option value='4'>Łódzkie</option>
							<option value='5'>Małopolskie</option>
							<option value='6'>Mazowieckie</option>
							<option value='7'>Opolskie</option>
							<option value='8'>Podkarpackie</option>
							<option value='9'>Podlaskie</option>
							<option value='10'>Pomorskie</option>
							<option value='11'>Śląskie</option>
							<option value='12'>Świętokrzyskie</option>
							<option value='13'>Warmińsko - mazurskie</option>
							<option value='14'>Wielkopolskie</option>
							<option value='15'>Zachodniopomorskie</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						Zakres napraw:
					</th>
					<td>
						<select id='zakres'>
							<option value='0'>Chłodnicze</option>
							<option value='1'>Grzewcze</option>
							<option value='2'>Chłodnicze i grzewcze</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						Generowanie zlecenia:
					</th>
					<td>
						<select id='zlecenia'>
							<option value='1'>TAK
							</option>
							<option value='0'>NIE
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>
						Certyfikat imienny:
					</th>
					<td>
						<input type='text' id='certyfikat'/>
					</td>
				</tr>
				<tr>
					<th>
						Data szkolenia:
					</th>
					<td>
						<input type='text' id='data_cert' class='data_cal' />
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div id='serwisy_buttons'>
		<table>
			<tr>
				<th>
					<button class='button' id='b_wczytaj_serwis'>Wczytaj do edycji</button>
				</th>
			</tr>
			<tr>
				<th>
					<button class='button' id='b_zapisz_serwis'>Zapisz</button> 
					<span id='tryb'>Tryb dodaj</span>
				</th>
			</tr>
			<tr>
				<th>
					<button class='button' id='b_usun_serwis'>Usuń</button>
				</th>
			</tr>
			<tr>
				<th>
					<button class='button' id='b_zakoncz_rok'>Zakończ rok</button>
				</th>
			</tr>
		</table>
	</div>
</div>
	</body>
</html>