"use strict";

function getRowHtml() {
	return '	\
					<tr ofv_id = "" brandnew>\
						<td>\
							<select field="voc-codvoc" class="form-control">\
								<option disabled selected>...</option>\
							</select>\
						</td>\
						<td>\
							<input field="ofv-codart-agg" type="text" class="form-control" przLordo="">\
							<span field="lvo-tiposmu"></span>\
						</td>\
						<td>\
							<span field="voc-critcalc"></span>\
						</td> \
						<td>\
							<span field="voc-formula"></span>\
						</td>\
						<td>\
							<input qta field="ofv-quantita" type="text" class="form-control" placeholder="qta">\
							<input qta field="ofv-durata" type="text" class="form-control" placeholder="min">\
							<input qta field="ofv-lunghezza" type="text" class="form-control" placeholder="Lunghezza">\
							<input qta field="ofv-larghezza" type="text" class="form-control" placeholder="Larghezza">\
						</td>\
						<td>\
							<input field="ofv-valuni-cal" type="text" class="form-control">\
						</td>\
						<td style="width: 70px;">\
							<input field="ofv-sconto" type="text" class="form-control col-md-1">\
						</td>\
						<td>\
							<span field="ofv-valuni-fin"></span>\
						</td>\
						<td>\
							<span field="ofv-valtot-fin"></span>\
						</td>\
						<td style="width: 40px;">\
							<button field="btn-voci-delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>\
						</td>\
					</tr>\
	';
}

function init() {

	$("#header-offerta").show();
	$("#elenco-offerta").hide();
	$("#dettaglio-offerta").hide();
	$("#header-articolo").hide();
	$("#elenco-articolo").hide();
	$("#dettaglio-articolo").hide();	
	$("#header-voci").hide();
	$("#dettaglio-voci").hide();	
	
	$("#btn-articolo-elenco").hide();	
	$("#btn-offerta-elenco").hide();	
	
	//- Offerta
	
	$( "#btn-offerta-new" ).click(function() {
		//- Mostra il dettaglio 
		$("#elenco-offerta").hide();
		$("#dettaglio-offerta").show();
		$("#header-articolo").hide();
		$("#elenco-articolo").hide();
		$("#dettaglio-articolo").hide();	
		$("#header-voci").hide();
		$("#dettaglio-voci").hide();	
		
		//- Abilita campi e pulisce
		$("#dettaglio-offerta :input").prop("disabled", false);
		$("#dettaglio-offerta :input").val("");
		$("#btn-offerta-crea").show();
		
		//- Imposta la maschera di inserimento dati
		$( "#off-datains" ).datepicker()
		.datepicker( "setDate", new Date() )
		.datepicker( "option", "dateFormat", "dd/mm/yy" );
		
		$( "#off-dataeva" ).datepicker()
		.datepicker( "option", "dateFormat", "dd/mm/yy" );

		//- Carica i codici clienti
  	$.getJSON("data-viste.php?clienti")
		.done(function(data) {
				if (data.error) {
					alert("error");
				} else {
					
					var list_codcli = [];
					
					$.each( data, function( i, item ) {
						list_codcli.push({
							label: item.cli_codcli+" - "+item.cli_ragsoc,
							value: item.cli_codcli
						});
					});
					
					$( "#off-codcli" ).autocomplete({
      			source: list_codcli,
						select: function( event, ui ) {
							var selected_codcli = ui.item.value;
							
							var arr = $.grep(data, function( item ) {
  							return item.cli_codcli == selected_codcli;
							});
							
							$( "#off-ragsoc" ).val(arr[0].cli_ragsoc);
						}
    			});
				}					
		})
		.fail(function(data) {
		});	
		
	});
	
	$( "#btn-offerta-elenco" ).click(function() {
		$("#elenco-offerta").toggle();
	});

	$( "#btn-offerta-modifica" ).click(function() {
  	alert( "TBI-offerta-modifica" );
		//- Carica i dati dall'offerta selezionata
		
		//- Mostra l'elenco degli articoli collegati
		$("#elenco-offerta").hide();
		$("#dettaglio-offerta").show();
		$("#header-articolo").show();
		$("#elenco-articolo").show();
		$("#dettaglio-articolo").hide();	
		$("#header-voci").hide();
		$("#dettaglio-voci").hide();	
	});
	
	$( "#btn-offerta-crea" ).click(function(e) {
		e.preventDefault();
		
		//- Verifica i dati
		
		//- Crea una nuova offerta
		var getData = {};
		getData.insert      = true;
    getData.off_codcli  = $("#off-codcli").val();
    getData.off_datains = $("#off-datains").val();
		getData.off_dataeva = $("#off-dataeva").val();
		
		$.getJSON("data-offerta.php", getData)
		.done(function(data) {
			if (data.error) {
				alert("error");
			} else {
				//- Assegna il numoff
				$("#off-numoff").val(data[0].off_numoff);

				//- Disabilita i campi dell'offerta
				$("#dettaglio-offerta :input").prop("disabled", true);
				$( "#btn-offerta-crea" ).hide();

				//- Abilita la possibilità di inserire gli articoli
				$("#header-articolo").show();
			}
		})
		.fail(function(data) {
		});						

	});
	
	//- Articolo
	
  $( "#btn-articolo-new" ).click(function() {
		//- Mostra il dettaglio 
		$("#elenco-offerta").hide();
		$("#elenco-articolo").hide();
		$("#dettaglio-articolo").show();	
		$("#header-voci").hide();
		$("#dettaglio-voci").hide();	
		
		//- Abilita campi e pulisce
		$("#dettaglio-articolo :input").prop("disabled", false);
		$("#dettaglio-articolo :input").val("");
		$("#btn-articolo-inserisci").show();		
		$("#btn-articolo-aggiorna").hide();
		
		//- Carica gli articoli del cliente selezionato
		var getData = {};
		getData.articoliDelCliente = true;
    getData.codcli             = $("#off-codcli").val();
		
  	$.getJSON("data-viste.php", getData)
		.done(function(data) {
				if (data.error) {
					alert("error");
				} else {
					
					var list_codart = [];
					
					$.each( data, function( i, item ) {
						list_codart.push({
							label: item.art_codart+" - "+item.art_descart,
							value: item.art_codart
						});
					});
					
					$( "#ofa-codart" ).autocomplete({
      			source: list_codart,
						select: function( event, ui ) {
							var selected_codart = ui.item.value;
							
							var arr = $.grep(data, function( item ) {
  							return item.art_codart == selected_codart;
							});
							
							//- Mostra i dati dell'articolo
							$( "#ofa-descart" ).val(arr[0].art_descart);
							$( "#ofa-famiglia" ).val(arr[0].fam_descriz);
							$( "#ofa-spessore" ).val(arr[0].art_spessore);
							$( "#ofa-moltiplicatore" ).val(arr[0].lis_moltipl);
							$( "#ofa-scarto" ).val(arr[0].lis_scarto);
							$( "#ofa-oneri" ).val(arr[0].lis_oneriacc);
							$( "#ofa-unimis" ).val(arr[0].lis_unimis);
							$( "#ofa-przacq-net" ).val(arr[0].lis_przacq);
							
							//- Calcola il prezzo lordo
							var przLordo = 
									($( "#ofa-przacq-net" ).val() * $( "#ofa-moltiplicatore" ).val())
								+ ($( "#ofa-przacq-net" ).val() * $( "#ofa-oneri" ).val() / 100)
								+ ($( "#ofa-przacq-net" ).val() * $( "#ofa-scarto" ).val() / 100);
							$( "#ofa-przacq-lor" ).val(przLordo);
						}
    			});
				}					
		})
		.fail(function(data) {
		});			
	});
	
	$( "#btn-articolo-elenco" ).click(function() {
		$("#elenco-articolo").toggle();
	});

	$( "#btn-articolo-modifica" ).click(function() {
  	alert( "TBI-articolo-modifica" );
	});
	
	$( "#btn-articolo-delete" ).click(function() {
  	alert( "TBI-articolo-delete" );
	});
	
	$( "#btn-articolo-inserisci" ).click(function(e) {
		e.preventDefault();
		
		//- Verifica i dati
		
		//- Crea una nuova offerta
		var getData = {};
		getData.insert        = true;
    getData.ofa_numoff    = $("#off-numoff").val();
    getData.ofa_codart    = $("#ofa-codart").val();
		getData.ofa_lunghezza = $("#ofa-lunghezza").val();
		getData.ofa_larghezza = $("#ofa-larghezza").val();
		
		$.getJSON("data-offerta-articoli.php", getData)
		.done(function(data) {
			if (data.error) {
					alert("error");
				} else {		
					//- Disabilita i campi dell'articolo
					$("#ofa-codart").prop("disabled", true);
					$("#btn-articolo-inserisci").hide();
					$("#btn-articolo-aggiorna").show();

					//- Abilita la possibilità di inserire le voci di costo
					$("#header-voci").show();
					$("#dettaglio-voci").show();
				}
		})
		.fail(function(data) {
		});						
	});
	
	$( "#btn-articolo-aggiorna" ).click(function(e) {
		e.preventDefault();
		
		//- Verifica i dati
		
		//- Crea una nuova offerta
		var getData = {};
		getData.update        = true;
    getData.ofa_numoff    = $("#off-numoff").val();
    getData.ofa_codart    = $("#ofa-codart").val();
		getData.ofa_lunghezza = $("#ofa-lunghezza").val();
		getData.ofa_larghezza = $("#ofa-larghezza").val();
		
		$.getJSON("data-offerta-articoli.php", getData)
		.done(function(data) {
		})
		.fail(function(data) {
		});						
	});
	
	//- Voci
	
	$( "#btn-voci-new" ).click(function() {
		//- Aggiunge la nuova voce se l'ultima ha già assegnato un articolo
		
		//- Crea una nuova voce
		var getData = {};
		getData.insert        = true;
    getData.ofv_numoff    = $("#off-numoff").val();
    getData.ofv_codart    = $("#ofa-codart").val();
		
		$.getJSON("data-offerta-costi.php", getData)
		.done(function(data) {
				if (data.error) {
					alert("error");
				} else {
					//- Aggiunge una nuova riga nella tabella
					$("#table-voci-body").append(getRowHtml());
					
					//- Assegna l'id alla riga
					var ofv_id = data.id;
					
					$( "tr[brandnew]" )
					.attr( "ofv_id", ofv_id)
					.removeAttr("brandnew");
					
					//- Imposta gli elementi della riga
					var row  = $( 'tr[ofv_id="' + ofv_id + '"]');
											 
					//- Carica le voci
					var getData = {};
					getData.voci   = true;

					$.getJSON("data-viste.php", getData)
					.done(function(data) {
							if (data.error) {
								alert("error");
							} else {

								var arrVoci = data;
								
								//- Aggiorna l'elenco voci
								$.each( arrVoci, function( i, item ) {
									var opt = '<option value="'+item.voc_codvoce+'">'+item.voc_descriz+'</option>';
									row.find('[field="voc-codvoc"]').append(opt);
								});
								
								//- Nasconde i campi
								row.find('[field="ofv-codart-agg"]').hide();
								row.find("[qta]").hide();
								
								//- Gestisce la selezione di una voce
								row.find('[field="voc-codvoc"]').selectmenu({
  								change: function( event, ui ) {
										var selected_codvoce = ui.item.value;
										
										var arr = $.grep(arrVoci, function( item ) {
											return item.voc_codvoce == selected_codvoce;
										});

										row.find('[field="voc-codvoc"]')
											.selectmenu( "close" )
											.selectmenu( "disable" );
										
										//- Carica gli articoli aggiuntivi in base alla voce
										var getData = {};
										getData.articoliPerVoce = true;
										getData.codvoce         = selected_codvoce;
//											getData.codcli          = $("#off-codcli").val();											
//											getData.ofv_codart      = $("#ofa-codart").val();

										$.getJSON("data-viste.php", getData)
										.done(function(data) {
												if (data.error) {
													alert("error");
												} else {

													var list_codart = [];

													$.each( data, function( i, item ) {
														list_codart.push({
															label: item.art_codart+" - "+item.art_descart,
															value: item.art_codart
														});
													});
													
													//- Se ci sono articoli aggiuntivi, abilita la scelta
													row.find('[field="ofv-codart-agg"]').hide();
													if (list_codart.length > 0) {
														row.find('[field="ofv-codart-agg"]').show();
														row.find('[field="ofv-codart-agg"]').autocomplete({
															source: list_codart,
															select: function( event, ui ) {
																var selected_codart = ui.item.value;

																var arr = $.grep(data, function( item ) {
																	return item.art_codart == selected_codart;
																});
																
																//- Inserisce lo smusso
																if (arr[0].ivo_flagsmu == 's') {
																	row.find('[field="ivo_tiposmu"]').show();
																	row.find('[field="ivo_tiposmu"]').val(arr[0].ivo_flagsmu);
																}

																//- Calcola il prezzo lordo
																var przLordo = 
																		(arr[0].lis_przacq * arr[0].lis_moltipl)
																	+ (arr[0].lis_przacq * arr[0].lis_oneriacc / 100)
																	+ (arr[0].lis_przacq * arr[0].lis_scarto / 100);

																row.find('[field="ofv-codart-agg"]').attr("przLordo", przLordo);
															}
														});
													}													
												}
										})
										.fail(function(data) {
										});			
										
										var fieldFormula = row.find('[field="voc-formula"]');
										fieldFormula.text(arr[0].codice);
										fieldFormula.parent().prop('title', arr[0].formula);

										var critcalc = arr[0].voc_critcalc;
										row.find('[field="voc-critcalc"]').text(critcalc);

										//-...disabled=true
										row.find('[field="ofv-valuni-cal"]').prop("disabled", false);
										
										row.find("[qta]").hide();
										switch (critcalc){
											case "Q": 
												row.find('[field="ofv-quantita"]').show();
												break;
											case "T": 
												row.find('[field="ofv-durata"]').show();
												break;
											case "D": 
												row.find('[field="ofv-lunghezza"]').show();
												row.find('[field="ofv-larghezza"]').show();
												break;
											defaut:
												//- Inserimento manuale del prezzo
												row.find('[field="ofv-valuni-cal"]').prop("disabled", false);
										}
										
										row.find('[field="ofv-valuni-cal"]').val(10);
										row.find('[field="ofv-sconto"]').val(5);

										//-TODO: Carica lo sconto in base a codcli,codart,codvoc
									}
								});
								
								//- Cancella una voce
								row.find('[field="btn-voci-delete"]').click(function() {
									var getData = {};
									getData.delete = true;
    							getData.ofv_id = ofv_id;

									$.getJSON("data-offerta-costi.php", getData)
									.done(function(data) {
											if (data.error) {
												alert("error");
											} else {
												//- Rimuove la riga
												row.remove();
											}
									})
									.fail(function(data) {
									});														
								});
							}					
					})
					.fail(function(data) {
					});	
				}
		})
		.fail(function(data) {
		});						
	});
	
	$( "#btn-voci-ricalcola" ).click(function() {
		//- Scorre le voci
		var elencoVoci = $("#table-voci-body tr");
		
		var tot_prz = 0;
		var tot_prz_uni_fin = 0;
		var tot_prz_uni_tot = 0;
		
		//- Esegue i calcoli
		$.each( elencoVoci, function( i, row ) {
			var $row = $(row);
			
			var qta = 1*$row.find('[field="ofv-quantita"]').val();
			var prz = 1*$row.find('[field="ofv-valuni-cal"]').val();
			var sco = 1*$row.find('[field="ofv-sconto"]').val();

			var prz_uni_fin = prz*(1-(sco/100));
			var prz_tot_fin = prz_uni_fin * qta;
			
			$row.find('[field="ofv-valuni-fin"]').text(prz_uni_fin);
			$row.find('[field="ofv-valtot-fin"]').text(prz_tot_fin);
			
			tot_prz = tot_prz + prz;
			tot_prz_uni_fin = tot_prz_uni_fin + prz_uni_fin;
			tot_prz_uni_tot = tot_prz_uni_tot + prz_tot_fin;
		});
		
		//- Aggiorna i totali
		$("#valuni-cal").text(tot_prz);
		$("#valuni-fin").text(tot_prz_uni_fin);
		$("#valtot-fin").text(tot_prz_uni_tot);

		//- Update sul server
		var getData = {};
		getData.update          = true;
    getData.ofv_numoff      = $("#off-numoff").val();
		//- Dati dell'articolo
    getData.ofv_codart      = $("#ofa-codart").val();
		getData.ofa_totuni      = $("#valuni-cal").text();
		getData.ofa_totunit_fin = $("#valuni-fin").text();
		getData.ofa_totgen      = $("#valtot-fin").text();
		//- Dati delle voci
		getData.voci            = [];
		$.each( elencoVoci, function( i, row ) {
			var $row = $(row);

			var objVoce = {};
			objVoce.ofv_id         = $row.attr("ofv_id");
			objVoce.ofv_codvoce    = $row.find('[field="voc-codvoc"]').val();
			objVoce.ofv_quantita   = $row.find('[field="ofv-quantita"]').val();
			objVoce.ofv_lunghezza  = $row.find('[field="ofv-lunghezza"]').val();
			objVoce.ofv_larghezza  = $row.find('[field="ofv-larghezza"]').val();
			objVoce.ofv_durata     = $row.find('[field="ofv-durata"]').val();
			objVoce.ofv_przacq     = ""; //??serve
			objVoce.ofv_sconto     = $row.find('[field="ofv-sconto"]').val();
			objVoce.ofv_valuni_cal = $row.find('[field="ofv-valuni-cal"]').val();
			objVoce.ofv_valuni_fin = $row.find('[field="ofv-valuni-fin"]').text();
			objVoce.ofv_valtot_fin = $row.find('[field="ofv-valtot-fin"]').text();
			objVoce.ofv_codart_agg = $row.find('[field="ofv-codart-agg"]').val();
			objVoce.ofv_codart_agg_prz_lor = $row.find('[field="ofv-codart-agg"]').attr("przLordo");
			
			getData.voci.push(objVoce);
		});
		
		console.log(getData);
		
		$.post("data-offerta-costi.php", getData)
		.done(function(data) {
			//- TODO
			console.log("done");
			console.log(data);
		})
		.fail(function(data) {
			console.log("fail");
		});	

	});

	
}//init
