<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Registration extends CI_Controller
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
    // Index =============================================================
    public function index()
    {
        
        $data = array();
        $where = array();
        $where['table'] = 'zs_country';
        $where['status'] = '1';
        $where['field'] = 'id,name';
        $find_data = $this->members_model->findDynamic($where);
        foreach($find_data as $k=>$v)
        {
            $data['country_list'][$v->id] = $v->name; 
        }

     
      $data["file"]="front/registration";
      $this->load->view('front/template',$data);
    }
    // check Email id =============================================================
    public function check_email()
    {
        $email = $this->input->get('email');
        $where = array();
        $where['email'] = $email;
        $where['field'] = 'id,first_name';
        $return_data = $this->members_model->findDynamic($where) ;
        
        if(empty($return_data))
         echo 1;
      else 
        echo 0;
      exit;
    }
    // Insert Data *************************************************************
    public function insertnow()
    {
        $this->load->library('email_service');
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('user_type','Mr/Mrs/Miss','trim|required');
        $this->form_validation->set_rules('first_name','First Name','trim|required');
        $this->form_validation->set_rules('last_name','Last Name','trim|required');
        $this->form_validation->set_rules('email','Email ','trim|required');
        $this->form_validation->set_rules('phone','Phone','trim|required');
        $this->form_validation->set_rules('country_id','Select County','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
           
            $insertData['user_type'] = $form_data['user_type'];
            $insertData['first_name'] = $form_data['first_name'];
            $insertData['last_name'] = $form_data['last_name'];
            $insertData['email'] = strtolower($form_data['email']);
            $insertData['phone'] = $form_data['phone'];
            $insertData['country_id'] = $form_data['country_id'];
            $insertData['password'] = $form_data['password'];
            $insertData['member_at'] = date("Y-m-d H:i:s");
            $insertData['member_status'] = '1';

            
            $result = $this->members_model->save($insertData);
            if($result > 0)
            {
                $insert_id = $this->db->insert_id();

                // Mail Send Cutomer
                $sendStatus = $this->email_service->send_register_cutomer_email($insertData);
                // Send Mail Admin 
                $insertData['admin_email'] = $this->config->item('admin_email_id');
                $sendStatus = $this->email_service->send_register_admin_email($insertData);
                // Redirect with message
                $this->session->set_flashdata('success', 'Registration successfull.');
                redirect('front/select_service/'.$insert_id);  
                exit; 
            }
            else
            { 
                $this->session->set_flashdata('error', 'Registration failed');
            }
            
            redirect('front/registration');
          }  
        
    }

}

?>