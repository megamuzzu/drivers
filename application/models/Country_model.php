<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Country_model extends Base_model
{
    public $table = "country";
    var $column_order = array(null, 'name','code'); //set column field database for datatable orderable
    var $column_search = array('name','code'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

        function __construct() {

            parent::__construct();

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

    }


	// Login
	function loginMe($email, $password)
    {
		
        //$this->db->select('*');
        $this->db->from($this->table);
        //$this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('email', $email);
        $this->db->where('password',$password);
        $query = $this->db->get();
        $user = $query->result();
        if(!empty($user)){
			return $user;
		}	
          else {
            return array();
        }
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





        // ###########################################################
        // array define for states
        // ###########################################################
        public function states(){
            $statesList = array();
            $statesList['usa'][] = "Alabama";
            $statesList['usa'][] = "Alaska";
            $statesList['usa'][] = "American Samoa";
            $statesList['usa'][] = "Arizona";
            $statesList['usa'][] = "Arkansas";
            $statesList['usa'][] = "California";
            $statesList['usa'][] = "Colorado";
            $statesList['usa'][] = "Connecticut";
            $statesList['usa'][] = "Delaware";
            $statesList['usa'][] = "District of Columbia";
            $statesList['usa'][] = "Federated States of Micronesia";
            $statesList['usa'][] = "Florida";
            $statesList['usa'][] = "Georgia";
            $statesList['usa'][] = "Guam";
            $statesList['usa'][] = "Hawaii";
            $statesList['usa'][] = "Idaho";
            $statesList['usa'][] = "Illinois";
            $statesList['usa'][] = "Indiana";
            $statesList['usa'][] = "Iowa";
            $statesList['usa'][] = "Kansas";
            $statesList['usa'][] = "Kentucky";
            $statesList['usa'][] = "Louisiana";
            $statesList['usa'][] = "Maine";
            $statesList['usa'][] = "Marshall Islands";
            $statesList['usa'][] = "Maryland";
            $statesList['usa'][] = "Massachusetts";
            $statesList['usa'][] = "Michigan";
            $statesList['usa'][] = "Minnesota";
            $statesList['usa'][] = "Mississippi";
            $statesList['usa'][] = "Missouri";
            $statesList['usa'][] = "Montana";
            $statesList['usa'][] = "Nebraska";
            $statesList['usa'][] = "Nevada";
            $statesList['usa'][] = "New Hampshire";
            $statesList['usa'][] = "New Jersey";
            $statesList['usa'][] = "New Mexico";
            $statesList['usa'][] = "New York";
            $statesList['usa'][] = "North Carolina";
            $statesList['usa'][] = "North Dakota";
            $statesList['usa'][] = "Northern Mariana Islands";
            $statesList['usa'][] = "Ohio";
            $statesList['usa'][] = "Oklahoma";
            $statesList['usa'][] = "Oregon";
            $statesList['usa'][] = "Palau";
            $statesList['usa'][] = "Pennsylvania";
            $statesList['usa'][] = "Puerto Rico";
            $statesList['usa'][] = "Rhode Island";
            $statesList['usa'][] = "South Carolina";
            $statesList['usa'][] = "South Dakota";
            $statesList['usa'][] = "Tennessee";
            $statesList['usa'][] = "Texas";
            $statesList['usa'][] = "Utah";
            $statesList['usa'][] = "Vermont";
            $statesList['usa'][] = "Virgin Islands";
            $statesList['usa'][] = "Virginia";
            $statesList['usa'][] = "Washington";
            $statesList['usa'][] = "West Virginia";
            $statesList['usa'][] = "Wisconsin";
            $statesList['usa'][] = "Wyoming";
            return $statesList;
        }

}