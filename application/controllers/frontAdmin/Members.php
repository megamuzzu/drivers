<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Members extends BaseController
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
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Zeno Strategics : Members';
        $this->loadViews("admin/members/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Zeno Strategics : Add New Members';
        $this->loadViews("admin/Members/addnew", $this->global, NULL , NULL);
        
    } 

    // Insert Video *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('first_name','First Name','trim|required');
        $this->form_validation->set_rules('last_name','Last Name','trim');
        $this->form_validation->set_rules('phone','Phone Number','trim');
        $this->form_validation->set_rules('email','Email Address','trim|required');
        $this->form_validation->set_rules('address','Address','trim');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['first_name'] = $form_data['first_name'];
            $insertData['last_name'] = $form_data['last_name'];
            $insertData['email'] = $form_data['email'];
            $insertData['phone'] = $form_data['phone'];
            $insertData['address'] = $form_data['address'];
            $insertData['password'] = $form_data['password'];
            $insertData['member_at'] = date("Y-m-d H:i:s");
            $insertData['member_status'] = '1';

            $result = $this->members_model->save($insertData);
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Member successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Member Addition failed');
            }
            redirect('admin/members/addnew');
          }  
        
    }


    // Videos list
    public function ajax_list()
    {
        $list = $this->members_model->get_datatables();
       
        $data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {

            $temp_date = $currentObj->member_at;
            $member_at = date("m-d-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->first_name." ".$currentObj->last_name;
            $row[] = $currentObj->email;
            $row[] = $currentObj->phone;
            $row[] = $currentObj->country;
            $row[] = $member_at;
            $row[] = $currentObj->member_status==1?'Active':'InActive';
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/members/edit/'.$currentObj->id.'"><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->members_model->count_all(),
                        "recordsFiltered" => $this->members_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
    // Add New 
    public function edit($id = NULL)
    {
        
        //exit;
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/members');
        }

        $where = array();
        $where['table'] = 'zs_country';
        $where['status'] = '1';
        $where['field'] = 'id,name';
        $find_data = $this->members_model->findDynamic($where);
        foreach($find_data as $k=>$v)
        {
            $data['country_list'][$v->id] = $v->name; 
        }
       
        $data['edit_data'] = $this->members_model->find($id);
        $this->global['pageTitle'] = 'Zeno Strategics : Edit Members';
        $this->loadViews("admin/members/edit", $this->global, $data , NULL);
        
        
    } 

    // Update Members *************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('first_name','First Name','trim|required');
        $this->form_validation->set_rules('last_name','Last Name','trim');
        $this->form_validation->set_rules('phone','Phone Number','trim');
        $this->form_validation->set_rules('email','Email Address','trim|required');
        $this->form_validation->set_rules('country_id','Country Select','trim');
        $this->form_validation->set_rules('password','Password','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->edit($form_data['id']);
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['first_name'] = $form_data['first_name'];
            $insertData['last_name'] = $form_data['last_name'];
            $insertData['email'] = $form_data['email'];
            $insertData['phone'] = $form_data['phone'];
            $insertData['country_id'] = $form_data['country_id'];
            $insertData['password'] = $form_data['password'];
            $insertData['member_update'] = date("Y-m-d H:i:s");
            $insertData['member_status'] = $form_data['member_status'];

            $result = $this->members_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Members successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Members Updation failed');
            }
            redirect('admin/members/edit/'.$insertData['id']);
          }  
        
    }

    // Delet Video *****************************************************************
      function delete()
    {
        $this->isLoggedIn();
        $delId = $this->input->post('id');  
        $result = $this->members_model->delete($delId);           
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    
}

?>