<?php
if(isset($_POST['kontr']) && $_POST['kontr'] == '1')
	$adres = "http://system.dora-metal.pl/HANDLOWY/wtle/wyborkontrahenta.php?q=".$_POST['q'];
else
	$adres = "http://system.dora-metal.pl/HANDLOWY/wtle/zamowienia_wybortowmat.php?q=".$_POST['q']."&towmat=1";
$adres = str_replace(' ', '%20', $adres);
$text = fopen($adres, 'r');	
file_put_contents('karta.txt', $text);
fclose($text);

$text = fopen('karta.txt', 'r');
@$text1 =  fread($text, filesize('karta.txt'));
fclose($text);
while(strpos($text1, '<td onclick'))
{
	$pozycja1 = strpos($text1, '<td onclick');
	$pozycja2 = strpos($text1, ';">');

	$text_do_wyc = substr($text1,$pozycja1, (($pozycja2-$pozycja1)+3));

	$text1 = str_replace($text_do_wyc, '<td>', $text1);
	$text1 = str_replace('x  x  &nbsp;&nbsp;0 zł', '', $text1);
}

echo $text1;
?>