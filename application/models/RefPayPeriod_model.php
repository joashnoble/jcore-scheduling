<?php

class RefPayPeriod_model extends CORE_Model {
    protected  $table="refpayperiod";
    protected  $pk_id="pay_period_id";

    function __construct() {
        parent::__construct();
    }

    function get_pay_period($year) {
     	$query = $this->db->query('SELECT * FROM refpayperiod WHERE extract(YEAR from pay_period_start)='.$year.' AND is_deleted=0 ORDER BY pay_period_start DESC');
		return $query->result();   
    }

    function get_year_list(){
    	$query = $this->db->query("SELECT DISTINCT pay_period_year FROM refpayperiod ORDER BY pay_period_year DESC");
    	return $query->result();
    }    
    
}
?>