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
        <h2 style="margin-top:0px">Ds_product_attribute <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Ds Product Attribute Name <?php echo form_error('ds_product_attribute_name') ?></label>
            <input type="text" class="form-control" name="ds_product_attribute_name" id="ds_product_attribute_name" placeholder="Ds Product Attribute Name" value="<?php echo $ds_product_attribute_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Ds Product Attribute Enable <?php echo form_error('ds_product_attribute_enable') ?></label>
            <input type="text" class="form-control" name="ds_product_attribute_enable" id="ds_product_attribute_enable" placeholder="Ds Product Attribute Enable" value="<?php echo $ds_product_attribute_enable; ?>" />
        </div>
	    <input type="hidden" name="ds_product_attribute_id" value="<?php echo $ds_product_attribute_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_attribute') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>