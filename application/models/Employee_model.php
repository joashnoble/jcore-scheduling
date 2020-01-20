<?php

class Employee_model extends CORE_Model {
    protected  $table="employee_list";
    protected  $pk_id="employee_id";

    function __construct() {
        parent::__construct();
    }

    function getschedemployee($status){
         $query = $this->db->query("SELECT 
                    employee_list.*,
                    CONCAT(employee_list.first_name,
                            ' ',
                            employee_list.middle_name,
                            ' ',
                            employee_list.last_name) AS full_name,
                    ref_branch.branch,
                    ref_department.department
                FROM
                    employee_list
                        LEFT JOIN
                    emp_rates_duties ON emp_rates_duties.emp_rates_duties_id = employee_list.emp_rates_duties_id
                        LEFT JOIN
                    ref_branch ON ref_branch.ref_branch_id = emp_rates_duties.ref_branch_id
                        LEFT JOIN
                    ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
                WHERE
                    employee_list.is_deleted = 0
                    ".($status==0?"":" AND employee_list.is_retired=0 AND employee_list.status = 'Active' ")."
                ORDER BY employee_list.last_name, ref_department.department ASC");
                return $query->result();
    }

    function getcountemployee() {
        $query = $this->db->query('SELECT COUNT(employee_list.employee_id) as total_employee FROM employee_list
                                LEFT join emp_rates_duties ON
                                employee_list.employee_id=emp_rates_duties.employee_id
                                 WHERE employee_list.is_deleted=0 AND active_rates_duties=TRUE');
                            $query->result();

                          return $query->result();
    }

    function check_code($ecode) {
        $query = $this->db->query('SELECT 
                COUNT(employee_list.employee_id) AS cecode,
                employee_list.employee_id,
                employee_list.ecode,
                employee_list.image_name,
                employee_list.status,
                CONCAT(employee_list.first_name,
                        " ",
                        middle_name,
                        " ",
                        employee_list.last_name) AS full_name,
                ref_department.department,
                ref_position.position,
                ref_branch.branch,
                emp_rates_duties.ref_payment_type_id
            FROM
                employee_list
                    LEFT JOIN
                emp_rates_duties ON employee_list.employee_id = emp_rates_duties.employee_id
                    LEFT JOIN
                ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
                    LEFT JOIN
                ref_position ON ref_position.ref_position_id = emp_rates_duties.ref_position_id
                    LEFT JOIN
                ref_branch ON ref_branch.ref_branch_id = emp_rates_duties.ref_branch_id
            WHERE
                employee_list.is_deleted = 0
                    AND active_rates_duties = TRUE
                    AND employee_list.ecode = '.$ecode.'
                    AND employee_list.is_retired = 0');
                            $query->result();
                          return $query->result();
    }

    function get_employee_info($employee_id){
                $query = $this->db->query('SELECT 
                COUNT(employee_list.employee_id) AS cecode,
                employee_list.employee_id,
                employee_list.ecode,
                employee_list.image_name,
                employee_list.status,
                CONCAT(employee_list.first_name,
                        " ",
                        middle_name,
                        " ",
                        employee_list.last_name) AS full_name,
                ref_department.department,
                ref_position.position,
                ref_branch.branch,
                emp_rates_duties.ref_payment_type_id
            FROM
                employee_list
                    LEFT JOIN
                emp_rates_duties ON employee_list.employee_id = emp_rates_duties.employee_id
                    LEFT JOIN
                ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
                    LEFT JOIN
                ref_position ON ref_position.ref_position_id = emp_rates_duties.ref_position_id
                    LEFT JOIN
                ref_branch ON ref_branch.ref_branch_id = emp_rates_duties.ref_branch_id
            WHERE
                employee_list.is_deleted = 0
                    AND active_rates_duties = TRUE
                    AND employee_list.employee_id = '.$employee_id.'
                    AND employee_list.is_retired = 0');
                            $query->result();
                          return $query->result();
    }

    function check_pin($employee_id, $pin){
        $query = $this->db->query("SELECT attempt FROM employee_list WHERE employee_id = $employee_id AND pin_number = '".$pin."'");
        $query->result();
        return $query->result();
    }

    function check_pin_number($pin_number){
        $query = $this->db->query('SELECT pin_number FROM employee_list WHERE pin_number ='.$pin_number);
        $query->result();
        return $query->result();
    }

    function getExpiringPersonnel($type,$type2,$month,$year){
        $query = $this->db->query("SELECT 
                CONCAT(emp_list.first_name,
                        ' ',
                        emp_list.middle_name,
                        '',
                        emp_list.last_name) AS fullname,
                DATE_FORMAT(emp_rates.date_start, '%m/%d/%Y') AS date_hired,
                DATE_FORMAT(emp_rates.date_end, '%m/%d/%Y') AS date_expire,
                dept.department
            FROM
                employee_list AS emp_list
                    LEFT JOIN
                emp_rates_duties AS emp_rates ON emp_rates.employee_id = emp_list.employee_id
                    LEFT JOIN
                ref_department AS dept ON dept.ref_department_id = emp_rates.ref_department_id
            WHERE
                emp_list.is_deleted = 0
                    AND emp_list.is_retired = 0
                    AND emp_rates.active_rates_duties = 1
                    AND emp_rates.is_deleted = 0
                    
                 ".($type=='week'?" 
                    AND emp_rates.date_end BETWEEN 
                        DATE(NOW() + INTERVAL (1 - DAYOFWEEK(NOW())) DAY) AND 
                        DATE(NOW() + INTERVAL (7 - DAYOFWEEK(NOW())) DAY)
                 ":" 
                    ".($type2 == 1 ? " 
                        AND 
                            MONTH(emp_rates.date_end) = MONTH(CURRENT_DATE())
                        AND
                            YEAR(emp_rates.date_end) = YEAR(CURRENT_DATE())
                    ":"
                        AND 
                            MONTH(emp_rates.date_end) = $month
                        AND 
                            YEAR(emp_rates.date_end) = $year
                    ")."
                 ")."
                ");

        $query->result();
        return $query->result();
    }

    function empcountperdept() {
        $query = $this->db->query('SELECT COUNT(ref_department.ref_department_id) as totalperdept,ref_department.department FROM employee_list
        LEFT JOIN emp_rates_duties ON
        emp_rates_duties.employee_id=employee_list.employee_id
        LEFT JOIN ref_department ON
        ref_department.ref_department_id=emp_rates_duties.ref_department_id
        WHERE active_rates_duties=1 AND employee_list.is_deleted=0
        GROUP BY ref_department.ref_department_id');
        $query->result();
        return $query->result();
    }

    function get_bday($month){
        $query = $this->db->query('SELECT 
                CONCAT(emplist.first_name," ",emplist.middle_name," ",emplist.last_name) as fullname,
                emplist.birthdate,dept.department 
                FROM employee_list as emplist 
                LEFT JOIN emp_rates_duties as emp_rd ON
                emp_rd.emp_rates_duties_id = emplist.emp_rates_duties_id
                LEFT JOIN ref_department as dept ON
                dept.ref_department_id = emp_rd.ref_department_id
                WHERE EXTRACT(MONTH FROM emplist.birthdate) = '.$month.' 
                AND emplist.is_deleted = 0 AND emplist.is_retired = 0');
        $query->result();
        return $query->result();
    }

    function empcountperbranch() {
        $query = $this->db->query('SELECT COUNT(ref_branch.ref_branch_id) as totalperbranch,ref_branch.branch FROM employee_list
        LEFT JOIN emp_rates_duties ON
        emp_rates_duties.employee_id=employee_list.employee_id
        LEFT JOIN ref_branch ON
        ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id
        WHERE active_rates_duties=1 AND employee_list.is_deleted=0
        GROUP BY ref_branch.ref_branch_id');
        $query->result();
        return $query->result();
    }

    function dashmonthlygross() {
        $year = date('Y');
        $query = $this->db->query("SELECT 
                (CASE
                    WHEN refpayperiod.month_id = '1' THEN '00'
                    WHEN refpayperiod.month_id = '2' THEN '01'
                    WHEN refpayperiod.month_id = '3' THEN '02'
                    WHEN refpayperiod.month_id = '4' THEN '03'
                    WHEN refpayperiod.month_id = '5' THEN '04'
                    WHEN refpayperiod.month_id = '6' THEN '05'
                    WHEN refpayperiod.month_id = '7' THEN '06'
                    WHEN refpayperiod.month_id = '8' THEN '07'
                    WHEN refpayperiod.month_id = '9' THEN '08'
                    WHEN refpayperiod.month_id = '10' THEN '09'
                    WHEN refpayperiod.month_id = '11' THEN '10'
                    WHEN refpayperiod.month_id = '12' THEN '11'
                END) AS Month,
            ROUND(SUM(pay_slip.gross_pay), 2) AS reg_pay,
            ROUND(SUM(pay_slip.net_pay), 2) AS net_pay
    FROM
        pay_slip
    LEFT JOIN daily_time_record ON daily_time_record.dtr_id = pay_slip.dtr_id
    LEFT JOIN emp_rates_duties ON emp_rates_duties.employee_id = daily_time_record.employee_id
    LEFT JOIN ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
    LEFT JOIN refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
    LEFT JOIN months ON months.month_id = refpayperiod.month_id
        WHERE refpayperiod.pay_period_year = ".$year."
        GROUP BY refpayperiod.month_id");
        $query->result();
        return $query->result();
    }

    function dashcompensationdept() {
        $year = date('Y');
        $query = $this->db->query("SELECT 
                ref_department.department,
                    ROUND(SUM(pay_slip.gross_pay), 2) AS reg_pay,
                    ROUND(SUM(pay_slip.net_pay), 2) AS net_pay
            FROM
                pay_slip
            LEFT JOIN daily_time_record ON daily_time_record.dtr_id = pay_slip.dtr_id
            LEFT JOIN refpayperiod ON refpayperiod.pay_period_id = daily_time_record.pay_period_id
            LEFT JOIN emp_rates_duties ON emp_rates_duties.employee_id = daily_time_record.employee_id
            LEFT JOIN ref_department ON ref_department.ref_department_id = emp_rates_duties.ref_department_id
            WHERE
                refpayperiod.pay_period_year = ".$year."
            GROUP BY ref_department.ref_department_id");
        $query->result();
        return $query->result();
    }

      function send_mail($email,$message,$subject,$company_email,$email_password,$company_name)
      {     
        $emailConfig = array('protocol' => 'smtp', 
        'smtp_host' => 'ssl://smtp.googlemail.com', 
        'smtp_port' => 465, 
        'smtp_user' => $company_email, 
        'smtp_pass' => $email_password, 
        'mailtype' => 'html', 
        'charset' => 'iso-8859-1');

        $this->load->library('email', $emailConfig);
        $this->email->set_newline("\r\n");
        $this->email->from($company_email, $company_name);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();
      }
}
?>
