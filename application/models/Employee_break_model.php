<?php

class Employee_break_model extends CORE_Model {
    protected  $table="employee_break";
    protected  $pk_id="employee_break_id";
    protected  $fk_id="schedule_employee_id";
    function __construct() {
        parent::__construct();
    }

    function get_break() {
    	$query = $this->db->query("SELECT * FROM employee_break WHERE is_deleted=0");
        return $query->result();
    }


    function emp_breaklist($schedule_employee_id) {
        $query = $this->db->query("SELECT 
                                    employee_break.*,
                                    DATE_FORMAT(employee_break.break_out, '%H:%i:%s') AS break_out,
                                    DATE_FORMAT(employee_break.break_in, '%H:%i:%s') AS break_in,
                                    (CASE
                                        WHEN employee_break.break_out = '0000-00-00 00:00:00'
                                        THEN '0000-00-00'
                                        ELSE DATE_FORMAT(employee_break.break_out, '%m/%d/%Y')
                                    END) AS date_break_out,
                                    (CASE
                                        WHEN employee_break.break_in = '0000-00-00 00:00:00'
                                        THEN '0000-00-00'
                                        ELSE DATE_FORMAT(employee_break.break_in, '%m/%d/%Y')
                                    END) AS date_break_in
                                FROM
                                    employee_break
                                        LEFT JOIN
                                    schedule_employee ON schedule_employee.schedule_employee_id = employee_break.schedule_employee_id
                                WHERE
                                    employee_break.schedule_employee_id = ".$schedule_employee_id."
                                ORDER BY sort_key ASC");
        return $query->result();
    }

    function generate_break_report($employee_filter,$schedule_filter){
        $query = $this->db->query("SELECT * FROM employee_break WHERE employee_break_id=".$employee_break_id);
        return $query->result();
    }

    function get_employee($schedule_filter,$employee_id=null){
        $query = $this->db->query("SELECT DISTINCT(schedule_employee.employee_id),
            CONCAT(employee_list.first_name,' ',employee_list.middle_name,' ',employee_list.last_name) AS full_name
                                    FROM
                                        employee_break
                                            LEFT JOIN
                                        schedule_employee ON schedule_employee.schedule_employee_id = employee_break.schedule_employee_id
                                            LEFT JOIN
                                        employee_list ON employee_list.employee_id = schedule_employee.employee_id
                                    WHERE
                                        schedule_employee.date = '".$schedule_filter."'
                                        ".($employee_id=='all'?"":" AND employee_list.employee_id = ".$employee_id."")."
                                        ");
                                    return $query->result();
    }

    function chck_break($employee_break_id) {
        $query = $this->db->query("SELECT * FROM employee_break WHERE employee_break_id=".$employee_break_id);
        return $query->result();
    }

    function chck_sort_key($schedule_employee_id, $chck_sort_key) {
        $query = $this->db->query("SELECT * FROM employee_break WHERE sort_key=".$chck_sort_key." AND schedule_employee_id =".$schedule_employee_id);
        return $query->result();
    }

    function chck_sort_key_update($schedule_employee_id, $chck_sort_key,$employee_break_id) {
        $query = $this->db->query("SELECT * FROM employee_break WHERE sort_key=".$chck_sort_key." AND schedule_employee_id =".$schedule_employee_id." AND employee_break_id !=".$employee_break_id);
        return $query->result();
    }
    
    function get_schedule_break($schedule_employee_id){
        $query = $this->db->query("SELECT employee_break.* FROM employee_break WHERE schedule_employee_id=".$schedule_employee_id." ORDER BY sort_key ASC");
        return $query->result();
    }

    function chck_schedule_break($schedule_employee_id){
        $query = $this->db->query("SELECT COUNT(*) as count_break FROM employee_break WHERE schedule_employee_id=".$schedule_employee_id);
        return $query->result();
    }



}
?>