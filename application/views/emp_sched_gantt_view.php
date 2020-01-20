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
                        <li><a href="Employee_schedule_gantt">Employee Schedule Gantt</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:300;">Employee Schedule Gantt</h2></center>
                                </div>
                                <div class="panel-body table-responsive">
                                    <div class="row">
                                        <div class="col-md-12">

                                                <div class="col-md-4">
                                                    <br />
                                                    <label for="inputEmail1"><i class="fa fa-user"></i> Employee :</label>
                                                    <select class="form-control" name="employee_id" id="employee_id">
                                                    <option value=""></option>
                                                    <?php foreach($employees as $employee){?>
                                                        <option value="<?php echo $employee->employee_id; ?>">
                                                            <?php echo  $employee->ecode.' - '.$employee->full_name; ?>
                                                        </option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <br />
                                                    <label for="inputEmail1"><b><i class="fa fa-calendar"></i> From Date :</b></label>
                                                    <input type="text" name="from_date" id="from_date" class="form-control date-picker" value="<?php echo date("m/d/Y"); ?>">
                                                </div>

                                                <div class="col-md-3">
                                                    <br />
                                                    <label for="inputEmail1"><b><i class="fa fa-calendar"></i> To Date :</b></label>
                                                    <input type="text" name="to_date" id="to_date" class="form-control date-picker" value="<?php echo date("m/d/Y"); ?>">
                                                </div>

                                            <div class="col-md-2"><br />
                                                <button type="button" class="btn col-sm-12 form-control" id="btn_print_sched_gantt" style="background-color:#27ae60;color:white;margin-top: 9px"><i class="fa fa-print"></i> PRINT</button>

                                                <button type="button" class="btn col-sm-12 form-control" id="btn_pdf_sched_gantt" style="background-color:#05B8CC;color:white;margin-top: 9px"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                                            </div>                                         
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                Legend : 

                                                <span style="width: 25px!important;height: 25px;background: #FFF;border: 1px solid lightgray;display: inline-block;margin-left: 10px;">&nbsp;</span> No Schedule
                                                <span style="width: 25px!important;height: 25px;background: #27ae60;border: 1px solid lightgray;display: inline-block;margin-left: 10px;">&nbsp;</span> Active Schedule
                                                <span style="width: 25px!important;height: 25px;background: #E5FFE5;border: 1px solid lightgray;display: inline-block;margin-left: 10px;">&nbsp;</span> Day Off


                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="margin-top: 5px;">
                                    </div>
                                    <hr>
                                    <div id="demography_preview" style="overflow-x: scroll;">
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
    var _cbo_employee;

    _cbo_employee=$("#employee_id").select2({
        placeholder: "Select Employee",
        allowClear: false
    });

    _cbo_employee.select2('val', null);    

    var process_table_hover=function(){

        $('[data-rel=popover]').popover({
          html: true,
          trigger: "hover"
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

    var format_date=function(date){

        var formattedDate = new Date(date);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        m += 1;  // JavaScript months are 0-11
        var y = formattedDate.getFullYear();
        return y+'-'+m+'-'+d;

    }

    var get_schedule_gantt=function(type){

        var from_date = format_date($('#from_date').val());
        var to_date = format_date($('#to_date').val());
        var employee_id = $('#employee_id').val();

        if (employee_id == null || employee_id == ""){
            employee_id = 0;
        }

        if (type == "fullview"){

            $.ajax({
                "dataType":"html",
                "type":"POST",
                "url":"Employee_schedule_gantt/schedule/schedule_gantt/"+employee_id+"/"+from_date+"/"+to_date+"/"+type,
                beforeSend : function(){
                            $('#demography_preview').html("<center><img src='assets/img/loader/preloaderimg.gif'><h3>Loading...</h3></center>");
                        },
                    }).done(function(response){
                        $('#demography_preview').html(response);
                        process_table_hover();
                    });

        }else{
            window.open("Employee_schedule_gantt/schedule/schedule_gantt/"+employee_id+"/"+from_date+"/"+to_date+"/"+type);
        }

    };

    get_schedule_gantt('fullview');

    $("#from_date").change(function(){
        get_schedule_gantt("fullview");
    });

    $("#to_date").change(function(){
        get_schedule_gantt("fullview");
    });    

    $("#employee_id").change(function(){
        get_schedule_gantt("fullview");
    });

    $(document).on('click','#btn_print_sched_gantt',function(){
        get_schedule_gantt("print");
    });


    $(document).on('click','#btn_pdf_sched_gantt',function(){
        get_schedule_gantt("pdf");
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