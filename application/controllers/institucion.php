<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('insti_model');
	}
			
	public function index()
	{
		$this->load->view('sistrec_1header');	
		$this->load->view('insti_02body');
	}
	
	
	
	
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function monitoreo()
	{
		$variable = array('marca'=>$this->insti_model->ver_todas_marcas(),
						  'direccion'=>$this->insti_model->ver_todas_direcciones(),
						  'servicio'=>$this->insti_model->ver_todos_servicios());
		$this->load->view('sistrec_1header');	
		$this->load->view('insti_03monitoreo',$variable);
	}
	public function servicios()
	{
		$variable = array('servicios'=>$this->insti_model->ver_todos_servicios());
		$this->load->view('sistrec_1header');	
		$this->load->view('insti_04servicios',$variable);
	}
	public function direcciones()
	{
		$variable = array('direcciones'=>$this->insti_model->ver_todas_direcciones());
		$this->load->view('sistrec_1header');	
		$this->load->view('insti_07direcciones',$variable);
	}
	
	
	
	

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function nuevoservicio()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('poliat','Politica atención','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('polico','Politica conclución','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('direcc','Dirección','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('direccion'=>$this->insti_model->ver_todas_direcciones());
			$this->load->view('sistrec_1header');	
			$this->load->view('insti_05nuevoservicio',$variable);
		}
		else
		{
			$this->load->model('insti_model');
			$nombre = $this->input->post('nombre');
			$poliat = $this->input->post('poliat');
			$polico = $this->input->post('polico');
			$instit = $this->session->userdata('id');
            $direcc = $this->input->post('direcc');
			
            $nueva_insercion = $this->insti_model->nuevo_servicio($nombre,$poliat,$polico,$instit,$direcc);
			redirect('institucion/servicios');
		}
	}
	public function nuevadireccion()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('usuario','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('contra','Contraseña','trim|required|min_lenght[1]|max_lenght[50]|xss_clean|md5');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('sistrec_1header');	
			$this->load->view('insti_08nuevadireccion');
		}
		else
		{
			$this->load->model('insti_model');
			$nombre = $this->input->post('nombre'); 
			$usuario = $this->input->post('usuario'); 
			$contra = $this->input->post('contra');
			$instit = $this->session->userdata('id');
			      
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->insti_model->nueva_direccion($nombre,$usuario,$contra,$instit);
			redirect('institucion/direcciones');
		}
	}
	
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function datosservicio($id)
	{		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('poliat','Politica atención','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('polico','Politica conclución','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('direcc','Dirección','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('direccion'=>$this->insti_model->ver_todas_direcciones(),
							  'servicio'=>$this->insti_model->datos_servicio($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('insti_06datosservicio',$variable);

		}
		else
		{
			$this->load->model('insti_model');
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$poliat = $this->input->post('poliat');
			$polico = $this->input->post('polico');
            $direcc = $this->input->post('direcc');
			
            $nueva_insercion = $this->insti_model->actualizar_servicio($id,$nombre,$poliat,$polico,$direcc);
			redirect('institucion/datosservicio/'.$id);
		}
	}
	public function datosdireccion($id)
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('usuario','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('direccion'=>$this->insti_model->datos_direcciones($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('insti_09datosdireccion',$variable);
		}
		else
		{
			$this->load->model('insti_model');
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre'); 
			$usuario = $this->input->post('usuario'); 
			      
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->insti_model->actualizar_direccion($id,$nombre,$usuario);
			redirect('institucion/datosdireccion/'.$id);
		}
	}
	
	
	
	
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function restablecer_di($id)
	{
		$variable = array('direccion'=>$this->insti_model->restablecer_di($id));
		redirect('institucion/datosdireccion/'.$id);
	}
	
	
	
	
	
	
	
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function busqueda($direccion,$servicio)
	{
		$variable = array('marca'=>$this->insti_model->busqueda_avanzada($direccion,$servicio),
						  'direccion'=>$this->insti_model->ver_todas_direcciones(),
						  'servicio'=>$this->insti_model->ver_todos_servicios());
		$this->load->view('sistrec_1header');	
		$this->load->view('insti_03monitoreo',$variable);
	}
	
	
	
	
}