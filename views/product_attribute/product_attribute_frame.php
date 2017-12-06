<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('includes/header')?>
    <link href="<?php echo base_url('')?>assets/minimal/css/pages/tab-page.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/minimal/')?>css/pages/floating-label.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/plugins/multiselect/css/multi-select.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('')?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
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
<body>
    <div class="row">
        <div class="col-12">
            <div class="row">
            <div class="form-group col-6">
                <div class="input-group ">
                  <select class="form-control col-6" id="att_select">
                    <option>Select option..</option>
                    <?php foreach($attribute_list as $attribute):?>
                    <option value="<?php echo $attribute->ds_product_attribute_id?>"><?php echo $attribute->ds_product_attribute_name?></option>
                    <?php endforeach?>
                  </select>            
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="button" tabindex="-1" onclick="attribute_add();">ADD</button>
                  </span>
                </div>
            </div>
            <div class="col-6">
                <div class="pull-right">
                <label>Bulk Action &nbsp;</label>
                <select class="form-control col-6">
                    <option></option>
                    <option>Generate All</option>
                </select>
                </div>
            </div>
            </div>
        </div>

        <!-- TEMPLATE -->
        <div class="list-group col-12">
            <?php foreach($attribute_list as $attribute):?>
            <div id="show_coll_<?php echo $attribute->ds_product_attribute_id?>" class="card" style="margin-bottom: 0px;display: none">
                <div class="card-header" role="tab" data-toggle="collapse" data-target="#collapse_<?php echo $attribute->ds_product_attribute_id?>" aria-expanded="false" aria-controls="collapse_<?php echo $attribute->ds_product_attribute_id?>" style="cursor: pointer;">
                  <h5 class="mb-0">
                    <?php echo $attribute->ds_product_attribute_name?>
                  </h5>
                </div>
                <div id="collapse_<?php echo $attribute->ds_product_attribute_id?>" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" >
                  <div class="card-body">
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
                </div>
            </div>
            <?php endforeach?>
        </div>
        <!-- TEMPLATE END-->
    </div>
    <?php $this->load->view('includes/jsFooter')?>
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