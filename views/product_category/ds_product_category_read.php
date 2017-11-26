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
        <h2 style="margin-top:0px">Ds_product_category Read</h2>
        <table class="table">
	    <tr><td>Ds Product Category Name</td><td><?php echo $ds_product_category_name; ?></td></tr>
	    <tr><td>Ds Product Category Enable</td><td><?php echo $ds_product_category_enable; ?></td></tr>
	    <tr><td>Ds Product Category Date Created</td><td><?php echo $ds_product_category_date_created; ?></td></tr>
	    <tr><td>Ds Product Category Date Modified</td><td><?php echo $ds_product_category_date_modified; ?></td></tr>
	    <tr><td>Ds Product Category Created By</td><td><?php echo $ds_product_category_created_by; ?></td></tr>
	    <tr><td>Ds Product Category Modified By</td><td><?php echo $ds_product_category_modified_by; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('product_category') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>