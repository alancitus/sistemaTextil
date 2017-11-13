<script>
$(document).ready(function(){
	var colsNames = ['id','Nombre'];
	var colsModel = [ 
		{name:'id',index:'id', width:25, hidden: true},
		{name:'Nombre', index:'Nombre', formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('secuenciaoperaciones/proceso/' + rowObject.id, cellvalue);
			}}
	];	
		
	var grid = jqGridStart('list', 'pager', 'secuenciaoperaciones/ajax/CargarProcesos', colsNames, colsModel, '', '' );

	grid.jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});
})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<a class="btn btn-default pull-right" href="<?php echo base_url('index.php/secuenciaoperaciones/proceso'); ?>">
				<span class="glyphicon glyphicon-file"></span>
				Nuevo proceso
			</a>
			<h1>Procesos</h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li class="active">Procesos</li>
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

