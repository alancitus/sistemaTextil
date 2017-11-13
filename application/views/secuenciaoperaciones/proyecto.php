<?php
	//array_debug($servicio); 
?>
<script>
$(document).ready(function(){
	BuscarServicios();
	var grid = $("#list");
	var colsnames = ['id','proyecto_id','proceso_id', 'nrooperacion', 'horas','fecha_fin','costo','fecha_real','estado'];
	colsnames = ['id','proyecto_id','proceso_id','Acciones','Nro. operacion','Nombre del Proceso','Tiempo', 'Fecha Fin', 'Costo'];
	var colsmodel = [ 
		{name:'id',index:'id', width:25, hidden: true},
		{name:'proyecto_id',index:'proyecto_id', width:25, hidden: true},
		{name:'proceso_id', index:'Nombre del Proceso', search: false},
		{name:'nrooperacion', index:'Horas', width: 30, search: false},
        {name:'horas',index:'Fecha Fin', width: 30, align:"right", search: false},
		{name:'fecha_fin',index:'Precio', width: 30, align:"right", search: false},
		{name:'costo',index:'Precio', width: 30, align:"right", search: false},
		{name:'fecha_real',index:'Precio', width: 30, align:"right", search: false},
		{name:'estado',index:'Precio', width: 30, align:"right", search: false}
		
	];
	colsmodel = [ 
		{name:'id',index:'id', hidden: true},
		{name:'proyecto_id',index:'proyecto_id', hidden: true},
		{name:'proceso_id',index:'proceso_id', hidden: true},
		{name: 'Acciones',index:'Acciones',search:false, width:30,formatter:function (cellvalue, options, rowObject) {    
		    return "<button class='btn btn-default' onclick='some_function'\><span class='glyphicon glyphicon-minus'></span></button>";
		}},
		{name:'nrooperacion', index:'nrooperacion', width:30, search: false},
		{name:'nombreproceso', index:'nombreproceso', search: false},
		{name:'horas', index:'horas', width: 30, search: false},
        {name:'fecha_fin',index:'fecha_fin', width: 30, align:"right", search: false},
		{name:'costo',index:'costo', width: 30, align:"right", search: false}
	];	
	url = 'secuenciaoperaciones/ajax/CargarProcesosProyecto';
	<?php if($proyecto) {?>
			url = url + "?proyecto_id="+ <?php echo $proyecto->id ?>;
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
	  		sortname: 'nrooperacion',
	  		viewrecords: true,
	  		sortorder: '',
	  		autowidth:true,
	  		height: 'auto',
	  		filterToolbar: true
		}
	);
	
	grid.jqGrid('filterToolbar', {stringResult: false, searchOnEnter: true});
})
function BuscarServicios()
{
	var input = $("#txtproyecto");

    input.autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: base_url('services/Proyectos'),
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.id,
                            value: item.Nombre
                        }
                    }))
                }
            })
        },
        search  : function(){$(this).addClass('ui-autocomplete-loading');},
        open    : function(){$(this).removeClass('ui-autocomplete-loading');},
        select: function (e, ui) {
        	return false;
        }
    })
}


</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $proyecto == null ? "Nuevo Proceso" : $proyecto->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/secuenciaoperaciones/Procesos'); ?>">Procesos</a></li>
		  <li class="active"><?php echo $proyecto == null ? "Nuevo Proceso" : $proyecto->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">(*) Campos obligatorios</div>
				<?php echo form_open('secuenciaoperaciones/Proyectoscrud', array('class' => 'upd')); ?>
				<?php if($proyecto != null): ?>
				<input type="hidden" name="id" value="<?php echo $proyecto->id; ?>" />
				<?php endif; ?>
				  <div class="form-group">
				    <label>Nombre (*)</label>
				    <input autocomplete="off" id="txtproyecto" name="nombre" type="text" class="form-control required" placeholder="Nombre del proyecto" value="<?php echo $proyecto != null ? $proyecto->Nombre : null; ?>" />
				  </div>
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-md-6">
				  			<label>Fecha de inicio (*)</label>
				  			<div class="input-group">
				  				<input id="From" autocomplete="off" name="Fecha_inicio" class="form-control datepicker required" type="text" value="<?php echo $proyecto != null ? DateFormat($proyecto->Fecha_inicio,6) : null; ?>" placeholder="Inicio" />
				  				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				  			</div>
				  		</div>
				  		<div class="col-md-6">
				  			<label>Fecha de fin (*)</label>
				  			<div class="input-group">
				  				<input id="to" autocomplete="off" name="Fecha_fin" class="form-control datepicker required" type="text" value="<?php echo $proyecto != null ? DateFormat($proyecto->Fecha_fin,6) : null; ?>" placeholder="Fin" />
				  				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				  			</div>
				  		</div>
				  	</div>
				  </div>

				<div class="clearfix text-right">
					<?php if(isset($proyecto)): ?>
					<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/secuenciaoperaciones/proyectoeliminar/' . $proyecto->id); ?>">Eliminar</button>
					<?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				</div>
				<?php echo form_close(); ?>
				  <?php if($proyecto) {?>
				  <div class="form-group">
				  	<div class="row">
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<input autocomplete="off" id="txtproceso" name="nombreproceso" type="text" class="form-control" placeholder="Nombre del proceso" value="" />
				  		</div>
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<input autocomplete="off" id="txthoras" name="horas" type="text" class="form-control" placeholder="Horas" value="" />
				  		</div>
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<div class="input-group">
				  				<input id="txtFechafin" autocomplete="off" class="form-control datepicker" type="text" value="" placeholder="Fecha Fin" />
				  				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				  			</div>
				  		</div>
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<input autocomplete="off" id="txtcosto" name="costo" type="text" class="form-control" placeholder="Costo" value="" />
				  		</div>
				  		<div class="col-md-3">
				  			<label>&nbsp;</label>
				  			<div class="input-group">
				  				<button class="btn btn-info" type="button" onclick="addprocesoproyecto()">Agregar</button>
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