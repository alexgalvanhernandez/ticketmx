<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database('default');
		$this->load->model('admon_model');
	}
	public function index()
	{
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_2body');
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function tarifas()
	{
		$variable = array('tarifa'=>$this->admon_model->ver_todas_tarifas());
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_7tarifas',$variable);
	}
	public function localidades()
	{
		$variable = array('localidad'=>$this->admon_model->ver_todas_localidades());
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_10localidades',$variable);
	}
	public function instituciones()
	{
		$variable = array('institucion'=>$this->admon_model->ver_todas_instituciones());
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_13instituciones',$variable);
	}
	public function licencias()
	{
		$variable = array('licencia'=>$this->admon_model->ver_todas_licencias());
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_3licencias',$variable);
	}
	public function usuarios()
	{
		$variable = array('usuario'=>$this->admon_model->ver_todos_usuarios());
		$this->load->view('sistrec_1header');	
		$this->load->view('admin_16usuarios',$variable);
	}
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function nuevalicencia()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('fecha','Fecha de inicio','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('institucion','Institucion','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('tarifa','Tarifa','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('institucion'=>$this->admon_model->llenarcombo_institucion_nuevalicencia(),
							  'tarifa'=>$this->admon_model->ver_todas_tarifas());
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_4nuevalicencia',$variable);
		}
		else
		{
			$this->load->model('admon_model');
			$inicio = $this->input->post('fecha');
				$nuevafecha = strtotime ( '+1 year' , strtotime ($inicio)) ;
			$termino = date('Y-m-d',$nuevafecha);
			$tarifa = $this->input->post('tarifa');
            $institucion = $this->input->post('institucion');
			
			$variable = $this->admon_model->datos_tarifas($tarifa);
			
			foreach($variable as $var)
				{
					$costo= $var->ta_costo;
					$cant= $var->ta_cant;
				}
            $nueva_insercion = $this->admon_model->nueva_licencia($inicio,$termino,$costo,$cant,$tarifa,$institucion);
			redirect('admin/licencias');
		}
	}
	public function nuevatarifa()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('cantidad','Cantidad de servicios','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('costo','Costo','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('descrip','Descripción','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_8nuevatarifa');
		}
		else
		{
			$this->load->model('admon_model');
			$cantidad = $this->input->post('cantidad'); 
			$precio = $this->input->post('costo'); 
			$descrip = $this->input->post('descrip'); 
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->nueva_tarifa($cantidad,$precio,$descrip);
			redirect('admin/tarifas');
			//echo "<script language=\"javascript\">alert('La operacion fue fallida, vuelve a intentarlo');<script>";			
		}
	}
	public function nuevalocalidad()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('munici','Municipio','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('estado','Estado','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_11nuevalocalidad');
		}
		else
		{
			$this->load->model('admon_model');
			$munici = $this->input->post('munici'); 
			$estado = $this->input->post('estado'); 
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->nueva_localidad($munici,$estado);
			redirect('admin/localidades');
		}
	}
	public function nuevainstitucion()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('usuario','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('contra','Contraseña','trim|required|min_lenght[1]|max_lenght[50]|xss_clean|md5');
		$this->form_validation->set_rules('tipo','Tipo','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('localidad','Localidad','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('localidad'=>$this->admon_model->ver_todas_localidades());
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_14nuevainstitucion',$variable);
		}
		else
		{
			$this->load->model('admon_model');
			$nombre = $this->input->post('nombre'); 
			$usuario = $this->input->post('usuario'); 
			$contra = $this->input->post('contra');    
			$tipo = $this->input->post('tipo');
			$localidad = $this->input->post('localidad');
			      
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->nueva_institucion($nombre,$usuario,$contra,$tipo,$localidad);
			redirect('admin/instituciones');
		}
	}
	public function nuevousuario()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('apellido','Apellido','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('correo','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('contra','Contraseña','trim|required|min_lenght[1]|max_lenght[50]|xss_clean|md5');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_17nuevousuario');
		}
		else
		{
			$this->load->model('admon_model');
			$nombres = $this->input->post('nombre'); 
			$apellid = $this->input->post('apellido'); 
			$correo = $this->input->post('correo').'@sistrec'; 
			$contra = $this->input->post('contra');
			      
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->nuevo_usuario($nombres,$apellid,$correo,$contra);
			redirect('admin/usuarios');
		}
	}
	
	
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////	
	public function datoslicencia($id)
	{		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('fecha','Fecha de inicio','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('institucion','Institucion','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('tarifa','Tarifa','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('institucion'=>$this->admon_model->llenarcombo_institucion_nuevalicencia(),
							  'tarifa'=>$this->admon_model->ver_todas_tarifas(),
							  'licencia'=>$this->admon_model->datos_licencia($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_5datoslicencia',$variable);
		}
		else
		{
			$this->load->model('admon_model');
			$id = $this->input->post('id');
			$inicio = $this->input->post('fecha');
				$nuevafecha = strtotime ( '+1 year' , strtotime ($inicio)) ;
			$termino = date('Y-m-d',$nuevafecha);
			$tarifa = $this->input->post('tarifa');
            $institucion = $this->input->post('institucion');
			
			$variable = $this->admon_model->datos_tarifas($tarifa);
			
			foreach($variable as $var)
				{
					$costo= $var->ta_costo;
					$cant= $var->ta_cant;
				}
            $nueva_insercion = $this->admon_model->actualizar_licencia($id,$inicio,$termino,$costo,$cant,$tarifa,$institucion);
			redirect('admin/datoslicencia/'.$id);
		}
	}
	public function datostarifa($id)
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('cantidad','Cantidad de servicios','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('costo','Costo','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('descrip','Descripción','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('tarifa'=>$this->admon_model->datos_tarifas($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_9datostarifa', $variable);
		}
		else
		{
			$this->load->model('admon_model');
			$id = $this->input->post('id'); 
			$cantidad = $this->input->post('cantidad'); 
			$descrip = $this->input->post('descrip'); 
			$costo = $this->input->post('costo'); 
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->actualizar_tarifa($id,$cantidad,$costo,$descrip);
			redirect('admin/datostarifa/'.$id);
		}
	}
	public function datoslocalidad($id)
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('munici','Municipio','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('estado','Estado','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('localidad'=>$this->admon_model->datos_localidades($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_12datoslocalidad', $variable);
		}
		else
		{
			$this->load->model('admon_model');
			$id = $this->input->post('id'); 
			$munici = $this->input->post('munici'); 
			$estado = $this->input->post('estado'); 
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->actualizar_localidad($id,$munici,$estado);
			redirect('admin/datoslocalidad/'.$id);
		}
	}
	public function datosinstitucion($id)
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('usuario','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('tipo','Tipo','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('localidad','Localidad','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('institucion'=>$this->admon_model->datos_instituciones($id),'localidad'=>$this->admon_model->ver_todas_localidades());
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_15datosinstitucion',$variable);
		}
		else
		{
			$this->load->model('admon_model');
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre'); 
			$usuario = $this->input->post('usuario'); 
			$tipo = $this->input->post('tipo');
			$localidad = $this->input->post('localidad');
			      
			//ahora procesamos los datos hacía el modelo que debemos crear
            $nueva_insercion = $this->admon_model->actualizar_institucion($id,$nombre,$usuario,$tipo,$localidad);
			redirect('admin/datosinstitucion/'.$id);
		}
	}
	public function datosusuario($id)
	{		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre','Nombre','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('apellido','Apellido','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		$this->form_validation->set_rules('correo','Usuario','trim|required|min_lenght[1]|max_lenght[50]|xss_clean');
		
		if($this->form_validation->run()==FALSE)
		{
			$variable = array('usuario'=>$this->admon_model->datos_usuario($id));
			$this->load->view('sistrec_1header');	
			$this->load->view('admin_18datosusuario',$variable);
		}
		else
		{
			$this->load->model('admon_model');
			$id = $this->input->post('id');
			$nombres = $this->input->post('nombre'); 
			$apellid = $this->input->post('apellido'); 
			$correo = $this->input->post('correo').'@sistrec'; 

            $nueva_insercion = $this->admon_model->actualizar_usuario($id,$nombres,$apellid,$correo);
			redirect('admin/datosusuario/'.$id);
		}
	}
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function restablecer_in($id)
	{
		$variable = array('ayunta'=>$this->admon_model->restablecer_in($id));
		redirect('admin/datosinstitucion/'.$id);
	}
	public function restablecer_us($id)
	{
		$variable = array('ayunta'=>$this->admon_model->restablecer_us($id));
		redirect('admin/datosusuario/'.$id);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function restablecercontra($id)
	{
		$variable = array('ayunta'=>$this->admon_model->restablecercontra($id));
		redirect('admin/datoslicencia/'.$id);
	}
	
	public function cambiarstatusAc($id)
	{
		$variable = array('ayunta'=>$this->admon_model->cambiarstatus($id,'Activo'));
		redirect('admin/datoslicencia/'.$id);
	}
	public function cambiarstatusIn($id)
	{
		$variable = array('ayunta'=>$this->admon_model->cambiarstatus($id,'Inactivo'));
		redirect('admin/datoslicencia/'.$id);
	}
	
	
	
	
		
}