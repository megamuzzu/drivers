<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Login extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/members_model');
     }



    /**
     * Index Page for this controller.
     */
    // Pay now =============================================================
    public function index()
    {
     
      $this->isLoggedIn();
    }
    // is login
    function isLoggedIn()
    {

        $isLoggedIn = $this->session->userdata('loginstatus');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $data["file"]="front/login";
            $this->load->view('front/template',$data);
        }
        else
        {

            redirect('/front/index_page');
        }
    }
    // Login
    public function loginMe()
    {
       
       $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

      if($this->form_validation->run() == FALSE)
        {
           $this->index();
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $where = array();
            $where['email'] = $email;
            $where['password'] = $password;
            $result = $this->members_model->findDynamic($where);
           
           
            if(count($result) > 0)
            {
                if($result[0]->member_status != 1)
                {
                    $this->session->set_flashdata('error', 'Your Account Blocked.');
                    redirect('/front/login');
                }
                else
                {
                    foreach ($result as $res)
                    {
                        $sessionArray = array('memberId'=>$res->id,                    
                                                'first_name'=>$res->first_name,
                                                'last_name'=>$res->last_name,
                                                'email'=>$res->email,
                                                'phone'=>$res->phone,
                                                'loginstatus' => TRUE
                                        );
                                        
                        $this->session->set_userdata($sessionArray);
                        
                        redirect('/frontadmin');
                    }
                }    
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                redirect('/front/login');
            }
        }
    }

    // Logout=============================================================
     function forgotPassword()
    {
        $data["file"]="front/forgotPassword";
        $this->load->view('front/template',$data);
    }

    // Reset Password
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        $this->load->library('email_service');

        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $user_email = $this->input->post('login_email');
            $where = array();
            $where['email'] = $user_email;
            $result = $this->members_model->findDynamic($where);
            if(count($result) > 0)
            {
                
                $otp = mt_rand(1000, 9999);
                $update_data['id'] = $result[0]->id;
                $update_data['otp'] = $otp;
                $update_result = $this->members_model->save($update_data);
               
                if($result[0]->member_status != 1)
                {
                    $this->session->set_flashdata('error', 'Your Account Blocked.');
                    redirect('/front/login');
                }
                else
                {
                    $data1['reset_link'] = base_url() . "front/login/resetPasswordConfirmUser/?id=" . $otp. "&email=" . $user_email;
                   
                    $data1["name"] = $result[0]->first_name."  ".$result[0]->last_name;
                    $data1["email"] = $result[0]->email;
                    $data1["message"] = "Reset Your Password";
                    $sendStatus = $this->email_service->send_forgot_password_email($data1);
                    if($sendStatus)
                    {

                        $this->session->set_flashdata('success', 'Reset Password Link sent in your email id .');
                        redirect('/front/login');
                    }    
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Email Id Not Match');
                redirect('/front/login/forgotPassword');
            }
        }    
           
    }
    // Reset Password
    // This function used to reset the password 
    function resetPasswordConfirmUser()
    {
        $otp = $this->input->get('id');
        $email = $this->input->get('email');
        $where = array();
        $where['email'] = $email;
        $where['otp'] = $otp;
        $result = $this->members_model->findDynamic($where);
        
        if(!empty($result))
        {
            $data["file"]="front/resetpassword";
            $data["otp"]=$otp;
            $this->load->view('front/template',$data);
        }
        else
        {
            $this->session->set_flashdata('error', 'Not Match Your OTP Resend Otp');
            redirect('/front/login/forgotPassword');
        }
        
    }
    // Save New Password
    function resetpassword_save()
    {
         $this->load->library('form_validation');
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

      if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else
        {
            $email = $this->input->post('email');
            $email = strtolower($email);
            $password = $this->input->post('password');
            $otp = $this->input->post('otp');
           
            
            $where = array();
            $where['email'] = $email;
            $where['otp'] = $otp;
            $result = $this->members_model->findDynamic($where);

            if(!empty($result))
            {

                $update_data['id'] = $result[0]->id;
                $update_data['password'] = $password;
                $update_data['otp'] = '';
                $update_result = $this->members_model->save($update_data);
                $this->session->set_flashdata('success', 'Successfully Password Changed');
                redirect('/front/login');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email Id Not Match');
                redirect('/front/login/forgotPassword');
            }
        }    
    }

    // Logout=============================================================
     function logout()
    {
       $this->session->sess_destroy();
       redirect("front/login");
    }

}

?>