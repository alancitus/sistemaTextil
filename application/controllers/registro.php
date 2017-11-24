<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class registro extends CI_Controller 
{
	public function __CONSTRUCT()
	{
		parent::__construct();
		$this->load->model('compramodel', 'rcm');
		$this->load->model('ventamodel', 'rvm');
	}
	public function compras()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('registro/compras');
		$this->load->view('footer');		
	}
	public function compra($id=0)
	{
		$p = $id > 0 ? $this->rcm->Obtener($id) : null;
		 
 		$this->load->view('header');
		$this->load->view('registro/compra', 
							array( 
								'compra' => $p
								));
		$this->load->view('footer');		
	}
	public function Comprascrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode(isset($_POST['id']) ? $this->rcm->Actualizar(SafeRequestParameters($_POST)) : $this->rcm->Registrar(SafeRequestParameters($_POST))));		
	}
	public function compraeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode($this->rcm->Eliminar($id)));		
	}
	public function ventas()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('registro/ventas');
		$this->load->view('footer');		
	}
	public function venta($id=0)
	{
		$p = $id > 0 ? $this->rvm->Obtener($id) : null;
		
		$this->load->view('header');
		$this->load->view('registro/venta',
					array(
						'venta' => $p
					));
		$this->load->view('footer');		
	}
	public function Ventascrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
        if(IS_DEMO == 1)
        {
            print_r(json_encode(array('response' => false, 'message' => 'La <b>versión DEMO</b> no permite guardar los datos de los Usuarios.')));            
        } else {
            print_r(json_encode( isset($_POST['id']) ? $this->rvm->Actualizar(SafeRequestParameters($_POST)) : $this->rvm->Registrar(SafeRequestParameters($_POST))) );            
        }
	}
	public function ventaeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
		print_r(json_encode($this->rvm->Eliminar($id)));
	}
	
	public function Ajax($action)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		switch($action)
		{
			case 'AgregarProcesosProyecto':
				print_r(json_encode($this->ppm->Registrar($_POST)));
				break;
			case 'EditarProcesosProyecto':
				unset($_POST['oper']);
				print_r(json_encode($this->ppm->Actualizar($_POST)));
				break;
			case 'EliminarProcesosProyecto':
				print_r(json_encode($this->ppm->Eliminar($_POST['id'])));
				break;
			case 'CargarProyectos':
				print_r(json_encode($this->rvm->Listar()));
				break;
			case 'Cargarventas':
				print_r(json_encode($this->rvm->Listar()));
				break;
			case 'Cargarcompras':
				print_r(json_encode($this->rcm->Listar()));
				break;
		}
	}
}