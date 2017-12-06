<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <link href="<?php echo base_url('assets/minimal/')?>css/pages/floating-label.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/multiselect/css/multi-select.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('')?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('')?>assets/minimal/css/pages/tab-page.css" rel="stylesheet">
    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
          background: #398bf7;
          color: #ffffff;
          border-color: #398bf7; }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            float: right;
            color: #ffffff;
            margin-right: 0px;
            margin-left: 4px;}
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
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Bread crumb and right sidebar toggle -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Product Info</h3>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('products')?>">Product</a></li>
                            <li class="breadcrumb-item active">Form</li>
                        </ol>
                    </div>
                </div>
            <!-- End Bread crumb and right sidebar toggle -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body" style="min-height: 600px;">
                                <h4 class="card-title">Product Data</h4>
                                <h6 class="card-subtitle">Use default tab with class <code>vtabs, tabs-vertical & customvtab</code></h6>
                                <!-- Nav tabs -->
                                <div class="vtabs customvtab">
                                    <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" data-target="#home3" data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">General</span> </a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="javascript:void(0)" data-target="#profile3" data-toggle="tab" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Attributes</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Variations</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content col-12">
                                        <div class="tab-pane active" id="home3" role="tabpanel">
                                            <div class="p-20">
                                                <h3>Best Clean Tab ever</h3>
                                                <h4>you can use it with the small code</h4>
                                                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="profile3" role="tabpanel">
                                            <div class="embed-responsive embed-responsive-16by9">
                                            <iframe src="<?php echo site_url('product_attribute/product_attribute_frame/1')?>" style="position:absolute;"></iframe>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="messages3" role="tabpanel">
                                            <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                <div id="div_1512461937574" class="card product_well" style="margin-bottom: 0px">
                                                    <div class="card-header" role="tab" id="heading48">
                                                        
                                                      <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">
                                                        <select class="form-control">
                                                            <option></option>
                                                        </select>
                                                        <select class="form-control">
                                                            <option></option>
                                                        </select>
                                                        <span class="qtyDisplay" id="qtyDisplay_1512461937574">1</span>&nbsp;x&nbsp;
                                                        
                                                    </h5>
                                                    
                                                    <a class="collapsed btn btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapse_1512461937574" aria-expanded="false" aria-controls="collapse_1512461937574"><i class="mdi mdi-view-sequential"></i></a>
                                                </div>

                                                <small class="text-muted"></small>
                                                    
                                                  </div>
                                                    <div id="collapse_1512461937574" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Quantity</label>
                                                                        <input type="hidden" class="productID" value="48" name="productID[]">
                                                                        <input type="number" class="form-control qtyInput" onkeyup="singleUpdate(this,null)" min="1" onchange="singleUpdate(this,null)" value="1" id="qtyInput_1512461937574" name="subItem[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Price</label>
                                                                        <input type="hidden" class="form-control amtInput" value="0" id="amtInput_1512461937574" name="subAmt[]">
                                                                        <input type="number" class="form-control priceInput" value="0.00" id="priceInput_1512461937574" name="subPrice[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Taken</label>
                                                                        <input type="number" class="form-control takenInput" value="" min="0" id="takenInput_1512461937574" name="subTaken[]" max="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product Forms</h4>
                                <h6 class="card-subtitle"> &nbsp;</h6>
                                <form class="form" action="<?php echo $action; ?>" method="post">
                                    <div class="form-group m-t-40 row">
                                        <label for="example-text-input" class="col-2 col-form-label">Product Name</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" value="<?php echo $ds_product_name; ?>" name="ds_product_name" id="ds_product_name" autocomplete="off">
                                        </div>
                                    </div>
                                    <?php //print_r($category_list)?>
                                    <div class="form-group row">
                                        <label for="example-month-input" class="col-2 col-form-label">Category</label>
                                        <div class="col-10">
                                            <select class="custom-select col-12" name="ds_product_category" id="ds_product_category">
                                                <option selected="">Choose Category...</option>
                                                <?php foreach($category_list as $category):?>
                                                <option value="<?php echo $category->ds_product_category_id?>" <?php echo $category->ds_product_category_id == $ds_product_category? 'selected':''?>><?php echo $category->ds_product_category_name?></option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-2 col-form-label">Price</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="ds_product_price" id="ds_product_price" value="<?php echo $ds_product_price; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <hr>
                                    <?php //print_r($attribute_sub_list)?>
                                    <?php foreach($attribute_list as $attribute):?>
                                    <div class="form-group row" id="att_display_<?php echo $attribute->ds_product_attribute_id?>" style="display: none">
                                        <label for="example-search-input" class="col-2 col-form-label"><?php echo $attribute->ds_product_attribute_name?></label>
                                        <div class="col-10">
                                            <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="att_<?php echo $attribute->ds_product_attribute_id?>[]">
                                                <?php foreach($attribute_sub_list as $attribute_sub):?>
                                                <?php if($attribute_sub->ds_product_attribute_parent_id == $attribute->ds_product_attribute_id):?>
                                                <option value="<?php echo $attribute_sub->ds_product_attribute_sub_id;?>"><?php echo $attribute_sub->ds_product_attribute_sub_name?></option>
                                                <?php endif?>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php endforeach?>
                                

                                    <div class="form-group row m-b-0">
                                        <label for="example-search-input" class="col-2 col-form-label">&nbsp;</label>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="ds_product_enable" id="basic_checkbox_2" class="filled-in" <?php echo $ds_product_enable ? 'checked':''?>>
                                                <label for="basic_checkbox_2">Enabled</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row m-b-0">
                                        <label for="example-search-input" class="col-2 col-form-label">&nbsp;</label>
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" name="ds_product_is_service" id="basic_checkbox_3" class="filled-in" <?php echo $ds_product_is_service ? 'checked':''?>>
                                                <label for="basic_checkbox_3">IS SERVICE</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions pull-right">
                                        <input type="hidden" name="ds_product_id" value="<?php echo $ds_product_id; ?>" />
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Attributes</h4>
                                &nbsp;<br>
                                <?php //print_r($attribute_list)?>
                                <?php foreach($attribute_list as $attribute):?>
                                <a href="javascript:void(0)" class="btn btn-info" onclick="$('#att_display_<?php echo $attribute->ds_product_attribute_id?>').show()"><?php echo $attribute->ds_product_attribute_name?></a>
                                <?php endforeach?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © 2017 Admin Pro by wrappixel.com | rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->


    
    <script src="<?php echo base_url('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')?>" type="text/javascript"></script>

    <script type="text/javascript">
        $(".select2").select2();
        function attribute_add(){
            var att_id = $("#att_select").val();
            //alert();
            $("#show_coll_"+att_id).show();
        }
    </script>
</body>
</html>