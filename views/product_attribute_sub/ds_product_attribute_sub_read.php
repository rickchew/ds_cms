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
        <h2 style="margin-top:0px">Ds_product_attribute_sub Read</h2>
        <table class="table">
	    <tr><td>Ds Product Attribute Parent Id</td><td><?php echo $ds_product_attribute_parent_id; ?></td></tr>
	    <tr><td>Ds Product Attribute Sub Name</td><td><?php echo $ds_product_attribute_sub_name; ?></td></tr>
	    <tr><td>Ds Product Attribute Sub Enable</td><td><?php echo $ds_product_attribute_sub_enable; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product_attribute_sub') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>