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
    <?php echo $loaderscript; ?>
    <style type="text/css">
        body {
          -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
             -khtml-user-select: none; /* Konqueror HTML */
               -moz-user-select: none; /* Old versions of Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
                    user-select: none; /* Non-prefixed version, currently
                                          supported by Chrome, Opera and Firefox */
        }

        img {
          -webkit-user-drag: none;
          -khtml-user-drag: none;
          -moz-user-drag: none;
          -o-user-drag: none;
          user-drag: none;
        }        
    </style>        
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
                        <li><a href="PeriodSchedule">Employee Period Schedule</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:300;">Employee Period Schedule</h2></center>
                                </div>
                                <div class="panel-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <br />
                                                <label for="inputEmail1"><b><i class="fa fa-calendar"></i> Period :</b></label>

                                                <select class="form-control" name="pay_period_id" id="pay_period_id">
                                                    <?php foreach($payperiod as $period){ ?>
                                                        <option value="<?php echo $period->pay_period_id; ?>">
                                                            <?php echo $period->period; ?>
                                                        </option>
                                                    <?php }?>
                                                    
                                                </select>

                                            </div>
                                            <div class="col-md-3">
                                                <br />
                                                <label for="inputEmail1"><i class="fa fa-building"></i> Department :</label>
                                                <select class="form-control" name="ref_department_id" id="ref_department_id">
                                                <option value="all">All</option>
                                                <?php foreach($departments as $department){?>
                                                    <option value="<?php echo $department->ref_department_id; ?>">
                                                        <?php echo $department->department; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                            </div>

                                        <div class="col-md-2"><br /><br />
                                            <button type="button" class="btn col-sm-12 form-control" id="print_period_schedule" style="background-color:#27ae60;color:white;margin-top: 9px"><i class="fa fa-print"></i> PRINT</button>
                                        </div>
                                        <div class="col-md-2"><br /><br />
                                            <button type="button" class="btn col-sm-12 form-control" id="pdf_period_schedule" style="background-color:#05B8CC;color:white;margin-top: 9px"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                                        </div>                                             
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="margin-top: 5px;">
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


<?php echo $_rights; ?>
<script>

$(document).ready(function(){
    var _cbo_department; var _cbo_period;

    _cbo_department=$("#ref_department_id").select2({
        placeholder: "Select Department",
        allowClear: false
    });

    _cbo_department.select2('val', null);    

    _cbo_period=$("#pay_period_id").select2({
        placeholder: "Select Pay Period",
        allowClear: false
    });        

    var process_table_focus=function(){
        // $('.tbl_daily_shift tbody > tr').on("click", function(){
        //     alert();
        // });

        // $('.popover-dismiss').popover({
        //   html: true,
        //   trigger: 'focus'
        // })

        $('[data-rel=popover]').popover({
          html: true,
          trigger: "focus"
        });        

        var x,y,top,left,down;

        $("#demography_preview").mousedown(function(e){
            // e.preventDefault();
            down=true;
            x=e.pageX;
            y=e.pageY;
            top=$(this).scrollTop();
            left=$(this).scrollLeft();
        });

        $("body").mousemove(function(e){
            if(down){

                var newX=e.pageX;
                var newY=e.pageY;
                
                //console.log(y+", "+newY+", "+top+", "+(top+(newY-y)));
                
                $("#demography_preview").scrollTop(top-newY+y);    
                $("#demography_preview").scrollLeft(left-newX+x);    
            }
        });

        $("body").mouseup(function(e){down=false;});       

    }

    var get_period_schedule=function(){

        pay_period_id = $('#pay_period_id').val();
        ref_department_id = $('#ref_department_id').val();

        if (pay_period_id == ""){
            pay_period_id = 0;
        }

        $.ajax({
            "dataType":"html",
            "type":"POST",
            "url":"PeriodSchedule/schedule/period-schedule-demography/"+pay_period_id+"/"+ref_department_id+"/fullview",
            beforeSend : function(){
                        $('#demography_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                    },
                }).done(function(response){
                    $('#demography_preview').html(response);
                    process_table_focus();
                });

    };

    get_period_schedule();

    $("#pay_period_id").change(function(){
        get_period_schedule();
    });

    $("#ref_department_id").change(function(){
        get_period_schedule();
    });

    $(document).on('click','#print_period_schedule',function(){

        pay_period_id = $('#pay_period_id').val();
        ref_department_id = $('#ref_department_id').val();

        if (pay_period_id == ""){
            pay_period_id = 0;
        }

        window.open('PeriodSchedule/schedule/period-schedule-demography/'+pay_period_id+'/'+ref_department_id+'/print');
    });

    $(document).on('click','#pdf_period_schedule',function(){

        pay_period_id = $('#pay_period_id').val();
        ref_department_id = $('#ref_department_id').val();

        if (pay_period_id == ""){
            pay_period_id = 0;
        }
        
        window.open('PeriodSchedule/schedule/period-schedule-demography/'+pay_period_id+'/'+ref_department_id+'/pdf');
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