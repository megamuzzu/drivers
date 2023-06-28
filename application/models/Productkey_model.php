<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Productkey_model extends Base_model
{
    public $table = "productkey";
    var $column_order = array(null,'pk. productKey','pk.orderId','u.fname','odr.email','pk.status'); //set column field database for datatable orderable
    var $column_search = array('pk. productKey','u.fname','u.lname'); //set column field database for datatable searchable 
    var $order = array('id' => 'ASC'); // default order

        

        function __construct() {

            parent::__construct();

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
        function get_datatables2($where = NULL)
        {
            $sql = "SELECT pk.*,pk.id as pk_id, odr.*, u.*  FROM productkey as pk LEFT JOIN  z_order as odr  ON pk.orderId = odr.id";
            $sql .=" LEFT JOIN   z_users as u  ON odr.user_id = u.id";
            if(!empty($where)){
                foreach ($where as $key => $value) {
                    $where = " ( pk.".$key." = '".$value."' )";
               }
            }  
            $sql .= ($where)?" WHERE ". $where:'';

            $sql = $this->_get_datatables_query2($sql); 
            
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $sql .= " LIMIT ".$_POST['start'].", ".$_POST['length'];
            
            
            //echo $sql;exit;
              

            $query = $this->db->query($sql);
            //echo $this->db->last_query();exit;
            $dataa = $query->result();
            //print_r($dataa);exit;
            return $query->result();
            
        }

        // Get Database 
         public function _get_datatables_query2($sql)
        {     
            
            $i = 0;     
            foreach ($this->column_search as $item) // loop column 
            {

                if(isset($_POST['search']['value']) && $_POST['search']['value']) // if datatable send POST for search
                {
                    if($i===0) // first loop
                    {
                        $whereis = " (`".$item."` LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
                    }
                    else
                    {
                        $whereis .= " OR `".$item."` LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
                    }

                }
                $i++;
            }

            // if isset $_POST['search']['value']
            if(isset($whereis)){

                $sql .=  (strpos($sql, 'WHERE') !== false)?" AND". $whereis.")":" WHERE". $whereis.") ";
            }else{
                //$sql .= "  GROUP BY pk.id"; 
            }
            //echo $_POST['filterData'];exit;
            $filterdata = (isset($_POST['filterData']))?json_decode($_POST['filterData']):'';
            
             
            if(isset($_POST['order'])) // here order processing
            {   

                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                $sql .= " ORDER BY ".$this->column_order[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $sql .= " ORDER BY pk.".key($order)." ".$order[key($order)];
            }
            return $sql;
        }


        // Get  List
        function get_datatables($where = NULL)
        {
            // $sql = "SELECT * FROM `productkey` WHERE `client_id` = '36' ";
            // $query = $this->db->query($sql);
            // $datais =   $query->result();
            // print_r($datais);exit;

            if(!empty($where)){
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
               }
            }
            $this->_get_datatables_query();
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
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
                        //$this->db->like($item, $_POST['search']['value']);
                        $whereis = " (`".$item."` LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
                    }
                    else
                    {
                        //$this->db->or_like($item, $_POST['search']['value']);
                        $whereis .= " OR `".$item."` LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
                    }

                }
                $i++;
            }

            // if isset $_POST['search']['value']
            if(isset($whereis)){
                $this->db->where($whereis.") " );
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
        function count_filtered($where =NULL)
        {
           $sql = "SELECT COUNT(*) as total  FROM productkey as pk LEFT JOIN  z_order as odr  ON pk.orderId = odr.id";
            $sql .=" LEFT JOIN  z_users as u  ON odr.user_id = u.id";
            if(!empty($where)){
                foreach ($where as $key => $value) {
                    $where = " ( pk.".$key." = '".$value."' )";
               }
            }  
            $sql .= ($where)?" WHERE ". $where:'';
            $sql = $this->_get_datatables_query2($sql); 
            $query = $this->db->query($sql);
            $returnData  = $query->result();
            //pre($returnData);exit;
            return  (isset($returnData[0]))?$returnData[0]->total:0;
        }
        // Count  Filtered
        function count_filtered1()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
        // Count all
        public function count_all($where=NULL)
        {
            $sql = "SELECT COUNT(*) as total  FROM productkey as pk LEFT JOIN  z_order as odr  ON pk.orderId = odr.id";
            $sql .=" LEFT JOIN  z_users as u  ON odr.user_id = u.id";
            if(!empty($where)){
                foreach ($where as $key => $value) {
                    $where = " ( pk.".$key." = '".$value."' )";
               }
            }  
            $sql .= ($where)?" WHERE ". $where:'';
            $sql = $this->_get_datatables_query2($sql); 
            $query = $this->db->query($sql);
            $returnData  = $query->result();
            //pre($returnData);exit;
            return  (isset($returnData[0]))?$returnData[0]->total:0;

            
        }
      

}





  