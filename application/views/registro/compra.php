<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/css/ui.jqgrid.css" />
<script>
$(document).ready(function(){
	var mydata = [];
	<?php if($compra != null): ?>
	mydata = <?php echo  $compra->detalle ?>;
	<?php endif ?>
	$("#list").jqGrid({
		datatype: "local",
		data : mydata,
		height: 250,
	   	colNames:[
	   	'NÚMERO CORRELATIVO DEL REGISTRO O CÓDIGO UNICO DE LA OPERACIÓN',
	   	'FECHA DE EMISIÓN DEL COMPROBANTE DE PAGO O DOCUMENTO', 
	   	'FECHA DE VENCIMIENTO  O FECHA DE PAGO (1)', 
	   	'TIPO (TABLA 10)',
	   	'SERIE O CÓDIGO DE LA DEPENDENCIA ADUANERA (TABLA 11)',
	   	'AÑO DE EMISIÓN DE LA DUA O DSI',
	   	'N° DEL COMPROBANTE DE PAGO, DOCUMENTO, N° DE ORDEN DEL FORMULARIO FÍSICO O VIRTUAL,  N° DE DUA, DSI O LIQUIDACIÓN DE  COBRANZA U OTROS DOCUMENTOS  EMITIDOS POR SUNAT PARA ACREDITAR  EL CRÉDITO FISCAL EN LA IMPORTACIÓN ',
	   	'TIPO DOCUMENTO',
	   	'NÚMERO DOCUMENTO',
	   	'APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL',
	   	'BASE IMPONIBLE',
	   	'IGV',
	   	'BASE IMPONIBLE',
	   	'IGV',
	   	'BASE IMPONIBLE',
	   	'IGV',
	   	'VALOR DE LAS ADQUISICIONES NO GRAVADAS',
	   	'ISC',
	   	'OTROS ATRIBUTOS Y CARGOS',
	   	'IMPORTE TOTAL',
	   	'N° DE COMPROBANTE DE PAGO EMITIDO POR SUJETO NO DOMICILIADO (2)',
	   	'NÚMERO',
	   	'FECHA DE EMISIÓN',
	   	'TIPO DE CAMBIO',
	   	'FECHA',
	   	'TIPO (TABLA 10)',
	   	'SERIE',
	   	'N° DEL COMPROBANTE DE PAGO O DOCUMENTO'],
	   	colModel:[
	   		{name:'id', index:'id', key:true},
			{name:'fecha_emision', index:'fecha_emision', editable:true,
				editoptions: {
		                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
		                        // use it to place a third party control to customize the toolbar
		                        dataInit: function (element) {
		                        	$(element).on('click', function(){
		                        		if(!$(this).data("datepicker")){
		                        			$(this).datepicker({format: FormatoFecha,autoclose: true,language: "es",todayHighlight: true});
		                        		}
		                        		$(this).focus();
		                        	})
		                        }
		                    }
			},
			{name:'fecha_vencimiento', index:'fecha_vencimiento', editable:true,
				editoptions: {
		                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
		                        // use it to place a third party control to customize the toolbar
		                        dataInit: function (element) {
		                        	$(element).on('click', function(){
		                        		if(!$(this).data("datepicker")){
		                        			$(this).datepicker({format: FormatoFecha,autoclose: true,language: "es",todayHighlight: true});
		                        		}
		                        		$(this).focus();
		                        	})
		                        }
		                    }},
			{name:'tipo_tabla10', index:'tipo_tabla10', editable:true,edittype: "select"
			,editoptions:{
				value:"00:00-Otros;01:01-Factura;02:02-Recibo por Honorarios;03:03-Boleta de Venta;04:04-Liquidación de compra;05:05-Boleto de compañía de aviación comercial por el servicio de transporte aéreo de pasajeros;06:06-Carta de porte aéreo por el servicio de transporte de carga aérea;07:07-Nota de crédito;08:08-Nota de débito;09:09-Guía de remisión - Remitente;10:10-Recibo por Arrendamiento"
			}
			},
			{name:'serie', index:'serie', editable:true},
			{name:'anho', index:'anho', editable:true},
			{name:'nro_comprobante', index:'nro_comprobante', editable:true},
			{name:'tipo_tabla2', index:'tipo_tabla2', editable:true},
			{name:'numero', index:'numero', editable:true},
			{name:'denominacion', index:'denominacion', editable:true},
			{name:'base_imponible_1', index:'base_imponible_1', editable:true},
			{name:'igv_1', index:'igv_1', editable:true},
			{name:'base_imponible_2', index:'base_imponible_2', editable:true},
			{name:'igv_2', index:'igv_2', editable:true},
			{name:'base_imponible_3', index:'base_imponible_3', editable:true},
			{name:'igv_3', index:'igv_3', editable:true},
			{name:'valor_adquisiciones', index:'valor_adquisiciones', editable:true},
			{name:'isc', index:'isc', editable:true},
			{name:'otros_tributos', index:'otros_tributos', editable:true},
			{name:'importe_total', index:'importe_total', editable:true},
			{name:'comprobante_pago', index:'comprobante_pago', editable:true},
			{name:'detraccion_nro', index:'detraccion_nro', editable:true},
			{name:'detraccion_fecha_emision', index:'detraccion_fecha_emision', editable:true,
				editoptions: {
		                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
		                        // use it to place a third party control to customize the toolbar
		                        dataInit: function (element) {
		                        	$(element).on('click', function(){
		                        		if(!$(this).data("datepicker")){
		                        			$(this).datepicker({format: FormatoFecha,autoclose: true,language: "es",todayHighlight: true});
		                        		}
		                        		$(this).focus();
		                        	})
		                        }
		                    }},
			{name:'tipo_cambio', index:'tipo_cambio', editable:true},
			{name:'fecha_o', index:'fecha_o', editable:true,
				editoptions: {
		                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
		                        // use it to place a third party control to customize the toolbar
		                        dataInit: function (element) {
		                        	$(element).on('click', function(){
		                        		if(!$(this).data("datepicker")){
		                        			$(this).datepicker({format: FormatoFecha,autoclose: true,language: "es",todayHighlight: true});
		                        		}
		                        		$(this).focus();
		                        	})
		                        }
		                    }},
			{name:'tipo_tabla10_o', index:'tipo_tabla10_o', editable:true},
			{name:'serie_o', index:'serie_o', editable:true},
			{name:'nro_comprobante_o', index:'nro_comprobante_o', editable:true}


	   	],
	   	pager: '#pager',
        rowNum: 10,
        rowList: [5, 10, 20, 50],
        sortname: 'id',
        viewrecords: true,
        gridview: true,
        height: "100%",
        editUrl: 'clientArray',
        cellsubmit:'clientArray' ,
        height: '100%',
        onSelectRow: function(id){
        	
	    }
	});

	$("#list").jqGrid('setGroupHeaders', {
          useColSpanStyle: false, 
          groupHeaders:[
            {startColumnName: 'id', numberOfColumns: 1, titleText: 'PERIODO'},
            {startColumnName: 'fecha_emision', numberOfColumns: 1, titleText: $("#txtmes").val()+'/'+$("#txtanho").val()}
            ]   
     });
	$("#list").jqGrid('setGroupHeaders', {
          useColSpanStyle: false, 
          groupHeaders:[
            {startColumnName: 'id', numberOfColumns: 1, titleText: 'RUC'},
            {startColumnName: 'fecha_emision', numberOfColumns: 1, titleText: '<?php echo  $this->conf->Ruc ?>'}
            ]   
     });
	$("#list").jqGrid('setGroupHeaders', {
          useColSpanStyle: false, 
          groupHeaders:[
            {startColumnName: 'id', numberOfColumns: 1, titleText: 'RAZÓN SOCIAL:'},
            {startColumnName: 'fecha_emision', numberOfColumns: 3, titleText: '<?php echo  $this->conf->RazonSocial ?>'}
            ]   
     });
	$("#list").jqGrid('setGroupHeaders', {
          useColSpanStyle: true, 
          groupHeaders:[
            {startColumnName: 'tipo_tabla10', numberOfColumns: 3, titleText: 'COMPROBANTE DE PAGO O DOCUMENTO'},
            {startColumnName: 'tipo_tabla2', numberOfColumns: 3, titleText: 'INFORMACIÓN DEL PROVEEDOR'},
            {startColumnName: 'base_imponible_1', numberOfColumns: 2, titleText: 'ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONES GRAVADAS Y/O DE EXPORTACIÓN'},
            {startColumnName: 'base_imponible_2', numberOfColumns: 2, titleText: 'ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONES GRAVADAS Y/O DE EXPORTACIÓN'},
            {startColumnName: 'base_imponible_3', numberOfColumns: 2, titleText: 'ADQUISICIONES GRAVADAS DESTINADAS A OPERACIONES NO GRAVADAS'},
            {startColumnName: 'detraccion_nro', numberOfColumns: 2,titleText:'CONSTANCIA DE DEPÓSITO DE DETRACCIÓN (3)'},
            {startColumnName: 'fecha_o', numberOfColumns: 4,titleText:'REFERENCIA DEL COMPROBANTE DE PAGO O DOCUMENTO ORIGINAL QUE SE MODIFICA'}
            ]   
     });


	$("#list").jqGrid('navGrid',"#pager",{edit:false,add:false,del:false, search: false, refresh: false ,view: false});
	$("#list").jqGrid("inlineNav", "#pager", {addParams: {
		position: "last",
		startId: mydata.length,
		rowID: function (options) {
        return options.startId + $.jgrid.guid++;
    		}
    	}
    }
    );
    $("#export").on("click", function(event){
    	event.preventDefault();
		$("#list").jqGrid("exportToExcel",{
			includeLabels : true,
			includeGroupHeader : true,
			includeFooter: true,
			fileName : "jqGridExport.xlsx",
			//maxlength : 40 // maxlength for visible string data 
		})
	})

	$("#btnguardar" ).on('click',function( event ) {
		saveRows();
	  $("#detalle").val(JSON.stringify($("#list").jqGrid('getGridParam', 'data')));
	  //startEdit();
	});
	startEdit();
	updateperiod();
})
function startEdit() {
    var grid = $("#list");
    var ids = grid.jqGrid('getDataIDs');
    for (var i = 0; i < ids.length; i++) {
        grid.jqGrid('editRow',ids[i]);
    }
};
function saveRows() {
    var grid = $("#list");
    var ids = grid.jqGrid('getDataIDs');
    for (var i = 0; i < ids.length; i++) {
        grid.jqGrid('saveRow', ids[i]);
    }
}
function updateperiod(){
	var groupHeadersOptions = $("#list").jqGrid('getGridParam','groupHeader');
	groupHeadersOptions[0].groupHeaders[1].titleText = $("#txtmes").val()+'/'+$("#txtanho").val();
	headerRow = $("#list").closest("div.ui-jqgrid-view")
    .find("table.ui-jqgrid-htable>thead>tr.ui-jqgrid-labels").first();
    $($(headerRow[0]).children()[1]).text($("#txtmes").val()+'/'+$("#txtanho").val());
}
</script>
<style type="text/css">
	ui-grid{ width:100% !important; }
	 .ui-jqgrid .ui-jqgrid-htable th div
    {
        height: auto;
        overflow: hidden;
        padding-right: 4px;
        padding-top: 2px;
        position: relative;
        vertical-align: text-top;
        white-space: normal !important;
    }
    th{
    	text-align: center;
    }
    .jqg-second-row-header{
    	height: 20px !important;
    }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $compra == null ? "Nuevo registro compra" : $compra->mes; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/registro/compras'); ?>">compras</a></li>
		  <li class="active"><?php echo $compra == null ? "Nuevo compra" : $compra->mes; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">(*) Campos obligatorios</div>
				<?php echo form_open('registro/comprascrud', array('class' => 'upd')); ?>
				<?php if($compra != null): ?>
				<input type="hidden" name="id" value="<?php echo $compra->id; ?>" />				
				<?php endif; ?>
				<input type="hidden" name="detalle" id="detalle" value="[]" />
				<div class="form-group">
					<label>Ruc</label>
					<?php echo $this->conf->Ruc; ?>
				</div>
				<div class="form-group">
					<label>Razon Social</label>
					<?php echo $this->conf->RazonSocial; ?>
				</div>
				  <div class="form-group">
				    <label>Año (*)</label>
				    <input autocomplete="off" id="txtanho" name="mes" type="text" onchange="updateperiod()" class="form-control required" placeholder="mes" value="<?php echo $compra != null ? $compra->mes : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtmes" name="anho" type="text" onchange="updateperiod()" class="form-control required" placeholder="año" value="<?php echo $compra != null ? $compra->anho : null; ?>" />
				  </div>
				  <div style="width:100%;overflow:auto;">
				  		<button id="export">Export to Excel</button>
				  		<table id="list"></table>
				  		<div id="pager"></div>
				  	</div>
				  <div class="clearfix text-right">
				  <?php if(isset($compra)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/registro/compraeliminar/' . $compra->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button" id="btnguardar">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
				<div class="col-md-12">
				  	
				</div>
		</div>
	</div>
</div>