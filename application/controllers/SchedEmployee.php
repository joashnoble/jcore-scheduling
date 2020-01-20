<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  require 'application/third_party/Carbon.php';
  use Carbon\Carbon;
class SchedEmployee extends CORE_Controller
{

    function __construct() {
        parent::__construct('');
        $this->validate_session();
        if($this->session->userdata('right_employee_schedule_view') == 0 || $this->session->userdata('right_employee_schedule_view') == null) {
            redirect('../Dashboard');
        }
        $this->load->model('Employee_model');
        $this->load->model('SchedEmployee_model');
        $this->load->model('RefSchedPay_model');
        $this->load->model('SchedRefShift_model');
        $this->load->model('RefPayPeriod_model');
        $this->load->model('RefGroup_model');
        $this->load->model('SchedHolidaySetup_model');
        $this->load->model('Sched_shift_break_model');
        $this->load->model('Employee_break_model');
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
        $data['ref_group']=$this->RefGroup_model->get_list(array('refgroup.is_deleted'=>FALSE));

        if($this->session->is_filtered_department == 1){
            $data['employee_list']=$this->Employee_model->getschedemployee(1,$this->session->user_ref_department_id);
            $data['employee_list1']=$this->Employee_model->getschedemployee(1,$this->session->user_ref_department_id);
        }else{
            $data['employee_list']=$this->Employee_model->getschedemployee(1);
            $data['employee_list1']=$this->Employee_model->getschedemployee(1);
        }

        $data['pay_period']=$this->RefPayPeriod_model->get_list(
            array('refpayperiod.is_deleted'=>FALSE),
            'refpayperiod.*',
            array(
            ),
        'refpayperiod.pay_period_start DESC'
        );
        $data['schedpay']=$this->RefSchedPay_model->get_list(array('sched_refpay.is_deleted'=>FALSE));
        $data['shift']=$this->SchedRefShift_model->get_list(array('sched_refshift.is_deleted'=>FALSE));
        $data['title'] = 'Employee Schedule';

        $this->load->view('sched_employee_view', $data);
    }

    function transaction($txn = null,$filter_value=null,$filter_value2=null) {
         function sum_the_time($time_in, $advance_in_out) {
              $times = array($time_in, $advance_in_out);
              $seconds = 0;
              foreach ($times as $time)
              {
                list($hour,$minute,$second) = explode(':', $time);
                $seconds += $hour*3600;
                $seconds += $minute*60;
                $seconds += $second;
              }
              $hours = floor($seconds/3600);
              $seconds -= $hours*3600;
              $minutes  = floor($seconds/60);
              $seconds -= $minutes*60;
              if($seconds < 9)
              {
              $seconds = "0".$seconds;
              }
              if($minutes < 9)
              {
              $minutes = "0".$minutes;
              }
                if($hours < 9)
              {
              $hours = "0".$hours;
              }
              return "{$hours}:{$minutes}:{$seconds}";
        }

        function getDatesFromRange($start, $end, $format = 'Y-m-d') {
            $array = array();
            $interval = new DateInterval('P1D');

            $realEnd = new DateTime($end);
            $realEnd->add($interval);

            $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

            foreach($period as $date) {
                $array[] = $date->format($format);
            }

            return $array;
        }

        switch ($txn) {
            case 'list':
                $employee_id = ($this->input->post('employee_id', TRUE) == null || $this->input->post('employee_id', TRUE) == "" ) ? 0 : $this->input->post('employee_id', TRUE);
                $pay_period_id = ($this->input->post('pay_period_id', TRUE) == null || $this->input->post('pay_period_id', TRUE) == "" ) ? 0 : $this->input->post('pay_period_id', TRUE);
                $response['data']=$this->SchedEmployee_model->getschedules($employee_id,$pay_period_id);
                echo json_encode($response);
            break;


            case 'emp_breaklist':

                $m_emp_break = $this->Employee_break_model;

                $schedule_employee_id = ($this->input->post('schedule_employee_id', TRUE) == null || $this->input->post('schedule_employee_id', TRUE) == "" ) ? 0 : $this->input->post('schedule_employee_id', TRUE);


                $response['data']=$this->Employee_break_model->emp_breaklist($schedule_employee_id);
                echo json_encode($response);

            break;

            case 'schedules_per_payperiod':
              $employee_id = ($filter_value == null || $filter_value == "" ) ? 0 : $filter_value;
              $pay_period_id = ($filter_value2 == null || $filter_value2 == "" ) ? 0 : $filter_value2;
              $response['data'] = $this->SchedEmployee_model->getscheduleperperiod($employee_id,$pay_period_id);
            echo json_encode($response);
            break;

            case 'override_sched':
                $schedule_id = ($this->input->post('schedule_id', TRUE) == null || $this->input->post('schedule_id', TRUE) == "" ) ? 0 : $this->input->post('schedule_id', TRUE);
                $response['data']=$this->SchedEmployee_model->getschedulewithID($schedule_id);
                echo json_encode($response);
            break;


            case 'override_break':
            $m_break = $this->Employee_break_model;

            $employee_break_id = $this->input->post('employee_break_id', TRUE);
            $date_break_out = $this->input->post('date_break_out', TRUE);
            $time_break_out = $this->input->post('time_break_out', TRUE);
            $date_break_in = $this->input->post('date_break_in', TRUE);
            $time_break_in = $this->input->post('time_break_in', TRUE);


                for ($i=0;$i<(count($employee_break_id));$i++) {
                    
                    if($date_break_out[$i] == "0000-00-00"){
                        $date_break_out_1 = "0000-00-00";
                    }else{
                        $date_break_out_1 = date('Y-m-d', strtotime($date_break_out[$i]));
                    }

                    if($date_break_in[$i] == "0000-00-00"){
                        $date_break_in_1 = "0000-00-00";
                    }else{
                        $date_break_in_1 = date('Y-m-d', strtotime($date_break_in[$i]));
                    }

                    $break_out = $date_break_out_1.' '.date('H:i:s',strtotime($time_break_out[$i]));
                    $break_in = $date_break_in_1.' '.date('H:i:s',strtotime($time_break_in[$i]));

                    $chck_break_out = $date_break_out_1.' '.$time_break_out[$i];
                    $chck_break_in = $date_break_in_1.' '.$time_break_in[$i];

                    $break_is_out = 0;
                    $break_is_in = 0;

                    if ($chck_break_out == "0000-00-00 0:00:00"){
                        $break_is_out = 0;
                    }else{
                        $break_is_out = 1;
                    }

                    if ($chck_break_in == "0000-00-00 0:00:00"){
                        $break_is_in = 0;
                    }else{
                        $break_is_in = 1;
                    }

                    $m_break->break_out = $break_out;
                    $m_break->break_in = $break_in;
                    $m_break->break_is_out = $break_is_out;
                    $m_break->break_is_in = $break_is_in;

                    if ($break_is_out == 1 OR $break_is_in == 0){
                          $chck_break = $this->Employee_break_model->chck_break($employee_break_id[$i]);
                          $chck_break_time = $chck_break[0]->break_time;
                          $chck_break_allowance = $chck_break[0]->break_allowance;
                          $time_explode = explode(':', $chck_break_time);
                          $myResult = ($time_explode[0]*60) + ($time_explode[1]) + ($time_explode[2]/60);
                          $totalBreak = $myResult + $chck_break_allowance;
                          $time_extend = new DateTime($break_out);
                          $time_extend->add(new DateInterval('PT' . $totalBreak . 'M'));
                          $stamp = $time_extend->format('Y-m-d H:i:s');
                          $late = $this->SchedEmployee_model->check_break_late($stamp,$break_in);
                          $m_break->break_late = $late[0]->break_late;
                    }

                    $m_break->modify($employee_break_id[$i]);
                }

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Employee Break Updated Successfully.';
                echo json_encode($response);

            break;


            case 'getemployeedetails':
                $employee_id = ($this->input->post('employee_id', TRUE) == null || $this->input->post('employee_id', TRUE) == "" ) ? 0 : $this->input->post('employee_id', TRUE);
                $response['employee_list']=$this->Employee_model->get_list(
                    'employee_list.is_deleted=0 AND employee_list.employee_id='.$employee_id,
                    'employee_list.employee_id,employee_list.ecode,employee_list.image_name,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,
                    ref_department.department,ref_position.position,ref_branch.branch',
                    array(
                        array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                        array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        array('ref_position','ref_position.ref_position_id=emp_rates_duties.ref_position_id','left'),
                        array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
                        )
                );

                echo json_encode($response);
            break;

            case 'dayoff':
                $schedule_employee_id = ($this->input->post('schedule_employee_id', TRUE) == null || $this->input->post('schedule_employee_id', TRUE) == "" ) ? 0 : $this->input->post('schedule_employee_id', TRUE);
                $m_schedule = $this->SchedEmployee_model;

                $m_schedule->is_day_off = 1;
                $m_schedule->modify($schedule_employee_id);

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Employee Schedule Updated Successfully.';
                echo json_encode($response);
            break;

            case 'canceldayoff':
                $schedule_employee_id = ($this->input->post('schedule_employee_id', TRUE) == null || $this->input->post('schedule_employee_id', TRUE) == "" ) ? 0 : $this->input->post('schedule_employee_id', TRUE);
                $m_schedule = $this->SchedEmployee_model;

                $m_schedule->is_day_off = 0;
                $m_schedule->modify($schedule_employee_id);

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Employee Schedule Updated Successfully.';
                echo json_encode($response);
            break;

            case 'update_overridesched':
                $m_schedule = $this->SchedEmployee_model;
                $schedule_id = $this->input->post('schedule_id', TRUE);

                $clock_in_date = date("Y-m-d", strtotime($this->input->post('clock_in_date', TRUE)));
                $clock_out_date = date("Y-m-d", strtotime($this->input->post('clock_out_date', TRUE)));

                $clock_in = $this->input->post('frm_clock_in', TRUE);
                $clock_out = $this->input->post('frm_clock_out', TRUE);

                $date = $this->input->post('frm_date', TRUE);
                // $clock_outDate = $this->input->post('clock_outDate', TRUE);
                // $clock_inDate = $this->input->post('clock_inDate', TRUE);
                $break_time = $this->input->post('break_time', TRUE);
                $sched_hours = $this->input->post('total', TRUE);
                $time_in = $this->input->post('time_in', TRUE);

                $updated_clockin = $clock_in_date.' '.$clock_in;
                $updated_clockout = $clock_out_date.' '.$clock_out;

                if ($clock_in == "00:00:00"){
                  $m_schedule->clock_in = null;
                  $m_schedule->late = 0;
                  $m_schedule->is_in = 0;
                }else{
                  $m_schedule->clock_in = $updated_clockin;
                  $m_schedule->is_in = 1;

                  $computelate = $this->SchedEmployee_model->compute_late($time_in,$updated_clockin);
                  if ($computelate[0]->late > 0){
                    $m_schedule->late = $computelate[0]->late;
                  }

                }

                if ($clock_out == "00:00:00"){
                  $m_schedule->clock_out = null;
                  $m_schedule->is_out = 0;
                }else{
                  $m_schedule->clock_out = $updated_clockout;
                  $m_schedule->is_out = 1;
                }

                if ($clock_in != "00:00:00" AND $clock_out != "00:00:00"){
                $total_hours_attended = $this->SchedEmployee_model->get_timediff($updated_clockin,$updated_clockout,$break_time);
                $sched_hours_conv = $this->SchedEmployee_model->conv_timetominute($sched_hours);
                $hours_percentage = round(($total_hours_attended[0]->minutesattended/$sched_hours_conv[0]->sched_minutes)*100,2);//total hours
                $hours_percentage = ($hours_percentage > 100 ? '100' : $hours_percentage);
                $hours_percentage = ($hours_percentage < 0 ? '0' : $hours_percentage);
                $m_schedule->stat_completion = $hours_percentage;
                }else{
                  $m_schedule->stat_completion = 0;
                }

                $m_schedule->modify($schedule_id);

                $response['title'] = 'Success!';
                $response['stat'] = 'success';
                $response['msg'] = 'Employee Schedule Overrride Successfully.';
                echo json_encode($response);
            break;


            // $response['data']=$this->SchedEmployee_model->get_list(
            //     'schedule_employee.is_deleted=0 AND schedule_employee.employee_id='.$employee_id.' AND schedule_employee.pay_period_id='.$pay_period_id.' ',
            //     'schedule_employee.*,sched_refpay.schedpay,sched_refshift.shift,CONCAT(employee_list.first_name," ",employee_list.middle_name," ",employee_list.last_name) as full_name,COALESCE(ref_day_type.daytype,
            //     "Regular Day") as daytype',
            //     array(
            //         array('sched_refpay','sched_refpay.sched_refpay_id=schedule_employee.sched_refpay_id','left'),
            //         array('sched_refshift','sched_refshift.sched_refshift_id=schedule_employee.sched_refshift_id','left'),
            //         array('employee_list','employee_list.employee_id=schedule_employee.employee_id','left'),
            //         array('sched_holiday_setup','sched_holiday_setup.date=schedule_employee.date','left'),
            //         array('ref_day_type','ref_day_type.ref_day_type_id=sched_holiday_setup.ref_day_type_id','left'),
            //         ),
            //     'schedule_employee.date DESC'
            //     );

            case 'create':
                $m_schedule = $this->SchedEmployee_model;
                $m_breaks = $this->Employee_break_model;

                $this->load->library('form_validation');
                $this->load->helper('security');
                $employee_id = $this->input->post('employee_id', TRUE);
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $advance_in_out = $this->input->post('advance_in_out', TRUE);
                $time_in = $this->input->post('time_in', TRUE);
                $time_out = $this->input->post('time_out', TRUE);
                $break_time = $this->input->post('break_time', TRUE);
                $date = date("Y-m-d", strtotime($this->input->post('date', TRUE)));
                $sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                
                if($this->input->post('typestate', TRUE)==0){
                        $this->form_validation->set_rules('employee_id', 'Employee', 'strip_tags|xss_clean|required');
                        $this->form_validation->set_rules('pay_period_id', 'Pay Period', 'strip_tags|xss_clean|required');
                        $this->form_validation->set_rules('sched_refshift_id', 'Shift', 'strip_tags|xss_clean|required');
                        $this->form_validation->set_rules('time_in', 'Time In', 'strip_tags|xss_clean|required');
                        $this->form_validation->set_rules('time_out', 'Time Out', 'strip_tags|xss_clean|required');

                        if ($this->form_validation->run() == TRUE)
                        {
                            // $ifschedoverlaps=$this->SchedEmployee_model->ifschedoverlapscreate($employee_id,$pay_period_id,$sched_refshift_id);
                            /*echo json_encode($ifschedoverlaps);*/
                            // if(count($ifschedoverlaps)>0){
                            //     $response['title']='Notice';
                            //     $response['stat']='warningexist';
                            //     $response['msg']='Sorry, '.$ifschedoverlaps[0]->full_name.' already have Schedule for this shift and period.';
                            //
                            //
                            // }
                            // else{
                                    $period_days=$this->RefPayPeriod_model->get_list($pay_period_id);
                                    $dates = getDatesFromRange($period_days[0]->pay_period_start, $period_days[0]->pay_period_end);

                                    // $time_in = new DateTime($time_in);
                                    // $time_out = new DateTime($time_out);

                                    /*$sumtime = sum_the_time($time_in,$advance_in_out);
                                    $sum= new DateTime($sumtime);*/
                                    // $difference = $time_in ->diff($time_out );
                                    //
                                    // $total_hours = $difference ->format('%H.%i');
                                    // $total_hours = new DateTime($total_hours);
                                    // $break_time = new DateTime($break_time);
                                    // $total_attending_hours = $total_hours ->diff($break_time );
                                    // $total_attending_hours = $total_attending_hours ->format('%H.%i');

                                    foreach($dates as $dato){
                                      $ifperschedoverlaps=$this->SchedEmployee_model->ifperschedoverlaps($employee_id,$dato,$sched_refshift_id);
                                      // echo count($ifperschedoverlaps);
                                      if(count($ifperschedoverlaps)>0){

                                      }
                                      else{

                                        $day =  date('D', strtotime($dato));

                                        if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                          $time_in = $dato.' '.$this->input->post('time_in', TRUE);

                                          $newdate = Carbon::createFromFormat('Y-m-d', $dato)->addDay(1);
                                          $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time


                                          $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                        }
                                        else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                          $time_in = $dato.' '.$this->input->post('time_in', TRUE);
                                          $time_out = $dato.' '.$this->input->post('time_out', TRUE);
                                        }

                                        $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');
                                        // echo $total[0]->total_hours;
                                        $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                                        $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                        $m_schedule->sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                                        $m_schedule->sched_refpay_id = $this->input->post('sched_refpay_id', TRUE);
                                        $m_schedule->day = $day;
                                        $m_schedule->date = $dato;
                                        $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                        $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                        $m_schedule->time_in = $time_in;
                                        $m_schedule->time_out = $time_out;
                                        $m_schedule->break_time = $this->input->post('break_time', TRUE);
                                       /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                        $m_schedule->created_by = $this->session->user_id;
                                        $m_schedule->date_created = date("Y-m-d H:i:s");

                                        $m_schedule->total = $total[0]->total_hours;
                                        $m_schedule->save();

                                        $schedule_employee_id = $m_schedule->last_insert_id();

                                        $m_shift_break = $this->Sched_shift_break_model;
                                        // Create the employee break -> applying breaks into schedules
                                        $break = $m_shift_break->get_break_list($sched_refshift_id);

                                        foreach ($break as $breaks) {
                                            $m_breaks->schedule_employee_id = $schedule_employee_id;
                                            $m_breaks->break_time = $breaks->break_time;
                                            $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                            $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                            $m_breaks->save();
                                        }
                                      }
                                    }
                                    $response['title'] = 'Success!';
                                    $response['stat'] = 'success';
                                    $response['msg'] = 'Employee Schedule successfully created.';

                                    $this->SchedHolidaySetup_model->applysetuptoschedule();
                            // }

                       }
                      else
                      {
                          $response['title'] = 'Error!';
                          $response['stat'] = 'error';
                          $response['msg'] = validation_errors();

                      }

                      
                      echo json_encode($response);

                    }

                    if($this->input->post('typestate', TRUE)==1){
                      $this->form_validation->set_rules('group_id', 'Group', 'strip_tags|xss_clean|required');
                      $this->form_validation->set_rules('pay_period_id', 'Pay Period', 'strip_tags|xss_clean|required');
                      $this->form_validation->set_rules('sched_refshift_id', 'Shift', 'strip_tags|xss_clean|required');
                      $this->form_validation->set_rules('time_in', 'Time In', 'strip_tags|xss_clean|required');
                      $this->form_validation->set_rules('time_out', 'Time Out', 'strip_tags|xss_clean|required');

                      $group_id = $this->input->post('group_id', TRUE);

                      if ($this->form_validation->run() == TRUE)
                      {
                        $period_days=$this->RefPayPeriod_model->get_list($pay_period_id);
                        $dates = getDatesFromRange($period_days[0]->pay_period_start, $period_days[0]->pay_period_end);

                        // $group_id =
                        // $group=$this->Employee_model->get_list(
                        //     'refgroup.group_id='.$group_id.' AND employee_list.is_deleted=0',
                        //     'employee_list.employee_id,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name',
                        //     array(
                        //           array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                        //           array('refgroup','refgroup.group_id=emp_rates_duties.group_id','left'),
                        //         )//,
                        //     //null,
                        //    // null,
                        //    // true,
                        //    // '4'
                        //     );
                        $employee_id=$this->input->post('employee_id',TRUE);
                        $stat='';
                        $namesexcluded=array();
                        $response['title']='Notice!';
                        $response['stat']='error';
                        $response['msg']='There is no one in this group.';

                        foreach($employee_id as $row){
                          $employee_id = $row;
                          $group=$this->Employee_model->get_list(
                              'employee_list.employee_id='.$employee_id.' AND employee_list.is_deleted=0',
                              'employee_list.employee_id,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name'
                              // array(
                              //       array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                              //       array('refgroup','refgroup.group_id=emp_rates_duties.group_id','left'),
                              //     )//,
                              //null,
                             // null,
                             // true,
                             // '4'
                              );

                          $ifschedoverlaps=$this->SchedEmployee_model->ifschedoverlapscreate($employee_id,$pay_period_id,$sched_refshift_id);
                          /*echo json_encode($ifschedoverlaps);*/
                          if(count($ifschedoverlaps)>0){
                              $response['title']='Notice';
                              $response['stat']='warning';
                              array_push($namesexcluded,$group[0]->full_name);
                              // $response['msg']='Success, There is already schedule for some employees in this group';
                              $response['msg']='Group Schedule successfully created.';
                              $response['excluded']=$namesexcluded;
                          }
                          else{

                            foreach($dates as $dato){

                              $stat='yes';
                              $day =  date('D', strtotime($dato));

                                if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                  $time_in = $dato.' '.$this->input->post('time_in', TRUE);

                                  $newdate = Carbon::createFromFormat('Y-m-d', $dato)->addDay(1);
                                  $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time
                        
                                  $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                }
                                else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                  $time_in = $dato.' '.$this->input->post('time_in', TRUE);
                                  $time_out = $dato.' '.$this->input->post('time_out', TRUE);
                                }

                                $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                                $m_schedule->employee_id = $employee_id;
                                $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                $m_schedule->sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                                $m_schedule->sched_refpay_id = $this->input->post('sched_refpay_id', TRUE);
                                $m_schedule->day = $day;
                                $m_schedule->date = $dato;
                                $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                $m_schedule->time_in = $time_in;
                                $m_schedule->time_out = $time_out;
                                $m_schedule->break_time = $this->input->post('break_time', TRUE);
                               /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                $m_schedule->created_by = $this->session->user_id;
                                $m_schedule->date_created = date("Y-m-d H:i:s");

                                $m_schedule->total = $total[0]->total_hours;
                                $m_schedule->save();

                                $schedule_employee_id = $m_schedule->last_insert_id();

                                $m_shift_break = $this->Sched_shift_break_model;
                                // Create the employee break -> applying breaks into schedules
                                $break = $m_shift_break->get_break_list($sched_refshift_id);

                                foreach ($break as $breaks) {
                                    $m_breaks->schedule_employee_id = $schedule_employee_id;
                                    $m_breaks->break_time = $breaks->break_time;
                                    $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                    $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                    $m_breaks->save();
                                }

                             }

                            $response['title']='Success!';
                            $response['stat']='success';
                            $response['msg']='Group Schedule successfully created.';
                            $response['excluded']=$namesexcluded;
                          }

                        }
                        // if($stat=='yes'){

                        // }

                        $this->SchedHolidaySetup_model->applysetuptoschedule();
                        echo json_encode($response);
                      }
                      else{
                        $response['title'] = 'Error!';
                        $response['stat'] = 'error';
                        $response['msg'] = validation_errors();
                      }
                    }
                // echo json_encode($response);
            break;

            case 'delete':
                $m_schedule=$this->SchedEmployee_model;

                $schedule_employee_id=$this->input->post('schedule_employee_id',TRUE);

                $m_schedule->delete_via_id($schedule_employee_id);
                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Employee Schedule successfully deleted.';
                echo json_encode($response);

                break;


            case 'delete_break':
                $m_break=$this->Employee_break_model;

                $employee_break_id=$this->input->post('employee_break_id',TRUE);

                $chck_break = $m_break->chck_break($employee_break_id);

                $break_in = $chck_break[0]->break_is_in;
                $break_out = $chck_break[0]->break_is_out;

                if($break_in == 1 OR $break_out == 1){
                    $response['title']='Warning!';
                    $response['stat']='error';
                    $response['msg']='Sorry Employee Break cannot be deleted. It is already used in transaction.';
                    $response['false']=0;
                }else{
                    $m_break->delete_via_id($employee_break_id);
                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Employee Break successfully deleted.';
                    $response['false']=1;
                }

                echo json_encode($response);

            break;

            case 'create_break':
            $m_break=$this->Employee_break_model;

            $schedule_employee_id = $this->input->post('schedule_employee_id', TRUE);
            $break_time = $this->input->post('emp_break_time', TRUE);
            $break_allowance = $this->input->post('emp_break_allowance', TRUE);
            $sort_key = $this->input->post('emp_sort_key', TRUE);

            $chck_break = $m_break->chck_sort_key($schedule_employee_id,$sort_key);

            if (count($chck_break) <= 0){

                $m_break->schedule_employee_id = $schedule_employee_id;
                $m_break->break_time = $break_time;
                $m_break->break_allowance = $break_allowance;
                $m_break->sort_key = $sort_key;
                $m_break->save();

                $employee_break_id = $m_break->last_insert_id();

                $response['title']='Success!';
                $response['stat']='success';
                $response['msg']='Employee Break successfully created.';

                $response['row_added']=$m_break->get_list($employee_break_id);

            }else{
                $response['title']='Error!';
                $response['stat']='error';
                $response['msg']='Sort Key have duplicate. Please check your sort key.';
            }

                echo json_encode($response);

            break;

            case 'update_break':
                $m_break=$this->Employee_break_model;

                $employee_break_id = $this->input->post('employee_break_id', TRUE);
                $schedule_employee_id = $this->input->post('schedule_employee_id', TRUE);
                $break_time = $this->input->post('emp_break_time', TRUE);
                $break_allowance = $this->input->post('emp_break_allowance', TRUE);
                $sort_key = $this->input->post('emp_sort_key', TRUE);

                $chck_break = $m_break->chck_sort_key_update($schedule_employee_id,$sort_key,$employee_break_id);

                if (count($chck_break) <= 0){

                    $m_break->schedule_employee_id = $schedule_employee_id;
                    $m_break->break_time = $break_time;
                    $m_break->break_allowance = $break_allowance;
                    $m_break->sort_key = $sort_key;
                    $m_break->modify($employee_break_id);

                    $response['title']='Success!';
                    $response['stat']='success';
                    $response['msg']='Employee break successfully updated.';
                    $response['row_updated']=$m_break->get_list($employee_break_id);

                }else{
                    $response['title']='Error!';
                    $response['stat']='error';
                    $response['msg']='Sort Key have duplicate. Please check your sort key.';
                }
                echo json_encode($response);
            break;

            case 'update':
                $m_schedule=$this->SchedEmployee_model;
                $m_sched_breaks = $this->Sched_shift_break_model;
                $m_breaks = $this->Employee_break_model;

                $this->load->library('form_validation');
                $this->load->helper('security');
                $this->form_validation->set_rules('employee_id', 'Employee', 'strip_tags|xss_clean|required');
                $this->form_validation->set_rules('pay_period_id', 'Pay Period', 'strip_tags|xss_clean|required');
                $this->form_validation->set_rules('sched_refshift_id', 'Shift', 'strip_tags|xss_clean|required');
                $this->form_validation->set_rules('time_in', 'Time In', 'strip_tags|xss_clean|required');
                $this->form_validation->set_rules('time_out', 'Time Out', 'strip_tags|xss_clean|required');
                /*$this->form_validation->set_rules('total', 'Total', 'strip_tags|xss_clean|required');     */


                $schedule_employee_id=$this->input->post('schedule_employee_id',TRUE);

                $employee_id = $this->input->post('employee_id', TRUE);
                $pay_period_id = $this->input->post('pay_period_id', TRUE);
                $advance_in_out = $this->input->post('advance_in_out', TRUE);
                $time_in = $this->input->post('time_in', TRUE);
                $time_out = $this->input->post('time_out', TRUE);
                $break_time = $this->input->post('break_time', TRUE);
                $date = date("Y-m-d", strtotime($this->input->post('date', TRUE)));
                $sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                if ($this->form_validation->run() == TRUE)
                {
                    $ifschedoverlaps=$this->SchedEmployee_model->ifschedoverlaps($employee_id,$pay_period_id,$date,$time_in,$time_out);
                    /*echo json_encode($ifschedoverlaps);*/
                    if(count($ifschedoverlaps)>0){
                        if($time_in >= $ifschedoverlaps[0]->time_in && $time_in <= $ifschedoverlaps[0]->time_out){
                            if($ifschedoverlaps[0]->sched_refshift_id==$sched_refshift_id){

                                    $day =  date('D', strtotime($date));
                                    if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);

                                      $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                                      $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time
                                        
                                      $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                    }
                                    else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);
                                      $time_out = $date.' '.$this->input->post('time_out', TRUE);
                                    }

                                    $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                                    $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                                    $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                    $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                    $m_schedule->time_in = $time_in;
                                    $m_schedule->time_out = $time_out;
                                    $m_schedule->break_time = $this->input->post('break_time', TRUE);
                                    $m_schedule->sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                                    $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                   /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                    $m_schedule->created_by = $this->session->user_id;
                                    $m_schedule->date_created = date("Y-m-d H:i:s");
                                    $time_in = $time_in;
                                    $time_out = $time_out;

                                    /*$sumtime = sum_the_time($time_in,$advance_in_out);
                                    $sum= new DateTime($sumtime);*/
                                    $m_schedule->total = $total[0]->total_hours;
                                    /*echo $return_time;*/
                                    $m_schedule->modify($schedule_employee_id);
                                    $m_breaks->delete_via_fk($schedule_employee_id);

                                    // Create the employee break -> applying breaks into schedules
                                    $break = $m_sched_breaks->get_break_list($sched_refshift_id);

                                    foreach ($break as $breaks) {
                                        $m_breaks->schedule_employee_id = $schedule_employee_id;
                                        $m_breaks->break_time = $breaks->break_time;
                                        $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                        $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                        $m_breaks->save();
                                    }

                                    $response['title']='Success';
                                    $response['stat']='success';
                                    $response['msg']='Employee Schedule successfully updated.';
                                    /*$response['row_updated']=$this->SchedEmployee_model->get_list(
                                        $schedule_employee_id,
                                        'schedule_employee.*,sched_refpay.schedpay,sched_refshift.shift',
                                        array(
                                            array('sched_refpay','sched_refpay.sched_refpay_id=schedule_employee.sched_refpay_id','left'),
                                            array('sched_refshift','sched_refshift.sched_refshift_id=schedule_employee.sched_refshift_id','left'),
                                            ),
                                        'schedule_employee.day DESC'
                                        );*/
                            }
                            else{
                                $checkshiftexist=$this->SchedEmployee_model->checkshiftexist($employee_id,$pay_period_id,$date,$time_in,$time_out,$sched_refshift_id);
                                if(count($checkshiftexist)>0){
                                    $response['title']='Notice';
                                    $response['stat']='warning';
                                    $response['msg']='Sorry, The Chosen Shifting for this date is already exist1';
                                }
                                if(count($checkshiftexist)==0){
                                    /*echo $count($checkshiftexist);*/
                                    $day =  date('D', strtotime($date));
                                    if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);

                                      $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                                      $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time

                                      
                                        
                                      $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                    }
                                    else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);
                                      $time_out = $date.' '.$this->input->post('time_out', TRUE);
                                    }

                                    $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                                    $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                                    $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                    $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                    $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                    $m_schedule->time_in = $time_in;
                                    $m_schedule->time_out = $time_out;
                                    $m_schedule->break_time = $this->input->post('break_time', TRUE);
                                   /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                    $m_schedule->created_by = $this->session->user_id;
                                    $m_schedule->date_created = date("Y-m-d H:i:s");

                                    $m_schedule->total = $total[0]->total_hours;
                                    $m_schedule->modify($schedule_employee_id);
                                    $m_breaks->delete_via_fk($schedule_employee_id);

                                    // Create the employee break -> applying breaks into schedules
                                    $break = $m_sched_breaks->get_break_list($sched_refshift_id);

                                    foreach ($break as $breaks) {
                                        $m_breaks->schedule_employee_id = $schedule_employee_id;
                                        $m_breaks->break_time = $breaks->break_time;
                                        $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                        $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                        $m_breaks->save();
                                    }

                                    $response['title']='Success';
                                    $response['stat']='success';
                                    $response['msg']='Employee Schedule successfully updated.';
                                    /*$response['row_updated']=$this->SchedEmployee_model->get_list(
                                        $schedule_employee_id,
                                        'schedule_employee.*,sched_refpay.schedpay,sched_refshift.shift',
                                        array(
                                            array('sched_refpay','sched_refpay.sched_refpay_id=schedule_employee.sched_refpay_id','left'),
                                            array('sched_refshift','sched_refshift.sched_refshift_id=schedule_employee.sched_refshift_id','left'),
                                            ),
                                        'schedule_employee.day DESC'
                                        );*/
                                }
                            }

                        }
                        else{
                            $checkshiftexist=$this->SchedEmployee_model->checkshiftexist($employee_id,$pay_period_id,$date,$time_in,$time_out,$sched_refshift_id);
                            if(count($checkshiftexist)>0){

                                if($checkshiftexist[0]->sched_refshift_id==$sched_refshift_id){
                                    $day =  date('D', strtotime($date));
                                    if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);

                                      $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                                      $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time

                                        
                                      $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                    }
                                    else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                      $time_in = $date.' '.$this->input->post('time_in', TRUE);
                                      $time_out = $date.' '.$this->input->post('time_out', TRUE);
                                    }

                                    $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                                    $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                                    $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                    $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                    $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                    $m_schedule->time_in = $time_in;
                                    $m_schedule->time_out = $time_out;
                                    $m_schedule->break_time = $this->input->post('break_time', TRUE);
                                   /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                    $m_schedule->created_by = $this->session->user_id;
                                    $m_schedule->date_created = date("Y-m-d H:i:s");

                                    $m_schedule->total = $total[0]->total_hours;;
                                    $m_schedule->modify($schedule_employee_id);

                                    $m_breaks->delete_via_fk($schedule_employee_id);

                                    // Create the employee break -> applying breaks into schedules
                                    $break = $m_sched_breaks->get_break_list($sched_refshift_id);

                                    foreach ($break as $breaks) {
                                        $m_breaks->schedule_employee_id = $schedule_employee_id;
                                        $m_breaks->break_time = $breaks->break_time;
                                        $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                        $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                        $m_breaks->save();
                                    }

                                    $response['title']='Success';
                                    $response['stat']='success';
                                    $response['msg']='Employee Schedule successfully updated.';
                                }
                                else{
                                    $response['title']='Notice';
                                    $response['stat']='warning';
                                    $response['msg']='Sorry, The Chosen Shifting for this date is already exist';
                                }
                            }
                            if(count($checkshiftexist)==0){
                                /*echo $count($checkshiftexist);*/
                                $day =  date('D', strtotime($date));
                                if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                                  $time_in = $date.' '.$this->input->post('time_in', TRUE);

                                  $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                                  $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time

                                  
                                    
                                  $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                                }
                                else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                                  $time_in = $date.' '.$this->input->post('time_in', TRUE);
                                  $time_out = $date.' '.$this->input->post('time_out', TRUE);
                                }


                                $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                                $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                                $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                                $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                                $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                                $m_schedule->time_in = $time_in;
                                $m_schedule->time_out = $time_out;
                                $m_schedule->break_time = $this->input->post('break_time', TRUE);
                               /* $m_schedule->total = $this->input->post('total', TRUE);*/
                                $m_schedule->created_by = $this->session->user_id;
                                $m_schedule->date_created = date("Y-m-d H:i:s");

                                $m_schedule->total = $total[0]->total_hours;
                                $m_schedule->modify($schedule_employee_id);

                                $m_breaks->delete_via_fk($schedule_employee_id);

                                // Create the employee break -> applying breaks into schedules
                                $break = $m_sched_breaks->get_break_list($sched_refshift_id);

                                foreach ($break as $breaks) {
                                    $m_breaks->schedule_employee_id = $schedule_employee_id;
                                    $m_breaks->break_time = $breaks->break_time;
                                    $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                                    $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                                    $m_breaks->save();
                                }

                                $response['title']='Success';
                                $response['stat']='success';
                                $response['msg']='Employee Schedule successfully updated.';
                                /*$response['row_updated']=$this->SchedEmployee_model->get_list(
                                    $schedule_employee_id,
                                    'schedule_employee.*,sched_refpay.schedpay,sched_refshift.shift',
                                    array(
                                        array('sched_refpay','sched_refpay.sched_refpay_id=schedule_employee.sched_refpay_id','left'),
                                        array('sched_refshift','sched_refshift.sched_refshift_id=schedule_employee.sched_refshift_id','left'),
                                        ),
                                    'schedule_employee.day DESC'
                                    );*/
                            }

                        }

                       /* $response['title']='Notice';
                        $response['stat']='warning';
                        $response['msg']='Sorry, Date or time overlaps';*/


                    }
                    else{
                        $day =  date('D', strtotime($date));
                        if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                          $time_in = $date.' '.$this->input->post('time_in', TRUE);

                          $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                          $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time

                          
                            
                          $time_out = $newdate.' '.$this->input->post('time_out', TRUE);

                        }
                        else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                          $time_in = $date.' '.$this->input->post('time_in', TRUE);
                          $time_out = $date.' '.$this->input->post('time_out', TRUE);
                        }

                        $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');
                        $m_schedule->employee_id = $this->input->post('employee_id', TRUE);
                        $m_schedule->pay_period_id = $this->input->post('pay_period_id', TRUE);
                        $m_schedule->advance_in_out = $this->input->post('advance_in_out', TRUE);
                        $m_schedule->grace_period = $this->input->post('grace_period',TRUE);
                        $m_schedule->time_in = $time_in;
                        $m_schedule->time_out = $time_out;
                        $m_schedule->break_time = $this->input->post('break_time', TRUE);
                        $m_schedule->sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);
                       /* $m_schedule->total = $this->input->post('total', TRUE);*/
                        $m_schedule->created_by = $this->session->user_id;
                        $m_schedule->date_created = date("Y-m-d H:i:s");

                        $m_schedule->total = $total[0]->total_hours;
                        /*echo $return_time;*/
                        $m_schedule->modify($schedule_employee_id);

                        $m_breaks->delete_via_fk($schedule_employee_id);
                        // Create the employee break -> applying breaks into schedules
                        $break = $m_sched_breaks->get_break_list($sched_refshift_id);

                        foreach ($break as $breaks) {
                            $m_breaks->schedule_employee_id = $schedule_employee_id;
                            $m_breaks->break_time = $breaks->break_time;
                            $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                            $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                            $m_breaks->save();
                        }

                        $response['title']='Success';
                        $response['stat']='success';
                        $response['msg']='Employee Schedule successfully updated.';
                    }
                    /*$response="yes";*/


                    /*$response['row_added'] = $this->SchedEmployee_model->get_list($schedule_employee_id);*/
               }
                else
                {
                    $response['title'] = 'Error!';
                    $response['stat'] = 'error';
                    $response['msg'] = validation_errors();

                }
                echo json_encode($response);
            break;

            case 'manualinout':
            $m_schedule=$this->SchedEmployee_model;
              $schedule_employee_id = $this->input->post('schedule_employee_id', TRUE);
              $sched_refshift_id = $this->input->post('sched_refshift_id', TRUE);

              // if($sched_refshift_id==3){ //if it is graveyard shift
              //   $date = $this->input->post('date', TRUE);
              //   $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
              //   $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time
              //   $clock_in = $date.' '.$this->input->post('clock_in', TRUE);
              //   $clock_out =  $newdate.' '.$this->input->post('clock_out', TRUE);
              // }
              // else{
              //   $date = $this->input->post('date', TRUE);
              //   $clock_in = $date.' '.$this->input->post('clock_in', TRUE);
              //   $clock_out =  $date.' '.$this->input->post('clock_out', TRUE);
              // }

            if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){

                $date = $this->input->post('date', TRUE);
                $newdate = Carbon::createFromFormat('Y-m-d', $date)->addDay(1);
                $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time
                $clock_in = $date.' '.$this->input->post('clock_in', TRUE);
                $clock_out =  $newdate.' '.$this->input->post('clock_out', TRUE);


            }
            else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                $date = $this->input->post('date', TRUE);
                $clock_in = $date.' '.$this->input->post('clock_in', TRUE);
                $clock_out =  $date.' '.$this->input->post('clock_out', TRUE);
            }

              if($clock_in!=null){
                $m_schedule->clock_in = $clock_in;
                $m_schedule->is_in = 1;
              }
              if($clock_out!=null){
                $m_schedule->clock_out = $clock_out;
                $m_schedule->is_out = 1;
              }
              $m_schedule->modify($schedule_employee_id);
              $schedemployee_manual=$this->SchedEmployee_model->get_list('schedule_employee.schedule_employee_id='.$schedule_employee_id);
              $is_in = $schedemployee_manual[0]->is_in;
              $is_out = $schedemployee_manual[0]->is_out;
              $break_time = $schedemployee_manual[0]->break_time;
              $clock_in = $schedemployee_manual[0]->clock_in;
              $clock_out = $schedemployee_manual[0]->clock_out;
              $sched_hours = $schedemployee_manual[0]->total;
              $time_out = $schedemployee_manual[0]->time_out;


              // $start_t = new DateTime($clock_in);
              // $current_t = new DateTime(date("H:i:s"));
              // $difference = $start_t ->diff($current_t );
              // $return_time = $difference ->format('%H.%i');
              // $total_hours_attended = $return_time-$break_time;//1 is 1 hour lunch break nvm
              /*echo $total_hours_attended;*/
              $total_hours_attended = $this->SchedEmployee_model->get_timediff($clock_in,$clock_out,$break_time);
              $sched_hours_conv = $this->SchedEmployee_model->conv_timetominute($sched_hours);
              $hours_percentage = round(($total_hours_attended[0]->minutesattended/$sched_hours_conv[0]->sched_minutes)*100,2);//total hours
              $hours_percentage = ($hours_percentage > 100 ? '100' : $hours_percentage);
              $hours_percentage = ($hours_percentage < 0 ? '0' : $hours_percentage);
              $m_schedule->stat_completion = $hours_percentage;
              $m_schedule->modify($schedule_employee_id);
              $response['title']='Success';
              $response['stat']='success';
              $response['msg']='Manual Employee Time IN/OUT  Successful .';
              echo json_encode($response);
            break;

            case 'check_code':

                $ecode = '"'.$this->input->post('employee_code', TRUE).'"';
                $response['emp'] = $this->Employee_model->check_code($ecode);
                $cecode = $response['emp'][0]->cecode;

                if($cecode !=0 ){
                    $response['title']='Success';
                    $response['stat']='success';
                    $response['msg']='Please Enter your PIN Number!';
                }
                else{
                    $response['title']='Error';
                    $response['stat']='error';
                    $response['msg']='Employee not found!';
                }
                
                echo json_encode($response);

            break;

            case 'timein':
                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;
                $attempt = 0;
                $pinnumber = $this->input->post('pinnumber', TRUE);
                $employee_id =$this->input->post('eid', TRUE);

                $response['check_pin']=$this->Employee_model->check_pin($employee_id);
                $emp_pin_number = $response['check_pin'][0]->pin_number;
                // $attempt = $response['check_pin'][0]->attempt;
                $ecode = $response['check_pin'][0]->ecode;

                $response['employee_list']=$this->Employee_model->check_code($ecode);

                    if ($emp_pin_number == $pinnumber){

                      $m_employee->attempt = 0;
                      $m_employee->modify($employee_id);

                    $date = date("Y-m-d");
                    $time = $date.' '.date("H:i:s");
                    $pay_period_id = 0;

                    $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                    $ref_payment_type_id = $response['employee_list'][0]->ref_payment_type_id;
                    $no_date_filter = 0;

                    if ($ref_payment_type_id == 1){
                      $no_date_filter = 15;
                    }
                    else if ($ref_payment_type_id == 2){
                      $no_date_filter = 31;
                    }
                    else if ($ref_payment_type_id == 3){
                      $no_date_filter = 1;
                    }
                    else if ($ref_payment_type_id == 4){
                      $no_date_filter = 7;
                    }

                    $pay_period_id_Temp=$this->SchedEmployee_model->get_pay_period($date,$no_date_filter);

                    if(count($pay_period_id_Temp)!=0){
                        $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                    }
                    else{
                        $response['title']='Notice';
                        $response['stat']='warning';
                        $response['msg']='Pay Period not found, Check the Pay Period.';
                        echo json_encode($response);
                        exit();
                    }

                $schedule_employee_id_temp=$this->SchedEmployee_model->get_schedule_id($employee_id,$pay_period_id,$date,$time);

                if(count($schedule_employee_id_temp) != 0){
                    $schedule_employee_id = $schedule_employee_id_temp[0]->schedule_employee_id;
                    $is_in = $schedule_employee_id_temp[0]->is_in;
                    $is_out = $schedule_employee_id_temp[0]->is_out;
                    $break_time = $schedule_employee_id_temp[0]->break_time;
                    $clock_in = $schedule_employee_id_temp[0]->clock_in;
                    $sched_hours = $schedule_employee_id_temp[0]->total;
                    $time_out = $schedule_employee_id_temp[0]->time_out;
                    $allow_ot = $schedule_employee_id_temp[0]->allow_ot;
                    $ot_in = $schedule_employee_id_temp[0]->ot_in;
                    $ot_out = $schedule_employee_id_temp[0]->ot_out;
                }
                else{

                    $checkot = $this->SchedEmployee_model->check_ot($employee_id,$pay_period_id,$date,$time);

                    if (count($checkot) != 0){
                        $schedule_employee_id = $checkot[0]->schedule_employee_id;
                        $is_in = $checkot[0]->is_in;
                        $is_out = $checkot[0]->is_out;
                        $break_time = $checkot[0]->break_time;
                        $clock_in = $checkot[0]->clock_in;
                        $sched_hours = $checkot[0]->total;
                        $time_out = $checkot[0]->time_out;
                        $allow_ot = $checkot[0]->allow_ot;
                        $ot_in = $checkot[0]->ot_in;
                        $ot_out = $checkot[0]->ot_out;

                        if($checkot[0]->allow_ot==1){
                          if($is_in == 1 && $is_out == 1 && $allow_ot == 1){
                            if($ot_in==0){
                              $m_schedule->ot_in = 1;
                              $m_schedule->modify($schedule_employee_id);
                              $response['title']='Success';
                              $response['stat']='success';
                              $response['msg']='Overtime Activated.';
                              echo json_encode($response);
                              exit();
                            }
                            if( $ot_in == 1 ){
                              $m_schedule->ot_out = $date.' '.date("H:i:s");
                              $m_schedule->modify($schedule_employee_id);
                              $response['title']='Success';
                              $response['stat']='success';
                              $response['msg']='Overtime OUT Successful.';
                              echo json_encode($response);
                              exit();
                            }
                          }
                        }
                    }

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You do not have Time schedule today';
                      echo json_encode($response);
                      exit();
                }

                if($is_in==0){
                    $m_schedule->is_in=1;
                    $m_schedule->clock_in = $date.' '.date("H:i:s");
                    $state="In";
                }
                if($is_in==1 && $is_out==0){
                    $instatus = $this->SchedEmployee_model->checkifdoublein($schedule_employee_id,$time);
                    if($instatus==1){
                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You already clocked in for this day.';
                      echo json_encode($response);
                      exit();
                    }
                    $m_schedule->is_out=1;
                    $m_schedule->clock_out = $date.' '.date("H:i:s");
                    $state="Out";
                    $clock_out = $date.' '.date("H:i:s");
                        // $start_t = new DateTime($clock_in);
                        // $current_t = new DateTime(date("H:i:s"));
                        // $difference = $start_t ->diff($current_t );
                        // $return_time = $difference ->format('%H.%i');
                        // $total_hours_attended = $return_time-$break_time;//1 is 1 hour lunch break nvm
                        /*echo $total_hours_attended;*/
                        $total_hours_attended = $this->SchedEmployee_model->get_timediff($clock_in,$clock_out,$break_time);
                        $sched_hours_conv = $this->SchedEmployee_model->conv_timetominute($sched_hours);
                        $hours_percentage = round(($total_hours_attended[0]->minutesattended/$sched_hours_conv[0]->sched_minutes)*100,2);//total hours
                        $hours_percentage = ($hours_percentage > 100 ? '100' : $hours_percentage);
                        $hours_percentage = ($hours_percentage < 0 ? '0' : $hours_percentage);
                     $m_schedule->stat_completion = $hours_percentage;
                }
                if($is_in==1 && $is_out==1){
                    $checkot = $this->SchedEmployee_model->check_ot($employee_id,$pay_period_id,$date,$time);
                    if(count($checkot)!=0){
                      if($checkot[0]->allow_ot==1){
                        if($is_in == 1 && $is_out == 1 && $allow_ot == 1){
                          if($ot_in==0){
                            $m_schedule->ot_in = 1;
                            $m_schedule->modify($schedule_employee_id);
                            $response['title']='Success';
                            $response['stat']='success';
                            $response['msg']='Overtime Activated.';
                            echo json_encode($response);
                            exit();
                          }
                          if( $ot_in == 1 ){
                            $m_schedule->ot_out = $date.' '.date("H:i:s");
                            $m_schedule->modify($schedule_employee_id);
                            $response['title']='Success';
                            $response['stat']='success';
                            $response['msg']='Overtime OUT Successful.';
                            echo json_encode($response);
                            exit();
                          }
                        }
                      }
                    }
                          $response['title']='Notice';
                          $response['stat']='warning';
                          $response['msg']='Sorry, You already clocked out for this day.';
                          $clock = $this->SchedEmployee_model->get_list(
                          $schedule_employee_id,
                              'schedule_employee.clock_in,schedule_employee.clock_out,schedule_employee.is_in,schedule_employee.is_out'
                          );
                          $response['clock_in'] = date("h:iA", strtotime($clock[0]->clock_in));
                          $response['clock_out'] = date("h:iA", strtotime($clock[0]->clock_out));
                          echo json_encode($response);
                          exit();
                      }
                      $m_schedule->modify($schedule_employee_id);

                      $response['title']='Success';
                      $response['stat']='success';
                      $response['msg']='Employee Time '.$state.' Successful.';
                      $clock = $this->SchedEmployee_model->get_list(
                          $schedule_employee_id,
                          'schedule_employee.clock_in,schedule_employee.clock_out,schedule_employee.is_in,schedule_employee.is_out'
                      );
                      $response['clock_in'] = date("h:iA", strtotime($clock[0]->clock_in));
                      $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);
                      $response['is_out'] = $clock[0]->is_out;
                      if($clock[0]->is_out!=0){
                          $response['clock_out'] = date("h:iA", strtotime($clock[0]->clock_out));
                      }
                      else{
                          $response['clock_out'] = 'notset';
                      }

                    }else{

                      $response['check_pin']=$this->Employee_model->check_pin($employee_id);
                      $attempt = $response['check_pin'][0]->attempt;

                      $remaining_attempt = 3 - $attempt;

                      if ($attempt == 3){

                          $m_employee->status = 'Inactive';
                          $m_employee->modify($employee_id);

                          $response['title']='Warning';
                          $response['attempt'] = 'block';
                          $response['stat']='error';
                          $response['msg']='Your account has been locked! Please coordinate with your manager or supervisor.';

                      }else{

                            $m_employee->attempt = $attempt + 1;
                            $m_employee->modify($employee_id);

                            $response['title']='Warning';
                            $response['attempt'] = 'go';
                            $response['stat']='error';
                            $response['msg']='Pin number is incorrect please try again. <br> Remaining Attempt ( '.$remaining_attempt.' )';
                          }
                    }

                echo json_encode($response);
            break;

            case 'schedstats':
                $m_schedule=$this->SchedEmployee_model;
                $employee_code = '"'.$this->input->post('employee_code', TRUE).'"';
                $response['employee_list']=$this->Employee_model->get_list(
                    'employee_list.is_deleted=0 AND ecode='.$employee_code,
                    'employee_list.employee_id,employee_list.ecode,employee_list.image_name,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name,
                    ref_department.department,ref_position.position,ref_branch.branch',
                    array(
                        array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                        array('ref_department','ref_department.ref_department_id=emp_rates_duties.ref_department_id','left'),
                        array('ref_position','ref_position.ref_position_id=emp_rates_duties.ref_position_id','left'),
                        array('ref_branch','ref_branch.ref_branch_id=emp_rates_duties.ref_branch_id','left'),
                        )
                );

                $date = date("Y-m-d");
                $time = date("H:i:s");

                if(count($response['employee_list'])!=0){
                    $employee_id = $response['employee_list'][0]->employee_id;
                    $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);
                }
                else{
                    $response['title']='Notice';
                    $response['stat']='error';
                    $response['msg']='Employee not found!';
                    echo json_encode($response);
                    exit();
                }

                $pay_period_id_Temp=$this->SchedEmployee_model->get_pay_period($date);

                if(count($pay_period_id_Temp)!=0){
                    $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                }
                else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['msg']='You do not have schedule for this Pay Period.';
                    echo json_encode($response);
                    exit();
                }



                $schedule_employee_id_temp=$this->SchedEmployee_model->get_schedule_stat($employee_id,$pay_period_id);

                if(count($schedule_employee_id_temp)!=0){
                    $schedule_employee_id = $schedule_employee_id_temp[0]->schedule_employee_id;
                    /*$response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id);*/
                }
                else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['msg']='No Schedule Found';
                    echo json_encode($response);
                    exit();
                }

                $response['title']='Success';
                $response['stat']='success';
                $response['msg']='Employee Schedule Found.';
                $clock = $this->SchedEmployee_model->get_list(
                    $schedule_employee_id,
                    'schedule_employee.clock_in,schedule_employee.clock_out,schedule_employee.is_in,schedule_employee.is_out'
                );
                $response['clock_in'] = date("h:iA", strtotime($clock[0]->clock_in));
                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);
                echo json_encode($response);
            break;

            case 'allowot' :
              $m_schedule=$this->SchedEmployee_model;
              $schedule_employee_id = $this->input->post('schedule_employee_id', TRUE);
              $m_schedule->allow_ot = $this->input->post('allow_ot', TRUE);
              $m_schedule->modify($schedule_employee_id);
              $response['title']='Success';
              $response['stat']='success';
              $response['msg']='Overtime successfully activated';
              echo json_encode($response);

            break;

            case 'test' :
                $start_t = new DateTime('8:00:00');
                $current_t = new DateTime('17:00:00');
                $difference = $start_t ->diff($current_t );
                $return_time = $difference ->format('%H.%i');
                $total_hours_attended = $return_time - 1;//1 is 1 hour lunch break
                echo $hours_percentage = ($total_hours_attended/8)*100;//total hours
                /*echo $return_time;*/

            break;

            case 'listempgroup' :
                $group_id = $this->input->post('group_id', TRUE);
                $response['data']=$this->Employee_model->get_list(
                    'refgroup.group_id='.$group_id.' AND employee_list.is_deleted=0',
                    'employee_list.employee_id,CONCAT(employee_list.first_name," ",middle_name," ",employee_list.last_name) as full_name',
                    array(
                          array('emp_rates_duties','emp_rates_duties.emp_rates_duties_id=employee_list.emp_rates_duties_id','left'),
                          array('refgroup','refgroup.group_id=emp_rates_duties.group_id','left'),
                        )//,
                    //null,
                   // null,
                   // true,
                   // '4'
                    );
                    echo json_encode($response);
            break;

            case 'batchdelete' :
              $schedule_employee_id=$this->input->post('schedule_employee_id',TRUE);
              foreach($schedule_employee_id as $row){
                $this->db->where('schedule_employee_id', $row);
                $this->db->delete('schedule_employee');
              }
              $response['title']='Success';
              $response['stat']='success';
              $response['msg']='Schedule(s) successfully deleted.';
              echo json_encode($response);
            break;

            case 'batchupdate' :

              $m_breaks = $this->Employee_break_model;
              $m_schedule = $this->SchedEmployee_model;

              $schedule_employee_id=$this->input->post('schedule_employee_id',TRUE);
              $pay_period_id=$this->input->post('pay_period_id',TRUE);
              $advance_in_out=$this->input->post('advance_in_out',TRUE);
              // $time_in=$this->input->post('time_in',TRUE);
              // $time_out=$this->input->post('time_out',TRUE);
              $break_time=$this->input->post('break_time',TRUE);
              $date=$this->input->post('date',TRUE);
              $sched_refshift_id=$this->input->post('sched_refshift_id',TRUE);



              $updateArray = array();
              $x=0;
              foreach($schedule_employee_id as $row){
                // if($this->input->post('sched_refshift_id', TRUE)==3){
                //   $time_in = $date[$x].' '.$this->input->post('time_in', TRUE);

                //   $newdate = Carbon::createFromFormat('Y-m-d', $dato)->addDay(1);
                //   $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time

                //   $time_out = $newdate.' '.$this->input->post('time_out', TRUE);
                // }
                // else{
                //   $time_in = $date[$x].' '.$this->input->post('time_in', TRUE);
                //   $time_out = $date[$x].' '.$this->input->post('time_out', TRUE);
                // }

            if ($this->input->post('time_in', TRUE) > $this->input->post('time_out', TRUE)){
                  $time_in = $date[$x].' '.$this->input->post('time_in', TRUE);
                  $newdate = Carbon::createFromFormat('Y-m-d', $date[$x])->addDay(1);
                  $newdate = $newdate->format('Y-m-d'); //to remove carbon generated date time
                  $time_out = $newdate.' '.$this->input->post('time_out', TRUE);
            }
            else if ($this->input->post('time_in', TRUE) < $this->input->post('time_out', TRUE)){
                  $time_in = $date[$x].' '.$this->input->post('time_in', TRUE);
                  $time_out = $date[$x].' '.$this->input->post('time_out', TRUE);
            }

                $m_breaks->delete_via_fk($row);

                $total = $this->SchedEmployee_model->get_timediff($time_in,$time_out,'00:00:00');

                $m_schedule->pay_period_id = $pay_period_id;
                $m_schedule->advance_in_out = $advance_in_out;
                $m_schedule->time_in = $time_in;
                $m_schedule->time_out = $time_out;
                $m_schedule->break_time = $break_time;
                $m_schedule->sched_refshift_id = $sched_refshift_id;
                $m_schedule->total = $total[0]->total_hours;
                $m_schedule->modify($row);

                $m_shift_break = $this->Sched_shift_break_model;
                // Create the employee break -> applying breaks into schedules
                $break = $m_shift_break->get_break_list($sched_refshift_id);

                foreach ($break as $breaks) {
                    $m_breaks->schedule_employee_id = $row;
                    $m_breaks->break_time = $breaks->break_time;
                    $m_breaks->break_allowance = $this->get_numeric_value($breaks->break_allowance);
                    $m_breaks->sort_key = $this->get_numeric_value($breaks->sort_key);
                    $m_breaks->save();
                }

              }
              $response['title']='Success';
              $response['stat']='success';
              $response['msg']='Schedule(s) successfully updated.';
              echo json_encode($response);
            break;
        }
    }











}
