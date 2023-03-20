<script src="../jquery-mini.js"></script>
<script>
function sortowanie1(kto, coo)
										{
													if((location.href.indexOf(kto+'=')) == -1)
													{
														/* JEŻELI NIEMA*/
														if(location.href.indexOf('?') != -1)
														{
															/*JEZELI JEST '?' */
															var adres = location.href;
															location.href = adres+'&'+kto+'='+coo;
														}
														else
															location.href = '?'+kto+'='+coo;
															
													}
													else 
													{
														/* JEŻELI JEST */
														var adres = location.href;
															if(adres.indexOf('&', adres.indexOf(kto+'=')) != -1)
															{
																/*JEŻELI NIE JEST OSTATNI */
																var i = adres.indexOf(kto+'=');
																var ii = adres.indexOf('&', i);
																var co = adres.substring(i, ii);
																var naco = kto+'='+coo;
																adres = adres.replace(co, naco);
																window.location = adres;
															}
															else
															{
																/*JEŻELI JEST OSTATNI */
																var i = adres.indexOf(kto+'=');
																var co = adres.substring(i);
																var naco = kto+'='+coo;
																adres = adres.replace(co, naco);
																window.location = adres;

															}
													}
										}
</script>
<?php
include('../connect.php');

if(isset($_GET['q']))
{
	$q2 = $_GET['q'];
}
else
	$q2 = 'w';

date_default_timezone_set('CET');

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
			if(!$dane = mysql_query("SELECT `serwis` FROM `rejestr` WHERE czesci_wys IS NOT NULL AND NOT `czesci_wys`=''"))
				echo('tabela/dane');				
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}
$j;
$jj = 0;
while($row = mysql_fetch_array($dane))
{
	$j[$jj] = $row['serwis'];
	++$jj;	
}

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
			if(!$dane = mysql_query("SELECT * FROM `serwisy` WHERE NOT `id` = 1 AND NOT `id` = 2 ORDER BY `nazwisko`"))
				echo('tabela/dane');				
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
	}

	echo "<select><option value='xx1' id='xx1'>WSZYSCY</option>";
	echo "<option value='1' id='i1'>SERWIS DM</option>";
	echo "<option value='2' id='i2'>WYSYŁKA CZĘŚCI</option>";
while($row = mysql_fetch_array($dane))
{
	$kontrol = false;
	for($x = 0; $x < count($j); ++$x)
	{
		if($j[$x] == $row['id'])
		{
			$kontrol = true;
			break;
		}
	}
	if($kontrol == true)
	{
		if($row['nazwisko'] != '')
			echo "<optgroup label='".$row['nazwisko']."'>";
		else
			echo "<optgroup label='-'>";

		echo "<option value='".$row['id']."' id='i".$row['id']."'> ".$row['firma']."</option>";
		echo "</optgroup>";
	}
}
	echo "</select> &nbsp;  &nbsp; &nbsp; &nbsp; Na dzień: ".Date('d-m-Y');
	echo "<br/>";
?>		

<p><button onclick="sortowanie1('q','w')" <?php if(isset($_GET['q']) && $_GET['q'] == 'w') echo "disabled=true"; if(!isset($_GET['q'])) echo "disabled=true"; ?>>>WSZYSTKIE</button>
<button onclick="sortowanie1('q','z')" <?php if(isset($_GET['q']) && $_GET['q'] == 'z') echo "disabled=true"; ?>>>ZWRÓCONE</button>
<button onclick="sortowanie1('q','n')" <?php if(isset($_GET['q']) && $_GET['q'] == 'n') echo "disabled=true"; ?>>>NIE ZWRÓCONE</button></p>

<script>
	$(document).ready
	(
		function()
		{
			$('select').on
				(
					"change",
					function()
					{
						window.location.replace(location.pathname+'?id='+$(this).val());
					}
				);
			<?php
				if(isset($_GET['id']))
			{
					echo "var ident = '".$_GET['id']."';";
					?>
						$('select').val(ident);
						
			
		}
	); 
	</script>
		<?php }
		
				if(isset($_GET['id']))
			{
	$dane = NULL;
	if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
		echo('polaczenie');
	else
	{
		if(!mysql_select_db($baza))
			echo('baza');
		else
		{
			if($_GET['id'] != 'xx1')
			{
				switch($q2)
				{
					case 'w':
					$zapyt = "SELECT `czesci_wys`, `id`, `zlecenie` FROM `rejestr` WHERE serwis=".$_GET['id']." AND czesci_wys IS NOT NULL AND NOT `czesci_wys`=''";
					break;
					case 'z':
					$zapyt = "SELECT `czesci_wys`, `id`, `zlecenie` FROM `rejestr` WHERE serwis=".$_GET['id']." AND czesci_wys IS NOT NULL AND NOT `czesci_wys`='' AND  `zwrot` = 1";
					break;
					case 'n':
					$zapyt = "SELECT `czesci_wys`, `id`, `zlecenie` FROM `rejestr` WHERE serwis=".$_GET['id']." AND czesci_wys IS NOT NULL AND NOT `czesci_wys`='' AND  `zwrot` = 0";
					break;
					default:
					$zapyt = "SELECT `czesci_wys`, `id`, `zlecenie` FROM `rejestr` WHERE serwis=".$_GET['id']." AND czesci_wys IS NOT NULL AND NOT `czesci_wys`=''";
				}
			}
			else
			{
				switch($q2)
				{
					case 'w':
					$zapyt = "SELECT `czesci_wys`, `id`, `serwis`, `zlecenie` FROM `rejestr` WHERE `czesci_wys` IS NOT NULL AND NOT `czesci_wys`='' ORDER BY `serwis`";
					break;
					case 'z':
					$zapyt = "SELECT `czesci_wys`, `id`, `serwis`, `zlecenie` FROM `rejestr` WHERE `czesci_wys` IS NOT NULL AND NOT `czesci_wys`='' AND  `zwrot` = '1' ORDER BY `serwis`";
					break;
					case 'n':
					$zapyt = "SELECT `czesci_wys`, `id`, `serwis`, `zlecenie` FROM `rejestr` WHERE `czesci_wys` IS NOT NULL AND NOT `czesci_wys`='' AND  `zwrot` = '0' ORDER BY `serwis`";
					break;
					default:
					$zapyt = "SELECT `czesci_wys`, `id`, `serwis`, `zlecenie` FROM `rejestr` WHERE `czesci_wys` IS NOT NULL AND NOT `czesci_wys`='' ORDER BY `serwis`";
				}
			}
			mysql_query('SET NAMES utf8');
			if(!$dane = mysql_query($zapyt))
				echo('tabela/dane');				
		}
		if(!mysql_close($sql_conn))
			echo('zamkniecie');
		
		
		while($row = mysql_fetch_array($dane))
		{
			echo "<hr/>";
			if($_GET['id'] != 'xx1')
			{
				echo "<br/><br/>KN: ".$row['id']." ZLECENIE: ".$row['zlecenie']."<br/><br/>".nl2br($row['czesci_wys']);
			}
			else
			{				
				if(!$sql_conn = mysql_connect($serwer.':'.$port, $login, $haslo))
					echo('polaczenie');
				else
				{
					if(!mysql_select_db($baza))
						echo('baza');
					else
					{
						$zapyt = "SELECT `firma`, `nazwisko` FROM `serwisy` WHERE `id`='".$row['serwis']."'";
						mysql_query('SET NAMES utf8');
						if(!$dane1 = mysql_query($zapyt))
							echo('tabela/dane');				
					}
					if(!mysql_close($sql_conn))
						echo('zamkniecie');
						$row1 = mysql_fetch_array($dane1);
						echo "<br/><b>".$row1['nazwisko']."</b><br/>".$row1['firma']."&nbsp;KN: ".$row['id']." ZLECENIE: ".$row['zlecenie']."<br/><br/>".nl2br($row['czesci_wys']);
				}
			}
		}
}
			}

if(!isset($_GET['id']))
{ ?>
	}
	); 
	</script>
<?php }
?>