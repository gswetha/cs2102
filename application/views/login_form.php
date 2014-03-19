<?php
$login = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value' => set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);

$login_label = 'Email';

?>
<div class="container mini">
	<div class="content">
		<div class="page-header">
			<h1>Login</h1>
		</div>
		<form method="post" class="form-inline">

			<?php if(isset($errors['email']) || isset($errors['password']) ) { ?>
					<div class="alert-message block-message error">
						<span><strong>Oh Snap!</strong> Your login was incorrect.</span>
					</div>
				<?php } ?>
				<?php if( validation_errors() ) { ?>
					<div class="alert-message block-message error">
						<span><?php echo validation_errors('<div>','</div>'); ?></span>
					</div>
				<?php } ?>

			<div class="<?php echo strlen(form_error('email')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($login_label, $login['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<input type="text" id="email" name="email" class="form-control" />
						<?php echo form_error('email','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('password')) ? 'control-group error' : 'control-group'; ?>">
				<span>Password<input type="password" class="form-control" placeholder="Password" name="password" id="password"></span>
				<?php echo form_error('password','<span class="help-inline">', '</span>'); ?>
       		</div>
       		<br>
       		<input type="submit" id="submit_login" name="submit_login" value="Sign in" class="btn btn-primary btn-large" />
        </form>
	</div>
</div>