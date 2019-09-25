<?php
class MY_Model extends CI_Model {
	
	protected $_table_name=null;

	protected $_primary_key=null;

	public function __construct() {
		parent:: __construct();
	}
	
	public function get($id=null, $order_by= null){
	   
		
		if(is_numeric($id)){
           $q=$this->db->where($this->_primary_key, $id);
		}
		if(is_array($id)){
			foreach($id as $_key=>$_value){
				$this->db->where($_key, $_value);
			}
		}

		$q=$this->db->get($this->_table_name);
		return $q->result_array();
	}


	public function insert($data){
	    $this->db->insert($this->_table_name, $data);
	    return $this->db->insert_id();
    }

    public function update($new_data, $where){
        if(is_numeric($where)){
            $this->db->where($this->_primary_key, $where);
        }elseif(is_array($where)){
           foreach($where as $_key=>$_value){
               $this->db->where($_key, $_value);
		   }
        }else{
			die("You must pass the second Parameter to UPDATE() method.");
		}
	    $this->db->update($this->_table_name, $new_data);
	    return $this->db->affected_rows();
    }

    public function delete($id){
	    if(is_numeric($id)){
	        $this->db->where($this->_primary_key, $id);
        } elseif(is_array($id)){
            foreach($id as $_key=>$_value){
                $this->db->where($_key, $_value);
            }
        }else {
	        die("You must pass a parameter to the DELETE() method");
        }
	    $this->db->delete($this->_table_name);
	    return $this->db->affected_rows();
    }
}