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
                    <h3 class="text-themecolor">Member List</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Members</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><!--Responsive Table --></h4>
                                <h6 class="card-subtitle"><!--Create responsive tables by wrapping any <code>.table</code> in <code>.table-responsive </code>--></h6>
                                <?php if($this->session->userdata('message')):?>
                                <div class="alert alert-success"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> </div>&nbsp;<br>&nbsp;<br>
                                <?php endif?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo site_url('members/index'); ?>" class="form-inline" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" autocomplete="off" spellcheck="false">
                                                <span class="input-group-btn">
                                                    <?php 
                                                        if ($q <> '')
                                                        {
                                                            ?>
                                                            <a href="<?php echo site_url('members/'); ?>" class="btn btn-info"><i class="fa fa-close"></i></a>
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
                                        <?php echo anchor(site_url('members/create'),'<i class="mdi-flash mdi"></i> Quick Add', 'class="btn btn-success"'); ?>&nbsp;
                                        <?php echo anchor(site_url('members/create'),'<i class="mdi-account-plus mdi"></i> New Member', 'class="btn btn-success"'); ?>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="table-responsive">
                                    <table class="table table-hover success-bordered-table color-bordered-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>NRIC</th>
                                                <th>Occupation</th>
                                                <th>Gender</th>
                                                <th class="text-center">Nationality</th>
                                                <th class="text-center">Birthday</th>
                                                <th class="text-center">Mobile</th>
                                                <th>Place Of Birth</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-weight: 400;">
                                            <?php foreach($members_data as $members):?>
                                            <tr>
                                                <td width="80px"><?php echo ++$start ?></td>
                                                <td><?php echo $members->mod_clients_fullname.' '.$members->mod_clients_fullname_zh ?></td>
                                                <td><?php echo $members->mod_clients_nric ?></td>
                                                <td><?php echo $members->mod_clients_occupation ?></td>
                                                <td><?php echo $members->mod_clients_gender ?></td>
                                                <td class="text-center"><?php echo $members->mod_clients_nationality ?></td>
                                                <td class="text-center"><?php echo $members->mod_clients_birthday ?></td>
                                                <td><?php echo $members->mod_clients_contact_1 ?><?php echo $members->mod_clients_contact_2 ? '<br>'.$members->mod_clients_contact_2:'' ?></td>
                                                <td><?php echo $members->mod_clients_place_of_birth ?></td>
                                                <td style="text-align:center" width="200px">

                                                    <?php 
                                                    /*
                                                    echo anchor(site_url('members/read/'.$members->mod_clients_id),'Read'); 
                                                    echo ' | '; 
                                                    echo anchor(site_url('members/update/'.$members->mod_clients_id),'Update'); 
                                                    echo ' | '; 
                                                    echo anchor(site_url('members/delete/'.$members->mod_clients_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); */
                                                    ?>
                                                    <div class="btn-group">
                                                      <?php
                                                      echo anchor(site_url('members/read/'.$members->mod_clients_id),'<i class="fa fa-search text-inverse m-r-10"></i>&nbsp;','data-toggle="tooltip"');
                                                      echo anchor(site_url('members/update/'.$members->mod_clients_id),' <i class="fa fa-pencil text-inverse m-r-10"></i>','data-toggle="tooltip"'); 
                                                      //echo anchor(site_url('members/delete/'.$members->mod_clients_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')" class="btn btn-primary"'); 
                                                      
                                                      ?>
                                                      <!--
                                                      <button type="button" class="btn btn-primary">Apple</button>
                                                      <button type="button" class="btn btn-primary">Samsung</button>
                                                      <button type="button" class="btn btn-primary">Sony</button>-->
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
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
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2017 Admin Pro by wrappixel.com | rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="<?php echo base_url()?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url()?>/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url()?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url('assets/minimal/')?>js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url('assets/minimal/')?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url('assets/minimal/')?>js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url()?>/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url()?>/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url('assets/minimal/')?>js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url()?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>