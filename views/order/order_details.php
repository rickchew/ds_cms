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
 .tooltip {
    font-family:'microsoft yahei;
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
                                    <?php if($docs->pos_doc_order_saved == 1):?> <!-- IF ORDER SAVED-->
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Add Invoice</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages2" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">History</span></a> </li>
                                    <?php endif?>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home2" role="tabpanel" aria-expanded="true">
                                        <?php //print_r($this->input->post())?>
                                        <form action="<?php echo site_url('order/order_update/'.$docs->pos_doc_id)?>" method="post">
                                        <div class="p-20">
                                            <table class="table table-hover success-bordered-table color-bordered-table" style="font-weight: 500">
                                            <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th width="10%" class="text-right">Qty</th>
                                                <th width="10%" class="text-right">Price</th>
                                                <th width="10%" class="text-right">PV</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($child as $val):?>
                                            <?php if($docs->pos_doc_order_saved == 1):?>
                                            <?php $product_bal = (int)$val->pos_doc_child_product_qty-(int)$val->pos_doc_child_product_taken?>
                                            <!-- IF ORDER SAVED -->
                                                <tr>
                                                    <td><?php echo $val->ds_product_name?> &nbsp;[<?php echo $product_bal.'/'.(int)$val->pos_doc_child_product_qty?>]</td>
                                                    <td class="text-right"><?php echo $val->pos_doc_child_product_qty?></td>
                                                    <td class="text-right">
                                                        <?php echo $val->pos_doc_child_product_total_price?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $val->pos_doc_child_pv_used?>
                                                        <input type="hidden" name="proPV[]" value="<?php echo $val->pos_doc_child_pv_used?>">
                                                    </td>
                                                </tr>
                                            <?php else:?>
                                            <!-- NEW ORDER -->
                                                <tr>
                                                    <td><?php echo $val->ds_product_name?></td>
                                                    <td class="text-right">
                                                        <input type="hidden" value="<?php echo $val->pos_doc_child_id?>" name="childId[]">
                                                        <input type="hidden" value="<?php echo $val->pos_doc_child_product_qty?>" name="childQty[]">
                                                        <?php echo $val->pos_doc_child_product_qty?>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="text" class="form-control text-right" name="proPirce[]" value="<?php echo $val->ds_product_price * $val->pos_doc_child_product_qty ?>" onkeyup="updateOrdBal();" autocomplete="off">
                                                    </td>
                                                    <td><input type="text" class="form-control text-right" name="proPV[]" onkeyup="updateOrdBal();" value="0" autocomplete="off"></td>
                                                </tr>
                                            <?php endif?>


                                            <?php endforeach?>

                                            </tbody>
                                            <input type="hidden" value="<?php echo $docs->pos_doc_quote_price?>" id="quotePrice">
                                            <input type="hidden" value="<?php echo $docs->pos_doc_pv_given?>" id="pos_doc_pv_given">
                                        </table>
                                            <?php if($docs->pos_doc_order_saved != 1):?>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <?php endif?>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane p-20" id="profile2" role="tabpanel" aria-expanded="false">
                                        <div class="row">
                                        <div class="col-7">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="list-group col-12">
                                                    <?php foreach($child as $val):?>
                                                        <?php $product_bal = (int)$val->pos_doc_child_product_qty-(int)$val->pos_doc_child_product_taken?>
                                                        <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start" onclick="addCart(<?php echo $val->ds_product_id?>);">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1"><?php echo $val->ds_product_name.' X '.(int)$val->pos_doc_child_product_qty?></h5>
                                                                <span style="color:#000;font-weight: 400;">RM <?php echo $val->pos_doc_child_product_total_price?></span>
                                                            </div>
                                                            <p class="mb-1">&nbsp; &nbsp; &nbsp; </p>
                                                            <div>
                                                                Product Balance: &nbsp;<?php echo $product_bal.' / '.(int)$val->pos_doc_child_product_qty?><br>
                                                                Amount Balance: &nbsp;<?php echo ' / '.$val->pos_doc_child_product_total_price?>
                                                            </div>
                                                        </a>
                                                        <!--TEMPLATES-->
                                                        <div style="display: none">
                                                            <div id="pro_<?php echo $val->ds_product_id?>" class="card product_well" style="margin-bottom: 0px">
                                                                <div class="card-header" role="tab" id="heading<?php echo $val->ds_product_id?>">
                                                                <h5 class="mb-0">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#coll_attr" aria-expanded="false" aria-controls="coll_attr">
                                                                <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1"><span class="qtyDisplay">1</span>&nbsp;x&nbsp;<?php echo $val->ds_product_name?></h5>
                                                                <span class="priceDisplay">RM&nbsp;<?php echo $val->pos_doc_child_product_price?></span>
                                                                </div>

                                                            <small class="text-muted"><a href="javascript:void(0)" class="delBtn">remove</a></small>
                                                                </a>
                                                              </h5> 
                                                              </div>
                                                            
                                                            <div id="coll_attr" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Quantity</label>
                                                                                <input type="hidden" class="productID" value="<?php echo $val->ds_product_id?>">
                                                                                <input type="number" class="form-control qtyInput" onkeyup="singleUpdate(this,null)" min="1" onchange="singleUpdate(this,null)"
                                                                                 value="1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Price</label>
                                                                                <input type="hidden" class="form-control amtInput" value="<?php echo $val->ds_product_price?>">
                                                                                <input type="number" class="form-control priceInput" onkeyup="singleUpdate(this,null)" onchange="singleUpdate(this,null)" value="<?php echo $val->pos_doc_child_product_price?>">
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
                                                    <?php endforeach?>
                                                    </div>
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
                                                            <input type="hidden" id="membersID" name="membersID" value="<?php echo $docs->mod_clients_id?>">
                                                            <input type="hidden" id="hiddenMethod" name="hiddenMethod" value="">
                                                            <input type="hidden" id="hiddenOrder" name="hiddenOrder" value="">
                                                            <input type="hidden" id="orderID" name="orderID" value="<?php echo $docs->pos_doc_id?>">
                                                            <input type="hidden" id="paymentAmt" name="paymentAmt">
                                                            <input type="hidden" id="paymentGst" name="paymentGst">
                                                            <input type="hidden" id="paymentTotal" name="paymentTotal">
                                                            <input type="hidden" id="docType" name="docType" value="1">
                                                            <input type="hidden" name="docDate" value="<?php echo date('Y-m-d')?>">
                                                            <input type="hidden" value="<?php echo $this->session->userdata('outlet_id')?>" name="outletID">

                                                            <!-- HIDDEN SUBMIT-->
                                                        </div>
                                                        <div class="col-12">
                                                        &nbsp;<br>
                                                        <button type="button" class="btn btn-block btn-lg btn-info" data-toggle="modal" data-target="#paymentModal">PAY</button>
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
                                    <div class="tab-pane p-20" id="messages2" role="tabpanel" aria-expanded="false">
                                        <?php //print_r($inv)?>
                                        <table class="table table-hover success-bordered-table color-bordered-table" style="font-weight: 500">
                                            <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Invoice</th>
                                                <th>Date</th>
                                                <th class="text-right">Total Amount</th>
                                                <th class="text-right">Amount Paid</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $start=0?>
                                            <?php foreach($inv as $invVal):?>
                                            <tr>
                                                <td><?php echo ++$start?></td>
                                                <td><?php echo $invVal->pos_doc_inv_id?></td>
                                                <td><?php echo $invVal->pos_doc_date?></td>
                                                <td class="text-right"><?php echo $invVal->pos_doc_payment_wo_gst?></td>
                                                <td class="text-right"><?php echo $invVal->pos_doc_payment_total?></td>
                                                <td class="text-center"><?php echo anchor(site_url('cash_sales/details/'.$invVal->pos_doc_id),'<i class="fa fa-search text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"');?></td>
                                            </tr>
                                            <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="p-b-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="myBtn" class="text-right" style="" data-toggle="tooltip" data-placement="left" title="" data-original-title="提交前请确定 Amount Balance为0 否则剩下的Balance没有commision">
                    Order Amount :&nbsp; &nbsp;<span><?php echo $docs->pos_doc_quote_price?></span><br>
                    Amount Balance :&nbsp; &nbsp;<span id="orderBalDisplay"><?php echo $docs->pos_doc_quote_price?></span><br>
                    PV Balance :&nbsp; &nbsp;<span id="pvBalDisplay"><?php echo $docs->pos_doc_pv_given?></span><br>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <div id="paymentModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Payment Method</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form id="methodFormID">
                    <div class="col-md-12">
                        <div id="accordion9" role="tablist">

                        <!--***********************

                                    CASH

                        **************************-->
                          <div class="card" style="margin-bottom: 0px">
                            <div class="card-header" role="tab" id="headingOne">
                              <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse001" aria-expanded="true" aria-controls="collapse001">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><span >1. CASH</span></h5>
                                        <span class="priceDisplay" id="methodCashDisplay">RM 0.00</span>
                                    </div>

                                    <!--<small class="text-muted">Donec id elit non mi porta</small>-->
                                </a>
                              </h5>
                            </div>
                            <div id="collapse001" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion9">
                              <div class="card-body">
                                <div class="form-group row m-b-0">

                                    <!--<label class="control-label text-right col-md-9 form-control" style="border:0px">Cash</label>-->
                                    <label class="col-md-8">&nbsp;</label>
                                    <div class="input-group col-md-4 pull-right">
                                        <div class="input-group-addon">RM</div>
                                        <input type="hidden" name="methodID[]" value="1">
                                        <input type="hidden" name="methodRemark[]">
                                        <input type="number" id="methodCash" class="form-control text-right" onkeyup="methodUpdate()" onchange="methodUpdate()" name="methodAmt[]">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!--***********************

                                    CARD

                        **************************-->



                          <div class="card" style="margin-bottom: 0px">
                            <div class="card-header" role="tab" id="headingTwo">
                              <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse002" aria-expanded="true" aria-controls="collapse002">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><span >2. CREDIT / DEBIT CARD</span></h5>
                                        <span class="priceDisplay" id="methodCardDisplay">RM 0.00</span>
                                    </div>

                                    <!--<small class="text-muted">Donec id elit non mi porta</small>-->
                                </a>
                              </h5>
                            </div>
                            <div id="collapse002" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion9">
                              <div class="card-body">
                                <div class="form-group row m-b-0">

                                    <!--<label class="control-label text-right col-md-9 form-control" style="border:0px">Cash</label>-->
                                    <div class="input-group col-md-8">
                                        <input type="hidden" name="methodID[]" value="2">
                                        <input type="text" class="form-control" placeholder="Remarks" name="methodRemark[]">
                                    </div>

                                    <div class="input-group col-md-4 pull-right">
                                        <div class="input-group-addon">RM</div>
                                        <input type="number" id="methodCard" class="form-control text-right" onkeyup="methodUpdate()" onchange="methodUpdate()" name="methodAmt[]">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--***********************

                                    INTERNET BANKING

                        **************************-->
                          <div class="card" style="margin-bottom: 0px">
                            <div class="card-header" role="tab" id="headingThree">
                              <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse003" aria-expanded="true" aria-controls="collapse003">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><span >3. INTERNET BANKING</span></h5>
                                        <span class="priceDisplay" id="methodOnlineDisplay">RM 0.00</span>
                                    </div>

                                    <!--<small class="text-muted">Donec id elit non mi porta</small>-->
                                </a>
                              </h5>
                            </div>
                            <div id="collapse003" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion9">
                              <div class="card-body">
                                <div class="form-group row m-b-0">
                                    <!--<label class="control-label text-right col-md-9 form-control" style="border:0px">Cash</label>-->
                                    <div class="input-group col-md-8">
                                        <input type="hidden" name="methodID[]" value="3">
                                        <input type="text" class="form-control" placeholder="Remarks" name="methodRemark[]">
                                    </div>

                                    <div class="input-group col-md-4 pull-right">
                                        <div class="input-group-addon">RM</div>
                                        <input type="number" id="methodOnline" class="form-control text-right" onkeyup="methodUpdate()" onchange="methodUpdate()" name="methodAmt[]">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--***********************

                                    Voucher

                        **************************-->
                          <div class="card" style="margin-bottom: 0px">
                            <div class="card-header" role="tab" id="headingThree">
                              <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse004" aria-expanded="true" aria-controls="collapse004">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><span >4. PRODUCT VOUCHER</span></h5>
                                        <span class="priceDisplay" id="methodVoucherDisplay">RM 0.00</span>
                                    </div>

                                    <!--<small class="text-muted">Donec id elit non mi porta</small>-->
                                </a>
                              </h5>
                            </div>
                            <div id="collapse004" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion9">
                              <div class="card-body">
                                <div class="form-group row m-b-0">

                                    <!--<label class="control-label text-right col-md-9 form-control" style="border:0px">Cash</label>-->
                                    <div class="input-group col-md-8">
                                    <input type="hidden" name="methodID[]" value="4">
                                        <input type="text" class="form-control" placeholder="Remarks" name="methodRemark[]">
                                    </div>

                                    <div class="input-group col-md-4 pull-right">
                                        <div class="input-group-addon">RM</div>
                                        <input type="number" id="methodVoucher" class="form-control text-right" onkeyup="methodUpdate()" onchange="methodUpdate()" name="methodAmt[]">
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    </form>
                    <div class="col-md-12">
                        &nbsp;<br>&nbsp;<br>
                        <div>
                            <strong>Customer Changes </strong>
                            <span class="pull-right" style="font-weight: 500;font-size: 25px" id="outStandingDisplay">RM 0.00</span> 
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="methodFormBtn" onclick="generateInv();">Generate Invoice</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script type="text/javascript">
        updateOrdBal();
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

            //console.log(running);

        }
        function generateInv(){
            //console.log(JSON.stringify($("#methodFormID").serializeArray()));
            $("#hiddenMethod").val(JSON.stringify($("#methodFormID").serializeArray()));
            $("#cashierForm").submit();
        }
        function addCart(pro_id){
            console.log(pro_id);
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
            methodUpdate();
            
        }
        function updateOrdBal(){
            var proPriceSum = $("input[name='proPirce[]'").map(function(){return $(this).val();}).get();
            var proPVSum = $("input[name='proPV[]'").map(function(){return $(this).val();}).get();
            var eval_proPriceSum = eval(proPriceSum.join("+"));
            var eval_proPVSum = eval(proPVSum.join("+"));

            var orderBal = $("#quotePrice").val() - eval_proPriceSum;
            var pvBal = $("#pos_doc_pv_given").val() - eval_proPVSum;

            $("#orderBalDisplay").html(orderBal);
            $("#pvBalDisplay").html(pvBal);


            if(pvBal<0){
                alert('PV Invalid');
            }
            if(orderBal<0){
                alert('Order Balance Invalid')
            }
            //console.log();
            
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