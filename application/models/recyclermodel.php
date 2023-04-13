<?php
class Recyclermodel extends MY_Model{

		public function profile()
		{
			$id = $this->session->userdata('id');
			$recycler = $this->db->select(['fname','cname','contact','email','address','profile_img'])
							->where('id',$id)
							->get('recycler');
			return $recycler->row();
		}

		public function update_password($passwordold,$password,Array $recycler)
		{
			$id = $this->session->userdata('id');
			$check = $this->db->select(['pword'])
								->where('id',$id)
								->get('recycler');
			$pold = $check->row();
			if($pold->pword == $passwordold)
			{
				unset($recycler['passwordold']);
				unset($recycler['password']);
				$recycler['pword'] = $password;
				return $this->db->where('id',$id)
								->update('recycler',$recycler);
			}
			else
			{
				return FALSE;
			}
		}


		public function findProfile()
		{
			$id = $this->session->userdata('id');
			$q = $this->db->select(['cname','contact','email','address'])
							->where('id',$id)
							->get('recycler');
			return $q->row();
		}

		public function editProfile($recycler)
		{
			$id = $this->session->userdata('id');
			return $this->db->where('id',$id)
								->update('recycler',$recycler);
		}

		public function getPhoto()
		{
			$id = $this->session->userdata('id');
			$data = $this->db->select('profile_img')
						->where('id',$id)
						->get('recycler');
			return $data->row();
		}

		public function updatePhoto($post)
		{
			$id = $this->session->userdata('id');
			return $this->db->where('id',$id)
								->update('recycler',$post);
		}

        public function getDetails($e_id,$table)
        {
		   	if( $table=='ewaste'  )
		   	{
			     $x = $this->db->select(['e_id','e_name','e_quantity','e_age','e_type','e_img','e_specs','service_feedback'])
							->where('e_id',$e_id)
							->get('ewaste');
				}
				// else
				// {
				// 	$x=$this->db->select(['order_items.p_id','p_name','amount','p_type','p_img1','p_specs'])
				// 			->where('order_items.p_id',$e_id)
				// 			->join('products','products.p_id=order_items.p_id')
				// 			->get('order_items');
				// }

			  return $x->row();
         }
		public function request($limit,$offset)
		{
			$this->db->limit($limit, $offset);
			$query=$this->db->get_where('ewaste',array('r_id'=>'0','buy_nobuy'=>'0'));
			return $query->result();
		}
		
		public function Homerequest()
		{
			$this->db->limit(4);
			$query=$this->db->get_where('ewaste',array('r_id'=>'0','buy_nobuy'=>'0'));
			return $query->result();
		}

		public function acceptProduct($post)
        {
        	$this->db->update('ewaste',
        array('r_id'=>$this->session->userdata('id')),array('e_id'=>$post['accept'])) ;
        }


		public function status($limit,$offset)
		{
			$this->db->limit($limit, $offset);
			$query=$this->db->get_where('ewaste',array('r_id'=>$this->session->userdata('id'),'recycler_feedback'=>''));
			return $query->result();
		}

		public function getUserID($eid)
		{
			$id = $this->db->select('u_id')
							->where('e_id',$eid)
							->get('ewaste');
			return $id->row()->u_id;
			//print_r($id->row()->u_id); exit;
		}

		public function addStatus($post,$eid,$u_id)
		{

			$points = $this->db->select('creditpoints')
						->where('id', $u_id)
						->get('user');
			$total = $points->row()->creditpoints + $post['creditpoints'];
			$user = array('creditpoints' => $total);
			$gold=0;
			$silver=0;
			$palladium=0;
			$copper=0;
			$other_metals=0;
			$other_non_metals=0;
			//print_r($user); exit;
			if(isset($post["Element1Value"]))
				$gold=$post["Element1Value"];

			if(isset($post["Element2Value"]))
				$silver=$post["Element2Value"];

			if(isset($post["Element3Value"]))
				$palladium=$post["Element3Value"];

			if(isset($post["Element4Value"]))
				$copper=$post["Element4Value"];

			if(isset($post["Element5Value"]))
				$other_metals=$post["Element5Value"];

			if(isset($post["Element6Value"]))
				$other_non_metals=$post["Element6Value"];


			$this->db->insert('recycled_products',array(

				'e_id'=>$eid,
				'r_id'=>$this->session->userdata('id'),
				'gold'=>$gold,
				'silver'=>$silver,
				'palladium'=>$palladium,
				'copper'=>$copper,
				'other_metals'=>$other_metals,
				'other_non_metals'=>$other_non_metals,
			    ));

			$this->db->where('id',$u_id)
						->update('user',$user);
			return $this->db->where('e_id',$eid)
								->update('ewaste',array('recycler_feedback'=>$post['recycler_feedback'],'r_creditpoints'=>$post['creditpoints']));
		}
		public function countProducts()
        {
	        $x = $this->db->get_where('ewaste',array('r_id'=>'0','buy_nobuy'=>'0'));
	        return $x->num_rows();
        }

        public function getRecycledDetails($e_id)
        {
        	$x = $this->db->select(['recycled_products.e_id','e_name','e_quantity','e_age','e_type','e_img','e_specs','gold','silver','palladium','copper','other_metals','other_non_metals'])
						->where('recycled_products.e_id',$e_id)
						->join('ewaste','ewaste.e_id=recycled_products.e_id')
						->get('recycled_products');	

		  return $x->row();
        }
        public function countProductsStatus()
        {
	        $x = $this->db->get_where('ewaste',array('r_id'=>$this->session->userdata('id'),'recycler_feedback'=>''));
	        return $x->num_rows();
        }

        public function countRecycledProducts()
        {
        	 $x = $this->db->get_where('ewaste',array('r_id'=>$this->session->userdata('id'),'recycler_feedback !='=>''));
	        return $x->num_rows();
        }

        public function recycled($limit,$offset)
		{
			$this->db->limit($limit, $offset);
			$query=$this->db->get_where('ewaste',array('r_id'=>$this->session->userdata('id'),'recycler_feedback !='=>''));
			return $query->result();
		}
		public function Homerecycled()
		{
			$this->db->limit(4);
			$query=$this->db->get_where('ewaste',array('r_id'=>$this->session->userdata('id'),'recycler_feedback !='=>''));
			return $query->result();
		}
        
}
?>