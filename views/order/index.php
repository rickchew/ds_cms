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
                    <h3 class="text-themecolor">Order</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if($this->session->userdata('message')):?>
                                <div class="alert alert-success"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> </div>&nbsp;<br>&nbsp;<br>
                                <?php endif?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="<?php echo site_url('order/index'); ?>" class="form-inline" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" spellcheck="false" autocomplete="off">

                                                <span class="input-group-btn">
                                                   <?php if ($q <> ''):?>
                                                    <a href="<?php echo site_url('order'); ?>" class="btn btn-info">Reset</a>
                                                    <?php endif?>
                                                  <button class="btn btn-success" type="submit">Search</button>
                                                </span>
                                            </div>
                                            &nbsp; &nbsp; &nbsp; <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-success">
                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> ALL
                                            </label>
                                            <?php foreach($branch_list as $branch):?>
                                            <label class="btn btn-success">
                                                <input type="radio" name="options" autocomplete="off" value="<?php echo $branch->ds_branch_id?>"> <?php echo $branch->ds_branch_name?>
                                            </label>
                                            <?php endforeach?>
                                            </div>
                                        </form>

                                        &nbsp;<br>

                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="pull-right">
                                        <?php //print_r($branch_list)?>
                                            
                                        <?php if($this->session->userdata('outlet_id')):?>
                                        <?php //echo anchor(site_url('package_sales'),'<i class="mdi-library-plus mdi"></i> New Order', 'class="btn btn-success"'); ?>&nbsp;
                                        <?php echo anchor(site_url('order/manual_invoice'),'<i class="mdi-library-plus mdi"></i> &nbsp;Manual Invoice', 'class="btn btn-success"'); ?>&nbsp;
                                        <?php echo anchor(site_url('cash_sales'),'<i class="mdi-library-plus mdi"></i> &nbsp;Add Sales', 'class="btn btn-success"'); ?>
                                        <?php endif?>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover success-bordered-table color-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>TYPE</th>
                                                <th>Invoice No</th>
                                                <th>Members Name</th>
                                                <th>Date</th>
                                                <th>Branch</th>
                                                <th class="text-right">Total Amount</th>
                                                <th class="text-right">Amount Paid</th>
                                                <th class="text-right">Order Amount</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-weight: 400;">
                                            <?php //print_r($doc_data)?>
                                            <?php foreach ($doc_data as $doc):?>
                                            <tr>
                                                <td width="80px"><?php echo ++$start ?></td>
                                                <td><?php echo $doc->pos_doc_type_name ?></td>
                                                <td><?php echo $doc->pos_doc_inv_id?></td>
                                                <td><?php echo $doc->mod_clients_fullname ?></td>
                                                <td><?php echo $doc->pos_doc_date ?></td>
                                                <td><?php echo $doc->ds_branch_name ?></td>
                                                <td class="text-right"><?php echo $doc->pos_doc_is_cancel ? "":$doc->pos_doc_payment_wo_gst ?></td>
                                                <td class="text-right"><?php echo $doc->pos_doc_is_cancel ? "<span class='badge badge-danger text-center'>CANCELLED</span>":$doc->pos_doc_payment_total ?></td>
                                                <td class="text-right"><?php echo $doc->pos_doc_quote_price ?></td>
                                                <td style="text-align:center" width="200px">
                                                    <div class="btn-group">
                                                    <?php
                                                    if($doc->pos_doc_type_id==2){
                                                        
                                                        echo anchor(site_url('order/order_details/'.$doc->pos_doc_id),'<i class="fa fa-search text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"');
                                                    }else{
                                                        echo anchor(site_url('cash_sales/details/'.$doc->pos_doc_id),'<i class="fa fa-search text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"');
                                                    }
                                                      
                                                      echo $doc->pos_doc_date >= date('Y-m-d') ? anchor(site_url('cash_sales/cancel/'.$doc->pos_doc_id),'<i class="mdi mdi-content-cut text-inverse m-r-10"></i>&nbsp;','onclick="javasciprt: return confirm(\'Cancel , Are You Sure ?\')"') : ''; 
                                                      //echo $doc->pos_doc_date >= date('Y-m-d') ? anchor(site_url('cash_sales/cancel/'.$doc->pos_doc_id),'<i class="mdi mdi-content-cut text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'):'';
                                                      //echo $doc->pos_doc_inv_id == 1 ? '':anchor(site_url('doc/update/'.$doc->pos_doc_id),' <i class="fa fa-pencil text-inverse m-r-10"></i>','data-toggle="tooltip"'); 
                                                      
                                                      ?> 
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>

                                </div>
                                &nbsp;<br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-success">Total Record : <?php echo $total_rows ?></a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="pull-right">
                                            <?php echo $pagination ?>
                                        </div>
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