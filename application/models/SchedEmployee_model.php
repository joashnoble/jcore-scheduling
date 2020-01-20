<?php

class SchedEmployee_model extends CORE_Model {
    protected  $table="schedule_employee";
    protected  $pk_id="schedule_employee_id";

    function __construct() {
        parent::__construct();
    }


    function get_shift_daily_schedule($date){
        $query = $this->db->query("SELECT 
                DISTINCT(sched.sched_refshift_id),
                shift.shift,
                TIME_FORMAT(shift.schedule_template_timein, '%h:%i %p') as schedule_template_timein,
                TIME_FORMAT(shift.schedule_template_timeout, '%h:%i %p') as schedule_template_timeout,

                TIME_FORMAT(shift.schedule_template_timein, '%h') as schedule_template_timein_title,
                TIME_FORMAT(shift.schedule_template_timeout, '%h') as schedule_template_timeout_title,

                TIME_FORMAT(shift.schedule_template_timein, '%h %p') as schedule_template_timein_title_hr,
                TIME_FORMAT(shift.schedule_template_timeout, '%h %p') as schedule_template_timeout_title_hr
            FROM
                schedule_employee sched
                LEFT JOIN sched_refshift shift ON shift.sched_refshift_id = sched.sched_refshift_id
                WHERE sched.date = '$date'
                AND sched.is_deleted = FALSE
                ORDER BY schedule_template_timein ASC");
                return $query->result();
    }

 function get_shift_daily_schedule_employee($date,$ref_department_id="all"){
           $query = $this->db->query("SELECT 
                    CONCAT(emp.last_name,
                            ', ',
                            emp.first_name,
                            ' ',
                            emp.middle_name) AS full_name,
                    emp.image_name,

                    shift.shift,

                    TIME_FORMAT(shift.schedule_template_timein, '%h:%i %p') as schedule_template_timein,
                    TIME_FORMAT(shift.schedule_template_timeout, '%h:%i %p') as schedule_template_timeout,

                    TIME_FORMAT(shift.schedule_template_timein, '%h') as schedule_template_timein_title,
                    TIME_FORMAT(shift.schedule_template_timeout, '%h') as schedule_template_timeout_title,

                    TIME_FORMAT(shift.schedule_template_timein, '%h %p') as schedule_template_timein_title_hr,
                    TIME_FORMAT(shift.schedule_template_timeout, '%h %p') as schedule_template_timeout_title_hr,

                    sched.schedule_employee_id,
                    sched.employee_id,
                    sched.pay_period_id,
                    sched.sched_refshift_id,
                    erd.ref_department_id
                FROM
                    schedule_employee sched
                        LEFT JOIN
                    employee_list emp ON emp.employee_id = sched.employee_id
                        LEFT JOIN
                    emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                        LEFT JOIN
                    ref_department dept ON dept.ref_department_id = erd.ref_department_id
                        LEFT JOIN
                    sched_refshift shift ON shift.sched_refshift_id = sched.sched_refshift_id
                WHERE
                    sched.is_deleted = FALSE
                        AND sched.date = '$date'
                        ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
                GROUP BY sched.employee_id
                ORDER BY dept.department ASC , emp.last_name ASC");
                return $query->result();     
    }

    function get_period_schedule_dept($pay_period_id, $ref_department_id="all"){
        $query = $this->db->query("SELECT DISTINCT
            erd.ref_department_id, dept.*
        FROM
            schedule_employee sched
                LEFT JOIN
            employee_list emp ON emp.employee_id = sched.employee_id
                LEFT JOIN
            emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                LEFT JOIN
            ref_department dept ON dept.ref_department_id = erd.ref_department_id
        WHERE
            sched.is_deleted = FALSE
                AND sched.pay_period_id = $pay_period_id
                ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
        ORDER BY department ASC");
        return $query->result();

    }

    function get_period_schedule_date($pay_period_id, $ref_department_id="all"){
        $query = $this->db->query("SELECT 
            CONCAT(emp.last_name,
                        ', ',
                        emp.first_name,
                        ' ',
                        emp.middle_name) AS full_name,
                emp.image_name,
                sched.schedule_employee_id,
                sched.employee_id,
                sched.pay_period_id,
                sched.date,
                sched.is_day_off,
                sched.sched_refshift_id,
                erd.ref_department_id
            FROM
                schedule_employee sched
                    LEFT JOIN
                employee_list emp ON emp.employee_id = sched.employee_id
                    LEFT JOIN
                emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                    LEFT JOIN
                ref_department dept ON dept.ref_department_id = erd.ref_department_id
            WHERE
                sched.is_deleted = FALSE
                    AND sched.pay_period_id = $pay_period_id
                    ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
            ORDER BY dept.department ASC , emp.last_name ASC , sched.date ASC");
            return $query->result();

    }    

    function get_period_schedule($pay_period_id, $ref_department_id="all"){
        $query = $this->db->query("SELECT 
                CONCAT(emp.last_name,
                        ', ',
                        emp.first_name,
                        ' ',
                        emp.middle_name) AS full_name,
                emp.image_name,
                sched.schedule_employee_id,
                sched.employee_id,
                sched.pay_period_id,
                sched.sched_refshift_id,
                erd.ref_department_id
            FROM
                schedule_employee sched
                    LEFT JOIN
                employee_list emp ON emp.employee_id = sched.employee_id
                    LEFT JOIN
                emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                    LEFT JOIN
                ref_department dept ON dept.ref_department_id = erd.ref_department_id
            WHERE
                  sched.is_deleted = FALSE
                  AND sched.pay_period_id = $pay_period_id
                  ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
            GROUP BY sched.employee_id
            ORDER BY dept.department ASC , emp.last_name ASC");
        return $query->result();

    }    

    function get_daily_schedule_dept($date, $ref_department_id="all"){
        $query = $this->db->query("SELECT 
                DISTINCT erd.ref_department_id, 
                dept.*
            FROM
                schedule_employee sched
                LEFT JOIN employee_list emp ON emp.employee_id = sched.employee_id
                LEFT JOIN emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                LEFT JOIN ref_department dept ON dept.ref_department_id = erd.ref_department_id
                WHERE '$date' BETWEEN DATE_FORMAT(time_in,'%Y-%m-%d') AND DATE_FORMAT(time_out,'%Y-%m-%d')
                AND sched.is_deleted = FALSE
                AND sched.is_day_off = FALSE
                ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
                ORDER BY department ASC");
        return $query->result();

    }

 function get_schedule_gantt($employee_id,$from_date,$to_date){
        $query = $this->db->query("SELECT 
    main.*,
    (CASE
        WHEN main.time_12am > 0 THEN '#3aca77'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 00:00:00') BETWEEN main.time_in AND main.time_out THEN '#3aca77'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'zero',
    (CASE
        WHEN main.time_1am > 0 THEN '#38c373'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 01:00:00') BETWEEN main.time_in AND main.time_out THEN '#38c373'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'one',
    (CASE
        WHEN main.time_2am > 0 THEN '#36bc6e'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 02:00:00') BETWEEN main.time_in AND main.time_out THEN '#36bc6e'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'two',
    (CASE
        WHEN main.time_3am > 0 THEN '#33b66b'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 03:00:00') BETWEEN main.time_in AND main.time_out THEN '#33b66b'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'three',
    (CASE
        WHEN main.time_4am > 0 THEN '#32b067'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 04:00:00') BETWEEN main.time_in AND main.time_out THEN '#32b067'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'four',
    (CASE
        WHEN main.time_5am > 0 THEN '#31aa64'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 05:00:00') BETWEEN main.time_in AND main.time_out THEN '#31aa64'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'five',
    (CASE
        WHEN main.time_6am > 0 THEN '#2fa561'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 06:00:00') BETWEEN main.time_in AND main.time_out THEN '#2fa561'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'six',
    (CASE
        WHEN main.time_7am > 0 THEN '#2da05e'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 07:00:00') BETWEEN main.time_in AND main.time_out THEN '#2da05e'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'seven',
    (CASE
        WHEN main.time_8am > 0 THEN '#2c9c5b'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 08:00:00') BETWEEN main.time_in AND main.time_out THEN '#2c9c5b'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'eight',
    (CASE
        WHEN main.time_9am > 0 THEN '#2b9859'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 09:00:00') BETWEEN main.time_in AND main.time_out THEN '#2b9859'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'nine',
    (CASE
        WHEN main.time_10am > 0 THEN '#289155'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 10:00:00') BETWEEN main.time_in AND main.time_out THEN '#289155'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'ten',
    (CASE
        WHEN main.time_11am > 0 THEN '#289054'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 11:00:00') BETWEEN main.time_in AND main.time_out THEN '#289054'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'eleven',
    (CASE
        WHEN main.time_12nn > 0 THEN '#278b51'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 12:00:00') BETWEEN main.time_in AND main.time_out THEN '#278b51'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'twelve',
    (CASE
        WHEN main.time_13pm > 0 THEN '#25844d'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 13:00:00') BETWEEN main.time_in AND main.time_out THEN '#25844d'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'thirteen',
    (CASE
        WHEN main.time_14pm > 0 THEN '#24804b'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 14:00:00') BETWEEN main.time_in AND main.time_out THEN '#24804b'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'fourteen',
    (CASE
        WHEN main.time_15pm > 0 THEN '#227a47'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 15:00:00') BETWEEN main.time_in AND main.time_out THEN '#227a47'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'fifteen',
    (CASE
        WHEN main.time_16pm > 0 THEN '#217544'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 16:00:00') BETWEEN main.time_in AND main.time_out THEN '#217544'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'sixteen',
    (CASE
        WHEN main.time_17pm > 0 THEN '#1f7142'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 17:00:00') BETWEEN main.time_in AND main.time_out THEN '#1f7142'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'seventeen',
    (CASE
        WHEN main.time_18pm > 0 THEN '#1e6c3f'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 18:00:00') BETWEEN main.time_in AND main.time_out THEN '#1e6c3f'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'eighteen',
    (CASE
        WHEN main.time_19pm > 0 THEN '#1c663b'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 19:00:00') BETWEEN main.time_in AND main.time_out THEN '#1c663b'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'nineteen',
    (CASE
        WHEN main.time_20pm > 0 THEN '#1b6239'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 20:00:00') BETWEEN main.time_in AND main.time_out THEN '#1b6239'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'twenty',
    (CASE
        WHEN main.time_21pm > 0 THEN '#1a5d36'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 21:00:00') BETWEEN main.time_in AND main.time_out THEN '#1a5d36'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'twentyone',
    (CASE
        WHEN main.time_22pm > 0 THEN '#195934'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 22:00:00') BETWEEN main.time_in AND main.time_out THEN '#195934'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'twentytwo',
    (CASE
        WHEN main.time_23pm > 0 THEN '#175330'
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN '#E5FFE5'
            ELSE (CASE
                WHEN CONCAT(main.date, ' 23:00:00') BETWEEN main.time_in AND main.time_out THEN '#175330'
                ELSE '#FFFFFF'
            END)
        END)
    END) AS 'twentythree',






    (CASE
        WHEN main.time_12am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 00:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'zero_hidden',
    (CASE
        WHEN main.time_1am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 01:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'one_hidden',
    (CASE
        WHEN main.time_2am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 02:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'two_hidden',
    (CASE
        WHEN main.time_3am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 03:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'three_hidden',
    (CASE
        WHEN main.time_4am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 04:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'four_hidden',
    (CASE
        WHEN main.time_5am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 05:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'five_hidden',
    (CASE
        WHEN main.time_6am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 06:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'six_hidden',
    (CASE
        WHEN main.time_7am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 07:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'seven_hidden',
    (CASE
        WHEN main.time_8am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 08:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'eight_hidden',
    (CASE
        WHEN main.time_9am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 09:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'nine_hidden',
    (CASE
        WHEN main.time_10am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 10:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'ten_hidden',
    (CASE
        WHEN main.time_11am > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 11:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'eleven_hidden',
    (CASE
        WHEN main.time_12nn > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 12:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'twelve_hidden',
    (CASE
        WHEN main.time_13pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 13:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'thirteen_hidden',
    (CASE
        WHEN main.time_14pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 14:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'fourteen_hidden',
    (CASE
        WHEN main.time_15pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 15:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'fifteen_hidden',
    (CASE
        WHEN main.time_16pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 16:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'sixteen_hidden',
    (CASE
        WHEN main.time_17pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 17:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'seventeen_hidden',
    (CASE
        WHEN main.time_18pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 18:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'eighteen_hidden',
    (CASE
        WHEN main.time_19pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 19:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'nineteen_hidden',
    (CASE
        WHEN main.time_20pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 20:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'twenty_hidden',
    (CASE
        WHEN main.time_21pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 21:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'twentyone_hidden',
    (CASE
        WHEN main.time_22pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 22:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'twentytwo_hidden',
    (CASE
        WHEN main.time_23pm > 0 THEN ''
        ELSE (CASE
            WHEN main.is_day_off = 1 THEN ''
            ELSE (CASE
                WHEN CONCAT(main.date, ' 23:00:00') BETWEEN main.time_in AND main.time_out THEN ''
                ELSE 'hidden'
            END)
        END)
    END) AS 'twentythree_hidden'


FROM
    (SELECT 
        sched.schedule_employee_id,
            sched.employee_id,
            sched.pay_period_id,
            sched.sched_refshift_id,
            sched.time_in,
            sched.time_out,
            sched.date,
            sched.day,
            sched.is_day_off,
            type.daytype,
            type.ref_day_type_id,
            CONCAT(emp.last_name,
                        ', ',
                        emp.first_name,
                        ' ',
                        emp.middle_name) AS full_name,
            emp.image_name,
            shift.shift,
            TIME_FORMAT(shift.schedule_template_timein, '%h:%i %p') as schedule_template_timein,
            TIME_FORMAT(shift.schedule_template_timeout, '%h:%i %p') as schedule_template_timeout,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 00:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_12am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 01:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_1am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 02:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_2am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 03:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_3am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 04:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_4am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 05:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_5am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 06:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_6am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 07:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_7am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 08:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_8am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 09:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_9am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 10:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_10am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 11:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_11am,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 12:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_12nn,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 13:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_13pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 14:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_14pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 15:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_15pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 16:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_16pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 17:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_17pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 18:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_18pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 19:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_19pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 20:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_20pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 21:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_21pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 22:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_22pm,
            (SELECT 
                    COUNT(*)
                FROM
                    schedule_employee
                WHERE
                    employee_id = sched.employee_id
                        AND CONCAT(sched.date, ' 23:00:00') BETWEEN time_in AND time_out
                        AND is_deleted = 0
                        AND is_day_off = 0
                        AND date != sched.date) AS time_23pm
    FROM
        schedule_employee sched
        LEFT JOIN employee_list emp ON emp.employee_id = sched.employee_id
        LEFT JOIN sched_refshift shift ON shift.sched_refshift_id = sched.sched_refshift_id
        LEFT JOIN ref_day_type type ON type.ref_day_type_id = sched.ref_day_type_id
    WHERE
        sched.employee_id = $employee_id
            AND (sched.date BETWEEN '$from_date' AND '$to_date')
            AND sched.is_deleted = FALSE
    ORDER BY sched.date ASC) AS main");
        return $query->result();
    }


    function get_daily_schedule($date,$ref_department_id="all"){
        $query = $this->db->query("SELECT 
                CONCAT(emp.last_name,', ',emp.first_name,' ',emp.middle_name) as full_name,
                emp.image_name,
                sched.schedule_employee_id,
                sched.employee_id,
                sched.pay_period_id,
                sched.sched_refshift_id,
                sched.time_in,
                sched.time_out,
                sched.date,
                erd.ref_department_id,
                shift.shift,
                TIME_FORMAT(shift.schedule_template_timein, '%h:%i %p') as schedule_template_timein,
                TIME_FORMAT(shift.schedule_template_timeout, '%h:%i %p') as schedule_template_timeout,
                (CASE
                    WHEN '$date 00:00:00' BETWEEN time_in AND time_Out
                        THEN '#3aca77'
                        ELSE '#FFFFFF'
                END) as 'zero',                  
                (CASE
                    WHEN '$date 01:00:00' BETWEEN time_in AND time_Out
                        THEN '#38c373'
                        ELSE '#FFFFFF'
                END) as 'one',
                (CASE
                    WHEN '$date 02:00:00' BETWEEN time_in AND time_Out
                        THEN '#36bc6e'
                        ELSE '#FFFFFF'
                END) as 'two',                
                (CASE
                    WHEN '$date 03:00:00' BETWEEN time_in AND time_Out
                        THEN '#33b66b'
                        ELSE '#FFFFFF'
                END) as 'three',  
                (CASE
                    WHEN '$date 04:00:00' BETWEEN time_in AND time_Out
                        THEN '#32b067'
                        ELSE '#FFFFFF'
                END) as 'four',
                (CASE
                    WHEN '$date 05:00:00' BETWEEN time_in AND time_Out
                        THEN '#31aa64'
                        ELSE '#FFFFFF'
                END) as 'five',
                (CASE
                    WHEN '$date 06:00:00' BETWEEN time_in AND time_Out
                        THEN '#2fa561'
                        ELSE '#FFFFFF'
                END) as 'six',                  
                (CASE
                    WHEN '$date 07:00:00' BETWEEN time_in AND time_Out
                        THEN '#2da05e'
                        ELSE '#FFFFFF'
                END) as 'seven',  
                (CASE
                    WHEN '$date 08:00:00' BETWEEN time_in AND time_Out
                        THEN '#2c9c5b'
                        ELSE '#FFFFFF'
                END) as 'eight',  
                (CASE
                    WHEN '$date 09:00:00' BETWEEN time_in AND time_Out
                        THEN '#2b9859'
                        ELSE '#FFFFFF'
                END) as 'nine',  
                (CASE
                    WHEN '$date 10:00:00' BETWEEN time_in AND time_Out
                        THEN '#289155'
                        ELSE '#FFFFFF'
                END) as 'ten',  
                (CASE
                    WHEN '$date 11:00:00' BETWEEN time_in AND time_Out
                        THEN '#289054'
                        ELSE '#FFFFFF'
                END) as 'eleven',  
                (CASE
                    WHEN '$date 12:00:00' BETWEEN time_in AND time_Out
                        THEN '#278b51'
                        ELSE '#FFFFFF'
                END) as 'twelve',  
                (CASE
                    WHEN '$date 13:00:00' BETWEEN time_in AND time_Out
                        THEN '#25844d'
                        ELSE '#FFFFFF'
                END) as 'thirteen',   
                (CASE
                    WHEN '$date 14:00:00' BETWEEN time_in AND time_Out
                        THEN '#24804b'
                        ELSE '#FFFFFF'
                END) as 'fourteen',   
                (CASE
                    WHEN '$date 15:00:00' BETWEEN time_in AND time_Out
                        THEN '#227a47'
                        ELSE '#FFFFFF'
                END) as 'fifteen', 
                (CASE
                    WHEN '$date 16:00:00' BETWEEN time_in AND time_Out
                        THEN '#217544'
                        ELSE '#FFFFFF'
                END) as 'sixteen', 
                (CASE
                    WHEN '$date 17:00:00' BETWEEN time_in AND time_Out
                        THEN '#1f7142'
                        ELSE '#FFFFFF'
                END) as 'seventeen', 
                (CASE
                    WHEN '$date 18:00:00' BETWEEN time_in AND time_Out
                        THEN '#1e6c3f'
                        ELSE '#FFFFFF'
                END) as 'eighteen', 
                (CASE
                    WHEN '$date 19:00:00' BETWEEN time_in AND time_Out
                        THEN '#1c663b'
                        ELSE '#FFFFFF'
                END) as 'nineteen', 
                (CASE
                    WHEN '$date 20:00:00' BETWEEN time_in AND time_Out
                        THEN '#1b6239'
                        ELSE '#FFFFFF'
                END) as 'twenty',
                (CASE
                    WHEN '$date 21:00:00' BETWEEN time_in AND time_Out
                        THEN '#1a5d36'
                        ELSE '#FFFFFF'
                END) as 'twentyone',
                (CASE
                    WHEN '$date 22:00:00' BETWEEN time_in AND time_Out
                        THEN '#195934'
                        ELSE '#FFFFFF'
                END) as 'twentytwo',
                (CASE
                    WHEN '$date 23:00:00' BETWEEN time_in AND time_Out
                        THEN '#175330'
                        ELSE '#FFFFFF'
                END) as 'twentythree',        



                (CASE
                    WHEN '$date 00:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'zero_border',                  
                (CASE
                    WHEN '$date 01:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'one_border',
                (CASE
                    WHEN '$date 02:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'two_border',                
                (CASE
                    WHEN '$date 03:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'three_border',  
                (CASE
                    WHEN '$date 04:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'four_border',
                (CASE
                    WHEN '$date 05:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'five_border',
                (CASE
                    WHEN '$date 06:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'six_border',                  
                (CASE
                    WHEN '$date 07:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'seven_border',  
                (CASE
                    WHEN '$date 08:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'eight_border',  
                (CASE
                    WHEN '$date 09:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'nine_border',  
                (CASE
                    WHEN '$date 10:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'ten_border',  
                (CASE
                    WHEN '$date 11:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'eleven_border',  
                (CASE
                    WHEN '$date 12:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'twelve_border',  
                (CASE
                    WHEN '$date 13:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'thirteen_border',   
                (CASE
                    WHEN '$date 14:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'fourteen_border',   
                (CASE
                    WHEN '$date 15:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'fifteen_border', 
                (CASE
                    WHEN '$date 16:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'sixteen_border', 
                (CASE
                    WHEN '$date 17:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'seventeen_border', 
                (CASE
                    WHEN '$date 18:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'eighteen_border', 
                (CASE
                    WHEN '$date 19:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'nineteen_border', 
                (CASE
                    WHEN '$date 20:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'twenty_border',
                (CASE
                    WHEN '$date 21:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'twentyone_border',
                (CASE
                    WHEN '$date 22:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'twentytwo_border',
                (CASE
                    WHEN '$date 23:00:00' BETWEEN time_in AND time_Out
                        THEN '#27ae60'
                        ELSE '#C8C8C8'
                END) as 'twentythree_border',


                (CASE
                    WHEN '$date 00:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'zero_border_px',                  
                (CASE
                    WHEN '$date 01:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'one_border_px',
                (CASE
                    WHEN '$date 02:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'two_border_px',                
                (CASE
                    WHEN '$date 03:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'three_border_px',  
                (CASE
                    WHEN '$date 04:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'four_border_px',
                (CASE
                    WHEN '$date 05:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'five_border_px',
                (CASE
                    WHEN '$date 06:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'six_border_px',                  
                (CASE
                    WHEN '$date 07:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'seven_border_px',  
                (CASE
                    WHEN '$date 08:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'eight_border_px',  
                (CASE
                    WHEN '$date 09:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'nine_border_px',
                (CASE
                    WHEN '$date 10:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'ten_border_px',
                (CASE
                    WHEN '$date 11:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'eleven_border_px',
                (CASE
                    WHEN '$date 12:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'twelve_border_px',
                (CASE
                    WHEN '$date 13:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'thirteen_border_px', 
                (CASE
                    WHEN '$date 14:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'fourteen_border_px', 
                (CASE
                    WHEN '$date 15:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'fifteen_border_px', 
                (CASE
                    WHEN '$date 16:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'sixteen_border_px', 
                (CASE
                    WHEN '$date 17:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'seventeen_border_px', 
                (CASE
                    WHEN '$date 18:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'eighteen_border_px', 
                (CASE
                    WHEN '$date 19:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'nineteen_border_px', 
                (CASE
                    WHEN '$date 20:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'twenty_border_px',
                (CASE
                    WHEN '$date 21:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'twentyone_border_px',
                (CASE
                    WHEN '$date 22:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'twentytwo_border_px',
                (CASE
                    WHEN '$date 23:00:00' BETWEEN time_in AND time_Out
                        THEN '0px'
                        ELSE '1px'
                END) as 'twentythree_border_px',

                (CASE
                    WHEN '$date 00:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'zero_hidden',                  
                (CASE
                    WHEN '$date 01:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'one_hidden',
                (CASE
                    WHEN '$date 02:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'two_hidden',                
                (CASE
                    WHEN '$date 03:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'three_hidden',  
                (CASE
                    WHEN '$date 04:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'four_hidden',
                (CASE
                    WHEN '$date 05:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'five_hidden',
                (CASE
                    WHEN '$date 06:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'six_hidden',                  
                (CASE
                    WHEN '$date 07:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'seven_hidden',  
                (CASE
                    WHEN '$date 08:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'eight_hidden',  
                (CASE
                    WHEN '$date 09:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'nine_hidden',  
                (CASE
                    WHEN '$date 10:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'ten_hidden',  
                (CASE
                    WHEN '$date 11:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'eleven_hidden',  
                (CASE
                    WHEN '$date 12:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'twelve_hidden',  
                (CASE
                    WHEN '$date 13:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'thirteen_hidden',   
                (CASE
                    WHEN '$date 14:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'fourteen_hidden',   
                (CASE
                    WHEN '$date 15:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'fifteen_hidden', 
                (CASE
                    WHEN '$date 16:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'sixteen_hidden', 
                (CASE
                    WHEN '$date 17:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'seventeen_hidden', 
                (CASE
                    WHEN '$date 18:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'eighteen_hidden', 
                (CASE
                    WHEN '$date 19:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'nineteen_hidden', 
                (CASE
                    WHEN '$date 20:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'twenty_hidden',
                (CASE
                    WHEN '$date 21:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'twentyone_hidden',
                (CASE
                    WHEN '$date 22:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'twentytwo_hidden',
                (CASE
                    WHEN '$date 23:00:00' BETWEEN time_in AND time_Out
                        THEN ''
                        ELSE 'hidden'
                END) as 'twentythree_hidden'                                  


            FROM
                schedule_employee sched
                LEFT JOIN employee_list emp ON emp.employee_id = sched.employee_id
                LEFT JOIN emp_rates_duties erd ON erd.emp_rates_duties_id = emp.emp_rates_duties_id
                LEFT JOIN ref_department dept ON dept.ref_department_id = erd.ref_department_id
                LEFT JOIN sched_refshift shift ON shift.sched_refshift_id = sched.sched_refshift_id
                WHERE '".$date."' BETWEEN DATE_FORMAT(time_in,'%Y-%m-%d') AND DATE_FORMAT(time_out,'%Y-%m-%d')
                AND sched.is_deleted = FALSE
                AND sched.is_day_off = FALSE
                ".($ref_department_id=="all"?"":" AND erd.ref_department_id = $ref_department_id ")."
                GROUP BY sched.employee_id
                ORDER BY dept.department ASC, sched.time_in ASC, emp.last_name ASC");
                return $query->result();

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
                    CASE
                        WHEN schedule_employee.clock_in > (DATE_ADD(schedule_employee.time_in, INTERVAL schedule_employee.grace_period minute))
                            THEN 
                                (CASE
                                    WHEN
                                        COALESCE(TIMESTAMPDIFF(MINUTE, schedule_employee.time_in,schedule_employee.clock_in),0) > 0
                                    THEN COALESCE(TIMESTAMPDIFF(MINUTE, schedule_employee.time_in,schedule_employee.clock_in),0)
                                    ELSE 0.00
                                END)
                        ELSE 0.00
                    END AS perlate,
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
                                            schedule_employee.time_out) / 60),
                                        2)) >= (ROUND((TIMESTAMPDIFF(MINUTE,
                                            schedule_employee.time_in,
                                            schedule_employee.time_out) / 60),
                                        2))
                            THEN
                                (ROUND((TIMESTAMPDIFF(MINUTE,
                                            schedule_employee.time_in,
                                            schedule_employee.time_out) / 60),
                                        2))
                            ELSE (ROUND((TIMESTAMPDIFF(MINUTE,
                                        schedule_employee.clock_in,
                                        schedule_employee.time_out) / 60),
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
