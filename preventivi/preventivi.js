"use strict";

function getRowElencoOfferte(stato) {
  if (stato == 0) {
    return ' \
					<tr numoff="">\
						<td></td>\
						<td></td>\
						<td></td>\
						<td></td>\
						<td></td>\
						<td>\
              <button field="btn-offerta-modifica" class="btn btn-success"><!--<span class="glyphicon glyphicon-edit"></span> - -->Modifica</button>\
						</td>\
            <td>\
              <button field="btn-offerta-delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>\
            </td>\
					</tr>\
    ';
  }
  else {
    return ' \
					<tr numoff="">\
						<td></td>\
						<td></td>\
						<td></td>\
						<td></td>\
						<td></td>\
						<td>\
              <button field="btn-offerta-visualizza" class="btn btn-success"><!--<span class="glyphicon glyphicon-eye-open"></span> - -->Visualizza</button>\
              <button field="btn-offerta-duplica" class="btn btn-success"><!--<span class="glyphicon glyphicon-retweet"></span> - -->Duplica</button>\
						</td>\
            <td>\
              <button field="btn-offerta-delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>\
            </td>\
					</tr>\
    ';
  }
}

function getRowHtml() {
	return '	\
					<tr ofv_id = "" brandnew  przunit="">\
						<td>\
							<select field="voc-codvoc" class="form-control">\
								<option disabled selected>...</option>\
							</select>\
						</td>\
						<td>\
							<input field="ofv-codart-agg" type="text" class="form-control" przLordo="">\
							<span field="lvo-tiposmu"></span>\
						</td>\
						<!--<td>\
							<span field="voc-critcalc"></span>\
						</td> \
						<td>\
							<span field="voc-formula"></span>\
						</td>-->\
						<td>\
							<div class="input-group width200">\
                <span qta field="label-quantita" class="input-group-addon">Qta</span>\
                <input qta field="ofv-quantita" type="text" class="form-control" placeholder="Qta">\
              </div>\
              <div class="input-group width200">\
							 <span qta field="label-durata" class="input-group-addon">Minuti</span>\
              <input qta field="ofv-durata" type="text" class="form-control" placeholder="Minuti">\
						  </div>\
              <div class="input-group width200">\
                <span qta field="label-lunghezza" class="input-group-addon">Lunghezza</span>\
                <input qta field="ofv-lunghezza" type="text" class="form-control" placeholder="Lunghezza">\
							</div>\
              <div class="input-group width200">\
                <span qta field="label-larghezza" class="input-group-addon">Larghezza</span>\
                <input qta field="ofv-larghezza" type="text" class="form-control" placeholder="Larghezza">\
              </div>\
              <div class="input-group width200">\
                <span qta field="label-spessore" class="input-group-addon">Spessore</span>\
                <input qta field="ofv-spessore" type="text" class="form-control" placeholder="Spessore">\
              </div>\
              <span field="costo"></span>\
            </td>\
						<td style="width: 160px;">\
							<input field="ofv-valuni-cal" type="text" class="form-control text-right pull-right">\
						</td>\
						<td style="width: 80px;">\
							<input field="ofv-sconto" type="text" class="form-control col-md-1 text-right pull-right">\
						</td>\
						<td class="text-right">\
							<span field="ofv-valuni-fin"></span>\
						</td>\
						<td class="text-right">\
							<span field="ofv-valtot-fin"></span>\
						</td>\
						<td style="width: 40px;">\
							<button field="btn-voci-delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>\
						</td>\
					</tr>\
	';
}

function getNumericOptions(what) {
  var opt = { aSep: '.', aDec: ',' };
  
  switch (what) {
  case "currency": 
    opt.vMin = '0.00';
    opt.vMax = '9999999.99';
    break;
  case "currency6.5": 
    opt.vMin = '0.00000';
    opt.vMax = '999999.99999';
    break;      
  case "decimal": 
    opt.vMin = '0.0';
    opt.vMax = '999999.9';
    break;
  case "sconto": 
    opt.vMin = '0.00';
    opt.vMax = '99.99';
    opt.wEmpty = 'zero';
    break;
  case "qta": 
    opt.vMin = '1';
    opt.vMax = '99999';
    opt.wEmpty = 'zero';
    break;
  case "integer4": 
    opt.vMin = '0';
    opt.vMax = '9999';
    break;			
  case "integer12": 
    opt.vMin = '0';
    opt.vMax = '999999999999';
    break;
  }  
  
  return opt;
}

function getSpessoriPrecedenti(row) {
  //- Calcola gli spessori precedenti alla 'num_riga_voce'
  var spessori = 0;
  var num_riga_voce = row.attr( "num_riga_voce" );
  
  var elencoVoci = $("#table-voci-body tr");
  $.each( elencoVoci, function( i, row ) {
    var $row = $(row);

    if ($row.attr( "num_riga_voce" ) < num_riga_voce) {
      spessori += (1 * $row.find('[field="ofv-spessore"]').autoNumeric('get'));
    }
  });

  return spessori;
}

function applyFormula(row) {
  var formula = row.attr('voc-formula');
  var valuni = 0;
  
  var costo = row.attr("przunit");
  var przlordo = $( "#ofa-przacq-lor" ).autoNumeric('get');
  var lun = $( "#ofa-lunghezza" ).autoNumeric('get');
  var lar = $( "#ofa-larghezza" ).autoNumeric('get');
  var qta = row.find('[field="ofv-quantita"]').autoNumeric('get');      
  var dur = row.find('[field="ofv-durata"]').autoNumeric('get');

  var spe = row.find('[field="ofv-spessore"]').autoNumeric('get');
  var smusso = row.find('[field="ofv-codart-agg"]').attr("smusso");
  var przRivest = row.find('[field="ofv-codart-agg"]').attr("przLordo");

  switch (formula) {
  case "1": //-ARTICOLO (non usato)
    valuni = przlordo;
    break;
  case "2": //-ARTICOLO (non usato)
    valuni = przlordo * (lun/1000) * (lar/1000);
    break;
  case "3": //-MANODOPERA
    valuni = costo * dur;
    break;
  case "4": //-RIVESTIMENTO (primo e successivi)
    var spePrec = getSpessoriPrecedenti(row);
    valuni = ((lun / 3.14) + (2 * spePrec) + (spe * 3.14) + (1 * smusso)) * przRivest;
    break;
  case "5": //-RIVESTIMENTO SUCCESSIVO (non usato)
    break;
  case "6": //-GIUNZIONE
    valuni = costo * lar;
    break;
  case "7": //-GUIDA
    valuni = costo * lun;  
    break;
  }

  row.find('[field="ofv-valuni-cal"]').autoNumeric('set', valuni);
}

function loadElencoOfferte(stato) {
  //- Carica l'elenco delle offerte
  var getData = {};
  getData.off_stato = stato;

  $.getJSON("data-offerta.php", getData)
  .done(function(data) {
    if (data.error) {
      alert(data.error);
    } else {

      $("#pager-offerta").pagination({
        items: data.length,
        itemsOnPage: 10,
        cssStyle: 'light-theme',
        prevText: '<',
        nextText: '>',
        onPageClick: function(pageNumber,event) {
          var start_i = 10 * (pageNumber - 1);
          var end_i = (10 * pageNumber) - 1;
          showElencoOfferte(start_i, end_i, data, stato);
        }
      });
      
      $("#pager-offerta").pagination('selectPage', 1);
    }
  })
  .fail(function(data) {
  });						
}

function loadDettaglioOfferta(numoff, readonly) {
  $("#header-offerta").show();
  $("#elenco-offerta").hide();
  $("#dettaglio-offerta").show();

  if (readonly) {
    //- Disabilita i campi dell'offerta
    $("#dettaglio-offerta :input").prop("disabled", true);
    $( "#btn-offerta-crea" ).hide();
    $( "#btn-offerta-aggiorna" ).hide();
  }
  else {
    //- Abilita alcuni campi dell'offerta
    $("#dettaglio-offerta :input").prop("disabled", false);
    $("#off-numoff").prop("disabled", true);
    $( "#btn-offerta-crea" ).hide();
  }
  
  var getData = {};
  getData.select_one  = true;
  getData.off_numoff  = numoff;

  $.getJSON("data-offerta.php", getData)
  .done(function(data) {
    if (data.error) {
      alert(data.error);
    } else {
      var d = "";

      //- Imposta i campi dell'offerta
      $("#off-numoff").val(numoff);          
      $("#off-codcli").val(data[0].off_codcli);
      $("#off-ragsoc").val(data[0].cli_ragsoc);

      d = "";
      if (data[0].off_datains != null) {
        d = new Date(data[0].off_datains);
      }
      $( "#off-datains" ).datepicker()
      .datepicker( "setDate", d)
      .datepicker( "option", "dateFormat", "dd/mm/yy" );

      d = "";
      if (data[0].off_dataeva != null) {
        d = new Date(data[0].off_dataeva);
      }
      $( "#off-dataeva" ).datepicker()
      .datepicker( "setDate", d )
      .datepicker( "option", "dateFormat", "dd/mm/yy" );
			
			$( "#off-gg-termine-consegna" ).autoNumeric('init', getNumericOptions("integer4"));
			$( "#off-gg-termine-consegna" ).autoNumeric('set', data[0].off_gg);
    }
    
    loadDettaglioArticolo(numoff, readonly);
  })
  .fail(function(data) {
  });						
}

function loadDettaglioArticolo(numoff, readonly) {
  $("#header-articolo").show();
  $("#elenco-articolo").hide();
  $("#dettaglio-articolo").show();	

  if (readonly) {
    //- Disabilita i campi dell'articolo
    $("#dettaglio-articolo .form-control").prop("disabled", true);
    $("#btn-articolo-new").hide();
    $("#btn-articolo-elenco").hide();
    $("#btn-articolo-inserisci").hide();
    $("#btn-articolo-aggiorna").hide();
  }
  else {
    //- Abilita alcuni campi dell'articolo
    $("#dettaglio-articolo .form-control").prop("disabled", false);
    $("#ofa-codart").prop("disabled", true);
    $("#btn-articolo-new").hide();
    $("#btn-articolo-elenco").hide();
    $("#btn-articolo-inserisci").hide();
    $("#btn-articolo-aggiorna").show(); 
  }
  
  var getData = {};
  getData.select_one  = true;
  getData.ofa_numoff  = numoff;

  $.getJSON("data-offerta-articoli.php", getData)
  .done(function(data) {
    if (data.error) {
      alert(data.error);
    } else {
      $( "#ofa-przacq-net" ).autoNumeric('init', getNumericOptions("currency6.5"));
      $( "#ofa-przacq-lor" ).autoNumeric('init', getNumericOptions("currency6.5"));
      $( "#ofa-lunghezza" ).autoNumeric('init', getNumericOptions("decimal"));
      $( "#ofa-larghezza" ).autoNumeric('init', getNumericOptions("decimal"));          
      $( "#ofa-lungsmu" ).autoNumeric('init', getNumericOptions("decimal"));          
      $( "#ofa-quantita" ).autoNumeric('init', getNumericOptions("qta"));

      //- Imposta i campi dell'articolo
      $("#ofa-codart").prop("disabled", true);

      $( "#ofa-codart" ).val(data[0].ofa_codart);
      $( "#ofa-descart" ).val(data[0].ofa_descart);
      $( "#ofa-famiglia" ).val(data[0].fam_descriz);
      $( "#ofa-moltiplicatore" ).val(data[0].ofa_moltipl);
      $( "#ofa-scarto" ).val(data[0].ofa_scarto);
      $( "#ofa-oneri" ).val(data[0].ofa_oneriacc);

      $( "#ofa-unimis option" ).each(function(i, item) {
        $(this).attr("selected","false");

        if ($(this).val() == data[0].ofa_unimis) {
          $(this).attr("selected","selected");              
        }
      });                        

      $( "#ofa-przacq-net" ).autoNumeric('set', data[0].ofa_przacq_net);
      $( "#ofa-przacq-lor" ).autoNumeric('set', data[0].ofa_przacq_lor);
      $( "#ofa-lunghezza" ).autoNumeric('set', data[0].ofa_lunghezza);
      $( "#ofa-larghezza" ).autoNumeric('set', data[0].ofa_larghezza);
      $( "#ofa-lungsmu" ).autoNumeric('set', data[0].ofa_lungsmu);
      $( "#ofa-quantita" ).autoNumeric('set', data[0].ofa_quantita);

      loadDettaglioVoci(numoff, data[0].ofa_codart, readonly)
    }
  })
  .fail(function(data) {
  });						
}
                            
function loadDettaglioVoci(numoff, codart, readonly) {
  $("#header-voci").show();
  $("#dettaglio-voci").show();
  $("#footer-voci").show();

  //- Imposta il formato dei totali
  $("#valuni-cal").autoNumeric('init', getNumericOptions("currency"));
  $("#valuni-cal").autoNumeric('set', "");
  $("#valuni-fin").autoNumeric('init', getNumericOptions("currency"));
  $("#valuni-fin").autoNumeric('set', "");
  $("#valtot-fin").autoNumeric('init', getNumericOptions("currency"));
  $("#valtot-fin").autoNumeric('set', "");

  //- Rimuove tutte le righe diversa dalla prima
  $( "tbody tr[num_riga_voce!='1']" ).remove();

  var getData = {};
  getData.ofv_numoff = numoff;
  getData.ofv_codart = codart;

  $.getJSON("data-offerta-costi.php", getData)
  .done(function(data) {
      if (data.error) {
        alert(data.error);
      } else {

        $.each( data, function( i, item ) {

          var row;

          if (item.ofv_num_riga_voce == 1) {
            row = $( "tr[num_riga_voce='1']" );
          }
          else {
            //- Aggiunge una nuova riga nella tabella
            $("#table-voci-body").append(getRowHtml());
            $("#table-voci-body").attr( "max_num_riga_voce", item.ofv_num_riga_voce );

            row = $( "tr[brandnew]" );

            row.attr( "num_riga_voce", item.ofv_num_riga_voce );
            row.removeAttr("brandnew");
            
            //- Aggiorna la voce
            row.find('[field="voc-codvoc"]').selectmenu();
            var opt = '<option value="'+item.ofv_codvoce+'">'+item.ofv_descriz+'</option>';
            row.find('[field="voc-codvoc"]').append(opt);
            row.find('[field="voc-codvoc"]').val(item.ofv_codvoce);
            row.find('[field="voc-codvoc"]').selectmenu( "refresh" );
            
            //- Disabilita la combo
            row.find('[field="voc-codvoc"]')
              .selectmenu( "close" )
              .selectmenu( "disable" );	
          }

          //- Assegna l'id alla riga
          var ofv_id = item.id;					
          row.attr( "ofv_id", ofv_id);

          //- Nasconde i campi
          row.find('[field="ofv-codart-agg"]').hide();
          row.find("[qta]").hide();

          //- Mostra i campi
          row.find('[field="ofv-valuni-cal"]').show();
          row.find('[field="ofv-sconto"]').show();

          //- Imposta il formato
          row.find('[field="ofv-quantita"]').autoNumeric('init', getNumericOptions("integer12"));
          row.find('[field="ofv-durata"]').autoNumeric('init', getNumericOptions("integer12"));
          row.find('[field="ofv-lunghezza"]').autoNumeric('init', getNumericOptions("decimal"));
          row.find('[field="ofv-larghezza"]').autoNumeric('init', getNumericOptions("decimal"));
          row.find('[field="ofv-spessore"]').autoNumeric('init', getNumericOptions("decimal"));
          row.find('[field="ofv-valuni-cal"]').autoNumeric('init', getNumericOptions("currency"));
          row.find('[field="ofv-sconto"]').autoNumeric('init', getNumericOptions("sconto"));              
          row.find('[field="ofv-valuni-fin"]').autoNumeric('init', getNumericOptions("currency"));        
          row.find('[field="ofv-valtot-fin"]').autoNumeric('init', getNumericOptions("currency"));

          //- Imposta i valori
          row.find('[field="ofv-quantita"]').autoNumeric('set', item.ofv_quantita);
          row.find('[field="ofv-durata"]').autoNumeric('set', item.ofv_durata);
          row.find('[field="ofv-lunghezza"]').autoNumeric('set', item.ofv_lunghezza);
          row.find('[field="ofv-larghezza"]').autoNumeric('set', item.ofv_larghezza);
          row.find('[field="ofv-spessore"]').autoNumeric('set', item.ofv_spessore);
          row.find('[field="ofv-valuni-cal"]').autoNumeric('set', item.ofv_valuni_cal);
          row.find('[field="ofv-sconto"]').autoNumeric('set', item.ofv_sconto);
          row.find('[field="ofv-valuni-fin"]').autoNumeric('set', item.ofv_valuni_fin);
          row.find('[field="ofv-valtot-fin"]').autoNumeric('set', item.ofv_valtot_fin);

          row.attr('descriz', item.ofv_descriz);
          row.attr('critcalc', item.ofv_critcalc);
          row.attr('voc-formula', item.ofv_formula);
          row.find("td").first().tooltip();
          row.find("td").first().prop('title', item.ofv_desc_formula);

          switch (item.ofv_critcalc) {
            case "Q": 
              row.find('[field="ofv-quantita"]').show();
              row.find('[field="label-quantita"]').show();
              break;
            case "T": 
              row.find('[field="ofv-durata"]').show();
              row.find('[field="label-durata"]').show();
              break;
            case "D": 
              row.find('[field="ofv-lunghezza"]').show();
              row.find('[field="ofv-larghezza"]').show();
              row.find('[field="label-lunghezza"]').show();
              row.find('[field="label-larghezza"]').show();
              break;
            case "S": 
              row.find('[field="ofv-spessore"]').show();
              row.find('[field="label-spessore"]').show();
              break;
          }

          //- Carica i dati aggiuntivi in base alla formula
          switch (""+item.ofv_formula) {
          case "3": //-MANODOPERA
          case "6": //-GIUNZIONE
          case "7": //-GUIDA 
            row.attr('przunit', item.ofv_costo);
            row.find('[field="costo"]').text("Costo: "+item.ofv_costo);
            break;
          case "4": //-RIVESTIMENTO (primo e successivi)
            row.find('[field="ofv-codart-agg"]').show();
            row.find('[field="ofv-codart-agg"]').prop("disabled", true);
            row.find('[field="ofv-codart-agg"]').val(item.ofv_codart_agg);
            row.find('[field="ofv-codart-agg"]').attr("przLordo", item.ofv_codart_agg_prz_lor);
            row.find('[field="ofv-codart-agg"]').attr("smusso", item.ofv_dimSmusso);

            row.find('[field="ofv-codart-agg"]').attr("desc1", item.ofv_desc1);
            row.find('[field="ofv-codart-agg"]').attr("desc2", item.ofv_desc2);
            row.find('[field="ofv-codart-agg"]').attr("desc3", item.ofv_desc3);
            row.find('[field="costo"]').html(item.ofv_desc1 + "<br>" + item.ofv_desc2 + "<br>" + item.ofv_desc3);
            break;
          }

          //- Gestisce il cambio valore di qta/lun/lar/spe/dur
          row.find('[field="ofv-quantita"]').keyup(function() {
            applyFormula(row); 
          });
          row.find('[field="ofv-lunghezza"]').keyup(function() {
            applyFormula(row); 
          });
          row.find('[field="ofv-larghezza"]').keyup(function() {
            applyFormula(row); 
          });
          row.find('[field="ofv-spessore"]').keyup(function() {
            applyFormula(row); 
          });
          row.find('[field="ofv-durata"]').keyup(function() {
            applyFormula(row);
          });

          //- Cancella una voce
          row.find('[field="btn-voci-delete"]').click(function() {
            var getData = {};
            getData.delete = true;
            getData.ofv_id = ofv_id;

            $.getJSON("data-offerta-costi.php", getData)
            .done(function(data) {
                if (data.error) {
                  alert(data.error);
                } else {
                  //- Rimuove la riga
                  row.remove();
                }
            })
            .fail(function(data) {
            });														
          });
        });

        if (readonly) {
          //- Disabilita i campi delle voci
          $("#dettaglio-voci .form-control").prop("disabled", true);
          $('#dettaglio-voci [field="btn-voci-delete"]').hide();
          $("#btn-voci-new").hide();
          $("#btn-voci-ricalcola").hide();
					$("#btn-voci-salva").hide();  
          $("#btn-voci-consolida").hide();  
        }
        else {
          //- Abilita i campi delle voci
          $("#dettaglio-voci .form-control").prop("disabled", false);
          $('#dettaglio-voci [field="btn-voci-delete"]').show();
          $("#btn-voci-new").show();
          $("#btn-voci-ricalcola").show();
					$("#btn-voci-salva").show();
          $("#btn-voci-consolida").show();  
        }
        
        //- Ricalcola
        $( "#btn-voci-ricalcola" ).trigger( "click" );
      }     
  })
  .fail(function(data) {
  });  
}

function showElencoOfferte(start_i, end_i, data, stato) {
  var row;
  
  $("#table-offerta tbody").empty();

  $.each( data, function( i, item ) {
    if (i < start_i) {
      return true; //continue
    }
    if (i > end_i) {
      return false; //break
    }

    $("#table-offerta tbody").append(getRowElencoOfferte(stato));

    row = $( "#table-offerta tbody tr:last-child" );
    row.attr( "numoff", item.off_numoff );

    var d = new Date(item.off_datains.substring(0,10));
    //var d = new Date(item.off_datains);

    row.find("td:nth-child(1)").text(item.off_numoff);
    row.find("td:nth-child(2)").text(d.toLocaleDateString());
    row.find("td:nth-child(3)").text(item.off_codcli);
    row.find("td:nth-child(4)").text(item.cli_ragsoc);
    row.find("td:nth-child(5)").autoNumeric('init', getNumericOptions("currency"));
    row.find("td:nth-child(5)").autoNumeric('set', item.totgen);

    //-
    //- Gestisce pulsante Modifica
    //-
    row.find('[field="btn-offerta-modifica"]').click(function() {
      loadDettaglioOfferta(item.off_numoff, false);
      $( "#btn-offerta-aggiorna" ).hide();
    });

    //-
    //- Gestisce pulsante Visualizza
    //-
    row.find('[field="btn-offerta-visualizza"]').click(function() {
      loadDettaglioOfferta(item.off_numoff, true);
      $( "#btn-offerta-aggiorna" ).hide();
    });

    //-
    //- Gestisce pulsante Duplica
    //-
    row.find('[field="btn-offerta-duplica"]').click(function() {
      //- Crea una nuova offerta
      var getData = {};
      getData.clone       = true;
      getData.off_numoff  = item.off_numoff;
		
      $.getJSON("data-offerta.php", getData)
      .done(function(data) {
        if (data.error) {
          alert(data.error);
        } else {
          //- Mostra i dettagli
          loadDettaglioOfferta(data[0].off_numoff, false);
          $( "#btn-offerta-aggiorna" ).show();
          
          //- Abilita l'header offerta per l'eventuale cambio di cliente
          $("#dettaglio-offerta :input").prop("disabled", false);
          
          loadCodiciClientiPerOfferta();
        }
      })
      .fail(function(data) {
      });						
      
    });
    
    //-
    //- Gestisce pulsante Cancella
    //-
    row.find('[field="btn-offerta-delete"]').click(function() {
      $( "#dialog-confirm span[msg]" ).text("L'offerta " + item.off_numoff + " verra' cancellata. Confermi ?");
      
      $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:200,
        modal: true,
        title: "Cancellazione",
        dialogClass: "no-close",
        buttons: {
          "Si": function() {
            $( this ).dialog( "close" );
            
            //- Elimina l'offerta
            var getData = {};
            getData.delete_logic = true;
            getData.off_numoff   = item.off_numoff;

            $.getJSON("data-offerta.php", getData)
            .done(function(data) {
              if (data.error) {
                alert(data.error);
              } else {
                //- Ricarica l'elenco
                loadElencoOfferte(stato);
              }
            })
            .fail(function(data) {
            });				
          },
          "No": function() {
            $( this ).dialog( "close" );
          }
        }
      });
    });
  });
}

function loadCodiciClientiPerOfferta() {
  //- Carica i codici clienti
  $.getJSON("data-viste.php?clienti")
  .done(function(data) {
      if (data.error) {
        alert(data.error);
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

          //- Permette la scelta solo tra le voci dell'elenco
          change: function (event, ui) {
            if (!ui.item) {
              $(this).val('');
              $( "#off-ragsoc" ).val('');
            }
          },

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
  $("#footer-voci").hide();
	
  $("#btn-offerta-elenco").show();	
  $("#btn-offerta-completate").show();	
  
  $("#btn-articolo-new").hide();	
	$("#btn-articolo-elenco").hide();	
	
  //---------------------------------------
	//- Offerta
  //---------------------------------------
	
	$( "#btn-offerta-new" ).click(function() {
		//- Mostra il dettaglio 
		$("#elenco-offerta").hide();
    $("#pager-offerta").hide();
		$("#dettaglio-offerta").show();
		$("#header-articolo").hide();
		$("#elenco-articolo").hide();
		$("#dettaglio-articolo").hide();	
		$("#header-voci").hide();
		$("#dettaglio-voci").hide();	
    $("#footer-voci").hide();
		
		//- Abilita campi e pulisce
		$("#dettaglio-offerta :input").prop("disabled", false);
		$("#dettaglio-offerta :input").val("");
		$("#btn-offerta-crea").show();
    $("#btn-offerta-aggiorna").hide();
		
		//- Imposta la maschera di inserimento dati
		$( "#off-datains" ).datepicker()
		.datepicker( "setDate", new Date() )
		.datepicker( "option", "dateFormat", "dd/mm/yy" );
		
		$( "#off-gg-termine-consegna" ).autoNumeric('init', getNumericOptions("integer4"));
		$( "#off-gg-termine-consegna" ).autoNumeric('set', 0);
		
		$( "#off-dataeva" ).datepicker()
		.datepicker( "option", "dateFormat", "dd/mm/yy" );

    loadCodiciClientiPerOfferta();		
	});
	
  $( "#btn-offerta-elenco" ).click(function() {
		if ($("#elenco-offerta").is(":visible")) {
      $("#elenco-offerta").hide();
      $("#pager-offerta").hide();  
    }
    else {
      $("#elenco-offerta").show();
      $("#pager-offerta").show();  
      
      $("#dettaglio-offerta").hide();

      $("#header-articolo").hide();
      $("#elenco-articolo").hide();
      $("#dettaglio-articolo").hide();	

      $("#header-voci").hide();
      $("#dettaglio-voci").hide();	
      $("#footer-voci").hide();
	
      $("#btn-articolo-elenco").hide();
    }
    
    loadElencoOfferte(0);    
	});

  $( "#btn-offerta-completate" ).click(function() {
		if ($("#elenco-offerta").is(":visible")) {
      $("#elenco-offerta").hide();
      $("#pager-offerta").hide();  
    }
    else {
      $("#elenco-offerta").show();
      $("#pager-offerta").show();  
      
      $("#dettaglio-offerta").hide();

      $("#header-articolo").hide();
      $("#elenco-articolo").hide();
      $("#dettaglio-articolo").hide();	

      $("#header-voci").hide();
      $("#dettaglio-voci").hide();	
      $("#footer-voci").hide();
	
      $("#btn-articolo-elenco").hide();
    }
    
    loadElencoOfferte(1);    
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
    $("#footer-voci").hide();
	});
	
	$( "#btn-offerta-crea" ).click(function(e) {
		e.preventDefault();
		
		//- Verifica i dati
    var codcli = $( "#off-codcli" ).val();
		if (_.isUndefined(codcli) || (codcli == "")) {
      alert('Scegli un codice cliente.');
      return;
    }
    
		//- Calcola la data di evasione
		var gg = $("#off-gg-termine-consegna").autoNumeric('get');
		var d1  = $("#off-datains").datepicker("getDate");
		var d2  = new Date();
		d2.setTime( d1.getTime() + gg * 86400000 );
		
		$( "#off-dataeva" ).datepicker( "setDate", d2 );

		//- Crea una nuova offerta
		var getData = {};
		getData.insert      = true;
    getData.off_codcli  = $("#off-codcli").val();
    getData.off_datains = $("#off-datains").val();
		getData.off_gg      = gg;
		getData.off_dataeva = $("#off-dataeva").val();
		
		$.getJSON("data-offerta.php", getData)
		.done(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//- Assegna il numoff
				$("#off-numoff").val(data[0].off_numoff);

				//- Disabilita i campi dell'offerta
				$("#dettaglio-offerta :input").prop("disabled", true);
				$( "#btn-offerta-crea" ).hide();

				//- Abilita la possibilità di inserire gli articoli
				$("#header-articolo").show();
        
        //- Crea un nuovo articolo
        $("#btn-articolo-new").trigger( "click" );
			}
		})
		.fail(function(data) {
		});						

	});
	
  $( "#btn-offerta-aggiorna" ).click(function(e) {
		e.preventDefault();
		
		//- Verifica i dati
    var codcli = $( "#off-codcli" ).val();
		if (_.isUndefined(codcli) || (codcli == "")) {
      alert('Scegli un codice cliente.');
      return;
    }
    
		//- Aggiorna l'offerta
		var getData = {};
		getData.update      = true;
    getData.off_numoff  = $("#off-numoff").val();
    getData.off_codcli  = $("#off-codcli").val();
    getData.off_datains = $("#off-datains").val();
		getData.off_dataeva = $("#off-dataeva").val();
		
		$.getJSON("data-offerta.php", getData)
		.done(function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				//- Disabilita i campi dell'offerta
				//$("#dettaglio-offerta :input").prop("disabled", true);
				//$( "#btn-offerta-crea" ).hide();
			}
		})
		.fail(function(data) {
		});						

	});
  
  //---------------------------------------
	//- Articolo
  //---------------------------------------
	
  $( "#btn-articolo-new" ).click(function() {
		//- Mostra il dettaglio 
		$("#elenco-offerta").hide();
    $("#pager-offerta").hide();
		$("#elenco-articolo").hide();
		$("#dettaglio-articolo").show();	
		$("#header-voci").hide();
		$("#dettaglio-voci").hide();	
    $("#footer-voci").hide();
		
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
					alert(data.error);
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
            
            //- Permette la scelta solo tra le voci dell'elenco
            change: function (event, ui) {
              if (!ui.item) {
                $(this).val('');
                $( "#ofa-descart" ).val('');
                $( "#ofa-famiglia" ).val('');
                $( "#ofa-moltiplicatore" ).val('');
                $( "#ofa-scarto" ).val('');
                $( "#ofa-oneri" ).val('');
                $( "#ofa-przacq-net" ).autoNumeric('set', "");
                $( "#ofa-przacq-lor" ).autoNumeric('set', "");
                $( "#ofa-lunghezza" ).autoNumeric('set', "");
                $( "#ofa-larghezza" ).autoNumeric('set', "");         
                $( "#ofa-lungsmu" ).autoNumeric('set', "");    
                $( "#ofa-quantita" ).autoNumeric('set', 1);
              }
            },

						select: function( event, ui ) {
							var selected_codart = ui.item.value;
							
							var arr = $.grep(data, function( item ) {
  							return item.art_codart == selected_codart;
							});
							
							//- Mostra i dati dell'articolo
							$( "#ofa-descart" ).val(arr[0].art_descart);
							$( "#ofa-famiglia" ).val(arr[0].fam_descriz);
							$( "#ofa-moltiplicatore" ).val(arr[0].lis_moltipl);
							$( "#ofa-scarto" ).val(arr[0].lis_scarto);
							$( "#ofa-oneri" ).val(arr[0].lis_oneriacc);

              $( "#ofa-unimis option" ).each(function(i, item) {
                $(this).attr("selected","false");
                
                if ($(this).val() == arr[0].lis_unimis) {
                  $(this).attr("selected","selected");              
                }
              });                        
              
              $( "#ofa-przacq-net" ).autoNumeric('set', arr[0].lis_przacq);
              
							//- Calcola il prezzo lordo
              var przNetto = $( "#ofa-przacq-net" ).autoNumeric('get');
              
							var przLordo = 
									(przNetto * $( "#ofa-moltiplicatore" ).val())
								+ (przNetto * $( "#ofa-oneri" ).val() / 100)
								+ (przNetto * $( "#ofa-scarto" ).val() / 100);
							
              $( "#ofa-przacq-lor" ).autoNumeric('set', przLordo);
              
              $( "#ofa-lunghezza" ).autoNumeric('set', "");
              $( "#ofa-larghezza" ).autoNumeric('set', "");         
              $( "#ofa-lungsmu" ).autoNumeric('set', "");    
              $( "#ofa-quantita" ).autoNumeric('set', 1);
						}
    			});

          //- Imposta i campi
          $( "#ofa-przacq-net" ).autoNumeric('init', getNumericOptions("currency6.5"));
          $( "#ofa-przacq-lor" ).autoNumeric('init', getNumericOptions("currency6.5"));
          $( "#ofa-lunghezza" ).autoNumeric('init', getNumericOptions("decimal"));
          $( "#ofa-larghezza" ).autoNumeric('init', getNumericOptions("decimal"));          
          $( "#ofa-lungsmu" ).autoNumeric('init', getNumericOptions("decimal"));          
          $( "#ofa-quantita" ).autoNumeric('init', getNumericOptions("qta"));
          $( "#ofa-quantita" ).autoNumeric('set', 1);
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
    var codart = $( "#ofa-codart" ).val();
		if (_.isUndefined(codart) || (codart == "")) {
      alert('Scegli un codice articolo.');
      return;
    }
		
		//- Crea una nuova offerta
		var getData = {};
		getData.insert         = true;
    getData.ofa_numoff     = $("#off-numoff").val();
    getData.ofa_codart     = $("#ofa-codart").val();
    getData.ofa_descart    = $("#ofa-descart").val();
    getData.ofa_unimis     = $("#ofa-unimis").val();
    getData.ofa_moltipl    = $("#ofa-moltiplicatore").val();
    getData.ofa_scarto     = $("#ofa-scarto").val();
    getData.ofa_oneriacc   = $("#ofa-oneri").val();
    getData.ofa_przacq_net = $("#ofa-przacq-net").autoNumeric('get');
    getData.ofa_przacq_lor = $("#ofa-przacq-lor").autoNumeric('get');
		getData.ofa_lunghezza  = $("#ofa-lunghezza").autoNumeric('get');
		getData.ofa_larghezza  = $("#ofa-larghezza").autoNumeric('get');
    getData.ofa_lungsmu    = $("#ofa-lungsmu").autoNumeric('get');
    getData.ofa_quantita   = $("#ofa-quantita").autoNumeric('get');
		
    console.log(getData);
    
		$.getJSON("data-offerta-articoli.php", getData)
		.done(function(data) {
			if (data.error) {
					alert(data.error);
				} else {		
					//- Disabilita i campi dell'articolo
					$("#ofa-codart").prop("disabled", true);
					$("#btn-articolo-inserisci").hide();
					$("#btn-articolo-aggiorna").show();

					//- Abilita la possibilità di inserire le voci di costo
					$("#header-voci").show();
					$("#dettaglio-voci").show();
          $("#footer-voci").show();
					$("#btn-voci-new").show();
        	$("#btn-voci-ricalcola").show();
					$("#btn-voci-salva").show();
        	$("#btn-voci-consolida").show();  
          
          //- Imposta il formato dei totali
          $("#valuni-cal").autoNumeric('init', getNumericOptions("currency"));
          $("#valuni-cal").autoNumeric('set', "");
          $("#valuni-fin").autoNumeric('init', getNumericOptions("currency"));
          $("#valuni-fin").autoNumeric('set', "");
          $("#valtot-fin").autoNumeric('init', getNumericOptions("currency"));
          $("#valtot-fin").autoNumeric('set', "");
          
          //- Rimuove tutte le righe diversa dalla prima
          $( "tbody tr[num_riga_voce!='1']" ).remove();
          
          //- Inserisce la voce associata all' ARTICOLO (num_riga_voce == 1) (cod-voce == 1)
          var getData = {};
          getData.insertArticolo = true;
          getData.ofv_numoff     = $("#off-numoff").val();
          getData.ofv_codart     = $("#ofa-codart").val();

          $.getJSON("data-offerta-costi.php", getData)
          .done(function(data) {
              if (data.error) {
                alert(data.error);
              } else {

                var row = $( "tr[num_riga_voce='1']" );

                //- Assegna l'id alla riga
                var ofv_id = data.id;					
                row.attr( "ofv_id", ofv_id);

                //- Nasconde i campi
                row.find('[field="ofv-codart-agg"]').hide();
                row.find("[qta]").hide();

                //- Mostra i campi
                row.find('[field="ofv-valuni-cal"]').show();
                row.find('[field="ofv-sconto"]').show();

                //- Imposta il formato
                row.find('[field="ofv-quantita"]').autoNumeric('init', getNumericOptions("integer12"));
                row.find('[field="ofv-durata"]').autoNumeric('init', getNumericOptions("integer12"));
                row.find('[field="ofv-lunghezza"]').autoNumeric('init', getNumericOptions("decimal"));
                row.find('[field="ofv-larghezza"]').autoNumeric('init', getNumericOptions("decimal"));
                row.find('[field="ofv-spessore"]').autoNumeric('init', getNumericOptions("decimal"));
                row.find('[field="ofv-valuni-cal"]').autoNumeric('init', getNumericOptions("currency"));
                row.find('[field="ofv-sconto"]').autoNumeric('init', getNumericOptions("sconto"));
                row.find('[field="ofv-sconto"]').autoNumeric('set', 0);
                row.find('[field="ofv-valuni-fin"]').autoNumeric('init', getNumericOptions("currency"));
                row.find('[field="ofv-valuni-fin"]').autoNumeric('set', "");
                row.find('[field="ofv-valtot-fin"]').autoNumeric('init', getNumericOptions("currency"));
                row.find('[field="ofv-valtot-fin"]').autoNumeric('set', "");

                //- Calcola il prezzo
                var valuni = 0;
                var tipo = $( "#ofa-unimis" ).val();
                var przlordo = $( "#ofa-przacq-lor" ).autoNumeric('get');
                var lun = $( "#ofa-lunghezza" ).autoNumeric('get');
                var lar = $( "#ofa-larghezza" ).autoNumeric('get');

                switch (tipo) {
                case "P": 
                  valuni = przlordo;
                  break;
                case "M": 
                  valuni = przlordo * (lun/1000) * (lar/1000);
                  break;
                }

                row.find('[field="ofv-valuni-cal"]').autoNumeric('set', valuni);

                //- Carica lo sconto in base alla voce
                var getData = {};
                getData.scontoPerVoce = true;
                getData.codvoce       = 1;
                getData.codcli        = $("#off-codcli").val();											
                getData.codart        = $("#ofa-codart").val();

                $.getJSON("data-viste.php", getData)
                .done(function(data) {
                    if (data.error) {
                      alert(data.error);
                    } else {
                      row.find('[field="ofv-sconto"]').autoNumeric('set', data[0].sconto);
                    }
                })
                .fail(function(data) {
                });	

                //- Ricalcola in automatico cambiando i valori
                row.find('[field="ofv-valuni-cal"]').keyup(function() {
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-sconto"]').keyup(function() {
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                
                //- Ricalcola
                $( "#btn-voci-ricalcola" ).trigger( "click" );
              }     
          })
          .fail(function(data) {
          });          
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
    getData.ofa_unimis     = $("#ofa-unimis").val();
    getData.ofa_przacq_net = $("#ofa-przacq-net").autoNumeric('get');
    getData.ofa_przacq_lor = $("#ofa-przacq-lor").autoNumeric('get');
		getData.ofa_lunghezza  = $("#ofa-lunghezza").autoNumeric('get');
		getData.ofa_larghezza  = $("#ofa-larghezza").autoNumeric('get');
    getData.ofa_lungsmu    = $("#ofa-lungsmu").autoNumeric('get');
    getData.ofa_quantita   = $("#ofa-quantita").autoNumeric('get');
    
		$.getJSON("data-offerta-articoli.php", getData)
		.done(function(data) {
        //- Ricalcola il prezzo ARTICOLO
        var valuni = 0;
        var tipo = $( "#ofa-unimis" ).val();
        var przlordo = $( "#ofa-przacq-lor" ).autoNumeric('get');
        var lun = $( "#ofa-lunghezza" ).autoNumeric('get');
        var lar = $( "#ofa-larghezza" ).autoNumeric('get');

        switch (tipo) {
        case "P": 
          valuni = przlordo;
          break;
        case "M": 
          valuni = przlordo * (lun/1000) * (lar/1000);
          break;
        }

        $( "tr[num_riga_voce='1']" ).find('[field="ofv-valuni-cal"]').autoNumeric('set', valuni);
        
        //- Ricalcola
        $( "#btn-voci-ricalcola" ).trigger( "click" );
		})
		.fail(function(data) {
		});						
	});
	
  //---------------------------------------
	//- Voci
  //---------------------------------------
  
  $( "#btn-voci-new" ).click(function() {
    
		//- Aggiunge la nuova voce se l'ultima ha già assegnato un articolo
		var maxNumRigaVoce = $("#table-voci-body").attr( "max_num_riga_voce" );
    
    if (maxNumRigaVoce > 1) {
      var lastRow  = $( 'tr[num_riga_voce="' + maxNumRigaVoce + '"]');
      
      //- Non ha ancora selezionato un articolo
      if (lastRow.find('[field="voc-codvoc"]').prop('disabled') == false) {
        return;
      }     
    }
    
    var newNumRigaVoce = 1 + (1*maxNumRigaVoce);
  
		//- Crea una nuova voce
		var getData = {};
		getData.insert            = true;
    getData.ofv_numoff        = $("#off-numoff").val();
    getData.ofv_codart        = $("#ofa-codart").val();
    getData.ofv_num_riga_voce = newNumRigaVoce;
		
		$.getJSON("data-offerta-costi.php", getData)
		.done(function(data) {
				if (data.error) {
					alert(data.error);
				} else {
					//- Aggiunge una nuova riga nella tabella
					$("#table-voci-body").append(getRowHtml());
          $("#table-voci-body").attr( "max_num_riga_voce", newNumRigaVoce );
          
					//- Assegna l'id alla riga
					var ofv_id = data.id;
					
					$( "tr[brandnew]" )
					.attr( "ofv_id", ofv_id)
          .attr( "num_riga_voce", newNumRigaVoce )
					.removeAttr("brandnew");
					
					//- Imposta gli elementi della riga
					var row  = $( 'tr[ofv_id="' + ofv_id + '"]');
											 
					//- Carica le voci
					var getData = {};
					getData.voci   = true;

					$.getJSON("data-viste.php", getData)
					.done(function(data) {
							if (data.error) {
								alert(data.error);
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
                row.find('[field="ofv-valuni-cal"]').hide();
                row.find('[field="ofv-sconto"]').hide();
								
                //- Imposta il formato
                row.find('[field="ofv-quantita"]').autoNumeric('init', getNumericOptions("integer12"));
                row.find('[field="ofv-durata"]').autoNumeric('init', getNumericOptions("integer12"));
								row.find('[field="ofv-lunghezza"]').autoNumeric('init', getNumericOptions("decimal"));
								row.find('[field="ofv-larghezza"]').autoNumeric('init', getNumericOptions("decimal"));
                row.find('[field="ofv-spessore"]').autoNumeric('init', getNumericOptions("decimal"));
                row.find('[field="ofv-valuni-cal"]').autoNumeric('init', getNumericOptions("currency"));
                row.find('[field="ofv-sconto"]').autoNumeric('init', getNumericOptions("sconto"));
                row.find('[field="ofv-sconto"]').autoNumeric('set', 0);
                row.find('[field="ofv-valuni-fin"]').autoNumeric('init', getNumericOptions("currency"));
                row.find('[field="ofv-valtot-fin"]').autoNumeric('init', getNumericOptions("currency"));
                
								//- Gestisce la selezione di una voce
								row.find('[field="voc-codvoc"]').selectmenu({
  								change: function( event, ui ) {
                    
                    //- Disabilita la combo
                    row.find('[field="voc-codvoc"]')
											.selectmenu( "close" )
											.selectmenu( "disable" );	
                    
										var selected_codvoce = ui.item.value;
										
										var arr = $.grep(arrVoci, function( item ) {
											return item.voc_codvoce == selected_codvoce;
										});
                    
                    var descriz     = arr[0].voc_descriz;
                    var formula     = arr[0].codice;
                    var descFormula = arr[0].formula;
                    var critcalc    = arr[0].critcalc;

                    //- Imposta i valori
                    row.attr('descriz', descriz);
                    row.attr('critcalc', critcalc);
                    row.attr('voc-formula', formula);
                    row.find("td").first().tooltip();
                    row.find("td").first().prop('title', descFormula);
                    
                    //- Mostra i campi
                    row.find('[field="ofv-valuni-cal"]').show();
                    row.find('[field="ofv-sconto"]').show();
                    
										row.find("[qta]").hide();
										switch (critcalc) {
											case "Q": 
												row.find('[field="ofv-quantita"]').show();
                        row.find('[field="label-quantita"]').show();
												break;
											case "T": 
												row.find('[field="ofv-durata"]').show();
                        row.find('[field="label-durata"]').show();
												break;
											case "D": 
												row.find('[field="ofv-lunghezza"]').show();
												row.find('[field="ofv-larghezza"]').show();
                        row.find('[field="label-lunghezza"]').show();
												row.find('[field="label-larghezza"]').show();
												break;
											case "S": 
												row.find('[field="ofv-spessore"]').show();
                        row.find('[field="label-spessore"]').show();
												break;
										}
                    
                    //- Carica lo sconto in base alla voce
										var getData = {};
										getData.scontoPerVoce = true;
										getData.codvoce       = selected_codvoce;
                    getData.codcli        = $("#off-codcli").val();											
                    getData.codart        = $("#ofa-codart").val();

										$.getJSON("data-viste.php", getData)
										.done(function(data) {
												if (data.error) {
													alert(data.error);
												} else {
                          if (data.length > 0) {
                            row.find('[field="ofv-sconto"]').autoNumeric('set', data[0].sconto);
                          }
												}
										})
										.fail(function(data) {
										});	
                    
                    //- Carica i dati aggiuntivi in base alla formula
                    switch (""+formula) {
                    case "3": //-MANODOPERA
                    case "6": //-GIUNZIONE
                    case "7": //-GUIDA            

                      //- Carica il costo
                      var getData = {};
                      getData.costoPerVoce = true;
                      getData.codvoce      = selected_codvoce;

                      $.getJSON("data-viste.php", getData)
                      .done(function(data) {
                          if (data.error) {
                            alert(data.error);
                          } else {

                            if (data.length > 0) {
                              var costo = data[0].ivo_przunit;
                              
                              row.attr('przunit', costo);
                              row.find('[field="costo"]').text("Costo: "+costo);
                            }			

                            applyFormula(row);
                          }
                      })
                      .fail(function(data) {
                      });
                        
                      break;
                    case "4": //-RIVESTIMENTO (primo e successivi)
                      
                      //- Carica gli articoli aggiuntivi per il rivestimento
                      var getData = {};
                      getData.articoliPerVoce = true;
                      getData.codvoce         = selected_codvoce;

                      $.getJSON("data-viste.php", getData)
                      .done(function(data) {
                          if (data.error) {
                            alert(data.error);
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

                                //- Permette la scelta solo tra le voci dell'elenco
                                change: function (event, ui) {
                                  if (!ui.item) {
                                    $(this).val('');
                                    $(this).attr("przLordo", 0);
                                    
                                    row.find('[field="costo"]').html("");
                                  }
                                },
                                
                                select: function( event, ui ) {
                                  var selected_codart = ui.item.value;

                                  var arr = $.grep(data, function( item ) {
                                    return item.art_codart == selected_codart;
                                  });

                                  //- Calcola il prezzo lordo
                                  var przNetto = arr[0].lis_przacq;
                                  
                                  var przLordo = 
                                      (przNetto * arr[0].lis_moltipl)
                                    + (przNetto * arr[0].lis_oneriacc / 100)
                                    + (przNetto * arr[0].lis_scarto / 100);

                                  row.find('[field="ofv-codart-agg"]').attr("przLordo", przLordo);
                                  
                                  //- Inserisce lo smusso
                                  var tiposmu = 0;
                                  var strSmusso = "No smusso";
                                  var dimSmusso = 0;
                                  
                                  if (arr[0].ivo_flagsmu == 's') {
                                    tiposmu = arr[0].ivo_tiposmu;
                                  }
                                  
                                  switch (tiposmu) {
                                    case "1":
                                      dimSmusso = $( "#ofa-lungsmu" ).autoNumeric('get');
                                      strSmusso = "Smusso diritto (" + dimSmusso + ")";
                                      break;
                                    case "2":
                                      dimSmusso = (0.6 * $("#ofa-larghezza").autoNumeric('get')) + $( "#ofa-lungsmu" ).autoNumeric('get');
                                      strSmusso = "Smusso diagonale (" + dimSmusso + ")";
                                      break;
                                  }
                                  
                                  row.find('[field="ofv-codart-agg"]').attr("smusso", dimSmusso);
                                  
                                  //- Mostra il messaggio
                                  var strPrz = "Prezzo: " + Number(przLordo).toFixed(5);
                                  var strSpessori = "Spessori prec.: " + getSpessoriPrecedenti(row);

                                  row.find('[field="ofv-codart-agg"]').attr("desc1", strPrz);
                                  row.find('[field="ofv-codart-agg"]').attr("desc2", strSmusso);
                                  row.find('[field="ofv-codart-agg"]').attr("desc3", strSpessori);
                                  
                                  row.find('[field="costo"]').html(strPrz + "<br>" + strSmusso + "<br>" + strSpessori);
                                }
                              });
                            }			
                          }
                      })
                      .fail(function(data) {
                      });
                        
                      break;
                    }	
									}
								});
								
                //- Gestisce il cambio valore di qta/lun/lar/spe/dur valore e sconto
                row.find('[field="ofv-quantita"]').keyup(function() {
                  applyFormula(row); 
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-lunghezza"]').keyup(function() {
                  applyFormula(row); 
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-larghezza"]').keyup(function() {
                  applyFormula(row); 
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-spessore"]').keyup(function() {
                  applyFormula(row); 
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-durata"]').keyup(function() {
                  applyFormula(row);
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-valuni-cal"]').keyup(function() {
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });
                row.find('[field="ofv-sconto"]').keyup(function() {
                  $( "#btn-voci-ricalcola" ).trigger( "click" );
                });

								//- Cancella una voce
								row.find('[field="btn-voci-delete"]').click(function() {
									var getData = {};
									getData.delete = true;
    							getData.ofv_id = ofv_id;

									$.getJSON("data-offerta-costi.php", getData)
									.done(function(data) {
											if (data.error) {
												alert(data.error);
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
		
		//- Esegue i calcoli dei totali
		$.each( elencoVoci, function( i, row ) {
			var $row = $(row);
			
      var qta = $("#ofa-quantita").autoNumeric('get');
			var prz = $row.find('[field="ofv-valuni-cal"]').autoNumeric('get');
			var sco = $row.find('[field="ofv-sconto"]').autoNumeric('get');

			var prz_uni_fin = prz*(1-(sco/100));
			var prz_tot_fin = prz_uni_fin * qta;
			
			$row.find('[field="ofv-valuni-fin"]').autoNumeric('set', prz_uni_fin);
			$row.find('[field="ofv-valtot-fin"]').autoNumeric('set', prz_tot_fin);
			
			tot_prz = tot_prz + 1*prz;
			tot_prz_uni_fin = tot_prz_uni_fin + prz_uni_fin;
			tot_prz_uni_tot = tot_prz_uni_tot + prz_tot_fin;
		});
		
		//- Aggiorna i totali
    $("#valuni-cal").autoNumeric('set', tot_prz);
    $("#valuni-fin").autoNumeric('set', tot_prz_uni_fin);
    $("#valtot-fin").autoNumeric('set', tot_prz_uni_tot);

		//- Update sul server
		var getData = {};
		getData.update          = true;
    getData.ofv_numoff      = $("#off-numoff").val();
    
		//- Dati dell'articolo
    getData.ofv_codart      = $("#ofa-codart").val();
		getData.ofa_totuni      = $("#valuni-cal").autoNumeric('get');
		getData.ofa_totunit_fin = $("#valuni-fin").autoNumeric('get');
		getData.ofa_totgen      = $("#valtot-fin").autoNumeric('get');
		
    //- Dati delle voci
		getData.voci            = [];
		$.each( elencoVoci, function( i, row ) {
			var $row = $(row);
      
			var objVoce = {};
			objVoce.ofv_id         = $row.attr("ofv_id");
			objVoce.ofv_codvoce    = $row.find('[field="voc-codvoc"]').val();
			objVoce.ofv_quantita   = $row.find('[field="ofv-quantita"]').autoNumeric('get');
			objVoce.ofv_lunghezza  = $row.find('[field="ofv-lunghezza"]').autoNumeric('get');
			objVoce.ofv_larghezza  = $row.find('[field="ofv-larghezza"]').autoNumeric('get');
      objVoce.ofv_spessore   = $row.find('[field="ofv-spessore"]').autoNumeric('get');
			objVoce.ofv_durata     = $row.find('[field="ofv-durata"]').autoNumeric('get');
			objVoce.ofv_sconto     = $row.find('[field="ofv-sconto"]').autoNumeric('get');
			objVoce.ofv_valuni_cal = $row.find('[field="ofv-valuni-cal"]').autoNumeric('get');
			objVoce.ofv_valuni_fin = $row.find('[field="ofv-valuni-fin"]').autoNumeric('get');
			objVoce.ofv_valtot_fin = $row.find('[field="ofv-valtot-fin"]').autoNumeric('get');
			objVoce.ofv_codart_agg = $row.find('[field="ofv-codart-agg"]').val();
			objVoce.ofv_codart_agg_prz_lor = $row.find('[field="ofv-codart-agg"]').attr("przLordo");
			
      objVoce.ofv_descriz    = $row.attr('descriz');
			objVoce.ofv_formula    = $row.attr('voc-formula');
			objVoce.ofv_desc_formula = "";
			objVoce.ofv_critcalc   = $row.attr('critcalc');
			objVoce.ofv_costo      = $row.attr('przunit');
			objVoce.ofv_dimsmusso  = $row.find('[field="ofv-codart-agg"]').attr("smusso");
			objVoce.ofv_desc1      = $row.find('[field="ofv-codart-agg"]').attr("desc1");
			objVoce.ofv_desc2      = $row.find('[field="ofv-codart-agg"]').attr("desc2");
			objVoce.ofv_desc3      = $row.find('[field="ofv-codart-agg"]').attr("desc3");
      
			getData.voci.push(objVoce);
		});
		
		$.post("data-offerta-costi.php", getData)
		.done(function(data) {
			//- TODO ... messaggio preventivo salvato
		})
		.fail(function(data) {
			console.log("fail");
		});	

	});

	
  $( "#btn-voci-salva" ).click(function() {
    
		//- Cambia lo stato dell'offerta in completato
		var getData = {};
		getData.update_stato_salva  = true;
    getData.off_numoff          = $("#off-numoff").val();
    
		$.getJSON("data-offerta.php", getData)
		.done(function(data) {
		})
		.fail(function(data) {
		});						
    
	});
 
  $( "#btn-voci-consolida" ).click(function() {
    
		//- Cambia lo stato dell'offerta in completato
		var getData = {};
		getData.update_stato  = true;
    getData.off_numoff    = $("#off-numoff").val();
    
		$.getJSON("data-offerta.php", getData)
		.done(function(data) {
        //- Imposta tutti i campi in readonly

        //- Disabilita i campi dell'offerta
        $("#dettaglio-offerta :input").prop("disabled", true);
        $( "#btn-offerta-crea" ).hide();
        $( "#btn-offerta-aggiorna" ).hide();

        //- Disabilita i campi dell'articolo
        $("#dettaglio-articolo .form-control").prop("disabled", true);
        $("#btn-articolo-new").hide();
        $("#btn-articolo-elenco").hide();
        $("#btn-articolo-inserisci").hide();
        $("#btn-articolo-aggiorna").hide();

        //- Disabilita i campi delle voci
        $("#dettaglio-voci .form-control").prop("disabled", true);
        $('#dettaglio-voci [field="btn-voci-delete"]').hide();
        $("#btn-voci-new").hide();
        $("#btn-voci-ricalcola").hide();
				$("#btn-voci-salva").hide();
        $("#btn-voci-consolida").hide();  
      
        //- Nasconde il pulsante
        $("#footer-voci").hide();
		})
		.fail(function(data) {
		});						
    
	});
  
}//init