<?php
	//array_debug($servicio); 
?>
<script>
$(document).ready(function(){
	BuscarServicios();
})
function BuscarServicios()
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
			<h1><?php echo $proceso == null ? "Nuevo Proceso" : $proceso->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/secuenciaoperaciones/Procesos'); ?>">Procesos</a></li>
		  <li class="active"><?php echo $proceso == null ? "Nuevo Proceso" : $proceso->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">(*) Campos obligatorios</div>
				<?php echo form_open('secuenciaoperaciones/Procesoscrud', array('class' => 'upd')); ?>
				<?php if($proceso != null): ?>
				<input type="hidden" name="id" value="<?php echo $proceso->id; ?>" />
				<?php endif; ?>
				  <div class="form-group">
				    <label>Nombre (*)</label>
				    <input autocomplete="off" id="txtproceso" name="nombre" type="text" class="form-control required" placeholder="Nombre del proceso" value="<?php echo $proceso != null ? $proceso->Nombre : null; ?>" />
				  </div>
				  <div class="clearfix text-right">
				  <?php if(isset($proceso)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/secuenciaoperaciones/procesoeliminar/' . $proceso->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>