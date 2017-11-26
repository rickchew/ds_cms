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
        <h2 style="margin-top:0px">Ds_product List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('products/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('products/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('products'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ds Product Name</th>
		<th>Ds Product Category</th>
		<th>Ds Product Enable</th>
		<th>Ds Product Price</th>
		<th>Ds Product Date Created</th>
		<th>Ds Product Last Modified</th>
		<th>Ds Product Created By</th>
		<th>Ds Product Modified By</th>
		<th>Action</th>
            </tr><?php
            foreach ($products_data as $products)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $products->ds_product_name ?></td>
			<td><?php echo $products->ds_product_category ?></td>
			<td><?php echo $products->ds_product_enable ?></td>
			<td><?php echo $products->ds_product_price ?></td>
			<td><?php echo $products->ds_product_date_created ?></td>
			<td><?php echo $products->ds_product_last_modified ?></td>
			<td><?php echo $products->ds_product_created_by ?></td>
			<td><?php echo $products->ds_product_modified_by ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('products/read/'.$products->ds_product_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('products/update/'.$products->ds_product_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('products/delete/'.$products->ds_product_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>