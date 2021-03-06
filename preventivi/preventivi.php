<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  
	<link rel="stylesheet" href="scripts/jquery-ui.min.css" />
	<link rel="stylesheet" href="scripts/bootstrap.min.css" >
  <link rel="stylesheet" href="scripts/bootstrap-theme.min.css" >
  <link rel="stylesheet" href="scripts/simplePagination.css" >
	<link rel="stylesheet" href="preventivi.css" />
	
	<script type="text/javascript" src="scripts/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
	<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
  <script type="text/javascript" src="scripts/underscore.min.js"></script>
  <script type="text/javascript" src="scripts/autoNumeric-min.js"></script>
  <script type="text/javascript" src="scripts/jquery.simplePagination.js"></script>
	
	<script type="text/javascript" src="preventivi.js"></script>
	
  <script type="text/javascript">
		$(document).ready(function () {
			init();
		});
  </script>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header" style="width:300px">
      <div class="row">
        <div class="col-md-4"><img src="atig.png" alt="A.T.I.G." height="48" ></div>
        <div class="col-md-8 navbar-brand">Gestione Offerte</div>
      </div>
    </div>
    <ul class="nav navbar-nav navbar-inverse">
      <li id='btn-offerta-new'><a href="#">Nuova Offerta</a></li>
      <li id='btn-offerta-elenco'><a href="#">Offerte in lavorazione</a></li>
      <li id='btn-offerta-completate'><a href="#">Offerte consolidate</a></li> 
    </ul>
  </nav>
  <div style="height:50px"></div>
	<div class="container">
		<div id="alert-success" class="alert alert-success" style="display:none">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span id="alert-success-msg"></span>
		</div>
		<div id="alert-danger" class="alert alert-danger" style="display:none">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<span id="alert-danger-msg"></span>
		</div>	
	</div>
  <div id="dialog-message" title="Messaggio" style="display:none">
    <p>
      <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
      <span msg></span>
    </p>
  </div>
  <div id="dialog-confirm" title="Cancellazione" style="display:none">
    <p>
      <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
      <span msg></span>
    </p>
  </div>
  <div id='page-preventivi'>
  	<!--
    <div id='header-offerta' class="padleft20">
			<h1>
				<span>Offerta</span>
				<button id='btn-offerta-new' class="btn btn-default" >
					<span class="glyphicon glyphicon-plus" aria-hidden="true" style="position: inherit;"></span>
				</button>
				<button id='btn-offerta-elenco' class="btn btn-default" >In lavorazione</button>
        <button id='btn-offerta-completate' class="btn btn-default" >Consolidate</button>
			</h1>
		</div>
    -->
		<div id='elenco-offerta' class="padleft20" stato="empty">
      <table>
        <tr>
          <td>
            <h1>
              <span>Ricerca offerte</span>
            </h1>
          </td>
          <td style="padding: 20px 0px 10px 20px">
            <input id="filtro" type="text" class="form-control">
            <button id='btn-filtro' class="btn-default" >
              <span class="glyphicon glyphicon-search" aria-hidden="true" style="position: inherit;"></span>
            </button>
          </td>
        </tr>
      </table>
      <br>
			<table id='table-offerta' class="table table-striped table-condensed">
  			<thead>
					<tr>
						<th>N. offerta</th>
						<th>Descrizione</th>
						<th>Data offerta</th>
						<th>Cod. Cliente</th>
						<th>Ragione sociale</th>
						<th>Importo</th>
						<th></th>
            <th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>999999999</td>
						<td>xxxxxxxxxxxxxxxxxxxxxxxxxx</td>
						<td>gg/mm/aaaa</td>
						<td>999999999</td>
						<td>xxxxxxxxxxxxxxxxxxxxxxxxxx</td>
						<td>9.999.999.999,99</td>
						<td>
              <button field="btn-offerta-modifica" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button>
						</td>
            <td>
              <button field="btn-offerta-delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
					</tr>
				</tbody>
			</table>			
      <div id='pager-offerta'></div>    
    </div>
		<div id='dettaglio-offerta' class="padleft20" off_id="">
      <h1>
        <span>Offerta</span>
      </h1>
			<label>
				<span>Codice Cliente</span>
				<input id="off-codcli" type="text" class="form-control">
			</label>
			<label>
				<span>Ragione sociale</span>
				<input id="off-ragsoc" type="text" class="form-control" readonly>
			</label>
			<label>
				<span>Data inserimento</span>
				<input id="off-datains" type="text" class="form-control" readonly>
			</label>
			<label>
				<span>Termine di consegna (gg)</span>
				<input id="off-gg-termine-consegna" type="text" class="form-control">
			</label>			
			<label style="display:none">
				<span>Data evasione presunta</span>
				<input id="off-dataeva" type="text"class="form-control" readonly>
			</label>
			<label>
				<span>Descrizione</span>
				<input id="off-descriz" maxlength="50" type="text" class="form-control">
			</label>
			<label>
				<span>Numero offerta</span>
				<input id="off-numoff" type="text" class="form-control" readonly>
			</label>
			<label>
				<button id='btn-offerta-crea' class="btn btn-success">Crea</button>
        <button id='btn-offerta-aggiorna' class="btn btn-success" >Aggiorna</button>
			</label>
		</div>
		<div id='header-articolo' class="padleft20">
			<h3>
				<span>Articolo</span>
    		<button id='btn-articolo-new' class="btn btn-default" >
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button id='btn-articolo-elenco' class="btn btn-primary" >Elenco</button>
			</h3>
		</div>
		<div id='elenco-articolo' class="padleft20">
			<table id='table-articolo'>
  			<thead>
					<tr>
						<th>Cod. Articolo</th>
						<th>Descrizione</th>
						<th>Prezzo vendita</th>
						<th>Costo totale</th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>999.999,99</td>						
						<td></td>
					</tr>
				</tfoot>
				<tbody>
					<!--<tr>
						<td>xxxxxxxx</td>
						<td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td>
						<td>999.999,99</td>
						<td>999.999,99</td>
						<td>
							<button id='btn-articolo-modifica' class="btn btn-success">Modifica</button>
							<button id='btn-articolo-delete' class="btn btn-danger" >Delete</button>
						</td>
					</tr>-->
				</tbody>
			</table>
		</div>		
		<div id='dettaglio-articolo' class="padleft20" ofa_id="">
			<label>
				<span>Codice articolo</span>
				<input id="ofa-codart" type="text" class="form-control">
			</label>
			<label>
				<span>Descrizione</span>
				<input id="ofa-descart" type="text" class="form-control" readonly>
			</label>
			<label>
				<span>Famiglia</span>
				<input id="ofa-famiglia" type="text" class="form-control" readonly>
			</label>
			<label>
				<span>Moltiplicatore</span>
				<input id="ofa-moltiplicatore" type="text" class="form-control" readonly>
			</label>			
			<label>
				<span>Scarto (%)</span>
				<input id="ofa-scarto" type="text" class="form-control t-right" readonly>
			</label>			
			<label>
				<span>Oneri accessori (%)</span>
				<input id="ofa-oneri" type="text" class="form-control t-right" readonly>
			</label>				
			<label>
				<span>Tipo prezzo</span>
			        <select class="form-control" id="ofa-unimis">
			          <option value='M'>Metro</option>
			          <option value='P'>Pezzo</option>
			        </select>
			</label>	
			<label>
				<span>Prz acq. Netto</span>
				<input id="ofa-przacq-net" type="text" class="form-control t-right">
			</label>		
			<label>
				<span>Prz acq. Lordo</span>
				<input id="ofa-przacq-lor" type="text" class="form-control t-right">
			</label>	
			<label>
				<span>Lunghezza (base)</span>
				<input id="ofa-lunghezza" type="text" class="form-control t-right">
			</label>				
			<label>
				<span>Larghezza (altezza)</span>
				<input id="ofa-larghezza" type="text" class="form-control t-right">
			</label>
			<label style="display:none">
				<span>Lunghezza smusso</span>
				<input id="ofa-lungsmu" type="text" class="form-control t-right">
			</label>
			<label style="display:none">
				<span>Tipo smusso</span>
			        <select class="form-control" id="ofa-tiposmu">
			          <option value='0' selected>0 - No smusso</option>
			          <option value='1'>1 - Smusso dritto</option>
								<option value='2'>2 - Smusso diagonale</option>
			        </select>
      </label>
			<label>
				<span>Pezzi</span>
				<input id="ofa-quantita" type="text" class="form-control t-right">
			</label>
      <button id='btn-articolo-inserisci' class="btn btn-success" >Inserisci</button>
			<button id='btn-articolo-aggiorna' class="btn btn-success" >Aggiorna</button>
		</div>
		<div id='header-voci' class="padleft20">
			<h3>
				<span>Voci di costo</span>
				<button id='btn-voci-new' class="btn btn-default" >
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button id='btn-voci-ricalcola' class="btn btn-success" style="display:none">Ricalcola</button>
			</h3>
		</div>
		<div id='dettaglio-voci' class="padleft20">
			<table id='table-voci' class="table table-bordered">
  			<thead>
					<tr>
						<th style="min-width: 200px;">Voce di costo</th>
						<th style="min-width: 200px;">Articolo aggiuntivo</th>
						<!--<th>Crit. calcolo</th>
						<th>Formula</th>-->
						<th style="min-width: 200px;">Parametri</th>
						<th class="text-right" style="min-width: 160px;">Valore unitario</th>
						<th class="text-right" style="min-width: 80px;">% sconto</th>
						<th class="text-right" style="min-width: 160px;">Valore unitario finale</th>
						<th class="text-right" style="min-width: 160px;">Totale di vendita</th>
						<th style="min-width: 50px;"></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td>Totale</td>
						<td></td>
						<!--<td></td>
						<td></td>-->
						<td></td>
						<td class="text-right"><span id="valuni-cal"></span></td>
						<td></td>
						<td class="text-right"><span id="valuni-fin"></span></td>
						<td class="text-right"><span id="valtot-fin"></span></td>
						<td class="text-right"></tr>
				</tfoot>
				<tbody id='table-voci-body' max_num_riga_voce='1'>
          <tr num_riga_voce='1' class="info" przunit='0'>
						<td>Articolo<input type=hidden value=1 field="voc-codvoc"></td>
						<td></td>
						<!--<td></td>
						<td></td>-->
						<td>
              				<input qta field="ofv-quantita" type="text" class="form-control" placeholder="Qta">
                      <input qta field="ofv-durata" type="text" class="form-control" placeholder="Minuti">
                      <input qta field="ofv-lunghezza" type="text" class="form-control" placeholder="Lunghezza">
                      <input qta field="ofv-larghezza" type="text" class="form-control" placeholder="Larghezza">
                      <input qta field="ofv-spessore" type="text" class="form-control" placeholder="Spessore">
                      <input qta field="ofv-lungsmu" type="text" class="form-control" placeholder="Lunghezza">
            			</td>
						<td>
							<input field="ofv-valuni-cal" type="text" class="form-control text-right pull-right">
						</td>
						<td>
              <input field="ofv-sconto" type="text" class="form-control col-md-1 text-right pull-right">
						</td>
						<td class="text-right">
							<span field="ofv-valuni-fin"></span>
						</td>
						<td class="text-right">
							<span field="ofv-valtot-fin"></span>
						</td>
						<td></td>
					</tr>
					<!--
					<tr ofv_id = "" brandnew>
						<td>
							<select field="voc-codvoc">
								<option disabled selected>...</option>
							</select>
						</td>
						<td>
							<input field="ofv-codart-agg" type="text">
							<span field="lvo-tiposmu">1-diritto</span>
						</td>
						<td>
							<span field="voc-critcalc">Q</span>
						</td>
						<td>
							<span field="voc-formula">1</span>
						</td>
						<td>
							<input qta field="ofv-quantita" type="text" placeholder="qta">
							<input qta field="ofv-durata" type="text" placeholder="min">
							<input qta field="ofv-lunghezza" type="text" placeholder="Lunghezza">
							<input qta field="ofv-larghezza" type="text" placeholder="Larghezza">
						</td>
						<td>
							<input field="ofv-valuni-cal" type="text">
						</td>
						<td>
							<input field="ofv-sconto" type="text">
						</td>
						<td>
							<span field="ofv-valuni-fin">99,99</span>
						</td>
						<td>
							<span field="ofv-valtot-fin">999,99</span>
						</td>
						<td>
							<button field="btn-voci-delete">delete</button>
						</td>
					</tr>
					-->
				</tbody>
			</table>
		</div>
		<div id='footer-voci' class="padleft20 bottom200">
			<h3>
				<button id='btn-voci-consolida' class="btn btn-success right">Consolida</button>
				<button id='btn-voci-salva' class="btn btn-success right">Salva</button>
			</h3>
		</div>
  </div>
</body>
</html>