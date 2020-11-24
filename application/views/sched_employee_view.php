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

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">

    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">



    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet">                   <!-- Custom Checkboxes / iCheck -->

    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">


    <link href="assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>


<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>


<!-- Date range use moment.js same as full calendar plugin -->
<script src="assets/js/plugins/fullcalendar/moment.min.js"></script>
<!-- Data picker -->
<script src="assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- twitter typehead -->
<script src="assets/plugins/twittertypehead/handlebars.js"></script>
<script src="assets/plugins/twittertypehead/bloodhound.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.bundle.min.js"></script>
<script src="assets/plugins/twittertypehead/typeahead.jquery.min.js"></script>

<!-- touchspin -->
<script type="text/javascript" src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js"></script>

<!-- numeric formatter -->
<script src="assets/plugins/formatter/autoNumeric.js" type="text/javascript"></script>
<script src="assets/plugins/formatter/accounting.js" type="text/javascript"></script>

<script type="text/javascript" src="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <style>

        .toolbar{
            float: left;
        }
/*        td.breaksetting{
            background: url('assets/img/show.png') no-repeat center center !important;
            cursor: pointer;
        }*/
/*        td.breaksetting {
            background: url('assets/img/Folder_Closed.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('assets/img/Folder_Opened.png') no-repeat center center;
        }*/

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
            width: 100%;
        }
        .bootstrap-timepicker-widget.dropdown-menu {
            z-index: 1400!important;

        }
        .checks{
            height:20px !important;
        }
        .cancel{
          background-color:#27ae60 !important;
        }
        .regularday{
          background-color:#81c784 ;
        }
        #tbl_scheduling tbody tr{
          cursor:pointer;
        }

        button[name^="allow_ot"],button[name^="cancel_dayoff"]{
            padding: 5px!important;
            font-size: 15px!important;
            margin-right: 3px;
        }
        .tbl_break{
            width: 100%; height: auto; border: 1px solid #CFD8DC;font-size: 10pt;  
            border-collapse: collapse;
            border-spacing: 0;
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
             -khtml-user-select: none; /* Konqueror HTML */
               -moz-user-select: none; /* Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
                    user-select: none; /* Non-prefixed version, currently
                                          supported by Chrome and Opera */
        }

        .tbl_break tr:nth-child(even){background-color: #f2f2f2}
        .break_row{margin: 5px;}

        .tbl_break td{
            text-align: center;padding: 10px;border-bottom: 1px solid #CFD8DC;"
        }
        .tbl_break th{
            text-align: center;padding: 4px;background: #2c3e50;color:#fff;border: 1px solid #fff;
        }
        .add_break{
            margin-right: 5px;color: #2E7D32;cursor: pointer;padding: 5px;border-radius: 50%;
        }
        .remove_break{
            margin-right: 5px;color: #c62828;cursor: pointer;padding: 5px;border-radius: 50%;
        }

    </style>
<?php echo $loaderscript; ?>
</head>

<body class="animated-content">

<?php echo $_top_navigation; ?>

<div id="wrapper">
    <div id="layout-static">

        <?php echo $_side_bar_navigation;?>

        <div class="static-content-wrapper white-bg">
            <div class="static-content" >
                <div class="page-content">

                    <ol class="breadcrumb" style="margin-bottom:0px;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="SchedEmployee">Employee Schedule</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_product_list">
                            <div class="panel panel-default">
                                        <button class="btn right_employee_schedule_create"  id="btn_new" style="width:240px;background-color:#2ecc71;color:white;" title="Create New Schedule" >
                                        <i class="fa fa-file"></i> New Employee Schedule</button>
                                        <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                             <center><h2 style="color:white;font-weight:300;">Employee Schedule</h2></center>
                                        </div>
                                    <div class="panel-body table-responsive" style="padding-top:8px;">
                                        <div class="row" style="margin:10px;">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Employee :</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="employee_id_dt" id="employee_id_dt" data-error-msg="Please Select Employee" required>
                                                            <option value="">[ Select Employee ]</option>
                                                           <?php
                                                                                foreach($employee_list1 as $row)
                                                                                {
                                                                                    echo '<option value="'.$row->employee_id  .'" dept="'.$row->department.'" branch="'.$row->branch.'" ecode="'.$row->ecode.'">'.$row->ecode.'&nbsp&nbsp&nbsp&nbsp'.$row->full_name.'</option>';
                                                                                }
                                                                                ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Period :</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="pay_period_id_dt" id="pay_period_id_dt" data-error-msg="Please Select Employee" required>
                                                            <option value="">[ Select Pay Period ]</option>
                                                           <?php
                                                                                foreach($pay_period as $row)
                                                                                {
                                                                                    echo '<option value="'.$row->pay_period_id  .'">'.$row->pay_period_start.'&nbsp ~ &nbsp'.$row->pay_period_end.'</option>';
                                                                                }
                                                                                ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">ECODE :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control text-center" id="emp_ecode" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Branch :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control text-center" id="emp_branch" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-4 inlinecustomlabel-sm"  for="inputEmail1">Department :</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="emp_dept" class="form-control text-center" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <table id="tbl_scheduling" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><center><input type='checkbox' id='checkall_sched' name='' value=""></center></th>
                                                    <th width="5%"></th>
                                                    <th>Day</th>
                                                    <th width="10%">Date</th>
                                                    <th width="5%">Time Allowance</th>
                                                    <th>Time In</th>
                                                    <th>Time Out</th>
                                                    <th>Total</th>
                                                    <th width="20%">Shift</th>
                                                    <th>IS IN?</th>
                                                    <th>IS OUT?</th>
                                                    <th width="10%">Schedule Type</th>
                                                    <th>Day Type</th>
                                                    <th>Break</th>
                                                    <th width="15%"><center>Action</center></th>
                                                 </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                <div class="panel-footer">
                                  <button class="btn" style="background-color:#2ecc71;color:white;" id="batch_update">Batch Update</button>
                                  <button class="btn" style="background-color:#e74c3c;color:white;" id="batch_delete">Batch Delete</button>
                                </div>
                            </div> <!--panel default -->

                        </div> <!--rates and duties list -->
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

            <div id="modal_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div><!---content-->
                </div>
              </div>
            </div><!---modal-->

            <div id="modal_confirmation_break" class="modal fade" tabindex="-1" role="dialog" style="z-index: 9999;"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes_break" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div><!---content-->
                </div>
              </div>
            </div><!---modal-->

            <div id="modal_emp_break" class="modal fade" tabindex="-1" role="dialog" style="z-index: 1400;"><!--modal-->
                <div class="modal-dialog modal-sm" style="min-width: 400px;">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Create New Break</h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_employee_break">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Break Time : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control timepicker2" name="emp_break_time" placeholder="Break Time" data-error-msg="Break Time is Required!" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Allowance : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control numeric" name="emp_break_allowance" placeholder="Break Allowance" data-error-msg="Break Time is Required!" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Sort Key : </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control sort_key" name="emp_sort_key" placeholder="Sort Key" data-error-msg="Sort Key is Required!" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_save_emp_break" type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                            <button id="btn_cancel_emp_break" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content-->
                </div>
              </div>
            </div><!---modal-->


            <div id="modal_create_schedule" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Employee Schedule : <transaction class="transaction_type"></transaction></h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_schedule">
                            <div class="row eventrow">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Transaction Type :</label>
                                    <div class="col-sm-8">
                                      <input class="tevent" type="checkbox" id="toggle-two" data-width="100%">

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Pay Period :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="pay_period_id" id="pay_period_id" data-error-msg="Please Select Pay Period" required>
                                            <option value="">[ Select Pay Period ]</option>
                                           <?php
                                                                foreach($pay_period as $row)
                                                                {
                                                                    echo '<option value="'.$row->pay_period_id  .'">'.$row->pay_period_start.'&nbsp - &nbsp'.$row->pay_period_end.'</option>';
                                                                }
                                                                ?>
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row groupselect">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Group :</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="group_id" id="group_id" data-error-msg="Please Select Group">
                                          <option value="">[ Select Group ]</option>
                                         <?php
                                                 foreach($ref_group as $row)
                                                 {
                                                     echo '<option value="'.$row->group_id  .'">'.$row->group_desc.'</option>';
                                                 }
                                                              ?>
                                      </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row employeesselect">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Employee :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="employee_id" id="employee_id" data-error-msg="Please Select Employee">
                                            <option value="">[ Select Employee ]</option>
                                           <?php
                                                                foreach($employee_list as $row)
                                                                {
                                                                    echo '<option value="'.$row->employee_id  .'" dept="'.$row->department.'" branch="'.$row->branch.'" ecode="'.$row->ecode.'">'.$row->ecode.'&nbsp&nbsp&nbsp&nbsp'.$row->full_name.'</option>';
                                                                }
                                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Pay Type :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="sched_refpay_id" placeholder="SchedPay Type" data-error-msg="SchedPay Type is Required!" required>
                                            <option value="">[ Select SchedPay Type ]</option>
                                            <?php
                                                foreach($schedpay as $row)
                                                {
                                                    // echo '<option value="'.$row->sched_refpay_id  .'">'.$row->schedpay.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Shifting :</label>
                                    <div class="col-sm-8">
                                      <button id="btn_show_template" type="button" class="btn" style="background-color:#16a085;color:white;width:100%;">SELECT SHIFTING</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Date :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control date-picker datesched" name="date" placeholder="Date" data-error-msg="Date is Required!" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Day :</label>
                                    <div class="col-sm-8">
                                        <input tyoe="text" class="form-control daysched" name="day" placeholder="Day" data-error-msg="Day is Required!" readonly>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Allowance - IN:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_advance_in_out" name="advance_in_out" placeholder="Early In" data-error-msg="Early In is Required!">
                                        <center><small>Minutes must not exceed to 120!</small></center>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In Grace Period (Minutes): </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_grace_period" name="grace_period" placeholder="Grace Period">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_timein" name="time_in" placeholder="Time In" data-error-msg="Time In is Required!" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Out :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_timeout" name="time_out" placeholder="Time Out" data-error-msg="Time Out is Required!" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Total Break:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_break_time" name="break_time" placeholder="Break Time" data-error-msg="Break Time is Required!" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_create" type="button" class="btn" style="background-color:#2ecc71;color:white;">Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content-->
                </div>
            </div><!---modal-->

            <div id="modal_schedbatch_update" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Employee Schedule : Batch Update</h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_schedbatch_update">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Pay Period :</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="pay_period_id" id="pay_period_id_up" data-error-msg="Please Select Pay Period" required>
                                            <option value="">[ Select Pay Period ]</option>
                                           <?php
                                                                foreach($pay_period as $row)
                                                                {
                                                                    echo '<option value="'.$row->pay_period_id  .'">'.$row->pay_period_start.'&nbsp - &nbsp'.$row->pay_period_end.'</option>';
                                                                }
                                                                ?>
                                          </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Shifting :</label>
                                    <div class="col-sm-8">
                                      <button  type="button" class="btn btn_show_template" style="background-color:#16a085;color:white;width:100%;">SELECT SHIFTING</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Allowance - IN/OUT:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_advance_in_out" name="advance_in_out" placeholder="Early In" data-error-msg="Early In is Required!">
                                        <center><small>Minutes must not exceed to 120!</small></center>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_timein" name="time_in" placeholder="Time In" data-error-msg="Time In is Required!" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Out :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_timeout" name="time_out" placeholder="Time Out" data-error-msg="Time Out is Required!" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Break Time :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control schedule_template_break_time" name="break_time" placeholder="Break Time" data-error-msg="Break Time is Required!" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row">
                              <center>
                                <button id="btn_show_template" type="button" class="btn" style="background-color:#16a085;color:white;width:100%;">SELECT Schedule Template</button>
                              </center>
                            </div> -->
                            <!-- <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Total :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control numeric" name="total" placeholder="Total Hours" data-error-msg="Total is Required!" disabled>
                                    </div>
                                </div>
                            </div> -->
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_updatesched_batch" type="button" class="btn" style="background-color:#2ecc71;color:white;">Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content-->
                </div>
            </div><!---modal-->

            <!-- Modal -->
            <div id="modal_show_template" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Choose Schedule Template</h4>
                  </div>
                  <div class="modal-body">
                    <table id="tbl_schedule_template" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Template Name</th>
                                <th>Time Allowance</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Break Time</th>
                                <th width="80%"><center>Action</center></th>
                             </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="btn_create_schedtemplate" class="btn btn-green">Create</button>
                    <button type="button" class="btn btn-default btndelete" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <!-- Modal -->
            <div id="modal_create_schedtemplate" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#27ae60;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:white;"><schedtransac id="schedtransac"></schedtransac> Schedule Template</h4>
                  </div>
                  <div class="modal-body">
                    <form id="frm_schedule_template">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Schedule Template Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="shift" placeholder="Schedule Template Name" data-error-msg="Schedule Template name is Required!" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Allowance - IN/OUT:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " name="schedule_template_advance_in_out" placeholder="Early In" data-error-msg="Time Allowance is Required!" required>
                                <center><small>Minutes must not exceed to 120!</small></center>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In Grace Period (Minutes): </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="grace_period" placeholder="Grace Period">
                            </div>
                        </div>
                    </div>                    
                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control timepicker2 " name="schedule_template_timein" placeholder="Time In" data-error-msg="Time In is Required!" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time Out :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control timepicker2 " name="schedule_template_timeout" placeholder="Time Out" data-error-msg="Time Out is Required!" required>
                                <input type="hidden" name="total_break" id="total_break">
                            </div>
                        </div>
                    </div>
                    <hr>
<!--                     <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Break Time :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control timepicker2 " name="schedule_template_break_time" placeholder="Break Time" data-error-msg="Break Time is Required!" required>
                            </div>
                        </div>
                    </div> -->

                    <div class="row break_row">
                        <table class="tbl_break">
                            <thead>
                                <tr>
                                    <th>Break Time</th>
                                    <th>Break Allowance (Mins)</th>
                                    <th>Sort Key</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="break_time[]" class="form-control timepicker2 break_time" data-error-msg="Break time is Required!" required></td>
                                    <td><input type="text" name="break_allowance[]" class="form-control numeric"></td>
                                    <td width="15%"><input type="text" name="sort_key[]" id="sort_key" class="form-control sort_key" data-error-msg="Sort Key is Required!" required></td>
                                    <td width="15%">
                                        <span class="fa fa-plus add_break"></span>
                                        <span class="fa fa-times remove_break"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="btn_save_schedtemplate" class="btn btn-green">Save</button>
                    <button type="button" class="btn btn-default btndelete" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <div id="modal_confirmation_schedtemplate" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content"><!---content-->
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Deletion</h4>
                        </div>

                        <div class="modal-body">
                            <p id="modal-body-message">Are you sure ?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes_sched" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close_sched" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div><!---content---->
                </div>
              </div>
            </div><!---modal-->

            <div id="modal_manual_inout" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#16a085;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:white;"><schedtransac id="manualtransac"></schedtransac> In & Out : Status</h4>
                  </div>
                  <div class="modal-body">
                    <form id="frm_manual_inout">
                      <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Name :</label>
                            <div class="col-sm-8">
                                <fullname id="full_name" style="font-size:12pt;"></fullname>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Date :</label>
                            <div class="col-sm-8">
                                <fullname id="d_date" style="font-size:12pt;"></fullname>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Day :</label>
                            <div class="col-sm-8">
                                <fullname id="d_day" style="font-size:12pt;"></fullname>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Schedule :</label>
                            <div class="col-sm-8">
                                <fullname id="d_schedinout" style="font-size:12pt;"></fullname>
                            </div>
                        </div>
                      </div>
                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Manual Time In :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control timepicker2 clock_in" name="clock_in" placeholder="Time In" data-error-msg="Manual Time In is Required!" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Manual Time Out :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control timepicker2 clock_out" name="clock_out" placeholder="Time Out" data-error-msg="Manual Time Out is Required!" required>
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="btn_manual_inout" class="btn btn-green">Save</button>
                    <button type="button" class="btn btn-default btndelete" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <div id="modal_show_excluded" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#16a085;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:white;">Excluded</h4>
                  </div>
                  <div class="modal-body" style="height:500px;overflow:scroll;">
                    <table class="table table-striped">
                      <tbody class="excluded_preview">

                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default btndelete" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <div id="modal_show_emp_ingroup" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header" style="background-color:#16a085;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color:white;">Excluded</h4>
                  </div>
                  <div class="modal-body">
                    <div class="container-fluid">
                      <table id="tbl_group_emp" class="table table-responsive">
                        <thead>
                            <th>Employee name</th>
                            <th><center>Include?</center></th>
                        </thead>
                      </table>
                      <tbody>

                      </tbody>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="select_all"><checktype id="checktype">Check all</checktype></button>
                    <button type="button" class="btn btn-default btndelete" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

            <div id="modal_confirm_dayoff" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Dayoff?</h4>
                        </div>

                        <div class="modal-body">

                            <img src="assets/img/question_mark.png" style="width: 50px; position: absolute;margin-left: 30px;"> 
                            <p id="modal-body-message" style="font-size: 12pt;width: 80%;font-weight: normal!important;margin-left: 100px; font-weight: 400;margin-top: 10px;">Are you sure you want to make <datesched class="datesched"></datesched> schedule of <empfullname class="empfullname"></empfullname> as Day Off?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes_dayoff" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_null_dayoff" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e74c3c;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>NOTICE:</h4>
                        </div>

                        <div class="modal-body">
                            <h4 id="modal-body-message" style="color:#c0392b;font-size: 12pt;">Please Select Employee Schedule.</h4>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_dayoff_on" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e74c3c;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span>NOTICE:</h4>
                        </div>

                        <div class="modal-body">
                            <h4 id="modal-body-message" style="color:#c0392b;font-size: 12pt;"><datesched class="datesched"></datesched> Schedule is already Day Off.</h4>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_cancel_dayoff" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Cancel Dayoff?</h4>
                        </div>

                        <div class="modal-body">

                            <img src="assets/img/question_mark.png" style="width: 50px; position: absolute;margin-left: 30px;"> 
                            <p id="modal-body-message" style="font-size: 12pt;width: 80%;font-weight: normal!important;margin-left: 100px; font-weight: 400;margin-top: 10px;">Are you sure you want to cancel day off in <datesched class="datesched"></datesched> schedule of <empfullname class="empfullname"></empfullname>?</p>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_yes_cancel_dayoff" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal_employee_break" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#27ae60;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;font-size: 13pt;">
                                Break List of <span id="emp_fullname"></span> <br />
                                Date : <span id="break_date"></span> | Shift :  <span id="break_shift"></span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <button type="button" id="btn_add_break" class="btn btn-success" style="float: right; margin-right: 5px; margin-top: 0px !important; margin-bottom: 5px;"><i class="fa fa-plus"></i> ADD BREAK</button>
                            <table id="tbl_scheduling_break" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <th>Sort Key</th>
                                    <th>Breaktime</th>
                                    <th>IS Break Out?</th>
                                    <th>IS Break In?</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

<!--             <div id="modal_employee_add_break" class="modal fade" tabindex="-1" role="dialog"> --><!--modal-->
<!--                 <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#27ae60;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:white;font-size: 13pt;">
                                Break List of <span id="emp_fullname"></span> <br />
                                Date : <span id="break_date"></span> | Shift :  <span id="break_shift"></span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-success" style="float: right; margin-right: 5px; margin-top: 0px !important; margin-bottom: 5px;"><i class="fa fa-plus"></i> ADD BREAK</button>
                            <table id="tbl_scheduling_break" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <th>Sort Key</th>
                                    <th>Breaktime</th>
                                    <th>IS Break Out?</th>
                                    <th>IS Break In?</th>
                                    <th>Action</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
 -->

            <link href="assets/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
            <script src="assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

            <link href="assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
            <script src="assets/plugins/sweet-alert/sweetalert.min.js"></script>
<?php echo $_rights; ?>
<script>
  $(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Per Group',
      off: 'Per Employee'
    });
  })
</script>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _period_id; var _selectedIDschedtemplate;
    var _txnModetemplate; var _selectRowObjtemplate; var _sched_refshift_id; var _typestate = 0; var _date;
    var empname;var _selectedName;var _selectedDate = 0;var _selectedDayOff;

    var _selectedIDdt = $('#employee_id_dt').val();
    var _pay_period_id_dt = $('#pay_period_id_dt').val();

    var scheduling=function(){
        dt=$('#tbl_scheduling').DataTable({
            "drawCallback": function (oSettings, json) {
                $.unblockUI();
                $.each( $('#tbl_scheduling tbody tr .isinclass'),function(){
                    if($(this).attr('data-isin')==1){
                      $(this).closest('tbody tr').find('.sched_checkbox').attr('disabled',true);
                    }
                });

                changecolor();

            },
            "order": [[ 3, "asc" ]],
            "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]],
            "ajax": {
            "url": "SchedEmployee/transaction/list",
            "type": "POST",
            "bDestroy": true,
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "employee_id": _selectedIDdt, //id of the user
                    "pay_period_id": _pay_period_id_dt
                    } );
                }
            },
            "columns": [
                { targets:[0],data: "schedule_employee_id",
                    render: function (data, type, full, meta){
                            return "<center><input type='checkbox' id='employee_sched_checkbox' class='sched_checkbox' name='schedule_employee_id[]' value="+data+"></center>";
                    }
                },
                {
                    "targets": [1],
                    "class":          "schedsetting",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": "<center><i class='fa fa-cog' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='Manual In/Out'></i></center>"
                },
                { targets:[2],data: "day" },
                { targets:[3],data: "date",
                    render: function (data, type, full, meta){
                            return "<span class='dataday'>"+data+"</span>";
                    }
                },
                { targets:[4],data: "advance_in_out" },
                { targets:[5],data: "time_in",
                    render: function (data, type, full, meta){
                      var d = data;
                      d = d.split(' ')[1];
                            return d;
                    }
                },
                { targets:[6],data: "time_out",
                    render: function (data, type, full, meta){
                      var d = data;
                      d = d.split(' ')[1];
                            return d;
                    }
                },
                { targets:[7],data: "total" },
                { targets:[8],data: "shift" },
                { targets:[9],data: "is_in",
                    render: function (data, type, full, meta){
                        //alert(data);

                        if(data == 1){
                            return "<center><span style='color:#1B5E20;font-size:14pt;' class='fa fa-check-circle-o isinclass' data-isin='1'></span></center>";
                        }

                        else{
                            return "<center><span style='color:#e74c3c;font-size:14pt;' class='fa fa-times-circle-o isinclass' data-isin='0'></span></center>";
                        }
                    }
                },
                { targets:[10],data: "is_out",
                    render: function (data, type, full, meta){
                        //alert(data);

                        if(data == 1){
                            return "<center><span style='color:#1B5E20;font-size:14pt;' class='fa fa-check-circle-o'></span></center>";
                        }

                        else{
                            return "<center><span style='color:#e74c3c;font-size:14pt;' class='fa fa-times-circle-o'></span></center>";
                        }
                    }
                },
                { targets:[11],data: null,
                    render: function (data, type, full, meta){
                            return "<span class='daytype' data-daytype='"+data.daytype+"' data-dayoff='"+data.is_day_off+"'>"+data.daytype+"</span>";
                    }
                },
                { targets:[12],data: "type",
                    render: function (data, type, full, meta){
                            return "<span class='daytype' data-daytype='"+data+"'>"+data+"</span>";
                    }
                },
                {
                    "targets": [13],
                    "class":          "breaksetting",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": "<center><i class='fa fa-cog' aria-hidden='true' data-toggle='tooltip' data-placement='top' title='Break Settings'></i></center>"
                },
                {
                    targets:[14],data: null,
                    render: function (data, type, full, meta){

                        allowot = (data.allow_ot==1) ? '<button class="btn btn-success btn-sm" name="allow_ot" data-toggle="tooltip" data-placement="top" title="Disable Ot"><i class="glyphicon glyphicon-ok"></i> </button>' : '<button class="btn btn-sm" style="background-color:#d35400;color:white;" name="allow_ot" data-toggle="tooltip" data-placement="top" title="Enable Ot"><i class="glyphicon glyphicon-remove"></i> </button>';


                        var canceldayoff = (data.is_day_off ==1) ? '<button class="btn btn-warning btn-sm" name="cancel_dayoff" data-toggle="tooltip" data-placement="top" title="Cancel Dayoff"><i class="fa fa-times-circle-o" style="font-size: 12pt;color:black;"></i> </button>' : '';

                        return '<center>'+canceldayoff+allowot+right_employee_schedule_edit+right_employee_schedule_delete+'</center>';
                    }
                }


            ],
            language: {
                         searchPlaceholder: "Search Schedule"
                     },
            "rowCallback":function( row, data, index ){

            changecolor();
            }
        });

        $('.numeric').autoNumeric('init');
    };


    var getbreaks=function(schedule_employee_id){
        dt_scheduling_break=$('#tbl_scheduling_break').DataTable({
            "drawCallback": function (oSettings, json) {
                $.unblockUI();
            },
            "paging":   false,
            "ordering": false,
            "info":     false,
            "showNEntries" : false,
            "searching": false,
            "ajax": {
            "url": "SchedEmployee/transaction/emp_breaklist",
            "type": "POST",
            "bDestroy": true,
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "schedule_employee_id": schedule_employee_id
                    } );
                }
            },
            "columns": [
                { targets:[0],data: "sort_key"},
                { targets:[1],data: "break_time"},
                { targets:[2],data: "break_is_out",
                    render: function (data, type, full, meta){
                        if(data == 1){
                            return "<center><span style='color:#1B5E20;font-size:14pt;' class='fa fa-check-circle-o isinclass' data-isin='1'></span></center>";
                        }
                        else{
                            return "<center><span style='color:#e74c3c;font-size:14pt;' class='fa fa-times-circle-o isinclass' data-isin='0'></span></center>";
                        }
                    }
                },
                { targets:[3],data: "break_is_in",
                    render: function (data, type, full, meta){
                        if(data == 1){
                            return "<center><span style='color:#1B5E20;font-size:14pt;' class='fa fa-check-circle-o isinclass' data-isin='1'></span></center>";
                        }
                        else{
                            return "<center><span style='color:#e74c3c;font-size:14pt;' class='fa fa-times-circle-o isinclass' data-isin='0'></span></center>";
                        }
                    }
                },
                {
                    targets:[4],data: null,
                    render: function (data, type, full, meta){

                        update_break = '<button class="btn btn-primary btn-sm" style="margin-right: 4px;padding: 5px;" name="update_break" data-toggle="tooltip" data-placement="top" title="Update"><i class="glyphicon glyphicon-edit"></i> </button>';

                        remove_break = '<button class="btn btn-danger btn-sm" style="margin-right: 4px;padding: 5px;" name="remove_break" data-toggle="tooltip" data-placement="top" title="Remove"><i class="glyphicon glyphicon-trash"></i> </button>';

                        return '<center>'+update_break+remove_break+'</center>';
                    }
                }


            ],
            "rowCallback":function( row, data, index ){

            }
        });

    };

    var compute_breaks= function(){
        var pad = function(num) { return ("0"+num).slice(-2); }
        var totalSeconds = 0;

        $(".tbl_break tbody .break_time").each(function(){
            var currentDuration = $(this).val();
            currentDuration = currentDuration.split(":");
            var hrs = parseInt(currentDuration[0],10);
            var min = parseInt(currentDuration[1],10);
            var sec = parseInt(currentDuration[2],10);
            var currDurationSec = sec + (60*min) + (60*60*hrs); 
            totalSeconds +=currDurationSec;
        });

        var hours = Math.floor(totalSeconds / 3600);
        totalSeconds %= 3600;
        var minutes = Math.floor(totalSeconds / 60);
        var seconds = totalSeconds % 60;

        var total_final = pad(hours)+":"+pad(minutes)+":"+pad(seconds);
        $('#total_break').val(total_final);
    }


    var getempingroup=function(){
                    dt_emp_ingroup=$('#tbl_group_emp').DataTable({
            "fnInitComplete": function (oSettings, json) {
                $.unblockUI();
                },
            "order": [[ 1, "asc" ]],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax": {
            "url": "SchedEmployee/transaction/listempgroup",
            "type": "POST",
            "bDestroy": true,
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "pay_period_id": $('#pay_period_id').val(),
                    "group_id": $('#group_id').val()
                    } );
                }
            },
            "columns": [
                { targets:[0],data: "full_name" },
                { targets:[1],data: "employee_id",
                    render: function (data, type, full, meta){
                            return "<center><input type='checkbox' id='employee_id' name='employee_id[]' value="+data+"></center>";
                    }
                },
            ],
            language: {
                         searchPlaceholder: "Search Employee"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(10).attr({
                    "align": "right"
                });
            }

        });

    }

    $('#tbl_scheduling').on('page', function () {
      alert();
    });

    $('#tbl_scheduling tbody').delegate('tr', 'click', function() {

        $('.odd').css('background-color','#eeeeee');
        $('.odd').css('color','#616161');
        $('.even').css('background-color','white');
        $('.even').css('color','#616161');

        $(this).closest("tr").css('background-color','#FFECB3');
        $(this).closest("tr").css('color','#616161');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.schedule_employee_id;
            _selectedDate = data.date;
            _selectedName = data.full_name;
            _selectedDayOff = data.is_day_off;
        changecolor();
    });


    $(document).keydown(function(event) {
        if( event.which == 113) {
          confirm_dayoff();
        }
    });

    var confirm_dayoff = function(){ 
        if (_selectedDate != 0){
            if (_selectedDayOff == 0){
                $('.datesched').text(_selectedDate);
                $('.empfullname').text(_selectedName);
                $('#modal_confirm_dayoff').modal('show');
            } 
            else{
                $('.datesched').text('('+_selectedDate+')');
                $('#modal_dayoff_on').modal('show'); 
            }
        }else{
            $('#modal_null_dayoff').modal('show'); 
        }
    }


    var changecolor=function(){
      $.each( $('#tbl_scheduling tbody tr .daytype'),function(){
          if($(this).attr('data-daytype')=="Regular Sunday"){
            $(this).closest('tbody tr').css({"background-color":"#fff176","color":"black"});
          }
          if($(this).attr('data-daytype')=="Regular Holiday"){
            $(this).closest('tbody tr').css({"background-color":"#81c784","color":"black"});
          }
          if($(this).attr('data-daytype')=="Special Holiday"){
            $(this).closest('tbody tr').css({"background-color":"#ff8a65","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Regular Holiday"){
            $(this).closest('tbody tr').css({"background-color":"#e57373","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Special Holiday"){
            $(this).closest('tbody tr').css({"background-color":"#f06292","color":"black"});
          }
          if($(this).attr('data-daytype')=="Regular O.T"){
            $(this).closest('tbody tr').css({"background-color":"#e1bee7","color":"black"});
          }
          if($(this).attr('data-daytype')=="Regular Holiday O.T"){
            $(this).closest('tbody tr').css({"background-color":"#c5cae9","color":"black"});
          }
          if($(this).attr('data-daytype')=="Special Holiday O.T"){
            $(this).closest('tbody tr').css({"background-color":"#90caf9","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Regular O.T"){
            $(this).closest('tbody tr').css({"background-color":"#03a9f4","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Regular Holiday O.T"){
            $(this).closest('tbody tr').css({"background-color":"#00bcd4","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Special Holiday O.T"){
            $(this).closest('tbody tr').css({"background-color":"#80cbc4","color":"black"});
          }
          if($(this).attr('data-daytype')=="Sunday Special Holiday O.T"){
            $(this).closest('tbody tr').css({"background-color":"#80cbc4","color":"black"});
          }
          if($(this).attr('data-dayoff')==1){
            $(this).closest('tbody tr').css({"background-color":"#b71c1c","color":"white"});
          }

      });
    };

    var getschedule=function(){
        $('#tbl_scheduling').dataTable().fnDestroy();
        _selectedIDdt = $('#employee_id_dt').val();
        _pay_period_id_dt = $('#pay_period_id_dt').val();
        $('#emp_dept').val($("#employee_id_dt").select2().find(":selected").attr('dept'));
        $('#emp_branch').val($("#employee_id_dt").select2().find(":selected").attr('branch'));
        $('#emp_ecode').val($("#employee_id_dt").select2().find(":selected").attr('ecode'));
        showSpinningProgressLoading();
        scheduling();
    };

    scheduling();


    var bindEventHandlers=(function(){
        var detailRows = [];

        $("#employee_id_dt").change(function() {
            getschedule();
        });

        $("#pay_period_id_dt").change(function() {
            getschedule();
        });

        _employeesdt=$("#employee_id_dt").select2({
            placeholder: "Select Employee",
            allowClear: false
        });

        _employeesdt.select2('val', null);


        _payperiodt=$("#pay_period_id_dt").select2({
            placeholder: "Select Pay Period",
            allowClear: false
        });

        _payperiodt.select2('val', null);

        _employees=$("#employee_id").select2({
            dropdownParent: $("#modal_create_schedule"),
            placeholder: "Select Employee",
            allowClear: false
        });

        _employees.select2('val', null);

        _payperiod=$("#pay_period_id").select2({
            dropdownParent: $("#modal_create_schedule"),
            placeholder: "Select Pay Period",
            allowClear: false
        });

        _payperiod.select2('val', null);    

        _payperiodup=$("#pay_period_id_up").select2({
            dropdownParent: $("#modal_schedbatch_update"),
            placeholder: "Select Pay Period",
            allowClear: false
        });

        _payperiodup.select2('val', null);    

        _group=$("#group_id").select2({
            dropdownParent: $("#modal_create_schedule"),
            placeholder: "Select Group",
            allowClear: false
        });

        _group.select2('val', null);        

        var _checktype=0;
        $('#select_all').click(function(){
            event.preventDefault();
            if(_checktype==0){
              $('#checktype').text('Uncheck All');
              _checktype=1;
              $('#tbl_group_emp tbody').find('input:checkbox').prop('checked', true);
            }
            else{
              $('#checktype').text('Check All');
              _checktype=0;
              $('#tbl_group_emp tbody').find('input:checkbox').prop('checked', false);
            }

        });

        $('#batch_update').click(function(){
            var pay_period_selected = $('#pay_period_id_dt').val();

            var chkAll = $('#tbl_scheduling tbody').find('input:checkbox');
            var checked = chkAll.filter(':checked').length;

            if (checked > 0){
                clearFields($('#frm_schedbatch_update'));
                $('#pay_period_id_up').val(pay_period_selected).trigger("change");
                $('#modal_schedbatch_update').modal('toggle');
            }else{
                showNotification({title:"Error!",stat:"error",msg:'Please select schedules you want to update.'});
            }

        });

        $('#btn_updatesched_batch').click(function(){
          if(validateRequiredFields($('#frm_schedbatch_update'))){
            batchupdateSchedule().done(function(response){
                showNotification(response);
                schedcheckstat=0;
                $('#tbl_scheduling tbody').find('input:checkbox').prop('checked', false);


                $('#checkall_sched').prop('checked', false);


                $('#tbl_scheduling').DataTable().ajax.reload();
            }).always(function(){
                $.unblockUI();
                $('#modal_schedbatch_update').modal('toggle');
                swal("Updated!", "Schedule(s) successfully Updated.", "success");
                changecolor();
            });
          }
        });


        $('#batch_delete').click(function(){
            var batch_ids = $('#tbl_scheduling').dataTable();
            var data = $('input', batch_ids.fnGetNodes()).serializeArray();
            if(data.length!=0){
              swal({
                  title: "Confirmation",
                  text: "Are you sure you want to delete these schedule(s)?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#2980b9",
                  confirmButtonText: "No",
                  cancelButtonText: "Yes",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
                function(isConfirm){
                  if (isConfirm) {
                    // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  } else {
                    batchremoveSchedule().done(function(response){
                        showNotification(response);
                        $('#tbl_scheduling').DataTable().ajax.reload();
                        $('#tbl_scheduling tbody').find('input:checkbox').prop('checked', false);
                        $('#checkall_sched').prop('checked', false);
                        schedcheckstat=0;
                    }).always(function(){
                        $.unblockUI();
                        swal("Deleted!", "Schedule(s) successfully Deleted.", "success");
                        changecolor();
                    });

                  }
                });

            }
            else{
              swal("Notice!", "Please select employee schedule", "warning")
            }


        });

        var schedcheckstat=0;
        $('#checkall_sched').click(function(){
          if(schedcheckstat==0){
            schedcheckstat=1;

            $.each( $('#tbl_scheduling tbody tr .isinclass'),function(){
                if($(this).attr('data-isin')!=1){
                  $(this).closest('tbody tr').find('.sched_checkbox').prop('checked', true);
                }
                
            });
          }
          else{
            schedcheckstat=0;
            $('#tbl_scheduling tbody').find('input:checkbox').prop('checked', false);
          }

        });

        $("#pay_period_id").change(function() {
            $("#group_id").attr('disabled',false);
        });

        $("#group_id").attr('disabled',true);

        $("#group_id").change(function() {
          if($('#pay_period_id').val()==0){
            return;
          }
          $('#tbl_group_emp').dataTable().fnDestroy();
          getempingroup();
          // $('#tbl_group_emp tbody').find('input:checkbox').prop('checked', true);
          $('#modal_show_emp_ingroup').modal('toggle');
        });

        $('#tbl_scheduling tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $(".eventrow").hide();
            $('.groupselect').hide(200);
            $('.employeesselect').show(200);
            $('#group_id').prop('required',false);
            $('#employee_id').prop('required',true);
            $('#employee_id').attr('disabled',false);
            $('.transaction_type').text('Edit');

            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();

            
            $('#employee_id').val(data.employee_id).trigger("change");
            $('#pay_period_id').val(data.pay_period_id).trigger("change");
            _selectedID=data.schedule_employee_id;
            _sched_refshift_id = data.sched_refshift_id;
            _date=data.date;
            //$('#emp_exemptpagibig').val(data.emp_exemptphilhealth);

           // alert($('input[name="tax_exempt"]').length);
            //$('input[name="tax_exempt"]').val(0);
            //$('input[name="inventory"]').val(data.is_inventory);

            $('input,textarea,select').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        if(_elem.attr('name')=="time_in" || _elem.attr('name')=="time_out"){
                          var dp = value;
                          dp = dp.split(' ')[1];
                          _elem.val(dp);
                        }
                        else{
                          _elem.val(value);
                        }

                    }
                });
            });

            $('#modal_create_schedule').modal('show');

        });

        $('#tbl_scheduling_break tbody').on('click','button[name="update_break"]',function(){
            _txnMode="edit";

            _selectRowObjBreak=$(this).closest('tr');
            var data=dt_scheduling_break.row(_selectRowObjBreak).data();


            _employee_break_id = data.employee_break_id;
            _break_time = data.break_time;
            _allowance = data.break_allowance;
            _sort_key = data.sort_key;

            $('input[name="emp_break_time"]').val(_break_time);
            $('input[name="emp_break_allowance"]').val(_allowance);
            $('input[name="emp_sort_key"]').val(_sort_key);

            $('#modal_emp_break').modal('show');

        });

        $('#btn_add_break').on('click', function(){ 
            _txnMode="create";
            clearFields($('#frm_employee_break'))
            reInitializeNumeric();
            $('.timepicker2').timepicker({
                minuteStep: 1,
                appendWidgetTo: 'body',
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });

            $('#modal_emp_break').modal('toggle');

        });

        $('#tbl_scheduling tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.schedule_employee_id;

            $('#modal_confirmation').modal('show');
        });


        $('#tbl_scheduling_break tbody').on('click','button[name="remove_break"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt_scheduling_break.row(_selectRowObj).data();

            _selectedID=data.employee_break_id;

            $('#modal_confirmation_break').modal('show');
        });


        $('#tbl_scheduling tbody').on('click','button[name="cancel_dayoff"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.schedule_employee_id;
            _selectedDate = data.date;
            _selectedName = data.full_name;

            $('.datesched').text(_selectedDate);
            $('.empfullname').text(_selectedName);
            $('#modal_cancel_dayoff').modal('show');
        });


        $('#tbl_scheduling tbody').on('click','button[name="allow_ot"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.schedule_employee_id;
            var typeot = (data.allow_ot==0) ? "Enable" : "Disable";
            var otstat = (data.allow_ot == 0) ? 1 : 0;
            empname=data.full_name;
            swal({
                title: "Notice!",
                text: typeot+" Overtime for "+empname+"?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#2980b9",
                confirmButtonText: "No",
                cancelButtonText: "Yes",
                closeOnConfirm: true,
                closeOnCancel: true
              },
              function(isConfirm){
                if (isConfirm) {

                } else {
                  allowOt(otstat).done(function(response){
                      showNotification(response);
                      $('#tbl_scheduling').DataTable().ajax.reload();
                      $.unblockUI();
                      changecolor();
                  });
                }
              });

        });

        // $('#save_ot').click(function(){
        //   if(validateRequiredFields($('#frm_ot'))){
        //     swal({
        //         title: "Notice!",
        //         text: "Allow Overtime for "+empname+"?",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#2980b9",
        //         confirmButtonText: "No",
        //         cancelButtonText: "Yes",
        //         closeOnConfirm: true,
        //         closeOnCancel: true
        //       },
        //       function(isConfirm){
        //         if (isConfirm) {
        //
        //         } else {
        //           allowOt().done(function(response){
        //               showNotification(response);
        //               $('#tbl_scheduling').DataTable().ajax.reload();
        //               $.unblockUI();
        //           });
        //         }
        //       });
        //     }
        // });


        $('#btn_yes').click(function(){
            removeSchedule().done(function(response){
                showNotification(response);
                if(response.false==0){
                }
                else{
                    dt.row(_selectRowObj).remove().draw();
                }
                $.unblockUI();
            });
        });


        $('#btn_yes_dayoff').click(function(){
            dayoffSchedule().done(function(response){
                showNotification(response);
                $('#tbl_scheduling').DataTable().ajax.reload();
                $.unblockUI();
                changecolor();
            });
        });

        $('#btn_yes_cancel_dayoff').click(function(){
            canceldayoffSchedule().done(function(response){
                showNotification(response);
                $('#tbl_scheduling').DataTable().ajax.reload();
                $.unblockUI();
                changecolor();
            });
        });

        $('#btn_yes_break').click(function(){
            removeScheduleBreak().done(function(response){
                showNotification(response);
                if(response.false==0){
                }
                else{
                    dt_scheduling_break.row(_selectRowObj).remove().draw();
                }
                $.unblockUI();
            });
        });

        $('#btn_new').click(function(){
            _txnMode="new";
            if(_typestate==1){
              $('.employeesselect').hide(200);
              $('#employee_id').attr('disabled',true);
              $('.groupselect').show(200);
              $('#employee_id').prop('required',false);
              $('#group_id').prop('required',true);
            }
            else{
              $('.groupselect').hide(200);
              $('.employeesselect').show(200);
              $('#employee_id').attr('disabled',false);
              $('#group_id').prop('required',false);
              $('#employee_id').prop('required',true);

            }
            // $('.groupselect').hide(500);
            // $('.employeesselect').show(500);
            // $('#employee_id').prop('required',true);
            $(".eventrow").show();
            $('.transaction_type').text('New');
            $('#modal_create_schedule').modal('show');
            clearFields($('#frm_schedule'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_schedule'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    createSchedule().done(function(response){
                        showNotification(response);
                        if(response.stat=="warningexist"){
                            $.unblockUI();
                            return;
                        }
                        if(response.stat=="warning"){
                          $('#modal_create_schedule').modal('toggle');
                          $('#tbl_scheduling').DataTable().ajax.reload();
                          // $('#modal_create_schedule').modal('toggle');
                          swal({
                              title: "Notice!",
                              text: "Some employees already have schedule for this shift and period",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#2980b9",
                              confirmButtonText: "Done",
                              cancelButtonText: "Show",
                              closeOnConfirm: true,
                              closeOnCancel: true
                            },
                            function(isConfirm){
                              if (isConfirm) {
                                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
                              } else {
                                showexcluded(response.excluded);
                              }
                            });
                          $.unblockUI();
                          changecolor();
                          return;
                        }
                        $('#tbl_scheduling').DataTable().ajax.reload();
                        clearFields($('#frm_schedule'))
                        $('#modal_create_schedule').modal('toggle');
                    }).always(function(){
                        $.unblockUI();
                        $('.datepicker').remove();
                        changecolor();
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    updateSchedule().done(function(response){
                        showNotification(response);
                        if(response.stat=="error" || response.stat=="warning"){
                            $.unblockUI();
                             }
                        /*dt.row(_selectRowObj).data(response.row_updated[0]).draw();*/
                        $('#tbl_scheduling').DataTable().ajax.reload();
                    }).always(function(){
                        $.unblockUI();
                        $('#modal_create_schedule').modal('toggle');
                        changecolor();
                    });
                    return;
                }
            }
            else{}
        });


        $('#btn_save_emp_break').click(function(){

            if (validateRequiredFields($('#frm_employee_break'))){
                if(_txnMode=="create"){
                     createNewBreak().done(function(response){
                        $.unblockUI();
                        if(response.stat=="error"){
                            $('#modal_emp_break').modal('show');
                            showNotification(response);
                        }
                        else {
                            dt_scheduling_break.row.add(response.row_added[0]).draw();
                            showNotification(response);
                            $('#modal_emp_break').modal('hide');
                        }
                    });
                }
                if(_txnMode=="edit"){
                     updateBreak().done(function(response){
                        $.unblockUI();
                        if(response.stat=="error"){
                            $('#modal_emp_break').modal('show');
                            showNotification(response);
                        }
                        else {
                        dt_scheduling_break.row(_selectRowObjBreak).data(response.row_updated[0]).draw();
                        showNotification(response);
                        $('#modal_emp_break').modal('hide');
                        }
                    });
                }
            }
        });

        $('#btn_show_template').click(function(){
            $('#tbl_schedule_template').dataTable().fnDestroy();
            scheduletemplate();
            $('#modal_show_template').modal('show');
        });

        $('.btn_show_template').click(function(){
            $('#tbl_schedule_template').dataTable().fnDestroy();
            scheduletemplate();
            $('#modal_show_template').modal('show');
        });

    })();


    var scheduletemplate=function(){
        dt_sched_template=$('#tbl_schedule_template').DataTable({
            "fnInitComplete": function (oSettings, json) {
                $.unblockUI();
            },
            "order": [[ 1, "desc" ]],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "ajax": {
            "url": "Sched_RefShift/transaction/list",
            "type": "POST",
            "bDestroy": true,
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "employee_id": _selectedIDdt, //id of the user
                    "pay_period_id": _pay_period_id_dt
                    } );
                }
            },
            "columns": [
                { targets:[0],data: "shift" },
                { targets:[1],data: "schedule_template_advance_in_out" },
                { targets:[2],data: "schedule_template_timein" },
                { targets:[3],data: "schedule_template_timeout" },
                { targets:[4],data: "schedule_template_break_time" },
                {
                    targets:[5],
                    render: function (data, type, full, meta){
                      var shedtemplate_apply='<button class="btn btn-default btn-sm btn-green" name="apply_schedtemplate"   data-toggle="tooltip" data-placement="top" title="Apply Schedule"><i class="fa fa-check"></i> </button>';
                      var shedtemplate_edit='<button class="btn btn-default btn-sm btnedit" name="edit_schedtemplate"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> </button>';
                      var shedtemplate_delete='<button class="btn btn-default btn-sm btndelete" name="delete_schedtemplate"  data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>';

                        return '<center>'+shedtemplate_apply+shedtemplate_edit+shedtemplate_delete+'</center>';
                    }
                }

            ],
            language: {
                         searchPlaceholder: "Search Schedule Template"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(11).attr({
                    "align": "right"
                });
            }
        });






        $('.numeric').autoNumeric('init');


    };

    $('#btn_create_schedtemplate').click(function(){
        _txnModetemplate="new";
        $('#schedtransac').text('New');
        $('#modal_create_schedtemplate').modal('show');
    });

    $('#tbl_schedule_template tbody').on('click','button[name="edit_schedtemplate"]',function(){
        _txnModetemplate="edit";
        $('#schedtransac').text('Edit');
        _selectRowObjtemplate=$(this).closest('tr');

        var datatemplate=dt_sched_template.row(_selectRowObjtemplate).data();
        _selectedIDschedtemplate=datatemplate.sched_refshift_id;
        _sched_refshift_id = datatemplate.sched_refshift_id;

        $('input,textarea,select').each(function(){
            var _elem=$(this);
            $.each(datatemplate,function(name,value){
                if(_elem.attr('name')==name){
                    _elem.val(value);
                }
            });
        });



        $.ajax({
            "dataType":"json",
            "type":"GET",
            "url":"Sched_RefShift/transaction/getbreaklist/"+_sched_refshift_id,
            cache : false,
            processData : false,
            contentType : false,
            success : function(response){
                    var rows=response.data;

                    if (rows.length > 0){
                        $(".tbl_break > tbody").html("");
                        $.each(rows,function(i,value){

                            $('.tbl_break > tbody').append(newRowItemforupdate({
                                sched_shift_break_id : value.sched_shift_break_id,
                                break_time : value.break_time,
                                break_allowance : value.break_allowance,
                                sort_key: value.sort_key
                            }));
                            
                        });
                    }else{
                        $(".tbl_break > tbody").html("");
                         $('.tbl_break > tbody').append(newRowItem());
                    }

                    reInitializeNumeric();
                    $('.timepicker2').timepicker({
                        minuteStep: 1,
                        appendWidgetTo: 'body',
                        showSeconds: true,
                        showMeridian: false,
                        defaultTime: false
                    });

                }
        });


        $('#modal_create_schedtemplate').modal('show');

    });

    $('#tbl_schedule_template tbody').on('click','button[name="delete_schedtemplate"]',function(){
        _selectRowObjtemplate=$(this).closest('tr');
        var datatemplate=dt_sched_template.row(_selectRowObjtemplate).data();
        _selectedIDschedtemplate=datatemplate.sched_refshift_id;

        $('#modal_confirmation_schedtemplate').modal('show');
    });

    $('#tbl_schedule_template tbody').on('click','button[name="apply_schedtemplate"]',function(){
        var templatenotify = {title:"Success", msg:"Schedule Template Applied.", stat:"success", eyeColor:"blue"};
        _selectRowObjtemplate=$(this).closest('tr');
        var datatemplate=dt_sched_template.row(_selectRowObjtemplate).data();
        _selectedIDschedtemplate=datatemplate.sched_refshift_id;
        $('.schedule_template_advance_in_out').val(datatemplate.schedule_template_advance_in_out).css({'color':'#27ae60','font-weight':'bold'});
        $('.schedule_template_grace_period').val(datatemplate.grace_period).css({'color':'#27ae60','font-weight':'bold'});
        $('.schedule_template_timein').val(datatemplate.schedule_template_timein).css({'color':'#27ae60','font-weight':'bold'});
        $('.schedule_template_timeout').val(datatemplate.schedule_template_timeout).css({'color':'#27ae60','font-weight':'bold'});
        $('.schedule_template_break_time').val(datatemplate.schedule_template_break_time).css({'color':'#27ae60','font-weight':'bold'});
        _sched_refshift_id = datatemplate.sched_refshift_id;
        showNotification(templatenotify);
        $('#modal_show_template').modal('toggle');
    });

    $('#btn_save_schedtemplate').click(function(){
        if(validateRequiredFields($('#frm_schedule_template'))){
            if(_txnModetemplate==="new"){
                //alert("aw");
                createScheduleTemplate().done(function(response){
                    showNotification(response);
                    if(response.stat=="error" || response.stat=="warning"){
                        $.unblockUI();
                        return;
                         }
                    dt_sched_template.row.add(response.row_added[0]).draw();
                    clearFields($('#frm_schedule_template'))
                    $('#modal_create_schedtemplate').modal('toggle');
                }).always(function(){
                    $.unblockUI();
                    $('.datepicker').remove();
                });
                return;
            }
            if(_txnModetemplate==="edit"){
                //alert("update");
                updateScheduleTemplate().done(function(response){
                    showNotification(response);
                    if(response.stat=="error" || response.stat=="warning"){
                        $.unblockUI();
                         }
                    dt_sched_template.row(_selectRowObjtemplate).data(response.row_updated[0]).draw();
                }).always(function(){
                    $.unblockUI();
                    $('#modal_create_schedtemplate').modal('toggle');
                });
                return;
            }
        }
        else{}
    });

    $('#btn_yes_sched').click(function(){
        removeScheduleTemplate().done(function(response){
            showNotification(response);
            if(response.false==0){
            }
            else{
                dt_sched_template.row(_selectRowObjtemplate).remove().draw();
            }
            $.unblockUI();
        });
    });

    var _d_refshift_id;

    $('#tbl_scheduling tbody').on( 'click', 'tr td.schedsetting', function () {
      _selectRowObj=$(this).closest('tr');
      var data=dt.row(_selectRowObj).data();
      $('#employee_id').val(data.employee_id).trigger("change");
      $('#pay_period_id').val(data.pay_period_id).trigger("change");
      _selectedID=data.schedule_employee_id;
      $('#full_name').text(data.full_name);
      $('#d_date').text(data.date);
      $('#d_day').text(data.day);
      var _d_timein = data.time_in;
      var d_timein = _d_timein.split(' ')[1];
      var _d_timeout = data.time_out;
      var _d_timeout = _d_timeout.split(' ')[1];
      $('#d_schedinout').text(d_timein+' - '+_d_timeout);
      _d_refshift_id = data.sched_refshift_id;
      $('#modal_manual_inout').modal('toggle');
    });


    $('#tbl_scheduling tbody').on( 'click', 'tr td.breaksetting', function () {

      _selectRowObj=$(this).closest('tr');
      var data=dt.row(_selectRowObj).data();
      $('#employee_id').val(data.employee_id).trigger("change");
      $('#pay_period_id').val(data.pay_period_id).trigger("change");
      _selectedID=data.schedule_employee_id;

      $('#emp_fullname').text(data.full_name);
      $('#break_date').text(data.date);
      $('#break_shift').text(data.shift);

      $('#tbl_scheduling_break').dataTable().fnDestroy();
      getbreaks(_selectedID);
      $('#modal_employee_break').modal('toggle');

    });



    $('#btn_manual_inout').click(function(){
      updateInOut().done(function(response){
          showNotification(response);
          if(response.stat=="error" || response.stat=="warning"){
              $.unblockUI();
               }
          $('#tbl_scheduling').DataTable().ajax.reload();
      }).always(function(){
          $.unblockUI();
          clearFields($('#frm_manual_inout'));
          $('#modal_manual_inout').modal('toggle');
          changecolor();
      });
    });


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

    var createSchedule=function(){
        // var _data1=$('#frm_schedule').serialize();
        var oTable = $('#tbl_group_emp').dataTable();
         var _data2 = $('input', oTable.fnGetNodes()).serialize();
        // _data.push({name : "sched_refshift_id" ,value : _sched_refshift_id});
        // _data.push({name : "typestate" ,value :$('.tevent').is(':checked') ? 1 : 0});
        var _data=$('#frm_schedule').serialize()+'&'+$.param({'sched_refshift_id':_sched_refshift_id,'typestate':$('.tevent').is(':checked') ? 1 : 0}); //trick to merge 2 serialize and add additional data
       //var aww={name : "pay_period_id" ,value : _selectedYear};
        //_pusheddata.push({name : "employee_id" ,value : _selectedID  });

        var newdata = _data2 + '&' + _data;

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/create",
            "data":newdata,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var createNewBreak=function(){
        var _data=$('#frm_employee_break').serializeArray();
        _data.push({name : "schedule_employee_id" ,value : _selectedID});
         return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/create_break",
            "data":_data
        });
    };

    var updateBreak=function(){
        var _data=$('#frm_employee_break').serializeArray();
        _data.push({name : "employee_break_id" ,value : _employee_break_id});
        _data.push({name : "schedule_employee_id" ,value : _selectedID});
         return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/update_break",
            "data":_data
        });
    };

    var updateSchedule=function(){
        var _data=$('#frm_schedule').serializeArray();
        _data.push({name : "sched_refshift_id" ,value : _sched_refshift_id});
        _data.push({name : "schedule_employee_id" ,value : _selectedID});
        _data.push({name : "typestate" ,value : $('.tevent').is(':checked') ? 1 : 0});
        _data.push({name : "date" ,value : _date});
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var getbreaklist=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "sched_refshift_id" ,value : _sched_refshift_id});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/getbreaklist",
            "data":_data
        });
    }

    var removeSchedule=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/delete",
            "data":{schedule_employee_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var removeScheduleBreak=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/delete_break",
            "data":{employee_break_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var dayoffSchedule=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/dayoff",
            "data":{schedule_employee_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var canceldayoffSchedule=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/canceldayoff",
            "data":{schedule_employee_id : _selectedID},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var batchupdateSchedule=function(){
      var batch_ids = $('#tbl_scheduling').dataTable();
      var _data = $('input', batch_ids.fnGetNodes()).serialize();
      var _data2=$('#frm_schedbatch_update').serialize()+'&'+$.param({'sched_refshift_id':_sched_refshift_id}); //trick to merge 2 serialize and add additional data

      $.each( $('#tbl_scheduling tbody tr .dataday'),function(){
          // if($(this).is(':checked'))
          if($(this).closest('tbody tr').find('.sched_checkbox').is(':checked')){
            _data2+='&'+$.param({'date[]':$(this).text()});
          }

      });
      var newdata = _data2 + '&' + _data;
      
      return $.ajax({
          "dataType":"json",
          "type":"POST",
          "url":"SchedEmployee/transaction/batchupdate",
          "data":newdata,
          "beforeSend": showSpinningProgressLoading()
      })
    };

    var batchremoveSchedule=function(){
      var batch_ids = $('#tbl_scheduling').dataTable();
      var data = $('input', batch_ids.fnGetNodes()).serializeArray();
      return $.ajax({
          "dataType":"json",
          "type":"POST",
          "url":"SchedEmployee/transaction/batchdelete",
          "data":data,
          "beforeSend": showSpinningProgressLoading()
      })
    };

    var allowOt=function(otstat){
      var _data=$('#').serializeArray();
      _data.push({name : "allow_ot" ,value : otstat});
      _data.push({name : "schedule_employee_id" ,value : _selectedID});
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/allowot",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var updateInOut=function(){
        var _data=$('#frm_manual_inout').serializeArray();

        /*console.log(_data);*/
        _data.push({name : "schedule_employee_id" ,value : _selectedID});
        _data.push({name : "date" ,value : $('#d_date').text()});
        _data.push({name : "sched_refshift_id" ,value : _d_refshift_id});

        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"SchedEmployee/transaction/manualinout",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var createScheduleTemplate=function(){
        var _data=$('#frm_schedule_template').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };


    var updateScheduleTemplate=function(){
        var _data=$('#frm_schedule_template').serializeArray();

        /*console.log(_data);*/
        _data.push({name : "sched_refshift_id" ,value : _selectedIDschedtemplate});
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var removeScheduleTemplate=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/delete",
            "data":{sched_refshift_id : _selectedIDschedtemplate},
            "beforeSend": showSpinningProgress($('#'))
        });
    };

    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };

        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

    var showSpinningProgress=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Saving Changes</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var showSpinningProgressLoading=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Loading Data</h4>',
            css: {
            border: 'none',
            padding: '15px',
            backgroundColor: 'none',
            opacity: 1,
            zIndex: 20000,
        } });
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI);
    };

    var clearFields=function(f){
        $('input,textarea,select',f).val('');
        $(f).find('input:first').focus();
        $('#employee_id').val('').trigger("change");
    };

    $('.timepicker2').timepicker({
        minuteStep: 1,
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });

    $('.tevent').change(function() {
      _typestate = $(this).is(':checked') ? 1 : 0;
      if(_typestate==1){
        $('.employeesselect').hide(200);
        $('.groupselect').show(200);
        $('#employee_id').prop('required',false);
        $('#employee_id').attr('disabled',true);
        $('#group_id').prop('required',true);
      }
      else{
        $('.groupselect').hide(200);
        $('.employeesselect').show(200);
        $('#group_id').prop('required',false);
        $('#employee_id').prop('required',true);
        $('#employee_id').attr('disabled',false);

      }
    });

    var showexcluded=function(excluded){
      var show2preview="";
      if(excluded.length==0){
          $('.excluded_preview').html("No Result");
          return;
      }
      var countex=excluded.length-1;
      var numbering=1;
       for(var i=0;parseInt(countex)>=i;i++){
          //alert(response.available_leave[i].leave_type);
          show2preview+='<tr><td>'+numbering+'</td><td>'+excluded[i]+'</td></tr>';
          numbering++;
       }
       $('.excluded_preview').html(show2preview);
        $('#modal_show_excluded').modal('toggle');
    };

   /* $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });*/


    // apply input changes, which were done outside the plugin
    //$('input:radio').iCheck('update');

    var reInitializeNumeric=function(){
        $('.numeric').autoNumeric('init');
    };


    $('.tbl_break tbody').on('click','.add_break',function(){
        $('.tbl_break > tbody').append(newRowItem());
        reInitializeNumeric();
        $('.timepicker2').timepicker({
            minuteStep: 1,
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
        compute_breaks();
    });

    $('.tbl_break tbody').on('keypress','.sort_key',function(e){
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $('.sort_key').on('keypress',function(e){
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $('.tbl_break tbody').on('change','input',function(){
        compute_breaks();
    });

          $('.tbl_break tbody').on('keyup','#sort_key',function(){

              var sort_key = $(this).closest('tr').find('input.sort_key').val();
              var row = $(this).closest('tr');
              var row_count = 0;
              var array = [];

              $('.tbl_break tbody').each(function(){

                  var sort_key1 = sort_key;

                  var values = [];
                  $(this).find("input.sort_key").each(function(){

                      values.push($(this).val());
                  });

                  array.push(values);

                  var found = array.find(function(element){
                      return element = sort_key;
                  });

                  var counts = {};
                  jQuery.each(found, function(key,value) {
                    if (!counts.hasOwnProperty(value)) {
                      counts[value] = 1;
                    } else {
                      counts[value]++;
                    }

                    row_count = counts[value];
                  });

              });

              if (row_count >= 2){
                showNotification({"title":"Warning!","stat":"error","msg":"Sorry, you cannot have duplicate sort key."});
                row.find('input.sort_key').val("");
              }

          });

    $('.tbl_break tbody').on('click','.remove_break',function(){
        
        var oRow=$('.tbl_break > tbody tr');

        if (oRow.length>1){
            $(this).closest('tr').remove();  
        }else{
            showNotification({"title":"Warning!","stat":"error","msg":"Sorry, you cannot remove all rows."});
        }
        reInitializeNumeric();
        $('.timepicker2').timepicker({
            minuteStep: 1,
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });

        compute_breaks();
    });

    var newRowItem=function(d){
    return '<tr>'+
        '<td><input type="text" name="break_time[]" class="form-control timepicker2 break_time" data-error-msg="Break time is Required!" required></td>'+
        '<td><input type="text" name="break_allowance[]" class="form-control numeric"></td>'+
        '<td width="15%"><input type="text" name="sort_key[]" id="sort_key" class="form-control sort_key" data-error-msg="Sort Key is Required!" required></td>'+
        '<td width="15%"><span class="fa fa-plus add_break"></span><span class="fa fa-times remove_break"></span></td>'+
        '</tr>';
    };

    var newRowItemforupdate=function(d){
    return '<tr>'+
        '<td><input type="hidden" name="sched_shift_break_id" value="'+d.sched_shift_break_id+'"><input type="text" name="break_time[]" class="form-control timepicker2 break_time" data-error-msg="Break time is Required!" required value="'+d.break_time+'"></td>'+
        '<td><input type="text" name="break_allowance[]" class="form-control numeric" value="'+d.break_allowance+'"></td>'+
        '<td width="15%"><input type="text" name="sort_key[]" id="sort_key" class="form-control sort_key" data-error-msg="Sort Key is Required!" required value="'+d.sort_key+'"></td>'+
        '<td width="15%"><span class="fa fa-plus add_break"></span><span class="fa fa-times remove_break"></span></td>'+
        '</tr>';
    };

});

</script>
</body>

</html>
