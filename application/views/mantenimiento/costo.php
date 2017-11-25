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
    calcularcostos();
    $("input").change(function(){
    	calcularcostos();
    })
}
function calcularcostos(){
	manodeobradirecta = 0;
	if($("#txtmanoobra").val())
	manodeobradirecta = parseFloat($("#txtmanoobra").val());
	totalmateriaprima = 0;
	if($("#txttela").val())
	totalmateriaprima = parseFloat($("#txttela").val());
	if($("#txtotros").val())
	totalmateriaprima += parseFloat($("#txtotros").val());
	totalotrosavios = totalmateriaprima;
	if($("#txtbotones").val())
	totalotrosavios -= parseFloat($("#txtbotones").val());
	if($("#txthilos").val())
	totalotrosavios -= parseFloat($("#txthilos").val());
	if($("#txtbroches").val())
	totalotrosavios -= parseFloat($("#txtbroches").val());
	totalcostosfabricacion = 0;
	if($("#txttelefono").val())
	totalcostosfabricacion += parseFloat($("#txttelefono").val());
	if($("#txtleasing").val())
	totalcostosfabricacion += parseFloat($("#txtleasing").val());
	if($("#txttercearizacion").val())
		totalcostosfabricacion += parseFloat($("#txttercearizacion").val());
	if($("#txtdepreciacion").val())
		totalcostosfabricacion += parseFloat($("#txtdepreciacion").val());	
	if($("#txtpacking").val())
		totalcostosfabricacion += parseFloat($("#txtpacking").val());
	if($("#txtluz").val())
		totalcostosfabricacion += parseFloat($("#txtluz").val());
	if($("#txtagua").val())
		totalcostosfabricacion += parseFloat($("#txtagua").val());
	if($("#txtbordado").val())
		totalcostosfabricacion += parseFloat($("#txtbordado").val());
	if($("#txtfusionado").val())
		totalcostosfabricacion += parseFloat($("#txtfusionado").val());
	totalcostosproduccion = 0;
	totalcostosproduccion = totalotrosavios + manodeobradirecta + totalcostosfabricacion;


	$("#totalmateriaprima").html(totalmateriaprima);
	$("#txtotrosavios").val(totalotrosavios);
	$("#totalcostosfabricacion").html(totalcostosfabricacion);
	$("#totalcostosproduccion").html(totalcostosproduccion);
	$("#txtcostoproduccion").val(totalcostosproduccion);
unidadesproducidas = 0;
if($("#txtunidadesproducidas").val())
unidadesproducidas = parseFloat($("#txtunidadesproducidas").val());

cu_mp = 0;
cu_mo = 0;
cu_gf = 0;
if(unidadesproducidas>0){
	cu_mp = parseFloat(totalotrosavios/unidadesproducidas);
	cu_mo = parseFloat(manodeobradirecta/unidadesproducidas);
	cu_gf = parseFloat(totalcostosfabricacion/unidadesproducidas);

}
$("#cu_mp").html(cu_mp);
$("#cu_mo").html(cu_mo);
$("#cu_gf").html(cu_gf);
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $costo == null ? "Registro de Costo de Producción" : $costo->Nombre; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/mantenimiento/costos'); ?>">Costos de Producción</a></li>
		  <li class="active"><?php echo $costo == null ? "Nuevo Item" : $costo->Nombre; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<?php echo form_open('mantenimiento/costocrud', array('class' => 'upd form-horizontal')); ?>
				<?php if($costo != null): ?>
				<input type="hidden" name="id" value="<?php echo $costo->id; ?>" />
				<?php endif; ?>
				  <div class="well well-sm">(*) Campos obligatorios</div>
				  <div class="form-group">
				    <label  class="control-label col-sm-2">Nombre (*)</label>
				    <div class="col-sm-10">
				    <input id="txtCliente" autocomplete="off" name="Nombre" type="text" class="form-control required" placeholder="Nombre del proveedor" value="<?php echo $costo != null ? $costo->Nombre : null; ?>" />
				</div>
				  </div>
		
		

 <div class="form-group">
				    <label  class="control-label col-sm-2">Tela</label>
				    <div class="col-sm-10">
					    <input autocomplete="off" name="Tela" id="txttela"  type="text" class="form-control" placeholder="Tela" value="<?php echo $costo != null ? $costo->Tela : null; ?>" />
					</div>
				  </div>

 <div class="form-group">
				    <label  class="control-label col-sm-2">Otros</label>
				    <div class="col-sm-10">
				    	<input autocomplete="off" name="Otros" id="txtotros"  type="text" class="form-control" placeholder="Otros" value="<?php echo $costo != null ? $costo->Otros : null; ?>" />
				    </div>
				  </div>		
<div class="form-group">
	<label  class="control-label col-sm-2">Total</label>
	<div class="col-sm-10" id="totalmateriaprima">	   	
	</div>
</div>

<div class="form-group">
				    <label  class="control-label col-sm-2">Hilos</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Hilos" id="txthilos" type="text" class="form-control" placeholder="Hilos" value="<?php echo $costo != null ? $costo->Hilos : null; ?>" />
				  	</div>
				  </div>		


<div class="form-group">
				    <label  class="control-label col-sm-2">Botones</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Botones" id="txtbotones"  type="text" class="form-control" placeholder="Botones" value="<?php echo $costo != null ? $costo->Botones : null; ?>" />
					</div>
				  </div>	


<div class="form-group">
				    <label  class="control-label col-sm-2">Broches</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Broches" id="txtbroches"  type="text" class="form-control" placeholder="Broches" value="<?php echo $costo != null ? $costo->Broches : null; ?>" />
				  </div></div>


<div class="form-group">
				    <label  class="control-label col-sm-2">Otros Avios</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Otros_Avios" id="txtotrosavios" type="text" class="form-control" placeholder="Otros_Avios" value="<?php echo $costo != null ? $costo->Otros_Avios : null; ?>" />
				  </div></div>
<div class="form-group">
				    <label  class="control-label col-sm-2">Mano de Obra Directa</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Mano_Obra" id="txtmanoobra" type="text" class="form-control" placeholder="Mano_Obra" value="<?php echo $costo != null ? $costo->Mano_Obra : null; ?>" />
				  </div></div>

 <div class="form-group">
				    <label  class="control-label col-sm-2">Teléfono</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Telefono" id="txttelefono"  type="text" class="form-control" placeholder="Telefono" value="<?php echo $costo != null ? $costo->Telefono : null; ?>" />
				  </div></div>

 <div class="form-group">
				    <label  class="control-label col-sm-2">Leasing</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Leasing" id="txtleasing"  type="text" class="form-control" placeholder="Leasing" value="<?php echo $costo != null ? $costo->Leasing : null; ?>" />
				  </div></div>	

 <div class="form-group">
				    <label  class="control-label col-sm-2">Tercearizacion</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Tercearizacion" id="txttercearizacion"  type="text" class="form-control" placeholder="Tercearizacion" value="<?php echo $costo != null ? $costo->Tercearizacion : null; ?>" />
				  </div>
				  </div>	

 <div class="form-group">
				    <label  class="control-label col-sm-2">Depreciacion</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Depreciacion" id="txtdepreciacion" type="text" class="form-control" placeholder="Depreciacion" value="<?php echo $costo != null ? $costo->Depreciacion : null; ?>" />
				  </div>	
				  </div>

 <div class="form-group">
				    <label  class="control-label col-sm-2">Packing</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Packing" id="txtpacking"  type="text" class="form-control" placeholder="Packing" value="<?php echo $costo != null ? $costo->Packing : null; ?>" />
				  </div>
				  </div>	



	 <div class="form-group">
				    <label  class="control-label col-sm-2">Luz</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Luz" id="txtluz"  type="text" class="form-control" placeholder="Luz" value="<?php echo $costo != null ? $costo->Luz : null; ?>" />
				    </div>
				  </div>	


	 <div class="form-group">
				    <label  class="control-label col-sm-2">Agua</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Agua" id="txtagua"  type="text" class="form-control" placeholder="Agua" value="<?php echo $costo != null ? $costo->Agua : null; ?>" />
				</div>				  
				  </div>	
	 <div class="form-group">
				    <label  class="control-label col-sm-2">Bordado</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Bordado" id="txtbordado" type="text" class="form-control" placeholder="Bordado" value="<?php echo $costo != null ? $costo->Bordado : null; ?>" />
				  </div>
				  </div>	

	 <div class="form-group">
				    <label  class="control-label col-sm-2">Fusionado</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="Fusionado" id="txtfusionado" type="text" class="form-control" placeholder="Fusionado" value="<?php echo $costo != null ? $costo->Fusionado : null; ?>" />
					</div>
				  </div>	
<div class="form-group">
	<label  class="control-label col-sm-2">Total Costo de Fabricacion
	</label>
	<div class="col-sm-10" id="totalcostosfabricacion">	   	
	</div>
</div>	
<div class="form-group">
	<label  class="control-label col-sm-2">Total Costo de Producción
		<input type="hidden" id="txtcostoproduccion" name="Costo_Produccion">
	</label>
	<div class="col-sm-10" id="totalcostosproduccion">	   	
	</div>
</div>	
				<div class="form-group">
				    <label  class="control-label col-sm-2">Unidades Producidas</label>
				    <div class="col-sm-10">
				    <input autocomplete="off" name="unidadesproducidas" id="txtunidadesproducidas" type="text" class="form-control" placeholder="Unidades Producidas" value="<?php echo $costo != null ? $costo->unidadesproducidas : null; ?>" />
					</div>
				  </div>
<div class="form-group">
	<label  class="control-label col-sm-2">Costo Unit. MP</label>
	<div class="col-sm-10" id="cu_mp">	   	
	</div>
</div>
<div class="form-group">
	<label  class="control-label col-sm-2">Costo Unit. Mano de Obra</label>
	<div class="col-sm-10" id="cu_mo">	   	
	</div>
</div>
<div class="form-group">
	<label  class="control-label col-sm-2">Costo Unit. Gastos de Fabricación</label>
	<div class="col-sm-10" id="cu_gf">	   	
	</div>
</div>

				  <div class="clearfix text-right">
				  <?php if(isset($costo)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/mantenimiento/costoeliminar/' . $costo->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>