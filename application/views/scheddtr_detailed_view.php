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
                        <li><a href="SchedDtrDetailed">Schedule DTR Detailed</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:300;">Schedule DTR Detailed</h2></center>
                                </div>
                                <div class="panel-body table-responsive" style="padding-top:8px;">
                                    <div class="row">
                                        <div class="col-md-3" style="margin-left: 20px;">
                                            <label  style="float:left;margin-top:5px;font-weight: bold;" for="inputEmail1">Employee Filter :</label>
                                            <select class="form-control"  name="employee_demog_filter" id="employee_demog_filter" data-error-msg="Pay Period Filter is required" required>
                                            <option value="all">All</option>
                                            <?php
                                                foreach($employee as $employees)
                                                                    {
                                                                        echo '<option value="'.$employees->employee_id  .'">'.$employees->full_name.'</option>';
                                                                    }
                                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="float:left;margin-top:5px;margin-left: 20px;font-weight: bold;" for="inputEmail1">Pay Period Year :</label>
                                            <select class="form-control" style="margin-left: 20px;" name="payperiod_demog_filter" id="payperiod_demog_filter" data-error-msg="Pay Period Filter is required" required>
                                            <?php
                                                foreach($payperiod as $periods)
                                                                    {
                                                                        echo '<option value="'.$periods->pay_period_id  .'">'.$periods->pay_period_start." ~ ".$periods->pay_period_end.'</option>';
                                                                    }
                                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn col-sm-12 form-control" id="print_sched_demography" style="background-color:#27ae60;color:white;margin-left: 20px; margin-top: 32px;">
                                                <i class="fa fa-print"></i> PRINT
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="demography_preview" style="overflow: scroll;">
                                    </div>
                                </div>

                                <div class="panel-footer"></div>
                            </div> <!--panel default -->
                        </div>

                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->


<?php echo $_rights;?>
<script>

$(document).ready(function(){
    var employee_filter; var payperiod_demog_filter;
    employee_filter=$("#employee_demog_filter").select2({
        placeholder: "Select Employee",
        allowClear: false
    });

    employee_filter.select2('val', null);

    payperiod_demog_filter=$("#payperiod_demog_filter").select2({
        placeholder: "Select Pay Period",
        allowClear: false
    });

    var filterdemog;
    filterdemog = $('#payperiod_demog_filter').val();
    filterdemogemp = $('#employee_demog_filter').val();
    $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"SchedDtrDetailed/schedule/sched-dtr-detailed/"+filterdemog+"/"+filterdemogemp+"/fullview",
        beforeSend : function(){
                    $('#demography_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#demography_preview').html(response);
            });

    $("#payperiod_demog_filter").change(function(){
        filterdemog = $('#payperiod_demog_filter').val();
        filterdemogemp = $('#employee_demog_filter').val();
        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"SchedDtrDetailed/schedule/sched-dtr-detailed/"+filterdemog+"/"+filterdemogemp+"/fullview",
        beforeSend : function(){
                    $('#demography_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#demography_preview').html(response);
            });
    });

    $("#employee_demog_filter").change(function(){
        filterdemog = $('#payperiod_demog_filter').val();
        filterdemogemp = $('#employee_demog_filter').val();
        $.ajax({
        "dataType":"html",
        "type":"POST",
        "url":"SchedDtrDetailed/schedule/sched-dtr-detailed/"+filterdemog+"/"+filterdemogemp+"/fullview",
        beforeSend : function(){
                    $('#demography_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                },
            }).done(function(response){
                $('#demography_preview').html(response);
            });
    });

    $('#print_sched_demography').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files_demography.css";
            $("#demography_preview").printThis({
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
            }, 3000);
    });


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

    var showinitializeprint=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Initializing Printing...</h4>',
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

});

</script>
</body>

</html>
