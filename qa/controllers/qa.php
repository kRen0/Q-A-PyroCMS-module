<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Qa extends Public_Controller {
    
    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
	 private $question_on_page = 10;
	 
	 private $create_validation_rules = array();
	 
    function __construct()
    {
        parent::__construct();
        $this->load->model('questions_m');
        $this->load->model('answers_m');
		$this->load->model('a_authors_m');
        $this->lang->load('qa');
        $this->load->helper('recaptchalib');
		
		$this->create_validation_rules = array(	
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
			)
		);
        
        $this->load->library('form_validation');
    }
    

    
    /**
     * index method
     *
     * @access public
     * @return void
     */
    public function index()
    {
	redirect('qa/view/1');
	
    }
    
    public function view($page = 1)
    {
	$question_on_page = $this->question_on_page;
	
     $questions = $this->questions_m->get_by_limit($question_on_page, ($page-1)*$question_on_page);
	 $answers = $this->answers_m->get_date_by_qm($questions);
	 $count = $this->questions_m->get_count();
	 $page_count = ((int)($count / $question_on_page)) + (!!($count % $question_on_page) + 0);
	 $pages = range(1, $page_count);
	 $authors = array();
	 foreach($this->a_authors_m->get_all_auth() AS $t) {
		$authors[$t->id]['name'] = $t->name;
		$authors[$t->id]['email'] = $t->email;
	}
            
    $this->template
							->set('pages', $pages)
							->set('current_page', $page)
                            ->set('questions', $questions)
                            ->set('answers', $answers)
							->set('authors', $authors)
                            ->build('view');
        
    }
	
		public function createquestion(){
		$this->form_validation->set_rules($this->create_validation_rules);
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
			$isJq = true;
		}
		else $isJq = false;
		
		$validation = $this->form_validation->run();
		if(!$validation) {
			/*
			*
			*	создать массив $response = array() 
			*	в нем два моля $response['responseCode']
			*  и  $response['data']
			*	в случае, если произошла ошибка, то добавляем в $response['responseCode'] = 'validation_error'
			*  а в data сообщения
			*  затем, используя template->build_json  возвращаем json Объект клиенту, и там его парзим
			*/
			if($isJq)
				echo (validation_errors());
			else $this->template
				 ->build('create',array());
		}
		
		$privatekey = "6LdeMc8SAAAAAAP7LqIlG140JRU0J8A6sAFGoFsy";
		$r=false;
		if(isset($_SERVER["REMOTE_ADDR"]) && isset($_POST["recaptcha_challenge_field"]) && isset($_POST["recaptcha_response_field"])) {
			$r=true;
			$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
		}
		if (!$r || !$resp->is_valid) {
			$r = false;
			$captcha_err = '<p><span class="error">'.lang('qa_captcha_incorrect').'</span></p>';
			if($isJq)
				echo ($captcha_err); //You can not use the call errors, without changing the CMS files :(
			else
			$this->template
		 	 ->set('captcha_err', $captcha_err)
			 ->build('create',array());
		}
		
		if( $validation && $r ){
		
			if( $order_id = $this->questions_m->insert($this->input->post()) ){
				if($isJq) echo('success');
				else $this->template
				 ->set('success', 1)
				 ->build('create',array());
				return TRUE;
			}
		}
		
        return FALSE;
	}
    
}
/* End of file controllers/faq.php */