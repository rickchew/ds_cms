<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
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
                    <h3 class="text-themecolor">Blank Page</h3>
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
                        <div class="card card-body printableArea">
                            <h3><b>TAX INVOICE</b> <span class="pull-right">#S20171234</span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-success">SKIN HOUSE BEAUTY SDN BHD</b> </h3>
                                            <p class="text-muted m-l-5">Skin House (Main Branch) GST ID : 000371052544


                                                <br> 118, Sutera Tanjung 8/3,
                                                <br> Taman Sutera Utama,
                                                <br> 81300 Skudai,Johor.</p>
                                        </address>
                                    </div>
                                    <div class="pull-right text-right">
                                        <address>
                                            <h3>To,</h3>
                                            <h4 class="font-bold"><?php echo $docs->mod_clients_fullname?></h4>
                                            <p class="text-muted m-l-30">&nbsp;<?php echo $docs->mod_clients_contact_1?></p>
                                            <p class="m-t-30"><!--<b>Invoice No :</b> <strong> <?php echo 'S20171234'?></strong><br>--><b>Invoice Date :</b> <strong> <?php echo $docs->pos_doc_date?></strong></p>
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
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Unit Price</th>
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
                                                    <td><?php echo $cv->ds_product_name?></td>
                                                    <td class="text-right"> <?php echo $cv->pos_doc_child_product_qty ?> </td>
                                                    <td class="text-right"> <?php echo $cv->ds_product_price ?> </td>
                                                    <td class="text-right"> <?php echo sprintf("%.02f",$cv->pos_doc_child_product_qty * $cv->ds_product_price) ?> </td>
                                                </tr>
                                            <?php endforeach?>
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
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
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
</body>
</html>