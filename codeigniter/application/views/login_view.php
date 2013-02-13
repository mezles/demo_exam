<?php echo $header; ?>

	<div id="body">
		
		<div class="body-wrapper">
		
			<div class="content-wrapper">
				<div class="error-wrapper">
					<?php //echo $this->session->flashdata( 'error' ); ?>
					<?php echo $error; ?>
					<?php echo validation_errors(); ?>
				</div>
				
				<?php echo form_open(); ?>
				<?php echo form_label( 'Username', 'username' ); ?>
				<?php echo form_input( array( 'name' => 'username', 'id' => 'username', 'value' => set_value( 'username' ) ) ); ?>
				<?php echo form_label( 'Password', 'password' ); ?>
				<?php echo form_password( array( 'name' => 'password', 'id' => 'password' ) ); ?>
				<p></p>
				<?php echo form_submit( 'login', 'Login' ); ?>
				<?php echo form_close(); ?>
				
			</div>
			
		</div>
		
	</div>

<?php echo $footer; ?>
