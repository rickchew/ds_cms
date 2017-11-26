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
        <h2 style="margin-top:0px">Mod_clients <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Mod Clients Fullname <?php echo form_error('mod_clients_fullname') ?></label>
            <input type="text" class="form-control" name="mod_clients_fullname" id="mod_clients_fullname" placeholder="Mod Clients Fullname" value="<?php echo $mod_clients_fullname; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Fullname Zh <?php echo form_error('mod_clients_fullname_zh') ?></label>
            <input type="text" class="form-control" name="mod_clients_fullname_zh" id="mod_clients_fullname_zh" placeholder="Mod Clients Fullname Zh" value="<?php echo $mod_clients_fullname_zh; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Nric <?php echo form_error('mod_clients_nric') ?></label>
            <input type="text" class="form-control" name="mod_clients_nric" id="mod_clients_nric" placeholder="Mod Clients Nric" value="<?php echo $mod_clients_nric; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Email <?php echo form_error('mod_clients_email') ?></label>
            <input type="text" class="form-control" name="mod_clients_email" id="mod_clients_email" placeholder="Mod Clients Email" value="<?php echo $mod_clients_email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Occupation <?php echo form_error('mod_clients_occupation') ?></label>
            <input type="text" class="form-control" name="mod_clients_occupation" id="mod_clients_occupation" placeholder="Mod Clients Occupation" value="<?php echo $mod_clients_occupation; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Marital Status <?php echo form_error('mod_clients_marital_status') ?></label>
            <input type="text" class="form-control" name="mod_clients_marital_status" id="mod_clients_marital_status" placeholder="Mod Clients Marital Status" value="<?php echo $mod_clients_marital_status; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Gender <?php echo form_error('mod_clients_gender') ?></label>
            <input type="text" class="form-control" name="mod_clients_gender" id="mod_clients_gender" placeholder="Mod Clients Gender" value="<?php echo $mod_clients_gender; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Nationality <?php echo form_error('mod_clients_nationality') ?></label>
            <input type="text" class="form-control" name="mod_clients_nationality" id="mod_clients_nationality" placeholder="Mod Clients Nationality" value="<?php echo $mod_clients_nationality; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Mod Clients Birthday <?php echo form_error('mod_clients_birthday') ?></label>
            <input type="text" class="form-control" name="mod_clients_birthday" id="mod_clients_birthday" placeholder="Mod Clients Birthday" value="<?php echo $mod_clients_birthday; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Contact 1 <?php echo form_error('mod_clients_contact_1') ?></label>
            <input type="text" class="form-control" name="mod_clients_contact_1" id="mod_clients_contact_1" placeholder="Mod Clients Contact 1" value="<?php echo $mod_clients_contact_1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Contact 2 <?php echo form_error('mod_clients_contact_2') ?></label>
            <input type="text" class="form-control" name="mod_clients_contact_2" id="mod_clients_contact_2" placeholder="Mod Clients Contact 2" value="<?php echo $mod_clients_contact_2; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Attr 1 <?php echo form_error('mod_clients_attr_1') ?></label>
            <input type="text" class="form-control" name="mod_clients_attr_1" id="mod_clients_attr_1" placeholder="Mod Clients Attr 1" value="<?php echo $mod_clients_attr_1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Attr 2 <?php echo form_error('mod_clients_attr_2') ?></label>
            <input type="text" class="form-control" name="mod_clients_attr_2" id="mod_clients_attr_2" placeholder="Mod Clients Attr 2" value="<?php echo $mod_clients_attr_2; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Address <?php echo form_error('mod_clients_address') ?></label>
            <input type="text" class="form-control" name="mod_clients_address" id="mod_clients_address" placeholder="Mod Clients Address" value="<?php echo $mod_clients_address; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Address Country <?php echo form_error('mod_clients_address_country') ?></label>
            <input type="text" class="form-control" name="mod_clients_address_country" id="mod_clients_address_country" placeholder="Mod Clients Address Country" value="<?php echo $mod_clients_address_country; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Address State <?php echo form_error('mod_clients_address_state') ?></label>
            <input type="text" class="form-control" name="mod_clients_address_state" id="mod_clients_address_state" placeholder="Mod Clients Address State" value="<?php echo $mod_clients_address_state; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Col 05 <?php echo form_error('col_05') ?></label>
            <input type="text" class="form-control" name="col_05" id="col_05" placeholder="Col 05" value="<?php echo $col_05; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Col 17 <?php echo form_error('col_17') ?></label>
            <input type="text" class="form-control" name="col_17" id="col_17" placeholder="Col 17" value="<?php echo $col_17; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Col 21 <?php echo form_error('col_21') ?></label>
            <input type="text" class="form-control" name="col_21" id="col_21" placeholder="Col 21" value="<?php echo $col_21; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Col 24 <?php echo form_error('col_24') ?></label>
            <input type="text" class="form-control" name="col_24" id="col_24" placeholder="Col 24" value="<?php echo $col_24; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Col 25 <?php echo form_error('col_25') ?></label>
            <input type="text" class="form-control" name="col_25" id="col_25" placeholder="Col 25" value="<?php echo $col_25; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Passport <?php echo form_error('mod_clients_passport') ?></label>
            <input type="text" class="form-control" name="mod_clients_passport" id="mod_clients_passport" placeholder="Mod Clients Passport" value="<?php echo $mod_clients_passport; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Mod Clients Place Of Birth <?php echo form_error('mod_clients_place_of_birth') ?></label>
            <input type="text" class="form-control" name="mod_clients_place_of_birth" id="mod_clients_place_of_birth" placeholder="Mod Clients Place Of Birth" value="<?php echo $mod_clients_place_of_birth; ?>" />
        </div>
	    <input type="hidden" name="mod_clients_id" value="<?php echo $mod_clients_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('members') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>