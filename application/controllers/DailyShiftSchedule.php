<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyShiftSchedule extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_daily_shift_schedule_view') == 0 || $this->session->userdata('right_daily_shift_schedule_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->model('Employee_model');
        $this->load->model('SchedEmployee_model');
        $this->load->model('RefSchedPay_model');
        $this->load->model('SchedRefShift_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('SchedDemography_model');
        $this->load->model('GeneralSettings_model');
        $this->load->model('RefDepartment_model');

        $this->load->library('M_pdf');

    }
    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        $data['_top_navigation'] = $this->load->view('template/elements/top_navigation', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['employee'] = $this->Employee_model->get_list('employee_list.is_deleted=0','employee_list.employee_id,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name',null,'full_name ASC');

        $data['departments'] = $this->RefDepartment_model->get_department_list();
        $data['payperiod'] = $this->RefPayPeriod_model->get_list('refpayperiod.is_deleted=0','refpayperiod.*, CONCAT(pay_period_start," ~ ",pay_period_end) as period',null,'pay_period_start DESC');

        $data['title'] = 'Daily Shift Schedule';

        $this->load->view('daily_shift_schedule_view', $data);
    }


    function schedule($transaction=null,$filter_value=null,$filter_value2=null,$type=null){

        switch($transaction){
            case 'daily-shift-schedule-demography':

                        $date = date("Y-m-d", strtotime($filter_value));

                        $ref_department_id = $filter_value2;
                        $date_name = date("F d, Y", strtotime($date));

                        $data['departments'] = $this->SchedEmployee_model->get_daily_schedule_dept($date,$ref_department_id);
                        $data['date'] = $date;
                        $data['date_name'] = $date_name;
                        $data['schedules'] = $this->SchedEmployee_model->get_shift_daily_schedule_employee($date,$ref_department_id);
                        $data['shifts'] = $this->SchedEmployee_model->get_shift_daily_schedule($date);

                        $data['company']=$this->GeneralSettings_model->get_list()[0];
                        $data['type'] = $type;

                        if($type=='fullview'||$type==null){
                            echo $this->load->view('template/daily_shift_schedule_html_view',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }

                        if($type=='print'){
                            echo $this->load->view('template/daily_shift_schedule_html_print',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }                        


                        if($type=='pdf'){
                            $file_name= 'Daily Manpower Schedule - '.$date_name;
                            $pdfFilePath = $file_name.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/daily_shift_schedule_html_print',$data,TRUE); //load the template

                            $pdf=new mPDF('c', 'A4-L'); 
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->Output($pdfFilePath,"D");

                        }
            break;
        }


    }


}
