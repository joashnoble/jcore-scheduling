<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_schedule_gantt extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_emp_sched_gantt_view') == 0 || $this->session->userdata('right_emp_sched_gantt_view') == null) {
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

        $data['employees'] = $this->Employee_model->get_employee_list();
        $data['title'] = 'Employee Schedule Gantt';

        $this->load->view('emp_sched_gantt_view', $data);
    }


    function schedule($transaction=null,$filter_value=null,$filter_value2=null,$filter_value3=null,$type=null){




        switch($transaction){

            case 'schedule_gantt':

                        $employee_id = $filter_value;
                        $from_date = date("Y-m-d", strtotime($filter_value2));
                        $to_date = date("Y-m-d", strtotime($filter_value3));

                        $data['from_date'] = date("F d, Y", strtotime($from_date));
                        $data['to_date'] = date("F d, Y", strtotime($to_date));

                        $data['employee'] = $this->Employee_model->get_employee_list($employee_id);
                        $data['schedules'] = $this->SchedEmployee_model->get_schedule_gantt($employee_id,$from_date,$to_date);
                        $data['company']=$this->GeneralSettings_model->get_list()[0];

                        $data['date_name']=date("F d, Y", strtotime($from_date)).' - '.date("F d, Y", strtotime($to_date));
                        $data['type'] = $type;

                        if($type=='fullview'||$type==null){
                            echo $this->load->view('template/emp_schedule_gantt_html_view',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }

                        if($type=='print'){
                            echo $this->load->view('template/emp_schedule_gantt_html_print',$data,TRUE);
                            //echo $this->load->view('template/dr_content_menus',$data,TRUE);
                        }                        


                        if($type=='pdf'){
                            $file_name= 'Employee Schedule Gantt - '.$data['employee'][0]->full_name.' ('.$from_date.' to '.$to_date.')';
                            $pdfFilePath = $file_name.".pdf"; //generate filename base on id
                            $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                            $content=$this->load->view('template/emp_schedule_gantt_html_print',$data,TRUE); //load the template

                            $pdf=new mPDF('c', 'A4-L'); 
                            $pdf->WriteHTML($content);
                            //download it.
                            $pdf->Output($pdfFilePath,"D");

                        }

                        //show only inside grid without menu button
                        // if($type=='contentview'){
                        //     echo $this->load->view('template/scheddemography_view',$data,TRUE);
                        // }

                        //download pdf
                        // if($type=='pdf'){
                        //     $pdfFilePath = $loans[0]->fullname."-Loan-".$get_type.".pdf"; //generate filename base on id
                        //     $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                        //     $content=$this->load->view('template/scheddemography_view',$data,TRUE); //load the template
                        //     $pdf->setFooter('{PAGENO}');
                        //     $pdf->WriteHTML($content);
                        //     //download it.
                        //     $pdf->Output($pdfFilePath,"D");

                        // }

                        // //preview on browser
                        // if($type=='preview'){
                        //     $pdfFilePath = $loans[0]->fullname."-Loan-".$get_type.".pdf"; //generate filename base on id
                        //     $pdf = $this->m_pdf->load(); //pass the instance of the mpdf class
                        //     $content=$this->load->view('template/payroll_employee_loans_html',$data,TRUE); //load the template
                        //     $pdf->setFooter('{PAGENO}');
                        //     $pdf->WriteHTML($content);
                        //     //download it.
                        //     /*$pdf->SetJS('this.print();');*/
                        //     $pdf->Output();
                        // }

            break;

        }


    }


}
