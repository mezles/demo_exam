<?php echo $header; ?>

	<div id="body">
	
		<div class="body-wrapper">
		
			<?php echo $left_nav; ?>
			
			<div class="content-wrapper">
			
				<h2><?php echo $page_subtitle; ?></h2>
				
				<div class="error-wrapper">
				<?php echo $this->session->flashdata( 'error' ); ?>
				<?php echo validation_errors(); ?>
				</div>
				
				<?php $lvl_opt = array( '3' => 'Regular User', '2' => 'Supervisor' ); ?>
				<?php echo form_open(); ?>
					<?php echo form_label( 'Username', 'username' ); ?>
					<?php echo form_input( array( 'name' => 'username', 'id' => 'username', 'value' => set_value( 'username' ) ) ); ?>
					<?php echo form_label( 'Password', 'password' ); ?>
					<?php echo form_password( array( 'name' => 'password', 'id' => 'password' ) ); ?>
					<?php echo form_label( 'User Level', 'level' ); ?>
					<?php echo form_dropdown( 'level', $lvl_opt, set_value( 'level' ) ); ?>
					<p></p>
					<?php echo form_submit( 'create_user', 'Create User' ); ?>
				<?php echo form_close(); ?>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>

<?php echo $footer; ?>
