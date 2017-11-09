<?php //echo array_debug($ProductosSinStock); ?>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1>Inicio</h1>
		</div>
		<?php if($this->user->Tipo == 1 || $this->user->Tipo == 2): ?>
		<div class="row resume">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Vendido Hoy</span>
							<span class="glyphicon glyphicon-arrow-up"></span>
							<?php echo $this->conf->Moneda_id; ?> <span class="total"><?php echo number_format($resumen->Vendido, 2); ?></span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Ganado Hoy</span>
							<span class="glyphicon glyphicon-arrow-up"></span>
							<?php echo $this->conf->Moneda_id; ?> <span class="total"><?php echo number_format($resumen->Ganado, 2); ?></span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Comprobantes de Hoy</span>
							<span class="glyphicon glyphicon-book"></span>
							<span class="total"><?php echo $resumen->Comprobantes; ?></span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Clientes</span>
							<span class="glyphicon glyphicon-user"></span>
							<span class="total"><?php echo $resumen->Clientes; ?></span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Productos</span>
							<span class="glyphicon glyphicon-shopping-cart"></span>
							<span class="total"><?php echo $resumen->Productos; ?></span>						
						</div>
					</div>
					<div class="col-md-2">
						<div class="well well-sm">
							<span class="legend">Servicios</span>
							<span class="glyphicon glyphicon-briefcase"></span>
							<span class="total"><?php echo $resumen->Servicios; ?></span>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr />
		<?php endif; ?>
		<?php if(HasModule('stock') && count($ProductosSinStock) > 0): ?>
			<fieldset>
				<legend class="text-center">Productos que se están quedando sin Stock</legend>
				<div class="well well-sm">
					<table class="table table-striped">
					<?php foreach($ProductosSinStock as $p): ?>
						<tr>
							<td><?php echo $p->Nombre; ?></td>
							<td class="text-right" style="width:100px;">
								<b><?php echo $p->Stock . ' ' . $p->UnidadMedida_id; ?></b>
							</td>
							<td class="text-right" style="width:100px;">
								<a target="_blank" href="<?php echo base_url('index.php/almacen/entrada/' . $p->id); ?>" class="btn btn-success btn-xs">
									<i class="glyphicon glyphicon-plus"></i> Abastecer
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
			</fieldset>
		<?php endif; ?>


		<div class="well">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Extensiones</th>
						<th class="text-right" style="width:100px;"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Control de Stock</td>
						<td class="text-right"><?php echo HasModule('stock') ? '<span class="badge badge-green"><i class="glyphicon glyphicon-ok"></i></span>' : '<span class="badge badge-red"><i class="glyphicon glyphicon-remove"></i></span>' ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>