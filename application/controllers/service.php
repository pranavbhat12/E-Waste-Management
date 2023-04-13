<?php
class Service extends MY_Controller{
	 
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
		$this->load->model('servicemodel');
	 	$serviced = $this->servicemodel->getHomeServicedProducts();
	 	$orders = $this->servicemodel->gethomeHistoryProducts();
		$request=$this->servicemodel->Homerequest();
		$name=$this->servicemodel->profile();
		$this->load->view("service/home_page",compact('orders','serviced','request','name'));
	}
	//Home Page Ends


	//Profile
	public function profilePage()
	{
		$this->load->model('servicemodel');
	 	$service = $this->servicemodel->profile();
		$this->load->view("service/profile_service",compact('service'));
	}

	public function changePassword()
	{
		$this->load->view("service/changepassword_service");
	}

	public function updatePassword()
	{
	 	$this->load->model('servicemodel');
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('password','Password','required|alpha_dash|max_length[50]');
	 	$this->form_validation->set_rules('passwordold','Password','required|alpha_dash|max_length[50]');
	 	$post = $this->input->post();
				unset($post['submit']);
	 	if($this->form_validation->run())
			{
				$password = $this->input->post('password');
				$passwordold = $this->input->post('passwordold');

				$this->_flashNredirect($this->servicemodel->update_password($passwordold,$password,$post),'Password Updated Successfully','Failed to Update Password, Please Try Again','profilePage','profilePage');
			}
		else
			{
				$this->load->view('public/change_password');
			}
	}

	public function editProfile()
	{
		$this->load->model('servicemodel');
		$profile = $this->servicemodel->findProfile();
		$this->load->view('service/editprofile_service',compact('profile'));
	}

	public function updateProfile()
	{
		$this->load->model('servicemodel');
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
	 		$this->_flashNredirect($this->servicemodel->editProfile($post),'Profile Updated Successfully','Failed to Update Profile, Please Try Again','profilePage','profilePage');
	 	}
	 	else
	 	{
	 		$profile = $this->servicemodel->findProfile();
	 		$this->load->view('service/editprofile_service',compact('profile'));
	 	}
	}

	public function updateProfilePhoto()
	{
		$this->load->model('servicemodel');
		$data = $this->servicemodel->getPhoto();
		$this->load->view('service/updateprofilephoto_service',compact('data'));
	}

	public function updatePhoto()
	{
		$config = [
			'upload_path' => './uploads/profilepic/service',
			'allowed_types' => 'jpg|png|jpeg',
			'max_size' => '1000',
			'max_width' => '500',
			'max_height' => '500'
					];
		$this->load->library('upload',$config);
		$this->load->model('servicemodel');
		if($this->upload->do_upload())
		{
			$this->load->helper("file");
			$path = $this->servicemodel->getPhoto();
			unlink(".".substr($path->profile_img,19));
			//print_r(".".substr($path->profile_img,19));exit;
			$data = $this->upload->data();
			$image_path = base_url("uploads/profilepic/service/".$data['file_name']);
			$post['profile_img'] = $image_path;
			$this->_flashNredirect($this->servicemodel->updatePhoto($post),'Profile Photo Updated Successfully','Failed to Update Profile Photo, Please Try Again','profilePage','profilePage');
		}
		else
		{
			$data = $this->servicemodel->getPhoto();
			$upload_error = $this->upload->display_errors();
			$this->load->view('service/updateprofilephoto_service',compact('upload_error','data'));
		}
	}
	//Profile Ends


	//Request
	public function requestPage()
	{
		$this->load->model('servicemodel');
		$this->load->library('pagination');
		$config=$this->getConfig("service/requestPage",4,$this->servicemodel->countProducts());
		$this->pagination->initialize($config);
		$request=$this->servicemodel->request($config['per_page'],$this->uri->segment(3));

		$this->load->view("service/request_service",compact('request'));

	}
   
    //More info on Products
	public function productDetails($eid,$option)
 	{
 		$this->load->model('servicemodel');
 		$table='ewaste';
 		$details = $this->servicemodel->getDetails($eid,$table);
 		$this->load->view("service/ewasteMoreDetails",compact('details','option'));
 	}


 	// Redirect toUpdate Status Page
 	public function updateStatus($e_id)
 	{
 		
 		 return $this->load->view("service/updateStatusPage",compact('e_id'));

 	}


    //update status of the product
 	public function statusCheck()
 	{
 		$this->load->model('servicemodel');
       $this->load->library('form_validation');
			$this->form_validation->set_rules('problem','Specify the Problem','required|max_length[3000]');
			$this->form_validation->set_rules('service_feedback','Specify What You Did','required|max_length[3000]');
			$this->form_validation->set_rules('creditpoints','Credit Points','required|numeric|less_than[6]');
	   $post = $this->input->post();
			unset($post['submit']);
			if($this->form_validation->run())
			{
			
				$id = $this->session->userdata('id');
				$u_id = $this->servicemodel->getUserId($post["e_id"]);
				//print_r($post['creditpoints']); exit;
				$this->_flashNredirect($this->servicemodel->addStatus($post,$post["e_id"],$u_id),'Congratulations! Product Status Updated Successfully and Product is Transfered to Recyclers ','Oh Snap! Failed to Update Status of the Product, Please Try Again','statusPage','updateStatus/{$post["e_id"]}');
				
			}
			else
			{
				
				$this->load->view('service/updateStatusPage',$post);
			}
 	}


public function servicedProductDetails($eid)
 	{
 		$this->load->model('servicemodel');
 		
 		$details = $this->servicemodel->getServicedDetails($eid);
 		
 		$this->load->view("service/servicedProductsMoreDetails",compact('details'));
 	}
 	//More Info on Sold Products
 	public function moreInfoSold($pid,$option)
 	{
 		$this->load->model('servicemodel');
 		$table='products';
 		$details=$this->servicemodel->getDetails($pid,$table);
 		$this->load->view("service/soldHistoryMoreDetails",compact('details','option'));
 	}
	//Request Ends
    public function accept()
    {
    	$this->load->model('servicemodel');
    	$post=$this->input->post();
    	$this->servicemodel->acceptProduct($post);
    	return redirect('service/requestPage');
    	
    }

	//Status
	public function statusPage()
	{
		$this->load->model('servicemodel');

		$this->load->library('pagination');
		$config=$this->getConfig("service/statusPage",4,$this->servicemodel->countProductsStatus());
		$this->pagination->initialize($config);
		$status=$this->servicemodel->status($config['per_page'],$this->uri->segment(3));
        
		$this->load->view("service/status_service",compact('status'));

	}
	//Status Ends

    //Setting Status of the Orders Placed.
	public function orderStatus()
	{
		$this->load->model('servicemodel');
      	$this->load->library('pagination');
        $config=$this->getConfig("service/orderStatus",3,$this->servicemodel->countOrderStatus());
        $this->pagination->initialize($config);
	     $order = $this->servicemodel->getOrderStatus($config['per_page'],$this->uri->segment(3));
         //print_r($order);
	      
		$this->load->view("service/order_status",compact('order'));
	}

	//More Details of a Product in order and Status
	
	public function moreInfoOrderStatus($oid,$pid,$option)
 	{
 		$this->load->model('servicemodel');
 		
 		$details=$this->servicemodel->getMoreDetailsOrderStatus($oid,$pid);
 		$this->load->view("service/soldHistoryMoreDetails",compact('details','option'));
 	}

	//Order Tracking
	public function orderTracking()
	{
		$this->load->model('servicemodel');
		$this->load->library('form_validation');
		$post = $this->input->post();
		$this->form_validation->set_rules('tracking','Tracking Status','required');
		
			unset($post['submit']);
				
				$this->_flashNredirect($this->servicemodel->updateTracking($post["orderId"],$post["productId"],$post),'Product Tracking Updated ','Oh Snap! Failed to Update Tracking Product, Please Try Again','orderStatus','orderStatus');
			

	}

    //Sell Refurbish
    public function sellrefurbish()
    {
    	$this->load->view("service/sell_refurbish_service");

    }

    //History of Sold Products
    public function historyProducts()
    {
    	$this->load->library('pagination');
    	$this->load->model('servicemodel');
		$config = $this->getConfig("service/historyProducts",10,$this->servicemodel->countHistoryProducts());
	 	$this->pagination->initialize($config);
	 	$orders = $this->servicemodel->getHistoryProducts($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("service/history",compact('orders'));
    }


    public function servicedProducts()
    {
    	$this->load->library('pagination');
    	$this->load->model('servicemodel');
		$config = $this->getConfig("service/servicedProducts",10,$this->servicemodel->countServicedProducts());
	 	$this->pagination->initialize($config);
	 	$serviced = $this->servicemodel->getServicedProducts($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("service/servicedProducts",compact('serviced'));
    }

    //Upload Service Center's Product to the Page
    public function uploadProduct()
    {
    	$this->load->model('servicemodel');
    	$config = [
				'upload_path' => './uploads/ewaste',
				'allowed_types' => 'jpg|gif|png|jpeg'
			];
			$this->load->library('upload',$config);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('p_type','Type','required');
			$this->form_validation->set_rules('p_name','Model Name','required|max_length[100]');
			$this->form_validation->set_rules('p_age','Age of Product','required|is_natural_no_zero');
			$this->form_validation->set_rules('p_quantity','Quantity of Refurbished Product','required|is_natural_no_zero');
			$this->form_validation->set_rules('p_cost','Cost of Refurbished Product','required|is_natural_no_zero');
			$this->form_validation->set_rules('p_specs','Specification','required|max_length[10000]');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			$post = $this->input->post();
			unset($post['submit']);
			if($this->form_validation->run() && $this->upload->do_upload())
			{
				$data = $this->upload->data();
				$id = $this->session->userdata('id');
				//$data['orig_name'] = $post['date'].$id.$data['file_ext'];
				//$data['file_name'] = $post['date'].$id.$data['file_ext'];
				//file name problem to be solved
				$image_path = base_url("uploads/ewaste/".$data['file_name']);
				$post['p_img1'] = $image_path;
				$post['s_id'] = $this->session->userdata('id');
				$this->_flashNredirect($this->servicemodel->addProduct($post),'Congratulations! Product Uploaded Successfully','Oh Snap! Failed to Upload Product, Please Try Again','sellrefurbish','sellrefurbish');
			}
			else
			{
				$upload_error = $this->upload->display_errors();
				$this->load->view('service/sell_refurbish_service',compact('upload_error'));
			}
    }
//Forward Request
	public  function forwardRequest()
	{
		$this->load->model('servicemodel');
		$post=$this->input->post();
		print_r($post["forward"]);
		$this->servicemodel->requestForward($post);
		return redirect('service/statusPage');
	}
	//FEEDBACK FUNCTION
	private function _flashNredirect($tf,$succm,$errm,$page1,$page2)
	{
		if($tf)
			{
				$this->session->set_flashdata('feedback',$succm);
				$this->session->set_flashdata('class','primary');
				return redirect('service/'.$page1);
			}
			else
			{
				$this->session->set_flashdata('feedback',$errm);
				$this->session->set_flashdata('class','danger');
				return redirect('service/'.$page2);
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