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
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet"><!-- iCheck -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/_all.css" rel="stylesheet"><!-- Custom Checkboxes / iCheck -->
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
    <style>
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
        .bootstrap-timepicker-widget.dropdown-menu {
            z-index: 1400!important;
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
                        <li><a href="Sched_RefShift">Shift</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div id="div_product_list">
                            <div class="panel panel-default">
                                        <button class="btn right_schedule_shifting_view"  id="btn_new" style="width:185px;background-color:#2ecc71;color:white;" title="Create New Schedule Shift" >
                                        <i class="fa fa-file"></i> New Shift</button>
                                        <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                             <center><h2 style="color:white;font-weight:300;">Shift List</h2></center>
                                        </div>
                                    <div class="panel-body table-responsive" style="padding-top:8px;">
                                        <table id="tbl_shift" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                              <tr>
                                                  <th>Template Name</th>
                                                  <th>Time Allowance</th>
                                                  <th>Time In</th>
                                                  <th>Time Out</th>
                                                  <th>Break Time</th>
                                                  <th><center>Action</center></th>
                                               </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                <div class="panel-footer"></div>
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
            <div id="modal_create_shift" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#2ecc71;">
                            <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                            <h4 class="modal-title" style="color:#ecf0f1;"><span id="modal_mode"> </span>Shift : <transaction class="transaction_type"></transaction></h4>
                        </div>

                        <div class="modal-body">
                            <form id="frm_shift">
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
                                      <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Time In Grace Period (Minutes):</label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control " name="grace_period" placeholder="Grace Period">
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
                              <!-- <div class="row">
                                  <div class="form-group">
                                      <label class="col-sm-4 inlinecustomlabel-sm" for="inputEmail1">Break Time :</label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control timepicker2 " name="schedule_template_break_time" placeholder="Break Time" data-error-msg="Break Time is Required!" required>
                                      </div>
                                  </div>
                              </div> -->
                              <div class="row break_row">
                              <br>
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
                                          <td><input type="text" name="break_time[]" class="form-control timepicker2 break_time" data-error-msg="Break time is Required!"></td>
                                          <td><input type="text" name="break_allowance[]" class="form-control numeric"></td>
                                          <td width="15%"><input type="text" name="sort_key[]" id="sort_key" class="form-control sort_key" data-error-msg="Sort Key is Required!"></td>
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
                            <button id="btn_create" type="button" class="btn" style="background-color:#2ecc71;color:white;">Save</button>
                            <button id="btn_cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!---content---->
                </div>
            </div><!---modal-->
<script type="text/javascript" src="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj;

    var initializeControls=function(){
        dt=$('#tbl_shift').DataTable({
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "orderFixed": [ 6, 'desc' ],
            "ajax" : "Sched_RefShift/transaction/list",
            "columns": [
              { targets:[0],data: "shift" },
              { targets:[1],data: "schedule_template_advance_in_out" },
              { targets:[2],data: "schedule_template_timein" },
              { targets:[3],data: "schedule_template_timeout" },
              { targets:[4],data: "schedule_template_break_time" },
              {
                  targets:[5],
                  render: function (data, type, full, meta){

                      return '<center>'+right_schedule_shifting_edit+right_schedule_shifting_delete+'</center>';
                  }
              },
              { visible:false, targets:[6],data: "sched_refshift_id" }

            ],
            language: {
                         searchPlaceholder: "Search Shift Type"
                     },
            "rowCallback":function( row, data, index ){

                $(row).find('td').eq(5).attr({
                    "align": "right"
                });
            }
        });






        $('.numeric').autoNumeric('init');


    }();


    var bindEventHandlers=(function(){
        var detailRows = [];

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

        $('#tbl_shift tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );

            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();

                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );

                row.child( format( row.data() ) ).show();

                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        });

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



        $('#tbl_shift tbody').on('click','button[name="edit_info"]',function(){
            _txnMode="edit";
            $('.transaction_type').text('Edit');
            $('#modal_create_shift').modal('show');
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.sched_refshift_id;

            //$('#emp_exemptpagibig').val(data.emp_exemptphilhealth);

           // alert($('input[name="tax_exempt"]').length);
            //$('input[name="tax_exempt"]').val(0);
            //$('input[name="inventory"]').val(data.is_inventory);

            $('input,textarea').each(function(){
                var _elem=$(this);
                $.each(data,function(name,value){
                    if(_elem.attr('name')==name){
                        _elem.val(value);
                    }
                });
            });

            $.ajax({
                "dataType":"json",
                "type":"GET",
                "url":"Sched_RefShift/transaction/getbreaklist/"+_selectedID,
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

            hideRatesduties();
            hideemployeeList();
            showemployeeFields();

        });

        $('#tbl_shift tbody').on('click','button[name="remove_info"]',function(){
            _selectRowObj=$(this).closest('tr');
            var data=dt.row(_selectRowObj).data();
            _selectedID=data.sched_refshift_id;

            $('#modal_confirmation').modal('show');
        });

        $('#btn_yes').click(function(){
            removeShift().done(function(response){
                showNotification(response);
                if(response.false==0){
                }
                else{
                    dt.row(_selectRowObj).remove().draw();
                }
                $.unblockUI();
            });
        });


        $('#btn_new').click(function(){
            _txnMode="new";
            $('.transaction_type').text('New');
            $('#modal_create_shift').modal('show');
            clearFields($('#frm_shift'));
        });

        $('#btn_create').click(function(){
            if(validateRequiredFields($('#frm_shift'))){
                if(_txnMode==="new"){
                    //alert("aw");
                    createShift().done(function(response){
                        showNotification(response);
                        if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row.add(response.row_added[0]).draw();
                        clearFields($('#frm_shift'))
                    }).always(function(){
                        $.unblockUI();
                        $('#modal_create_shift').modal('toggle');
                    });
                    return;
                }
                if(_txnMode==="edit"){
                    //alert("update");
                    updateShift().done(function(response){
                        showNotification(response);
                        if(response.stat=="error"){
                            $.unblockUI();
                             }
                        dt.row(_selectRowObj).data(response.row_updated[0]).draw();
                    }).always(function(){
                        $.unblockUI();
                        $('#modal_create_shift').modal('toggle');
                    });
                    return;
                }
            }
            else{}
        });

    })();


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

    var createShift=function(){
        var _data=$('#frm_shift').serializeArray();

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };


    var updateShift=function(){
        var _data=$('#frm_shift').serializeArray();

        console.log(_data);
        _data.push({name : "sched_refshift_id" ,value : _selectedID});
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});

        //alert($('input[name="is_inventory"]').val());
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/update",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    var removeShift=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"Sched_RefShift/transaction/delete",
            "data":{sched_refshift_id : _selectedID},
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

    var clearFields=function(f){
        $('input,textarea',f).val('');
        $(f).find('input:first').focus();
    };

    $('.timepicker2').timepicker({
        minuteStep: 1,
        appendWidgetTo: 'body',
        showSeconds: true,
        showMeridian: false,
        defaultTime: false
    });


    function format ( d ) {
        return '<div class="container-fluid">'+
        '<div class="col-md-12">'+
        '<center><h4 class="boldlabel">Nothing Follows</h4></center>'+
        '</div>'+ //First Row//
        '</div>';
    };



   /* $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });*/


    // apply input changes, which were done outside the plugin
    //$('input:radio').iCheck('update');

});

</script>
</body>

</html>
