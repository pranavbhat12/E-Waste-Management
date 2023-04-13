<?php
class User extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata('id') )
			{
				return redirect('login');
			}
		$this->load->helper('form');
		$this->load->model('usermodel');
	}

	//Home Page
	public function homePage()
	{
		$this->load->model('usermodel');
		$products = $this->usermodel->gethomeProducts();
		$orders = $this->usermodel->gethomeOrderDetails();
		$donations = $this->usermodel->gethomeDonationDetails();
		$name = $this->usermodel->profile();
		$this->load->view("user/home_page",compact('products','orders','donations','name'));
	}
	//Home Page Ends

	//Profile
	public function profilePage()
	{
		$this->load->model('usermodel');
	 	$user = $this->usermodel->profile();
		$this->load->view("user/profile_user",compact('user'));
	}

	public function changePassword()
	{
		$this->load->view("user/changepassword_user");
	}

	public function updatePassword()
	{
	 	$this->load->model('usermodel');
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('password','Password','required|alpha_dash|max_length[50]');
	 	$this->form_validation->set_rules('passwordold','Password','required|alpha_dash|max_length[50]');
	 	$post = $this->input->post();
				unset($post['submit']);
	 	if($this->form_validation->run())
			{
				$password = $this->input->post('password');
				$passwordold = $this->input->post('passwordold');

				$this->_flashNredirect($this->usermodel->update_password($passwordold,$password,$post),'Password Updated Successfully','Failed to Update Password, Please Try Again','profilePage','profilePage');
			}
		else
			{
				$this->load->view('public/change_password');
			}
	}

	public function editProfile()
	{
		$this->load->model('usermodel');
		$profile = $this->usermodel->findProfile();
		$this->load->view('user/editprofile_user',compact('profile'));
	}

	public function updateProfile()
	{
		$this->load->model('usermodel');
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
	 		$this->_flashNredirect($this->usermodel->editProfile($post),'Profile Updated Successfully','Failed to Update Profile, Please Try Again','profilePage','profilePage');
	 	}
	 	else
	 	{
	 		$profile = $this->usermodel->findProfile();
	 		$this->load->view('user/editprofile_user',compact('profile'));
	 	}
	}

	public function updateProfilePhoto()
	{
		$this->load->model('usermodel');
		$data = $this->usermodel->getPhoto();
		$this->load->view('user/updateprofilephoto_user',compact('data'));
	}

	public function updatePhoto()
	{
		$config = [
			'upload_path' => './uploads/profilepic/user',
			'allowed_types' => 'jpg|png|jpeg',
			'max_size' => '1000',
			'max_width' => '500',
			'max_height' => '500'
					];
		$this->load->library('upload',$config);
		$this->load->model('usermodel');
		if($this->upload->do_upload())
		{
			$this->load->helper("file");
			$path = $this->usermodel->getPhoto();
			unlink(".".substr($path->profile_img,19));
			//print_r(".".substr($path->profile_img,19));exit;
			$data = $this->upload->data();
			$image_path = base_url("uploads/profilepic/user/".$data['file_name']);
			$post['profile_img'] = $image_path;
			$this->_flashNredirect($this->usermodel->updatePhoto($post),'Profile Photo Updated Successfully','Failed to Update Profile Photo, Please Try Again','profilePage','profilePage');
		}
		else
		{
			$data = $this->usermodel->getPhoto();
			$upload_error = $this->upload->display_errors();
			$this->load->view('user/updateprofilephoto_user',compact('upload_error','data'));
		}
	}

	public function yourOrders()
	{
		$this->load->library('pagination');
		$config = $this->getConfig("user/yourOrders",10,$this->usermodel->countUserOrders());
	 	$this->pagination->initialize($config);
	 	$orders = $this->usermodel->getUserOrders($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("user/your_orders_user",compact('orders'));
	}

	public function orderDetails($o_id)
	{
		$order = $this->usermodel->getOrderDetails($o_id);
		$this->session->set_userdata('o_id',$o_id);
		//print_r($order);exit;
		$this->load->view("user/order_detail_user",compact('order'));
	}

	public function giveFeedback($p_id)
	{
		$this->session->set_userdata('p_id',$p_id);
		$this->load->view("user/feedback_user");
	}

	public function updateFeedback()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('review','Feedback','required|max_length[250]');
	 	$this->form_validation->set_rules('rating','Rating','required');
	 	$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
	 	$post = $this->input->post();
	 	unset($post['submit']);
	 	if($this->form_validation->run())
	 	{
	 		$this->_flashNredirect($this->usermodel->enterFeedback($post),'Feedback Provided Successfully','Failed to Provide Feedback, Please Try Again','yourOrders','yourOrders');
	 	}
	}

	public function yourDonations()
	{
		$this->load->library('pagination');
		$config = $this->getConfig("user/yourDonations",10,$this->usermodel->countUserDonations());
	 	$this->pagination->initialize($config);
	 	$donations = $this->usermodel->getUserDonations($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("user/your_donations_user",compact('donations'));
	}

	public function donationDetails($e_id)
	{
		$donation = $this->usermodel->getDonationDetails($e_id);
       
		$this->load->view("user/donation_detail_user",compact('donation'));
	  
	}

	public function donationStatus($e_id)
	{
		$donation = $this->usermodel->getDonationStatus($e_id);
	  
        $this->load->view("user/donate_status",compact('donation'));
	}


	//Profile Ends
 	

 	//Donate E-waste
	public function donatePage()
	{
		$this->load->view("user/donate_user");	
	}

	public function donateEwaste()
	{
		$this->load->model('usermodel');
		$config = [
				'upload_path' => './uploads/ewaste',
				'allowed_types' => 'jpg|gif|png|jpeg'
			];
			$this->load->library('upload',$config);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('e_type','Type','required');
			$this->form_validation->set_rules('e_name','Model Name','required|max_length[100]');
			$this->form_validation->set_rules('e_age','Age of E-waste','required|is_natural_no_zero');
			$this->form_validation->set_rules('e_quantity','Quantity of E-waste','required|is_natural_no_zero');
			$this->form_validation->set_rules('e_specs','Specification','required|max_length[400]');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

			$post = $this->input->post();
			$post['buy_nobuy']=1;
			unset($post['submit']);
			if($this->form_validation->run() && $this->upload->do_upload())
			{
				$data = $this->upload->data();
				$id = $this->session->userdata('id');
				//$data['orig_name'] = $post['date'].$id.$data['file_ext'];
				//$data['file_name'] = $post['date'].$id.$data['file_ext'];
				//file name problem to be solved
				$image_path = base_url("uploads/ewaste/".$data['file_name']);
				$post['e_img'] = $image_path;
				$post['u_id'] = $this->session->userdata('id');
				$this->_flashNredirect($this->usermodel->addEwaste($post),'Congratulations! E-waste Uploaded Successfully','Oh Snap! Failed to Upload E-waste, Please Try Again','donatePage','donatePage');
			}
			else
			{
				$upload_error = $this->upload->display_errors();
				$this->load->view('user/donate_user',compact('upload_error'));
			}
	}
 	//Donate E-waste Ends


 	//Buy RF Products
 	public function buyPage()
 	{
	 	$this->load->model('usermodel');
	 	$this->load->library('pagination');
	 	$config = $this->getConfig("user/buyPage",8,$this->usermodel->countProducts());
	 	$this->pagination->initialize($config);
	 	$products = $this->usermodel->getProducts($config['per_page'] ,$this->uri->segment(3));
	 	$this->load->view("user/buy_user",compact('products'));
 	}

 	public function productDetails($pid,$option)
 	{
 		$this->load->model('usermodel');
 		$details = $this->usermodel->getDetails($pid);
 		$reviews = $this->usermodel->reviewOfProduct($pid);
 		$recommend = $this->usermodel->recommendProduct($pid);
 		//print_r($reviews);exit;
 		$this->load->view("user/productdetail_user",compact('details','option','reviews','recommend'));
 	}

 	public function search()
 	{
 		$this->load->model('usermodel');
	 	$post = $this->input->post();
	 	$string = $post['search'];
	 	$sortby = $post['sortby'];
	 	if($string=='')
	 	{
	 		return redirect("user/searchResults_/$sortby/");
	 	}
	 	return redirect("user/searchResults/$sortby/$string/");
 	}

 	public function searchResults($sortby,$string)
 	{
 		$this->load->model('usermodel');
	 	$this->load->library('pagination');
 		$config = $this->getConfig("user/searchResults/$sortby/$string/",8,$this->usermodel->countSearchProducts($string));
	 	$this->pagination->initialize($config);
	 	$products = $this->usermodel->getSearchProducts($config['per_page'] ,$this->uri->segment(5),$string,$sortby);
	 	$this->load->view("user/search_user",compact('products'));
 	}

 	public function searchResults_($sortby)
 	{
 		$this->load->model('usermodel');
	 	$this->load->library('pagination');
 		$config = $this->getConfig("user/searchResults_/$sortby/",8,$this->usermodel->countSearchProducts2());
	 	$this->pagination->initialize($config);
	 	$products = $this->usermodel->getSearchProducts2($config['per_page'] ,$this->uri->segment(4),$sortby);
	 	$this->load->view("user/search_user",compact('products'));
 	}
 	//Buy RF Product Ends


 	//CART
 	public function cartPage()
 	{
 		$this->load->library('cart');
 		$this->load->view("user/cart_user");
 	}

    public function addToCart($p_id)
    {
    	$this->load->library('cart');
    	$this->load->model('usermodel');
    	$product = $this->usermodel->getProduct($p_id);
    	$data = array(
					    'id'      => $product[0]->p_id,
					    's_id'    => $product[0]->s_id,
					    'qty'     => 1,
				        'price'   => $product[0]->p_cost,
				        'name'    => $product[0]->p_name,
				        'photo1'  => $product[0]->p_img1,
				        'type'    => $product[0]->p_type,
				        'cname'   => $product[0]->cname,
					);
    	$this->cart->insert($data);
    	return redirect("user/cartPage");
    	//print_r($data);exit;
    	//$data = array('id' => $this->$, );
    }

    public function deleteItem($rowid)
 	{
 		$this->load->library('cart');
 		$this->cart->remove($rowid);
 		return redirect("user/cartPage");
 	}


 	public function updateItemP($rowid)
 	{
 		$this->load->library('cart');
 		$data = $this->cart->get_item($rowid);
 		$data['qty'] = $data['qty']+1;
 		$update = array(
 			'rowid' => $rowid,
 			'qty' => $data['qty'] 
 		);
 		$this->cart->update($update);
 		return redirect("user/cartPage");
 		//print_r($data);
 	}

 	public function updateItemM($rowid)
 	{
 		$this->load->library('cart');
 		$data = $this->cart->get_item($rowid);
 		$data['qty'] = $data['qty']-1;
 		$update = array(
 			'rowid' => $rowid,
 			'qty' => $data['qty'] 
 		);
 		$this->cart->update($update);
 		return redirect("user/cartPage");
 		//print_r($data);
 	}

 	public function useCreditPoints()
 	{
 		$this->load->library('cart');
 		$creditpoints = $this->usermodel->getCreditPoints();
 		//print_r($creditpoints);exit;
 		if($creditpoints > $this->cart->total())
 		{
 			$creditpoints = $this->cart->total();
 		}
 		$this->session->set_userdata('creditpoints',$creditpoints);
 		return redirect("user/cartPage");
 	}

	 public function payment()
	 {
		 $this->load->view('my_stripe',$_SESSION); 
		 //$this->load->library('cart');
 		 //$this->load->model('usermodel');
		 
		 //$_SESSION["payment_total"]
	 }

 	public function order()
 	{
 		$this->load->library('cart');
 		$this->load->model('usermodel');
 		if($this->cart->total()>0)
 		{
			
	 		$data = $this->cart->contents();

	 		$data1 = array('u_id' => $this->session->userdata('id'),
	 						'amount' => $this->cart->total(),
	 						'date' => date('Y-m-d H:i:s'));	 		
	 		$id = $this->usermodel->addOrderTable($data1);
	 		$i=0;
	 		$data2 = array();
	 		foreach ($data as &$items){
		 		$data2[$i]['o_id'] = $id;
		 		$data2[$i]['p_id'] = $items['id'];
		 		$data2[$i]['s_id']=$items['s_id'];
		 		$data2[$i]['u_id']=$this->session->userdata('id');
		 		$data2[$i]['quantity'] = $items['qty'];
		 		$data2[$i]['amount'] = $items['subtotal'];
		 		$data2[$i]['date']=date('Y-m-d H:i:s');
		 		$i++;
	 		}
	 		$check =  $this->usermodel->addOrderItems($data2);
			$transaction = $this->payment();
	 		if($check)
	 		{
	 			$this->cart->destroy();
	 			$this->_flashNredirect($check,'Congratulations! Order Placed Successfully','Oh Snap! Failed to Place Order, Please Try Again','cartPage','cartPage');
	 		}
	 		
 		}
 		else
 		{
 			$this->_flashNredirect(false,'Congratulations! Order Placed Successfully','Your Cart is Empty','cartPage','cartPage');
 		}
 	}
    //CART Ends

	//FEEDBACK FUNCTION
	private function _flashNredirect($tf,$succm,$errm,$page1,$page2)
	{
		if($tf)
			{
				$this->session->set_flashdata('feedback',$succm);
				$this->session->set_flashdata('class','primary');
				return redirect('user/'.$page1);
			}
			else
			{
				$this->session->set_flashdata('feedback',$errm);
				$this->session->set_flashdata('class','danger');
				return redirect('user/'.$page2);
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