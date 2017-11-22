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
        <h2 style="margin-top:0px">Ds_branch Read</h2>
        <table class="table">
	    <tr><td>Ds Branch Name</td><td><?php echo $ds_branch_name; ?></td></tr>
	    <tr><td>Ds Branch Code</td><td><?php echo $ds_branch_code; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('branch') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>