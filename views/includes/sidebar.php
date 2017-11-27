<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    $active_menu_id = isset($active_menu_id) ? $active_menu_id:'';

/*------------------------
    
        ACL SETTING

------------------------*/

    // Get Parent and Child menu
    $parent = $this->menu_model->getParent('main_menu');
    $child = $this->menu_model->getChild('main_menu');

    // Get Access Array
    $access = $this->access_control_model->get_access_by_id($this->session->userdata('group_id'));

    $user_group = $this->session->userdata['group_id'];
    $child_arr = array();
                
    foreach($child as $tmp){
        array_push($child_arr,$tmp->parent_id);
    }
    $child_arr = array_unique($child_arr);
 
    //print_r($active_menu_id);
    $active_menu_id = isset($active_menu_id) ? $active_menu_id:'';

    //print_r($active_menu_id);
?>
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="nav-small-cap">MAIN MENU</li>
            <!--
            <li class="active"> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
            </li>-->
            <?php foreach($parent as $pv):?>
            <?php if(in_array($pv->menu_id, $child_arr)):   //Parent with child?>
            <?php 
                $active = $active_menu_id == $pv->menu_id ? 'active':'';
                //$display = $this->input->get('menu_active') == $pv->menu_id ? 'display: block':'display: none';
            ?>
            <?php if(in_array($pv->menu_id, $access)):?>
            <li class="<?php echo $active?>"> 
            <a class="has-arrow waves-effect waves-dark" aria-expanded="false" href="javascript:void(0)"><i class="<?php echo $pv->menu_icon?>"></i><span class="hide-menu"><?php echo $pv->menu_name?></span></a>
                <ul aria-expanded="false" class="collapse">
                    <?php foreach($child as $ca):?>
                    <?php if(in_array($ca->menu_id, $access)):?>
                        <?php if($ca->parent_id == $pv->menu_id):?>
                            <li><a href="<?php echo site_url($ca->menu_url)?>"><?php echo $ca->menu_name?></a></li>
                            <!--<li><a href="<?php echo site_url($ca->menu_url."?menu_active=".$ca->menu_id)?>"><?php echo $ca->menu_name?></a></li>-->
                        <?php endif?>
                    <?php endif?>
                    <?php endforeach?>
                </ul>
            </li>
            <?php endif?>
            <?php else: //Parent without child?>
            <?php 
                
                $active = $active_menu_id == $pv->menu_id ? 'active':'';
                /*
                $style = $active_menu_id == $pv->menu_id ? 'background: rgba(0,0,0,0.07);':'';*/
            ?>
            <?php if(in_array($pv->menu_id, $access)):?>
            <li class="<?php echo $active?>"> <a class="waves-effect waves-dark" href="<?php echo site_url($pv->menu_url)?>" aria-expanded="false"><i class="<?php echo $pv->menu_icon?>"></i><span class="hide-menu"><?php echo $pv->menu_name?></span></a>
            <?php endif?>
            <?php endif?>
            <?php endforeach?>
            <!-- <?php echo anchor($pv->menu_url,'<i class="'.$pv->menu_icon.'"></i><span>'.$pv->menu_name.'</span>',array('class' => 'has-arrow waves-effect waves-dark'))?> -->
            <li class=""> <a class="waves-effect waves-dark" href="<?php echo site_url('logout')?>" aria-expanded="false"><i class="mdi mdi-logout-variant"></i><span class="hide-menu">Logout</span></a></li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>