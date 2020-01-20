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
                        <li><a href="EmployeeQuickSetup">Employee Quick Setup</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2ecc71 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:bold;">Employee Quick Setup</h2></center>
                                </div>
                                <div class="panel-body table-responsive" style="padding-top:8px;">
                                    <form id="frm_employee_setup" role="form" class="form-horizontal row-border">
                                        <div class="container-fluid">
                                            <div class="col-md-12" style="margin-top: 15px; margin-bottom: 20px;">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Firstname</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_fname" class="form-control" value="" data-error-msg="Firstname is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Lastname</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_lname" class="form-control" value="" data-error-msg="Lastname is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Middlename</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_mname" class="form-control" value="">
                                                                <!-- data-error-msg="Middlename is required!" required -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Email</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_email" class="form-control" value="" data-error-msg="Email is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Department</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <select name="emp_dept" id="emp_dept" class="form-control" data-error-msg="Department is Required!" required style="width: 100%;">
                                                                    <option value="0">[ Create Department ]</option>
                                                                    <?php
                                                                        foreach($ref_department as $row)
                                                                        {
                                                                            echo '<option value="'.$row->ref_department_id .'">'.$row->department.'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Branch</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <select class="form-control" name="emp_branch" id="emp_branch" data-error-msg="Branch is Required!" required style="width: 100%;">
                                                                    <option value="0">[ Create Branch ]</option>
                                                                    <?php
                                                                        foreach($ref_branch as $row)
                                                                        {
                                                                            echo '<option value="'.$row->ref_branch_id  .'">'.$row->branch.'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Tax Pay Type</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <select class="form-control" id="emp_pay_type" name="emp_pay_type" data-error-msg="Payment Type is Required!" required style="width: 100%;">
                                                                    <option value="0">[ Please select tax pay type ]</option>
                                                                    <?php
                                                                    foreach($ref_payment as $row)
                                                                        {
                                                                        echo '<option id="'.$row->pay_type_factor  .'" value="'.$row->ref_payment_type_id  .'">'.$row->payment_type.'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> 
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Tax Code</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <select class="form-control" id="emp_tax_code" name="emp_tax_code" data-error-msg="Tax Code is required!" required style="width: 100%;">
                                                                    <?php foreach($tax_codes as $row)
                                                                        {
                                                                            echo '<option value="'.$row->tax_id  .'">'.$row->tax_code.'</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Employee Type</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                    <select class="form-control" id="emp_type" name="emp_type" data-error-msg="Employee Type is Required!" required style="width: 100%;">
                                                                        <option value="0">[ Create Employment Type ]</option>
                                                                        <?php
                                                                            foreach($ref_emptype as $row)
                                                                            {
                                                                            echo '<option value="'.$row->ref_employment_type_id  .'">'.$row->employment_type.'</option>';
                                                                            }
                                                                        ?>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Group</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                    <select class="form-control" id="emp_group" name="emp_group" data-error-msg="Group is Required!" required style="width: 100%;">
                                                                    <option value="0">[ Create Group Type ]</option>
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
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Hrs Per Day</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_hrs_per_day" id="emp_hrs_per_day" class="form-control numeric" value="" data-error-msg="Hrs Per Day is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Regular Rates</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" name="emp_reg_rates" id="emp_reg_rates" class="form-control numeric" value="" data-error-msg="Regular Rates is required!" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Per Day</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" id="emp_per_day_pay" name="emp_per_day_pay" class="form-control numeric" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <label class="control-label boldlabel" style="text-align:left;">Per Hour</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                <i class="fa fa-file-code-o"></i>
                                                                </span>
                                                                <input type="text" id="emp_per_hour_pay" name="emp_per_hour_pay" class="form-control numeric" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>   
                                </div>
                                <div class="panel-footer">
                                    <button id="btn_save_setup" class="btn" style="float: right; margin-right: 30px; padding: 10px; padding-left: 10px;padding-right: 10px; width: 150px;font-size: 12pt; background-color: #CFD8DC; border: 1px solid #455A64;"><span class="fa fa-check-circle"></span> Save</button>
                                </div>
                            </div> <!--panel default -->
                        </div>
                        <div id="modal_references" class="modal fade modal_references" tabindex="-1" role="dialog"><!--modal-->
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#27ae60;">
                                        <button type="button" style="color:white;" class="close"  data-dismiss="modal" aria-hidden="true">X</button>
                                        <h4 class="modal-title" style="color:white;"><span id="modal_mode"> </span><texttitle id="title_modal"></texttitle></h4>
                                    </div>

                                    <div class="modal-body">
                                        <form id="frm_references">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label class="boldlabel"><texttitle id="name_modal"></texttitle> :</label>
                                                <input type="text" class="form-control" id="postname" name="postname" placeholder="" data-error-msg="This Field is Required!" required>
                                            </div>
                                          </div>
                                        </div><br>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label class="boldlabel"><texttitle id="description_modal"></texttitle> :</label>
                                                <textarea type="text" class="form-control" id="postdescription" name="postdescription" placeholder=""></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button id="btn_new_create_reference" type="button" class="btn btn-success">Save</button>
                                        <button id="btn_close_reference" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div><!--static content -->

        </div><!--content wrapper -->
    </div><!--static layout -->
</div> <!--wrapper -->


<!-- <?php echo $_rights; ?> -->
<script>

$(document).ready(function(){

    var emp_dept; var emp_branch; var emp_pay_type; var emp_tax_code; var emp_type; var emp_group; var _txnModeRate; 

    $('.numeric').autoNumeric('init');

    var initialize_select = function(){
        $('#emp_dept').val(1);
        $('#emp_branch').val(1);
        $('#emp_pay_type').val(0);
        $('#emp_type').val(1);
        $('#emp_group').val(1);
    };

    initialize_select();

    $('#emp_dept').change(function(){
        var a = $('#emp_dept').val();
        if(a=="0"){
            _txnModeRate="department";
            clearFieldsRef();
            $('#emp_dept').val(1);
            $('#title_modal').text('Create Department');
            $('#name_modal').text('Department Name');
            $('#description_modal').text('Description');
            $('#postname').attr('placeholder', 'Department name');
            $('#postdescription').attr('placeholder', 'Department Description');
            $('#modal_references').modal('show');
        }
    });

    $('#emp_branch').change(function(){
        var a = $('#emp_branch').val();
        if(a=="0"){
            _txnModeRate="branch";
            clearFieldsRef();
            $('#emp_branch').val(1);
            $('#title_modal').text('Create Branch');
            $('#name_modal').text('Branch Name');
            $('#description_modal').text('Description');
            $('#postname').attr('placeholder', 'Branch name');
            $('#postdescription').attr('placeholder', 'Branch Description');
            $('#modal_references').modal('show');
        }
    });

    // $('#emp_pay_type').change(function(){
    //     var a = $('#emp_pay_type').val();
    //     if(a=="0"){
    //         _txnModeRate="paytype";
    //         clearFieldsRef();
    //         $('#emp_pay_type').val(1);
    //         $('#title_modal').text('Create Tax Pay Type');
    //         $('#name_modal').text('Tax Pay Type');
    //         $('#description_modal').text('Description');
    //         $('#postname').attr('placeholder', 'Tax Pay Type');
    //         $('#postdescription').attr('placeholder', 'Description');
    //         $('#modal_references').modal('show');
    //     }
    // });

    $('#emp_type').change(function(){
        var a = $('#emp_type').val();
        if(a=="0"){
            _txnModeRate="emp_type";
            clearFieldsRef();
            $('#emp_type').val(1);
            $('#title_modal').text('Create Employee Type');
            $('#name_modal').text('Employee Type');
            $('#description_modal').text('Description');
            $('#postname').attr('placeholder', 'Employee Type');
            $('#postdescription').attr('placeholder', 'Description');
            $('#modal_references').modal('show');
        }
    });

    $('#emp_group').change(function(){
        var a = $('#emp_group').val();
        if(a=="0"){
            _txnModeRate="group";
            clearFieldsRef();
            $('#emp_group').val(1);
            $('#title_modal').text('Group');
            $('#name_modal').text('Group name');
            $('#description_modal').text('Description');
            $('#postname').attr('placeholder', 'Group name');
            $('#postdescription').attr('placeholder','Description');
            $('#modal_references').modal('show');
        }
    });

    $('#btn_new_create_reference').click(function(){
        var btn=$(this);
        if(validateRequiredFields($('#frm_references'))){
            if(_txnModeRate=="department"){
                createDepartment().done(function(response){
                    showNotification(response);
                    $('#modal_references').modal('hide');
                    var _data=response.row_added[0];
                    $('#emp_dept').append('<option value="'+_data.ref_department_id+'" selected>'+_data.department+'</option>');
                    $('#emp_dept').val(_data.ref_department_id);
                }).always(function(){
                    $.unblockUI();
                });
            }
            if(_txnModeRate=="branch"){
                createBranch().done(function(response){
                    showNotification(response);
                    $('#modal_references').modal('hide');
                    var _data=response.row_added[0];
                    $('#emp_branch').append('<option value="'+_data.ref_branch_id+'" selected>'+_data.branch+'</option>');
                    $('#emp_branch').val(_data.ref_branch_id);
                }).always(function(){
                    $.unblockUI();
                });
            }
            if(_txnModeRate=="paytype"){
                createTaxPayType().done(function(response){
                    showNotification(response);
                    $('#modal_references').modal('hide');
                    var _data=response.row_added[0];
                    $('#emp_pay_type').append('<option value="'+_data.ref_payment_type_id+'" selected>'+_data.payment_type+'</option>');
                    $('#emp_pay_type').val(_data.ref_payment_type_id);
                }).always(function(){
                    $.unblockUI();
                });
            }
            if(_txnModeRate=="emp_type"){
                createEmpType().done(function(response){
                    showNotification(response);
                    $('#modal_references').modal('hide');
                    var _data=response.row_added[0];
                    $('#emp_type').append('<option value="'+_data.ref_employment_type_id+'" selected>'+_data.employment_type+'</option>');
                    $('#emp_type').val(_data.ref_employment_type_id);
                }).always(function(){
                    $.unblockUI();
                });
            }
            if(_txnModeRate=="group"){
                createGroup().done(function(response){
                    showNotification(response);
                    $('#modal_references').modal('hide');
                    var _data=response.row_added[0];
                    $('#emp_group').append('<option value="'+_data.group_id+'" selected>'+_data.group_desc+'</option>');
                    $('#emp_group').val(_data.group_id);
                }).always(function(){
                    $.unblockUI();
                });
            }
        }
    });

    $('#emp_pay_type').change(function(){
        /*alert("aw");*/
        var tax = $('#emp_pay_type').val();
        if(tax==1){
            gettaxcodesemimonthly().done(function(response){
                            /*showNotification(response);*/
                            var show2select="";
                            if(response.data.length==0){
                                return;
                            }
                            var jsoncount=response.data.length-1;
                             for(var i=0;parseInt(jsoncount)>=i;i++){
                                //alert(response.available_leave[i].leave_type);
                                show2select+='<option value='+response.data[i].tax_id+'>'+response.data[i].tax_code+'</option>';
                             }
                             $('#emp_tax_code').html(show2select);
                            }).always(function(){
                            $.unblockUI();
                            });
        }
        if(tax==2){
            gettaxcodemonthly().done(function(response){
                            /*showNotification(response);*/
                            var show2select="";
                            if(response.data.length==0){
                                return;
                            }
                            var jsoncount=response.data.length-1;
                             for(var i=0;parseInt(jsoncount)>=i;i++){
                                //alert(response.available_leave[i].leave_type);
                                show2select+='<option value='+response.data[i].tax_id+'>'+response.data[i].tax_code+'</option>';
                             }
                             $('#emp_tax_code').html(show2select);
                            }).always(function(){
                            $.unblockUI();
                            });
        }
        if(tax==3){
            gettaxcodedaily().done(function(response){
                            /*showNotification(response);*/
                            var show2select="";
                            if(response.data.length==0){
                                return;
                            }
                            var jsoncount=response.data.length-1;
                             for(var i=0;parseInt(jsoncount)>=i;i++){
                                //alert(response.available_leave[i].leave_type);
                                show2select+='<option value='+response.data[i].tax_id+'>'+response.data[i].tax_code+'</option>';
                             }
                             $('#emp_tax_code').html(show2select);
                            }).always(function(){
                            $.unblockUI();
                            });
        }
        if(tax==4){
            gettaxcodeweekly().done(function(response){
                            /*showNotification(response);*/
                            var show2select="";
                            if(response.data.length==0){
                                return;
                            }
                            var jsoncount=response.data.length-1;
                             for(var i=0;parseInt(jsoncount)>=i;i++){
                                //alert(response.available_leave[i].leave_type);
                                show2select+='<option value='+response.data[i].tax_id+'>'+response.data[i].tax_code+'</option>';
                             }
                             $('#emp_taxcode').html(show2select);
                            }).always(function(){
                            $.unblockUI();
                            });
        }

    });

    var gettaxcodesemimonthly=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefWTax/transaction/taxSemiMonthly",
            "beforeSend": showSpinningProgressLoading($('#'))
        });
    };
    var gettaxcodemonthly=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefWTax/transaction/taxMonthly",
            "beforeSend": showSpinningProgress($('#'))
        });
    };
    var gettaxcodedaily=function(){
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefWTax/transaction/taxDaily",
            "beforeSend": showSpinningProgress($('#'))
        });
    }
    var gettaxcodeweekly=function(){
        //_data.push({name:"is_inventory",value: $('input[name="is_inventory"]').val()});
        //alert($('input[name="is_inventory"]').val());
        /*alert("test");*/
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefWTax/transaction/taxWeekly",
            "beforeSend": showSpinningProgress($('#'))
        });
    }


    $('#btn_save_setup').click(function(){
        if(validateRequiredFields($('#frm_employee_setup'))){
            createEmployeeQuickSetup().done(function(response){
                showNotification(response);
                if(response.stat=="error"){
                    $.unblockUI();
                    return;
                }
                clearFields($('#frm_employee_setup'))
            }).always(function(){
                $.unblockUI();
            });
        }
    });

    $('#emp_pay_type').change(function() {
        computeperdayandperhour();
    });

    $("#emp_hrs_per_day").keyup(function(){
        computeperdayandperhour();
    });

    $("#emp_reg_rates").keyup(function(){
        computeperdayandperhour();
    });

    var clearFieldsRef = function(){
        $('#postname').val('');
        $('#postdescription').val('');
        $('#postname').focus();
    };

    var createDepartment = function(){
        var data=$('#frm_references').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefDepartment/transaction/createdirect",
            "data":data,
            "beforeSend" : function(){
                showSpinningProgress($('#btn_new_create_reference'));
            }
        });
    };

    var createBranch = function(){
        var data=$('#frm_references').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefBranch/transaction/createdirect",
            "data":data,
            "beforeSend" : function(){
                showSpinningProgress($('#btn_new_create_reference'));
            }
        });
    };

    var createTaxPayType = function(){
        var data=$('#frm_references').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefPaymentType/transaction/createdirect",
            "data":data,
            "beforeSend" : function(){
                showSpinningProgress($('#btn_new_create_reference'));
            }
        });
    };

    var createEmpType = function(){
        var data=$('#frm_references').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefEmploymentType/transaction/createdirect",
            "data":data,
            "beforeSend" : function(){
                showSpinningProgress($('#btn_new_create_reference'));
            }
        });
    };

    var createGroup = function(){
        var data=$('#frm_references').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"RefGroup/transaction/createdirect",
            "data":data,
            "beforeSend" : function(){
                showSpinningProgress($('#btn_new_create_reference'));
            }
        });
    };


    var computeperdayandperhour=function(){
        var payment_factor = $('#emp_pay_type option:selected').attr('id');
        var hour_per_day_temp = $('#emp_hrs_per_day').val();
        var hour_per_day = hour_per_day_temp.replace(/,/g, "");
        var salary_reg_rates_compute_temp = $('#emp_reg_rates').val();
        var salary_reg_rates_compute = salary_reg_rates_compute_temp.replace(/,/g, "");

        //finalize compute
        var per_day_pay =  parseInt(salary_reg_rates_compute) / parseInt(payment_factor);
        var per_hour_pay =  parseInt(salary_reg_rates_compute) / parseInt(hour_per_day) / parseInt(payment_factor);

        $('#emp_per_day_pay').val(accounting.formatNumber(per_day_pay,2));
        $('#emp_per_hour_pay').val(accounting.formatNumber(per_hour_pay,2));
    };

    var createEmployeeQuickSetup=function(){
        var _data=$('#frm_employee_setup').serializeArray();
        return $.ajax({
            "dataType":"json",
            "type":"POST",
            "url":"EmployeeQuickSetup/transaction/create",
            "data":_data,
            "beforeSend": showSpinningProgressLoading()
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

    var validateRequiredFields=function(f){
        var stat=true;
        $('div.form-group').removeClass('has-error');
        $('input[required],textarea[required],select[required]',f).each(function(){
                if($(this).is('select')){
                if($(this).val()==0 || $(this).val()==null){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
                }else{
                if($(this).val()==""){
                    showNotification({title:"Error!",stat:"error",msg:$(this).data('error-msg')});
                    $(this).closest('div.form-group').addClass('has-error');
                    $(this).focus();
                    stat=false;
                    return false;
                }
            }
        });
    return stat;
    };

    var showSpinningProgress=function(e){
        $.blockUI({ message: '<img src="assets/img/gears.svg"/><br><h4 style="color:#ecf0f1;">Saving Changes...</h4>',
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
        initialize_select();
    };

});

</script>
</body>

</html>
