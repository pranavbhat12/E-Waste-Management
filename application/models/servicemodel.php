<?php
class Servicemodel extends MY_Model{
     
		public function profile()
		{
			$id = $this->session->userdata('id');
			$service = $this->db->select(['fname','cname','contact','email','address','profile_img'])
							->where('id',$id)
							->get('service');
			return $service->row();
		}

		public function update_password($passwordold,$password,Array $service)
		{
			$id = $this->session->userdata('id');
			$check = $this->db->select(['pword'])
								->where('id',$id)
								->get('service');
			$pold = $check->row();
			if($pold->pword == $passwordold)
			{
				unset($service['passwordold']);
				unset($service['password']);
				$service['pword'] = $password;
				return $this->db->where('id',$id)
								->update('service',$service);
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
							->get('service');
			return $q->row();
		}

		public function getDetails($e_id,$table) 
        {
		   	if( $table=='ewaste'  )
		   	{
			     $x = $this->db->select(['e_id','e_name','e_quantity','e_age','e_type','e_img','e_specs','service_feedback'])
							->where('e_id',$e_id)
							->get('ewaste');
				}
				else
				{
					$x=$this->db->select(['order_items.p_id','p_name','amount','p_type','p_img1','p_specs','order_items.quantity','fname','cname','contact','email','address','Tracking','o_id'])
							->where('order_items.p_id',$e_id)
							->join('products','products.p_id=order_items.p_id')
							->join('user','user.id=order_items.u_id')
							->get('order_items');
				}

			  return $x->row();
         }
         public function getServicedDetails($e_id)
	   {
	        $x = $this->db->select('*')
						->where('e_id',$e_id)
						->get('ewaste');
			 return $x->row();
	   }


		public function editProfile($service)
		{
			$id = $this->session->userdata('id');
			return $this->db->where('id',$id)
								->update('service',$service);
		}

		public function getPhoto()
		{
			$id = $this->session->userdata('id');
			$data = $this->db->select('profile_img')
						->where('id',$id)
						->get('service');
			return $data->row();
		}

		public function updatePhoto($post)
		{
			$id = $this->session->userdata('id');
			return $this->db->where('id',$id)
								->update('service',$post);
		}

		public function request($limit,$offset)
		{
			 
			 	$this->db->limit($limit, $offset);
			 	$query=$this->db->get_where('ewaste',array('s_id'=>'0'));
			
			return $query->result();
		}
		public function Homerequest()
		{
			$this->db->limit(3);
			$query=$this->db->get_where('ewaste',array('s_id'=>'0'));
			
			return $query->result();	
		}
		public function status($limit,$offset)
		{
			
			 	$this->db->limit($limit, $offset);
			 	$query=$this->db->get_where('ewaste',array('s_id'=>$this->session->userdata('id'),'r_id'=>0,'buy_nobuy'=>1));
			
			return $query->result();
		}
		
		public function acceptProduct($post)
		{
			 $this->db->update('ewaste',
        array('s_id'=>$this->session->userdata('id')),array('e_id'=>$post['hiddenAccept'])) ;
		}

		public function addProduct($array)
		{
               return $this->db->insert('products',$array);
		}

		public function addStatus($post,$eid,$u_id)
		{
			$points = $this->db->select('creditpoints')
						->where('id', $u_id)
						->get('user');
			$total = $points->row()->creditpoints + $post['creditpoints'];
			$user = array('creditpoints' => $total);
			//print_r($user); exit;

			$this->db->where('id',$u_id)
						->update('user',$user);
			$this->db->update('ewaste',array('buy_nobuy'=>'0'),array('e_id'=>$eid));

			return $this->db->where('e_id',$eid)
								->update('ewaste',array('problem'=>$post['problem'],'service_feedback'=>$post['service_feedback'], 's_creditpoints'=>$post['creditpoints']));
		}

		public function updateTracking($oid,$pid,$post)
		{
			return $this->db->where(array('o_id'=>$oid,'p_id'=>$pid))
								->update('order_items',array('Tracking'=>$post['tracking']));
		}

		public function disableStatus($eid)
		{
			$disable = $this->db->select('service_feedback')
						->where('e_id', $eid)
						->get('ewaste');
			if($disable->row()->service_feedback!='')
				return TRUE;
			else
				return FALSE;

		}

		public function getUserID($eid)
		{
			$id = $this->db->select('u_id')
							->where('e_id',$eid)
							->get('ewaste');
			return $id->row()->u_id;
			//print_r($id->row()->u_id); exit;
		}

		// public function requestForward($post)
		// {
		// 	$this->db->update('ewaste',array('buy_nobuy'=>'0'),array('e_id'=>$post['forward']));
		// }
		public function countProducts()
        {
	        $x = $this->db->get_where('ewaste',array('s_id'=>'0'));
	        return $x->num_rows();
        }
        public function countProductsStatus()
        {
	        $x = $this->db->get_where('ewaste',array('s_id'=>$this->session->userdata('id'),'r_id'=>0,'buy_nobuy'=>'1'));
	        return $x->num_rows();
        }

        public function countServicedProducts()
        {
	        $x = $this->db->get_where('ewaste',array('s_id'=>$this->session->userdata('id'),'service_feedback!='=>""));
	        return $x->num_rows();
        }

        public function getServicedProducts($limit,$offset)
         {
         	$id=$this->session->userdata('id');
         	$x=$this->db->select('*')
         	   ->where(array('s_id'=>$this->session->userdata('id'),'service_feedback!='=>""))
         	   ->limit($limit,$offset)
			   ->order_by('date','DESC')
         	   ->get('ewaste');
         	  return $x->result();
         }
         public function getHomeServicedProducts()
		{
			$this->db->limit(3);
			$id=$this->session->userdata('id');
         	$x=$this->db->select('*')
         	   ->where(array('s_id'=>$this->session->userdata('id'),'service_feedback!='=>""))

			   ->order_by('date','DESC')
         	   ->get('ewaste');

         	  return $x->result();		
			
		}

        public function countHistoryProducts()
        {
	       $id = $this->session->userdata('id');
	       $x = $this->db->select(['p_id'])
				->where(array('s_id'=>$id,'Tracking'=>"Delivered"))
				->get('order_items');
	       return $x->num_rows();
         }
         public function getHistoryProducts($limit,$offset)
         {
         	$id=$this->session->userdata('id');
         	$x=$this->db->select(['o_id','u_id','products.p_id','p_name','amount','order_items.date','p_img1','p_type','p_specs','quantity','p_cost','Tracking'])
         	   ->where(array('order_items.s_id'=>$id,'Tracking'=>"Delivered"))
         	   ->join('products','products.p_id=order_items.p_id')
         	   ->limit($limit,$offset)
			   ->order_by('order_items.date','DESC')
         	   ->get('order_items');
         	   //print_r($x->result());exit;
         	  return $x->result();
         }

         public function countOrderStatus()
        {
	       $id = $this->session->userdata('id');
	       $x = $this->db->select(['p_id'])
				->where(array('s_id'=>$id,'Tracking !='=>"Delivered"))
				->get('order_items');
	       return $x->num_rows();
         }
         public function getOrderStatus($limit,$offset)
         {
         	$id=$this->session->userdata('id');
         	$x=$this->db->select(['o_id','u_id','products.p_id','p_name','amount','order_items.date','p_img1','p_type','p_specs','quantity','p_cost','Tracking'])
         	   ->where(array('order_items.s_id'=>$id,'Tracking !='=>"Delivered"))
         	   ->join('products','products.p_id=order_items.p_id')
         	   ->limit($limit,$offset)
			   ->order_by('order_items.date','DESC')
         	   ->get('order_items');
         	  return $x->result();
         }

         public function getMoreDetailsOrderStatus($oid,$pid)
         {
         	$x=$this->db->select(['order_items.p_id','p_name','amount','p_type','p_img1','p_specs','order_items.quantity','fname','cname','contact','email','address','Tracking','o_id'])
							->where(array('order_items.o_id'=>$oid,'order_items.p_id'=>$pid))
							->join('products','products.p_id=order_items.p_id')
							->join('user','user.id=order_items.u_id')
							->get('order_items');

			return $x->row();
         }

		 public function gethomeHistoryProducts()
		 {
			$id=$this->session->userdata('id');
			$x=$this->db->select(['o_id','u_id','products.p_id','p_name','amount','order_items.date'])
			   ->where(array('order_items.s_id'=>$id,'Tracking'=>"Delivered"))
			   ->join('products','products.p_id=order_items.p_id')
			   ->limit(4)
			    ->order_by('order_items.date','DESC')
			   ->get('order_items');
			  return $x->result();
		 }

}
?>