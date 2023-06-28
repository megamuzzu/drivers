<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Get_start extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/get_start_model');
   }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : Get Sart';
        $this->loadViews("admin/get_start/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : Add New Documnet';
        $this->loadViews("admin/get_start/addnew", $this->global, NULL , NULL);
        
    } 

    // Insert Video *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('link_url','Link Url','trim|required');
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['title'] = $form_data['title'];
            $insertData['link_url'] = $form_data['link_url'];
            $insertData['get_start_date'] = date("Y-m-d H:i:s");
            $insertData['get_start_status'] = '1';
           
            // Video Upload
            if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {

                $f_name         =$_FILES['attachment']['name'];
                $f_tmp          =$_FILES['attachment']['tmp_name'];
                $f_size         =$_FILES['attachment']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/get_start_attachment/".$f_newfile;
               
                if(!move_uploaded_file($f_tmp,$store))
                {
                     $this->session->set_flashdata('error', 'attachment Updation Failed Try again');
                }
                else
                {
                   $insertData['attachment'] = $f_newfile;
                }
             } 
            $result = $this->get_start_model->save($insertData);  
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Get Start Documnet Added successfully');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Get Start Documnet Addition failed');
            }
            redirect('admin/get_start/addnew');
          }  
        
    }


    // Videos list
    public function ajax_list()
    {
        $list = $this->get_start_model->get_datatables();
        $data = array();

        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->get_start_date;
            $get_start_at = date("m-d-Y", strtotime($temp_date));
            $attachment = $currentObj->attachment;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<p>".$currentObj->title."</p>";
            $row[] = (!empty($attachment))?'Avalable':'Not Avalable';
            $row[] = $get_start_at;
            $row[] = $currentObj->get_start_status==1?'Active':'InActive';
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/get_start/edit/'.$currentObj->id.'"><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->get_start_model->count_all(),
                        "recordsFiltered" => $this->get_start_model->count_filtered(),
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
            redirect('admin/get_start');
        }
        
        $data['edit_data'] = $this->get_start_model->find($id);
        
        
        $this->global['pageTitle'] = 'zenostrategics : Edit Get Start Documnet';
        $this->loadViews("admin/get_start/edit", $this->global, $data , NULL);
        
        
    } 

    // Update Video *************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('link_url','Link Url','trim|required');                            
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['title'] = $form_data['title'];
            $insertData['link_url'] = $form_data['link_url'];
            $insertData['get_start_update'] = date("Y-m-d H:i:s");
            $insertData['get_start_status'] = $form_data['get_start_status'];
            $old_attachment  =  $form_data['old_attachment'];

            // Video Upload
            if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
                
                //
                $f_name         =$_FILES['attachment']['name'];
                $f_tmp          =$_FILES['attachment']['tmp_name'];
                $f_size         =$_FILES['attachment']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/get_start_attachment/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Q&A Updation Failed Try again');
                }
                else
                {
                   $insertData['attachment'] = $f_newfile;
                   //Old File  Delete File 
                   $old_file = "uploads/get_start_attachment/".$old_attachment;
                   if (file_exists($old_file)) {   
                    unlink($old_file);                       
                    }
                   
                   
                }
             } 
             $result = $this->get_start_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Updation failed');
            }
            redirect('admin/get_start/edit/'.$insertData['id']);
          }  
        
    }

    // Delet Video *****************************************************************
      function delete()
    {
        $this->isLoggedIn();
        $delId = $this->input->post('id');  
        $file = $this->get_start_model->find($delId);
        //Unlink File
       $old_file = "uploads/get_start_attachment/".$file->attachment;
       if (file_exists($old_file)) {   
        unlink($old_file);                       
        }
       
        $result = $this->get_start_model->delete($delId);           
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    
}

?>