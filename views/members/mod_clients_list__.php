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
        <h2 style="margin-top:0px">Mod_clients List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('members/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('members/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('members'); ?>" class="btn btn-default">Reset</a>
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
		<th>Mod Clients Fullname</th>
		<th>Mod Clients Fullname Zh</th>
		<th>Mod Clients Nric</th>
		<th>Mod Clients Email</th>
		<th>Mod Clients Occupation</th>
		<th>Mod Clients Marital Status</th>
		<th>Mod Clients Gender</th>
		<th>Mod Clients Nationality</th>
		<th>Mod Clients Birthday</th>
		<th>Mod Clients Contact 1</th>
		<th>Mod Clients Contact 2</th>
		<th>Mod Clients Attr 1</th>
		<th>Mod Clients Attr 2</th>
		<th>Mod Clients Address</th>
		<th>Mod Clients Address Country</th>
		<th>Mod Clients Address State</th>
		<th>Col 05</th>
		<th>Col 17</th>
		<th>Col 21</th>
		<th>Col 24</th>
		<th>Col 25</th>
		<th>Mod Clients Passport</th>
		<th>Mod Clients Place Of Birth</th>
		<th>Action</th>
            </tr><?php
            foreach ($members_data as $members)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $members->mod_clients_fullname ?></td>
			<td><?php echo $members->mod_clients_fullname_zh ?></td>
			<td><?php echo $members->mod_clients_nric ?></td>
			<td><?php echo $members->mod_clients_email ?></td>
			<td><?php echo $members->mod_clients_occupation ?></td>
			<td><?php echo $members->mod_clients_marital_status ?></td>
			<td><?php echo $members->mod_clients_gender ?></td>
			<td><?php echo $members->mod_clients_nationality ?></td>
			<td><?php echo $members->mod_clients_birthday ?></td>
			<td><?php echo $members->mod_clients_contact_1 ?></td>
			<td><?php echo $members->mod_clients_contact_2 ?></td>
			<td><?php echo $members->mod_clients_attr_1 ?></td>
			<td><?php echo $members->mod_clients_attr_2 ?></td>
			<td><?php echo $members->mod_clients_address ?></td>
			<td><?php echo $members->mod_clients_address_country ?></td>
			<td><?php echo $members->mod_clients_address_state ?></td>
			<td><?php echo $members->col_05 ?></td>
			<td><?php echo $members->col_17 ?></td>
			<td><?php echo $members->col_21 ?></td>
			<td><?php echo $members->col_24 ?></td>
			<td><?php echo $members->col_25 ?></td>
			<td><?php echo $members->mod_clients_passport ?></td>
			<td><?php echo $members->mod_clients_place_of_birth ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('members/read/'.$members->mod_clients_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('members/update/'.$members->mod_clients_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('members/delete/'.$members->mod_clients_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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