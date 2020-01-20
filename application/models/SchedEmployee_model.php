<?php

class SchedEmployee_model extends CORE_Model {
    protected  $table="schedule_employee";
    protected  $pk_id="schedule_employee_id";

    function __construct() {
        parent::__construct();
    }

    function ifschedoverlapscreate($employee_id,$pay_period_id,$sched_refshift_id) {
        $query = $this->db->query("SELECT schedule_employee.schedule_employee_id,schedule_employee.sched_refshift_id,schedule_employee.time_in,schedule_employee.time_out,
                                   CONCAT(employee_list.first_name,' ',middle_name,' ',employee_list.last_name) as full_name
                                   FROM schedule_employee
                                   LEFT JOIN employee_list
                                   ON schedule_employee.employee_id=employee_list.employee_id
                                    WHERE schedule_employee.employee_id='".$employee_id."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0 AND sched_refshift_id=".$sched_refshift_id."");

                                return $query->result();

    }

    function get_reg_hol_sched($employee_id,$pay_period_id){
        $query = $this->db->query("SELECT 
                        (CASE
                            WHEN clock_in != '' AND clock_out != '' THEN 1
                            ELSE 0
                        END) AS count_reg_hol,
                        date
                    FROM
                        schedule_employee
                    WHERE
                        schedule_employee.pay_period_id = ".$pay_period_id."
                            AND schedule_employee.employee_id = ".$employee_id."
                            AND ref_day_type_id = 3");
                              return $query->result();
    }

    function get_actual_sched_list($employee_id,$start_date,$end_date,$stat,$pay_period_id=null){
            $query = $this->db->query("SELECT 
                    schedule_employee.*,
                    sched_refpay.schedpay,
                    sched_refshift.shift,
                    CONCAT(employee_list.first_name,
                            ' ',
                            employee_list.middle_name,
                            ' ',
                            employee_list.last_name) AS full_name,
                    employee_list.ecode,
                    COALESCE(TIMESTAMPDIFF(MINUTE,
                                DATE_ADD(schedule_employee.time_in, INTERVAL schedule_employee.grace_period minute)
                                ,schedule_employee.clock_in)) AS perlate,
                    IF(schedule_employee.is_day_off = 1,
                        'Day Off',
                        ref_day_type.daytype) AS daytype
                FROM
                    schedule_employee
                        LEFT JOIN
                    sched_refpay ON sched_refpay.sched_refpay_id = schedule_employee.sched_refpay_id
                        LEFT JOIN
                    sched_refshift ON sched_refshift.sched_refshift_id = schedule_employee.sched_refshift_id
                        LEFT JOIN
                    employee_list ON employee_list.employee_id = schedule_employee.employee_id
                        LEFT JOIN
                    ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id
                WHERE
                    schedule_employee.is_deleted = 0
                        AND schedule_employee.employee_id = $employee_id
                        ".($stat==2?" AND schedule_employee.date BETWEEN '".$start_date."' AND '".$end_date."'":" AND schedule_employee.pay_period_id='".$pay_period_id."'")."
                ORDER BY schedule_employee.date ASC");
                              return $query->result();    
    }

    // AND schedule_employee.pay_period_id = $pay_period_id

    function get_emp_sched_report_list($employee_id,$start_date,$end_date,$stat=null,$pay_period_id=null){
            $query = $this->db->query("SELECT 
                        schedule_employee.*,
                        sched_refpay.schedpay,
                        sched_refshift.shift,
                        CONCAT(employee_list.first_name,
                                ' ',
                                employee_list.middle_name,
                                ' ',
                                employee_list.last_name) AS full_name,
                        employee_list.ecode,
                        IF(schedule_employee.is_day_off = 1,
                            'Day Off',
                            ref_day_type.daytype) AS daytype,
                        CASE
                            WHEN
                                (ROUND((TIMESTAMPDIFF(MINUTE,
                                            schedule_employee.clock_in,
                                            schedule_employee.time_out) / 60) - (TIME_TO_SEC(schedule_employee.break_time) / 60 / 60),
                                        2)) >= (ROUND((TIMESTAMPDIFF(MINUTE,
                                            schedule_employee.time_in,
                                            schedule_employee.time_out) / 60) - (TIME_TO_SEC(schedule_employee.break_time) / 60 / 60),
                                        2))
                            THEN
                                (ROUND((TIMESTAMPDIFF(MINUTE,
                                            schedule_employee.time_in,
                                            schedule_employee.time_out) / 60) - (TIME_TO_SEC(schedule_employee.break_time) / 60 / 60),
                                        2))
                            ELSE (ROUND((TIMESTAMPDIFF(MINUTE,
                                        schedule_employee.clock_in,
                                        schedule_employee.time_out) / 60) - (TIME_TO_SEC(schedule_employee.break_time) / 60 / 60),
                                    2))
                        END AS totalhrs
                    FROM
                        schedule_employee
                            LEFT JOIN
                        sched_refpay ON sched_refpay.sched_refpay_id = schedule_employee.sched_refpay_id
                            LEFT JOIN
                        sched_refshift ON sched_refshift.sched_refshift_id = schedule_employee.sched_refshift_id
                            LEFT JOIN
                        employee_list ON employee_list.employee_id = schedule_employee.employee_id
                            LEFT JOIN
                        ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id
                    WHERE
                        schedule_employee.is_deleted = 0
                            AND schedule_employee.employee_id = $employee_id
                            ".($stat==2?" AND schedule_employee.date BETWEEN '".$start_date."' AND '".$end_date."'":" AND schedule_employee.pay_period_id='".$pay_period_id."'")."
                    ORDER BY schedule_employee.date ASC");
                              return $query->result(); 
    }

    function get_before_date($employee_id,$pay_period_id,$date_before){
        $query = $this->db->query("SELECT 
                        (CASE
                            WHEN clock_in != '' AND clock_out != '' THEN 1
                            ELSE 0
                        END) AS count_before_date
                    FROM
                        schedule_employee
                    WHERE
                        schedule_employee.pay_period_id = ".$pay_period_id."
                            AND schedule_employee.employee_id = ".$employee_id."
                            AND date = '".$date_before."'");
                              return $query->result();
    }

    function get_empid_wthsundaypremium(){
        $query = $this->db->query("SELECT 
                schedule_employee.schedule_employee_id
            FROM
                schedule_employee
                    LEFT JOIN
                employee_list ON employee_list.employee_id = schedule_employee.employee_id
                    LEFT JOIN
                emp_rates_duties ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id
            WHERE
                emp_rates_duties.active_rates_duties = 1
                    AND emp_rates_duties.is_deleted = 0
                    AND emp_rates_duties.is_sunday_premium = 1
                    AND schedule_employee.is_deleted = 0
                    AND DATE_FORMAT(schedule_employee.date, '%W') = 'Sunday'
                    AND (schedule_employee.ref_day_type_id = 0
                    OR schedule_employee.ref_day_type_id = 1)");
                    return $query->result();
    }

    function ifperschedoverlaps($employee_id,$dato,$sched_refshift_id) {
        $query = $this->db->query("SELECT schedule_employee_id
                                   FROM schedule_employee
                                    WHERE schedule_employee.employee_id='".$employee_id."' AND date='".$dato."' AND schedule_employee.is_deleted=0 AND sched_refshift_id=".$sched_refshift_id."");

                                return $query->result();

    }

    function ifschedoverlaps($employee_id,$pay_period_id,$date,$time_in,$time_out) {
        $query = $this->db->query("SELECT schedule_employee.schedule_employee_id,schedule_employee.sched_refshift_id,schedule_employee.time_in,schedule_employee.time_out FROM schedule_employee
                                    WHERE employee_id='".$employee_id."' AND date='".$date."' AND pay_period_id=".$pay_period_id." AND is_deleted=0 AND (('".$time_in."' BETWEEN schedule_employee.time_in
                                    AND schedule_employee.time_out) OR ('".$time_out."' BETWEEN schedule_employee.time_in AND schedule_employee.time_out))");

                                return $query->result();

    }

    function checkshiftexist($employee_id,$pay_period_id,$date,$time_in,$time_out,$sched_refshift_id) {
        $query = $this->db->query("SELECT schedule_employee.schedule_employee_id,schedule_employee.sched_refshift_id FROM schedule_employee
                                    WHERE employee_id='".$employee_id."' AND date='".$date."' AND pay_period_id=".$pay_period_id." AND is_deleted=0 AND  sched_refshift_id=".$sched_refshift_id);

                                return $query->result();

    }

    function check_break_late($stamp,$time) {
        $query = $this->db->query("SELECT 
                                    (CASE
                                        WHEN '".$stamp."' >= '".$time."' THEN 0.00
                                        ELSE TIMESTAMPDIFF(MINUTE,'".$stamp."','".$time."')
                                    END) AS break_late");
                                return $query->result();

    }

    function chck_pay_period_timein($date,$employee_id){
                        $query = $this->db->query("SELECT 
                    pay_period_id, clock_in, clock_out, allow_ot, is_day_off
                FROM
                    schedule_employee
                WHERE
                    (CAST(time_in AS DATE) = '".$date."')
                        AND employee_id =".$employee_id);
                                return $query->result();
    }

    function chck_pay_period_timeout($date,$employee_id){
                        $query = $this->db->query("SELECT 
                    pay_period_id, clock_in, clock_out, allow_ot, is_day_off
                FROM
                    schedule_employee
                WHERE
                    (CAST(time_out AS DATE) = '".$date."')
                        AND employee_id =".$employee_id);
                                return $query->result();
    }    

    function chck_emp_sched($mode,$employee_id,$date){
        $query = $this->db->query("SELECT schedule_employee_id, is_in , is_out , allow_ot , ot_in , is_day_off FROM schedule_employee 
            WHERE employee_id = $employee_id
                AND is_deleted = 0
                 ".($mode=='time_in'?" AND CAST(time_in AS DATE) = '".$date."'":"")."
                 ".($mode=='time_out'?" AND CAST(time_out AS DATE) = '".$date."'":"")."
                 ".($mode=='ot_out'?" AND CAST(time_out AS DATE) = '".$date."'":"")."
             ");
        return $query->result();
    }

    function get_pay_period($date,$no_date_filter=null) {
        $query = $this->db->query("SELECT refpayperiod.pay_period_id FROM refpayperiod WHERE '".$date."' BETWEEN refpayperiod.pay_period_start AND refpayperiod.pay_period_end AND refpayperiod.is_deleted=0 ".($no_date_filter==0?"":" AND (TIMESTAMPDIFF(DAY, refpayperiod.pay_period_start, refpayperiod.pay_period_end)) <='".$no_date_filter."'")."");
          return $query->result();

    }

    // function get_schedule_id($employee_id,$pay_period_id,$date,$time) {
    //      $query = $this->db->query("SELECT schedule_employee.schedule_employee_id,schedule_employee.is_in,schedule_employee.is_out,schedule_employee.break_time,schedule_employee.clock_in,schedule_employee.total,schedule_employee.time_out,
    //                                 DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
    //                                 DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
    //                                 FROM schedule_employee
        //                          WHERE employee_id='".$employee_id."' AND date='".$date."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0 HAVING ('".$time."' BETWEEN timein  AND timeout )");
    //
    //                             return $query->result();
    //
    // }

    // function get_schedule_id($employee_id,$pay_period_id,$date,$time) {
    //      $query = $this->db->query("SELECT 
    //             schedule_employee.schedule_employee_id,
    //             schedule_employee.is_in,
    //             schedule_employee.date,
    //             schedule_employee.is_out,
    //             schedule_employee.break_time,
    //             schedule_employee.clock_in,
    //             schedule_employee.total,
    //             schedule_employee.time_in,
    //             schedule_employee.time_out,
    //             schedule_employee.allow_ot,
    //             schedule_employee.ot_in,
    //             schedule_employee.ot_out,
    //             schedule_employee.advance_in_out,
    //             DATE_ADD(schedule_employee.time_in,
    //                 INTERVAL - schedule_employee.advance_in_out MINUTE) AS timein,
    //             DATE_ADD(schedule_employee.time_out,
    //                 INTERVAL 210 MINUTE) AS timeout
    //         FROM
    //             schedule_employee
    //         WHERE
    //             employee_id = ".$employee_id." AND pay_period_id = ".$pay_period_id."
    //                 AND schedule_employee.is_deleted = 0
    //                 AND (schedule_employee.date = '".$date."' OR CAST(schedule_employee.time_out AS DATE) = '".$date."')
    //                 HAVING ('".$time."' BETWEEN timein AND timeout)");
    //                 return $query->result();

    // }

    function get_schedule_id($mode,$employee_id,$date,$is_day_off=null,$datetime) {
         $query = $this->db->query("SELECT 
                    schedule_employee_id,
                    date,
                    is_day_off,
                    is_in,
                    is_out,
                    break_time,
                    clock_in,
                    clock_out,
                    total,
                    time_in,
                    time_out,
                    allow_ot,
                    ot_in,
                    ot_out,
                    advance_in_out,
                    DATE_ADD(schedule_employee.time_in,
                        INTERVAL - schedule_employee.advance_in_out MINUTE) AS timein,
                    DATE_ADD(schedule_employee.time_out,
                        INTERVAL 210 MINUTE) AS timeout
                FROM
                    schedule_employee
                WHERE
                    employee_id = $employee_id
                        AND schedule_employee.is_deleted = 0
                        ".($is_day_off==null? " ":" AND schedule_employee.is_day_off = 0")."
                        ".($mode=='time_in'?" AND CAST(time_in AS DATE) = '".$date."'":"")."
                        ".($mode=='ot_out'?" AND is_in = 1 AND is_out = 1 AND '".$date."' BETWEEN DATE(time_in) AND DATE(time_out) ORDER BY schedule_employee_id DESC LIMIT 1":"")."
                        ".($mode=='break_out'?" AND '".$datetime."' BETWEEN time_in AND time_out":"")."
                        ".($mode=='break_in'?" AND '".$datetime."' BETWEEN time_in AND time_out":"")."
                        ".($mode=='time_out'?" AND is_in = 1 AND is_out = 0 AND '".$date."' BETWEEN DATE(time_in) AND DATE(time_out) ORDER BY schedule_employee_id DESC LIMIT 1":"")."
                        ");
         return $query->result();
     }


    function get_schedule_id_break($employee_id,$pay_period_id,$date,$time) {
        $query = $this->db->query("SELECT 
                schedule_employee.schedule_employee_id,
                schedule_employee.is_in,
                schedule_employee.date,
                schedule_employee.is_out,
                schedule_employee.break_time,
                schedule_employee.clock_in,
                schedule_employee.total,
                schedule_employee.time_in,
                schedule_employee.time_out,
                schedule_employee.allow_ot,
                schedule_employee.ot_in,
                schedule_employee.ot_out,
                schedule_employee.advance_in_out,
                DATE_ADD(schedule_employee.time_in,
                    INTERVAL - schedule_employee.advance_in_out MINUTE) AS timein,
                DATE_ADD(schedule_employee.time_out,
                    INTERVAL 210 MINUTE) AS timeout
            FROM
                schedule_employee
            WHERE
                employee_id = ".$employee_id." AND pay_period_id = ".$pay_period_id."
                    AND schedule_employee.is_deleted = 0
                    AND (schedule_employee.date = '".$date."' OR CAST(schedule_employee.time_out AS DATE) = '".$date."')
                    HAVING ('".$time."' BETWEEN schedule_employee.time_in AND schedule_employee.time_out)");
                    return $query->result();

    }
    
    function check_ot($employee_id,$pay_period_id,$date,$time) {
        $query = $this->db->query("SELECT 
                        allow_ot,
                        schedule_employee.schedule_employee_id,
                        schedule_employee.is_in,
                        schedule_employee.is_out,
                        schedule_employee.break_time,
                        schedule_employee.clock_in,
                        schedule_employee.total,
                        schedule_employee.allow_ot,
                        schedule_employee.ot_in,
                        schedule_employee.ot_out,
                        schedule_employee.time_out
                    FROM
                        schedule_employee
                    WHERE
                        employee_id = '".$employee_id."'
                            AND pay_period_id = ".$pay_period_id."
                            AND schedule_employee.is_deleted = 0
                        AND (CAST(schedule_employee.time_out AS DATE)) = '".$date."'
                    HAVING ('".$time."' >= time_out)");
                    return $query->result();

    }

    function get_period_sched($employee_id,$date) {
        $query = $this->db->query("SELECT 
                        schedule_employee.day,
                        schedule_employee.date,
                        schedule_employee.stat_completion,
                        schedule_employee.total,
                        schedule_employee.time_in,
                        schedule_employee.time_out
                    FROM
                        schedule_employee
                            LEFT JOIN
                        refpayperiod ON schedule_employee.pay_period_id = refpayperiod.pay_period_id
                    WHERE
                        employee_id = ".$employee_id."
                            AND schedule_employee.date BETWEEN refpayperiod.pay_period_start AND refpayperiod.pay_period_end
                            AND schedule_employee.is_deleted = 0
                            AND '".$date."' BETWEEN refpayperiod.pay_period_start AND refpayperiod.pay_period_end
                            AND is_day_off = 0

                    ORDER BY schedule_employee.date DESC");
                    return $query->result();
                            // AND (schedule_employee.is_day_off = 0 AND schedule_employee.clock_in != '' AND schedule_employee.clock_out != '')
    }

    function get_whosinout($pay_period_id,$date,$time,$type) {
        $query = $this->db->query("SELECT employee_list.ecode,CONCAT(employee_list.first_name,' ',employee_list.middle_name,' ',employee_list.last_name) as full_name,
                                   DATE_FORMAT(schedule_employee.clock_in,'%h:%i %p') as time_in12,
                                   DATE_FORMAT(schedule_employee.clock_out,'%h:%i %p') as time_out12,
                                   DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
                                   DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
                                   FROM schedule_employee
                                   LEFT JOIN employee_list ON
                                   schedule_employee.employee_id=employee_list.employee_id
                                   WHERE date='".$date."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0  AND is_in=1 HAVING ('".$time."' BETWEEN timein  AND timeout )
                                   ORDER BY schedule_employee.clock_in ASC");

                                return $query->result();

    }

    function count_whosin($pay_period_id,$date,$time,$type) {
        $query = $this->db->query("SELECT COUNT(schedule_employee.schedule_employee_id) as whos_in,
                                   DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
                                   DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
                                   FROM schedule_employee
                                   WHERE date='".$date."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0  AND is_in=1 HAVING ('".$time."' BETWEEN timein  AND timeout )");

                                return $query->result();

    }

    function get_whosout($pay_period_id,$date,$time,$type) {
        $query = $this->db->query("SELECT employee_list.ecode,CONCAT(employee_list.first_name,' ',employee_list.middle_name,' ',employee_list.last_name) as full_name,
                                   DATE_FORMAT(schedule_employee.clock_in,'%h:%i %p') as time_in12,
                                   DATE_FORMAT(schedule_employee.clock_out,'%h:%i %p') as time_out12,
                                   DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
                                   DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
                                   FROM schedule_employee
                                   LEFT JOIN employee_list ON
                                   schedule_employee.employee_id=employee_list.employee_id
                                   WHERE date='".$date."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0  AND is_in=1 AND is_out=1 HAVING ('".$time."' BETWEEN timein  AND timeout )
                                   ORDER BY schedule_employee.clock_out");

                                return $query->result();

    }

    function get_schedule_stat($employee_id,$pay_period_id) {
        $query = $this->db->query("SELECT schedule_employee.schedule_employee_id
                                    FROM schedule_employee
                                    WHERE employee_id='".$employee_id."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0 ");

                                return $query->result();

    }

    function get_timediff($time_in,$time_out,$break_time) {
        $query = $this->db->query("SELECT SEC_TO_TIME((a.totalminutes-b.breaktime)*60) as total_hours,(a.totalminutes-b.breaktime) as minutesattended FROM
                                  (SELECT TIMESTAMPDIFF(MINUTE,'".$time_in."','".$time_out."') as totalminutes) as a
                                  CROSS JOIN (SELECT TIME_TO_SEC('".$break_time."') / 60 as breaktime) as  b");

                                return $query->result();

    }

    function conv_timetominute($sched_hours) {
        $query = $this->db->query("SELECT TIME_TO_SEC('".$sched_hours."') / 60 as sched_minutes");

                                return $query->result();

    }

    function compute_late($sched_time,$clock_in) {
        $query = $this->db->query("SELECT TIMESTAMPDIFF(MINUTE, '".$sched_time."', '".$clock_in."') as late");
                                return $query->result();

    }

    function checkifdoublein($schedule_employee_id,$time) {
        $query = $this->db->query("SELECT
                                        (CASE
                                            WHEN
                                                (TIMESTAMPDIFF(MINUTE,
                                                    clock_in,
                                                    '".$time."')) < 15
                                            THEN
                                                1
                                            ELSE 0
                                        END) AS instatus
                                    FROM
                                        schedule_employee
                                    WHERE
                                        schedule_employee_id = ".$schedule_employee_id."
                                            AND schedule_employee.is_deleted = 0");
                                $result = $query->result();
                                return $result[0]->instatus;

    }

    function checkifforgottoout($pay_period_id,$date,$time) {

      $query = $this->db->query("SELECT employee_list.employee_id,schedule_employee.schedule_employee_id,schedule_employee.time_out,
                                     DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
                                     DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
                                     FROM schedule_employee
                                     LEFT JOIN employee_list ON
                                     schedule_employee.employee_id=employee_list.employee_id
                                     WHERE pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0  AND is_in=1 AND is_out=0 HAVING ('".$time."' > timeout )
                                       ORDER BY schedule_employee.clock_in ASC");
                              $result = $query->result();
                              return $result;
    }

    function getschedules($employee_id,$pay_period_id) {
        $query = $this->db->query("SELECT
                                      schedule_employee.*,
                                      sched_refpay.schedpay,
                                      sched_refshift.shift,
                                      CONCAT(employee_list.first_name,
                                              ' ',
                                              employee_list.middle_name,
                                              ' ',
                                              employee_list.last_name) AS full_name,
                                      (CASE 
                                        WHEN schedule_employee.is_day_off = 1 THEN 'DAY OFF'
                                        ELSE ref_day_type.daytype
                                      END) AS daytype,
                                      (CASE
                                          WHEN
                                              schedule_employee.time_in BETWEEN CONCAT(EXTRACT(YEAR FROM time_in),
                                                      '-',
                                                      EXTRACT(MONTH FROM time_in),
                                                      '-',
                                                      EXTRACT(DAY FROM time_in),
                                                      ' ',
                                                      nsdsetup.nsd_start) AND CONCAT(EXTRACT(YEAR FROM time_out),
                                                      '-',
                                                      EXTRACT(MONTH FROM time_out),
                                                      '-',
                                                      EXTRACT(DAY FROM time_out),
                                                      ' ',
                                                      nsdsetup.nsd_end)
                                          THEN
                                              'NSD'
                                          ELSE 'DAY'
                                      END) AS type
                                  FROM
                                      schedule_employee
                                          CROSS JOIN
                                      nsdsetup
                                          LEFT JOIN
                                      sched_refpay ON sched_refpay.sched_refpay_id = schedule_employee.sched_refpay_id
                                          LEFT JOIN
                                      sched_refshift ON sched_refshift.sched_refshift_id = schedule_employee.sched_refshift_id
                                          LEFT JOIN
                                      employee_list ON employee_list.employee_id = schedule_employee.employee_id
                                        LEFT JOIN
                                      ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id

                                      WHERE schedule_employee.is_deleted=0 AND schedule_employee.employee_id=".$employee_id." AND schedule_employee.pay_period_id=".$pay_period_id."

                                  ");
                                return $query->result();

    }

    function getscheduleperperiod($employee_id,$pay_period_id) {
        $query = $this->db->query("SELECT schedule_employee_id, schedule_employee.date
                FROM schedule_employee
                WHERE employee_id = ".$employee_id."
                AND pay_period_id = ".$pay_period_id."
                AND is_deleted = 0
                ");
        return $query->result();
    }

    function getemployeedetails($employee_id) {
        $query = $this->db->query("SELECT emplist.ecode, emplist.image_name FROM employee_list as emplist WHERE emplist.employee_id = ".$employee_id."");
        return $query->result();
    }

    function getschedulewithID($schedule_id){
        $query = $this->db->query("SELECT schedule_employee.schedule_employee_id, 
                schedule_employee.date, schedule_employee.day, schedule_employee.clock_in, schedule_employee.clock_out,
                sched_refpay.schedpay,sched_refshift.shift, schedule_employee.break_time, schedule_employee.total, schedule_employee.time_in, DATE_FORMAT(cast(schedule_employee.time_in as date), '%m/%d/%Y') as time_in_date, DATE_FORMAT(cast(schedule_employee.time_out as date), '%m/%d/%Y') as time_out_date, schedule_employee.time_out, ref_day_type.daytype AS daytype,
                (CASE
                    WHEN
                        schedule_employee.time_in BETWEEN CONCAT(EXTRACT(YEAR FROM time_in),
                                '-',
                                EXTRACT(MONTH FROM time_in),
                                '-',
                                EXTRACT(DAY FROM time_in),
                                ' ',
                                nsdsetup.nsd_start) AND CONCAT(EXTRACT(YEAR FROM time_out),
                                '-',
                                EXTRACT(MONTH FROM time_out),
                                '-',
                                EXTRACT(DAY FROM time_out),
                                ' ',
                                nsdsetup.nsd_end)
                    THEN
                        'NSD'
                    ELSE 'DAY'
                END) AS type
                FROM schedule_employee
                  CROSS JOIN
                nsdsetup
                  LEFT JOIN
                sched_refpay ON sched_refpay.sched_refpay_id = schedule_employee.sched_refpay_id
                    LEFT JOIN
                sched_refshift ON sched_refshift.sched_refshift_id = schedule_employee.sched_refshift_id
                  LEFT JOIN
                ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id 
                WHERE schedule_employee_id = ".$schedule_id."
                ");
        return $query->result();
    }

    // function getschedules() {
    //      $query = $this->db->query("SELECT
    //                                   schedule_employee.*,
    //                                   sched_refpay.schedpay,
    //                                   sched_refshift.shift,
    //                                   CONCAT(employee_list.first_name,
    //                                           ' ',
    //                                           employee_list.middle_name,
    //                                           ' ',
    //                                           employee_list.last_name) AS full_name,
    //                                   COALESCE(ref_day_type.daytype, 'Regular Day') AS daytype,
    //                                   (CASE
    //                                       WHEN
    //                                           schedule_employee.time_in BETWEEN CONCAT(EXTRACT(YEAR FROM time_in),
    //                                                   '-',
    //                                                   EXTRACT(MONTH FROM time_in),
    //                                                   '-',
    //                                                   EXTRACT(DAY FROM time_in),
    //                                                   ' ',
    //                                                   nsdsetup.nsd_start) AND CONCAT(EXTRACT(YEAR FROM time_out),
    //                                                   '-',
    //                                                   EXTRACT(MONTH FROM time_out),
    //                                                   '-',
    //                                                   EXTRACT(DAY FROM time_out),
    //                                                   ' ',
    //                                                   nsdsetup.nsd_end)
    //                                       THEN
    //                                           'NSD'
    //                                       ELSE 'DAY'
    //                                   END) AS type
    //                               FROM
    //                                   schedule_employee
    //                                       CROSS JOIN
    //                                   nsdsetup
    //                                       LEFT JOIN
    //                                   sched_refpay ON sched_refpay.sched_refpay_id = schedule_employee.sched_refpay_id
    //                                       LEFT JOIN
    //                                   sched_refshift ON sched_refshift.sched_refshift_id = schedule_employee.sched_refshift_id
    //                                       LEFT JOIN
    //                                   employee_list ON employee_list.employee_id = schedule_employee.employee_id
    //                                       LEFT JOIN
    //                                   sched_holiday_setup ON sched_holiday_setup.date = schedule_employee.date
    //                                       LEFT JOIN
    //                                   ref_day_type ON ref_day_type.ref_day_type_id = sched_holiday_setup.ref_day_type_id
    //
    //
    //                               ");
    //                             return $query->result();
    //
    // }

    // function checkifforgottoout($pay_period_id,$date,$time) {
    //
    //   $query = $this->db->query("SELECT employee_list.employee_id,schedule_employee.schedule_employee_id,schedule_employee.time_out,
    //                                  DATE_ADD(schedule_employee.time_in,INTERVAL -schedule_employee.advance_in_out MINUTE) as timein,
    //                                  DATE_ADD(schedule_employee.time_out,INTERVAL schedule_employee.advance_in_out MINUTE) as timeout
    //                                  FROM schedule_employee
    //                                  LEFT JOIN employee_list ON
    //                                  schedule_employee.employee_id=employee_list.employee_id
    //                                  WHERE date='".$date."' AND pay_period_id=".$pay_period_id." AND schedule_employee.is_deleted=0  AND is_in=1 AND is_out=0 HAVING ('".$time."' > timeout )
    //                                    ORDER BY schedule_employee.clock_in ASC");
    //                           $result = $query->result();
    //                           return $result;
    // }

    // function get_timediff($time_in,$time_out) {
    //      $query = $this->db->query("SELECT TIMESTAMPDIFF(HOUR,'".$time_in."','".$time_out."') as total_hours");
    //
    //                             return $query->result();
    //
    // }






}
?>
