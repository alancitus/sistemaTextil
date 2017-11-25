<script>
$(document).ready(function(){
	var colsNames = ['id','Mes','Año'];
	var colsModel = [ 
		{name:'id',index:'id', width:25, hidden: true},
		{name:'mes', index:'mes', formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('registro/compra/' + rowObject.id, cellvalue);
			}		
		},
		{name:'anho',index:'anho'}
	];	
		
	var grid = jqGridStart('list', 'pager', 'registro/ajax/Cargarventas', colsNames, colsModel, '', '' );

	grid.jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});
})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<a class="btn btn-default pull-right" href="<?php echo base_url('index.php/registro/compra'); ?>">
				<span class="glyphicon glyphicon-file"></span>
				Nuevo registro de compra
			</a>
			<h1>Registro de ventas</h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li class="active">Registro de ventas</li>
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
