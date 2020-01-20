<?php

class Sched_shift_break_model extends CORE_Model {
    protected  $table="sched_shift_break";
    protected  $pk_id="sched_shift_break_id";
    protected  $fk_id="sched_refshift_id";

    function __construct() {
        parent::__construct();
    }


    function get_break_list($sched_refshift_id){
    	$query = $this->db->query("SELECT * FROM sched_shift_break WHERE sched_refshift_id =".$sched_refshift_id);
        return $query->result();
    }
}
?>