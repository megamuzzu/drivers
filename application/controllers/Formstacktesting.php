<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Formstacktesting extends CI_Controller
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('admin/product_model');
        $this->load->library('base_library');
        // Cookie helper
        $this->load->helper('cookie');
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {

      $authcode = $this->input->get('code');
      

      // form id : 4213004

      define('CLIENT_ID', '28868');
      define('CLIENT_SECRET', 'b276605077');
      define('REDIRECT_URL', '<?php echo base_url()?>formstacktesting'); // for testing, use the URL to this PHP file.

      define('AUTHORIZE_URL', 'https://www.formstack.com/api/v2/oauth2/authorize');
      define('TOKEN_URL', 'https://www.formstack.com/api/v2/oauth2/token');

      if (!empty($authcode)) {
          
          /** 
           * We have an authorization code. We now exchange it for an access token.
           */
          $ch = curl_init(TOKEN_URL);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
          curl_setopt($ch, CURLOPT_POST, 1); 
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
              'grant_type' => 'authorization_code',
              'client_id' => CLIENT_ID,
              'redirect_uri' => REDIRECT_URL,
              'client_secret' => CLIENT_SECRET,
              'code' => $authcode
          )));
          
          // oauth2 contains the the access_token.
          $oauth2 = json_decode(curl_exec($ch));
          if(isset($oauth2->error) && $oauth2->error=="expired_token")
          {
            header("Location: https://www.formstack.com/api/v2/oauth2/authorize?client_id=28868&redirect_uri=https%3A%2F%2Fdriverfixer.com%2Fformstacktesting&response_type=code");
            echo $oauth2->error;
          }
          
          // get form
          $ch = curl_init('https://www.formstack.com/api/v2/form/4213004.json');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Authorization: Bearer ' . $oauth2->access_token
          )); 
          $forms = json_decode(curl_exec($ch));

          print '<pre>';
          print_r($forms);
          print '</pre>';
          

      } else {
          /** 
           *  Send the user to the authorization page.
           */
          $auth_url = AUTHORIZE_URL . '?' . http_build_query(array(
              'client_id' => CLIENT_ID,
              'redirect_uri' => REDIRECT_URL,
              'response_type' => 'code'
          )); 
          
          header('Location:' . $auth_url);
          exit;
      }
      exit;



      // Client ID: 27559
      // Client Secret: 33904c0c39
      // Redirect URI: http://driverfixer.com/formstacktesting
      // Your Access Token: 5f57445843da6a9bcac5a85902163a17

      // Form => "id": "3902750", Contact form id : 3903680
      //submission id : 619673498
      // filed id : 93359560

      // API :https://www.formstack.com/api/v2/oauth2/authorize?client_id=27621&redirect_uri=https%3A%2F%2Fdriverfixer.com%2Fformstacktesting&response_type=code
      //authorization_code : 52fc87855bc7f02165ec739488efbfe2
       // Token : d763a0c5acbb6031712b7cc10dc0e88e
      //formstack Form id : 3912421
      // submission ID : 621566769 , 621570638

      // Client ID: 27621
      // Client Secret: a3e07eab44
      // Redirect URI: <?php echo base_url()?>cart/cygatePayment
      // Your Access Token: d763a0c5acbb6031712b7cc10dc0e88e

      echo "Formstack Testing..";
      $url1 = "https://www.formstack.com/api/v2/oauth2/token";
      $attr1 = array();
      $attr1['grant_type'] = 'authorization_code';
      $attr1['client_id'] = "27621";
      $attr1['redirect_uri'] = "<?php echo base_url()?>formstacktesting";
      $attr1['client_secret'] = "a3e07eab44";
      $attr1['code'] = $authcode;
      


      ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
        $payload    =   json_encode($attr1);

           //print_r($payload);
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url1);
       // Following line is compulsary to add as it is:
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);
        //convert the XML result into array
        
        $response= json_decode($data, true);
        //return $response;
        print_r($response);


        exit;  


      // Onload Comon Page Data ============================= 
    	$data = array();
            


      exit;
       // Define =========================== 
       $data["title"]="Drivers Fixer";
       $data["file"]="front/about";
       $this->load->view('front/template',$data);
    } 



    // ===================================================================
    public function form1()
    {
      $data = array();
        
        $data["title"]="Drivers Fixer";
       $data["file"]="front/formstack";
       $this->load->view('front/template', $data);
    }

}

?>