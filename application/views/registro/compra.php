<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://www.ok-soft-gmbh.com/jqGrid/jquery.jqGrid-4.4.0/css/ui.jqgrid.css" />
<script>
$(document).ready(function(){
	$("#list").jqGrid({
		datatype: "local",
		height: 250,
	   	colNames:['1','2', '3', '4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27'],
	   	colModel:[
	   		{name:'id',index:'id', sorttype:"int", editable:true},
	   		{name:'c2',index:'c2', sorttype:"date", editable:true},
	   		{name:'c3',index:'c3', editable:true},
	   		{name:'c4',index:'c4', align:"right",sorttype:"float", editable:true},
	   		{name:'c5',index:'c5', align:"right",sorttype:"float", editable:true},		
	   		{name:'c6',index:'c6', align:"right",sorttype:"float", editable:true},		
	   		{name:'c7',index:'c7',  sortable:false, editable:true}		,		
	   		{name:'c8',index:'c8',  sortable:false, editable:true}	,		
	   		{name:'c9',index:'c9',   sortable:false, editable:true}	,		
	   		{name:'c10',index:'c10', sortable:false, editable:true}	,		
	   		{name:'c11',index:'c11', sortable:false, editable:true}	,		
	   		{name:'c12',index:'c12', sortable:false, editable:true}	,		
	   		{name:'c13',index:'c13', sortable:false, editable:true}	,		
	   		{name:'c14',index:'c14', sortable:false, editable:true}	,		
	   		{name:'c15',index:'c15', sortable:false, editable:true}	,		
	   		{name:'c16',index:'c16', sortable:false, editable:true}	,		
	   		{name:'c17',index:'c17', sortable:false, editable:true}	,		
	   		{name:'c18',index:'c18', sortable:false, editable:true}	,		
	   		{name:'c19',index:'c19', sortable:false, editable:true}	,		
	   		{name:'c20',index:'c20', sortable:false, editable:true}	,		
	   		{name:'c21',index:'c21', sortable:false, editable:true}	,		
	   		{name:'c22',index:'c22', sortable:false, editable:true}	,		
	   		{name:'c23',index:'c23', sortable:false, editable:true}	,		
	   		{name:'c24',index:'c24', sortable:false, editable:true}	,		
	   		{name:'c25',index:'c25', sortable:false, editable:true}	,		
	   		{name:'c26',index:'c26', sortable:false, editable:true}	,		
	   		{name:'c27',index:'c27', sortable:false, editable:true}	
	   	],
	   	pager: '#pager',
        rowNum: 10,
        rowList: [5, 10, 20, 50],
        sortname: 'id',
        sortorder: 'asc',
        viewrecords: true,
        gridview: true,
        height: "100%"
	});
	//$("#list").jqGrid('navGrid', '#mypager', { edit: true, add: false, del: false, search: true });
	//$("#list").jqGrid('navGrid',"#pager",{edit:false,add:false,del:true, search: false, refresh: false ,view: false, warning:false});
	//$("#list").jqGrid('inlineNav',"#pager");
	$('#list').navGrid("#pager", {edit: false, add: false, del: false, refresh: false, view: false});
            $('#list').inlineNav('#pager',
                // the buttons to appear on the toolbar of the grid
                { 
                    edit: true, 
                    add: true, 
                    del: true, 
                    cancel: true,
                    editParams: {
                        keys: true,
                    },
                    addParams: {
                        keys: true
                    }
                });

	/*
	var mydata = [
			{id:"1",invdate:"2007-10-01",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
			{id:"2",invdate:"2007-10-02",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
			{id:"3",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
			{id:"4",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
			{id:"5",invdate:"2007-10-05",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
			{id:"6",invdate:"2007-09-06",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"},
			{id:"7",invdate:"2007-10-04",name:"test",note:"note",amount:"200.00",tax:"10.00",total:"210.00"},
			{id:"8",invdate:"2007-10-03",name:"test2",note:"note2",amount:"300.00",tax:"20.00",total:"320.00"},
			{id:"9",invdate:"2007-09-01",name:"test3",note:"note3",amount:"400.00",tax:"30.00",total:"430.00"}
			];
	for(var i=0;i<=mydata.length;i++)
		$("#list").jqGrid('addRowData',i+1,mydata[i]);
	*/


	
})
</script>
<div class="row">
	<div class="col-md-12">
		<div class="page-header">
			<h1><?php echo $compra == null ? "Nuevo registro compra" : $compra->mes; ?></h1>
		</div>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('index.php'); ?>">Inicio</a></li>
		  <li><a href="<?php echo base_url('index.php/registro/compras'); ?>">compras</a></li>
		  <li class="active"><?php echo $compra == null ? "Nuevo compra" : $compra->mes; ?></li>
		</ol>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">(*) Campos obligatorios</div>
				<?php echo form_open('registro/comprascrud', array('class' => 'upd')); ?>
				<?php if($compra != null): ?>
				<input type="hidden" name="id" value="<?php echo $compra->id; ?>" />
				<?php endif; ?>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtmes" name="mes" type="text" class="form-control required" placeholder="mes" value="<?php echo $compra != null ? $compra->mes : null; ?>" />
				  </div>
				  <div class="form-group">
				    <label>Mes (*)</label>
				    <input autocomplete="off" id="txtanho" name="anho" type="text" class="form-control required" placeholder="año" value="<?php echo $compra != null ? $compra->anho : null; ?>" />
				  </div>
				  <div class="clearfix text-right">
				  <?php if(isset($compra)): ?>
				  	<button type="button" class="btn btn-danger submit-ajax-button del" value="<?php echo base_url('index.php/registro/compraeliminar/' . $compra->id); ?>">Eliminar</button>
			  	  <?php endif; ?>
				  	<button type="submit" class="btn btn-info submit-ajax-button">Guardar</button>
				  </div>
				<?php echo form_close(); ?>
			</div>
				<div class="col-md-12">
				  	<div class="table-responsive">
				  		<table id="list"></table>
				  		<div id="pager"></div>
				  	</div>
				</div>
		</div>
	</div>
</div>