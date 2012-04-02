<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Questions_m extends MY_Model {
    
    /**
     * Constructor method
     *
     * @access public
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }
    
    
    public function create_q($data)
    {
        return $this->insert($data, TRUE);
    }
    
    public function get_all_q()
    {
        return $this->order_by("{$this->_table}.date_add", 'DESC')
					->order_by("{$this->_table}.id", 'DESC')
                    ->get_all();
    }
	
	public function get_all_q_with_answered()
    {
        return $this->db->query("SELECT *, (`id` IN (SELECT q_id FROM {$this->db->dbprefix('answers')})) AS answered FROM {$this->db->dbprefix($this->_table)} ORDER BY answered, date_add DESC, ID DESC")->result();
    }
    
    public function update_q($id, $data)
    {
       return $this->update($id, $data, TRUE);
    }
	public function insert($input){
	
		return parent::insert(array(
			'author_name'    => $input['name'],
			'author_email' => $input['email'],
			'question' => $input['question'],
			'date_add' => date('Y-m-d')
			
		));
	}
	
	public function get_by_limit($start, $limit)
    {
        return $this->order_by("{$this->_table}.date_add", 'DESC')
					->order_by("{$this->_table}.id", 'DESC')
					->limit($start, $limit)
                    ->get_all();
    }
	
	function get_count($params = array())
	{
		return $this->db->query("SELECT count(*) as count FROM {$this->db->dbprefix($this->_table)}")->row()->count;
	}
}