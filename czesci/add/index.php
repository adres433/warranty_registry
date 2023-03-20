<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<title>Nowy rysunek</title>
	<link rel="stylesheet" href="../styles/main.css" type="text/css" />
	<script type="text/javascript" src="../scripts/jquery.js"></script>
	<script type="text/javascript" src="../scripts/okzoom.js"></script>
 </head>
<script>
var control = 0;
var control_coords = 0;
	$(document).ready
	(
		function()
		{
			$('#del_part').click
				(
					function ()
					{
						if($('.part:last').attr('id') == 'part0')
						{
							alert("Nie można usunąć wszystkich części zamiennych");
						}
						else
						{
							$('.part:last').remove();
							--control;
						}
					}
				);
			function del_coordsy()
			{
				$(this).parent().remove();
			}
			function add_coordsy()
			{
				var nr = $(this).parent().find("legend:first").text();
				nr = (parseInt(nr.substr(0, (nr.length-1)))-1);
				var clone = $('#part_clone .coords').clone();
				//clone.find('input').val('');
				clone.find('.x').attr('name', "x["+nr+"][]");
				clone.find('.y').attr('name', "y["+nr+"][]");
				clone.appendTo($(this).parent());
				$('.del_coords').unbind('click');
				$('.del_coords').bind('click', del_coordsy);
				$('.coords').click
				(
					function()
					{
						control_coords = $(this);
					}
				)
			}
			$('#preview').click
				(
					function(event)
					{
						var rodzic = this.offsetParent;
						var relativeX = event.pageX -$(this).offset().left;
						var relativeY = event.pageY - $(this).offset().top;
						$(control_coords).find('.x').val(relativeX);
						$(control_coords).find('.y').val(relativeY);
					}
				)
			$('.coords').click
				(
					function()
					{
						control_coords = $(this);
					}
				);
			$('#add_part').click
				(
					function ()
					{
						++control;
						var clone = $('#part_clone').clone();
						clone.find('fieldset legend:first').html((control+1)+'.');
						//clone.find('input').val('');
						clone.find('.x').attr('name', "x["+control+"][]");
						clone.find('.y').attr('name', "y["+control+"][]");
						clone.find('.del_coords').hide();
						clone.appendTo($('#formularz'));
						$('#formularz #part_clone').show().attr('id', 'part'+control).attr('class', 'part');
						$('.add_coords').unbind('click');
						$('.coords').unbind('click');
						$('.add_coords').bind('click', add_coordsy)
						$('.coords').click
							(
								function()
								{
									control_coords = $(this);
								}
							)
					}
				);
			$('.add_coords').bind('click', add_coordsy);
				
			$('#Next').click
				(
					function ()
					{
						$('#formularz').submit();
					}
				);
		}
	);
</script>
 <body>
  <div id='main'>
		<div id='tytul'>
			<h1>Nowy rysunek - krok <?php if(!isset($_GET['e'])) echo '1'; else echo $_GET['e']+1;?>.</h1>
		</div>
		<div id='draw' style='text-align: center;'> 
		<?php
			if(!isset($_GET['e']))
			{ ?>
				<br/><br/>
				<p>
					Wybierz plik z rysunkiem oraz wprowadź jego oznaczenie:
					<br/><br/>
					<form action='index.php?e=1' method='POST' enctype="multipart/form-data">
						<input type='text' id='model' name='model' value='Model'/><br/><br/>
						<input type='file' id='picture' name='picture' accept="image/png"/>
						<br/> <br/>
						<input type='submit' value='Dalej'/>
					</form>
				</p>
				<?php
			}
			if(isset($_GET['e']) && $_GET['e'] == '1')
			{
				echo "Rysunek: ".$_POST['model'];
				if (is_uploaded_file($_FILES['picture']['tmp_name'])) 
					{
						move_uploaded_file($_FILES['picture']['tmp_name'], '../images/'.$_POST['model'].'.png');
					}
				else 
					{
						echo 'Błąd przy przesyłaniu danych!';
					}
				echo "<img id='preview' src='../images/".@$_POST['model'].".png' style='max-width: 674px; max-height: 650px;' />";
			}
			if(isset($_GET['e']) && $_GET['e'] == '2')
			{
				$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?><machine><model>".$_POST['model']."</model>";

				$i = 0;
				foreach($_POST['name'] as $nazwa)
				{
					$xml .= "<part><name>".$nazwa."</name><index>".$_POST['index'][$i]."</index><szt>".$_POST['szt'][$i]."</szt><adress>".$_POST['adress'][$i]."</adress><desc>".$_POST['desc'][$i]."</desc><coords>";
					$ii = 0;
					foreach($_POST['x'][$i] as $x)
					{
						$xml .= "<x>".$x."</x><y>".$_POST['y'][$i][$ii]."</y>";
						++$ii;
					}
					$xml .= "</coords></part>";
					++$i;
				}
				$xml .= "</machine>";
				if(file_put_contents('../bin/'.$_POST['model'].'.xml', $xml))
				{
					echo "Pomyślnie dodano nowy rysunek<br/><br/>";
					echo "Kartę katalogową można zobaczyć pod poniższym linkiem: <br/>";
					echo "<a href='../index.php?m=".$_POST['model']."'>".$_POST['model']."</a>";
				}
			}
		?>
		</div>
	<div id='parts'>
		CZĘŚCI ZAMIENNE<br/>
		<?php
		if(isset($_GET['e']) && $_GET['e'] == '1')
		{
			?>
			<div id='add_part'>
			</div>
			<div id='del_part'>
			</div>
			<div id='Next'>
			</div>
			<?php
		}
		?>
	</div>
	<div id='list_parts' >
	<?php
		if(isset($_GET['e'])&&$_GET['e'] == '1')
		{
		?>
		<form id='formularz' action='index.php?e=2' enctype="multipart/form-data" method="post">
			<input type='hidden' name='model' value="<?php echo $_POST['model']; ?>" />
			<div class='part' id='part0'>
				<fieldset>
					<legend>1.</legend>
					<input type='text' name='name[]' value='Nazwa części' style='display: block;'/>
					<input type='text' name='index[]' value='Index części' style='display: block;'/>
					<input type='text' name='adress[]' value='Adres do sklepu' style='display: block;'/>
					<input type='text' name='szt[]' value='Ile w wyrobie' style='display: block;'/>
					<input type='text' name='desc[]' style='display: block;' value='Krótki opis' />
					<button type='button' class='add_coords'></button>
					<fieldset class='coords'>
						<legend>Koordynaty</legend>
						<input type='text' name='x[0][]' value='x' class='x'/>
						<input type='text' name='y[0][]'  value='y' class='y'/>
					</fieldset>
				</fieldset>
				<br/>
			</div>
		</form>
			<div id='part_clone' style='display: none'>
				<fieldset>
					<legend>1.</legend>
					<input type='text' name='name[]' value='Nazwa części' style='display: block;'/>
					<input type='text' name='index[]' value='Index części' style='display: block;'/>
					<input type='text' name='adress[]' value='Adres do sklepu' style='display: block;'/>
					<input type='text' name='szt[]' value='Ile w wyrobie' style='display: block;'/>
					<input type='text' name='desc[]' style='display: block;' value='Krótki opis' />
					<button type='button' class='add_coords'></button>
					<fieldset class='coords'>
						<legend>Koordynaty</legend>
						<button type='button' class='del_coords'></button><br/>
						<input type='text' name='x[][]' value='x' class='x'/>
						<input type='text' name='y[][]' value='y' class='y'/>
					</fieldset>
				</fieldset>
				<br/>
			</div>
			<?php
		}
		?>
	</div>
  </div>
 </body>
</html>