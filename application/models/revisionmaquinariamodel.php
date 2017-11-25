<?php 
Class RevisionmaquinariaModel extends CI_Model
{
	public function Actualizar($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('revisionmaquinaria', $data);
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$fecha_revision = $data['fecha_revision'];
		$data['fecha_revision'] = ToDate($data['fecha_revision']);
		$this->db->insert('revisionmaquinaria', $data);
		$new_id = $this->db->insert_id();
		$data['id'] = $new_id;
		$data['fecha_revision'] =  $fecha_revision;
		return $data;
	}
	public function Eliminar($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('revisionmaquinaria');
		return $id;

	}
	public function Listar($maquinaria_id)
	{
		//$where = 'maquinaria_id = ' . $this->proyecto->maquinaria_id . ' ';
		$where = 'maquinaria_id = '.$maquinaria_id.' ';
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;
		
		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM revisionmaquinaria')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->db->select('revisionmaquinaria.*');
		$this->db->select(' DATE_FORMAT(cast(revisionmaquinaria.fecha_revision as date),\'%d/%m/%Y\') fecha_revision',false);
		
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'revisionmaquinaria', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
}