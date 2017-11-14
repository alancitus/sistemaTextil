<script>
$(document).ready(function(){
	var colsNames = ['id','Proyecto','Acciones'];
	var colsModel = [ 
		{name:'id',index:'id', width:25, hidden: true},
		{name:'Nombre', index:'Nombre', formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('secuenciaoperaciones/proyecto/' + rowObject.id, cellvalue);
			}},
		{name:'Acciones',index:'Acciones', width: 30, align:"right", search: false, formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('secuenciaoperaciones/proyectotiempo/' + rowObject.id, 'Registro de tiempo');
			}}
	];	
		
	var grid = jqGridStart('list', 'pager', 'secuenciaoperaciones/ajax/CargarProyectos', colsNames, colsModel, '', '' );

	grid.jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});
})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<a class="btn btn-default pull-right" href="<?php echo base_url('index.php/secuenciaoperaciones/proyecto'); ?>">
				<span class="glyphicon glyphicon-file"></span>
				Nuevo Proyecto
			</a>
			<h1>Proyectos</h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li class="active">Proyectos</li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="list"></table>
					<div id="pager"></div>
				</div>
			</div>
		</div>
	</div>
</div>

