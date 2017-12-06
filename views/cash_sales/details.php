<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <style type="text/css">
    .print_bold{
        color:#000;
        font-weight: 400；
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
                    <h3 class="text-themecolor">Invoice</h3>
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
                    <div class="col-md-12">
                        <div class="card card-body">
                            <h3><b>TAX INVOICE</b> <span class="pull-right">#<?php echo $docs->pos_doc_inv_id?></span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-success">SKIN HOUSE BEAUTY SDN BHD</b> </h3>
                                            <p class="text-muted m-l-5">
                                            <span style="color: #000;font-weight: 400;">GST ID : 000371052544
                                            <br><?php echo $docs->ds_branch_name?>
                                            <br> <?php echo $docs->ds_branch_address?>
                                            <br> &nbsp;
                                            </span>
                                            </p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <!--<h3>To,</h3>-->
                                            <h4 class="font-bold"><?php echo $docs->mod_clients_fullname?></h4>
                                            <p class="text-muted m-l-30">&nbsp;<?php echo $docs->mod_clients_contact_1?></p>
                                            <p class="m-t-30"><b>Invoice Date :</b> <strong> <?php echo date('d-m-Y', strtotime($docs->pos_doc_date));?></strong></p>
                                            <p class="m-t-30"></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Description</th>
                                                    <?php if($docs->pos_doc_type_id != 8):?>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Price</th>
                                                    <?php endif?>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php //print_r($docs)?>
                                            <?php $i = 0?>
                                            <?php foreach($child as $cv):?>
                                            <?php $i++?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i?></td>
                                                    <td><?php echo $docs->pos_doc_type_id == 8 ? $cv->pos_doc_child_description:$cv->ds_product_name?></td>
                                                    <?php if($docs->pos_doc_type_id != 8):?>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_qty ?> </td>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_price ?> </td>
                                                    <?php endif?>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_total_price ?> </td>
                                                </tr>
                                            <?php endforeach?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $docs->pos_doc_note?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>Sub Total : RM <?php echo $docs->pos_doc_payment_wo_gst?></p>
                                        <p>GST (6%) : RM <?php echo $docs->pos_doc_payment_gst?> </p>
                                        <hr>
                                        <h3><b>Total :</b> RM <?php echo $docs->pos_doc_payment_total?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <!--<button class="btn btn-danger" type="submit"> Proceed to payment </button>-->
                                        <button id="print" class="btn btn-info btn-inverse btn-outline" type="button" onclick="printDiv('printableArea')"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  PRINT AREA  -->


                    <div class="col-md-12" style="display:none">
                        <div class="card card-body printableArea" id="printableArea" style="color:#000">
                            <h3><b>TAX INVOICE</b> <span class="pull-right" style="font-size: 30px;font-weight: 500;">#<?php echo $docs->pos_doc_inv_id?></span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12" style="font-family: "verdana";">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="align-bottom">SKIN HOUSE BEAUTY SDN BHD &nbsp; &nbsp;</b><img src="<?php echo base_url('assets/images/skinhouse_logo.png')?>" width="85px"></h3>
                                            <h4> &nbsp;(CO 1126896-D)</h4>

                                            <p class="text-muted m-l-5">
                                            <span style="color: #000;font-weight: 400;">GST ID : 000371052544
                                            <br><?php echo $docs->ds_branch_name?>
                                            <br> <?php echo $docs->ds_branch_address?>
                                            </span>
                                            </p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-left text-left">
                                        <address>
                                            <!--<h3>To,</h3>-->
                                            <h4 class="font-bold"><?php echo $docs->mod_clients_fullname?></h4>
                                            <p class="text-muted" style="color: #000;font-weight: 500;">&nbsp;<?php echo $docs->mod_clients_contact_1?></p>
                                            <p class="m-t-30"><b>Invoice Date :</b> <strong style="font-size: 20px;font-weight: 600;"> <?php echo date('d-m-Y', strtotime($docs->pos_doc_date));?></strong><br></p>
                                            <p class="m-t-30"></p>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr style="border-bottom: 2px dotted #000;">
                                                    <th class="text-center">#</th>
                                                    <th>Description</th>
                                                    <?php if($docs->pos_doc_type_id != 8):?>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Price</th>
                                                    <?php endif?>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php //print_r($docs)?>
                                            <?php $i = 0?>
                                            <?php foreach($child as $cv):?>
                                            <?php $i++?>
                                                <tr>
                                                    <td class="text-center" style="color: #000;font-weight: 500;"><?php echo $i?></td>
                                                    <td style="color: #000;font-weight: 500;"><?php echo $docs->pos_doc_type_id == 8 ? $cv->pos_doc_child_description:$cv->ds_product_name?></td>
                                                    <?php if($docs->pos_doc_type_id != 8):?>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_qty ?> </td>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_price ?> </td>
                                                    <?php endif?>
                                                    <td class="text-right" style="color: #000;font-weight: 500;"> <?php echo $cv->pos_doc_child_product_total_price ?> </td>
                                                </tr>
                                            <?php endforeach?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $docs->pos_doc_note?></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p style="color: #000;font-weight: 500;">Sub Total : RM <?php echo $docs->pos_doc_payment_wo_gst?></p>
                                        <p style="color: #000;font-weight: 500;">GST (6%) : RM <?php echo $docs->pos_doc_payment_gst?> </p>
                                        <hr>
                                        <h3><b style="color:#000">Total :</b> &nbsp; <span style="font-size: 30px;font-weight: 600;color: #000;">RM <?php echo $docs->pos_doc_payment_total?></span></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-center">
                                        <div>
                                        <p style="color: #000;font-weight: 500;">Goods sold are not refundable and exchangeable</p>
                                    </div>
                                        <!--<button class="btn btn-danger" type="submit"> Proceed to payment </button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        function printDiv(divName) {
             var printContents = $("#"+divName).html();
             var originalContents = document.body.innerHTML;

             //document.body.innerHTML = 
             document.body.innerHTML = printContents;

             window.print();

             document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>