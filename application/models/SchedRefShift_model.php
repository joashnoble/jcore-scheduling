<?php

class SchedRefShift_model extends CORE_Model {
    protected  $table="sched_refshift";
    protected  $pk_id="sched_refshift_id";
    protected  $tabletocheck="schedule_employee";

    function __construct() {
        parent::__construct();
    }

    function getshift() {
    	$query = $this->db->query("SELECT * FROM sched_refshift WHERE is_deleted=0");
        return $query->result();
    }


}
?>