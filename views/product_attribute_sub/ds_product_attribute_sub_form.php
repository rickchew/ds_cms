<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Ds_product_attribute_sub <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Ds Product Attribute Parent Id <?php echo form_error('ds_product_attribute_parent_id') ?></label>
            <input type="text" class="form-control" name="ds_product_attribute_parent_id" id="ds_product_attribute_parent_id" placeholder="Ds Product Attribute Parent Id" value="<?php echo $ds_product_attribute_parent_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ds Product Attribute Sub Name <?php echo form_error('ds_product_attribute_sub_name') ?></label>
            <input type="text" class="form-control" name="ds_product_attribute_sub_name" id="ds_product_attribute_sub_name" placeholder="Ds Product Attribute Sub Name" value="<?php echo $ds_product_attribute_sub_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Ds Product Attribute Sub Enable <?php echo form_error('ds_product_attribute_sub_enable') ?></label>
            <input type="text" class="form-control" name="ds_product_attribute_sub_enable" id="ds_product_attribute_sub_enable" placeholder="Ds Product Attribute Sub Enable" value="<?php echo $ds_product_attribute_sub_enable; ?>" />
        </div>
	    <input type="hidden" name="ds_product_attribute_sub_id" value="<?php echo $ds_product_attribute_sub_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_attribute_sub') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>