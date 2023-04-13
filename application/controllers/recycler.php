<?php
class Recycler extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('id') )
			{
				return redirect('login');
			}
		$this->load->helper('form');
	}


	//Home Page
	public function homePage()
	{
		$this->load->model('recyclermodel');
		$name = $this->recyclermodel->profile();
		$recycled = $this->recyclermodel->Homerecycled();
		$request=$this->recyclermodel->Homerequest();
		$this->load->view("recycler/home_page",compact('name','recycled','request'));
	}
	//Home Page Ends

	//Profile
	public function profilePage()
	{
		$this->load->model('recyclermodel');
	 	$recycler = $this->recyclermodel->profile();
		$this->load->view("recycler/profile_recycler",compact('recycler'));
	}

	public function changePassword()
	{
		$this->load->view("recycler/changepassword_recycler");
	}

	public function updatePassword()
	{
	 	$this->load->model('recyclermodel');
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('password','Password','required|alpha_dash|max_length[50]');
	 	$this->form_validation->set_rules('passwordold','Password','required|alpha_dash|max_length[50]');
	 	$post = $this->input->post();
				unset($post['submit']);
	 	if($this->form_validation->run())
			{
				$password = $this->input->post('password');
				$passwordold = $this->input->post('passwordold');

				$this->_flashNredirect($this->recyclermodel->update_password($passwordold,$password,$post),'Password Updated Successfully','Failed to Update Password, Please Try Again','profilePage','profilePage');
			}
		else
			{
				$this->load->view('public/change_password');
			}
	}

    //More info on products
	public function productDetails($eid,$option)
 	{
 		$this->load->model('recyclermodel');
 		$table='ewaste';
 		$details = $this->recyclermodel->getDetails($eid,$table);
 		$this->load->view("recycler/ewasteMoreDetails",compact('details','option'));
 	}

	public function editProfile()
	{
		$this->load->model('recyclermodel');
		$profile = $this->recyclermodel->findProfile();
		$this->load->view('recycler/editprofile_recycler',compact('profile'));
	}

	public function updateProfile()
	{
		$this->load->model('recyclermodel');
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('email','Email','required|max_length[100]|valid_email');
	 	$this->form_validation->set_rules('contact','Contact No','required|exact_length[10]');
	 	$this->form_validation->set_rules('cname','Company Name','required|max_length[100]');
	 	$this->form_validation->set_rules('address','Address','required|max_length[250]');
	 	$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
	 	$post = $this->input->post();
	 	unset($post['submit']);
	 	if($this->form_validation->run())
	 	{
	 		$this->_flashNredirect($this->recyclermodel->editProfile($post),'Profile Updated Successfully','Failed to Update Profile, Please Try Again','profilePage','profilePage');
	 	}
	 	else
	 	{
	 		$profile = $this->recyclermodel->findProfile();
	 		$this->load->view('recycler/editprofile_recycler',compact('profile'));
	 	}
	}

	public function updateProfilePhoto()
	{
		$this->load->model('recyclermodel');
		$data = $this->recyclermodel->getPhoto();
		$this->load->view('recycler/updateprofilephoto_recycler',compact('data'));
	}

	public function updatePhoto()
	{
		$config = [
			'upload_path' => './uploads/profilepic/recycler',
			'allowed_types' => 'jpg|png|jpeg',
			'max_size' => '1000',
			'max_width' => '500',
			'max_height' => '500'
					];
		$this->load->library('upload',$config);
		$this->load->model('recyclermodel');
		if($this->upload->do_upload())
		{
			$this->load->helper("file");
			$path = $this->recyclermodel->getPhoto();
			unlink(".".substr($path->profile_img,19));
			//print_r(".".substr($path->profile_img,19));exit;
			$data = $this->upload->data();
			$image_path = base_url("uploads/profilepic/recycler/".$data['file_name']);
			$post['profile_img'] = $image_path;
			$this->_flashNredirect($this->recyclermodel->updatePhoto($post),'Profile Photo Updated Successfully','Failed to Update Profile Photo, Please Try Again','profilePage','profilePage');
		}
		else
		{
			$data = $this->recyclermodel->getPhoto();
			$upload_error = $this->upload->display_errors();
			$this->load->view('recycler/updateprofilephoto_recycler',compact('upload_error','data'));
		}
	}
	//Profile Ends


	//Request
	public function requestPage()
	{
		$this->load->model('recyclermodel');
		$this->load->library('pagination');
		$config=$this->getConfig("recycler/requestPage",4,$this->recyclermodel->countProducts());
		$this->pagination->initialize($config);
		$request=$this->recyclermodel->request($config['per_page'],$this->uri->segment(3));
		$this->load->view("recycler/request_recycler",compact('request'));
	}
	//Request Ends

    //Accept Request
    public function accept()
    {
        $this->load->model('recyclermodel');
    	$post=$this->input->post();
    	$this->recyclermodel->acceptProduct($post);
    	return redirect('recycler/requestPage');
    }


	//Status
	public function statusPage()
	{
		$this->load->model('recyclermodel');
		$this->load->library('pagination');
		$config=$this->getConfig("recycler/statusPage",4,$this->recyclermodel->countProductsStatus());
		$this->pagination->initialize($config);
		$status=$this->recyclermodel->status($config['per_page'],$this->uri->segment(3));
		$this->load->view("recycler/status_recycler",compact('status'));

	}
	//Status Ends

    //Update Status
	public function updateStatus($e_id)
 	{
 		 return $this->load->view("recycler/updateStatusPage",compact('e_id'));

 	}

 	//update status of the product
 	public function statusCheck()
 	{
 		$this->load->model('recyclermodel');
       $this->load->library('form_validation');
			$this->form_validation->set_rules('recycler_feedback','Specify What You Did','required|max_length[3000]');
		$this->form_validation->set_rules('creditpoints','Credit Points','required|numeric|less_than[6]');
		

	   $post = $this->input->post();    	
	    
	   // {
	   // 	   $this->form_validation->set_rules('Element'+$i,'Specify in (kgs) How Much the Selected Element is retrieved','required|numeric');
	   // }
	   // echo $post['Element1Value'];
			unset($post['submit']);
			if($this->form_validation->run())
			{
			
				$id = $this->session->userdata('id');
				$u_id = $this->recyclermodel->getUserId($post["e_id"]);
				//$data['orig_name'] = $post['date'].$id.$data['file_ext'];
				//$data['file_name'] = $post['date'].$id.$data['file_ext'];
				//file name problem to be solved
    //                 echo $post["e_id"];
				// $this->servicemodel->addStatus($post,$post["e_id"]);
				
				$this->_flashNredirect($this->recyclermodel->addStatus($post,$post["e_id"],$u_id),'Congratulations! Product Status Updated Successfully','Oh Snap! Failed to Update Status of the Product, Please Try Again','statusPage','updateStatus/{$post["e_id"]}');
			}
			else
			{
				
				$this->load->view('recycler/updateStatusPage',$post);
			}
 	}

 	public function recycledProducts()
    {
    	$this->load->library('pagination');
    	$this->load->model('recyclermodel');
		$config = $this->getConfig("recycled/recycledProducts",10,$this->recyclermodel->countRecycledProducts());
	 	$this->pagination->initialize($config);
	 	$recycled = $this->recyclermodel->recycled($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("recycler/recycledProductsPage",compact('recycled'));
    }

    public function recycledProductDetails($e_id)
    {
        $this->load->model('recyclermodel');
        $details = $this->recyclermodel->getRecycledDetails($e_id); 
 		//print_r($details[0]->p_name);exit;
 		//print_r($details[0]);exit;
 		$this->load->view("recycler/recycledProductsMoreDetails",compact('details'));
    }

     
	//FEEDBACK FUNCTION
	private function _flashNredirect($tf,$succm,$errm,$page1,$page2)
	{
		if($tf)
			{
				$this->session->set_flashdata('feedback',$succm);
				$this->session->set_flashdata('class','primary');
				return redirect('recycler/'.$page1);
			}
			else
			{
				$this->session->set_flashdata('feedback',$errm);
				$this->session->set_flashdata('class','danger');
				return redirect('recycler/'.$page2);
			}
	}
	//FEEDBACK ENDS

	//Config for pagination
	public function getConfig($url,$perpage,$totalrows)
		{
			$config = [
						'base_url' => base_url($url),
						'per_page' => $perpage,
						'total_rows' => $totalrows,
						'full_tag_open' => "<ul class='pagination'>",
						'full_tag_close' => "</ul>",
						'first_tag_open' => "<li class='page-item'>",
						'first_tag_close' => "</li>",
						'last_tag_open' => "<li class='page-item'>",
						'last_tag_close' => "</li>",
						'next_tag_open' => "<li class='page-item'>",
						'next_tag_close' => "</li>",
						'prev_tag_open' => "<li class='page-item'>",
						'prev_tag_close' => "</li>",
						'num_tag_open' => "<li class='page-item'>",
						'num_tag_close' => "</li>",
						'cur_tag_open' => "<li class='page-item active'><a class='page-link'>",
						'cur_tag_close' => "</a></li>",
						'attributes' => array('class' => 'page-link'),
			];
			return $config;
		}
	// Config ends
}
?>