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
                    <h3 class="text-themecolor">Product Attributes</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Product</li>
                        <li class="breadcrumb-item active">Product Attribute</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><!--Responsive Table --></h4>
                                <h6 class="card-subtitle"><!--Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive </code>--></h6>
                                <?php if($this->session->userdata('message')):?>
                                <div class="alert alert-success"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> </div>&nbsp;<br>&nbsp;<br>
                                <?php endif?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo site_url('products/index'); ?>" class="form-inline" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" autocomplete="off" spellcheck="false">
                                                <span class="input-group-btn">
                                                    <?php 
                                                        if ($q <> '')
                                                        {
                                                            ?>
                                                            <a href="<?php echo site_url('products/'); ?>" class="btn btn-info"><i class="fa fa-close"></i></a>
                                                            <?php
                                                        }
                                                    ?>
                                                  <button class="btn btn-success" type="submit">Search</button>
                                                </span>
                                            </div>
                                        </form>
                                        &nbsp;<br>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="pull-right">
                                        <!--
                                        <?php echo anchor(site_url('products/create'),'<i class="mdi-library-plus mdi"></i> New Product', 'class="btn btn-success"'); ?>
                                        -->
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="table-responsive">
                                    <table class="table table-hover success-bordered-table color-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Enable</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-weight: 400;">
                                            <?php //print_r($product_attribute_data)?>
                                            <?php foreach($product_attribute_data as $products):?>
                                            <tr>
                                                <td width="80px"><?php echo ++$start ?></td>
                                                <td><?php echo $products->ds_product_attribute_name ?></td>
                                                <td><?php echo $products->ds_product_attribute_enable ? '':'<span class="badge badge-danger">DISABLED</span>' ?></td>
                                                <td style="text-align:center" width="200px">
                                                    <div class="btn-group">
                                                      <?php
                                                      //echo anchor(site_url('products/read/'.$products->ds_product_attribute_id),'<i class="fa fa-search text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"');
                                                      echo anchor(site_url('product_attribute/update/'.$products->ds_product_attribute_id),' <i class="mdi mdi-settings text-inverse m-r-10"></i>','data-toggle="tooltip"'); 
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
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo $action; ?>" method="post">
                                    <div class="form-body">
                                        <h3 class="card-title">Attribute Info</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Attribute Name</label>
                                                    <input type="text" id="firstName" class="form-control" name="ds_product_attribute_name" id="ds_product_attribute_name" required="">
                                                    <!--<small class="form-control-feedback"> This is inline help </small> </div>-->
                                            </div>
                                        </div>
                                        <!--/row-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="checkbox" name="ds_product_enable" id="basic_checkbox_2" class="filled-in" name="ds_product_attribute_enable" id="ds_product_attribute_enable">
                                                <label for="basic_checkbox_2">Enabled</label>
                                                    <!--<small class="form-control-feedback"> This is inline help </small> </div>-->
                                                </div>
                                            </div>  
                                        </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add Attribute</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
                <!-- Right sidebar -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme working">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url()?>/assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
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
</body>
</html>