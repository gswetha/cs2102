<?php
$username = array(
	'name'	=> 'username',
	'id'	=> 'username',
	'value' => set_value('username'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'Username',
	'class' => 'form-control',
);

$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value' => set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'Email',
	'class' => 'form-control',
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'label' => 'Password',
	'class' => 'form-control',
);

$first_name = array(
	'name'	=> 'first_name',
	'id'	=> 'first_name',
	'value' => set_value('first_name'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'First Name',
	'class' => 'form-control',
);

$last_name = array(
	'name'	=> 'last_name',
	'id'	=> 'last_name',
	'value' => set_value('last_name'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'Last Name',
	'class' => 'form-control',
);

$birthdate = array(
	'name'	=> 'birthdate',
	'id'	=> 'birthdate',
	'value' => set_value('birthdate'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'Birthdate (YYYY-MM-DD)',
	'class' => 'form-control',
);

$paypal = array(
	'name'	=> 'paypal',
	'id'	=> 'paypal',
	'value' => set_value('paypal'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'label' => 'Paypal Email',
	'class' => 'form-control',
);

?>
<div class="container mini">
	<div class="content">
		<div class="page-header">
			<h1>Sign up</h1>
		</div>
		<form method="post" class="form-inline">

			<?php if(count($errors) >= 1) { ?>
					<div class="alert-message block-message error">
						<span><strong>Oh Snap!</strong> Your signup was incorrect.</span>
					</div>
				<?php } ?>
				<?php if( validation_errors() ) { ?>
					<div class="alert-message block-message error">
						<span><?php echo validation_errors('<div>','</div>'); ?></span>
					</div>
				<?php } ?>

			<div class="<?php echo strlen(form_error('username')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($username['label'], $username['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($username); ?>
						<?php echo form_error('username','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('email')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($email['label'], $email['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($email); ?>
						<?php echo form_error('email','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('password')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label('Password', $password['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<input type="password" id="password" name="password" class="form-control" />
						<?php echo form_error('password','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('first_name')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($first_name['label'], $first_name['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($first_name); ?>
						<?php echo form_error('first_name','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('last_name')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($last_name['label'], $last_name['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($last_name); ?>
						<?php echo form_error('last_name','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('birthdate')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($birthdate['label'], $birthdate['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($birthdate); ?>
						<?php echo form_error('birthdate','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<div class="<?php echo strlen(form_error('paypal')) ? 'control-group error' : 'control-group'; ?>">
				<?php echo form_label($paypal['label'], $paypal['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input($paypal); ?>
						<?php echo form_error('paypal','<span class="help-inline">', '</span>'); ?>
					</div>
       		</div>
       		<br>
       		<input type="submit" id="submit_login" name="submit_login" value="Sign in" class="btn btn-primary btn-large" />
        </form>
	</div>
</div>