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
                url: base_url('services/proveedores'),
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
			<h1><?php echo $costo == null ? "Registro de Costo de Producción" : $costo->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/mantenimiento/costo'); ?>">Costos de Producción</a></li>
		  <li class="active"><?php echo $costo == null ? "Nuevo Item" : $costo->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('mantenimiento/costocrud', array('class' => 'upd')); ?>
				<?php if($costo != null): ?>
				<input type="hidden" name="id" value="<?php echo $costo->id; ?>" />
				<?php endif; ?>
				  <div class="well well-sm">(*) Campos obligatorios</div>
				  <div class="form-group">
				    <label>Nombre (*)</label>
				    <input id="txtCliente" autocomplete="off" name="Nombre" type="text" class="form-control required" placeholder="Nombre del proveedor" value="<?php echo $costo != null ? $costo->Nombre : null; ?>" />
				  </div>
		
		

 <div class="form-group">
				    <label>Tela</label>
				    <input autocomplete="off" name="Tela"  type="text" class="form-control" placeholder="Tela" value="<?php echo $costo != null ? $costo->Tela : null; ?>" />
				  </div>

 <div class="form-group">
				    <label>Otros</label>
				    <input autocomplete="off" name="Otros"  type="text" class="form-control" placeholder="Otros" value="<?php echo $costo != null ? $costo->Otros : null; ?>" />
				  </div>		


<div class="form-group">
				    <label>Hilos</label>
				    <input autocomplete="off" name="Hilos"  type="text" class="form-control" placeholder="Hilos" value="<?php echo $costo != null ? $costo->Hilos : null; ?>" />
				  </div>		


<div class="form-group">
				    <label>Botones</label>
				    <input autocomplete="off" name="Botones"  type="text" class="form-control" placeholder="Botones" value="<?php echo $costo != null ? $costo->Botones : null; ?>" />
				  </div>		


<div class="form-group">
				    <label>Broches</label>
				    <input autocomplete="off" name="Broches"  type="text" class="form-control" placeholder="Broches" value="<?php echo $costo != null ? $costo->Broches : null; ?>" />
				  </div>	


<div class="form-group">
				    <label>Otros Avios</label>
				    <input autocomplete="off" name="Otros_Avios"  type="text" class="form-control" placeholder="Otros_Avios" value="<?php echo $costo != null ? $costo->Otros_Avios : null; ?>" />
				  </div>	
<div class="form-group">
				    <label>Mano de Obra Directa</label>
				    <input autocomplete="off" name="Mano_Obra"  type="text" class="form-control" placeholder="Mano_Obra" value="<?php echo $costo != null ? $costo->Mano_Obra : null; ?>" />
				  </div>	

 <div class="form-group">
				    <label>Teléfono</label>
				    <input autocomplete="off" name="Telefono"  type="text" class="form-control" placeholder="Telefono" value="<?php echo $costo != null ? $costo->Telefono : null; ?>" />
				  </div>	

 <div class="form-group">
				    <label>Leasing</label>
				    <input autocomplete="off" name="Leasing"  type="text" class="form-control" placeholder="Leasing" value="<?php echo $costo != null ? $costo->Leasing : null; ?>" />
				  </div>	

 <div class="form-group">
				    <label>Tercearizacion</label>
				    <input autocomplete="off" name="Tercearizacion"  type="text" class="form-control" placeholder="Tercearizacion" value="<?php echo $costo != null ? $costo->Tercearizacion : null; ?>" />
				  </div>	

 <div class="form-group">
				    <label>Depreciacion</label>
				    <input autocomplete="off" name="Depreciacion"  type="text" class="form-control" placeholder="Depreciacion" value="<?php echo $costo != null ? $costo->Depreciacion : null; ?>" />
				  </div>	

 <div class="form-group">
				    <label>Packing</label>
				    <input autocomplete="off" name="Packing"  type="text" class="form-control" placeholder="Packing" value="<?php echo $costo != null ? $costo->Packing : null; ?>" />
				  </div>	



	 <div class="form-group">
				    <label>Luz</label>
				    <input autocomplete="off" name="Luz"  type="text" class="form-control" placeholder="Luz" value="<?php echo $costo != null ? $costo->Luz : null; ?>" />
				  </div>	


	 <div class="form-group">
				    <label>Agua</label>
				    <input autocomplete="off" name="Agua"  type="text" class="form-control" placeholder="Agua" value="<?php echo $costo != null ? $costo->Agua : null; ?>" />
				  </div>	
	 <div class="form-group">
				    <label>Bordado</label>
				    <input autocomplete="off" name="Bordado"  type="text" class="form-control" placeholder="Bordado" value="<?php echo $costo != null ? $costo->Bordado : null; ?>" />
				  </div>	

	 <div class="form-group">
				    <label>Fusionado</label>
				    <input autocomplete="off" name="Fusionado"  type="text" class="form-control" placeholder="Fusionado" value="<?php echo $costo != null ? $costo->Fusionado : null; ?>" />
				  </div>	



				  <div class="clearfix text-right">
				  <?php if(isset($costo)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/mantenimiento/compraeliminar/' . $costo->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>