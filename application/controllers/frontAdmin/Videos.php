<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Videos extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/video_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Zeno Strategics : Videos';
        $this->loadViews("admin/videos/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Zeno Strategics : Add New Videos';
        $this->loadViews("admin/videos/addnew", $this->global, NULL , NULL);
        
    } 

    // Insert Video *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('video_title','Video Title','trim|required');
        $this->form_validation->set_rules('video_description','Video Description','trim');                     
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['video_title'] = $form_data['video_title'];
            $insertData['video_description'] = $form_data['video_description'];
            $insertData['video_at'] = date("Y-m-d H:i:s");
            $insertData['video_status'] = '1';
            // Video Upload
            if(isset($_FILES['video_file']['name']) && $_FILES['video_file']['name'] != '') {

                $f_name         =$_FILES['video_file']['name'];
                $f_tmp          =$_FILES['video_file']['tmp_name'];
                $f_size         =$_FILES['video_file']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/videos/".$f_newfile;
               
                if(!move_uploaded_file($f_tmp,$store))
                {
                     $this->session->set_flashdata('error', 'Video Updation Failed Try again');
                }
                else
                {
                   $insertData['video_file'] = $f_newfile;
                   $result = $this->video_model->save($insertData);
                }
             }   
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Video Added successfully');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Video Addition failed');
            }
            redirect('admin/videos/addnew');
          }  
        
    }


    // Videos list
    public function ajax_list()
    {
        $list = $this->video_model->get_datatables();
        $data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->video_at;
            $video_at = date("m-d-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->video_title;
            $row[] = $currentObj->video_description;
            //$row[] = $currentObj->video_file;
            $row[] = $video_at;
            $row[] = $currentObj->video_status==1?'Active':'InActive';
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/videos/edit/'.$currentObj->id.'"><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->video_model->count_all(),
                        "recordsFiltered" => $this->video_model->count_filtered(),
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
            redirect('admin/videos');
        }
        
        $data['video'] = $this->video_model->find($id);
        
        
        $this->global['pageTitle'] = 'Zeno Strategics : Edit Videos';
        $this->loadViews("admin/videos/edit", $this->global, $data , NULL);
    } 

    // Update Video *************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('video_title','Video Title','trim|required');
        $this->form_validation->set_rules('video_description','Video Description','trim');                     
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['video_title'] = $form_data['video_title'];
            $insertData['video_description'] = $form_data['video_description'];
            $insertData['video_update'] = date("Y-m-d H:i:s");
            $insertData['video_status'] = $form_data['video_status'];
            $old_video_file  =  $form_data['old_video_file'];

            // Video Upload
            if(isset($_FILES['video_file']['name']) && $_FILES['video_file']['name'] != '') {
                
                //
                $f_name         =$_FILES['video_file']['name'];
                $f_tmp          =$_FILES['video_file']['tmp_name'];
                $f_size         =$_FILES['video_file']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/videos/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Video Updation Failed Try again');
                }
                else
                {
                   $insertData['video_file'] = $f_newfile;
                   //Old File  Delete File 
                   $old_file = "uploads/videos/".$old_video_file;
                   if (file_exists($old_file)) {   
                    unlink($old_file);                       
                    }
                   
                   
                }
             } 
             $result = $this->video_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Video successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Video Updation failed');
            }
            redirect('admin/videos/edit/'.$insertData['id']);
          }  
        
    }

    // Delet Video *****************************************************************
      function delete()
    {
        $this->isLoggedIn();
        $userId = $this->input->post('id');  
        $video = $this->video_model->find($userId);
        //Unlink File
       $old_file = "uploads/videos/".$video->video_file;
       if (file_exists($old_file)) {   
        unlink($old_file);                       
        }
       
        $result = $this->video_model->delete($userId);           
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    
}

?>