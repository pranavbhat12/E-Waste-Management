<?php 
class Loginmodel extends MY_Model{

	public function validate_user_login($role,$email,$password)
	{
		$q = $this->db->where(['email'=>$email,'pword'=>$password,'role'=>$role])
						->get($role);
		if($q->num_rows())
			{
				return $q->row()->id;
			}
		else
			{
				return FALSE;
			}
	}

	public function add_user($array)
	{
		return $this->db->insert($array['role'],$array);
	}

	
}
?>