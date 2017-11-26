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
        <h2 style="margin-top:0px">Ds_product_category <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Ds Product Category Name <?php echo form_error('ds_product_category_name') ?></label>
            <input type="text" class="form-control" name="ds_product_category_name" id="ds_product_category_name" placeholder="Ds Product Category Name" value="<?php echo $ds_product_category_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">Ds Product Category Enable <?php echo form_error('ds_product_category_enable') ?></label>
            <input type="text" class="form-control" name="ds_product_category_enable" id="ds_product_category_enable" placeholder="Ds Product Category Enable" value="<?php echo $ds_product_category_enable; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Ds Product Category Date Created <?php echo form_error('ds_product_category_date_created') ?></label>
            <input type="text" class="form-control" name="ds_product_category_date_created" id="ds_product_category_date_created" placeholder="Ds Product Category Date Created" value="<?php echo $ds_product_category_date_created; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Ds Product Category Date Modified <?php echo form_error('ds_product_category_date_modified') ?></label>
            <input type="text" class="form-control" name="ds_product_category_date_modified" id="ds_product_category_date_modified" placeholder="Ds Product Category Date Modified" value="<?php echo $ds_product_category_date_modified; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ds Product Category Created By <?php echo form_error('ds_product_category_created_by') ?></label>
            <input type="text" class="form-control" name="ds_product_category_created_by" id="ds_product_category_created_by" placeholder="Ds Product Category Created By" value="<?php echo $ds_product_category_created_by; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ds Product Category Modified By <?php echo form_error('ds_product_category_modified_by') ?></label>
            <input type="text" class="form-control" name="ds_product_category_modified_by" id="ds_product_category_modified_by" placeholder="Ds Product Category Modified By" value="<?php echo $ds_product_category_modified_by; ?>" />
        </div>
	    <input type="hidden" name="ds_product_category_id" value="<?php echo $ds_product_category_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('product_category') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>