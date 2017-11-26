<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <link href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
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
                    <h3 class="text-themecolor">Cash Sales</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">pages</li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-7">
                        <div class="col-12">
                            <!--
                            <div class="card-body">
                                This is some text within a card block.
                            </div>-->
                            <?php 
                                //print_r($product)
                                //print_r($customers);
                            ?>
                        </div>
                        <?php foreach($product as $pro):?>
                        <div class="col-md-4 col-lg-4 col-xlg-3">
                            <a href="javascript:void(0)" onclick='addCart(<?php echo $pro->ds_product_id?>);'>
                            <div class="card card-body" style="color:#333">
                                <div class=""><strong><?php echo $pro->ds_product_name?></strong><?php ?></div>

                            </div>
                            </a>
                        </div>

                        <!--TEMPLATES-->
                        <div style="display: none">
                            <div id="pro_<?php echo $pro->ds_product_id?>" class="card product_well" style="margin-bottom: 0px">
                                <div class="card-header" role="tab" id="heading<?php echo $pro->ds_product_id?>">
                                    <h5 class="mb-0">

                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#coll_attr" aria-expanded="false" aria-controls="coll_attr">
                                  <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><span class="qtyDisplay">1</span>&nbsp;x&nbsp;<?php echo $pro->ds_product_name?></h5>
                                <span class="priceDisplay">RM&nbsp;<?php echo $pro->ds_product_price?></span><!--<small class="text-muted"></small>-->
                            </div>

                            <small class="text-muted"><!--Donec id elit non mi porta.--></small>
                                </a>
                              </h5> </div>
                                <div id="coll_attr" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Quantity</label>
                                                    <input type="number" class="form-control qtyInput" onkeyup="singleUpdate(this)" onchange="singleUpdate(this)"
                                                     value="1">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Price</label>
                                                    <input type="number" class="form-control priceInput" onkeyup="singleUpdate(this)" onchange="singleUpdate(this)" value="<?php echo $pro->ds_product_price?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                                <div class="form-group">
                                                    <label class="control-label">Sub Total</label>
                                                    <input type="text" class="form-control amtInput" name="subAmt[]" value="<?php echo $pro->ds_product_price?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--END TEMPLATES-->
                        <?php endforeach?>
                        <!--
                        <div class="col-md-4 col-lg-4 col-xlg-3">
                            <div class="card card-body">
                                <div class=""><strong>Toner</strong></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xlg-3">
                            <div class="card card-body">
                                <div class=""><strong>Toner</strong></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xlg-3">
                            <div class="card card-body">
                                <div class=""><strong>Toner</strong></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xlg-3">
                            <div class="card card-body">
                                <div class=""><strong>Toner</strong></div>
                            </div>
                        </div>-->
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <select class="form-control custom-select select2" id="customer_select" onchange="checkCustomer()">
                                            <option>&nbsp;</option>
                                            <option value="0">- ADD NEW CUSTOMER -</option>
                                            <?php foreach($customers as $customer):?>
                                            <option value="<?php echo $customer->mod_clients_id?>"><?php echo $customer->mod_clients_nric ? $customer->mod_clients_fullname.'('.$customer->mod_clients_nric.')':$customer->mod_clients_fullname?></option>
                                            <?php endforeach?>
                                        </select>
                                        &nbsp;<br>
                                    </div>

                                    <div class="list-group col-12" style="padding-left: 16px;">
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="product_well" style="display: none">
                                            </div>
                                            <!--
                                            <div class="card product_well" style="margin-bottom: 0px">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Hydra Intensive Toner</h5>
                                                <small class="text-muted">RM 3000</small>
                                            </div>
                                            <small class="text-muted">Donec id elit non mi porta.</small>
                                                </a>
                                              </h5> </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body"> 
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Quantity</label>
                                                                    <input type="text" class="form-control" value="1">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Price</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Include GST</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                        &nbsp;<br>
                                    </div>
                                    <div class="col-12">
                                        <!--<input id="lastRandom" type="text">-->
                                        <textarea class="form-control" placeholder="Add Sales Note"></textarea>
                                        
                                        <hr>
                                        <div>Sub-total <span class="pull-right" style="font-weight: 500">RM 123.00</span></div>
                                        <div>Discount <span class="pull-right" style="font-weight: 500">- RM 10.00</span></div>
                                        <div>GST 6% <span class="pull-right" style="font-weight: 500">RM 6.50</span></div>
                                        <hr>
                                        <div>Total <span class="pull-right" style="font-weight: 500;font-size: 25px">RM 1,233.50</span></div>
                                    </div>
                                    <div class="col-12">
                                    &nbsp;<br>
                                    <button type="button" class="btn btn-block btn-lg btn-info">PAY</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
                <!-- Right sidebar -->
            </div>
            <!-- End Container fluid  -->
            <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Add New Customer</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="" method="post">
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Name</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" value="" name="" id="cus_name" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                            <div class="form-group m-l-10 m-r-10 row">
                                <label for="example-search-input" class="col-2 col-form-label nric">NRIC</label>
                                <div class="col-6 nric-danger">
                                    <input class="form-control form-control-danger" type="text" name="nric" id="nric" value="" autocomplete="off" data-mask="999999-99-9999" onkeyup="checkComplete()">
                                    <input class="form-control" type="text" name="passport" id="passport" value="" autocomplete="off" style="display: none">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check m-t-10">
                                        <input type="checkbox" name="ds_product_enable" id="basic_checkbox_2" class="filled-in" onchange="nric_chg()">
                                        <label for="basic_checkbox_2">Passport</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Birthday</label>
                                <div class="col-4">
                                    <input class="form-control" type="text" value="" name="" id="birthday_id" autocomplete="off" data-mask="9999-99-99">
                                    <small class="font-13 text-muted">YYYY-MM-DD</small>
                                </div>
                                <label for="example-text-input" class="col-2 col-form-label text-right">Gender&nbsp; </label>
                                <div class="col-md-4 m-t-5">
                                    <div class="radio-list">
                                        <label class="custom-control custom-radio">
                                            <input id="radio1" name="radio" type="radio" value="1" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Male</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                            <input id="radio2" name="radio" type="radio" value="0" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-t-20 m-l-10 m-r-10 row">
                                <label for="example-text-input" class="col-2 col-form-label">Birthplace</label>
                                <div class="col-6">
                                    <input class="form-control" type="text" value="" name="" id="birth_place" autocomplete="off" style="text-transform:uppercase">
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
                        <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-inverse waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
            <!-- footer -->
            <?php $this->load->view('includes/footer')?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <?php $this->load->view('includes/jsFooter')?>
    <script src="<?php echo base_url()?>assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/minimal/js/mask.js')?>"></script>
    <script type="text/javascript">
        $(".select2").select2();
        /*
        $(":text").focus(function () {
            var input = this;
            setTimeout(function() {
                input.setSelectionRange(0, 0);
            }, 0);
            //$(this).select();
        });*/
        /*
        $("input[type='text']").click(function () {
           $(this).select();
        });*/
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
            //$("#qty_display").attr('id',"qty_display_"+running_number);
            $("#div_"+running_number+" .qtyDisplay").attr("id","qtyDisplay_"+running_number);
            $("#div_"+running_number+" .qtyInput").attr("id","qtyInput_"+running_number);
            $("#div_"+running_number+" .priceInput").attr("id","priceInput_"+running_number);
            $("#div_"+running_number+" .amtInput").attr("id","amtInput_"+running_number);

            var subAmt = $("input[name='pname[]']")
              .map(function(){return $(this).val();}).get();
            console.log(subAmt);
        }
        function singleUpdate(para){
            var running = para.id.split('_');
            running = running[1];
            var totalPrice = parseFloat($("#qtyInput_"+running).val()) * parseFloat($("#priceInput_"+running).val());


            $("#qtyDisplay_"+running).html($("#qtyInput_"+running).val());
            $("#div_"+running+" .priceDisplay").html("RM "+totalPrice);
            $("#amtInput_"+running).val(totalPrice);
            //console.log();
            //console.log();
        }

        function checkCustomer(){
            //alert('666');
            if($("#customer_select").val()==0){
                $('#myModal').modal('toggle');
            }
        }
        function checkComplete(){
            //alert('1');
            //console.log($("#nric").val().substring(13, 14));
            if($("#nric").val().substring(13, 14) >= 0){
                nricAuto();
            }
        }
        function nric_chg(){

            if($("#basic_checkbox_2").is(':checked')){
                $("#passport").show();
                $("#nric").hide();
                //alert('1');
                $(".nric").html('Passport');
                //$("#nric").attr("name","passport");
                //$("#nric").attr("data-mask","");
                //data-mask="999999-99-9999"
            }else{
                $("#passport").hide();
                $("#nric").show();
                $(".nric").html('NRIC');
                //$("#nric").attr("name","nric");
                //$("#nric").attr("data-mask","999999-99-9999");
                //alert(9);
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
                $("input[name=radio][value=0]").attr('checked', 'checked');

            }else{
                $("input[name=radio][value=1]").attr('checked', 'checked');
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
                    alert(data.mod_clients_fullname+'-'+$('#nric').val()+' is EXISTED!')
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
    </script>
</body>
</html>