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
	   	colNames:['1','2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27'],
	   	colModel:[
	   		{name:'id',index:'id', key:true, editable:true},
	   		{name:'c2',index:'c2', sorttype:"date", editable:true},
	   		{name:'c3',index:'c3', editable:true},
	   		{name:'c4',index:'c4', align:"right",sorttype:"float", editable:true},
	   		{name:'c5',index:'c5', align:"right",sorttype:"float", editable:true},		
	   		{name:'c6',index:'c6', align:"right",sorttype:"float", editable:true},		
	   		{name:'c7',index:'c7',  sortable:false, editable:true}		,		
	   		{name:'c8',index:'c8',  sortable:false, editable:true}	,		
	   		{name:'c9',index:'c9',   sortable:false, editable:true}	,		
	   		{name:'c10',index:'c10', sortable:false, editable:true}	,		
	   		{name:'c11',index:'c11', sortable:false, editable:true}	,		
	   		{name:'c12',index:'c12', sortable:false, editable:true}	,		
	   		{name:'c13',index:'c13', sortable:false, editable:true}	,		
	   		{name:'c14',index:'c14', sortable:false, editable:true}	,		
	   		{name:'c15',index:'c15', sortable:false, editable:true}	,		
	   		{name:'c16',index:'c16', sortable:false, editable:true}	,		
	   		{name:'c17',index:'c17', sortable:false, editable:true}	,		
	   		{name:'c18',index:'c18', sortable:false, editable:true}	,		
	   		{name:'c19',index:'c19', sortable:false, editable:true}	,		
	   		{name:'c20',index:'c20', sortable:false, editable:true}	,		
	   		{name:'c21',index:'c21', sortable:false, editable:true}	,		
	   		{name:'c22',index:'c22', sortable:false, editable:true}	,		
	   		{name:'c23',index:'c23', sortable:false, editable:true}	,		
	   		{name:'c24',index:'c24', sortable:false, editable:true}	,		
	   		{name:'c25',index:'c25', sortable:false, editable:true}	,		
	   		{name:'c26',index:'c26', sortable:false, editable:true}	,		
	   		{name:'c27',index:'c27', sortable:false, editable:true}	
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
				<input type="hidden" name="detalle" id="detalle" value="[]" />
				<?php endif; ?>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtmes" name="mes" type="text" class="form-control required" placeholder="mes" value="<?php echo $compra != null ? $compra->mes : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtanho" name="anho" type="text" class="form-control required" placeholder="año" value="<?php echo $compra != null ? $compra->anho : null; ?>" />
				  </div>
				  <div style="width:100%;overflow:auto;">
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