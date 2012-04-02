<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Responding extends Admin_Controller
{

	/**
	 * The current active section
	 * @access protected
	 * @var string
	 */
	protected $section = 'responding';
	
	private $createauthors_validation_rules = array();	
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('questions_m');
        $this->load->model('answers_m');
		$this->load->model('a_authors_m');
		$this->load->library('form_validation');
		$this->lang->load('qa');
		$this->load->helper('html');
		$this->load->helper('string');
		$this->load->helper('pagination');
		
		$this->createauthors_validation_rules = array(
			array(
				'field' => 'name',
				'label' => lang('faq_responding_name_label'),
				'rules' => 'trim|min_length[1]|max_length[100]|required'
			),
			array(
				'field' => 'email',
				'label' => lang('faq_responding_email_label'),
				'rules' => 'trim|valid_email|required'
			)
		);
		
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}

	/*
	*
	*
	* Show all shipping orders
	*
	*/
	public function index($offset = 0){
		$all_authors     = $this->a_authors_m->get_all_auth();
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
		$this->template
		     ->title($this->module_details['name'])
			 ->set_partial('shortcuts', 'admin/partials/shortcuts')
			 ->build('admin/responding',array( 'all_authors' => $all_authors ));
	}
		
	public function create(){
		$this->form_validation->set_rules($this->createauthors_validation_rules);
		
		if( $this->form_validation->run() ){
			if( $this->a_authors_m->create_auth($this->input->post()) ){	
				$this->session->set_flashdata('success',lang('qa_author_create_success'));			
				if( $this->input->post('btnAction') == 'save_exit' ){
					redirect('admin/qa/responding');
				}else{
					redirect('admin/qa/responding/create/');
				}
			}else{
				$this->session->set_flashdata('error',lang('qa_author_create_error'));
				redirect('admin/qa/responding/create/');
			}
			
			return TRUE;
		}
		$this->template
			 ->build('admin/createauthor');
	}
	
	public function view($id = ''){
		if( !empty($id) ) {
			$author = $this->a_authors_m->get($id);
			
			$this->form_validation->set_rules($this->createauthors_validation_rules);
			
			if( $this->form_validation->run() ){
			
				if( $this->a_authors_m->update($id,$this->input->post()) ){
					$this->session->set_flashdata('success',lang('qa_author_create_successchange'));
					
					if( $this->input->post('btnAction') == 'save_exit' ){
						redirect('admin/qa/responding/');
					}else{
						redirect('admin/qa/responding/view/'.$id);
					}
				}else{
					$this->session->set_flashdata('error',lang('qa_author_create_errorchange'));
					redirect('admin/qa/responding/view/'.$id);
				}
				return true;
			}
			
			if( !empty($author) ){
				$this->template
					 ->set('author',$author)
					 ->build('admin/author');
			}
			return TRUE;
		}
		redirect('admin/qa/responding/');
	
	}
	
	public function del($id = ''){
	
		if( $this->input->post('btnAction') == 'delete' ){
			$del_status = $this->input->post('action_to');
			foreach($del_status as $status){
				$this->a_authors_m->delete($status);
				$this->answers_m->clear_author($status);
			}
		}else{ 
			if( !empty($id) ){
				$this->a_authors_m->delete($id);
				$this->answers_m->clear_author($id);
			}
		}
		redirect('admin/qa/responding/');
	}
	
}