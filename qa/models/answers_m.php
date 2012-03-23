<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Answers_m extends MY_Model {
    
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
    
	    public function create_a($data)
    {
        return $this->insert($data, TRUE);
    }
    
    public function get_all_a()
    {
        return $this->order_by("{$this->_table}.date_add", 'DESC')
                    ->get_all();
    }
    
    public function update_a($id, $data)
    {
       return $this->update($id, $data, TRUE);
    }
    
    public function clear_author($id)
    {
        return $this->db->where('author_id', $id)
                    ->set('author_id', 0)
                    ->update($this->_table);
    }
	public function get_by_q($q_id)
    {
        	
		$this->db->where('q_id =',$q_id);
		$this->db->limit(1);
		$query = $this->db->get($this->table_name());
		if( $query->num_rows() > 0 ){
		
			return $query->row();
		}
		return NULL;
    }
	public function get_date_by_qm($data)
    {
		$r_mas = array();
		foreach($data AS $t) {
			$r_mas[$t->id] = $this->get_by_q($t->id);
		}
		return $r_mas;
    }
    
}
/* End of file faq_m.php */
/* Location: ./addons/modules/faq/models/faq_m.php */