<?php defined('BASEPATH') or exit('No direct script access allowed');
/**

 */
class Module_QA extends Module {

	public $version = '1.0';
	
	public function info()
	{
		return array(
			'name' => array(
				'en' => 'QA',
				'ru' => 'Вопросы'
			),
			'description' => array(
				'en' => 'Management and the answers to user questions.',
				'ru' => 'Управление и ответы на вопросы пользователей.'
			),
			'frontend' => TRUE,
			'backend'  => TRUE,
			'menu'	  => 'Q&A',
			'author' => 'kReno',
			'sections' => array(
				'faqs' => array(
					'name'=>'qa_title',
					'uri'=>'admin/qa',
				),
				'responding'   => array(
					'name' => 'qa_responding_title',
					'uri'  => 'admin/qa/responding',
					'shortcuts' => array(
						array(
							'name' => 'qa_add_responding_title',
							'uri' => 'admin/qa/responding/create',
							'class' => 'add'
						)
					)
				)
			)
		);
	}
	
	public function install()
	{
		
		$this->dbforge->drop_table('questions');
		$this->dbforge->drop_table('answers');
		$this->dbforge->drop_table('a_authors');
		
		    $questions = array(
            'id' => array(
            'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'author_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'author_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
			'question' => array(
                'type' => 'TEXT'
            ),
			'date_add' => array(
                'type' => 'DATE'
            )
        );


        $this->dbforge->add_field($questions);
        $this->dbforge->add_key('id', TRUE);

        // Let's try running our DB Forge Table and inserting some settings
        if ( ! $this->dbforge->create_table('questions') )
        {
            return FALSE;
        }
		
				    $answers = array(
            'id' => array(
            'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
			'q_id' => array(
				'type' => 'INT',
                'constraint' => '11',
            ),
            'author_id' => array(
				'type' => 'INT',
                'constraint' => '11',
            ),
			'answer' => array(
                'type' => 'TEXT'
            ),
			'date_add' => array(
                'type' => 'DATE'
            )
        );


        $this->dbforge->add_field($answers);
        $this->dbforge->add_key('id', TRUE);

        // Let's try running our DB Forge Table and inserting some settings
        if ( ! $this->dbforge->create_table('answers') )
        {
            return FALSE;
        }
		
						    $a_authors = array(
            'id' => array(
            'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
        );


        $this->dbforge->add_field($a_authors);
        $this->dbforge->add_key('id', TRUE);

        // Let's try running our DB Forge Table and inserting some settings
        if ( ! $this->dbforge->create_table('a_authors') )
        {
            return FALSE;
        }
		
		return TRUE;
	}

	public function uninstall()
	{
		$this->dbforge->drop_table('questions');
		$this->dbforge->drop_table('answers');
		$this->dbforge->drop_table('a_author');

		return TRUE;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}
	
	public function help()
	{

		return "I helped you?";
	}
}
/* End of file details.php */