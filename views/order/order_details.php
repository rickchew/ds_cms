<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <link href="<?php echo base_url('assets/minimal/')?>css/pages/tab-page.css" rel="stylesheet">
    <style type="text/css">
    #myBtn {
  /*display: none;*/
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background:rgba(0,0,0,0.5);
  color: white;
  cursor: pointer;
  padding: 7px;
  border-radius: 10px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
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
                    <h3 class="text-themecolor">Order Details</h3>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Order Info</h3>
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Member's Name</label>
                                            <input type="text" id="firstName" class="form-control" value="<?php echo $docs->mod_clients_fullname?>" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Home</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Add Invoice</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">History</span></a> </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home2" role="tabpanel" aria-expanded="true">
                                        <div class="p-20">
                                            <table class="table table-hover success-bordered-table color-bordered-table" style="font-weight: 500">
                                            <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th width="10%">Qty</th>
                                                <th width="10%">Price</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($child as $val):?>
                                            <tr>
                                                <td><?php echo $val->ds_product_name?></td>
                                                <td><?php echo $val->pos_doc_child_product_qty?></td>
                                                <td><input type="text" class="form-control" name="proPirce[]" value="<?php echo $val->ds_product_price * $val->pos_doc_child_product_qty ?>" onkeyup="updateOrdBal();"></td>
                                                <td><input type="text" class="form-control" value=""></td>
                                            </tr>
                                            <?php endforeach?>
                                            </tbody>
                                            <input type="hidden" value="<?php echo $docs->pos_doc_quote_price?>" id="quotePrice">
                                        </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-20" id="profile2" role="tabpanel" aria-expanded="false">
                                        <div class="row">
                                        <div class="col-7">
                                            <div class="col-12">
                                                <div class="row">
                                                    <?php foreach($child as $val):?>
                                                    <div class="col-lg-3">
                                                        <a href="javascript:void(0)" onclick='addCart(<?php echo $val->ds_product_id?>);'>
                                                        <div class="card card-body card-body-shadow" style="color:#333">
                                                            <div class=""><strong><?php echo $val->ds_product_name?></strong></div>

                                                        </div>
                                                        </a>

                                                        <!--TEMPLATES-->
                                                        <div style="display: none">
                                                            <div id="pro_26" class="card product_well" style="margin-bottom: 0px">
                                                                <div class="card-header" role="tab" id="heading26">
                                                                    <h5 class="mb-0">

                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#coll_attr" aria-expanded="false" aria-controls="coll_attr">
                                                                  <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1"><span class="qtyDisplay">1</span>&nbsp;x&nbsp;Aromatherapy Facial</h5>
                                                                <span class="priceDisplay">RM&nbsp;0.00</span>
                                                            </div>

                                                            <small class="text-muted"></small></a><small class="text-muted"><a href="javascript:void(0)" class="delBtn">remove</a></small>
                                                                
                                                              </h5> </div>
                                                                <div id="coll_attr" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                                    <div class="card-body" style="box-shadow: 2px 2px 15px 0px rgba(0,0,0,0.1),0 1px 2px 0 rgba(0,0,0,0.1) !important">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Quantity</label>
                                                                                    <input type="hidden" class="productID" value="26">
                                                                                    <input type="number" class="form-control qtyInput" onkeyup="singleUpdate(this,null)" min="1" onchange="singleUpdate(this,null)" value="1">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Price</label>
                                                                                    <input type="hidden" class="form-control amtInput" value="0.00">
                                                                                    <input type="number" class="form-control priceInput" onkeyup="singleUpdate(this,null)" onchange="singleUpdate(this,null)" value="0.00">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label">Taken</label>
                                                                                    <input type="number" class="form-control takenInput" value="" min="0">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <form id="cashierForm" action="<?php echo site_url('cash_sales/create_action')?>" method="post">
                                            <div class="card">
                                                
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="list-group col-12" style="padding-left: 16px;">
                                                            <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                                <div class="product_well" style="display: none">
                                                                </div>
                                                            </div>
                                                            &nbsp;<br>
                                                        </div>
                                                        <div class="list-group col-12" style="padding-left: 16px;">
                                                            <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                                <div class="product_well" style="display: none">
                                                                </div><div id="div_1512263311066" class="card product_well" style="margin-bottom: 0px">
                                                            <div class="card-header" role="tab" id="heading23">
                                                                <h5 class="mb-0">

                                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_1512263311066" aria-expanded="false" aria-controls="collapse_1512263311066">
                                                              <div class="d-flex w-100 justify-content-between">
                                                            <h5 class="mb-1"><span class="qtyDisplay" id="qtyDisplay_1512263311066">1</span>&nbsp;x&nbsp;CBC Treatment</h5>
                                                            <span class="priceDisplay">RM 0</span>
                                                        </div>

                                                        <small class="text-muted"></small></a><small class="text-muted"><a href="#collapse_1512263311066" class="delBtn" aria-controls="collapse_1512263311066" onclick="$('#div_1512263311066').remove();singleUpdate(null)">remove</a></small>
                                                            
                                                          </h5> </div>
                                                            <div id="collapse_1512263311066" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Quantity</label>
                                                                                <input type="hidden" class="productID" value="23" name="productID[]">
                                                                                <input type="number" class="form-control qtyInput" onkeyup="singleUpdate(this,null)" min="1" onchange="singleUpdate(this,null)" value="1" id="qtyInput_1512263311066" name="subItem[]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Price</label>
                                                                                <input type="hidden" class="form-control amtInput" value="0" id="amtInput_1512263311066" name="subAmt[]">
                                                                                <input type="number" class="form-control priceInput" onkeyup="singleUpdate(this,null)" onchange="singleUpdate(this,null)" value="0.00" id="priceInput_1512263311066" name="subPrice[]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Taken</label>
                                                                                <input type="number" class="form-control takenInput" value="" min="0" id="takenInput_1512263311066" name="subTaken[]" max="1">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            </div>
                                                            &nbsp;<br>
                                                        </div>
                                                        <div class="col-12">
                                                            <!--<input id="lastRandom" type="text">-->
                                                            
                                                            <a href="javascript:void(0)" onclick="$('#salesNoteID').show();(this).hide()"><small>Add Sales Note</small></a>
                                                            <div style="display: none" id="salesNoteID">
                                                            <hr>
                                                            <textarea class="form-control" placeholder="Add Sales Note" name="salesNote" rows="6"></textarea>
                                                            </div>
                                                            <hr>
                                                            <div>Sub-total <span class="pull-right" style="font-weight: 500" id="subtotalDisplay">RM 0.00</span></div>
                                                            <div>Discount <span class="pull-right" style="font-weight: 500">- RM 0.00</span></div>
                                                            <div>GST 6% <span class="pull-right" style="font-weight: 500" id="gstDisplay">RM 0.00</span></div>
                                                            <hr>
                                                            <div>Total <span class="pull-right" style="font-weight: 500;font-size: 25px" id="totalAmtDisplay">RM 0.00</span> <small>(<span id="totalItemDisplay">0</span> Items)</small></div>


                                                            <!-- HIDDEN SUBMIT-->
                                                            <input type="hidden" id="hiddenMethod" name="hiddenMethod" value="">
                                                            <input type="hidden" id="hiddenOrder" name="hiddenOrder" value="">
                                                            <input type="hidden" id="paymentAmt" name="paymentAmt">
                                                            <input type="hidden" id="paymentGst" name="paymentGst">
                                                            <input type="hidden" id="paymentTotal" name="paymentTotal">
                                                            <input type="hidden" id="docType" name="docType">
                                                            <input type="hidden" name="docDate" value="<?php echo date('Y-m-d')?>">
                                                            <input type="hidden" value="<?php echo $this->session->userdata('outlet_id')?>" name="outletID">

                                                            <!-- HIDDEN SUBMIT-->
                                                        </div>
                                                        <div class="col-12">
                                                        &nbsp;<br>
                                                        <button type="button" class="btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#paymentModal" onclick="changeDocType(1)">PAY</button>
                                                        <!--
                                                        <button type="button" class="btn btn-block btn-lg btn-success" data-toggle="modal" data-target="#generateOrder" onclick="changeDocType(2)">GENERATE ORDER</button>
                                                        <button type="button" class="btn btn-block btn-lg btn-default">HOLD BILL</button>-->
                                                        </div>
                                                        <!--</form>-->
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-20" id="messages2" role="tabpanel" aria-expanded="false">3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="myBtn" class="text-right">
                    Order Amount :&nbsp; &nbsp;<span><?php echo $docs->pos_doc_quote_price?></span><br>
                    Amount Balance :&nbsp; &nbsp;<span id="orderBalDisplay"><?php echo $docs->pos_doc_quote_price?></span><br>
                    PV BAL :&nbsp; &nbsp;<span id="pvBalDisplay"><?php echo $docs->pos_doc_pv_given?></span><br>
                </div>
                <!-- End PAge Content -->
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
    <script type="text/javascript">
        updateOrdBal();
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
            //singleUpdate(null,running_number);
            //methodUpdate();
            
        }
        function updateOrdBal(){
            var proPriceSum = $("input[name='proPirce[]'").map(function(){return $(this).val();}).get();
            var eval_proPriceSum = eval(proPriceSum.join("+"));

            var orderBal = $("#quotePrice").val() - eval_proPriceSum;

            $("#orderBalDisplay").html(orderBal);
            console.log(orderBal);
            
        }



        //window.onscroll = function() {scrollFunction()};
        /*
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }*/


    </script>
</body>
</html>