<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
////////////////////////////////////acoplado para sitrad v5. Codigo limpio

class Model_ticketmx extends CI_Model {
	public function __construct()
  	{
		parent::__construct();
	}
	
	function guardar($persona_datos)
	{
		$success=false;
		$this->db->trans_start();
			
		$this->db->insert('miembro',$persona_datos);
		
		$this->db->trans_complete();		
		return 0;
	}

	function esta_logueado()
	{
		return $this->session->userdata('us_id')!=false;
	}
	
	function inicio_sesion($correo, $contrasena)
	{	
		$this->db->from('miembro');	
		$this->db->where('mi_correo',$correo);
		$this->db->where('mi_contrasena',md5($contrasena));
		$this->db->where('mi_borrar',0);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			//$this->session->set_userdata('mi_id', $row->mi_id);
			//$this->session->set_userdata('mi_nombres', $row->mi_nombres);
			//$this->session->set_userdata('mi_nom_completo', $row->mi_nombres.' '.$row->mi_paterno.' '.$row->mi_materno);
			return true;
		}
		return false;
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect('ticketmx');
	}
	
}

