<script>
$(document).ready(function(){
	var colsNames = ['id','Nombre','Marca','Acciones'];
	var colsModel = [ 
		{name:'id',index:'id', width:55, hidden: true},
		{name:'Nombre', index:'Nombre', sopt: 'like', formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('mantenimiento/Maquinaria/' + rowObject.id, cellvalue);
			}},
		{name:'Marca',index:'Marca', width:35},
		{name:'Acciones',index:'Acciones', width: 30, align:"right", search: false, formatter: function(cellvalue, options, rowObject){
				return jqGridCreateLink('mantenimiento/MaquinariaHistorial/' + rowObject.id, 'Historial de revision');
			}
		}
	];	
		
	var grid = jqGridStart('list', 'pager', 'mantenimiento/ajax/CargarMaquinarias', colsNames, colsModel, '', '' );

	grid.jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true});
})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<a class="btn btn-default pull-right" href="<?php echo base_url('index.php/mantenimiento/maquinaria'); ?>">
				<span class="glyphicon glyphicon-file"></span>
				Nueva Maquinaria
			</a>
			<h1>Maquinarias</h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li class="active">Maquinarias</li>
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

