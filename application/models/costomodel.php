<?php
class CostoModel extends CI_Model
{
	public function Actualizar($data)
	{
 		$this->db->trans_start();
 		 		
		$id = $data['id'];
		
		$validacion = true;
				
		if($validacion)
		{
			$this->db->where('id', $data['id']);
			$this->db->update('costo', $data);
	
			$this->responsemodel->SetResponse(true);				
		}
		
		$this->db->trans_complete();
		 
		if ($this->db->trans_status() === FALSE)
		{
			log_message('1', __CLASS__ . '->' . __METHOD__);
			$this->responsemodel->SetResponse(false);	
		}
				
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$this->db->trans_start();
		
	//	$data['Correo'] = strtolower($data['Correo']);
		
		$validacion = true;
	/*	if($data['Ruc'] != '')
		{
			if(!isRuc($data['Ruc']))
			{
				$validacion = false;
				$this->responsemodel->message = 'El RUC ingresado no es válido.';					
			}
			else if($data['Direccion'] == '')
			{
				$validacion = false;
				$this->responsemodel->message = 'Un cliente con RUC debe tener obligatoramiente una dirección.';						
			}else if($this->db->query("SELECT COUNT(*) Total FROM cliente WHERE Empresa_id = " . $this->user->Empresa_id . " AND Ruc = '" . $data['Ruc'] . "'")->row()->Total > 0)
			{
				$validacion = false;
				$this->responsemodel->message = 'Ya existe un cliente con este RUC.';
			}
		}
		if($data['Dni'] != '')
		{
			if(!isDni($data['Dni']))
			{
				$validacion = false;
				$this->responsemodel->message = 'El DNI ingresado no es válido.';					
			}
			else if($this->db->query("SELECT COUNT(*) Total FROM cliente WHERE Empresa_id = " . $this->user->Empresa_id . " AND Dni = '" . $data['Dni'] . "'")->row()->Total > 0)
			{
				$validacion = false;
				$this->responsemodel->message = 'Ya existe un cliente con este DNI.';					
			}
		}*/
		if($validacion)
		{
			$data['Empresa_id'] = $this->user->Empresa_id;
			$this->db->insert('costo', $data);
			
			$this->responsemodel->SetResponse(true);
			$this->responsemodel->href   = 'mantenimiento/costo/' . $this->db->insert_id();				
		}
		
		$this->db->trans_complete();
		 
		if ($this->db->trans_status() === FALSE)
		{
			log_message('1', __CLASS__ . '->' . __METHOD__);
			$this->responsemodel->SetResponse(false);	
		}
		
		return $this->responsemodel;
	}
	public function Obtener($id)
	{
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		return $this->db->get('costo')->row();
	}
	public function Eliminar($id)
	{
		
			$this->db->where('Empresa_id', $this->user->Empresa_id);
			$this->db->where('id', $id);
			$this->db->delete('costo');
			
			$this->responsemodel->SetResponse(true);
			$this->responsemodel->href = 'mantenimiento/costos/';
		
		return $this->responsemodel;
	}
	public function Listar()
	{
		$where  = "Empresa_id = " . $this->user->Empresa_id . ' ';;
		
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;

		if($this->filter != null)
		{
			foreach($this->filter->{'rules'} as $f)
			{
				if($f->field == 'Nombre') $where .= "AND Nombre LIKE '" . $f->data . "%' ";
				if($f->field == 'Identidad') $where .= "AND Identidad LIKE '" . $f->data . "%' ";
			}
		}

		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM costo')->get()->row()->Total);
		
		$sql = "
			SELECT 
				*
			FROM costo
			WHERE $where
			ORDER BY " . $this->jqgridmodel->sord . "
			LIMIT " . $this->jqgridmodel->start . "," . $this->jqgridmodel->limit;

		$this->db->where($where);
		$this->jqgridmodel->DataSource($this->db->query($sql)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio, $tipo=0)
	{
		// 1 Tiene Ruc 2 Solo Dni
		$select = "*, IF(Ruc = '', Dni, Ruc) AS Identidad";
		
		if($tipo == '3') $select = '*, Ruc Identidad';
		if($tipo == '2') $select = '*, Dni Identidad';
		
		$sql = "
			SELECT $select FROM compra
			WHERE Nombre LIKE '%$criterio%'
			AND Empresa_id = " . $this->user->Empresa_id . "
			ORDER BY Nombre
			LIMIT 10
		";		

		return $this->db->query($sql)->result();
	}
}