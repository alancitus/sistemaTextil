<?php
	//array_debug($servicio); 
?>
<script>
$(document).ready(function(){
	BuscarProcesos();
	var grid = $("#list");
	var colsnames = ['id','proyecto_id','proceso_id', 'nrooperacion', 'horas','fecha_fin','costo','fecha_real','estado'];
	colsnames = ['id','proyecto_id','proceso_id','Nro. operacion','Nombre del Proceso','Tiempo', 'Fecha Fin', 'Costo','Fecha Real','Estado'];
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
		{name:'nrooperacion', index:'nrooperacion', width:30, search: false},
		{name:'nombreproceso', index:'nombreproceso', search: false},
		{name:'horas', index:'horas', width: 30, search: false},
        {name:'fecha_fin',index:'fecha_fin', width: 30, align:"right", search: false},
		{name:'costo',index:'costo', width: 30, align:"right", search: false},
		{name:'fecha_real',index:'fecha_real', width: 30, align:"right", search: false},
		{name:'estado',index:'estado', width: 30, align:"right", search: false},
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
function BuscarProcesos()
{
	var input = $("#txtproceso");

    input.autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: base_url('services/Procesos'),
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            dataproceso: item.id,
                            value: item.Nombre
                        }
                    }))
                }
            })
        },
        search  : function(){$(this).addClass('ui-autocomplete-loading');},
        open    : function(){$(this).removeClass('ui-autocomplete-loading');},
        select: function (e, ui) {
            $("#txtproceso").attr('dataproceso',ui.item.dataproceso);
        }
    })
}
function addprocesoproyecto(){
	url = '../ajax/AgregarProcesosProyecto';
	nombreproceso = $("#txtproceso").val();
	nrooperacion = $("#list").getGridParam("reccount") +1;
	if($("#id").val() && $("#txtproceso").attr('dataproceso') && $("#txthoras").val() && $("#txtFechafin").val() && $("#txtcosto").val() ){
		$.ajax({
	            dataType: 'JSON',
	            type: 'POST',
	            data: {
	            	proyecto_id:$("#id").val(),
	            	proceso_id:$("#txtproceso").attr('dataproceso'),
	            	horas:$("#txthoras").val(),
	            	fecha_fin:$("#txtFechafin").val(),
	            	costo:$("#txtcosto").val(),
	            	nrooperacion:nrooperacion
	            },
	            url: url,
	            success: function (r) {
	            	r.nombreproceso = nombreproceso;
	            	$("#list").jqGrid('addRowData',r.id,r);
	            },
	            error: function () {
			        alert("error");
			    }
		});
	}
}
function eliminarprocesoproyecto(id){
	if(!confirm('seguro de eliminar')){
		return false;
	}
	url = '../ajax/EliminarProcesosProyecto';
	nombreproceso = $("#txtproceso").val();
	if(id > 0 ){
		$.ajax({
	            dataType: 'JSON',
	            type: 'POST',
	            data: {id:id},
	            url: url,
	            success: function (r) {
	            	console.log(r);
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
			<h1><?php echo $proyecto == null ? "Nuevo Proceso" : $proyecto->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/secuenciaoperaciones/Proyectos'); ?>">Proyectos</a></li>
		  <li class="active"><?php echo $proyecto == null ? "Nuevo Proceso" : $proyecto->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				  <?php if($proyecto) {?>
				  <input type="hidden" name="id" id="id" value="<?php echo $proyecto->id; ?>" />
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