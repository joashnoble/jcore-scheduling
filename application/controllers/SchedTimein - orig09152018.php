<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchedTimein extends CORE_Controller
{

    function __construct() {
        parent::__construct('');

        $this->validate_session();
        if($this->session->userdata('right_schedule_timeinout') == 0 || $this->session->userdata('right_schedule_timeinout') == null) {
            redirect('../Dashboard');
        }
        $this->load->model('Employee_model');
        $this->load->model('SchedEmployee_model');
        $this->load->model('Employee_break_model');

    }

    public function index() {
        $data['_def_css_files'] = $this->load->view('template/assets/css_files', '', TRUE);
        $data['_def_js_files'] = $this->load->view('template/assets/js_files', '', TRUE);
        // $data['_switcher_settings'] = $this->load->view('template/elements/switcher', '', TRUE);
        // $data['_side_bar_navigation'] = $this->load->view('template/elements/side_bar_navigation', '', TRUE);
        // $data['_top_navigation'] = $this->load->view('template/elements/top_navigation_for_timein', '', TRUE);
        $data['_rights'] = $this->load->view('template/elements/rights', '', TRUE);
        $data['loader'] = $this->load->view('template/elements/loader', '', TRUE);
        $data['loaderscript'] = $this->load->view('template/elements/loaderscript', '', TRUE);
        $data['title'] = 'Employee Time In';

        $this->load->view('sched_timein_view', $data);
    }

    function transaction($txn = null) {
        switch ($txn) {
            case 'list':
                $response['data']=$this->RefBranch_model->get_list(
                    array('ref_branch.is_deleted'=>FALSE)
                    );
                echo json_encode($response);
                break;

            case 'getlivetime':
              $m_schedule=$this->SchedEmployee_model;
                $response['livetime'] =date("h:iA");
                $response['livedate'] = date("Y/m/d");
                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");

                $pay_period_id_Temp=$this->SchedEmployee_model->get_pay_period($date,0);

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
                $count_whosin=$this->SchedEmployee_model->count_whosin($pay_period_id,$date,$time,$type="is_in");
                if($count_whosin!=null){
                  if($count_whosin[0]->whos_in!=$this->input->post('retrieve_whosin',TRUE)){
                    $response['count_whosin']=$count_whosin[0]->whos_in;
                    $response['whos_in']=$this->SchedEmployee_model->get_whosinout($pay_period_id,$date,$time,$type="is_in");
                    $response['status']='newdata';
                  }
                  else{
                    $response['status']='nochanges';
                    $response['count_whosin']=0;
                  }
                }
                else{
                  $response['status']='nodata';
                  $response['count_whosin']=0;
                }

                $count_whosout=$this->SchedEmployee_model->count_whosin($pay_period_id,$date,$time,$type="is_out");
                if($count_whosout!=null){
                  if($count_whosout[0]->whos_in!=$this->input->post('retrieve_whosout',TRUE)){
                    $response['count_whosout']=$count_whosout[0]->whos_in;
                    $response['whos_out']=$this->SchedEmployee_model->get_whosout($pay_period_id,$date,$time,$type="is_out");
                    $response['statusout']='newdata';
                  }
                  else{
                    $response['statusout']='nochanges';
                    $response['count_whosout']=0;
                  }
                }
                else{
                  $response['statusout']='nodata';
                  $response['count_whosout']=0;
                }



                echo json_encode($response);
            break;
                // $this->db->update_batch('schedule_employee',$updateArray, 'schedule_employee_id');
            case 'check_code':

                $ecode = '"'.$this->input->post('employee_code', TRUE).'"';
                $response['emp'] = $this->Employee_model->check_code($ecode);
                $cecode = $response['emp'][0]->cecode;
                $status = $response['emp'][0]->status;

                if($status == "Inactive"){
                    $response['title']='Warning';
                    $response['stat']='error';
                    $response['msg']='Your account has been locked! Please coordinate with your manager or supervisor.';
                }
                else if($status == "Active"){
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

            case 'chck_time_in':

                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;

                $employee_id = $this->input->post('employee_id', TRUE);

                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");
                $pay_period_id = 0;

                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                $employee = $this->Employee_model->get_employee_info($employee_id);
                $ref_payment_type_id = $employee[0]->ref_payment_type_id;

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

                        $chck_pay_period = $m_schedule->chck_pay_period_timein($date,$employee_id);

                        if (count($chck_pay_period) > 0){
                            $chck_clock_in = $chck_pay_period[0]->clock_in;
                            $chck_clock_out = $chck_pay_period[0]->clock_out;
                            $chck_allow_ot = $chck_pay_period[0]->allow_ot;
                            $is_day_off = $chck_pay_period[0]->is_day_off;

                              if ($is_day_off == 1){

                                  $response['title']='Notice';
                                  $response['stat']='warning';
                                  $response['trx_mode'] = 0;
                                  $response['msg']='Sorry, You cannot Time In due to Day Off Schedule. If you wish to Time In please cooperate with your manager / supervisor. Thank you.';
                                  echo json_encode($response);
                                  exit();

                              }else{

                                  if ($chck_clock_in == '' AND $chck_clock_out == ''){
                                    $pay_period_id = $chck_pay_period[0]->pay_period_id;
                                  }
                                  else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                                    $pay_period_id = $chck_pay_period[0]->pay_period_id;
                                  }
                                  else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                                  {
                                    $pay_period_id = $chck_pay_period[0]->pay_period_id;
                                  }
                                  else{
                                    $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                                  }

                              }

                        }else{
                              $response['title']='Notice';
                              $response['stat']='warning';
                              $response['trx_mode'] = 0;
                              $response['msg']='Sorry, You do not have Time schedule today.';
                              echo json_encode($response);
                              exit();
                          }
                      
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
                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You do not have Time schedule today';
                      echo json_encode($response);
                      exit();
                }


                if ($is_in == 0){
                    $response['stat'] = 'success';
                    echo json_encode($response);
                    exit();
                }
                
                if($is_in == 1){
                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You already clocked in for this day.';
                      echo json_encode($response);
                      exit();
                }

            break;


            case 'chck_time_out':
                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;

                $employee_id = $this->input->post('employee_id', TRUE);

                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");
                $pay_period_id = 0;

                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                $employee = $this->Employee_model->get_employee_info($employee_id);
                $ref_payment_type_id = $employee[0]->ref_payment_type_id;

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
                    $chck_pay_period = $m_schedule->chck_pay_period_timeout($date,$employee_id);

                    if (count($chck_pay_period) > 0){
                        $chck_clock_in = $chck_pay_period[0]->clock_in;
                        $chck_clock_out = $chck_pay_period[0]->clock_out;
                        $chck_allow_ot = $chck_pay_period[0]->allow_ot;
                        $is_day_off = $chck_pay_period[0]->is_day_off;

                          if ($is_day_off == 1){

                              $response['title']='Notice';
                              $response['stat']='warning';
                              $response['trx_mode'] = 0;
                              $response['msg']='Sorry, You cannot Time Out due to Day Off Schedule. If you wish to Time Out please cooperate with your manager / supervisor. Thank you.';
                              echo json_encode($response);
                              exit();

                          }else{

                              if ($chck_clock_in == '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                              {
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else{
                                $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                              }

                          }
                    }else{
                              $response['title']='Notice';
                              $response['stat']='warning';
                              $response['trx_mode'] = 0;
                              $response['msg']='Sorry, You do not have Time schedule today.';
                              echo json_encode($response);
                              exit();
                    }
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

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You do not have Time schedule today';
                      echo json_encode($response);
                      exit();
                }


                if ($is_out == 0){
                    $response['stat'] = 'success';
                    echo json_encode($response);
                    exit();
                }
                
                if($is_out == 1){
                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You already clocked out for this day.';
                      echo json_encode($response);
                      exit();
                }
            break;

            case 'chck_ot_out':
                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;

                $employee_id = $this->input->post('employee_id', TRUE);

                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");
                $pay_period_id = 0;

                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                $employee = $this->Employee_model->get_employee_info($employee_id);
                $ref_payment_type_id = $employee[0]->ref_payment_type_id;

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
                    $chck_pay_period = $m_schedule->chck_pay_period_timeout($date,$employee_id);

                   if (count($chck_pay_period) > 0){ 

                        $chck_clock_in = $chck_pay_period[0]->clock_in;
                        $chck_clock_out = $chck_pay_period[0]->clock_out;
                        $chck_allow_ot = $chck_pay_period[0]->allow_ot;
                        $is_day_off = $chck_pay_period[0]->is_day_off;

                          if ($is_day_off == 1){

                              $response['title']='Notice';
                              $response['stat']='warning';
                              $response['trx_mode'] = 0;
                              $response['msg']='Sorry, You cannot OT Out due to Day Off Schedule. If you wish to OT Out please cooperate with your manager / supervisor. Thank you.';
                              echo json_encode($response);
                              exit();

                          }else{

                              if ($chck_clock_in == '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                              {
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else{
                                $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                              }
                          }
                    }else{
                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['trx_mode'] = 0;
                      $response['msg']='Sorry, You do not have Time schedule today.';
                      echo json_encode($response);
                      exit();
                    }
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

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['msg']='Sorry, You do not have Time schedule today';
                      echo json_encode($response);
                      exit();
                }

                if ($allow_ot == 1){
                  if ($ot_out == "0000-00-00 00:00:00"){
                      $response['stat'] = 'success';
                      echo json_encode($response);
                      exit();
                  }
                  
                  if($ot_out != "0000-00-00 00:00:00"){
                        $response['title']='Notice';
                        $response['stat']='warning';
                        $response['msg']='Sorry, You already clocked OT out for this day.';
                        echo json_encode($response);
                        exit();
                  }
                }else{
                        $response['title']='Warning';
                        $response['stat']='warning';
                        $response['msg']='Sorry, You are not allowed to overtime. Please cooperate with your manager.';
                        echo json_encode($response);
                        exit();
                }

            break;

            case 'break_out':

                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;
                $m_break = $this->Employee_break_model;

                $employee_id = $this->input->post('employee_id', TRUE);

                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");
                $pay_period_id = 0;

                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                $employee = $this->Employee_model->get_employee_info($employee_id);
                $ref_payment_type_id = $employee[0]->ref_payment_type_id;

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
                    $chck_pay_period = $m_schedule->chck_pay_period_timein($date,$employee_id);

                    if (count($chck_pay_period) > 0){

                        if (count($chck_pay_period) != 0){
                          $chck_clock_in = $chck_pay_period[0]->clock_in;
                          $chck_clock_out = $chck_pay_period[0]->clock_out;
                          $chck_allow_ot = $chck_pay_period[0]->allow_ot;
                          $is_day_off = $chck_pay_period[0]->is_day_off;

                          if ($is_day_off == 1){

                              $response['title']='Notice';
                              $response['stat']='warning';
                              $response['trx_mode'] = 0;
                              $response['msg']='Sorry, You cannot Break Out due to Day Off Schedule. If you wish to Break Out please cooperate with your manager / supervisor. Thank you.';
                              echo json_encode($response);
                              exit();

                          }else{

                              if ($chck_clock_in == '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                              {
                                $pay_period_id = $chck_pay_period[0]->pay_period_id;
                              }
                              else{
                                $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                              }
                        }
                    }else{
                          $response['title']='Notice';
                          $response['stat']='warning';
                          $response['trx_mode'] = 0;
                          $response['msg']='Sorry, You do not have Time schedule today.';
                          echo json_encode($response);
                          exit();
                    }

                    }else{

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['trx_mode'] = 0;
                      $response['msg']='Sorry, You do not have Time schedule today.';
                      echo json_encode($response);
                      exit();
                    }
                }
                else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['trx_mode'] = 0;
                    $response['msg']='Pay Period not found, Check the Pay Period.';
                    echo json_encode($response);
                    exit();
                }

                $schedule_employee_id_temp=$this->SchedEmployee_model->get_schedule_id_break($employee_id,$pay_period_id,$date,$time);

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

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['trx_mode'] = 0;
                      $response['msg']='Sorry, You do not have Time schedule today.';
                      echo json_encode($response);
                      exit();
                }

                if ($clock_in != ""){
                    $break_in = $this->Employee_break_model->get_schedule_break($schedule_employee_id);

                      if(count($break_in) != 0){
                        $response['break_list'] = $this->Employee_break_model->get_schedule_break($schedule_employee_id);
                        $response['stat'] = 'success';
                        $response['trx_mode'] = 1;
                        echo json_encode($response);
                      }else{
                        $response['title']='Notice';
                        $response['stat']='warning';
                        $response['trx_mode'] = 1;
                        $response['msg']='Sorry, schedule break is not set up. Please coordinate with your manager / supervisor.';
                        echo json_encode($response);
                        exit();
                      }
                }else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['trx_mode'] = 1;
                    $response['msg']='Sorry, schedule time in is required.';
                    echo json_encode($response);
                    exit();
                }

            break;

            case 'break_in':

                $m_schedule=$this->SchedEmployee_model;
                $m_employee=$this->Employee_model;
                $m_break = $this->Employee_break_model;

                $employee_id = $this->input->post('employee_id', TRUE);

                $date = date("Y-m-d");
                $time = $date.' '.date("H:i:s");
                $pay_period_id = 0;

                $response['period_stats']=$this->SchedEmployee_model->get_period_sched($employee_id,$date);

                $employee = $this->Employee_model->get_employee_info($employee_id);
                $ref_payment_type_id = $employee[0]->ref_payment_type_id;

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
                    $chck_pay_period = $m_schedule->chck_pay_period_timein($date,$employee_id);

                    if (count($chck_pay_period) != 0){
                      $chck_clock_in = $chck_pay_period[0]->clock_in;
                      $chck_clock_out = $chck_pay_period[0]->clock_out;
                      $chck_allow_ot = $chck_pay_period[0]->allow_ot;
                      $is_day_off = $chck_pay_period[0]->is_day_off;

                      if ($is_day_off == 1){

                          $response['title']='Notice';
                          $response['stat']='warning';
                          $response['trx_mode'] = 0;
                          $response['msg']='Sorry, You cannot Break Out due to Day Off Schedule. If you wish to Break Out please cooperate with your manager / supervisor. Thank you.';
                          echo json_encode($response);
                          exit();

                      }else{

                          if ($chck_clock_in == '' AND $chck_clock_out == ''){
                            $pay_period_id = $chck_pay_period[0]->pay_period_id;
                          }
                          else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                            $pay_period_id = $chck_pay_period[0]->pay_period_id;
                          }
                          else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                          {
                            $pay_period_id = $chck_pay_period[0]->pay_period_id;
                          }
                          else{
                            $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                          }

                      }
                    }else{

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['trx_mode'] = 0;
                      $response['msg']='Sorry, You do not have Time schedule today.';
                      echo json_encode($response);
                      exit();
                    }
                }
                else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['trx_mode'] = 0;
                    $response['msg']='Pay Period not found, Check the Pay Period.';
                    echo json_encode($response);
                    exit();
                }

                $schedule_employee_id_temp=$this->SchedEmployee_model->get_schedule_id_break($employee_id,$pay_period_id,$date,$time);

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

                      $response['title']='Notice';
                      $response['stat']='warning';
                      $response['trx_mode'] = 0;
                      $response['msg']='Sorry, You do not have Time schedule today.';
                      echo json_encode($response);
                      exit();
                }

                $break_out = $this->Employee_break_model->get_schedule_break($schedule_employee_id);

                if($clock_in != ''){
                  if(count($break_out) != 0){
                    $response['break_list'] = $this->Employee_break_model->get_schedule_break($schedule_employee_id);
                    $response['stat'] = 'success';
                    $response['trx_mode'] = 1;
                    echo json_encode($response);
                  }else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['trx_mode'] = 1;
                    $response['msg']='Sorry, schedule break is not set up. Please coordinate with your manager / supervisor.';
                    echo json_encode($response);
                    exit();
                  }
                }else{
                    $response['title']='Notice';
                    $response['stat']='warning';
                    $response['trx_mode'] = 1;
                    $response['msg']='Sorry, schedule time in is required.';
                    echo json_encode($response);
                    exit();
                }

            break;


            case 'process_break_out':
              $m_break = $this->Employee_break_model;
              $employee_break_id = $this->input->post('employee_break_id', TRUE);
              $state = 'Break Out';
              $time = date("Y-m-d H:i:s");

              $m_break->break_out = $time;
              $m_break->break_is_out = 1;
              $m_break->modify($employee_break_id);

              $response['break_out'] = date("h:iA", strtotime($time));
              $response['break_is_out'] = 1;
              $response['title']='Success';
              $response['stat']='success';
              $response['msg']='Employee Time '.$state.' Successful.';
              echo json_encode($response);

            break;

            case 'process_break_in':
              $m_break = $this->Employee_break_model;
              $employee_break_id = $this->input->post('employee_break_id', TRUE);
              $state = 'Break In';
              $time = date("Y-m-d H:i:s");

              $chck_break = $this->Employee_break_model->chck_break($employee_break_id);
              $break_is_out = $chck_break[0]->break_is_out;
              $break_out = $chck_break[0]->break_out;
              $break_time = $chck_break[0]->break_time;
              $break_allowance = $chck_break[0]->break_allowance;

              if ($break_is_out == 1){

                  $m_break->break_in = $time;
                  $m_break->break_is_in = 1;

                  function minutes ($time_extend) {
                    $time_explode = explode(':', $time_extend);
                    return ($time_explode[0]*60) + ($time_explode[1]) + ($time_explode[2]/60);
                  }

                  $myResult = minutes($break_time);

                  $totalBreak = $myResult + $break_allowance;

                  $time_extend = new DateTime($break_out);
                  $time_extend->add(new DateInterval('PT' . $totalBreak . 'M'));

                  $stamp = $time_extend->format('Y-m-d H:i:s');

                  $late = $this->SchedEmployee_model->check_break_late($stamp,$time);
                  $m_break->break_late = $late[0]->break_late;

                  $m_break->modify($employee_break_id);

                  $response['break_in'] = date("h:iA", strtotime($time));
                  $response['break_is_in'] = 1;
                  $response['title']='Success';
                  $response['stat']='success';
                  $response['msg']='Employee Time '.$state.' Successful.';

              }else{

                  $response['title']='Notice';
                  $response['stat']='warning';
                  $response['msg']='Schedule Break out is required.';

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

                        $chck_pay_period = $m_schedule->chck_pay_period_timein($date,$employee_id);

                        $chck_clock_in = $chck_pay_period[0]->clock_in;
                        $chck_clock_out = $chck_pay_period[0]->clock_out;
                        $chck_allow_ot = $chck_pay_period[0]->allow_ot;

                        if ($chck_clock_in == '' AND $chck_clock_out == ''){
                          $pay_period_id = $chck_pay_period[0]->pay_period_id;
                        }
                        else if ($chck_clock_in != '' AND $chck_clock_out == ''){
                          $pay_period_id = $chck_pay_period[0]->pay_period_id;
                        }
                        else if ($chck_clock_in != '' AND $chck_clock_out != '' AND $chck_allow_ot == 1)
                        {
                          $pay_period_id = $chck_pay_period[0]->pay_period_id;
                        }
                        else{
                          $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                        }
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
                          if ($ot_out == '0000-00-00 00:00:00'){
                            $m_schedule->ot_out = $date.' '.date("H:i:s");
                            $state="OT out";
                            $m_schedule->modify($schedule_employee_id);
                            $response['allow_ot'] = 1;
                            $response['overtime_out'] = date("h:iA");
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
                          'schedule_employee.clock_in,schedule_employee.clock_out,schedule_employee.is_in,schedule_employee.is_out,schedule_employee.ot_out,schedule_employee.allow_ot'
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
            
            case 'autotimeout' :
              $date = date("Y-m-d");
              $time = $date.' '.date("H:i:s");
              $pay_period_id_Temp=$this->SchedEmployee_model->get_pay_period($date);
              if(count($pay_period_id_Temp)!=0){
                  $pay_period_id = $pay_period_id_Temp[0]->pay_period_id;
                  $employee_scheds= $this->SchedEmployee_model->checkifforgottoout($pay_period_id,$date,$time);
                  if(count($employee_scheds)!=0){
                    $i=0;
                    $updateArray = array();
                    $createArray = array();
                    foreach($employee_scheds as $row){
                        $updateArray[] = array(
                            'schedule_employee_id'=>$row->schedule_employee_id,
                            'is_out' => 1,
                            'clock_out' =>$row->time_out
                        );
                      $i++;
                      $createArray[] = array(
                          'employee_id'=>$row->employee_id,
                          'date_memo' => $date,
                          'memo_number' =>rand(1000,9999),
                          'ref_disciplinary_action_policy_id' => 1,
                          'ref_action_taken_id' => 1,
                          'date_granted' => $date,
                          'remarks' => "Failure to Clock out",
                          'created_by' => $this->session->user_id,
                          'date_created' => $date
                      );
                    }
                    // echo json_encode($createArray);
                    $this->db->insert_batch('emp_memo', $createArray);
                    $this->db->update_batch('schedule_employee',$updateArray, 'schedule_employee_id');
                  }
              }

            break;

                // echo json_encode($response);
            break;

            // case 'timein':
            //     $m_branch = $this->RefBranch_model;

            //     $m_branch->branch = $this->input->post('postname', TRUE);
            //     $m_branch->description = $this->input->post('post_description', TRUE);
            //     $m_branch->date_created = date("Y-m-d H:i:s");
            //     $m_branch->created_by = $this->session->user_id;
            //     $m_branch->save();

            //     $ref_branch_id = $m_branch->last_insert_id();


            //     $response['title'] = 'Success!';
            //     $response['stat'] = 'success';
            //     $response['msg'] = 'Branch information successfully created.';

            //     $response['row_added'] = $this->RefBranch_model->get_list($ref_branch_id);
            //     echo json_encode($response);

            //     break;

            case 'delete':

                break;

            case 'update':
                break;

        }
    }











}
