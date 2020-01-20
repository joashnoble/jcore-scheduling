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
                        <li><a href="EmployeeScheduleReport">Employee Schedule Report</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:300;">Employee Schedule Report</h2></center>
                                </div>
                                <div class="panel-body table-responsive" style="padding-top:8px;padding: 20px;">
                                   <div class="row" style="padding: 10px;">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="inlinecustomlabel-sm">Employee :</label>
                                                    <select class="form-control" name="employee_filter" id="employee_filter" data-error-msg="Pay Period Filter is required" required>
                                                        <?php foreach($employee as $employees){?>
                                                          <option value="<?php echo $employees->employee_id; ?>">
                                                            <?php echo $employees->ecode.' '.$employees->full_name; ?>
                                                          </option>
                                                        <?php } ?>
                                                    </select> <br/>
                                                    <button type="button" class="btn col-sm-12 form-control" id="print_emp_sched_report" style="background-color:#27ae60;color:white;margin-top: 10px;">
                                                        <i class="fa fa-print"></i> PRINT
                                                    </button>
                                                </div>                                        
                                            </div>
                                            <div class="col-md-3">
                                                <label class="inlinecustomlabel-sm">Pay Period : </label>
                                                <select class="form-control" name="pay_period_filter" id="pay_period_filter" data-error-msg="Pay Period Filter is required" required>
                                                    <option value="">[Select Pay Period]</option>
                                                    <?php foreach($payperiods as $payperiod){?>
                                                      <option value="<?php echo $payperiod->pay_period_id; ?>">
                                                        <?php echo $payperiod->period; ?>
                                                      </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="inlinecustomlabel-sm">Start Date :</label>
                                                    <input type="text" class="form-control date-picker" name="start_date" id="start_date" value="<?php echo date("m/01/Y")?>">
                                                </div>                                        
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="inlinecustomlabel-sm">End Date :</label>
                                                    <input type="text" class="form-control date-picker" name="end_date" id="end_date" value="<?php echo date("m/t/Y")?>">
                                                </div>  
                                            </div>
                                            <div class="col-md-2" style="padding-top: 20px;">
                                                <input type="radio" name="period" id="pay_period" value="1"> 
                                                    <label for="pay_period" style="cursor: pointer;"><b>Use Pay Period</b></label><br>
                                                <input type="radio" name="period" id="date_filter" value="2"> 
                                                    <label for="date_filter" style="cursor: pointer;"><b>Use Date Filter</b></label><br>
                                            </div>
                                        </div>  
                                </div>
                                <hr>
                                <div id="emp_sched_preview" style="overflow: scroll;"></div>
                                <div class="panel-footer"></div>
                            </div> <!--panel default -->
                        </div>

                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->


<?php echo $_rights; ?>
<script>

$(document).ready(function(){

    var employee_filter;
    var pay_period_filter;
    var _datefilter;
    var filter_employee;
    var filter_start;
    var filter_end;
    var stat;

    employee_filter=$("#employee_filter").select2({
        placeholder: "Select Employee",
        allowClear: false
    });
    employee_filter.select2('val', null);

    pay_period_filter=$("#pay_period_filter").select2({
        placeholder: "Select Pay Period",
        allowClear: false
    });
    pay_period_filter.select2('val', null);

    var d = new Date();

    var getScheduleReport=function(){
        var _data=$('#').serializeArray();
        _data.push({name : "employee_id" ,value : $('#employee_filter').val()});
        _data.push({name : "pay_period_id" ,value : $('#pay_period_filter').val()});
        _data.push({name : "start_date" ,value : $('#start_date').val()});
        _data.push({name : "end_date" ,value : $('#end_date').val()});
        _data.push({name : "stat" ,value : stat});

        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"PayrollReports/payrollreports/emp_sched_report",
            "data":_data,
            "beforeSend" : function(){
                        $('#emp_sched_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                    }
        });
    };

    $('input[type=radio][name=period]').on("change",function(){
        stat = this.value;

        if (stat == 1){
            pay_period_filter.select2("val",null);
            $('#pay_period_filter').prop("disabled",false);
            $('.date-picker').prop("disabled",true);
        }else{
            $('#pay_period_filter').prop("disabled",true);
            $('.date-picker').prop("disabled",false);
        }

        getScheduleReport().done(function(response){
            $('#emp_sched_preview').html(response);
        });

    });

    $('#pay_period').trigger('click');

    getScheduleReport().done(function(response){
        $('#emp_sched_preview').html(response);
    });      

    $("#start_date").change(function(){
        getScheduleReport().done(function(response){
            $('#emp_sched_preview').html(response);
        });    
    });

    $("#end_date").change(function(){
        getScheduleReport().done(function(response){
            $('#emp_sched_preview').html(response);
        });    
    });    

    $("#employee_filter").change(function(){
        getScheduleReport().done(function(response){
            $('#emp_sched_preview').html(response);
        });    
    });

    $("#pay_period_filter").change(function(){
        getScheduleReport().done(function(response){
            $('#emp_sched_preview').html(response);
        });    
    });

    $('#print_emp_sched_report').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $("#emp_sched_preview").printThis({
                debug: false,
                importCSS: true,
                importStyle: false,
                printContainer: false,
                printDelay: 1000,
                loadCSS: output,
                formValues:true
            });
            setTimeout(function() {
                 $.unblockUI();
            }, 1000);
    });


    var showNotification=function(obj){
        PNotify.removeAll();
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };
    
    var showSpinningProgressLoading=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Loading Data...</h4>',
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
        $("input:checkbox").prop('checked',false);
    };

    $('.date-picker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

});

</script>
</body>

</html>
