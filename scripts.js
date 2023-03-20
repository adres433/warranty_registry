var data = new Date();
var rok = 'r';
var edycja = 'dodaj';
rok = rok + data.getFullYear();
var ktory = 'brak';
function dodaj(id)
{
	if(ktory != 'brak')
	{
		if(id == ktory)
		{
			ktory = id;
			if(document.getElementById('kontener_form').style.display == 'block')
			{
				$('#kontener_form').fadeOut('slow');
				document.getElementById('formularz_rejestru').reset();
				ktory = 'brak';
				$('#przyciemnij').fadeOut();
			}
			else
			{
				$('#przyciemnij').fadeIn();
				$('#kontener_form').fadeIn('slow');
			}
		}
		else
			return;
	}
	else
	{
		ktory = id;
		if(document.getElementById('kontener_form').style.display == 'block')
		{
			$('#kontener_form').fadeOut('slow');
			document.getElementById('formularz_rejestru').reset();
			$('#przyciemnij').fadeOut();
		}
		else
		{
			
			$('#przyciemnij').fadeIn();
			$('#kontener_form').fadeIn('slow');
		}
	}
}





function edytuj(id)
{
	if(ktory != 'brak')
		{
			if(id == ktory)
			{
				ktory = id;
				if(document.getElementById('kontener_form').style.display == 'block')
				{
					$('#kontener_form').fadeOut('slow');
					document.getElementById('formularz_rejestru').reset();
					ktory = 'brak';
					$('#b_wczytaj').hide();
					$('#b_zapisz').attr('onclick', 'javascript: zapisz_wszystko();');
					$('#przyciemnij').fadeOut();
					$('#zlecenie_wczytane').val('0');
				}
				else
				{
					$('#przyciemnij').fadeIn();
					$('#kontener_form').fadeIn('slow');
					$('#b_wczytaj').show();
					document.getElementById('nr_id').value = '';
					$('#b_zapisz').attr('onclick', "javascript: zapisz_wszystko('aktualnie');");
					$('#zlecenie').val('');
				}
			}
			else
				return;
		}
		else
		{
			ktory = id;
			if(document.getElementById('kontener_form').style.display == 'block')
			{
				$('#kontener_form').fadeOut('slow');
				document.getElementById('formularz_rejestru').reset();
				$('#b_wczytaj').hide();
				$('#b_zapisz').attr('onclick', 'javascript: zapisz_wszystko();');
				$('#przyciemnij').fadeOut();
				$('#zlecenie_wczytane').val('0');
			}
			else
			{
				$('#przyciemnij').fadeIn();
				$('#kontener_form').fadeIn('slow');
				$('#b_wczytaj').show();
				document.getElementById('nr_id').value = '';
				$('#b_zapisz').attr('onclick', "javascript: zapisz_wszystko('aktualnie');");
				$('#zlecenie').val('');
			}
		}
}
function usun()
{
	var do_usuniecia = "numer=";
	do_usuniecia += window.prompt('Podaj nr PG, który chcesz usunąć:', 'Nie należy usuwać wpisów z rejestru');
	$.ajax
				(
					{  
					type: 'POST',  
					url: 'rejestr/del_rejestr.php',
					data: do_usuniecia,  
					success: function(data) 
						{
						if( data != 'OK' )
						  alert(data+'Błąd bazy danych - usuwanie');
						else
							{
								window.location.replace('index.php');
							}
						}
					}
				);  
}
function zapisz_wszystko(jak) 
	{  
			var dane_post = "dane=";
			dane_post += $('#nr_id').val(); 
			dane_post += "|";
			dane_post +=  $('#d_zgl').val();
			dane_post += "|"; 
			dane_post +=  $('#d_zal').val(); 
			dane_post += "|";
			dane_post +=  $('#nazwa').val();
			dane_post += "|"; 
			if($('#rodzaj').val() === '0')
				dane_post +=  "c";
			else if($('#rodzaj').val() === '1')
				dane_post +=  'g';
			else if($('#rodzaj').val() === '3')
				dane_post +=  'm';
			else
				dane_post +=  "c g";
			dane_post += "|"; 
			dane_post +=  $('#typ').val(); 
			dane_post += "|";
			dane_post +=  $('#fabryczny').val(); 
			dane_post += "|";
			dane_post +=  $('#zglaszajacy').val(); 
			dane_post += "|";
			dane_post +=  $('#uzytkownik').val(); 
			dane_post += "&dane1=";
			dane_post += "|";
			dane_post +=  $('#naprawa').val(); 
			dane_post += "|";
			dane_post +=  $('#ukryte_id').val(); 
			dane_post += "|";
			dane_post +=  $('#zlecenie').val(); 
			dane_post += "|";
			dane_post +=  $('#uszkodzenie').val(); 
			dane_post += "|";
			dane_post +=  $('#status').val(); 
			dane_post += "|";
			dane_post +=  $('#zwrot').val(); 
			dane_post += "|";
			dane_post +=  $('#dojazd').val(); 
			dane_post += "|";
			dane_post +=  $('#praca').val(); 
			dane_post += "|";
			dane_post +=  $('#czesci').val(); 
			dane_post += "|";
			dane_post +=  $('#materialy').val(); 
			dane_post += "|";
			dane_post +=  $('#wysylka').val();
			dane_post += "|";
			dane_post +=  $('#faktura').val();
			dane_post += "|";
			dane_post +=  $('#karta').val();
			dane_post += "|";
			dane_post +=  $('#d_spr').val();
			dane_post += "&dane2=";
			dane_post += "|";
			dane_post +=  $('#kupujacy').val();
			dane_post += "|";
			dane_post +=  $('#telefon').val();
			dane_post += "|";
			dane_post +=  $('#telefon1').val();
			dane_post += "|";
			dane_post +=  $('#adres').val();
			dane_post += "|";
			dane_post +=  $('#czesci_wys').val();
			dane_post += "|";
			dane_post +=  $('#czesci_adr').val();
			dane_post += "|";
			dane_post +=  $('#inne').val();
			dane_post += "|";
			dane_post +=  $('#wystawil').val();
			dane_post += "|";
			dane_post +=  $('#co_uszkodzone').val();
			dane_post += "|";
			var adresik_danych = (jak != 'aktualnie')? '/rejestr/add_rejestr.php' : '/rejestr/update_rejestr.php';
			$.ajax
				(
					{  
					type: 'POST',  
					url: adresik_danych,
					data: dane_post,  
					success: function(datka) 
						{
						if( datka != 'OK' )
						  alert('Błąd bazy danych - zapis'+datka);
						else
							{
								window.location.reload();
							}
						}
					}
				)
}

$(
	function()
	{ 
		$( '.data_cal' ).datepicker(
			{
			autoSize: true, 
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			changeMonth: true,
			closeText: "Zamknij",
			currentText: "Dzisiaj",
			showButtonPanel: true,
			showAnim: "fold",
			monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
			dayNamesMin: ['Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
			monthNamesShort: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],
			}
								);
	}
);
$(document).ready
(
	function()
	{
		$('#b_wczytaj').click
			(
				function wczytaj_karte()
				{
					var liczba1, liczba2 = 0;
					liczba1 = parseInt($('#nr_id').val());
					liczba2 = parseInt($('#ostatni_nr_id').val());
					if(liczba1 <= liczba2)
					{
						if($('#nr_id').val() != '')
						{
							if($('#nr_id').val() != '0')
							{
								var danee = 'id='+$('#nr_id').val();
								$.ajax
								(
									{
										type: 'POST',
										url: 'rejestr/load_rejestr.php',
										data: danee,
										success: function(data)
											{ 
												var pociete = data.split('|');
 				 
												if(pociete['3'] == 'c')
													$('#rodzaj').val('0');	
												else if(pociete['3'] == 'g')
													$('#rodzaj').val('1');
												else if(pociete['3'] == 'm')
													$('#rodzaj').val('3');
												else
													$('#rodzaj').val('2');
												$('#d_zgl').val(pociete['0']);		 
												$('#d_zal').val(pociete['1']); 		
												$('#nazwa').val(pociete['2']);			 
												$('#typ').val(pociete['4']); 		
												$('#fabryczny').val(pociete['5']); 		
												$('#zglaszajacy').val(pociete['6']); 		
												$('#uzytkownik').val(pociete['7']); 		
												$('#naprawa').val(pociete['8']); 		
												$('#serwis').val(pociete['9']); 		
												$('#ukryte_id').val(pociete['19']); 
												$('#zlecenie').val(pociete['10']); 
												$('#zlecenie_wczytane').val(pociete['10']); 
												$('#uszkodzenie').val(pociete['11']); 		
												$('#status').val(pociete['12']); 
												$('#zwrot').val(pociete['13']); 
												$('#dojazd').val(pociete['14']); 
												$('#praca').val(pociete['15']); 
												$('#czesci').val(pociete['16']); 
												$('#materialy').val(pociete['17']); 
												$('#wysylka').val(pociete['18']);
												$('#faktura').val(pociete['20']);
												$('#karta').val(pociete['21']);
												$('#d_spr').val(pociete['22']);
												$('#kupujacy').val(pociete['23']);
												$('#telefon').val(pociete['24']);
												$('#telefon1').val(pociete['25']);
												$('#adres').val(pociete['26']);
												$('#czesci_wys').val(pociete['27']);
												$('#czesci_adr').val(pociete['28']);
												$('#inne').val(pociete['29']);
												$('#wystawil').val(pociete['30']);
												$('#co_uszkodzone').val(pociete['31']);
											}
									}
								);
							}
							else
								alert('Nie można wczytać - wpis nie istnieje');
						}
						else
							return false;
					}
					else
						alert('Nie można wczytać - wpis nie istnieje');
					return false;
				}
			);
	}
);

$(document).ready
( function(){
	$('#b_wczytaj_serwis').click
	(
	function()
		{
		if(edycja === 'zmien')
			{
				edycja = 'dodaj';
				$('#tryb').html('Tryb dodaj');
			}
		else
			{
				edycja='zmien';
				$('#tryb').html('Tryb zmień');
			}
		var identyfikacyjny = 'id='+$('#ident_nr').val();
			$.ajax
				(
					{
						type: 'POST',
						url: 'serwisy/load_serwisy.php',
						data: identyfikacyjny,
						success: function(data)
							{ 
								var pociete = data.split('|');		 
								$('#firma').val(pociete['1']); 		
								$('#nip').val(pociete['2']);		 
								$('#nazwisko').val(pociete['3']);		 
								$('#telefon_serw').val(pociete['4']); 		
								$('#email').val(pociete['5']); 		
								$('#adres_serw').val(pociete['6']); 		
								$('#kod').val(pociete['7']); 		
								$('#wojewodztwo').val(pociete['8']); 		
								$('#zakres').val(pociete['9']); 
								$('#zlecenia').val(pociete['10']);
								$('#certyfikat').val(pociete['11']); 
								$('#data_cert').val(pociete['12']); 
							}
					}
				);
					return false;
		}
	)
});
$(document).ready
( function(){
	$('#b_zapisz_serwis').click
	(
	function()
		{
					var dane_serwisy = '';
					if(edycja != 'dodaj')
						{
							dane_serwisy = $('#ident_nr').val();
							dane_serwisy += '|';
						}
					dane_serwisy += $('#firma').val();
					dane_serwisy += '|';
					dane_serwisy += $('#nip').val();
					dane_serwisy += '|';
					dane_serwisy += $('#nazwisko').val();
					dane_serwisy += '|';
					dane_serwisy += $('#telefon_serw').val();
					dane_serwisy += '|';
					dane_serwisy += $('#email').val();
					dane_serwisy += '|';
					dane_serwisy += $('#adres_serw').val();
					dane_serwisy += '|';
					dane_serwisy += $('#kod').val();
					dane_serwisy += '|';
					dane_serwisy += $('#wojewodztwo').val();
					dane_serwisy += '|';
					dane_serwisy += $('#zakres').val();
					dane_serwisy += '|';
					dane_serwisy += $('#zlecenia').val();
					dane_serwisy += '|';
					dane_serwisy += $('#certyfikat').val();
					dane_serwisy += '|';
					dane_serwisy+=$('#data_cert').val();
					var datka = 'co='+edycja+'&dane='+dane_serwisy;
			$.ajax
				(
					{
						type: 'POST',
						url: 'serwisy/serwisy.php',
						data: datka,
						success: function(data){
							if( data != 'OK' )
						  alert('Błąd bazy danych - zapis');
						else
							{
								window.location.replace('index.php');
							}}
					}
				);
					return false;
		}
	)
});
$(document).ready
( function(){
	$('#b_usun_serwis').click
	(
	function()
		{
		var datka = 'co=usun&dane=';
		datka += $('#ident_nr').val();
			$.ajax
				(
					{
						type: 'POST',
						url: 'serwisy/serwisy.php',
						data: datka,
						success: function(data){
							if( data != 'OK' )
						  alert('Błąd bazy danych - zapis'+data);
						else
							{
								window.location.replace('index.php');
							}}
					}
				);
					return false;
		}
	)
});

	$(document).ready
	(
		function()
		{
			$('#b_opcje').click(
			function()
			{
				if($('#kontener_form').css('display') == 'none')
				{
					if($('#kontener_serwisy').css('display') == 'none')
					{						
						$('#przyciemnij').fadeIn();
						$('#kontener_serwisy').fadeIn('slow');
						$('#b_dodaj').attr('onclick', '');
						$('#b_edytuj').attr('onclick', '');
					}
					else
					{
						$('#kontener_serwisy').fadeOut('slow');
						$('#b_dodaj').attr('onclick', 'javascript: dodaj(this.id);');
						$('#b_edytuj').attr('onclick', 'javascript: edytuj(this.id);');
						$('#przyciemnij').fadeOut();
					}
				}
					return false;
			})
		}
	);

	$(document).ready
	(
		function()
		{
			$('#b_karta').click
				(
					function()
					{
						var dane = 'nr_karty='+$('#nr_id').val();
						dane += '&wyrob='+$('#nazwa').val()+' '+$('#typ').val();
						dane += '&fabryczny='+$('#fabryczny').val();
						dane += '&faktura='+$('#faktura').val();
						dane += '&gwarancja='+$('#karta').val();
						dane += '&data='+$('#d_spr').val();
						dane += '&kupujacy='+$('#kupujacy').val();
						dane += '&gw='+$('#naprawa').val();
						dane += '&kontakt='+$('#telefon').val()+' '+$('#telefon1').val();
						dane += '&adres='+$('#adres').val();
						dane += '&usterka='+$('#uszkodzenie').val();
						dane += '&serwis='+$('#ukryte_id').val();
						dane += '&serzlec='+$('#serwis').val();
						dane += '&zlec='+$('#zlecenie').val();
						dane += '&podpis='+$('#wystawil').val();
						dane += '&wysylka='+$('#czesci_adr').val();
						dane += '&inne='+$('#inne').val();
						
						if($('#czesci_wys').val() == '' || $('#czesci_wys').val() == ' ')
							dane += '&czesci=\n\n\n\n';
						else
							dane += '&czesci='+$('#czesci_wys').val()+"\n\n";
						if($('#inne').val() == '' || $('#inne').val() == ' ')
							dane += '&inne=\n\n\n\n';
						else
							dane += '&inne='+$('#inne').val()+"\n\n";

						$.ajax
							(
								{
									type: 'POST',
									url: 'ps_karta/index.php',
									data: dane,
									success:
										function(kartka)
										{
											var okno = window.open("ps_karta/karta.pdf", "Karta naprawy", "titlebar=no, width=700px, height=850px, toolbar=no, scrollbars=yes, resizable=0, top=10, left=200");
										}
								}
							);
					return false;
					}
				);
		}
	);

	$(document).ready
	(
		function()
		{
			$('#b_zlecenie').click
				(
					function()
					{
						var dane = 'zlec='+$('#zlecenie').val();
						dane += '&typ='+$('#nazwa').val()+' '+$('#typ').val();
						dane += '&fabryczny='+$('#fabryczny').val();
						dane += '&adres='+$('#adres').val();
						dane += '&kont='+$('#telefon').val();
						dane += '&tel='+$('#telefon1').val();
						dane += '&usterka='+$('#uszkodzenie').val();
						dane += '&rodzaj='+$('#rodzaj').val();
						dane += '&podpis='+$('#wystawil').val();
						dane += '&serwis='+$('#ukryte_id').val();
						if($('#ukryte_id').val() == '1' || $('#ukryte_id').val() == '2')
							return 0;
						else if($('#ukryte_id').val() == '')
							alert("Najpierw wybierz serwis");
						else
						{
							$.ajax
								(
									{
										type: 'POST',
										url: 'ps_zlecenie/index.php',
										data: dane,
										success:
											function(kartka)
											{
												var okno = window.open("ps_zlecenie/zlecenie.pdf", "Zlecenie", "width=600px, height=850px, toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500");
											}
									}
								);
						}
					return false;
					}
				);
		}
	);

	function sortowanie(event, ui, kto)
										{
													if((location.href.indexOf(kto+'=')) == -1)
													{
														/* JEŻELI NIEMA*/
														if(location.href.indexOf('?') != -1)
														{
															/*JEZELI JEST '?' */
															var adres = location.href;
															location.href = adres+'&'+kto+'='+ui.item.value;
														}
														else
															location.href = '?'+kto+'='+ui.item.value;
															
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
																var naco = kto+'='+ui.item.value;
																adres = adres.replace(co, naco);
																window.location = adres;
															}
															else
															{
																/*JEŻELI JEST OSTATNI */
																var i = adres.indexOf(kto+'=');
																var co = adres.substring(i);
																var naco = kto+'='+ui.item.value;
																adres = adres.replace(co, naco);
																window.location = adres;

															}
													}
										}
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
										}function sortowanie_data()
										{
											var data1 = $('#pokaz_data1').val();
											var data2 = $('#pokaz_data2').val();

													if((location.href.indexOf('pokaz_data1=')) == -1)
													{
														/* JEŻELI NIEMA*/
														if(location.href.indexOf('?') != -1)
														{
															/*JEZELI JEST '?' */
															var adres = location.href;
															location.href = adres+'&pokaz_data1='+data1+'&pokaz_data2='+data2;
														}
														else
															location.href = '?pokaz_data1='+data1+'&pokaz_data2='+data2;
															
													}
													else 
													{
														/* JEŻELI JEST */
														var adres = location.href;
															if(adres.indexOf('&', adres.indexOf('pokaz_data2=')) != -1)
															{
																/*JEŻELI NIE JEST OSTATNI */
																var i = adres.indexOf('pokaz_data1=');
																var i2 = adres.indexOf('pokaz_data2=');
																var ii = adres.indexOf('&', i2);
																var co = adres.substring(i, ii);
																var naco = 'pokaz_data1='+data1+'&pokaz_data2='+data2;
																adres = adres.replace(co, naco);
																window.location = adres;
															}
															else
															{
																/*JEŻELI JEST OSTATNI */
																var i = adres.indexOf('pokaz_data1=');
																var co = adres.substring(i);
																var naco = 'pokaz_data1='+data1+'&pokaz_data2='+data2;
																adres = adres.replace(co, naco);
																window.location = adres;

															}
													}
										}
$(document).ready
(
	function()
	{
		$('.sor_del').click
			(
				function()
				{
					if(this.id == 'naz_del')
						kto = 'nazwa';
					if(this.id == 'uzyt_del')
						kto = 'uzytkownik';
					if(this.id == 'zlec_del')
						kto = 'zlecenie';
					if(this.id == 'rodzaj_del')
						kto = 'rodzaj';
					if(this.id == 'nap_del')
						kto = 'naprawa';
					if(this.id == 'typ_del')
						kto = 'typ';
					if(this.id == 'ser_del')
						kto = 'serwis';
					if(this.id == 'usz_del')
						kto = 'uszkodzenie';
					if(this.id == 'stat_del')
						kto = 'status';
					if(this.id == 'uste_del')
						kto = 'usterka';
						
							var adres = location.href;
							if(adres.indexOf('?'+kto) == -1)
							{
								if(adres.indexOf('&', adres.indexOf(kto+'=')) != -1)
								{
									/*JEŻELI NIE JEST OSTATNI */
									var i = adres.indexOf(kto+'=');
									var ii = adres.indexOf('&', i);
									var co = adres.substring(--i, ii);
									var naco = '';
									adres = adres.replace(co, naco);
									window.location = adres;
								}
								else
								{
									/*JEŻELI JEST OSTATNI */
									var i = adres.indexOf(kto+'=');
									var co = adres.substring(--i);
									var naco = '';
									adres = adres.replace(co, naco);
									window.location = adres;
								}
							}
							else
							{
								if(adres.indexOf('&', adres.indexOf(kto+'=')) != -1)
								{
									/*JEŻELI NIE JEST OSTATNI */
									var i = adres.indexOf(kto+'=');
									var ii = adres.indexOf('&', i);
									var co = adres.substring(i, ++ii);
									var naco = '';
									adres = adres.replace(co, naco);
									window.location = adres;
								}
								else
								{
									/*JEŻELI JEST OSTATNI */
									var i = adres.indexOf(kto+'=');
									var co = adres.substring(--i);
									var naco = '';
									adres = adres.replace(co, naco);
									window.location = adres;
								}
							}
				}
			)
	}
);

$(document).ready
(
	function()
	{
		$('#b_zakoncz_rok').click
			(
				function ()
				{
					$.ajax
						({
							type: 'POST',
							url: 'rejestr/end_year.php',
							success: 
											function(kartka)
											{
												var okno = window.open("rejestr/rejestr_reklamacji_urzadzen.csv", "to_print", "width=600px, height=850px, toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500");
											}
						});
				}
			);
	}
);
$(document).ready
(
	function()
	{
		$('#menu1').hover
			(
				function ()
				{
					//if(ip_klienta === "192.168.2.176" || ip_klienta === "192.168.2.199")
						$('#menu').stop(false, true).fadeIn(0);
				},
				function ()
				{
				}
			);
	}
);
$(document).ready
(
	function()
	{
		$('#menu').hover
			(
				function ()
				{			
					//if(ip_klienta == "192.168.2.176" || ip_klienta == "192.168.2.199")
						$('#menu').stop(false, true).fadeIn(0);
				},
				function ()
				{
					//if(ip_klienta == "192.168.2.176" || ip_klienta == "192.168.2.199")
						$('#menu').stop().fadeOut(800);
				}
			);
	}
);
$(document).ready
(
	function()
	{
		var szer = window.innerWidth;
		szer = Math.round(szer/2, 0);
		szer = szer-100;
		$('#menu').css('left', szer);
		$('#menu1').css('left', szer);
		$(document).tooltip({track: true, position: { my: "right top+50", at: "right top", collision: "flipfit" }});
		$('#dojazd').change(function(){$('#dojazd').val($('#dojazd').val().replace(',', '.'))});
		$('#praca').change(function(){$('#praca').val($('#praca').val().replace(',', '.'))});
		$('#czesci').change(function(){$('#czesci').val($('#czesci').val().replace(',', '.'))});
		$('#materialy').change(function(){$('#materialy').val($('#materialy').val().replace(',', '.'))});
		$('#wysylka').change(function(){$('#wysylka').val($('#wysylka').val().replace(',', '.'))});
		$('#czesci_wys').bind('keyup', function(eve) {pokaz_czesci($(this).val(), eve);});
		$('#zglaszajacy').bind('keyup', function(eve) {pokaz_kontrahenta($(this).val(), eve);});
		$('#zglaszajacy').change(function(){$('#kupujacy').val($('#zglaszajacy').val())});
	}
);
function split( val ) 
{
	return val.split( /,\s*/ );
}
function extractLast( term ) 
{
	return split( term ).pop();
}

String.prototype.usun_spacje=function(){return this.replace(/^\s+|\s+$/g,'')}

	function pokaz_czesci(text, events)
	{
		if(events.which == 0 || events.which == 8)
			return false;
		/*//////////////*/
		/* KONFIKURACJA */
		/*//////////////*/
		/*
		# url -> Link do skryptu pobierającego dane z zewnętrznego żródła
		# id2 -> Identyfikator pola do wstawienia zawartości wybranego elementu
		# id1 -> Identyfikator pola zawierającego pobrane dane
		*/
		var conf = {'url' : 'rejestr/materialy.php', 'id1' : '#przyklady_czesci', 'id2' : '#czesci_wys'};


		var text1 = text.split(',\n');
		var dlugosc = text1.length;
		var dane = '';
		if(dlugosc == 1 && text != '')
			dane = text;
		else
			dane = text1[dlugosc-1];
		$.ajax
		({
			type: 'POST',
			url: conf['url'],
			data: 'q='+dane,
			success: function(dane)
			{
				$(conf['id1']).html(dane).ready
				(
					function()
					{
						$(document).click(function(){ $(conf['id1']).html('');});
						$('.wybor tr').hover
						(function()
						{
							$(this).css('background', '#c0c0c0');
							$(this).css('cursor', 'pointer');
						},
						function()
						{
							$(this).css('background', 'none');
							$(this).css('cursor', 'default');
						}
						);
						$('table.wybor td').click
						(function (){
							if(dlugosc > 1)
							{
								text1[dlugosc-1] = $(this).text().usun_spacje();
								text = text1.join(',\n');
							}
							else
								text = $(this).text().usun_spacje();
							$(conf['id2']).val(text+',\n').focus();
							$(conf['id1']).text('');
							});
						
					}
				);
			}
		});
	}
	function pokaz_kontrahenta(text, events)
	{
		if(events.which == 0 || events.which == 8)
			return false;
		/*//////////////*/
		/* KONFIKURACJA */
		/*//////////////*/
		/*
		# url -> Link do skryptu pobierającego dane z zewnętrznego żródła
		# id2 -> Identyfikator pola do wstawienia zawartości wybranego elementu
		# id1 -> Identyfikator pola zawierającego pobrane dane
		*/
		var conf = {'url' : 'rejestr/materialy.php', 'id1' : '#przyklady_zglaszajacy', 'id2' : '#zglaszajacy'};


		var dane = '';
		if(text != '')
			dane = text;
		$.ajax
		({
			type: 'POST',
			url: conf['url'],
			data: 'kontr=1&q='+dane,
			success: function(dane)
			{
				$(conf['id1']).html(dane).ready
				(
					function()
					{
						$(document).click(function(){ $(conf['id1']).html('');});
						$('.wybor tr').hover
						(function()
						{
							$(this).css('background', '#c0c0c0');
							$(this).css('cursor', 'pointer');
						},
						function()
						{
							$(this).css('background', 'none');
							$(this).css('cursor', 'default');
						}
						);
						$('table.wybor td').click
						(function (){							
							$(document).click('');
							$(conf['id2']).val($(this).children().text().usun_spacje());
							$('#kupujacy').val($(conf['id2']).val());
								});
						
					}
				);
			}
		});
	}