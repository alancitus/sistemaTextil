<?php 
Class ProcesoproyectoModel extends CI_Model
{
	public function Actualizar($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('proyecto', $data);
		
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$fecha_fin = $data['fecha_fin'];
		$data['fecha_fin'] = ToDate($data['fecha_fin']);
		$this->db->insert('procesoproyecto', $data);
		$new_id = $this->db->insert_id();
		$data['id'] = $new_id;
		$data['fecha_fin'] =  $fecha_fin;
		return $data;
	}
	public function Eliminar($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('procesoproyecto');
		return $id;

	}
	public function Listar($proyecto_id)
	{
		//$where = 'proyecto_id = ' . $this->proyecto->proyecto_id . ' ';
		$where = 'proyecto_id = '.$proyecto_id.' ';
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;
		
		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM procesoproyecto')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->db->join('proyecto','procesoproyecto.proyecto_id = proyecto.id');
		$this->db->join('proceso','procesoproyecto.proceso_id = proceso.id');
		$this->db->select('procesoproyecto.*,proceso.nombre as nombreproceso, proyecto.nombre as nombreproyecto');
		$this->db->select(' DATE_FORMAT(cast(procesoproyecto.fecha_fin as date),\'%d/%m/%Y\') fecha_fin',false);
		
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'procesoproyecto', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
}