<!DOCTYPE html>
<html lang="en">
<?php echo $loader; ?>
<head>
    <meta charset="utf-8">
    <title>JCORE SCHEDULING - <?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">
    <?php echo $_def_css_files; ?>
    <?php echo $_def_js_files; ?>
    <style>
        body{
            overflow-x: hidden!important;
        }
        .toolbar{
            float: left;
        }

        td.details-control {
            background: url('assets/img/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
        }

        .child_table{
            padding: 5px;
            border: 1px #ff0000 solid;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }
        .select2-container{
            min-width: 100%;
        }
        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

        .numeric{
            text-align: right;
            width: 60%;
        }

        .sweet-alert p{
            font-weight:400;
            font-size:16pt;
        }

        .sweet-alert h2{
            font-size:30pt;
        }
        img{
            border-radius: 20%;
            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }
        img:hover{
        border-radius: 20%;
        -moz-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        transform: scale(1.1);
        z-index: 4000;

        }
        .onlineusers
        {
            color:white;
        }
        .percentonlineusers{
            color:white;
        }
        .fa{
            color:white;
        }
        .item{
            box-shadow: -2px 2px 20px #424242;
            /*border-radius:1%;*/
        }
        .item2{
            box-shadow: -2px 2px 20px #424242;
            border-radius:1em;
        }
        .nomargin{
            color:#263238;
            margin:5px;
            font-size:15pt !important;
        }
        .item{
        max-width: 100%;
        }
        .fa-user{
            color:#616161
        }
        .pace-progress{
          display:none;
        } 

        #pinnumber{
          font-weight: bold;
          background: #455A64;
          color: #FFF;
          border: 1px solid #263238;
          font-size: 20pt;
          padding: 30px!important; 
          text-align: center;
          -webkit-text-security: disc;
        }
        .date-title{
             color: white;padding: 10px;
            margin-left: -15px;font-size: 12pt;text-shadow: 2px 2px 4px #000000;
        }
        .text-left{
            padding-left: 10px;font-size: 13pt!important;
        }
        #employee_code:focus{
          background: #FFF59D; border: 3px solid #90A4AE;
        }
        .modal-backdrop {
          position: fixed;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          z-index: @zindex-modal-background;
          /*background-color: #90A4AE;*/
          opacity: 0.1 !important;
        }
        body.modal-open {
          margin-right: 0!important;
          overflow: hidden!important;
        }
        .btn_menu{
            width: 100%;
            min-width: 190px;
            min-height: 70px;
            margin: 10px;
            font-size: 15pt;
            font-family: calibri!important;
            -webkit-box-shadow: 1px 1px 5px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 1px 1px 5px 0px rgba(0,0,0,0.75);
            box-shadow: 1px 1px 5px 0px rgba(0,0,0,0.75);
        }
        .btn_other_menu{
            background: #CFD8DC!important;
            border: 1px solid #263238!important;
            color: #212121!important;
        }
        .m-menu{
            text-align: center;
            min-width: 500px;margin-top: 200px;border-radius: .5em;
            -webkit-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
            box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
        }
        .m-menu-content{
            border-radius: .5em;
        }
        .m-menu-body{
            border-radius: .5em;
        }
        .swal-wide{
            width:510px;
            min-height:320px; 
        }
        .col-sm-12{
            margin-left: -10px;
        }
    </style>
<?php echo $loaderscript; ?>
</head>

<body class="animated-content" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
<div id="wrapper">
    <div id="layout-static">
        <div class="static-content-wrapper white-bg scw">
            <div class="static-content sc">
                <div class="page-content">
                    <div class="container-fluid cf">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-tile tile-orange item2 dt">
                                    <div class="tile-heading th">
                                        <span class="date-title">Date &amp; Time</span>
                                        <h3 class="text-right dtheader">
                                            <span id="livedate"><?php echo date("Y/m/d");?></span>
                                        </h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="fa fa-clock-o clock"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="cdt">
                                                <span id="livetime"><?php echo date("h:iA"); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-tile tile-orange item2 mtop">
                                    <div class="tile-heading th">
                                        <span class="date-title tito">TIME IN / OUT</span>
                                    </div>
                                    <h1 class="text-right h1tr">
                                        <clockin id="clock_in">?</clockin>
                                        <inout id="inout"></inout>
                                    </h1>
                                </div>
                                <div class="info-tile tile-orange item2 emp_charts">
                                    <div class="col-md-6">
                                        <div class="info-tile tile-orange aattendance">
                                            <div class="tile-heading thaa">
                                                <span>Average Attendance</span>
                                            </div>
                                            <div class="tile-body tbattended">
                                                <span class="adetails"><average class="average">N/A</average>%</span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success progress-bar-striped active paverage" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-tile tile-orange sattended">
                                            <div class="tile-heading thaa">
                                                <span>Schedules Attended</span>
                                            </div>
                                            <div class="tile-body tbattended">
                                                <span class="adetails"><attended class="attended">N/A%</attended></span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped active pattended" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="info-tile tile-orange sattended">
                                            <div class="tile-heading thaa">
                                                <span>Schedules Unattended</span>
                                            </div>
                                            <div class="tile-body tbattended">
                                                <span class="adetails"><unattended class="unattended">N/A%</unattended></span>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger progress-bar-striped active punattended" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-tile tile-orange emp_details">
                                            <p class="nomargin text-left">
                                                <b class="btitle">ECODE</b> : 
                                                <ecode class="result" id="ecode"></ecode>
                                            </p><hr class="schedhr">
                                            <p class="nomargin text-left">
                                                <b class="btitle">FULLNAME</b> : 
                                                <fullname  class="result" id="fullname"></fullname>
                                            </p><hr class="schedhr">
                                            <p class="nomargin text-left">
                                                <b class="btitle">BRANCH</b> : 
                                                <branch class="result" id="branch"></branch>
                                            </p><hr class="schedhr">
                                            <p class="nomargin text-left">
                                                <b class="btitle">DEPARTMENT</b> : 
                                                <department class="result" id="department"></department>
                                            </p><hr class="schedhr">
                                            <p class="nomargin text-left">
                                                <b class="btitle">POSITION</b> : 
                                                <position class="result" id="position"></position>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-tile tile-orange item2 empproscan">
                                    <div class="tile-heading thaa">
                                        <span class="date-title dtep">EMPLOYEE PROFILE</span>
                                    </div>
                                    <center>
                                        <img class="loadingimg" id="image_name" src="<?php echo $this->config->item('base_urlmain');?>/assets/img/default-user-icon.png">
                                        <input type="hidden" id="base_urlmain" value="<?php echo $this->config->item('base_urlmain');?>">
                                    </center>
                                </div>
                                <div class="info-tile tile-orange item2 scanpanel">
                                    <center>
                                        <label class="nomargin scanpanel-title">SCAN EMPLOYEE CODE HERE</label>
                                        <input type="text" id="employee_code" class="form-control text-center">
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->
        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

<div id="modal_pinnumber" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><!--modal-->
    <div class="modal-dialog modal-sm mdpin">
        <div class="modal-content"><!---content-->
            <div class="modal-header mhpin">
                <center><h4 class="modal-title mtpin">Please enter your PIN #</h4></center>
            </div>
            <div class="modal-body mbpin">
                <form id="frm_pin">
                    <input type="text" class="form-control" id="pinnumber" name="pinnumber" data-error-msg="Employee PIN is Required!" required>
                </form>
            </div>
            <div class="modal-footer mfpin">
              <center>
                <button type="button" id="enter_pin" class="btn btn-success enter"> 
                    <i class="fa fa-check-circle"></i> Enter
                </button>
                <button type="button" data-dismiss="modal" id="cancel_pin" class="btn btn-danger cancel">
                    <i class="fa fa-times-circle"></i> Cancel
                </button>
              </center>
            </div>
        </div><!--content-->
    </div>
</div>

<div id="modal_menu" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static"><!--modal-->
    <div class="modal-dialog modal-sm m-menu">
        <div class="modal-content m-menu-content"><!---content-->
            <div class="modal-body m-menu-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <button class="btn btn-default btn_menu btn_other_menu" id="btn_time_in">TIME IN</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-default btn_menu btn_other_menu" id="btn_time_out">TIME OUT</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <button class="btn btn-default btn_menu btn_other_menu" id="btn_break_out">BREAK OUT</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-default btn_menu btn_other_menu" id="btn_break_in">BREAK IN</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <button class="btn btn-default btn_menu btn_other_menu" id="btn_ot_out">OT OUT</button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" data-dismiss="modal" id="btn_menu_cancel" class="btn btn_menu btn-danger cancel ">
                                <i class="fa fa-times-circle"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--content-->
    </div>
</div>

<div id="modal_break_out_list" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" style="z-index: 1400;"><!--modal-->
    <div class="modal-dialog modal-sm" style="margin-top: 250px;-webkit-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);">
        <div class="modal-content"><!---content-->
            <div class="modal-body">
                <div id="breakoutlist"></div>
                <div class="row" style="margin: 5px;">
                    <button type="button" class="btn btn-danger" id="btn_close_break_out_list" style="width: 100%; font-size: 13pt;padding: 10px;background: #37474F!important;color:#ECEFF1;border: 1px solid #ECEFF1!important;">Close</button>
                </div>
            </div>
        </div><!--content-->
    </div>
</div>

<div id="modal_break_in_list" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" style="z-index: 1400;"><!--modal-->
    <div class="modal-dialog modal-sm" style="margin-top: 250px;-webkit-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);
box-shadow: 1px 1px 24px 0px rgba(0,0,0,0.75);">
        <div class="modal-content"><!---content-->
            <div class="modal-body">
                <div id="breakinlist"></div>
                <div class="row" style="margin: 5px;">
                    <button type="button" class="btn btn-danger" id="btn_close_break_in_list" style="width: 100%; font-size: 13pt;padding: 10px;background: #37474F!important;color:#ECEFF1;border: 1px solid #ECEFF1!important;">Close</button>
                </div>
            </div>
        </div><!--content-->
    </div>
</div>


<?php echo $_rights; ?>
<script>
$(document).ready(function(){
var interval = 60000; // 1 Minute
var attemptinterval=300000; // 5 Minutes 
var hourInterval= 3600000;// 1 Hour 
var trxn_mode; var emp_id=0;


    $(document).keyup(function(e) {
         if (e.keyCode == 27) { // escape key maps to keycode `27`
                clearinfos();
                clearchartstime();
                $('#employee_code').focus();
        }
    });

    function getlivetime() {
        $.ajax({
          type: 'POST',
          url: 'SchedTimein/transaction/getlivetime',
          dataType: 'json',
          success: function (response) {
                $('#livetime').text(response.livetime);
                $('#livedate').text(response.livedate);
            },
          complete: function (response) {
                  setTimeout(getlivetime, interval);
          }
        });
    };

    // function getlivetime() {
    //     var dt = new Date();
    //     var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //     document.write(time);
    // };

    setTimeout(getlivetime, interval);
    
    function attemptrefresh() {
          var _data=$('#').serializeArray();
          $.ajax({
            type: 'POST',
            url: 'Employee/transaction/attemptrefresh',
            dataType: 'json',
            complete: function (response) {
                    setTimeout(attemptrefresh, attemptinterval);
            }
          });
    }

    setTimeout(attemptrefresh, attemptinterval);

    function reloadPage(){
        location.reload(true);
    }

    setTimeout(reloadPage,hourInterval);

    $('#cancel_pin').on('click',function(){
        $('#modal_menu').modal('show');
    });

    $('#employee_code').keypress(function(evt){
        if(evt.keyCode==13){
            check_code().done(function(response){
                if (response.stat == "error"){
                defaultvalues();
                clearchartstime();
                swal({
                      title: response.title,
                      text: response.msg,
                      type: response.stat,
                      timer: 2000,
                      showConfirmButton: false
                });
              }else{
                  defaultvalues();
                  clearchartstime();
                  emp_id = response.emp[0].employee_id;

                  var base_urlmain = $('#base_urlmain').val();

                  $('#image_name').attr('src',base_urlmain+'/'+response.emp[0].image_name);
                  $('#ecode').text(response.emp[0].ecode);
                  $('#fullname').text(response.emp[0].full_name );
                  $('#branch').text(response.emp[0].branch);
                  $('#department').text(response.emp[0].department);
                  $('#position').text(response.emp[0].position);
              }
            }).always(function(response){
                $.unblockUI();
                if (response.stat == "success"){
                  $('#modal_menu').modal('show');
                }
            });
            $('#employee_code').val('');
        }
    });

    $('#enter_pin').on('click',function(){
        emp_time();
    });

    $('#pinnumber').keypress(function(evt){
        if(evt.keyCode==13){
            emp_time();
        }
    });

    $('#btn_time_in').click(function(){
        trx_mode = "time_in";
        chck_sched(trx_mode);
    });

    $('#btn_time_out').click(function(){
        trx_mode = "time_out";
        chck_sched(trx_mode);
    });

    $('#btn_ot_out').click(function(){
        trx_mode = "ot_out";
        chck_sched(trx_mode);
    });

    $('#btn_break_out').click(function(){
        $('#breakoutlist').html('');
        trx_mode = "break_out";
        chck_sched(trx_mode);
    });

    $('#btn_break_in').click(function(){
        $('#breakinlist').html('');
        trx_mode = "break_in";
        chck_sched(trx_mode);
    });

    $('#btn_menu_cancel').click(function(){
      clearinfos();
      clearchartstime();
      setTimeout(function(){
        $('#employee_code').focus();
      },500);
    });


    var chck_sched = function(mode){
        check_employee_sched(mode,emp_id).done(function(response){
            $.unblockUI();
            if (response.status == 0){

                swal({
                    title: response.title,
                    text: response.msg,
                    type: "warning",
                    customClass: 'swal-wide',
                    timer: 2000,
                    showConfirmButton: false
                });

                showNotification(response);

            }else if (response.status == 2){

                swal({
                    title: response.title,
                    text: response.msg,
                    type: "warning",
                    customClass: 'swal-wide',
                    timer: 2000,
                    showConfirmButton: false
                });

                showNotification(response);
                $('#modal_menu').modal('hide');
                clearinfos();
                clearchartstime();
                $('#employee_code').focus();

            }else if (response.status == 3){

                $('#modal_break_out_list').modal('show');
                var rows = response.break_list;

                $.each(rows,function(i,value){

                    $('#breakoutlist').append(newRowItem_breakout({
                        break_is_out : value.break_is_out,
                        employee_break_id : value.employee_break_id,
                        break_allowance : value.break_allowance,
                        schedule_employee_id : value.schedule_employee_id,
                        break_time : value.break_time,
                        sort_key: value.sort_key
                    }));
                });

                process_btn_break_out();

            }else if (response.status == 4){

                $('#modal_break_in_list').modal('show');
                var rows = response.break_list;

                $.each(rows,function(i,value){
                    $('#breakinlist').append(newRowItem_breakin({
                        break_is_in : value.break_is_in,
                        employee_break_id : value.employee_break_id,
                        break_allowance : value.break_allowance,
                        schedule_employee_id : value.schedule_employee_id,
                        break_time : value.break_time,
                        sort_key: value.sort_key
                    }));
                });


                process_btn_break_in();
            }
            else{

                $('#modal_menu').modal('hide');
                $('#modal_pinnumber').modal('show');
                setTimeout(function(){
                    $('#pinnumber').val('');
                    $('#pinnumber').focus();
                },600);

            }
        });
    };

    var emp_break_out = function(){
        trxn_mode = "break_out";

        break_out().done(function(response){

            if (response.stat != "success"){

                if (response.trx_mode == 1){
                    
                    setTimeout(function(){
                        $('#modal_menu').modal('toggle');
                    },500);

                }
                    swal({
                        title: response.title,
                        text: response.msg,
                        type: "warning",
                        customClass: 'swal-wide',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $.unblockUI();
                    showNotification(response);

            }
            else if(response.stat == "success"){
                $.unblockUI();

                $('#modal_break_out_list').modal('show');
                var rows = response.break_list;

                $.each(rows,function(i,value){

                    $('#breakoutlist').append(newRowItem_breakout({
                        break_is_out : value.break_is_out,
                        employee_break_id : value.employee_break_id,
                        break_allowance : value.break_allowance,
                        schedule_employee_id : value.schedule_employee_id,
                        break_time : value.break_time,
                        sort_key: value.sort_key
                    }));
                });

                process_btn_break_out();
            }
        });
    }

    var emp_break_in = function(){
        trxn_mode = "break_in";

        break_in().done(function(response){

            if (response.stat != "success"){

                if (response.trx_mode == 1){
                    
                    setTimeout(function(){
                        $('#modal_menu').modal('toggle');
                    },500);

                }
                    swal({
                        title: response.title,
                        text: response.msg,
                        type: "warning",
                        customClass: 'swal-wide',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    $.unblockUI();
                    showNotification(response);

            }else if(response.stat == "success"){
                $.unblockUI();

                $('#modal_break_in_list').modal('show');
                var rows = response.break_list;

                $.each(rows,function(i,value){

                    $('#breakinlist').append(newRowItem_breakin({
                        break_is_in : value.break_is_in,
                        employee_break_id : value.employee_break_id,
                        break_allowance : value.break_allowance,
                        schedule_employee_id : value.schedule_employee_id,
                        break_time : value.break_time,
                        sort_key: value.sort_key
                    }));
                });

                process_btn_break_in();
            }
        });
    }

    function addMinutes(date, minutes){
          var currentDate = new Date(date);
          return currentDate.setTime(currentDate.getTime() + minutes*60*1000);
    }

    var newRowItem_breakout=function(d){

        if (d.break_is_out == 1){
            return '<div class="row" style="margin: 5px;"><button id="'+d.employee_break_id+'" class="btn btn-default" style="width: 100%; font-size: 13pt;padding: 10px;border: 1px solid #37474F!important;cursor: not-allowed;" disabled>'+d.break_time+'</button></div>';
        }else{
            return '<div class="row" style="margin: 5px;">'+'<input type="button" id="'+d.employee_break_id+'" name="btn_break_out" class="btn btn-default" style="width: 100%; font-size: 13pt;padding: 10px;border: 1px solid #37474F!important;" value="'+d.break_time+'">'+'</div>';
        }

    };

    var newRowItem_breakin=function(d){

        // var dNow = new Date();
        // var utcdate =  dNow.getFullYear() + '-' 
        //             + (dNow.getMonth()+ 1) + '-' 
        //             + dNow.getDate() + ' ' 
        //             + dNow.getHours() + ':'
        //             + dNow.getMinutes() + ':'
        //             + dNow.getSeconds();

        if (d.break_is_in == 1){
            return '<div class="row" style="margin: 5px;"><button id="'+d.employee_break_id+'" class="btn btn-default" style="width: 100%; font-size: 13pt;padding: 10px;border: 1px solid #37474F!important;cursor: not-allowed;" disabled>'+d.break_time+'</button></div>';
        }else{

            return '<div class="row" style="margin: 5px;">'+'<input type="button" id="'+d.employee_break_id+'" name="btn_break_in" class="btn btn-default" style="width: 100%; font-size: 13pt;padding: 10px;border: 1px solid #37474F!important;" value="'+d.break_time+'"></div>';
        }

    };

    function process_btn_break_out(){

        $('input[name^="btn_break_out"]').click(function(){
            var employee_break_id = $(this).attr('id');
            process_break_out(employee_break_id).done(function(response){
                showNotification(response);
                if (response.stat == "success"){
                    $('#modal_break_out_list').modal('hide');
                    $('#modal_menu').modal('hide');
                    $('#clock_in').text(response.break_out);
                    $('#inout').text('BREAK OUT');
                    $('#inout').css('color','27ae60');
                }else{
                    swal({
                        title: response.title,
                        text: response.msg,
                        type: "warning",
                        customClass: 'swal-wide',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }

            }).always(function(){
                $.unblockUI();
            });

        });
    };

    function process_btn_break_in(){

        $('input[name^="btn_break_in"]').click(function(){
            var employee_break_id = $(this).attr('id');
            process_break_in(employee_break_id).done(function(response){
                showNotification(response);
                if (response.stat == "success"){
                    $('#modal_break_in_list').modal('hide');
                    $('#modal_menu').modal('hide');
                    $('#clock_in').text(response.break_in);
                    $('#inout').text('BREAK IN');
                    $('#inout').css('color','red');
                }else{
                    swal({
                        title: response.title,
                        text: response.msg,
                        type: "warning",
                        customClass: 'swal-wide',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }).always(function(){
                $.unblockUI();
            });

        });
    };


    $('#btn_close_break_out_list').click(function(){

        $('#modal_break_out_list').modal('hide');
        $('#modal_menu').modal('show');

    });

    $('#btn_close_break_in_list').click(function(){

        $('#modal_break_in_list').modal('hide');
        $('#modal_menu').modal('show');

    });


    var emp_time = function(){
        getlivetime();
        if (validateRequiredFields($('#frm_pin'))){
            process_time_txn().done(function(response){
                showNotification(response);

                if (response.status > 0 ){

                    swal({
                          title: response.title,
                          text: response.msg,
                          type: response.stat,
                          customClass: 'swal-wide',
                          timer: 2000,
                          showConfirmButton: false
                    });

                        var jsoncount=response.period_stats.length-1;
                        var period_stats='';
                        var totalpercent=0;
                        var renderedpercent=0;
                        var average=0;

                        var days_attended=0;
                        var avg_attended=0;
                        var days_unattended=0;
                        var days_count=0;
                        var avg_unattended=0;

                        for(var i=0;parseInt(jsoncount)>=i;i++){

                            totalpercent+= 100;
                            renderedpercent+= parseInt(response.period_stats[i].stat_completion);

                            var days_attended_count = (response.period_stats[i].stat_completion > 0 ) ? 1 : 0;
                            days_attended += parseInt(days_attended_count);
                            days_count +=1;
                            //in
                            var time = response.period_stats[i].time_in;
                            var timearray = time.split(" ");
                            var timeString = timearray[1];
                            var time_in = getampm(timeString);
                            //out
                            var time = response.period_stats[i].time_out;
                            var timearray = time.split(" ");
                            var timeString = timearray[1];
                            var time_out = getampm(timeString);

                                period_stats+='<h4 style="margin:10px;margin-top:5;margin-bottom:0;color:white;">'+response.period_stats[i].day+ '<span style="float:right !important;">' +response.period_stats[i].date+'</span></h4>'+
                                        '<p style="margin:10px;margin-top:0;margin-bottom:0;color:white;">'+response.period_stats[i].stat_completion+'%<span style="float:right !important;font-weight:400">'+time_in+'-'+time_out+'</span></p>'+
                                        '<div class="progress" style="margin:10px;margin-top:0;margin-bottom:0;color:white;">'+
                                          '<div class="progress-bar progress-bar-success progress-bar-striped active aemployeeprogress" role="progressbar"'+
                                          'aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="color:white;width:'+response.period_stats[i].stat_completion+'%">'+
                                          '</div>'+
                                        '</div><hr>';
                        }

                        average = (renderedpercent/totalpercent)*100;
                        $('.average').text(average.toFixed(2));
                        $('.paverage').css("width",average+"%");
                        $('.avgattendance').text(average+" percent ");

                        avg_attended = (days_attended/days_count)*100;
                        $('.attended').text(avg_attended.toFixed(2)+"%");
                        $('.attended2').text(days_attended);
                        $('.pattended').css("width",avg_attended.toFixed(2)+"%");
                        days_unattended = Math.abs(parseInt(days_attended)-parseInt(days_count))
                        avg_unattended = (days_unattended/days_count)*100;
                        $('.unattended').text(avg_unattended.toFixed(2)+"%");
                        $('.punattended').css("width",avg_unattended.toFixed(2)+"%");
                        $('.unattended2').text(days_unattended);
                        $('.period_stats').html(period_stats);

                        if (trx_mode == "time_in"){
                            $('#clock_in').text(response.clock_in);
                            $('#inout').text('IN');
                            $('#inout').css('color','green');
                        }
                        else if (trx_mode == "time_out"){
                            $('#clock_in').text(response.clock_out);
                            $('#inout').text('OUT');
                            $('#inout').css('color','red');
                        }
                        else if (trx_mode == "ot_out"){
                            $('#clock_in').text(response.overtime_out);
                            $('#inout').text('OT OUT');
                            $('#inout').css('color','red');
                        }

                        //Close PIN Modal
                        $('#modal_pinnumber').modal('hide');
                        
                        setTimeout(function(){
                            $('#employee_code').focus();
                        },600);

                }else{
                    if (response.attempt_status > 0){
                        setTimeout(function(){
                            $('#pinnumber').val('');
                            $('#pinnumber').focus();
                        },600)
                    }else{
                        $('#modal_pinnumber').modal('hide');
                        setTimeout(function(){
                            $('#employee_code').focus();
                        },600);
                    }
                }

            }).always(function(){
                $.unblockUI();
                $('#employee_code').val('');
                $('#pinnumber').val('');
            });
        }
    }

    var check_employee_sched = function(mode,emp_id){
        var _data=$('#').serializeArray();
        _data.push({name : "mode" ,value : mode });
        _data.push({name : "employee_id" ,value : emp_id });
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/check_employee_sched",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    }

    var check_code = function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_code" ,value : $('#employee_code').val() });
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/check_code",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    }

    var break_out=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_id" , value : emp_id});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/break_out",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var break_in=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_id" , value : emp_id});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/break_in",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });

    };

    var process_time_txn=function(){

        var _data=$('#').serializeArray();
        _data.push({name : "mode" , value : trx_mode });
        _data.push({name : "employee_id" , value : emp_id });
        _data.push({name : "pin" ,value : $('#pinnumber').val() });

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/process_time_txn",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };


    var process_break_out=function(employee_break_id){

        var _data=$('#').serializeArray();
        _data.push({name : "employee_break_id" ,value : employee_break_id });

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/process_break_out",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var process_break_in = function(employee_break_id){

        var _data=$('#').serializeArray();
        _data.push({name : "employee_break_id" ,value : employee_break_id });

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedTimein/transaction/process_break_in",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var validateRequiredFields=function(f){
        var stat=true;

        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
            if($(this).val()==""){
                showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                $(this).closest('div.form-group').addClass('has-error');
                $(this).focus();
                stat=false;
                return false;
            }
        });

        return stat;
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

    var showSpinningProgress=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Processing</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var defaultvalues=function(){
        var base_urlmain = $('#base_urlmain').val();
        $('#fullname').text("Not Found");
        $('#image_name').attr('src',base_urlmain+"/assets/img/default-user-icon.png");
        $('#ecode').text("Not Found");
        $('#fullname').text("Not Found");
        $('#branch').text("Not Found");
        $('#department').text("Not Found");
        $('#position').text("Not Found");
        $('#clock_in').text("?");
        $('#clock_out').text("?");
    }

    var clearchartstime=function(){
        $('.unattended').text("N/A%");
        $('.attended').text("N/A%");
        $('.average').text("N/A");
        $('.punattended').css('width','0%');
        $('.pattended').css('width','0%');
        $('.paverage').css('width','0%');
        $('#clock_in').text('?');
        $('#inout').text('');
    }

    var clearinfos=function(){
        var base_urlmain = $('#base_urlmain').val();
        $('#fullname').text("");
        $('#image_name').attr('src',base_urlmain+"/assets/img/default-user-icon.png");
        $('#ecode').text("");
        $('#fullname').text("");
        $('#branch').text("");
        $('#department').text("");
        $('#position').text("");
        $('#clock_in').text("?");
        $('#clock_out').text("?");
    };

    var getampm=function(timeString){
        var hourEnd = timeString.indexOf(":");
        var H = +timeString.substr(0, hourEnd);
        var h = H % 12 || 12;
        var ampm = H < 12 ? "AM" : "PM";
        var time = h + timeString.substr(hourEnd, 3) + ampm;
        return time;
    }

    $('#employee_code').focus(500);

});

</script>
</body>
</html>
