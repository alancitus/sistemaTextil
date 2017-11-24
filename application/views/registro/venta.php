<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/css/ui.jqgrid.css" />
<script>
$(document).ready(function(){
	var mydata = [];
	<?php if($venta != null and isset($venta->detalle)): ?>
	mydata = <?php echo  $venta->detalle ?>;
	<?php endif ?>
	$("#list").jqGrid({
		datatype: "local",
		data : mydata,
		height: 250,
	   	colNames:[
	   	'NÚMERO CORRELATIVO DEL REGISTRO O CÓDIGO UNICO DE LA OPERACIÓN',
	   	'FECHA DE EMISIÓN DEL COMPROBANTE DE PAGO O DOCUMENTO', 
	   	'FECHA DE VENCIMIENTO Y/O PAGO', 
	   	'TIPO (TABLA 10)',
	   	'N° SERIE ON° DE SERIE DE LA MAQUINA REGISTRADORA',
	   	'NÚMERO',
	   	'TIPO DOCUMENTO (TABLA 2)',
	   	'NÚMERO',
	   	'APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL',
	   	'VALOR FACTURADO DE LA EXPORTACIÓN',
	   	'BASE IMPONIBLE DE LA OPERACIÓN GRAVADA',
	   	'EXONERADA',
	   	'INAFECTA',
	   	'ISC',
	   	'IGV Y/O IPM',
	   	'OTROS TRIBUTOS Y CARGOS QUE NO FORMAN PARTE DE LA BASE IMPONIBLE',
	   	'IMPORTE TOTAL DEL COMPROBANTE DE PAGO',
	   	'TIPO DE CAMBIO',
	   	'FECHA',
	   	'TIPO (TABLA 10)',
	   	'SERIE',
	   	'N° DEL COMPROBANTE DE PAGO O DOCUMENTO'],
	   	colModel:[
	   		{name:'correlativo', index:'correlativo',key:true},
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
		                    }},
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
			{name:'tipo_tabla10', index:'tipo_tabla10', editable:true},
			{name:'serie', index:'serie', editable:true},
			{name:'numero', index:'numero', editable:true},
			{name:'tipo_documento', index:'tipo_documento', editable:true},
			{name:'numero_documento', index:'numero_documento', editable:true},
			{name:'denominacion', index:'denominacion', editable:true},
			{name:'valor_facturado', index:'valor_facturado', editable:true},
			{name:'base_imponible', index:'base_imponible', editable:true},
			{name:'exonerada', index:'exonerada', editable:true},
			{name:'inafecta', index:'inafecta', editable:true},
			{name:'isc', index:'isc', editable:true},
			{name:'igv_ipm', index:'igv_ipm', editable:true},
			{name:'otros_tributos', index:'otros_tributos', editable:true},
			{name:'importe_comprobante', index:'importe_comprobante', editable:true},
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
			{name:'comprobante_o', index:'comprobante_o', editable:true}
	   	],
	   	pager: '#pager',
        rowNum: 10,
        rowList: [5, 10, 20, 50],
        sortname: 'id',
        viewrecords: true,
        gridview: true,
        height: "100%",
        editUrl: 'clientArray',
        cellsubmit:'clientArray' 
	});
	$("#list").jqGrid('setGroupHeaders', {
          useColSpanStyle: true, 
          groupHeaders:[
            {startColumnName: 'tipo_tabla10', numberOfColumns: 3, titleText: 'COMPROBANTE DE PAGO O DOCUMENTO'},
            {startColumnName: 'tipo_documento', numberOfColumns: 3, titleText: 'INFORMACIÓN DEL CLIENTE'},
            {startColumnName: 'exonerada', numberOfColumns: 3, titleText: 'IMPORTE TOTAL DE LA OPERACIÓN EXONERADA O INAFECTA'},
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
			maxlength : 40 // maxlength for visible string data 
		})
	})   
	$("#btnguardar" ).on('click',function( event ) {
		saveRows();
	  $("#detalle").val(JSON.stringify($("#list").jqGrid('getGridParam', 'data')));
	});	
	startEdit();
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
</style>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $venta == null ? "Nuevo registro venta" : $venta->mes; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/registro/ventas'); ?>">ventas</a></li>
		  <li class="active"><?php echo $venta == null ? "Nuevo venta" : $venta->mes; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">(*) Campos obligatorios</div>
				<?php echo form_open('registro/ventascrud', array('class' => 'upd')); ?>
				<?php if($venta != null): ?>
				<input type="hidden" name="id" value="<?php echo $venta->id; ?>" />
				<input type="hidden" name="detalle" id="detalle" value="[]" />
				<?php endif; ?>
				
				<div class="form-group">
					<label>Ruc</label>
					<?php echo $this->conf->Ruc; ?>
				</div>
				<div class="form-group">
					<label>Razon Social</label>
					<?php echo $this->conf->RazonSocial; ?>
				</div>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtmes" name="mes" type="text" class="form-control required" placeholder="mes" value="<?php echo $venta != null ? $venta->mes : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtanho" name="anho" type="text" class="form-control required" placeholder="año" value="<?php echo $venta != null ? $venta->anho : null; ?>" />
				  </div>
				  <div style="width:100%;overflow:auto;">
				  		<button id="export">Export to Excel</button>
				  		<table id="list"></table>
				  		<div id="pager"></div>
				  	</div>
				  <div class="clearfix text-right">
				  <?php if(isset($venta)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/registro/ventaeliminar/' . $venta->id); ?>">Eliminar</button>
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