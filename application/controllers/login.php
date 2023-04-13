<?php   
class Login extends MY_Controller{



	//TESTING PURPOSE ONLY
	public function testing()
		{
			$this->load->view('my_stripe.php');
			//$this->load->view('service/request_service');
			//$config = $this->getConfig("hello",4,6);
			//print_r($config) ; exit;
		}

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
	//TEST YOUR VIEWS USING THE ABOVE FUNCTION

	public function index()
		{
			if($this->session->userdata('id'))
			{
			 	$role = $this->session->userdata('role');
				return redirect($role.'/page');
			}
			$this->load->helper('form');
			$this->load->view('public/home_page');
		}

	public function publicLogin()
		{
			if($this->session->userdata('id'))
			{
				$role = $this->session->userdata('role');
				return redirect($role.'/profilePage');
			}
			$this->load->helper('form');
			$this->load->view('public/public_login');
		}

	public function publicSignup()
		{
			if($this->session->userdata('id'))
			{
				$role = $this->session->userdata('role');
				return redirect($role.'/profilePage');
			}
			$this->load->helper('form');
			$this->load->view('public/public_signup');
		}

	public function verifyLogin()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email','required|max_length[100]|valid_email');
			$this->form_validation->set_rules('pword','Password','required|max_length[50]');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

			if($this->form_validation->run())
			{
				$role = $this->input->post('role');
				$email = $this->input->post('email');
				$password = $this->input->post('pword');
				$this->load->model('loginmodel');
				$id = $this->loginmodel->validate_user_login($role,$email,$password);
				if( $id )
					{
						if($role == 'user')
						{
							$newdata = array(
											'id' => $id,
											'role' => $role,
											'creditpoints' => 0
										);
						}
						else
						{
							$newdata = array(
											'id' => $id,
											'role' => $role
										);
						}
						$this->session->set_userdata($newdata);
						return redirect($role.'/profilePage');
					}
				else
					{
						$this->_flashNredirect(0,'Login Successful','Email or Password did not match, Please Try Again');
						return redirect('login');
					} 
			}
			else
			{
				$this->load->view('public/public_login');
			}
		}

	public function verifySignUp()
	{
		$config = [
			'upload_path' => './uploads/profilepic',
			'allowed_types' => 'jpg|png|jpeg',
			'max_size' => '1000',
			'max_width' => '500',
			'max_height' => '500'
					];

		
		$this->load->library('form_validation');
		$post = $this->input->post();
		$this->form_validation->set_rules('fname','Fullname','required|alpha_numeric_spaces|max_length[100]');
		$this->form_validation->set_rules('pword','Password','required|max_length[50]');
		$this->form_validation->set_rules('cname','Company Name','required|max_length[100]');
		$this->form_validation->set_rules('role','Role','required|max_length[10]');
		$this->form_validation->set_rules('address','Address','required|max_length[250]');
		if($post['role']=='user')
		{
			$this->form_validation->set_rules('email','Email ID','required|max_length[100]|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('contact','Contact Number','required|exact_length[10]|is_unique[user.contact]');
			$config['upload_path'] = './uploads/profilepic/user';
		}
		else if($post['role']=='service')
		{
			$this->form_validation->set_rules('email','Email ID','required|max_length[100]|valid_email|is_unique[service.email]');
			$this->form_validation->set_rules('contact','Contact Number','required|exact_length[10]|is_unique[service.contact]');
			$config['upload_path'] = './uploads/profilepic/service';
		}
		else
		{
			$this->form_validation->set_rules('email','Email ID','required|max_length[100]|valid_email|is_unique[recycler.email]');
			$this->form_validation->set_rules('contact','Contact Number','required|exact_length[10]|is_unique[recycler.contact]');
			$config['upload_path'] = './uploads/profilepic/recycler';
		}

		$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
		
		unset($post['submit']);
		$this->load->library('upload',$config);
		if($this->form_validation->run() && $this->upload->do_upload())
		{
			$this->load->model('loginmodel');
			$data = $this->upload->data();
			$image_path = base_url("uploads/profilepic/".$post['role']."/".$data['file_name']);
			$post['profile_img'] = $image_path;
			$this->_flashNredirect($this->loginmodel->add_user($post),'Accounted Created Successfully ,Try Logging In','Failed to Create Account, Please Try Again');
		}
		else
		{
			$upload_error = $this->upload->display_errors();
			$this->load->view('public/public_signup',compact('upload_error'));
		}
	}

	public function logout()
	{
		$this->load->helper('url');
		$this->session->unset_userdata('id','role');
		return redirect('login');
	}

	private function _flashNredirect($tf,$succm,$errm)
	{
		if($tf)
			{
				$this->session->set_flashdata('feedback',$succm);
				$this->session->set_flashdata('class','success');
				return redirect('login/index');
			}
		else
			{
				$this->session->set_flashdata('feedback',$errm);
				$this->session->set_flashdata('class','danger');
				return redirect('login/index');
			}
	}
}
?>