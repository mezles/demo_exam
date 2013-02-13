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
				
					<label for="username">
						<span><?php echo 'Username'; ?></span>
						<?php echo form_input( array( 
							'name' => 'username', 
							'id' => 'username',
							'disabled' => 'disabled',
							'value' => ( set_value( 'username' ) ) ? set_value( 'username' ) : $user->username ) ); 
						?>
					</label>
					
					<label for="change_pass">
						<span><?php echo 'Change Password'; ?></span>
						<?php echo form_checkbox( array( 'name' => 'change_pass', 'id' => 'change_pass' ) ); ?>
					</label>
					
					<div class="pass-wrapper">
						<label for="password">
							<span><?php echo 'Password'; ?></span>
							<?php echo form_password( array( 'name' => 'password', 'id' => 'password' ) ); ?>
						</label>
					</div>
					
					<label for="level">
						<span><?php echo 'User Level'; ?></span>
						<?php echo form_dropdown( 'level', $lvl_opt, 
							( set_value( 'level' ) ) ? set_value( 'level' ) : $user->level ); ?>
					</label>
					
					<p></p>
						<?php echo form_hidden( 'user_id', $user_id ); ?>
					<?php echo form_submit( 'update_user', 'Update User' ); ?>
					
				<?php echo form_close(); ?>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>

<?php echo $footer; ?>
