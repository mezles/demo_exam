<div id="body">
		
	<div class="body-wrapper">
	
		<div class="content-wrapper">
			<div class="error-wrapper">
				<?php //echo $this->session->flashdata( 'error' ); ?>
				<?php //echo $error; ?>
				<?php //echo validation_errors(); ?>
			</div>
			
			<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'index'))); ?>
			<?php echo $this->Form->input('username', array('label' => 'Username')); // has a label element ?>
			<?php echo $this->Form->input('password', array('label' => 'Password')); ?>
			<?php //echo form_label( 'Username', 'username' ); ?>
			<?php //echo form_input( array( 'name' => 'username', 'id' => 'username', 'value' => set_value( 'username' ) ) ); ?>
			<?php //echo form_label( 'Password', 'password' ); ?>
			<?php //echo form_password( array( 'name' => 'password', 'id' => 'password' ) ); ?>
			<p></p>
			<?php //echo form_submit( 'login', 'Login' ); ?>
			<?php echo $this->Form->end('Login'); ?>
			
		</div>
		
	</div>
	
</div>