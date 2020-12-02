<?php

class SchedDTR_model extends CORE_Model {
    protected  $table="schedule_employee";
    protected  $pk_id="schedule_employee_id";

    function __construct() {
        parent::__construct();
    }

    function getscheddtr($employee_id,$pay_period_id) {
        $query = $this->db->query("SELECT b.*,ref_day_type_id,
(CASE
	WHEN b.ref_day_type_id = 1 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_day,
(CASE
	WHEN b.ref_day_type_id = 2 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_sunday,
(CASE
	WHEN b.ref_day_type_id = 3 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_holiday,
(CASE
	WHEN b.ref_day_type_id = 4 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as special_holiday,
(CASE
	WHEN b.ref_day_type_id = 5 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as sunday_regular_holiday,
(CASE
	WHEN b.ref_day_type_id = 6 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as sunday_special_holiday,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=1 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as regular_ot,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=2 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as sunday_ot,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=3 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as regular_hol_ot,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=4 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as special_hol_ot,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=5 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as sunday_regular_hol_ot,
(CASE
	WHEN b.ot_in = 1 AND b.ref_day_type_id=6 AND b.time_in
    NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.ottime

	ELSE 0.00
  END) as sunday_special_hol_ot,
(CASE
	WHEN b.ref_day_type_id = 1 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_nsd,
(CASE
	WHEN b.ref_day_type_id = 2 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_sunday_nsd,
(CASE
	WHEN b.ref_day_type_id = 3 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as regular_hol_nsd,
(CASE
	WHEN b.ref_day_type_id = 4 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as special_hol_nsd,
(CASE
	WHEN b.ref_day_type_id = 5 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as sunday_regular_hol_nsd,
(CASE
	WHEN b.ref_day_type_id = 5 AND b.time_in
    BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
	  '-',
	  EXTRACT(MONTH FROM b.time_in),
	  '-',
	  EXTRACT(DAY FROM b.time_in),
	  ' ',
	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
	  '-',
	  EXTRACT(MONTH FROM b.time_out),
	  '-',
	  EXTRACT(DAY FROM b.time_out),
	  ' ',
	  b.nsd_end) THEN b.newhour

	ELSE 0.00
  END) as sunday_special_hol_nsd
 FROM (SELECT
	t.fullname,t.employee_id,t.date,t.payperiod,t.clock_in,t.clock_out,t.breaktime,t.ref_day_type_id,t.daytype,t.ot_in,t.time_in,t.time_out,t.nsd_start,t.nsd_end,
    CASE
        WHEN clock_in <= time_in THEN 0
        ELSE TIMESTAMPDIFF(MINUTE, time_in, clock_in)
    END AS timelate,
    ottime,
    CASE
        WHEN ((totalattendedhours / 60) - (breaktime)) >= (totalhours / 60) - (breaktime) THEN COALESCE(ROUND((totalhours / 60) - (breaktime), 2),0)
        ELSE COALESCE(ROUND(((totalattendedhours / 60) - (breaktime)),2),
                0)
    END AS newhour


FROM
    (SELECT ref_day_type.ref_day_type_id,ref_day_type.daytype,
		CONCAT(refpayperiod.pay_period_start, ' ~ ', refpayperiod.pay_period_end) AS payperiod,
        TIMESTAMPDIFF(MINUTE, clock_in, clock_out) AS totalattendedhours,
            clock_in,
            clock_out,
            TIMESTAMPDIFF(MINUTE, time_in, time_out) AS totalhours,
            ROUND(TIME_TO_SEC(break_time) / 60 / 60, 2) AS breaktime,
            COALESCE(TIMESTAMPDIFF(HOUR, time_out, ot_out), 0) AS ottime,
            date,
            time_in,
            time_out,
            total,ot_in,nsdsetup.nsd_start,nsdsetup.nsd_end,schedule_employee.employee_id,
            CONCAT(first_name,' ',middle_name,' ',last_name) as fullname
    FROM
        schedule_employee
	CROSS JOIN
	  nsdsetup
    LEFT JOIN employee_list ON schedule_employee.employee_id = employee_list.employee_id
    LEFT JOIN refpayperiod ON schedule_employee.pay_period_id = refpayperiod.pay_period_id
    LEFT JOIN ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id
    WHERE
        schedule_employee.employee_id = ".$employee_id."
            AND schedule_employee.pay_period_id = ".$pay_period_id."
            AND schedule_employee.is_deleted = 0) AS t
) as b");
        return $query->result();

    }

    // function getscheddtr($employee_id,$pay_period_id) {
    //     $query = $this->db->query("SELECT CASE WHEN clock_in <= time_in THEN 0 ELSE TIMESTAMPDIFF(MINUTE,time_in,clock_in) END as timelate,
    //                                 ottime,
    //                                 CASE WHEN ((totalattendedhours/60)-(breaktime)) >= (totalhours/60)-(breaktime) THEN ROUND((totalhours/60)-(breaktime),2)
    //                                  ELSE ROUND(((totalattendedhours/60)-(breaktime)),2) END as newhour,
    //                             t.fullname,t.*,ROUND((totalattendedhours/60)-(breaktime),2) as tfinalhours,
    //                             ROUND(TIME_TO_SEC(total) / 60 /60,2) as totalhrs
    //                             FROM
    //                             (SELECT TIMESTAMPDIFF(MINUTE,clock_in,clock_out) as totalattendedhours,clock_in,clock_out,
    //                             TIMESTAMPDIFF(MINUTE,time_in,time_out) as totalhours, ROUND(TIME_TO_SEC(break_time) / 60 /60,2) as breaktime ,
    //                             COALESCE(TIMESTAMPDIFF(MINUTE,time_out,ot_out),0) as ottime,
    //                             	CONCAT(first_name,' ',middle_name,' ',last_name) as fullname,
    //                                 CONCAT(refpayperiod.pay_period_start,'-',refpayperiod.pay_period_end) as payperiod,date,time_in,time_out,total
    //                                 FROM schedule_employee
    //                             	LEFT JOIN employee_list
    //                             	ON schedule_employee.employee_id=employee_list.employee_id
    //                             	LEFT JOIN refpayperiod
    //                             	ON schedule_employee.pay_period_id=refpayperiod.pay_period_id
    //                               WHERE schedule_employee.employee_id='".$employee_id."' AND schedule_employee.pay_period_id=".$pay_period_id." AND
    //                                schedule_employee.is_deleted=0) as t");
    //     return $query->result();
    //
    // }

//     function getdtrsummary($pay_period_id) {
//         $query = $this->db->query("SELECT sa.employee_id,sa.ref_department_id,sa.fullname,sa.ecode,SUM(sa.newhour) as newhour,
//         	sa.payperiod,
// 			SUM(sa.timelate) as timelate,
// 			SUM(sa.regular_day) as regular_day,
// 			SUM(sa.regular_sunday) as regular_sunday,
// 			SUM(sa.regular_holiday) as regular_holiday,
// 			SUM(sa.special_holiday) as special_holiday,
// 			SUM(sa.sunday_regular_holiday) as sunday_regular_holiday,
// 			SUM(sa.sunday_special_holiday) as sunday_special_holiday,
// 			SUM(sa.regular_ot) as regular_ot,
// 			SUM(sa.sunday_ot) as sunday_ot,
// 			SUM(sa.regular_hol_ot) as regular_hol_ot,
// 			SUM(sa.special_hol_ot) as special_hol_ot,
// 			SUM(sa.sunday_regular_hol_ot) as sunday_regular_hol_ot,
// 			SUM(sa.sunday_special_hol_ot) as sunday_special_hol_ot,
// 			SUM(sa.regular_nsd) as regular_nsd,
// 			SUM(sa.regular_sunday_nsd) as regular_sunday_nsd,
// 			SUM(sa.regular_hol_nsd) as regular_hol_nsd,
// 			SUM(sa.special_hol_nsd) as special_hol_nsd,
// 			SUM(sa.sunday_regular_hol_nsd) as sunday_regular_hol_nsd,
// 			SUM(sa.sunday_special_hol_nsd) as sunday_special_hol_nsd
//  FROM
// (SELECT b.*,
// (CASE
// 	WHEN b.ref_day_type_id = 1 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_day,
// (CASE
// 	WHEN b.ref_day_type_id = 2 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_sunday,
// (CASE
// 	WHEN b.ref_day_type_id = 3 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_holiday,
// (CASE
// 	WHEN b.ref_day_type_id = 4 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as special_holiday,
// (CASE
// 	WHEN b.ref_day_type_id = 5 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as sunday_regular_holiday,
// (CASE
// 	WHEN b.ref_day_type_id = 6 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as sunday_special_holiday,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=1 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as regular_ot,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=2 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as sunday_ot,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=3 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as regular_hol_ot,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=4 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as special_hol_ot,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=5 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as sunday_regular_hol_ot,
// (CASE
// 	WHEN b.ot_in = 1 AND b.ref_day_type_id=6 AND b.time_in
//     NOT BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.ottime

// 	ELSE 0.00
//   END) as sunday_special_hol_ot,
// (CASE
// 	WHEN b.ref_day_type_id = 1 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_nsd,
// (CASE
// 	WHEN b.ref_day_type_id = 2 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_sunday_nsd,
// (CASE
// 	WHEN b.ref_day_type_id = 3 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as regular_hol_nsd,
// (CASE
// 	WHEN b.ref_day_type_id = 4 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as special_hol_nsd,
// (CASE
// 	WHEN b.ref_day_type_id = 5 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as sunday_regular_hol_nsd,
// (CASE
// 	WHEN b.ref_day_type_id = 5 AND b.time_in
//     BETWEEN CONCAT(EXTRACT(YEAR FROM b.time_in),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_in),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_in),
// 	  ' ',
// 	  b.nsd_start) AND CONCAT(EXTRACT(YEAR FROM b.time_out),
// 	  '-',
// 	  EXTRACT(MONTH FROM b.time_out),
// 	  '-',
// 	  EXTRACT(DAY FROM b.time_out),
// 	  ' ',
// 	  b.nsd_end) THEN b.newhour

// 	ELSE 0.00
//   END) as sunday_special_hol_nsd
//  FROM (SELECT
// 	t.ref_department_id,t.fullname,t.ecode,t.employee_id,t.date,t.payperiod,t.clock_in,t.clock_out,t.breaktime,t.ref_day_type_id,t.daytype,t.ot_in,t.time_in,t.time_out,t.nsd_start,t.nsd_end,
//     CASE
//         WHEN clock_in <= time_in THEN 0
//         ELSE TIMESTAMPDIFF(MINUTE, time_in, clock_in)
//     END AS timelate,
//     ottime,
//     CASE
//         WHEN ((totalattendedhours / 60) - (breaktime)) >= (totalhours / 60) - (breaktime) THEN COALESCE(ROUND((totalhours / 60) - (breaktime), 2),0)
//         ELSE COALESCE(ROUND(((totalattendedhours / 60) - (breaktime)),2),
//                 0)
//     END AS newhour


// FROM
//     (SELECT ref_day_type.ref_day_type_id,ref_day_type.daytype,
// 		CONCAT(refpayperiod.pay_period_start, '-', refpayperiod.pay_period_end) AS payperiod,
//         TIMESTAMPDIFF(MINUTE, clock_in, clock_out) AS totalattendedhours,
//             clock_in,
//             clock_out,
//             TIMESTAMPDIFF(MINUTE, time_in, time_out) AS totalhours,
//             ROUND(TIME_TO_SEC(break_time) / 60 / 60, 2) AS breaktime,
//             COALESCE(TIMESTAMPDIFF(HOUR, time_out, ot_out), 0) AS ottime,
//             date,
//             time_in,
//             time_out,
//             total,ot_in,nsdsetup.nsd_start,nsdsetup.nsd_end,schedule_employee.employee_id,
//             CONCAT(first_name,' ',middle_name,' ',last_name) as fullname,ref_department.ref_department_id,employee_list.ecode
//     FROM
//         schedule_employee
// 	CROSS JOIN
// 	  nsdsetup
//     LEFT JOIN employee_list ON schedule_employee.employee_id = employee_list.employee_id
//     LEFT JOIN emp_rates_duties ON emp_rates_duties.employee_id = employee_list.employee_id
//     LEFT JOIN ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
//     LEFT JOIN refpayperiod ON schedule_employee.pay_period_id = refpayperiod.pay_period_id
//     LEFT JOIN ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id
//     WHERE schedule_employee.pay_period_id = ".$pay_period_id."
//             AND schedule_employee.is_deleted = 0

//             ) AS t
// ) as b ) as sa
// GROUP BY sa.employee_id");
//         return $query->result();

//     }

    function getdtrsummary($payperiod){
    	$query = $this->db->query("SELECT 
				    sa.employee_id,
				    sa.ref_department_id,
				    sa.fullname,
				    sa.ecode,
				    SUM(sa.newhourregular) AS newhourregular,
				    SUM(sa.newhoursunday) AS newhoursunday,
				    SUM(sa.newhourdayoff) AS newhourdayoff,
				    SUM(sa.newhournsdregular) AS newhournsdregular,
				    SUM(sa.newhournsdsunday) AS newhournsdsunday,
				    (SUM(sa.newhourregular) + SUM(sa.newhoursunday) + SUM(sa.newhourdayoff)) AS newhour,
				    sa.payperiod,
				    SUM(sa.breaktime) as breaktime,
				    SUM(sa.timelate) AS timelate,
				    SUM(sa.timeundertime) AS timeundertime,
				    sa.break_late as excess_break,
				    sa.days_with_pay,
				    SUM(sa.regular_day) AS regular_day,
				    SUM(sa.regular_sunday) AS regular_sunday,
				    SUM(sa.day_off) AS day_off,
				    SUM(sa.regular_holiday) AS regular_holiday,
				    SUM(sa.special_holiday) AS special_holiday,
				    SUM(sa.sunday_regular_holiday) AS sunday_regular_holiday,
				    SUM(sa.sunday_special_holiday) AS sunday_special_holiday,
				    SUM(sa.regular_ot) AS regular_ot,
				    SUM(sa.sunday_ot) AS sunday_ot,
				    SUM(sa.regular_hol_ot) AS regular_hol_ot,
				    SUM(sa.special_hol_ot) AS special_hol_ot,
				    SUM(sa.sunday_regular_hol_ot) AS sunday_regular_hol_ot,
				    SUM(sa.sunday_special_hol_ot) AS sunday_special_hol_ot,
				    SUM(sa.regular_nsd) AS regular_nsd,
				    SUM(sa.regular_sunday_nsd) AS regular_sunday_nsd,
				    SUM(sa.regular_hol_nsd) AS regular_hol_nsd,
				    SUM(sa.special_hol_nsd) AS special_hol_nsd,
				    SUM(sa.sunday_regular_hol_nsd) AS sunday_regular_hol_nsd,
				    SUM(sa.sunday_special_hol_nsd) AS sunday_special_hol_nsd
				FROM
				    (SELECT 
				        b.*,
				            -- (CASE
				            --     WHEN b.ref_day_type_id = 1 THEN b.newhourregular
				            --     WHEN
				            --         b.ref_day_type_id = 1
				            --             AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				            --             AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				            --     THEN
				            --         b.newhourregular
				            --     WHEN
				            --         b.ref_day_type_id = 2
				            --             AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				            --             AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				            --     THEN
				            --         b.newhourregular
				            --     ELSE 0.00
				            -- END) AS regular_day,
				            (b.newhourregular) AS regular_day,				            
				            (CASE
				                WHEN b.ref_day_type_id = 2 THEN b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 1
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 2
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhoursunday
				                ELSE 0.00
				            END) AS regular_sunday,
				            (CASE
				                WHEN b.is_day_off = 1 THEN b.newhourdayoff
				                ELSE 0.00
				            END) AS day_off,
				            (CASE
				               	WHEN b.ref_day_type_id = 3 THEN b.hour_per_day
				                WHEN
				                    b.ref_day_type_id = 3
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.hour_per_day
				                WHEN
				                    b.ref_day_type_id = 3
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.hour_per_day
				                ELSE 0.00
				            END) AS regular_holiday,
				            (CASE
				                WHEN b.ref_day_type_id = 4 THEN
				                	(CASE
				                		WHEN b.newhourregular > 0 
				                			THEN (b.hour_per_day*0.3)
				                		ELSE b.hour_per_day
				                	END)
				                WHEN
				                    b.ref_day_type_id = 4
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                	(CASE
				                		WHEN b.newhourregular > 0 
				                			THEN (b.hour_per_day*0.3)
				                		ELSE b.hour_per_day
				                	END)
				                WHEN
				                    b.ref_day_type_id = 4
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                	(CASE
				                		WHEN b.newhourregular > 0 
				                			THEN (b.hour_per_day*0.3)
				                		ELSE b.hour_per_day
				                	END)
				                ELSE 0.00
				            END) AS special_holiday,
				            (CASE
				                WHEN b.ref_day_type_id = 5 THEN b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 5
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 5
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhoursunday
				                ELSE 0.00
				            END) AS sunday_regular_holiday,
				            (CASE
				                WHEN b.ref_day_type_id = 6 THEN b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 6
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhoursunday
				                WHEN
				                    b.ref_day_type_id = 6
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhoursunday
				                ELSE 0.00
				            END) AS sunday_special_holiday,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 1
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.regularottime
				                ELSE 0.00
				            END) AS regular_ot,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 2
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.sundayottime
				                ELSE 0.00
				            END) AS sunday_ot,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 3
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.regularottime
				                ELSE 0.00
				            END) AS regular_hol_ot,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 4
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.regularottime
				                ELSE 0.00
				            END) AS special_hol_ot,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 5
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.sundayottime
				                ELSE 0.00
				            END) AS sunday_regular_hol_ot,
				            (CASE
				                WHEN
				                    b.ot_in = 1 AND b.ref_day_type_id = 6
				                        AND b.time_in NOT BETWEEN CONCAT(CAST(b.time_in AS DATE), ' ', b.nsd_start) AND CONCAT(CAST(b.time_out AS DATE), ' ', b.nsd_end)
				                THEN
				                    b.sundayottime
				                ELSE 0.00
				            END) AS sunday_special_hol_ot,
				            (CASE
				                WHEN b.ref_day_type_id = 1 THEN b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 1
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 2
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdregular
				                ELSE 0.00
				            END) AS regular_nsd,
				            (CASE
				                WHEN b.ref_day_type_id = 2 THEN b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 1
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 2
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdsunday
				                ELSE 0.00
				            END) AS regular_sunday_nsd,
				            (CASE
				                WHEN b.ref_day_type_id = 3 THEN b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 3
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 3
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdregular
				                ELSE 0.00
				            END) AS regular_hol_nsd,
				            (CASE
				                WHEN b.ref_day_type_id = 4 THEN b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 4
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdregular
				                WHEN
				                    b.ref_day_type_id = 4
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdregular
				                ELSE 0.00
				            END) AS special_hol_nsd,
				            (CASE
				                WHEN b.ref_day_type_id = 5 THEN b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 5
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 5
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdsunday
				                ELSE 0.00
				            END) AS sunday_regular_hol_nsd,
				            (CASE
				                WHEN b.ref_day_type_id = 6 THEN b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 6
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Saturday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Sunday'
				                THEN
				                    b.newhournsdsunday
				                WHEN
				                    b.ref_day_type_id = 6
				                        AND DATE_FORMAT(b.clock_in, '%W') = 'Sunday'
				                        AND DATE_FORMAT(b.clock_out, '%W') = 'Monday'
				                THEN
				                    b.newhournsdsunday
				                ELSE 0.00
				            END) AS sunday_special_hol_nsd
				    FROM
				        (SELECT 
				        t.ref_department_id,
				            t.fullname,
				            t.last_name,
				            t.ecode,
				            t.employee_id,
				            t.date,
				            t.payperiod,
				            t.clock_in,
				            t.clock_out,
				            t.breaktime,
				            t.ref_day_type_id,
				            t.is_day_off,
				            t.daytype,
				            t.ot_in,
				            t.time_in,
				            t.time_out,
				            t.nsd_start,
				            t.nsd_end,
                            t.break_late,
                            t.hour_per_day,
							(SELECT 
					            (CASE 
				                    WHEN 

				                    (SELECT COALESCE(SUM(dtr.days_with_pay),0) FROM daily_time_record dtr 
				                    	LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
					                		WHERE dtr.employee_id = elf.employee_id AND rpp.pay_period_year = ely.year) 
					                	>= 
					                	COALESCE(SUM(total*erd.hour_per_day),0) THEN
				                        0.00
				                    ELSE
				                        (COALESCE(SUM(total*erd.hour_per_day),0) - (SELECT COALESCE(SUM(dtr.days_with_pay),0) FROM daily_time_record dtr 
				                    	LEFT JOIN refpayperiod rpp ON rpp.pay_period_id = dtr.pay_period_id
					                		WHERE dtr.employee_id = elf.employee_id AND rpp.pay_period_year = ely.year))
				                END)
				            FROM
				                emp_leaves_filed elf
				                    LEFT JOIN
				                emp_leaves_entitlement ele ON ele.emp_leaves_entitlement_id = elf.emp_leaves_entitlement_id
				                    LEFT JOIN 
				                emp_leave_year ely ON ely.emp_leave_year_id = elf.emp_leave_year_id
				                    LEFT JOIN
				                employee_list el ON el.employee_id = elf.employee_id
				                    LEFT JOIN
				                emp_rates_duties erd ON erd.emp_rates_duties_id = el.emp_rates_duties_id
				            WHERE
				                elf.is_deleted = FALSE
				                    AND elf.employee_id = t.employee_id
				                    AND ely.year = t.pay_period_year) as days_with_pay,
				            CASE
				                WHEN clock_in > (DATE_ADD(time_in, INTERVAL grace_period minute))
				                	THEN 
				                		(CASE
	                						WHEN
	                							COALESCE(TIMESTAMPDIFF(MINUTE, time_in,clock_in),0) > 0
	                						THEN COALESCE(TIMESTAMPDIFF(MINUTE, time_in,clock_in),0)
	                						ELSE 0.00
	                					END)
				                ELSE 0.00
				            END AS timelate,
				            CASE
				                WHEN clock_out < time_out THEN TIMESTAMPDIFF(MINUTE, clock_out, time_out)
				                ELSE 0.00
				            END AS timeundertime,
				            regularottime,
				            sundayottime,
				            (CASE
				                WHEN 
				                	((totalattendedhoursregular / 60) - (breaktime)) >= (totalhoursregular / 60) - (breaktime) 
				                	THEN 
				                		(CASE
				                			WHEN
				                				(COALESCE(ROUND((totalhoursregular / 60) - (breaktime), 2), 0)) > 0
				                			THEN 
				                				COALESCE(ROUND((totalhoursregular / 60) - (breaktime), 2), 0)
				                			ELSE
				                				0
				                		END)
				                ELSE 
				                	(CASE
				                		WHEN
				                			(COALESCE(ROUND(((totalattendedhoursregular / 60) - (breaktime)), 2), 0)) > 0
				                		THEN
				                			COALESCE(ROUND(((totalattendedhoursregular / 60) - (breaktime)), 2), 0)
				                		ELSE
				                			0
				                	END)
				            END) AS newhourregular,
				            (CASE
				                WHEN 
				                	((totalattendedhourssunday / 60) - (breaktime)) >= (totalhourssunday / 60) - (breaktime) 
				                	THEN 
				                		(CASE
				                			WHEN
				                				(COALESCE(ROUND((totalhourssunday / 60) - (breaktime), 2), 0)) > 0
				                			THEN
				                				COALESCE(ROUND((totalhourssunday / 60) - (breaktime), 2), 0)
				                			ELSE
				                				0
				                		END)
				                ELSE 
				                	(CASE
				                		WHEN
				                			(COALESCE(ROUND(((totalattendedhourssunday / 60) - (breaktime)), 2), 0)) > 0
				                		THEN
				                			COALESCE(ROUND(((totalattendedhourssunday / 60) - (breaktime)), 2), 0)
				                		ELSE
				                			0
				                	END)
				            END) AS newhoursunday,
				            CASE
				                WHEN 
				                	((totalattendedhoursdayoff / 60) - (breaktime)) >= (totalhoursdayoff / 60) - (breaktime) 
				                	THEN 
				                		(CASE
				                			WHEN
				                				(COALESCE(ROUND((totalhoursdayoff / 60) - (breaktime), 2), 0)) > 0
				                			THEN
				                				COALESCE(ROUND((totalhoursdayoff / 60) - (breaktime), 2), 0)
				                			ELSE
				                				0
				                		END)
				                ELSE 
				                	(CASE
				                		WHEN
				                			(COALESCE(ROUND(((totalattendedhoursdayoff / 60) - (breaktime)), 2), 0)) > 0
				                		THEN
				                			COALESCE(ROUND(((totalattendedhoursdayoff / 60) - (breaktime)), 2), 0)
				                		ELSE
				                			0
				                	END)
				            END AS newhourdayoff,
				            -- CASE
				            --     WHEN ((totalattendedhoursregular / 60) ) >= (totalhoursregular / 60) THEN COALESCE(ROUND((totalhoursregular / 60), 2), 0)
				            --     ELSE COALESCE(ROUND(((totalattendedhoursregular / 60)), 2), 0)
				            -- END AS newhourregular,
				            -- CASE
				            --     WHEN ((totalattendedhourssunday / 60)) >= (totalhourssunday / 60) THEN COALESCE(ROUND((totalhourssunday / 60), 2), 0)
				            --     ELSE COALESCE(ROUND(((totalattendedhourssunday / 60)), 2), 0)
				            -- END AS newhoursunday,
				            -- CASE
				            --     WHEN ((totalattendedhoursdayoff / 60)) >= (totalhoursdayoff / 60) THEN COALESCE(ROUND((totalhoursdayoff / 60), 2), 0)
				            --     ELSE COALESCE(ROUND(((totalattendedhoursdayoff / 60)), 2), 0)
				            -- END AS newhourdayoff,
				            CASE
				                WHEN
				                    clock_in != '' AND clock_out != ''
				                THEN
				                    CASE
				                        WHEN t.nsdhrregular > 0 THEN (t.nsdhrregular)
				                        ELSE 0.00
				                    END
				                ELSE 0.00
				            END AS newhournsdregular,
				            CASE
				                WHEN
				                    clock_in != '' AND clock_out != ''
				                THEN
				                    CASE
				                        WHEN t.nsdhrsunday > 0 THEN (t.nsdhrsunday)
				                        ELSE 0.00
				                    END
				                ELSE 0.00
				            END AS newhournsdsunday
				    FROM
				        (SELECT 
				        ref_day_type.ref_day_type_id,
				            ref_day_type.daytype,
				            is_day_off,
				            CONCAT(refpayperiod.pay_period_start, ' ~ ', refpayperiod.pay_period_end) AS payperiod,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1 AND is_day_off = 0)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'))
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            CASE
				                                WHEN TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), clock_out) > TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) THEN TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out)
				                                ELSE TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), clock_out)
				                            END
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') != 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') != 'Sunday'
				                        THEN
				                            CASE
				                                WHEN clock_out > time_out THEN TIMESTAMPDIFF(MINUTE, clock_in, time_out)
				                                ELSE TIMESTAMPDIFF(MINUTE, clock_in, clock_out)
				                            END
				                        ELSE 0.00
				                    END)
				                WHEN
				                    (is_sunday_premium = 0 AND is_day_off = 0)
				                THEN
				                    -- (CASE
				                    --     WHEN TIMESTAMPDIFF(MINUTE, clock_in, clock_out) >= TIMESTAMPDIFF(MINUTE, clock_in, time_out) 
				                    --     	THEN TIMESTAMPDIFF(MINUTE, clock_in, time_out)

				                    --     WHEN TIMESTAMPDIFF(MINUTE, clock_in, clock_out) <= TIMESTAMPDIFF(MINUTE, clock_in, time_out) 
				                    --     	THEN TIMESTAMPDIFF(MINUTE, clock_in, clock_out)

				                    --     ELSE 0.00
				                    -- END)

				                    TIMESTAMPDIFF(MINUTE, time_in, time_out)			                    
				                ELSE 0.00
				            END AS totalattendedhoursregular,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1 AND is_day_off = 0)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            CASE
				                                WHEN TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), clock_out) > TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) THEN TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out)
				                                ELSE TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), clock_out)
				                            END
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            CASE
				                                WHEN TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) > TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) THEN TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'))
				                                ELSE TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'))
				                            END
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            CASE
				                                WHEN clock_out > time_out THEN TIMESTAMPDIFF(MINUTE, clock_in, time_out)
				                                ELSE TIMESTAMPDIFF(MINUTE, clock_in, clock_out)
				                            END
				                        ELSE 0.00
				                    END)
				                ELSE 0.00
				            END AS totalattendedhourssunday,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1 AND is_day_off = 0)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'))
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out)
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') != 'Sunday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') != 'Sunday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, time_in, time_out)
				                        ELSE 0.00
				                    END)
				                WHEN 
				                	(is_sunday_premium = 0 AND is_day_off = 0) 
				                	THEN 
				                		(CASE
				                			WHEN is_in = 1 AND is_out = 1
				                				THEN
				                					TIMESTAMPDIFF(MINUTE, time_in, time_out)
				                				ELSE
				                				 	0
				                		END)
				                ELSE 0.00
				            END AS totalhoursregular,
				            CASE
				                WHEN
				                    (is_day_off = 1)
				                THEN
				                    (CASE
				                        WHEN TIMESTAMPDIFF(MINUTE, clock_in, clock_out) >= TIMESTAMPDIFF(MINUTE, clock_in, time_out) THEN TIMESTAMPDIFF(MINUTE, clock_in, time_out)
				                        WHEN TIMESTAMPDIFF(MINUTE, clock_in, clock_out) <= TIMESTAMPDIFF(MINUTE, clock_in, time_out) THEN TIMESTAMPDIFF(MINUTE, clock_in, clock_in)
				                        ELSE 0.00
				                    END)
				                ELSE 0.00
				            END AS totalattendedhoursdayoff,
				            CASE
				                WHEN
				                    (is_day_off = 1 AND clock_in != ''
				                        AND clock_out != '')
				                THEN
				                    TIMESTAMPDIFF(MINUTE, time_in, time_out)
				                ELSE 0.00
				            END AS totalhoursdayoff,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1 AND is_day_off = 0)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out)
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'))
				                        WHEN
				                            DATE_FORMAT(CAST(time_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            CASE
				                                WHEN clock_out > time_out THEN TIMESTAMPDIFF(MINUTE, clock_in, time_out)
				                                ELSE TIMESTAMPDIFF(MINUTE, clock_in, clock_out)
				                            END
				                        ELSE 0.00
				                    END)
				                ELSE 0.00
				            END AS totalhourssunday,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) THEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') != 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') != 'Sunday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        ELSE 0.00
				                    END)
				                WHEN
				                    (is_sunday_premium = 0)
				                THEN
				                    (CASE
					                    WHEN
				                            (clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                AND clock_out >= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end))
				                        THEN
				                            CASE
				                                WHEN (TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, time_in, CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                ELSE 0.00
				                            END
				                        WHEN
				                            clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                AND clock_out >= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                        THEN
				                            CASE
				                                WHEN
				                                    (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > 0
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60)
				                                        ELSE (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60)
				                                    END
				                                ELSE 0.00
				                            END
				                        WHEN
				                            clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                        THEN
				                            CASE
				                                WHEN
				                                    (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > 0
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                        ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                    END
				                                ELSE 0.00
				                            END
				                        WHEN
				                            time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                        THEN
				                            CASE
				                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                ELSE 0.00
				                            END
				                        WHEN
				                            time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                        THEN
				                            CASE
				                                WHEN
				                                    (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) > 0
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                        ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                    END
				                                ELSE 0.00
				                            END
				                        ELSE 0.00
				                    END)
				                ELSE 0.00
				            END AS nsdhrregular,
				            CASE
				                WHEN
				                    (is_sunday_premium = 1)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00'), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, clock_in, CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', '00:00:00')) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(clock_out AS DATE), ' ', '00:00:00')) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        WHEN
				                            DATE_FORMAT(CAST(clock_in AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(clock_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (CASE
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in >= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, clock_in, time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, clock_in, clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    clock_in <= CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND clock_out <= CONCAT(CAST(clock_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(clock_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out >= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60) > 0 THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)) / 60)
				                                        ELSE 0.00
				                                    END
				                                WHEN
				                                    time_in <= CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start)
				                                        AND time_out <= CONCAT(CAST(time_out AS DATE), ' ', nsdsetup.nsd_end)
				                                THEN
				                                    CASE
				                                        WHEN
				                                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) > 0
				                                        THEN
				                                            CASE
				                                                WHEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60) > (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60) THEN (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), time_out) / 60)
				                                                ELSE (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_in AS DATE), ' ', nsdsetup.nsd_start), clock_out) / 60)
				                                            END
				                                        ELSE 0.00
				                                    END
				                                ELSE 0.00
				                            END)
				                        ELSE 0.00
				                    END)
				                ELSE 0.00
				            END AS nsdhrsunday,
				            CASE
				                WHEN
				                    (ot_in = 1 AND is_sunday_premium = 1)
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, time_out, CONCAT(CAST(ot_out AS DATE), ' ', '00:00:00')) / 60)
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), ot_out) / 60)
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') != 'Sunday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') != 'Sunday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, time_out, ot_out) / 60)
				                        ELSE 0.00
				                    END)
				                WHEN (ot_in = 1 AND is_sunday_premium = 0) THEN (TIMESTAMPDIFF(MINUTE, time_out, ot_out) / 60)
				                ELSE 0.00
				            END AS regularottime,
				            CASE
				                WHEN
				                    ot_in = 1 AND is_sunday_premium = 1
				                THEN
				                    (CASE
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Saturday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, CONCAT(CAST(time_out AS DATE), ' ', '00:00:00'), ot_out) / 60)
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') = 'Monday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, time_out, CONCAT(CAST(ot_out AS DATE), ' ', '00:00:00')) / 60)
				                        WHEN
				                            DATE_FORMAT(CAST(time_out AS DATE), '%W') = 'Sunday'
				                                AND DATE_FORMAT(CAST(ot_out AS DATE), '%W') = 'Sunday'
				                        THEN
				                            (TIMESTAMPDIFF(MINUTE, time_out, ot_out) / 60)
				                        ELSE 0.00
				                    END)
				                WHEN ot_in = 1 AND is_sunday_premium = 0 THEN (TIMESTAMPDIFF(MINUTE, time_out, ot_out) / 60)
				                ELSE 0.00
				            END AS sundayottime,
				            is_sunday_premium,
				            clock_in,
				            clock_out,
				            time_in,
				            time_out,
				            schedule_employee.is_in,
				            schedule_employee.is_out,
				            schedule_employee.grace_period,
				            nsdsetup.nsd_start,
				            nsdsetup.nsd_end,
				            (CASE
				            	WHEN schedule_employee.is_day_off = 0
				            		THEN
				            			(CASE
				            				WHEN
				            					schedule_employee.is_in = 1 AND schedule_employee.is_out = 1
				            				THEN
				            					(ROUND(TIME_TO_SEC(schedule_employee.break_time) / 60 / 60, 2))
				            				ELSE
				            					0
				            			END)

				            		ELSE
				            			0
				            END) as breaktime,
				            schedule_employee.date,
				            schedule_employee.total,
				            schedule_employee.ot_in,
				            schedule_employee.employee_id,
				            CONCAT(last_name,', ',first_name,' ',middle_name) AS fullname,
				            last_name,
				            ref_department.ref_department_id,
				            employee_list.ecode,
				            emp_rates_duties.hour_per_day,
							(SELECT SUM(COALESCE(break_late,0)) FROM employee_break 
                            	LEFT JOIN schedule_employee sched_emp 
                            		ON sched_emp.schedule_employee_id = employee_break.schedule_employee_id
                            		WHERE sched_emp.employee_id = schedule_employee.employee_id AND sched_emp.pay_period_id = $payperiod) as break_late,
							refpayperiod.pay_period_year                
				    FROM
				        schedule_employee
				    CROSS JOIN nsdsetup
				    LEFT JOIN employee_list ON schedule_employee.employee_id = employee_list.employee_id
				    LEFT JOIN emp_rates_duties ON emp_rates_duties.employee_id = employee_list.employee_id
				    LEFT JOIN ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
				    LEFT JOIN refpayperiod ON schedule_employee.pay_period_id = refpayperiod.pay_period_id
				    LEFT JOIN ref_day_type ON ref_day_type.ref_day_type_id = schedule_employee.ref_day_type_id
				    WHERE
				        schedule_employee.pay_period_id = ".$payperiod."
				            AND schedule_employee.is_deleted = 0
				            AND emp_rates_duties.is_deleted = 0
				            AND emp_rates_duties.active_rates_duties = 1) AS t) AS b) AS sa
				GROUP BY sa.employee_id
				ORDER BY sa.last_name");
    	return $query->result();
    }

    function getscheddtrdetailed($filter_value,$filter_value2) {
        $employee_filter = ($filter_value2 == "all") ? "" : "AND se.employee_id=".$filter_value2;
        $query = $this->db->query("SELECT m.*,GROUP_CONCAT(CONCAT(m.`date`,'=',ROUND(IF(thour=0,0.00,thour),2),' ~ ',ROUND(COALESCE(IF(ottime=0,0.00,ottime) / 60,0.00),2)))as data_serial,
        ROUND(SUM(temp),2) as totalhour,SUM(ROUND(COALESCE(ottime / 60,0.00),2)) as total_ot

        FROM
        (SELECT

            se.employee_id,se.pay_period_id,
            se.sched_refshift_id,se.`date`,
            rp.pay_period_start,rp.pay_period_end,
            CONCAT(el.first_name,' ',el.middle_name,' ',el.last_name) as full_name,
            dept.department,dept.ref_department_id,
        CASE WHEN ( (TIMESTAMPDIFF(MINUTE,clock_in,clock_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				>=
				( (TIMESTAMPDIFF(MINUTE,time_in,time_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				THEN ( (TIMESTAMPDIFF(MINUTE,time_in,time_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				ELSE
				( (TIMESTAMPDIFF(MINUTE,clock_in,clock_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				END as temp,TIMESTAMPDIFF(MINUTE,time_out,ot_out) as ottime,
          GROUP_CONCAT(
				CASE WHEN ( (TIMESTAMPDIFF(MINUTE,clock_in,clock_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				>=
				( (TIMESTAMPDIFF(MINUTE,time_in,time_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				THEN ( (TIMESTAMPDIFF(MINUTE,time_in,time_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				ELSE
				( (TIMESTAMPDIFF(MINUTE,clock_in,clock_out)/60)-(TIME_TO_SEC(break_time) / 60 /60) )
				END

				SEPARATOR ':'
			)

             as thour

        FROM `schedule_employee`

        as se


        INNER JOIN refpayperiod as rp ON rp.pay_period_id=se.pay_period_id
        LEFT JOIN employee_list as el ON el.employee_id=se.employee_id
        LEFT JOIN emp_rates_duties as erd ON erd.employee_id=se.employee_id
        LEFT JOIN ref_department as dept ON dept.ref_department_id=erd.ref_department_id


        WHERE se.is_in=1 AND se.is_out=1 AND  se.is_deleted=0 AND se.pay_period_id=".$filter_value." ".$employee_filter."

        GROUP BY employee_id,se.`date`)as m GROUP BY m.employee_id ORDER BY m.full_name ASC,m.department ASC");

                                return $query->result();

    }

}
?>
