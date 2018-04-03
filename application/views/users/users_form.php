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
        <h2 style="margin-top:0px">Users <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Oauth Provider <?php echo form_error('oauth_provider') ?></label>
            <input type="text" class="form-control" name="oauth_provider" id="oauth_provider" placeholder="Oauth Provider" value="<?php echo $oauth_provider; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Oauth Uid <?php echo form_error('oauth_uid') ?></label>
            <input type="text" class="form-control" name="oauth_uid" id="oauth_uid" placeholder="Oauth Uid" value="<?php echo $oauth_uid; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">First Name <?php echo form_error('first_name') ?></label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('last_name') ?></label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Gender <?php echo form_error('gender') ?></label>
            <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender" value="<?php echo $gender; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Locale <?php echo form_error('locale') ?></label>
            <input type="text" class="form-control" name="locale" id="locale" placeholder="Locale" value="<?php echo $locale; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Picture Url <?php echo form_error('picture_url') ?></label>
            <input type="text" class="form-control" name="picture_url" id="picture_url" placeholder="Picture Url" value="<?php echo $picture_url; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Profile Url <?php echo form_error('profile_url') ?></label>
            <input type="text" class="form-control" name="profile_url" id="profile_url" placeholder="Profile Url" value="<?php echo $profile_url; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Created <?php echo form_error('created') ?></label>
            <input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Modified <?php echo form_error('modified') ?></label>
            <input type="text" class="form-control" name="modified" id="modified" placeholder="Modified" value="<?php echo $modified; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>