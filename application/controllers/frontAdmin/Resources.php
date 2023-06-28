<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/FrontBaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Resources extends FrontBaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/video_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $data   = array();
        $where  = array();   
        $where['video_status'] = '1';
        $data['videos_list'] = $this->video_model->findDynamic($where);
        
        $this->global['pageTitle'] = 'zenostrategics : Resources';
        $this->loadViews("frontadmin/resources", $this->global, $data , NULL);
    }

}

?>