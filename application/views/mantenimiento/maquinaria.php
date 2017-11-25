<?php
	//array_debug($cliente); 
?>
<script>
$(document).ready(function(){
	BuscarClientes();
})
function BuscarClientes(){
	var input = $("#txtCliente");

    input.autocomplete({
        dataType: 'JSON',
        source: function (request, response) {
            jQuery.ajax({
                url: base_url('services/maquinarias'),
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            id: item.id,
                            value: item.Nombre,
                            identidad: item.Identidad,
                            direccion: item.Direccion
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
			<h1><?php echo $maquinaria == null ? "Nueva Maquinaria" : $maquinaria->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/mantenimiento/maquinarias'); ?>">Maquinarias</a></li>
		  <li class="active"><?php echo $maquinaria == null ? "Nuevo Item" : $maquinaria->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('mantenimiento/maquinariacrud', array('class' => 'upd')); ?>
				<?php if($maquinaria != null): ?>
				<input type="hidden" name="id" value="<?php echo $maquinaria->id; ?>" />
				<?php endif; ?>
				  <div class="well well-sm">(*) Campos obligatorios</div>
 <div class="form-group">
				    <label>Nombre o Tipo de Máquina</label>
				    <input autocomplete="off" name="Nombre"  type="text" class="form-control" placeholder="Nombre" value="<?php echo $maquinaria != null ? $maquinaria->Nombre : null; ?>" />
				  </div>
			
			
				  <div class="form-group">
				    <label>Marca</label>
				    <input autocomplete="off" name="Marca"  type="text" class="form-control" placeholder="Marca" value="<?php echo $maquinaria != null ? $maquinaria->Marca : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Número de Serie</label>
				    <input autocomplete="off" name="Codigo"  type="text" class="form-control" placeholder="Código" value="<?php echo $maquinaria != null ? $maquinaria->Codigo : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Motor</label>
				    <input autocomplete="off" name="Motor"  type="text" class="form-control" placeholder="Motor" value="<?php echo $maquinaria != null ? $maquinaria->Motor : null; ?>" />
				  </div>
				  	  <div class="form-group">
				    <label>Año</label>
				    <input autocomplete="off" name="Anho"  type="text" class="form-control" placeholder="Año" value="<?php echo $maquinaria != null ? $maquinaria->Anho : null; ?>" />
				  </div>
				  <div class="form-group">
                    <label>Foto</label>
                    <input name="Foto" type="file" autocomplete="off" />
                  </div>
                    <?php if($maquinaria != null): ?>
                    <?php if($maquinaria->Foto != ''): ?>
                    <div class="form-group">
                        <img src="<?php echo base_url('machines/' . $maquinaria->Foto); ?>"></img><?php endif; ?>
                    </div>
                    <?php endif; ?>
				  <div class="clearfix text-right">
				  <?php if(isset($maquinaria)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/mantenimiento/maquinariaeliminar/' . $maquinaria->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>