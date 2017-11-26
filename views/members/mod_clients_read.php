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
        <h2 style="margin-top:0px">Mod_clients Read</h2>
        <table class="table">
	    <tr><td>Mod Clients Fullname</td><td><?php echo $mod_clients_fullname; ?></td></tr>
	    <tr><td>Mod Clients Fullname Zh</td><td><?php echo $mod_clients_fullname_zh; ?></td></tr>
	    <tr><td>Mod Clients Nric</td><td><?php echo $mod_clients_nric; ?></td></tr>
	    <tr><td>Mod Clients Email</td><td><?php echo $mod_clients_email; ?></td></tr>
	    <tr><td>Mod Clients Occupation</td><td><?php echo $mod_clients_occupation; ?></td></tr>
	    <tr><td>Mod Clients Marital Status</td><td><?php echo $mod_clients_marital_status; ?></td></tr>
	    <tr><td>Mod Clients Gender</td><td><?php echo $mod_clients_gender; ?></td></tr>
	    <tr><td>Mod Clients Nationality</td><td><?php echo $mod_clients_nationality; ?></td></tr>
	    <tr><td>Mod Clients Birthday</td><td><?php echo $mod_clients_birthday; ?></td></tr>
	    <tr><td>Mod Clients Contact 1</td><td><?php echo $mod_clients_contact_1; ?></td></tr>
	    <tr><td>Mod Clients Contact 2</td><td><?php echo $mod_clients_contact_2; ?></td></tr>
	    <tr><td>Mod Clients Attr 1</td><td><?php echo $mod_clients_attr_1; ?></td></tr>
	    <tr><td>Mod Clients Attr 2</td><td><?php echo $mod_clients_attr_2; ?></td></tr>
	    <tr><td>Mod Clients Address</td><td><?php echo $mod_clients_address; ?></td></tr>
	    <tr><td>Mod Clients Address Country</td><td><?php echo $mod_clients_address_country; ?></td></tr>
	    <tr><td>Mod Clients Address State</td><td><?php echo $mod_clients_address_state; ?></td></tr>
	    <tr><td>Col 05</td><td><?php echo $col_05; ?></td></tr>
	    <tr><td>Col 17</td><td><?php echo $col_17; ?></td></tr>
	    <tr><td>Col 21</td><td><?php echo $col_21; ?></td></tr>
	    <tr><td>Col 24</td><td><?php echo $col_24; ?></td></tr>
	    <tr><td>Col 25</td><td><?php echo $col_25; ?></td></tr>
	    <tr><td>Mod Clients Passport</td><td><?php echo $mod_clients_passport; ?></td></tr>
	    <tr><td>Mod Clients Place Of Birth</td><td><?php echo $mod_clients_place_of_birth; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('members') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>