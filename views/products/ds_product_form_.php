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
        <h2 style="margin-top:0px">Ds_product <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Ds Product Name <?php echo form_error('ds_product_name') ?></label>
            <input type="text" class="form-control" name="ds_product_name" id="ds_product_name" placeholder="Ds Product Name" value="<?php echo $ds_product_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ds Product Category <?php echo form_error('ds_product_category') ?></label>
            <input type="text" class="form-control" name="ds_product_category" id="ds_product_category" placeholder="Ds Product Category" value="<?php echo $ds_product_category; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Ds Product Enable <?php echo form_error('ds_product_enable') ?></label>
            <input type="text" class="form-control" name="ds_product_enable" id="ds_product_enable" placeholder="Ds Product Enable" value="<?php echo $ds_product_enable; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Ds Product Price <?php echo form_error('ds_product_price') ?></label>
            <input type="text" class="form-control" name="ds_product_price" id="ds_product_price" placeholder="Ds Product Price" value="<?php echo $ds_product_price; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Ds Product Date Created <?php echo form_error('ds_product_date_created') ?></label>
            <input type="text" class="form-control" name="ds_product_date_created" id="ds_product_date_created" placeholder="Ds Product Date Created" value="<?php echo $ds_product_date_created; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Ds Product Last Modified <?php echo form_error('ds_product_last_modified') ?></label>
            <input type="text" class="form-control" name="ds_product_last_modified" id="ds_product_last_modified" placeholder="Ds Product Last Modified" value="<?php echo $ds_product_last_modified; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ds Product Created By <?php echo form_error('ds_product_created_by') ?></label>
            <input type="text" class="form-control" name="ds_product_created_by" id="ds_product_created_by" placeholder="Ds Product Created By" value="<?php echo $ds_product_created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ds Product Modified By <?php echo form_error('ds_product_modified_by') ?></label>
            <input type="text" class="form-control" name="ds_product_modified_by" id="ds_product_modified_by" placeholder="Ds Product Modified By" value="<?php echo $ds_product_modified_by; ?>" />
        </div>
	    <input type="hidden" name="ds_product_id" value="<?php echo $ds_product_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('products') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>