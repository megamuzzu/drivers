<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Services extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/services_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : Services';
        $this->loadViews("admin/services/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : Add New Services';
        $this->loadViews("admin/services/addnew", $this->global, NULL , NULL);
        
    } 

    // Insert Video *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('service_name','Service Name','trim|required');
        $this->form_validation->set_rules('service_price','Service Price','trim|required');
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['service_name']     = $form_data['service_name'];
            $insertData['service_price']    = $form_data['service_price'];
            $insertData['service_status']   = $form_data['service_status'];
            $insertData['service_at']       = date("Y-m-d");
            
            // Save in data base
            $result = $this->services_model->save($insertData);  
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Service Added successfully');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Service Addition failed');
            }
            redirect('admin/services/addnew');
          }  
        
    }


    // Videos list
    public function ajax_list()
    {
        $list = $this->services_model->get_datatables();
       
        $data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->service_at;
            $service_at = date("m-d-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->service_name;
            $row[] = $currentObj->service_price;
            $row[] = $service_at;
            $row[] = $currentObj->service_status==1?'Active':'InActive';
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/services/edit/'.$currentObj->id.'"><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->services_model->count_all(),
                        "recordsFiltered" => $this->services_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit *************************************************************
    // Add New 
    public function edit($id = NULL)
    {
        
        //exit;
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/services');
        }
        
        $data['edit_data'] = $this->services_model->find($id);
        
        
        $this->global['pageTitle'] = 'zenostrategics : Edit Service';
        $this->loadViews("admin/services/edit", $this->global, $data , NULL);
        
        
    } 

    // Update  *************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
         $this->form_validation->set_rules('service_name','Service Name','trim|required');
        $this->form_validation->set_rules('service_price','Service Price','trim|required');                     
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['service_name']     = $form_data['service_name'];
            $insertData['service_price']    = $form_data['service_price'];
            $insertData['service_status']   = $form_data['service_status'];
            $insertData['service_update']       = date("Y-m-d");

            $result = $this->services_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Service successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Service Updation failed');
            }
            redirect('admin/services/edit/'.$insertData['id']);
          }  
        
    }

    // Delet Video *****************************************************************
      function delete()
    {
        $this->isLoggedIn();
        $userId = $this->input->post('id');  
        $result = $this->services_model->delete($userId);           
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    
}

?>