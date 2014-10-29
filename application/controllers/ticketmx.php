<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticketmx extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('model_ticketmx');
	}
	
	public function index()
	{
		$this->load->view('web_1header');	
		$this->load->view('web_2body');
		//$this->load->view('web_3footer');
	}
	
	public function login()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		if($this->model_ticketmx->esta_logueado())
		{
			redirect('ticketmx');
		}
		else
		{
			$this->form_validation->set_rules('correo', 'Correo', 'trim|min_lenght[1]|xss_clean|callback_checa_login');
    	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('web_1header');	
				$this->load->view('web_4sesion');
			}
			else
			{
				redirect('ticketmx');
			}
		}
	}
	
	function checa_login($correo)
	{
		$contrasena = $this->input->post("contrasena");	
		
		/* El ! en el if niega la sentencia, true a false, false a true */
		if(!$this->model_ticketmx->inicio_sesion($correo,$contrasena))
		{
			$this->form_validation->set_message('checa_login','Correo/Contraseña inválidos');
			return false;
		}
		return true;		
	}
	
	public function register()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombres','Nombre','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('primero','Primer','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('segundo','Segundo','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('edad','Edad','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('correo','Primer','trim|min_lenght[1]|max_lenght[50]|xss_clean|valid_email');
		$this->form_validation->set_rules('domicilio','Domicilio','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('ciudad','Ciudad','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('telefono','Telefono','trim|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('contraseña','Edad','trim|min_lenght[1]|max_lenght[50]');
   	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('web_1header');	
			$this->load->view('web_5registro');
		}
		else
		{
			$this->load->model('model_ticketmx');
			
			if($this->input->post('segundo')=='')
			{
				$segundo= '';
			}
			else
			{
				$segundo= $this->input->post('segundo');
			}
			
			$persona_datos = array(
			'mi_nombre' => $this->input->post('nombres'),
			'mi_paterno' => $this->input->post('primero'), 
			'mi_materno' => $segundo,    
			'mi_edad' => $this->input->post('edad'),
			'mi_correo' => $this->input->post('correo'),
			'mi_domicilio' => $this->input->post('domicilio'),
			'mi_ciudad' => $this->input->post('ciudad'),
			'mi_telefono' => $this->input->post('telefono'),
			'mi_contrasena' => md5($this->input->post('dependencia')),
			'mi_borrar' => 0,
			'mi_autorizado' => 0,
			'mi_registro' => date('Y-m-d')
			);

			$value_so_id= $this->model_ticketmx->guardar($persona_datos);			
			$this->load->view('web_1header');	
			$this->load->view('web_6confirmacion');
		}
	}

}
