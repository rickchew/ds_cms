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
        <h2 style="margin-top:0px">Ds_branch <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Ds Branch Name <?php echo form_error('ds_branch_name') ?></label>
            <input type="text" class="form-control" name="ds_branch_name" id="ds_branch_name" placeholder="Ds Branch Name" value="<?php echo $ds_branch_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ds Branch Code <?php echo form_error('ds_branch_code') ?></label>
            <input type="text" class="form-control" name="ds_branch_code" id="ds_branch_code" placeholder="Ds Branch Code" value="<?php echo $ds_branch_code; ?>" />
        </div>
	    <input type="hidden" name="ds_branch_id" value="<?php echo $ds_branch_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('branch') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>