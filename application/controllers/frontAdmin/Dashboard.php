<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/FrontBaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Dashboard extends FrontBaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/members_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        // webinar Link
        $where = array();
        $where['table'] = 'zs_webinar_link';
        $data['webinar_link'] = $this->members_model->findDynamic($where);
        
        

        // Last Charge 
        $where = array();
        $where['table'] = 'zs_stripe_charge';
        $where['member_id'] = $this->member_id;
        $where['field'] = 'amount';
        $where['orderby'] = '-id';
        $where['limit']  = '1';
        $data['detail_charge'] = $this->members_model->findDynamic($where);
        $data['detail_charge'] = (empty($data['detail_charge']))?'':$data['detail_charge'][0];

       // Subscription Date to expire
        $where = array();
        $where['table'] = 'zs_stripe_subscription';
        $where['member_id'] = $this->member_id;
        $temp_subscription_detail = $this->members_model->findDynamic($where);
        $temp_subscription_detail = (empty($temp_subscription_detail))?'':$temp_subscription_detail[0];
       
        if(!empty($temp_subscription_detail))
        {
            $where = array();
            $where['table'] = 'zs_stripe_all_subscription';
            $where['customer_id'] = $temp_subscription_detail->customer_stripe_id;
            $where['orderby'] = '-id';
            $data['detail_membership'] = $this->members_model->findDynamic($where);
           
           if(!empty($data['detail_membership']))
           {
             $data['subscription_status'] = $temp_subscription_detail->status;   
             $temp_count = count($data['detail_membership']);
             if($temp_count > 1)
             {
                $temp_date = $data['detail_membership'][0]->subscription_current_period_start;
               $data['subscription_start'] = ($temp_date != '0000-00-00 00:00:00')?date("d-m-Y H:i", strtotime($temp_date)):'Unable to finded';
                $temp_date = $data['detail_membership'][$temp_count-1]->subscription_current_period_end;
                $data['subscription_end'] = ($temp_date != '0000-00-00 00:00:00')?date("d-m-Y H:i", strtotime($temp_date)):'';

                // Last 5 updates 
                $i = 0;
                while($i <= 4)
                {
                    if(isset($data['detail_membership'][$i]))
                    {
                        $data['updates_list'][$i] = $data['detail_membership'][$i]; 
                    }
                    $i++;
                }
             }
            }


        }// Subcription not empaty 

       
        // Membership type (Plan)
        if(!empty($temp_subscription_detail))
        {
            $where = array();
            $where['table'] = 'zs_stripe_plan'; 
            $where['plan_id'] = $temp_subscription_detail->plan_id ; 
            $where['field'] = 'nickname'; 
            $db_data = $this->members_model->findDynamic($where);
            $data['member_type'] = (empty($db_data))?'':$db_data[0]->nickname;
            
        }
        else
        {
            $data['subscription'] = '';
        }

        $this->global['pageTitle'] = 'zenostrategics : Dashboard';
        
        $this->loadViews("frontadmin/dashboard", $this->global, $data , NULL);
    }
    
   
   

    // Load CHange password page  =======================================
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'zenostrategics : Change Password';
        
        $this->loadViews("frontAdmin/changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
       
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            $where = array();
            $where['email'] = $this->email;
            $where['password'] = $oldPassword;
            $where['field'] = 'id,password';
            $db_data = $this->members_model->findDynamic($where); 
            
            if(!empty($db_data))
            {
                if($db_data[0]->password == $oldPassword) 
                {
                    $update['id'] = $db_data[0]->id;
                    $update['password'] = $newPassword;
                    $update['member_update'] = date('Y-m-d H:i:s');
                    $result = $this->members_model->save($update);
                    
                    $this->session->set_flashdata('success', 'Password Successfully Updated.');
                    redirect('frontadmin/dashboard/loadChangePass'); 
                }

            }
            else
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('frontadmin/dashboard/loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'zenostrategics : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>