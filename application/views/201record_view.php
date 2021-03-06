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
                        <li><a href="PersonnelList">Personnel List</a></li>
                    </ol>

                    <div class="container-fluid">

                        <div id="div_2316_list">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#2c3e50 !important;margin-top:2px;">
                                     <center><h2 style="color:white;font-weight:300;">Personnel List </h2></center>
                                </div>
                                <div class="panel-body table-responsive" style="padding-top:8px;">
                                    <div class="row">
                                        <div style="padding: 5px;margin-left: 20px; margin-top: 10px;">
                                             <div class="col-md-3">
                                                <label style="font-weight: bold;" for="inputEmail1">Employee Filter :</label>
                                                <select class="form-control" name="employee_filter_list" id="employee_filter_list" data-error-msg="Pay Period Filter is required" required>
                                                <option value="0">Select an employee</option>
                                                <?php foreach($employee as $employees){?>
                                                          <option value="<?php echo $employees->employee_id; ?>">
                                                            <?php echo $employees->ecode.' '.$employees->full_name; ?>
                                                          </option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div class="row" style="margin-top: 25px;">
                                                <div class="col-md-2">
                                                <button type="button" class="btn col-sm-12 form-control" id="print_employee_201record" style="background-color:#27ae60; color:white; width: 200px;">PRINT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="p_preview" style="overflow: scroll;">
                                    </div>
                                </div>

                                <div class="panel-footer"></div>
                            </div> <!--panel default -->
                        </div>

                    <div class="modal fade" id="modal_authorization" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-m" style="margin-top: 200px;">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#2980b9;">
                              <h4 class="modal-title" style="color:white;"><span class="fa fa-lock"></span> Authorization</h4>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="col-md-12">
                                    <div style="font-size: 11pt;">
                                        <strong>NOTE: <span style="color: red;">201 Records are cofidential Reports</span>. </strong><br>
                                        Please Enter the authorization password.
                                        <hr>
                                    </div>
                                        <input type="password" name="authorizationpwd" id="authorizationpwd" class="form-control" style="height: 50px !important; font-size: 15pt !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="background: #ECEFF1;">
                                <div style="margin-right: 30px;">
                                <button type="button" id="btnauthenticate" class="btn btn-primary" style="width: 100px; height: 38px; font-size: 13pt;"><span class="fa fa-check-circle"></span> OK</button>
                                <a href="dashboard"><button type="button" class="btn" style="width: 100px; height: 38px; font-size: 13pt; background: #c62828; color: #fff;"> Cancel</button></a>
                                </div>
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

        $(document).bind("contextmenu", function (e) {
                e.preventDefault();
        });

        $(document).keydown(function(event){
            if(event.keyCode == 123){
              //return false;  //Prevent from F12
          }
          else if(event.ctrlKey && event.shiftKey && event.keyCode == 73){
              return false;  //Prevent from ctrl+shift+i
          }
          else if(event.ctrlKey && event.keyCode == 85){
              return false;  //Prevent from ctrl+u
          }
          else if(event.ctrlKey && event.keyCode == 84){
              return false;  //Prevent from ctrl+t
          }
          else if(event.ctrlKey && event.keyCode == 83){
              return false;  //Prevent from ctrl+s
          }
          else if(event.keyCode == 113){
              $('#txtsearch').focus();  //Prevent from ctrl+s
          }
        });

    setTimeout(function() {
        $('#modal_authorization').modal('show');
        $('#authorizationpwd').focus(300);
    }, 1000);

    var processpwd = function(){
        var pwd = $('#authorizationpwd').val();
                if (pwd == ""){
                    showNotification({title:"Error!",stat:"error",msg:"Enter authorization password!"});
                    $('#authorizationpwd').focus();
                }else{
                authorization().done(function(response){
                 var checking = response['stat'];
                     if (checking == "success"){
                        showNotification(response);
                        $('#modal_authorization').modal('hide');
                     }else{
                        showNotification(response);
                        $('#authorizationpwd').focus().select();
                     }
                  });
                }
    };

    $('#btnauthenticate').click(function(){
        processpwd();
    });

    $('#authorizationpwd').keypress(function(evt){
        if(evt.keyCode==13){ 
            processpwd();
        }
    });

    var authorization=(function(){
       var _data={pword : $('input[name="authorizationpwd"]').val()};
               return $.ajax({
                   "dataType":"json",
                   "type":"POST",
                   "url":"Employee/transaction/chck_authorization",
                   "data" : _data,
                   "beforeSend": function(){
                   }
         });
   });

    var _employee;

    _employee=$("#employee_filter_list").select2({
        placeholder: "Select an employee",
        allowClear: true
    });

    _employee.select2('val', null);

    var nodata = "<div style='font-weight: bold; padding: 20px;font-size: 12pt;'><center>No data available</center></div>";

    $('#p_preview').html(nodata);

    $("#employee_filter_list").change(function(){
        filter_employee = $('#employee_filter_list').val();

        if (filter_employee == 0){
            $('#p_preview').html(nodata);
        }else{
            $.ajax({
            "dataType":"html",
            "type":"POST",
            "url":"Hris_Reports/reports/record201/"+filter_employee+"",
            beforeSend : showSpinningProgressLoading(),
                }).done(function(response){
                    $.unblockUI();
                    $('#p_preview').html(response);
                });
            }
    });

    $('#print_employee_201record').click(function(event){
            showinitializeprint();
            var currentURL = window.location.href;
            var output = currentURL.match(/^(.*)\/[^/]*$/)[1];
            output = output+"/assets/css/css_special_files.css";
            $("#p_preview").printThis({
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
});

</script>
</body>

</html>
