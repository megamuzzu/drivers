<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Productkeyupdate extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('productkey_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Driver Repair 24x7 : Product Key Update';
        $this->loadViews("admin/productkeyupdate/list", $this->global, NULL , NULL);
        
    }

    // Add New 
    public function addnew()
    {
		$this->isLoggedIn();
		// category
		$data = array();
        $this->global['pageTitle'] = 'Driver Repair 24x7 : Add New Product';
        $this->loadViews("admin/productkeyupdate/addnew", $this->global, $data , NULL);
        
    } 
	
	// Get Sub category
	public function get_sub_category()
    {
		//$this->isLoggedIn();
		$id = $this->input->post('id');
		
		
		// Sub category 
		$where['category_id'] = $id;
		$where['status'] = '1';
		$where['field'] = 'id,name';
		$sub_category_list = $this->sub_category_model->findDynamic($where);
		$option = '';
		foreach($sub_category_list as $k=>$v){
			$option .= '<option value="'.$v->id.'">'.$v->name.'</option>';
		}
		
		
		echo $option;//$select_box = '<select class ="form-control" name="sub_category_id" id="sub_category_id">'.$option.'</select>	';
	
		
       
        
    } 

    // Insert Member *************************************************************
    public function insertnow()
    {
        $this->isLoggedIn();
        date_default_timezone_set('Asia/Kolkata');

		$form_data  = $this->input->post();
		 
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('productKey','Product Key','trim|required');
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            // check already exist
            $where = array();
            $where['productKey'] = $form_data['productKey'];
            $returnData = $this->productkey_model->findDynamic($where);
            if(!empty($returnData)){
               $this->session->set_flashdata('error', $form_data['productKey'].' already Exist.');
            }else{
	        
                $insertData['productKey'] = $form_data['productKey'];
                $insertData['orderId'] = 0;
                $insertData['status'] = 0;
                $insertData['insertat'] = date("Y-m-d H:i:s");
                
    			$result = $this->productkey_model->save($insertData);
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Product Key successfully Added');
                }
                else
                { 
                    $this->session->set_flashdata('error', 'Product Key Addition failed');
                }
                
              }// check already  
               redirect('admin/productkeyupdate/addnew'); 
          }  
        
    }
    // Excel file insert
    public function excelinsert()
    {
        $this->isLoggedIn();
        date_default_timezone_set('Asia/Kolkata');
        
        //form data 
        $form_data  = $this->input->post();
        if(isset($_FILES['file']) && !empty($_FILES['file'])){
            $f_name         =$_FILES['file']['name'];
            $f_tmp          =$_FILES['file']['tmp_name'];
            $f_size         =$_FILES['file']['size'];
            $f_extension    =explode('.',$f_name);
            $f_extension    =strtolower(end($f_extension));
            if($f_extension != 'csv'){
              $this->session->set_flashdata('error', 'Upload Only CSV Files');
              redirect('admin/productkeyupdate/addnew');   
              exit;
            }

          $file = $_FILES['file']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
            {
              $productKey = $filesop[0];
              $where = array();
              $where['productKey'] = $productKey;
              $returnData = $this->productkey_model->findDynamic($where);
              if(empty($returnData)){
                $insertData['productKey'] = $productKey;
                $insertData['orderId'] = 0;
                $insertData['status'] = 0;
                $insertData['insertat'] = date("Y-m-d H:i:s");
                $result = $this->productkey_model->save($insertData);
              }

            $c++;
           }
        }// if condition closed.
        
        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Product Key successfully Added');
        }
        else
        { 
            $this->session->set_flashdata('error', 'Product Key Addition failed');
        }
        redirect('admin/productkeyupdate/addnew');
           
        
    }


    //  list
    public function ajax_list()
    {
        $list = $this->productkey_model->get_datatables2();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {

            $temp_date = $currentObj->dateat;
            $dateAt = date("d M Y ", strtotime($temp_date));
            //$dateAt = date("d M Y | g:i a", strtotime($temp_date));
            
            $no++;
            $row = array();
            $row[] = $currentObj->productKey;
            $row[] = $currentObj->orderId;
            $row[] = $currentObj->fname;
            $row[] = $currentObj->email;
            $row[] = $dateAt;
            $row[] = ($currentObj->status == 1)?"Assigned":"New";
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/productkeyupdate/edit/'.$currentObj->pk_id.'" Title="Edit Row" ><i class="fa fa-pencil"></i></a> ';//<a class="btn btn-sm btn-danger deletebtn" href="#" data-userid="'.$currentObj->id.'"><i class="fa fa-trash"></i></a>
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->productkey_model->count_all(),
                        "recordsFiltered" => $this->productkey_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
 
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
		if($id == null)
        {
            redirect('admin/productkeyupdate');
        }
		$data = array();
        // edit data 
        $data['edit_data'] = $this->productkey_model->find($id);
      
       
        $this->global['pageTitle'] = 'Driver Repair 24x7 : Edit ProductKey';
        $this->loadViews("admin/productkeyupdate/edit", $this->global, $data , NULL);
    } 

    // Update *************************************************************
    public function update()
    {
        date_default_timezone_set('Asia/Kolkata');
		$form_data  = $this->input->post();
		
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('id','Productkey Id Is Empty','required');
		$this->form_validation->set_rules('productKey','Product Key','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
            
            $insertData['id'] = $form_data['id'];
			$insertData['productKey'] = $form_data['productKey'];
            $insertData['updateat'] = date("Y-m-d H:i:s");
            
			$result = $this->productkey_model->save($insertData);
			

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Product Key successfully Updated');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Product Key Updation failed');
            }
            redirect('admin/Productkeyupdate/edit/'.$insertData['id']);
          }  
        
    }
	
	
    // Delete  *****************************************************************
      function delete()
    {
		
        $this->isLoggedIn();
        $delId = $this->input->post('id');  
		$db_data = $this->productkey_model->find($delId);
		//print_r($db_data);
		if(!empty($db_data))
		{
			$i = 1;
			while($i <= 3)
			{
				$image = 'image'.$i;
				$file = "uploads/product/".$db_data->$image;
				
				if(file_exists ( $file))
				{
					unlink($file);
				}
				$i++;
			}
		}
	
        $result = $this->productkey_model->delete($delId); 
			
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    
    
    
}

?>