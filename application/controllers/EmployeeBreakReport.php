<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeBreakReport extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_employeebreakreport_view') == 0 || $this->session->userdata('right_employeebreakreport_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->model('Employee_model');
        $this->load->model('SchedEmployee_model');
        $this->load->model('Employee_break_model');
        $this->load->model('GeneralSettings_model');
        $this->load->model('RefPayPeriod_model');
    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['payperiods'] = $this->RefPayPeriod_model->get_list('refpayperiod.is_deleted=0','refpayperiod.*, CONCAT(pay_period_start," ~ ",pay_period_end) as period',null,'pay_period_start DESC');
        $data['employee'] = $this->Employee_model->get_list('employee_list.is_deleted=0 AND employee_list.is_retired=0 AND employee_list.status = "Active"','employee_list.employee_id,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name, employee_list.ecode',null,'full_name ASC');
        $data['title'] = 'Employee Break Report';

        $this->load->view('employee_break_report_view', $data);
    }


    function schedule($transaction=null,$filter_value=null,$filter_value2=null,$type=null){

        switch($transaction){


            case 'employee-break-report':
                  $m_payperiod = $this->RefPayPeriod_model;
                  $getcompany=$this->GeneralSettings_model->get_list(
                  null,
                  'company_setup.*'
                  );
                  $data['company']=$getcompany[0];

                  $employee_id = $this->input->post("employee_id",TRUE);
                  $pay_period_id = $this->input->post("pay_period_id",TRUE);
                  $stat = $this->input->post("stat",TRUE);

                  $data['start_date'] = date("m/d/Y", strtotime($this->input->post("start_date",TRUE)));
                  $data['end_date'] = date("m/d/Y", strtotime($this->input->post("end_date",TRUE)));

                  $start_date = date("Y-m-d", strtotime($this->input->post("start_date",TRUE)));
                  $end_date = date("Y-m-d", strtotime($this->input->post("end_date",TRUE)));

                  $data['period'] = "";

                  if ($stat == 1){
                    $period = $m_payperiod->get_list($pay_period_id);
                    $pay_period_start = date("m/d/Y", strtotime($period[0]->pay_period_start));
                    $pay_period_end = date("m/d/Y", strtotime($period[0]->pay_period_end));
                    $data['period'] = $pay_period_start." to ".$pay_period_end;
                  }else{
                    $data['period'] = $data['start_date']." to ".$data['end_date'];
                  }

                  $data['emp_info']=$this->Employee_model->get_list(
                    'employee_list.employee_id='.$employee_id,
                    'employee_list.*,CONCAT(employee_list.first_name," ",employee_list.middle_name," ",employee_list.last_name) as full_name
                    ,ref_branch.branch,ref_department.department',
                    array(
                        array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                        array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
                        array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        )
                    );


                  $data['emp_break_report'] = $this->Employee_break_model->get_employee($employee_id,$start_date,$end_date,$stat,$pay_period_id);
                  $response = $this->load->view('template/employee_break_report_html',$data,TRUE);
                  echo json_encode($response);
            break;


            // case 'emp_actual_time':
            //   $getcompany=$this->GeneralSettings_model->get_list(
            //   null,
            //   'company_setup.*'
            //   );
            //   $data['company']=$getcompany[0];
            //   $data['emp_info']=$this->Employee_model->get_list(
            //                 'employee_list.employee_id='.$filter_value,
            //                 'employee_list.*,CONCAT(employee_list.first_name," ",employee_list.middle_name," ",employee_list.last_name) as full_name
            //                 ,ref_branch.branch,ref_department.department',
            //                 array(
            //                     array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
            //                     array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
            //                     array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
            //                     )
            //                 );

            //   $data['payperiod']=$this->RefPayPeriod_model->get_list(
            //                 'pay_period_id='.$filter_value2,
            //                 'CONCAT(pay_period_start," ~ ",pay_period_end) as pay_period'
            //   );

            //   $data['emp_sched_report']=$this->SchedEmployee_model->get_list(
            //       'schedule_employee.is_deleted=0 AND schedule_employee.employee_id='.$filter_value.' AND schedule_employee.pay_period_id='.$filter_value2.' ',
            //       'schedule_employee.*,sched_refpay.schedpay,sched_refshift.shift,CONCAT(employee_list.first_name," ",employee_list.middle_name," ",employee_list.last_name) as full_name, employee_list.ecode,ref_day_type.daytype,
            //             COALESCE(TIMESTAMPDIFF(MINUTE, schedule_employee.time_in, schedule_employee.clock_in)) as perlate',
            //       array(
            //           array('sched_refpay','sched_refpay.sched_refpay_id=schedule_employee.sched_refpay_id','left'),
            //           array('sched_refshift','sched_refshift.sched_refshift_id=schedule_employee.sched_refshift_id','left'),
            //           array('employee_list','employee_list.employee_id=schedule_employee.employee_id','left'),
            //           array('ref_day_type','ref_day_type.ref_day_type_id=schedule_employee.ref_day_type_id','left'),
            //           ),
            //       'schedule_employee.date ASC'
            //       );

            //     echo $this->load->view('template/employee_actual_time_html',$data,TRUE);
            // break;
        }
    }

}
