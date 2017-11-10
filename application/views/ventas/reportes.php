<script src="http://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
	$(document).ready(function(){
		Reporte(<?php echo date('Y,m'); ?>);
		$("#sltReporte").change(function(){
			Reporte(<?php echo date('Y,m'); ?>);
		})
		$("#excel").click(function(){
			$(".table").table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: $("#sltReporte option:selected").text() +'_'+ new Date().toLocaleDateString().replace(/[\-\:\.]/g, ""),
				fileext: ".xls",
				exclude_img: false,
				exclude_links: false,
				exclude_inputs: false
			});
		})
		
	})
	
	function Reporte(anio,mes)
	{
		$("#dvReporte").prepend('<div class="block-loading"></div>');
		$("#dvReporte").load(base_url('ventas/ajax/Reporte'),{
			tipo: $("#sltReporte").val(),
			y: anio,
			m: mes
		});
	}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<div class="btn-group pull-right">
				<button id="excel" class="btn btn-info" title="Exportar">
					<span class="glyphicon glyphicon-download-alt"></span>
				</button>
			</div>
			<h1>Reportes</h1>
		</div>
		<ol class="breadcrumb hidden-print">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li class="active">Reportes</li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-4 hidden-print">
						<div class="form-group">
							<label>Reporte actual</label>
							<select id="sltReporte" class="form-control">
								<optgroup label="Reportes por Periodo">
									<option value="1">Reporte Venta Diario</option>
									<option value="2">Reporte Venta Mensual</option>
									<option value="3">Reporte Venta Anual</option>
								</optgroup>
								<optgroup label="Movimiento de su Negocio">
									<option value="5">Top de Clientes</option>
									<option value="7">Top de Empleados</option>
									<option value="4">Top de Productos</option>
								</optgroup>
								<optgroup label="Análisis de Negocio">
									<option value="6">Rentabilidad de Producto Trimestral</option>
								</optgroup>
							</select>
						</div>					
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="col-md-12">
						<div id="dvReporte"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

