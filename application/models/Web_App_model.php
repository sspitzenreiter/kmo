<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_App_Model extends CI_Model {

	/**
	 * @author : Gede Lumbung
	 * @web : http://gedelumbung.com
	 * @keterangan : Model untuk menangani semua query database aplikasi web
	 **/
	 
	//query otomatis dengan active record	
	function delete_data($table,$data)
	{
		$this->db->delete($table,$data);
		return $this->db->affected_rows();
	}
	
	function update_data($table,$data,$field,$key)
	{
		$this->db->where($key,$field);
		$this->db->update($table,$data);
		return $this->db->affected_rows();
	}

	function update_data_where($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
		return $this->db->affected_rows();
	}
	
	function update_data_multifield($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function insert_data($table,$data)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	function get_data_distinct($table,$data,$select,$order_by="")
	{
		foreach ($data as $field => $filter) {
			$this->db->where($field, $filter);
		}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
        $this->db->select($select);
        $this->db->distinct();
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_data($table,$where="",$group="",$order="",$limit="",$select="*")
	{
		$this->db->from($table);
		if(!empty($where)){$this->db->where($where);}
		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order)){$this->db->order_by($order);}
		if(!empty($limit)){$this->db->limit($limit);}
		$this->db->select($select);
		$query = $this->db->get();
		
        return $query->result();
	}

	function get_data_and_where($table,$data, $order_by="",$group="",$custom_select="")
	{
		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		foreach ($data as $field => $filter) {
			$this->db->where($field, $filter);
		}
		if(!empty($group)){$this->db->group_by($group);}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_sum($table,$column_name,$where_clause="",$where_or_clause="", $join_clause="",$group="",$custom_select="",$pagination="", $sort="")
	{
		
        $limit = 10;
        $offset = 0;
		$current_page = 1;
	
		$column_order = array("field"=>"","direction"=>"");
		
		$this->db->select_sum($column_name);
		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		if (!empty($where_clause)) {
            foreach ($where_clause as $key => $value) {
                $this->db->where($value);

            }
		}
		if (!empty($where_or_clause)) {
            foreach ($where_or_clause as $key => $value) {
                $this->db->or_where($value);

            }
		}

        if($join_clause != false){
            foreach ($join_clause as $key => $value) {
                $this->db->join($value->table,$value->condition,$value->join_type);
            }
        }

		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
		}

		if(is_array($pagination) && array_key_exists("page", $pagination) && array_key_exists("perpage", $pagination)){
            $limit = $pagination["perpage"];
            $current_page = $pagination["page"];
            $offset = (($current_page -1) * $limit) ;
        }

        if(is_array($sort) && array_key_exists("field", $sort) && array_key_exists("sort", $sort)){
            $column_order["field"] = $sort["field"];
            $column_order["direction"] = $sort["sort"];
		}

		if(!empty($column_order)){
            $this->db->order_by($this->db->escape_str($column_order['field']), $column_order['direction']);
		}
		
		$this->db->limit($limit, $offset);

		$query = $this->db->get($table);
		$result = $query->result();
		return $result[0]->$column_name;
	}

	function get_count($table,$where_clause="",$where_or_clause="", $join_clause="",$group="",$custom_select="",$pagination="", $sort="")
	{
		$limit = 10;
        $offset = 0;
		$current_page = 1;
	
		$column_order = array("field"=>"","direction"=>"");

		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		if (!empty($where_clause)) {
            foreach ($where_clause as $key => $value) {
                $this->db->where($value);

            }
		}
		if (!empty($where_or_clause)) {
            foreach ($where_or_clause as $key => $value) {
                $this->db->or_where($value);

            }
		}
		
        if($join_clause != false){
            foreach ($join_clause as $key => $value) {

                $this->db->join($value->table,$value->condition,$value->join_type);
            }
		}
		
		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
		}
		if (!empty($pagination)){
			if(is_array($pagination) && array_key_exists("page", $pagination) && array_key_exists("perpage", $pagination)){
				$limit = $pagination["perpage"];
				$current_page = $pagination["page"];
				$offset = (($current_page -1) * $limit) ;
				
				$this->db->limit($limit, $offset);
			}
		}

		if (!empty($sort)) {
			if(is_array($sort) && array_key_exists("field", $sort) && array_key_exists("sort", $sort)){
				$column_order["field"] = $sort["field"];
				$column_order["direction"] = $sort["sort"];
			}
	
			if(!empty($column_order)){
				$this->db->order_by($this->db->escape_str($column_order['field']), $column_order['direction']);
			}
		}
        
		
		$query = $this->db->get($table);
		return $query->num_rows();
		// return $this->db->last_query();
	}

	function get_max($table,$column_name,$where_clause="",$where_or_clause="", $join_clause="",$group="",$custom_select="",$pagination="", $sort="")
	{
		$limit = 10;
        $offset = 0;
		$current_page = 1;
	
		$column_order = array("field"=>"","direction"=>"");

		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		
		if (!empty($where_clause)) {
            foreach ($where_clause as $key => $value) {
                $this->db->where($value);

            }
		}
		if (!empty($where_or_clause)) {
            foreach ($where_or_clause as $key => $value) {
                $this->db->or_where($value);

            }
		}
        if($join_clause != false){
            foreach ($join_clause as $key => $value) {

                $this->db->join($value->table,$value->condition,$value->join_type);
            }
        }
		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
		}

		if(is_array($pagination) && array_key_exists("page", $pagination) && array_key_exists("perpage", $pagination)){
            $limit = $pagination["perpage"];
            $current_page = $pagination["page"];
            $offset = (($current_page -1) * $limit) ;
        }

        if(is_array($sort) && array_key_exists("field", $sort) && array_key_exists("sort", $sort)){
            $column_order["field"] = $sort["field"];
            $column_order["direction"] = $sort["sort"];
		}

		if(!empty($column_order)){
            $this->db->order_by($this->db->escape_str($column_order['field']), $column_order['direction']);
		}
		
		$this->db->limit($limit, $offset);

		$this->db->select_max($column_name);
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_min($table,$column_name,$where_clause="",$where_or_clause="", $join_clause="",$group="",$custom_select="",$pagination='', $sort="")
	{
		$limit = 10;
        $offset = 0;
		$current_page = 1;
	
		$column_order = array("field"=>"","direction"=>"");

		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		
		if (!empty($where_clause)) {
            foreach ($where_clause as $key => $value) {
                $this->db->where($value);

            }
		}
		if (!empty($where_or_clause)) {
            foreach ($where_or_clause as $key => $value) {
                $this->db->or_where($value);

            }
		}

        if($join_clause != false){
            foreach ($join_clause as $key => $value) {

                $this->db->join($value->table,$value->condition,$value->join_type);
            }
		}
		
		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
		}

		if(is_array($pagination) && array_key_exists("page", $pagination) && array_key_exists("perpage", $pagination)){
            $limit = $pagination["perpage"];
            $current_page = $pagination["page"];
            $offset = (($current_page -1) * $limit) ;
        }

        if(is_array($sort) && array_key_exists("field", $sort) && array_key_exists("sort", $sort)){
            $column_order["field"] = $sort["field"];
            $column_order["direction"] = $sort["sort"];
		}

		if(!empty($column_order)){
            $this->db->order_by($this->db->escape_str($column_order['field']), $column_order['direction']);
		}
		
		$this->db->limit($limit, $offset);

		$this->db->select_min($column_name);
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_avg($table,$column_name,$where_clause="",$where_or_clause="", $join_clause="",$group="",$custom_select="",$pagination, $sort="")
	{
		$limit = 10;
        $offset = 0;
		$current_page = 1;
	
		$column_order = array("field"=>"","direction"=>"");

		if(!empty($custom_select)){
			$this->db->select($custom_select);
		}
		
		if (!empty($where_clause)) {
            foreach ($where_clause as $key => $value) {
                $this->db->where($value);

            }
		}
		if (!empty($where_or_clause)) {
            foreach ($where_or_clause as $key => $value) {
                $this->db->or_where($value);

            }
		}

        if($join_clause != false){
            foreach ($join_clause as $key => $value) {

                $this->db->join($value->table,$value->condition,$value->join_type);
            }
		}
		
		if(!empty($group)){$this->db->group_by($group);}
		if(!empty($order_by)){
			$this->db->order_by($order_by);
		}

		if(is_array($pagination) && array_key_exists("page", $pagination) && array_key_exists("perpage", $pagination)){
            $limit = $pagination["perpage"];
            $current_page = $pagination["page"];
            $offset = (($current_page -1) * $limit) ;
        }

        if(is_array($sort) && array_key_exists("field", $sort) && array_key_exists("sort", $sort)){
            $column_order["field"] = $sort["field"];
            $column_order["direction"] = $sort["sort"];
		}

		if(!empty($column_order)){
            $this->db->order_by($this->db->escape_str($column_order['field']), $column_order['direction']);
		}
		
		$this->db->limit($limit, $offset);

		$this->db->select_avg($column_name);
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_data_join($table1,$table2,$table3,$clause1,$clause2,$data,$select="*",$group="",$order_by="", $join_type1 = 'inner', $join_type2 = 'inner')
	{
		
		foreach ($data as $field => $filter) {
			$this->db->where($field, $filter);
		}
		$this->db->join($table2, $clause1, $join_type1);
		if (!empty($table3) && !empty($clause2)){
			$this->db->join($table3, $clause2, $join_type2);
		}
		if(!empty($group)){$this->db->group_by($group);}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
        $this->db->select($select);
		$query = $this->db->get($table1);
		$result = $query->result();
		return $result;
	}

	function get_data_or_where($table,$data, $order_by="")
	{
		foreach ($data as $field => $filter) {
			$this->db->or_where($field, $filter);
		}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function get_data_all($table, $order_by="")
	{
        $this->db->select('*');
        $this->db->from($table);
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
        $query = $this->db->get();
		return $query->result();
	}

	function get_single_data($table,$data)
	{
		$query = $this->db->get_where($table,$data);
		return $query->row();
	}

	function get_singel_exam_schedule_data($table1,$table2,$table3,$clause1,$clause2,$clause3,$select,$group,$where)
	{
		$this->db->select($select);
		$this->db->join($table2, $clause1);
		$this->db->where($where);
		if (!empty($table3) && !empty($clause2)){
			$this->db->join($table3, $clause2);
			$this->db->join("sync_lms_course as mcourse", $clause3);
		}
		$this->db->group_by($group);

		$query = $this->db->get($table1);
		$result = $query->result();
		return $result;
	}

	function get_last_id($table,$id_column,$extra_where=false)
	{
        $this->db->select("MAX($id_column) as max_id");
        $this->db->from($table);
        if(is_array($extra_where) && !empty($extra_where)){
	        $this->db->where($extra_where);
	    }
        $query = $this->db->get();
        $result = $query->row();
        if(empty($result)){
        	return 0;
        }else{
        	return $result->max_id;
        }
	}

	public function get_menu()
	{
		$myquery = " select * from menu";
		$query   = $this->db->query($myquery)->result();
		return $query;
	}

	public function get_submenu($menuid)
	{
		$myquery = " select * from submenu where menuid='".$menuid."'";
		$query   = $this->db->query($myquery)->result();
		return $query;
	}

    function get_data_limit($table,$limit,$order='',$order_direction='desc'){
        $this->db->select($table.".*");
        $this->db->from($table);
        $this->db->limit($limit);
        if (!empty($order)){
			$this->db->order_by($order, $order_direction);
		}
        $query = $this->db->get();
        return $query->result();
    }

    function get_data_list($table, $search, $target, $start, $limit, $order, $where, $order_direction='desc'){
        $this->db->select('*');
        $this->db->from($table);
        
        if(!empty($where)){
	        if(is_array($where)){
				foreach ($where as $field => $filter) {
					$this->db->where($field, $filter);
				}
	        }else{
				$this->db->where($where);
	        }
	    }

        if(!empty($search)){
            $this->db->like($target, $search);
        }
        
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $order_direction);
        $query = $this->db->get();

        if($query->num_rows()>0){
            return $query->result();
        }else{
            return array();
        }
	}
	
	function get_data_list_with_date($table, $search, $user_id, $start, $limit, $date_start, $date_end, $status, $order, $where, $order_direction='desc'){
        $this->db->select('*');
        $this->db->from($table);
		
		$target_date = "created_date";
		$target_status = "status";

        if(!empty($where)){
	        if(is_array($where)){
				foreach ($where as $field => $filter) {
					$this->db->where($field, $filter);
				}
	        }else{
				$this->db->where($where);
	        }
		}

        if(!empty($search)){
			// $this->db->like($target, $search);

			$this->db->where("invoice_number LIKE '%$search%'",NULL,FALSE);
			$this->db->or_where("invoice_number IN (
				select ti.invoice_number from transaction_item ti
				JOIN transaction tr ON tr.invoice_number = ti.invoice_number AND tr.user_id = '$user_id'
				WHERE ti.course_title LIKE '%$search%')",NULL,FALSE);

		}
		
		if(!empty($date_start)){
			$this->db->where("DATE($target_date) >=", $date_start);
			$this->db->where("DATE($target_date) <=", $date_end);
		}

		if(!empty($status) || $status == "0"){
			$this->db->like($target_status, $status);
		}
        
        $this->db->limit($limit, $start);
		$this->db->order_by($order, $order_direction);
		
		$query = $this->db->get();

		$transaction = $query->result();
		
        if($query->num_rows()>0){
			return $transaction;
        }else{
            return array();
        }
	}
	
	function get_data_join_list($table1,$table2,$table3,$clause1,$clause2,$data,$start="",$limit="",$select="*",$group="",$order_by="")
	{
		foreach ($data as $field => $filter) {
			$this->db->where($field, $filter);
		}
		$this->db->join($table2, $clause1);
		if (!empty($table3) && !empty($clause2)){
			$this->db->join($table3, $clause2);
		}
		if(!empty($group)){$this->db->group_by($group);}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
        }
		$this->db->select($select);
		$this->db->limit($limit, $start);
		$query = $this->db->get($table1);
		$result = $query->result();

		return $result;
	}

	function get_data_join_list_with_date($table1,$table2,$clause,$where,$target,$search,$status,$date_start,$date_end,$start="",$limit="",$select="*",$group="",$order_by="")
	{
		foreach ($where as $field => $filter) {
			$this->db->where($field, $filter);
		}
		$target_date_start = "start_date";
		$target_date_end = "end_date";

		$this->db->join($table2, $clause);

		if(!empty($group)){$this->db->group_by($group);}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
		}

		if(!empty($search)){
            $this->db->like($target, $search);
		}

		if(!empty($date_start)){
			$this->db->where("DATE($target_date_start) <=", $date_start);
			$this->db->where("DATE($target_date_end) >=", $date_start);
		}
		
		$this->db->select($select);
		$this->db->limit($limit, $start);
		$query = $this->db->get($table1);
		$result = $query->result();
		return $result;
	}

	function get_nested_data_join_list_with_date($table1,$table2,$table3,$clause1,$clause2,$where,$target,$search,$date_start,$date_end,$start="",$limit="",$select="*",$group="",$order_by="")
	{
		foreach ($where as $field => $filter) {
			$this->db->where($field, $filter);
		}
		$this->db->join($table2, $clause1);
		if (!empty($table3) && !empty($clause2)){
			$this->db->join($table3, $clause2);
		}
		if(!empty($group)){$this->db->group_by($group);}
        if(!empty($order_by)){
            $this->db->order_by($order_by);
		}
		
		$target_date = "created_date";
		$target_status = "status";

		if(!empty($search)){
            $this->db->like($target, $search);
		}
		
		if(!empty($date_start)){
			$this->db->where("DATE($target_date) >=", $date_start);
			$this->db->where("DATE($target_date) <=", $date_end);
		}

		if(!empty($status)){
			$this->db->like($target_status, $status);
		}

		$this->db->select($select);
		$this->db->limit($limit, $start);
		$query = $this->db->get($table1);
		$result = $query->result();
		return $result;
	}

}