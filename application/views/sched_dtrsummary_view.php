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
            width: 100%;
        }
        .bootstrap-timepicker-widget.dropdown-menu {
            z-index: 1400!important;
        }
        .checks{
            height:20px !important;
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
                        <li><a href="SchedEmployee">Branch</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_product_list">
                            <div class="panel panel-default">
                                        <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                             <center><h2 style="color:white;font-weight:300;">DTR Schedule Summary</h2></center>
                                        </div>
                                    <div class="panel-body table-responsive" style="padding-top:8px;">
                                        <div class="row" style="margin:10px;">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 inlinecustomlabel-sm" for="inputEmail1">Period :</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="pay_period_id" id="pay_period_id" data-error-msg="Please Select Pay Period" required>
                                                                <option value="">[ Select Pay Period ]</option>
                                                                <?php foreach($pay_period as $row) {
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
                                                        <label class="col-sm-4 inlinecustomlabel-sm"  for="inputEmail1">Option :</label>
                                                        <div class="col-sm-8">
                                                            <button id="printscheddtrsummary" style="width:100%;" style="margin-bottom:3px;" class="btn btn-green">PRINT</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="form-group">
                                                            <button id="transfertodtr" style="width:100%;background-color:#2980b9;color:white;" class="btn">Transfer to DTR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="scheddtrsummary_preview" style="height:800px;margin-left:20px;margin-right:20px;overflow:auto;">
                                        </div>
                                    </div>

                            </div> <!--panel default -->

                        </div> <!--rates and duties list -->
                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->

<div id="modal_transfer_confirmation" class="modal fade" tabindex="-1" role="dialog"><!--modal-->
    <div class="modal-dialog modal-md" style="top: 25%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"   data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title"><span id="modal_mode"> </span>Confirm Transfer to DTR?</h4>
            </div>

            <div class="modal-body">

                <img src="assets/img/question_mark.png" style="width: 50px; position: absolute;margin-left: 30px;margin-top: 20px;"> 
                <p id="modal-body-message" style="font-size: 12pt;width: 80%;font-weight: normal!important;margin-left: 100px; font-weight: 400;margin-top: 10px;">
                    <b>WARNING:</b> <br> <b style="color: red;font-size: 10pt;">This transfer summary will create DTR or update the existing DTR.</b> <br> Are you sure you want to transfer?</p>
            </div>

            <div class="modal-footer">
                <button id="btn_yes_transfer" type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var dt; var _txnMode; var _selectedID; var _selectRowObj; var _period_id; var _selectedIDschedtemplate; var _pay_period_id=0; var _employee_id=0;

    _period_id=$("#pay_period_id").select2({
        placeholder: "Select Pay Period",
        allowClear: false
    });
    
    _period_id.select2('val', null);

/*    $('#employee_id').change(function(){
      _pay_period_id = $('#pay_period_id').val();
      _employee_id = $('#employee_id').val();
      $('#emp_ecode').val($('option:selected', this).attr('ecode'));
      $('#emp_branch').val($('option:selected', this).attr('branch'));
      $('#emp_dept').val($('option:selected', this).attr('dept'));
      listschedDtrSummary().done(function(response){
        $('.scheddtrsummary_preview').html(response);
      }).always(function(){
          $.unblockUI();
      });
    });*/

    $('#pay_period_id').change(function(){
      _pay_period_id = $('#pay_period_id').val();
      // _employee_id = $('#employee_id').val();
      listschedDtrSummary().done(function(response){
        $('.scheddtrsummary_preview').html(response);
      }).always(function(){
          $.unblockUI();
      });
    });

    $('#printscheddtrsummary').click(function(event){
        if ($('#pay_period_id').val() == ""){
            showNotification({title:"Warning!",stat:"error",msg:"Please fill the pay period."});
            $('#pay_period_id').focus();
        }else{
            /*printing_notif();*/
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $(".scheddtrsummary_preview").printThis({
                debug: false,
                importCSS: true,
                importStyle: false,
                printContainer: false,
                loadCSS: output,
                formValues:true
            });
        }
    });

    var listschedDtrSummary=function(){
        var _data=$('#').serializeArray();
        // _data.push({name : "employee_id" ,value : _employee_id });
        _data.push({name : "pay_period_id" ,value : _pay_period_id });
        return $.ajax({
            "dataType":"html",
            "type":"POST",
            "url":"SchedDTRSummary/transaction/sched-dtr-summary",
            "data":_data,
            "beforeSend": showSpinningProgress($('#btn_save'))
        });
    };

    $('#transfertodtr').click(function(){
        if ($('#pay_period_id').val() == ""){
            showNotification({title:"Warning!",stat:"error",msg:"Please fill the pay period."});
            $('#pay_period_id').focus();
        }else{
            $('#modal_transfer_confirmation').modal('show');
        }
    });

    $('#btn_yes_transfer').click(function(){
        createorupdateDTR().done(function(response){
            swal("Success!", "Schedule Summary transferred to DTR.", "success");
        }).always(function(){
            $.unblockUI();
        });
    });

    var createorupdateDTR=function(){
        var _data=$('.summary_transfer').serializeArray();
        return $.ajax({
            "dataType":"html",
            "type":"POST",
            "url":"DailyTimeRecord/transaction/transfertodtr",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
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

        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true

        });

    var showSpinningProgress=function(e){
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

    var showSpinningProgressLoading=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Transferring Data</h4>',
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
