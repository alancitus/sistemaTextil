<?php 
Class VentaModel extends CI_Model
{
	public function Actualizar($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('venta', $data);
		
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$this->db->insert('venta', $data);
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'registro/venta/' . $this->db->insert_id();
		
		return $this->responsemodel;
	}
	public function Obtener($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('venta')->row();
	}
	public function Eliminar($id)
	{
		
		$this->db->where('id', $id);
		$this->db->delete('venta');
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'registro/ventas';
		
	
		return $this->responsemodel;

	}
	public function Listar()
	{
		$where = 'id is not null';
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;

		if($this->filter != null)
		{
			foreach($this->filter->{'rules'} as $f)
			{
				if($f->field == 'id') $where .= "AND id = '" . $f->data . "' ";
				if($f->field == 'Nombre') $where .= "AND Nombre LIKE '" . $f->data . "%' ";
			}
		}

		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM venta')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'venta', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio)
	{
		$sql = "
			SELECT * FROM venta
			WHERE Nombre LIKE '%$criterio%'
			ORDER BY Nombre
			LIMIT 0,10
		";
		return $this->db->query($sql)->result();
	}
}