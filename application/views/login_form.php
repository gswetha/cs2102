<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div class="container mini">
	<div class="content">
		<div class="page-header">
			<h1>Login</h1>
		</div>
		<?php echo form_open($this->uri->uri_string(), $arrayName = array('class' => 'form-horizontal login')); ?>
				<?php if(isset($errors[$login['name']]) || isset($errors[$password['name']]) ) { ?>
					<div class="alert-message block-message error">
						<span><strong>Oh Snap!</strong> Your login was incorrect.  Get a <?php echo anchor('/auth/forgot_password/', 'password reminder &raquo;', 'class=""'); ?></span>
					</div>
				<?php } ?>
				<?php if( validation_errors() ) { ?>
					<div class="alert-message block-message error">
						<span><?php echo validation_errors('<div>','</div>'); ?></span>
					</div>
				<?php } ?>
			<div class="">
		        <div class="<?php echo strlen(form_error($login['name'])) ? 'control-group error' : 'control-group'; ?>">
					<?php echo form_label($login_label, $login['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_input('login'); ?>
					    <?php echo form_error($login['name'],'<span class="help-inline">', '</span>'); ?><?php //echo isset($errors[$login['name']]) ? '<span class="help-inline">'.$errors[$login['name']].'</span>' : ''; ?>
					</div>
		        </div>
		        <div class="<?php echo strlen(form_error($password['name'])) ? 'control-group error' : 'control-group'; ?>">
					<?php echo form_label('Password', $password['id'], $arrayName = array('class' => 'control-label')); ?>
					<div class="controls">
						<?php echo form_password('password'); ?>
				    	<?php echo form_error($password['name'],'<span class="help-inline">', '</span>'); ?><?php //echo isset($errors[$password['name']]) ? '<span class="help-inline">'.$errors[$password['name']].'</span>' : ''; ?>
			    	</div>
				</div>
				<?php if ($show_captcha) { ?>
			        <div class="control-group">
						<div class="controls">
							<p>Enter the code exactly as it appears:</p>
							<?php echo $captcha_html; ?>
				    	</div>
					</div>
			        <div class="<?php echo strlen(form_error($captcha['name'])) ? 'control-group error' : 'control-group'; ?>">
						<?php //echo form_label('Confirmation Code', $captcha['id']); ?>
						<div class="controls">
							<td><?php echo form_input($captcha); ?></td>
					    	<?php echo form_error($captcha['name'],'<span class="help-inline">', '</span>'); ?><?php //echo isset($errors[$password['name']]) ? '<span class="help-inline">'.$errors[$password['name']].'</span>' : ''; ?>
				    	</div>
					</div>
				<?php } ?>
				<!-- <div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox"> I agree to SRECTrade's <a href="">Terms &amp; Conditions</a> and <a href="">Privacy Policy</a>
						</label>
					</div>
				</div> -->
		        <div class="control-group">
		        	<div class="controls">
			        	<input type="submit" id="submit_login" name="submit_login" value="Sign in" class="btn btn-primary btn-large" />
			        	<?php //echo form_submit('submit', 'Let me in'); ?>
			       		<!-- <a href="/app/auth/forgot_password" class="btn secondary">Forgot password &raquo;</a> -->
			       		<?php echo anchor('/auth/forgot_password/', 'Forgot password', 'class=""'); ?>
						<?php if ($this->config->item('allow_registration', 'tank_auth')) echo " or " . anchor('/auth/register/', 'Create an account', 'class=""'); ?>
					</div>
		        </div>
	    	</div>
        <?php echo form_close(); ?>
	</div>
</div>