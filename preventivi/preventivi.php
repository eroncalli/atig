<!DOCTYPE html>
<html lang="it">
<head>
	<link rel="stylesheet" href="scripts/jquery-ui.min.css" />
	<link rel="stylesheet" href="scripts/bootstrap.min.css" >
	<link rel="stylesheet" href="preventivi.css" />
	
	<script type="text/javascript" src="scripts/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
	<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="preventivi.js"></script>
	
  <script type="text/javascript">
		$(document).ready(function () {
			init();
		});
  </script>
</head>
<body>
  <div id='page-preventivi'>
  	<div id='header-offerta' class="padleft20">
			<h1>
				<span>Offerta</span>
				<button id='btn-offerta-new' class="btn btn-default" >
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button id='btn-offerta-elenco' class="btn btn-primary" >elenco</button>
			</h1>
		</div>
		<div id='elenco-offerta' class="padleft20">
			<table id='table-offerta'>
  			<thead>
					<tr>
						<th>N. offerta</th>
						<th>Data offerta</th>
						<th>Cod. Cliente</th>
						<th>Ragione sociale</th>
						<th>Importo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>999999999</td>
						<td>gg/mm/aaaa</td>
						<td>999999999</td>
						<td>xxxxxxxxxxxxxxxxxxxxxxxxxx</td>
						<td>9.999.999.999,99</td>
						<td>
							<button id='btn-offerta-modifica' class="btn btn-default" >modifica</button>
						</td>
					</tr>
				</tbody>
			</table>			
		</div>
		<div id='dettaglio-offerta' class="padleft20">
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
				<span>Data evasione presunta</span>
				<input id="off-dataeva" type="text"class="form-control" readonly>
			</label>
			<label>
				<span>Numero offerta</span>
				<input id="off-numoff" type="text" class="form-control" readonly>
			</label>
			<label>
				<button id='btn-offerta-crea' class="btn btn-success">Crea</button>
			</label>
		</div>
		<div id='header-articolo' class="padleft20">
			<h3>
				<span>Articolo</span>
    		<button id='btn-articolo-new' class="btn btn-default" >
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button id='btn-articolo-elenco' class="btn btn-primary" >elenco</button>
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
					<tr>
						<td>xxxxxxxx</td>
						<td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td>
						<td>999.999,99</td>
						<td>999.999,99</td>
						<td>
							<button id='btn-articolo-modifica' class="btn btn-success">Modifica</button>
							<button id='btn-articolo-delete' class="btn btn-danger" >Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>		
		<div id='dettaglio-articolo' class="padleft20">
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
				<span>Spessore</span>
				<input id="ofa-spessore" type="text" class="form-control" readonly>
			</label>
			<label>
				<span>Moltiplicatore</span>
				<input id="ofa-moltiplicatore" type="text" class="form-control" readonly>
			</label>			
			<label>
				<span>Scarto (%)</span>
				<input id="ofa-scarto" type="text" class="form-control" readonly>
			</label>			
			<label>
				<span>Oneri accessori (%)</span>
				<input id="ofa-oneri" type="text" class="form-control" readonly>
			</label>				
			<label>
				<span>Tipo appl. prezzo</span>
				<input id="ofa-unimis" type="text" class="form-control" readonly>
			</label>	
			<label>
				<span>Prz acq. Netto</span>
				<input id="ofa-przacq-net" type="text" class="form-control" readonly>
			</label>		
			<label>
				<span>Prz acq. Lordo</span>
				<input id="ofa-przacq-lor" type="text" class="form-control" readonly>
			</label>	
			<label>
				<span>Lunghezza (base)</span>
				<input id="ofa-lunghezza" type="text" class="form-control">
			</label>				
			<label>
				<span>Larghezza (altezza)</span>
				<input id="ofa-larghezza" type="text" class="form-control">
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
				<button id='btn-voci-ricalcola' class="btn btn-success">Ricalcola</button>
			</h3>
		</div>
		<div id='dettaglio-voci' class="padleft20">
			<table id='table-voci' class="table table-condensed">
  			<thead>
					<tr>
						<th>Voci di costo</th>
						<th>Articolo aggiuntivo</th>
						<th>Crit. calcolo</th>
						<th>Formula</th>
						<th>Qta</th>
						<th>Valore unit.</th>
						<th>% sconto</th>
						<th>Valore unit. finale</th>
						<th>Totale di vendita</th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td>Totale</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><span id="valuni-cal"></span></td>
						<td></td>
						<td><span id="valuni-fin"></span></td>
						<td><span id="valtot-fin"></span></td>
						<td></tr>
				</tfoot>
				<tbody id='table-voci-body'>
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
  </div>
</body>
</html>