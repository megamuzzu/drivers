<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Order_model extends Base_model
{
    public $table = "z_order";
    var $column_order = array(null, 'admin_type','name','email','phone','date','status'); //set column field database for datatable orderable
    var $column_search = array('admin_type','name','email','phone','date','status'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

        function __construct() {

            parent::__construct();
              $this->load->model('admin/product_model');

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

    }


	 
	
    public function find($id) {

            $query = $this->db->select('*')

                    ->from($this->table)

                    ->where('id', $id)

                    ->get();

            if ($query->num_rows() > 0) {

                $result = $query->result();

                return $result[0];

            } else {

                return array();

            }

        }

       // Get  List
        function get_datatables()
        {
            $this->_get_datatables_query();
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
        // Get Database 
         public function _get_datatables_query()
        {     
            $this->db->from($this->table);
            $i = 0;     
            foreach ($this->column_search as $item) // loop column 
            {
                if(isset($_POST['search']['value']) && $_POST['search']['value']) // if datatable send POST for search
                {
                    if($i===0) // first loop
                    {
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                }
                $i++;
            }
             
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        // Count  Filtered
        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
        // Count all
        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }


        public function get_order_with_template(array $arra_data)
        {
           

            /*start QUERY FOR order detial*/
            $transaction_id  = $arra_data['transaction_id'];
            $user_id        = $arra_data['user_id'];
                 


 $html_template =  get_product_template();


                $where = array();

                $where['transaction_id']= $transaction_id;
                $where['user_id']        = $user_id;
                $product_data       = $this->findDynamic($where);
                
                


                /*End QUERY FOR order detial*/

          


                $product_set_dtl ='';
              
                  
                

                if(!empty($product_data))
                {

                    $product_data = $product_data[0];
                    $product_set_dtl ='';



                     $product_set_dtl .= '
                                    <table border="0" align="center" width="100%" cellpadding="10" cellspacing="0">

                                            <tbody><tr align="left">
                                            <th style="font-size:14px;line-height:20px;color:#4d4d4d;font-family:arial,sans-serif;font-weight:700">Receipt Date <br>
                                            <span style="font-weight:400;color:#4d4d4d;font-family:arial,sans-serif;font-size:13px">'.date("M d, Y",strtotime($product_data->date_at)).'</span>
                                            </th>

                                            <th style="font-size:14px;line-height:20px;color:#4d4d4d;font-family:arial,sans-serif;font-weight:700;float:right;text-align:right;padding-right:14px">Receipt Number<br>
                                            <span style="font-weight:400;color:#4d4d4d;font-family:arial,sans-serif;font-size:13px;text-align:right">#'. $product_data->order_number.' </span>
                                            </th> 
                                            </tr>

                  </tbody></table><table border="0" align="center" width="100%" cellpadding="10" cellspacing="0">
                                       <tbody>
                                          <tr align="center">
                                             <th>
                                                <h5 style="font-weight:700;margin: 0px;color:#4d4d4d;font-family:arial,sans-serif;font-size:15px;">Summary</h5>
                                             </th>
                                          </tr>
                                       </tbody>
                                    </table>';
                     $product_set_dtl .= '<table style="width:100%;margin-bottom: 20px;padding: 10px;" border="0">';

                     $productarray = json_decode($product_data->products,true);
                 
                  
                    if(!empty($productarray))
                 { 

                     $product = $productarray['id'];

                    $product_qty = $productarray['qty'];
                    $product_price = $productarray['price'];


                    $product_set_dtl .='<tr>
                    <td style="text-align:center;"><strong >Product&nbsp;Image</strong></td>
                    <td style="text-align:center; "><strong>Name</strong>
                      
                    </td>
                    <td style="text-align:center;" >  
                      <strong >Qty</strong>
                    </td>
                    <td style="text-align:center;" >  
                      <strong >Price</strong>
                    </td>
                </tr>';

                   /* $product_set = json_decode($product_data[0]->dataset);*/

                   $inc = 0;
                    foreach ($product as $key => $v)
                    {



                                $product = $this->product_model->find( $v );



                        if(isset($product->image1) && !empty($product->image1))
                        {
                            $image_html = '<img  style="height:40px;width:40px;""  class="mt-4 mb-4" style="width:100px;" src="'.base_url('uploads/product/').$product->image1.'">';
                        } else{
                            $image_html  = '';
                        }


                           $product_set_dtl .='<tr>
                    <td>
                         '.$image_html .'</td>
                    <td style=" text-align: left;width:400px"><p style="font-size:13px;line-height:20px;">'.base64_decode($product->name).'</p></td> 
                    <td style="width: 200px; ">
                    <center ><strong >'.$product_qty[$inc].' </strong></center><br>
                      
                    </td><td style="width: 200px;text-align: center;">
                    <center ><strong > '. $product_qty[$inc]*$product_price[$inc] .' </strong></center><br>
                      
                    </td>
                </tr>
            ';

             $inc++;
                    }
                     
                 }   
                   $product_set_dtl .='
                   <tr><td colspan="100"></td></tr>
                   <tr><td colspan="100"></td></tr>
                   <tr><td colspan="100"></td></tr>
                   <tr><td colspan="100"></td></tr>
                   <tr width="85%" align="left">
                                            <th style="font-family:arial,sans-serif;font-weight:900;font-size:12px;padding-left:7%"><p>Total</p></th>
                                            <th > </th>
                                            <th > </th>
                                            <th align="right" style="font-family:arial,sans-serif;font-weight:900;font-size:13px;padding-right:7%"><p>$ '.$product_data->amount.'</p></th>
                                        </tr>';



                  /*start address detial*/
             
 



                         $product_set_dtl .= '</table>';
                
           
                /*end address detial*/

           
            $subject = 'Order Booking';
            $message = 'Product Booking Are Below';
            $message_mail_type = 'Product Booking Are Below';

            $names =  $product_data->firstname;
             $html_template = str_replace("##product_dtl##",$product_set_dtl,$html_template);
              $html_template = str_replace("##site_logo##",base_url().'assets/images/email-template.png',$html_template);
            $html_template = str_replace("##site_url##",base_url(),$html_template);

                }

                
                 
                 

            

            return $html_template;
          
        }

}