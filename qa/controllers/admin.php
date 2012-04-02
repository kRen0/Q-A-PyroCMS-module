<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 */
class Admin extends Admin_Controller
{
	/**
	 *
	 * @var array
	 * @access private
	 */
	private $validation_rules = array();

	public $section = 'qa';
	
	public function __construct()
	{
		// First call the parent's constructor
		parent::__construct();

		$this->validation_rules = array(
			array(
				'field' => 'name',
				'label' => lang('faq_author_name_label'),
				'rules' => 'trim|min_length[1]|max_length[100]|required'
			),
			array(
				'field' => 'email',
				'label' => lang('faq_email_name_label'),
				'rules' => 'trim|valid_email|required'
			),
			array(
				'field' => 'question',
				'label' => lang('faq_question_label'),
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'authors',
				'label' => lang('qa_a_author_v_label'),
				'rules' => 'trim'
			),
			array(
				'field' => 'answer',
				'label' => lang('qa_answer_label'),
				'rules' => 'trim|xss_clean'
			)		
		);
		
		// Load all the required classes
		$this->load->model(
						   array('questions_m', 'answers_m', 'a_authors_m')
						);
		$this->load->library('form_validation');
		$this->lang->load('qa');
		

		// Set the validation rules
		
		$no_authors[0] = lang('qa_select_authors');
			
		$authors = $this->a_authors_m->authors_options();
		
		$this->template->authors_options = $no_authors + $authors;
		
	
		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts')
				->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
				->append_metadata( js('faq.js', 'faq') );;
		
	}

	/**
	 */
	public function index()
	{
		//Get the records and assign to template
		$questions = $this->questions_m->get_all_q_with_answered();
		//build output
		$this->template->build('admin/index',array( 'questions' => $questions ));
	}

	/**
	 */
	public function del($id)
	{
		$ids = $this->input->post('action_to');
		
		if(!empty($ids))
		{
			//counter
			$i = 0;
			
			$count = count($ids);
			
			//loop through each id and try to delete
			foreach($ids as $id)
			{
				//delete success
				if($this->questions_m->delete($id))
				{
					$i++;
				}
			}
			$this->session->set_flashdata('success', sprintf(lang('faq_delete_success'), $i, $count));
		}
		else
		{
		
			if(!empty($id))
			{
				$this->questions_m->delete($id);
				$this->session->set_flashdata('success', lang('faq_delete_success'));
			}
			//oops no ids.. ids required here.
			else $this->session->set_flashdata('notice', lang('faq_action_empty'));
		}
		//no need to keep hanging around here,  redirect back to faq list
		redirect('admin/qa');
	}

	/**

	 */
	public function view($id)
	{
		$id_rule = array(
						'field' => 'a_id',
						'label' => lang('qa_id_label'),
						'rules' => 'is_numeric|trim'
					);
		
		//push the special id rule into the validation rules
		array_push($this->validation_rules, $id_rule);
		$this->form_validation->set_rules($this->validation_rules);
		
		//form valid lets do something with the data
		if($this->form_validation->run())
		{
			//prep the data
			$q_data = array('question' => $this->input->post('question'),
				      'author_name' => $this->input->post('name'),
				      'author_email' => $this->input->post('email'),
				      );
			$a_data = array('q_id' => $id,
				      'answer' => $this->input->post('answer'),
				      'author_id' => $this->input->post('authors')
				      );
			if(($this->input->post('a_id'))=="") {
				$date = date('Y-m-d');
				$a_data += array('date_add' => $date);
			}
			//update data
			
			$sucess = true;
			if(!$this->questions_m->update_q($id, $q_data))
			{
				$sucess = false;
			}
			if(($this->input->post('a_id'))=="")
			{
				if(!$this->answers_m->create_a($a_data)) {
					$sucess = false;
				}
			}
			else {
				if(!$this->answers_m->update_a($this->input->post('a_id'), $a_data)) {
						$sucess = false;
					}
			}
			if($sucess) {
				$message = lang('qa_quest_successchange');
				$status = 'success';
			}
			else
			{
				$message = lang('qa_quest_errorchange');
				$status = 'error';
			}
			
			if($this->_is_ajax())
			{
				$json = array('message' => $message,
					      'status' => $status
					      );
				echo json_encode($json);
				return TRUE;
			}
			else
			{
				$this->session->set_flashdata($status, $message);
				redirect('admin/qa');
			}
		}
		
		//id is set lets gooo.
		if($id)
		{
			//get the faq we want to edit and assign to template variable
			$this->template->qa = $this->questions_m->get($id);
			$this->template->answ = $this->answers_m->get_by_q($id);
		}
		else
		{
			//oops no id can't do nothing without that!
			redirect('admin/qa');
		}
		
		//form didn't validate and post is set so we should return our validation errors in json
		if($this->_is_ajax() && $_POST)
		{
			echo json_encode(
							array(
								'status' => 'error',
								'message' => validation_errors()
							)
						);
		}
		
		//just build the output
		else
		{
			$this->template->build('admin/edit');
		}
	}
	
	/**
	 * Helper method to allow one form to controll multiple actions
	 *
	 * @access public
	 * @return void
	 */
	public function action()
	{		
		if($this->input->post('btnAction') == 'delete')
		{
			$this->delete();
		}
	}


	
	protected function _is_ajax()
	{
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ? TRUE : FALSE;
	}
}
