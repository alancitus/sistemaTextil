<?php
	//array_debug($cliente); 
?>
<script>
$(document).ready(function(){
var grid = $("#list");
	var colsnames = ['id','maquinaria_id','fecha_revision','descripcion','Acciones'];
	var colsmodel = [ 
		{name:'id',index:'id', hidden: true},
		{name:'maquinaria_id',index:'maquinaria_id', hidden: true},
		{name:'fecha_revision',index:'fecha_revision', hidden: false, width:30},
		{name:'descripcion', index:'descripcion', width:100, search: false},
		{name: 'Acciones',index:'Acciones',search:false, width:30,formatter:function (cellvalue, options, rowObject) {    
		    return "<button class='btn btn-default' onclick='eliminarrevision("+rowObject.id+")'\><span class='glyphicon glyphicon-minus'></span></button>";
		}}
	];	
	url = 'mantenimiento/ajax/CargarRevisionMaquinaria';
	<?php if($maquinaria) {?>
			url = url + "?maquinaria_id="+ <?php echo $maquinaria->id ?>;
	<?php } ?>
	grid.jqGrid(
		{ 
			url: base_url(url), 
			datatype: 'json', 
			colNames:colsnames, 
			colModel:colsmodel, 
	  		rowNum:10000, 
	  		rowList:[20,30,100,10000],
	  		pager: '#pager' ,
	  		sortname: 'id',
	  		viewrecords: true,
	  		sortorder: '',
	  		autowidth:true,
	  		height: 'auto',
	  		filterToolbar: true
		}
	);
	
	grid.jqGrid('filterToolbar', {stringResult: false, searchOnEnter: true});
})
function registrarrevision(){
	url = '../ajax/RegistrarRevisionMaquinaria';
	if($("#id").val() &&  $("#txtdescripcion").val() && $("#txtFecharevision").val() ){
		$.ajax({
	            dataType: 'JSON',
	            type: 'POST',
	            data: {
	            	maquinaria_id:$("#id").val(),
	            	descripcion:$("#txtdescripcion").val(),
	            	fecha_revision:$("#txtFecharevision").val()
	            },
	            url: url,
	            success: function (r) {
	            	$("#list").jqGrid('addRowData',r.id,r);
	            },
	            error: function () {
			        alert("error");
			    }
		});
	}
}
function eliminarrevision(id){
	if(!confirm('seguro de eliminar')){
		return false;
	}
	url = '../ajax/EliminarRevisionMaquinaria';
	if(id > 0 ){
		$.ajax({
	            dataType: 'JSON',
	            type: 'POST',
	            data: {id:id},
	            url: url,
	            success: function (r) {
	            	$("#list").jqGrid('delRowData',id);
	            },
	            error: function () {
			        alert("error");
			    }
		});
	}
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $maquinaria == null ? "Nueva Maquinaria" : $maquinaria->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/mantenimiento/maquinarias'); ?>">Maquinarias</a></li>
		  <li class="active"><?php echo $maquinaria == null ? "Nuevo Item" : $maquinaria->Nombre; ?></li>
		</ol>
		
		<div class="row">
			<div class="col-md-12">
				  <?php if($maquinaria) {?>
				  <input type="hidden" name="id" id="id" value="<?php echo $maquinaria->id; ?>" />
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<div class="input-group">
				  				<input id="txtFecharevision" autocomplete="off" class="form-control datepicker" type="text" value="" placeholder="Fecha Revision" />
				  				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				  			</div>
				  		</div>
				  		<div class="col-md-9">
				  			<label>&nbsp;</label>
				  			<input autocomplete="off" id="txtdescripcion" name="descripcion" type="text" class="form-control" placeholder="Descripcion" value="" />
				  		</div>
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<div class="input-group">
				  				<button class="btn btn-info" type="button" onclick="registrarrevision()">Agregar</button>
				  			</div>
				  		</div>
				  	</div>
				  </div>
				  <div class="col-md-12">
				  	<div class="table-responsive">
				  		<table id="list"></table>
				  		<div id="pager"></div>
				  	</div>
				  </div>
				  <?php } ?>
				</div>
			</div>
	</div>
</div>