<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <link href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet" type="text/css">
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Skin House</p>
        </div>
    </div>
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar">
            <?php $this->load->view('includes/topbar')?>
        </header>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <?php $this->load->view('includes/sidebar')?>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Manual Invoice</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Order</li>
                        <li class="breadcrumb-item active">Manual Invoice</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <form action="<?php echo site_url('order/manual_create')?>" method="post">
                                        
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SERVICES RENDERED</th>
                                                    <th class="text-right" width="30%">AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for($i=0;$i<10;$i++):?>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="subItem[]" autocomplete="off"></td>
                                                    <td class="text-right"><input type="text" class="form-control text-right" onkeyup="totalUpdate()" name="subAmt[]" autocomplete="off"></td>
                                                </tr>
                                                <?php endfor?>
                                                <tr>
                                                    <td class="text-right" colspan="2"><textarea name="salesNote" style="min-height: 100px;" class="form-control" placeholder="Sales Note"></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h4>Sub Total</h4></td>
                                                    <td class="text-right"><span id="subDisplay" onkeyup="totalUpdate()"></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h4>GST</h4></td>
                                                    <td class="text-right"><span id="gstDisplay"></span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h1>Total Sales</h1></td>
                                                    <td class="text-right"><span id="totalDisplay"></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        &nbsp;<br>
                                        <input type="hidden" name="docType" id="docType" value="8">
                                        <input type="hidden" name="paymentAmt" id="paymentAmt">
                                        <input type="hidden" name="paymentGst" id="paymentGst">
                                        <input type="hidden" name="paymentTotal" id="paymentTotal">
                                        <input type="hidden" value="<?php echo $this->session->userdata('outlet_id')?>" name="outletID">
                                        <input type="hidden" name="membersID" id="membersID">
                                        <button type="submit" class="btn btn-success"> Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-10">
                                    <div class="form-group">
                                    <label class="control-label">Customer</label>
                                    <select class="form-control select2" onchange="checkCustomer();$('#membersID').(this.value)" id="customer_select">
                                        <option value="898">-- Cash Sales --</option>
                                        <option value="0">- ADD NEW CUSTOMER -</option>
                                        <?php foreach($customers as $customer):?>
                                        <option value="<?php echo $customer->mod_clients_id?>"><?php echo $customer->mod_clients_nric ? $customer->mod_clients_fullname.'('.$customer->mod_clients_nric.')':$customer->mod_clients_fullname?></option>
                                        <?php endforeach?>
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Invoice Number</label>
                                        <input type="text" id="firstName" class="form-control" value="<?php echo $inv?>" disabled="disabled">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                <!-- .right-sidebar -->
                <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Add New Customer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="<?php echo $action; ?>" method="post" id="custForm">
                            <input type="hidden" name="redirect" value="order/manual_invoice">
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="" name="mod_clients_fullname" id="cus_name" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                            <div class="form-group m-l-10 m-r-10 row">
                                <label for="example-search-input" class="col-2 col-form-label nric">NRIC</label>
                                <div class="col-6 nric-danger">
                                    <input class="form-control form-control-danger" type="text" name="mod_clients_nric" id="nric" value="" autocomplete="off" data-mask="999999-99-9999" onkeyup="checkComplete();">
                                    <input class="form-control" type="text" name="passport" id="passport" value="" autocomplete="off" style="display: none">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check m-t-10">
                                        <input type="checkbox" name="mod_clients_passport" id="basic_checkbox_2" class="filled-in" onchange="nric_chg()">
                                        <label for="basic_checkbox_2">Passport</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Birthday</label>
                                <div class="col-4">
                                    <input class="form-control" type="text" value="" name="mod_clients_birthday" id="birthday_id" autocomplete="off" data-mask="9999-99-99">
                                    <small class="font-13 text-muted">YYYY-MM-DD</small>
                                </div>
                                <label for="example-text-input" class="col-2 col-form-label text-right">Gender&nbsp; </label>
                                <div class="col-md-4 m-t-5">
                                    <div class="radio-list">
                                        <label class="custom-control custom-radio">
                                            <input id="radio1" name="mod_clients_gender" type="radio" value="1" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Male</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="radio2" name="mod_clients_gender" type="radio" value="0" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Birthplace</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" value="" name="mod_clients_address_state" id="birth_place" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Contact</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" value="" name="mod_clients_contact_1" autocomplete="off">
                                </div>
                            </div>
                            <!--
                            <div class="form-actions pull-right">
                                <input type="hidden" name="ds_product_id" value="">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                <button type="button" class="btn btn-inverse">Cancel</button>
                            </div>-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect text-left" onclick="$('#custForm').submit()">Submit</button>
                        <button type="button" class="btn btn-inverse waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
                <!-- End Right sidebar -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <?php $this->load->view('includes/footer')?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <?php $this->load->view('includes/jsFooter')?>
    <!-- <script src="<?php echo base_url()?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>-->
    <!--<script src="<?php echo base_url()?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>-->
    <script src="<?php echo base_url()?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/minimal/js/mask.js"></script>
    <script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js')?>"></script>
    <script type="text/javascript">
        $(".select2").select2();
        function addCart(pro_id){
            var div_templates;
            var running_number;

            running_number = $.now();

            //$("#lastRandom").val(running_number);

            $("#pro_"+pro_id).clone().prop({ id: "div_"+running_number}).insertAfter("div.product_well:last");


            $("#div_"+running_number+" a").attr("href", "#collapse_"+running_number);
            $("#div_"+running_number+" a").attr("aria-controls", "collapse_"+running_number);
            $("#div_"+running_number+" .collapse").attr("id", "collapse_"+running_number);
            $("#coll_attr").attr("id", "#collapse_"+running_number);
            $("#div_"+running_number+" .qtyDisplay").attr("id","qtyDisplay_"+running_number);
            $("#div_"+running_number+" .delBtn").attr("onclick","$('#div_"+running_number+"').remove();singleUpdate(null)");

            $("#div_"+running_number+" .priceInput").attr("id","priceInput_"+running_number);
            $("#div_"+running_number+" .priceInput").attr("name","subPrice[]");

            $("#div_"+running_number+" .amtInput").attr("id","amtInput_"+running_number);
            $("#div_"+running_number+" .amtInput").attr("name","subAmt[]");

            $("#div_"+running_number+" .qtyInput").attr("id","qtyInput_"+running_number);
            $("#div_"+running_number+" .qtyInput").attr("name","subItem[]");

            $("#div_"+running_number+" .takenInput").attr("id","takenInput_"+running_number);
            $("#div_"+running_number+" .takenInput").attr("name","subTaken[]");

            $("#div_"+running_number+" .productID").attr("name","productID[]");

            
            

            //var subAmt = $("input[name='pname[]']")
            //  .map(function(){return $(this).val();}).get();
            //var 
            singleUpdate(null,running_number);
            //methodUpdate();
            
        }
        function singleUpdate(para,run=null){
            //var running = para.id.split('_');

            if(para == null){
                //console.log(1);
                running = run;
            }else{
                //console.log(2);
                running = para.id.split('_');
                running = running[1];
            }
            
            var totalPrice = parseFloat($("#qtyInput_"+running).val()) * parseFloat($("#priceInput_"+running).val());
            totalPrice = totalPrice > 0 ? totalPrice.toFixed(2):totalPrice;


            $("#qtyDisplay_"+running).html($("#qtyInput_"+running).val());
            $("#div_"+running+" .priceDisplay").html("RM "+totalPrice);
            $("#amtInput_"+running).val(totalPrice);

            var subAmt = $("input[name='subAmt[]'").map(function(){return $(this).val();}).get();
            //console.log(subAmt);
            var totalItem = $("input[name='subItem[]'").map(function(){return $(this).val();}).get();

            var eval_subAmt = eval(subAmt.join("+"));
            var totalItem = eval(totalItem.join("+"));
            //console.log(eval_subAmt);
            eval_subAmt = eval_subAmt >= 0 ? eval_subAmt.toFixed(2):0;

            $("#subtotalDisplay").html('RM '+eval_subAmt);

            var gstVal = eval_subAmt*0.06;
            gstVal = gstVal >=0 ? gstVal.toFixed(2):0;
            var amtTotal = parseFloat(eval_subAmt)+parseFloat(gstVal);
            amtTotal = amtTotal >= 0 ? amtTotal.toFixed(2):0;

            $("#gstDisplay").html("RM "+gstVal);

            $("#totalAmtDisplay").html("RM "+amtTotal);
            
            $("#totalItemDisplay").html(totalItem);
            $("#takenInput_"+running).val($("#qtyInput_"+running).val());
            $("#takenInput_"+running).attr('max',$("#qtyInput_"+running).val());

            $("#paymentGst").val(gstVal);
            $("#paymentAmt").val(eval_subAmt);
            $("#paymentTotal").val(amtTotal);

            $("#outStandingDisplay").html("RM "+amtTotal);

            //console.log(amtTotal);

        }
        function methodUpdate(){
            var eval_subAmt = eval($("input[name='subAmt[]'").map(function(){return $(this).val();}).get().join("+"));
            var gstVal = eval_subAmt*0.06;
            var amtTotal = parseFloat(eval_subAmt)+parseFloat(gstVal);

            var methodCashVal = $("#methodCash").val() >= 0 ? parseFloat($("#methodCash").val()):0;
            var methodCardVal = $("#methodCard").val() >= 0 ? parseFloat($("#methodCard").val()):0;
            var methodOnlineVal = $("#methodOnline").val() >= 0 ? parseFloat($("#methodOnline").val()):0;
            var methodVoucherVal = $("#methodVoucher").val() >= 0 ? parseFloat($("#methodVoucher").val()):0;

            gstVal = gstVal || 0;
            amtTotal = amtTotal || 0;
            methodCashVal = methodCashVal || 0;
            methodCardVal = methodCardVal || 0;
            methodOnlineVal = methodOnlineVal || 0;
            methodVoucherVal = methodVoucherVal || 0;

            var outStanding;

            outStanding = outStanding || 0;
            outStanding = methodCashVal + methodCardVal + methodOnlineVal + methodVoucherVal;
            outStanding = amtTotal - outStanding;
            

            $("#methodCashDisplay").html("RM "+methodCashVal.toFixed(2));
            $("#methodCardDisplay").html("RM "+methodCardVal.toFixed(2));
            $("#methodOnlineDisplay").html("RM "+methodOnlineVal.toFixed(2));
            $("#methodVoucherDisplay").html("RM "+methodVoucherVal.toFixed(2));

            $("#outStandingDisplay").html("RM "+outStanding.toFixed(2));

            if(outStanding<=0){
                $("#methodFormBtn").show();
            }else{
                $("#methodFormBtn").hide();
            } //methodFormBtn
        }
        function changeDocType(type){
            $("#docType").val(type);
        }
        function genOrder(){
            $("#hiddenOrder").val(JSON.stringify($("#orderForm").serializeArray()));
            $("#cashierForm").submit();
            //$("input[name='subAmt[]'").attr('value',0);

        }
        function generateInv(){
            //console.log(JSON.stringify($("#methodFormID").serializeArray()));
            $("#hiddenMethod").val(JSON.stringify($("#methodFormID").serializeArray()));
            $("#cashierForm").submit();
        }

        function checkCustomer(){
            if($("#customer_select").val()==0){
                $('#myModal').modal('toggle');
            }
        }
        function checkComplete(){
            if($("#nric").val().substring(13, 14) >= 0){
                nricAuto();
            }
        }
        function nric_chg(){
            $("#nric").hide();
            $("#passport").hide();
            if($("#basic_checkbox_2").is(':checked')){
                $("#passport").show();
                $(".nric").html('Passport');
            }else{
                $("#nric").show();
                $(".nric").html('NRIC');
            }
        }
        
        //$("#nric").inputmask("999999-99-9999",{ "oncomplete": function(){ alert('inputmask complete'); } });
        function summary_update(){

        }
        function nricAuto(){
            //alert('111');
            var birtdate = $("#nric").val().substring(4,6);
            var birthmonth = $("#nric").val().substring(2,4);
            var birthyear = $("#nric").val().substring(0,2);
            var gender = $("#nric").val().substring(13,14);
            var place_of_birth = $("#nric").val().substring(7,9);

            var placeBithArr = {};
            placeBithArr['01'] = 'Johor';
            placeBithArr['02'] = 'Kedah';
            placeBithArr['03'] = 'Kelantan';
            placeBithArr['04'] = 'Malacca';
            placeBithArr['05'] = 'Negeri Sembilan';
            placeBithArr['06'] = 'Pahang';
            placeBithArr['07'] = 'Penang';
            placeBithArr['08'] = 'Perak';
            placeBithArr['09'] = 'Perlis';
            placeBithArr['10'] = 'Selangor';
            placeBithArr['11'] = 'Terengganu';
            placeBithArr['12'] = 'Sabah';
            placeBithArr['13'] = 'Sarawak';
            placeBithArr['14'] = 'Kuala Lumpur';
            placeBithArr['15'] = 'Labuan';
            placeBithArr['16'] = 'Putrajaya';
            placeBithArr['21'] = 'Johor';
            placeBithArr['22'] = 'Johor';
            placeBithArr['23'] = 'Johor';
            placeBithArr['24'] = 'Johor';
            placeBithArr['25'] = 'Kedah';
            placeBithArr['26'] = 'Kedah';
            placeBithArr['27'] = 'Kedah';
            placeBithArr['28'] = 'Kelantan';
            placeBithArr['29'] = 'Kelantan';
            placeBithArr['30'] = 'Malacca';
            placeBithArr['31'] = 'Negeri Sembilan';
            placeBithArr['32'] = 'Pahang';
            placeBithArr['33'] = 'Pahang';
            placeBithArr['34'] = 'Pahang';
            placeBithArr['35'] = 'Pahang';
            placeBithArr['36'] = 'Perak';
            placeBithArr['37'] = 'Perak';
            placeBithArr['38'] = 'Perak';
            placeBithArr['39'] = 'Perak';
            placeBithArr['40'] = 'Perlis';
            placeBithArr['41'] = 'Selangor';
            placeBithArr['42'] = 'Selangor';
            placeBithArr['43'] = 'Selangor';
            placeBithArr['44'] = 'Selangor';
            placeBithArr['45'] = 'Terengganu';
            placeBithArr['46'] = 'Terengganu';
            placeBithArr['47'] = 'Sabah';
            placeBithArr['48'] = 'Sabah';
            placeBithArr['49'] = 'Sabah';
            placeBithArr['50'] = 'Sarawak';
            placeBithArr['51'] = 'Sarawak';
            placeBithArr['52'] = 'Sarawak';
            placeBithArr['53'] = 'Sarawak';
            placeBithArr['54'] = 'Kuala Lumpur';
            placeBithArr['55'] = 'Kuala Lumpur';
            placeBithArr['56'] = 'Kuala Lumpur';
            placeBithArr['57'] = 'Kuala Lumpur';
            placeBithArr['58'] = 'Labuan';
            placeBithArr['59'] = 'Negeri Sembilan';

            //alert(placeBithArr[place_of_birth]);

            /*
            placebirth['01'] = 'Johor'; 
            placebirth['12'] = 'Sabah'; */

            gender = gender %2==0 ? 'Female':'Male';
            $("input[name=radio]").removeAttr("checked");
            //$("#nric").val().substring(13, 14)
            if($("#nric").val().substring(13, 14) %2==0){
                $("input[name=mod_clients_gender][value=0]").attr('checked', 'checked');

            }else{
                $("input[name=mod_clients_gender][value=1]").attr('checked', 'checked');
            }

            birthyear = birthyear > 25 ? '19'+birthyear:'20'+birthyear;
            $("#birthday_id").val(birthyear+'-'+birthmonth+'-'+birtdate);
            $("#birth_place").val(placeBithArr[place_of_birth]);
            //$("#gender-id").val(gender);


            //if(theValue.value%2==0)
            //console.log($("#mask-phone").val().length);
            //var url = http://127.0.0.1/skinhouse/index.php/members/check_ic;
            var getJSON = function(url) {
              return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('get', url, true);
                xhr.responseType = 'json';
                xhr.onload = function() {
                  var status = xhr.status;
                  if (status == 200) {
                    resolve(xhr.response);
                  } else {
                    reject(status);
                  }
                };
                xhr.send();
              });
            };
            var ic_val = $('#nric').val();

            $(".nric-danger").removeClass("has-success");
            $(".nric-danger").removeClass("has-danger");

            getJSON('<?php echo site_url('members/check_ic/')?>'+ic_val).then(function(data) {
                //console.log(data.mod_clients_fullname);
                if(data){
                    //alert(data.mod_clients_fullname+'-'+$('#nric').val()+' is EXISTED!');
                    swal("Duplicated :"+data.mod_clients_fullname);
                    $(".nric-danger").addClass("has-danger");
                    $("#nric").addClass("form-control-danger");
                }else{
                    
                    $(".nric-danger").addClass("has-success");
                    $("#nric").addClass("form-control-success");
                }
                //alert('Your Json result is:  ' + data.result); //you can comment this, i used it to debug

                //result.innerText = data.result; //display the result in an HTML element
            }, function(status) { //error detection....
              alert('Something went wrong.');
            });
        }
        function totalUpdate(){
            var subAmt = $("input[name='subAmt[]'").map(function(){
                if($(this).val()){
                    return $(this).val();
                }else{
                    return 0;
                }
                
            }).get();
            var eval_subAmt = eval(subAmt.join("+"));

            var subDisplay = eval_subAmt.toFixed(2);
            var gstDisplay = (eval_subAmt*0.06).toFixed(2);
            var totalDisplay = (parseFloat(subDisplay)+parseFloat(gstDisplay)).toFixed(2);

            $("#subDisplay").html('<h4>'+subDisplay+'</h4>');
            $("#gstDisplay").html('<h4>'+gstDisplay+'</h4>');
            $("#totalDisplay").html('<h2>'+totalDisplay+'</h2>');

            $("#paymentAmt").val(subDisplay);
            $("#paymentGst").val(gstDisplay);
            $("#paymentTotal").val(totalDisplay);
        }
    </script>
</body>
</html>