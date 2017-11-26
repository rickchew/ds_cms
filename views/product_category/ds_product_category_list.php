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
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Category List</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('products')?>">Product</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><!--Responsive Table --></h4>
                                <h6 class="card-subtitle"><!--Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive </code>--></h6>
                                <?php if($this->session->userdata('message')):?>
                                <div class="alert alert-success"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> </div>&nbsp;<br>&nbsp;<br>
                                <?php endif?>
                                <?php if($this->session->userdata('error_message')):?>
                                <div class="alert alert-danger"><?php echo $this->session->userdata('error_message') <> '' ? $this->session->userdata('error_message') : ''; ?> </div>&nbsp;<br>&nbsp;<br>
                                <?php endif?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo site_url('product_category/index'); ?>" class="form-inline" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" autocomplete="off" spellcheck="false">
                                                <span class="input-group-btn">
                                                    <?php 
                                                        if ($q <> '')
                                                        {
                                                            ?>
                                                            <a href="<?php echo site_url('product_category/'); ?>" class="btn btn-info"><i class="fa fa-close"></i></a>
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
                                        <?php echo anchor(site_url('product_category/create'),'<i class="mdi-library-plus mdi"></i> New Category', 'class="btn btn-success"'); ?>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="table-responsive">
                                    <table class="table table-hover success-bordered-table color-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Category Name</th>
                                                <th>Enable</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-weight: 400;">
                                            <?php //print_r($products_data)?>
                                            <?php foreach($product_category_data as $product_category):?>
                                            <tr>
                                                <td width="80px"><?php echo ++$start ?></td>
                                                <td><?php echo $product_category->ds_product_category_name ?></td>
                                                <td><?php echo $product_category->ds_product_category_enable ? '':'<span class="badge badge-danger">DISABLED</span>' ?></td>
                                                <td style="text-align:center" width="200px">
                                                    <div class="btn-group">
                                                      <?php
                                                      echo anchor(site_url('product_category/read/'.$product_category->ds_product_category_id),'<i class="mdi mdi-eye text-inverse m-r-10"></i>','data-toggle="tooltip"');
                                                      echo anchor(site_url('product_category/update/'.$product_category->ds_product_category_id),' <i class="mdi mdi-lead-pencil text-inverse m-r-10"></i>','data-toggle="tooltip"'); 
                                                      echo anchor(site_url('product_category/delete/'.$product_category->ds_product_category_id),' <i class="mdi mdi-delete text-inverse m-r-10"></i>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                                      
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