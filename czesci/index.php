<?PHP
ini_set( 'display_errors', 'On' ); 
error_reporting( E_ALL );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<title><?php if(isset($_GET['m'])) echo @$_GET['m']." - e-Katalog części zamiennych"; else echo "e-Katalog części zamiennych"; ?></title>
	<link rel="stylesheet" href="styles/main.css" type="text/css" />
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/okzoom.js"></script>
 </head>

 <body>
  <div id='main'>
		<div id='tytul'>
			<h1><?php if(isset($_GET['m']) && (@file_get_contents('images/'.$_GET['m'].'.png')) && (@file_get_contents('bin/'.$_GET['m'].'.xml'))) echo $_GET['m']; else echo "Wybierz rysunek z poniższej listy"; ?></h1>
		</div>
		<div id='draw'  style='text-align: center; '> 
		 <?php if(isset($_GET['m']) && (@file_get_contents('images/'.$_GET['m'].'.png')) && (@file_get_contents('bin/'.$_GET['m'].'.xml'))) { ?><canvas id='rysunek' width='674' height='650'></canvas> <?php } else echo "<canvas id='rysunek' width='1' height='1'></canvas>"?>
	<script>

	var plotno = document.getElementById('rysunek');		
	var a = plotno.getContext('2d');
	function scroll_to(selector) 
		{
			$('#list_parts').scrollTop('0');
			$('#list_parts').scrollTop($(selector).offset().top-160);
			return false;
		} 
	function pokaz_kolor(x,y, id, z)
	{
		a.fillStyle = 'green';
		a.strokeStyle = 'red';
		a.lineWidth = 3;
		a.beginPath();
		a.arc((x),(y),10, 0,((Math.PI/180)*360), false);
		a.stroke();
		a.fill();
		$('#parts'+id).css('background', '#ffffcc').css('opacity', '0.6');
		if(z == 1)
			scroll_to($('#parts'+id));
	}

		$(document).ready
		(
			function()
			{
				$('#menu_1').click
				(
					function ()
					{
						if($('#ok-loupe').length != 1)
						{
							$(function(){
							$('#min').okzoom({
							  width: 200,
							  height: 200,
							  border: "1px solid black",
							  shadow: "0 0 5px #000"
							});
							});
						}
					}
				);
				$('#menu_2').click
				(
					function ()
					{
						if($('#ok-loupe').length == 1)
						{
							$('#ok-loupe').remove();
							$('.ok-listener').remove();
							$('#min').mouseover = '';
							$('*').css('cursor', 'auto');
						}
					}
				);
			}
		);




	</script>
		<?php if(isset($_GET['m']) && (@file_get_contents('images/'.$_GET['m'].'.png')))
		{ 
			?>
			<img id='min' src='<?php echo "images/".$_GET['m'].".png"?>' style='max-width: 674px; max-height: 650px;' usemap='#mapa-max' /> 

			<map name="mapa-max">
			<?php
				$file = @file_get_contents('bin/'.$_GET['m'].'.xml');					
				if($parts = simplexml_load_string($file))
				{
					$i = 0;
					foreach ($parts -> part as $a)
					{
						++$i;
						if(count($a->coords->x) == 1)
						{							
							echo "<area shape='circle' coords='".$a->coords->x.", ".$a->coords->y.", 10'";
							echo " href='javascript:void(0);'  onmouseover='pokaz_kolor(".$a->coords->x.", ".$a->coords->y.", ".$i.", 1);' onmouseout=\"a.clearRect(0, 0, plotno.width, plotno.height); $('#parts".$i."').css('background', 'none').css('opacity', '1');\" />";
						}
						else
						{	
							//$ile = count($a->coords->x);
							$ii = 0;
							foreach($a->coords->x as $fdf)
							{			
								echo "<area shape='circle' coords='".$a->coords->x[$ii].", ".$a->coords->y[$ii].", 10'";
								echo " href='javascript:void(0);'  onmouseover='";
								$iii = 0;
								foreach($a->coords->x as $fdfs)
								{
									echo "pokaz_kolor(".$a->coords->x[$iii].", ".$a->coords->y[$iii].", ".$i.", 1); ";
									++$iii;
								}
								echo "' onmouseout=\"a.clearRect(0, 0, plotno.width, plotno.height); $('#parts".$i."').css('background', 'none').css('opacity', '1');\" />";	
								++$ii;
							}
						}
					}
				}
		}
		else
		{
			echo "<p><h3>";
			foreach (new DirectoryIterator('bin/') as $fileInfo) 
			{
				if($fileInfo->getFilename() != '.' && $fileInfo->getFilename() != '..')
				{
					$ab = str_replace('.xml', '', $fileInfo->getFilename());
					echo "<li><a href='?m=".$ab."' >".$ab."</a></li>";
				}
			}
			echo "</h3></p>";
		}
			?>


		</map> 
		</div>
	<div id='parts'>
		<?php if(isset($_GET['m'])) echo "CZĘŚCI ZAMIENNE<br/>
		<div id='menu_1'></div>
		<div id='menu_2'></div>" ?>
	</div>
	<div id='list_parts' >
		<?php
		if(isset($_GET['m']))
		{
			$file;
			if(!$file = @file_get_contents('bin/'.$_GET['m'].'.xml'))
				echo "<h4 style='color: red;'>Przepraszamy, niestety nie udało się pobrać danych z bazy części zamiennych.</h4>";
			if($parts = simplexml_load_string($file))
			{
				$i = 0;
				foreach ($parts -> part as $a)
				{
					++$i;
					if(count($a->coords->x) == 1)
					{	
						echo "<div id='parts".$i."' class='parts' onmouseover='pokaz_kolor(".$a->coords->x.", ".$a->coords->y.", ".$i.", 0);' onmouseout=\"a.clearRect(0, 0, plotno.width, plotno.height); $('#parts".$i."').css('background', 'none').css('opacity', '1');\">";
						?>
							<h4><?php echo $a -> name; ?></h4>
							Index:<span style='margin-right: 20px; margin-left: 20px; text-align: left; text-decoration: italic; color: silver'><?php echo $a -> index; ?></span>
							W wyrobie:<span style='margin-left: 20px; text-decoration: italic;	color: silver'><?php echo $a -> szt; ?> szt.</span>
							<br/>
							<span><?php echo $a -> desc; ?></span>
						</div>
						<script>
							<?php echo "$('#parts".$i."')";?>.ready
							(
								function()
								{ 
									$(this).dblclick
										(
											function()
											{
												window.open('<?php echo $a->adress; ?>', "popupWindow", "width=600,height=600,scrollbars=yes");
											}
										);
								}
							);
						</script>
						<?php
					}
					else
					{	
						$ii = 0;	
							echo "<div id='parts".$i."' class='parts' onmouseover='";
							$ii = 0;
							foreach($a->coords->x as $fdfs)
							{
								echo "pokaz_kolor(".$a->coords->x[$ii].", ".$a->coords->y[$ii].", ".$i."); ";
								++$ii;
							}
							
							echo "' onmouseout=\"a.clearRect(0, 0, plotno.width, plotno.height); $('#parts".$i."').css('background', 'none').css('opacity', '1');\" >";
							?>
								<h4><?php echo $a -> name; ?></h4>
								<span style='margin-left: 20px; text-align: left; text-decoration: italic;	color: silver'><?php echo $a -> index; ?></span>
								<span style='margin-left: 100px; text-decoration: italic;	color: silver'><?php echo $a -> szt; ?> szt.</span>
								<br/>
								<span><?php echo $a -> desc; ?></span>
							</div>
							<?php
					}
				}
			}
		}
		?>
	</div>
  </div>
 </body>
</html>