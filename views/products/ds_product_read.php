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
        <h2 style="margin-top:0px">Ds_product Read</h2>
        <table class="table">
	    <tr><td>Ds Product Name</td><td><?php echo $ds_product_name; ?></td></tr>
	    <tr><td>Ds Product Category</td><td><?php echo $ds_product_category; ?></td></tr>
	    <tr><td>Ds Product Enable</td><td><?php echo $ds_product_enable; ?></td></tr>
	    <tr><td>Ds Product Price</td><td><?php echo $ds_product_price; ?></td></tr>
	    <tr><td>Ds Product Date Created</td><td><?php echo $ds_product_date_created; ?></td></tr>
	    <tr><td>Ds Product Last Modified</td><td><?php echo $ds_product_last_modified; ?></td></tr>
	    <tr><td>Ds Product Created By</td><td><?php echo $ds_product_created_by; ?></td></tr>
	    <tr><td>Ds Product Modified By</td><td><?php echo $ds_product_modified_by; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('products') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>