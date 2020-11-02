<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	/**
	 * @author : Alifia Syalsabila
	 * @keterangan : Model untuk Auth
	 **/

	public function do_auth($u,$p)
	{
        if (!empty($u) && !empty($p)){
			$user = $this->get_single("user",array("email" => $u));
			if (!empty($user)){
				if (md5($p.$user["salt"]) == $user["password"]){
					$id = $user["id"];
					if (!empty($id)){
                        echo "check";
                        $user_data = array(
                            "id" => $user["id"],
                            "fullname" => $user["fullname"],
                            "email" => $user["email"],
                            "privilege" => $user["privilege"]
                            );
                        return $user_data;
					}
				}
			}
        }
    }

    public function get_single($table,$where="",$order="")
    {
        $this->db->from($table);
        if(!empty($where)){$this->db->where($where);}
		$this->db->limit(1);
		if(!empty($order)){$this->db->order_by($order);}
        $query = $this->db->get();
        return $query->row_array();
    }
}