<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Q_and_a extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/q_and_a_model');
   }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : FAQ';
        $this->loadViews("admin/q_and_a/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'zenostrategics : Add New FAQ';
        $this->loadViews("admin/q_and_a/addnew", $this->global, NULL , NULL);
        
    } 

    // Insert Video *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('question','FAQ Title','trim|required');
        $this->form_validation->set_rules('answer','FAQ Description','trim');                     
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['question'] = $form_data['question'];
            $insertData['answer'] = $form_data['answer'];
            $insertData['link_url'] = $form_data['link_url'];
            $insertData['q_and_a_date'] = date("Y-m-d H:i:s");
            $insertData['q_and_a_status'] = '1';
           
            // Video Upload
            if(isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {

                $f_name         =$_FILES['attachment']['name'];
                $f_tmp          =$_FILES['attachment']['tmp_name'];
                $f_size         =$_FILES['attachment']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/q_and_a_attachment/".$f_newfile;
               
                if(!move_uploaded_file($f_tmp,$store))
                {
                     $this->session->set_flashdata('error', 'attachment Updation Failed Try again');
                }
                else
                {
                   $insertData['attachment'] = $f_newfile;
                }
             } 
            $result = $this->q_and_a_model->save($insertData);  
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Q&A Added successfully');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Q&A Addition failed');
            }
            redirect('admin/q_and_a/addnew');
          }  
        
    }


    // Videos list
    public function ajax_list()
    {
        $list = $this->q_and_a_model->get_datatables();
        $data = array();

        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->q_and_a_date;
            $q_and_a_at = date("m-d-Y", strtotime($temp_date));
            $attachment = $currentObj->attachment;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "<p>".$currentObj->question."</p>";
            $row[] = "<p class='text-wrap'>".$currentObj->answer."</p>";
            $row[] = (!empty($attachment))?'Avalable':'Not Avalable';
            $row[] = $q_and_a_at;
            $row[] = $currentObj->q_and_a_status==1?'Active':'InActive';
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/q_and_a/edit/'.$currentObj->id.'"><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->q_and_a_model->count_all(),
                        "recordsFiltered" => $this->q_and_a_model->count_filtered(),
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
            redirect('admin/q_and_a');
        }
        
        $data['edit_data'] = $this->q_and_a_model->find($id);
        
        
        $this->global['pageTitle'] = 'zenostrategics : Edit Q&A';
        $this->loadViews("admin/q_and_a/edit", $this->global, $data , NULL);
        
        
    } 

    // Update Video *************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('question','FAQ Title','trim|required');
        $this->form_validation->set_rules('answer','FAQ Description','trim|required');                            
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
                $this->addnew();
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['question'] = $form_data['question'];
            $insertData['answer'] = $form_data['answer'];
            $insertData['link_url'] = $form_data['link_url'];
            $insertData['q_and_a_update'] = date("Y-m-d H:i:s");
            $insertData['q_and_a_status'] = $form_data['q_and_a_status'];
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
                $store          ="uploads/q_and_a_attachment/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Q&A Updation Failed Try again');
                }
                else
                {
                   $insertData['attachment'] = $f_newfile;
                   //Old File  Delete File 
                   $old_file = "uploads/q_and_a_attachment/".$old_attachment;
                   if (file_exists($old_file)) {   
                    unlink($old_file);                       
                    }
                   
                   
                }
             } 
             $result = $this->q_and_a_model->save($insertData);

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Q&A successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Q&A Updation failed');
            }
            redirect('admin/q_and_a/edit/'.$insertData['id']);
          }  
        
    }

    // Delet Video *****************************************************************
      function delete()
    {
        $this->isLoggedIn();
        $delId = $this->input->post('id');  
        $file = $this->q_and_a_model->find($delId);
        //Unlink File
       $old_file = "uploads/q_and_a_attachment/".$file->attachment;
       if (file_exists($old_file)) {   
        unlink($old_file);                       
        }
       
        $result = $this->q_and_a_model->delete($delId);           
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    
    
}

?>