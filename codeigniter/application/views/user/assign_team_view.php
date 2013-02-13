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
				
					<?php echo form_label( 'User Type', 'usertype' ); ?>
					<?php echo form_dropdown( 'usertype', $lvl_opt ); ?>
					<?php echo form_label( 'User Name', 'username' ); ?>
					<select id="username" name="username">
						<?php if ( is_array( $users ) && ! empty( $users ) && $users ): ?>
							<?php foreach ( $users as $user ): ?>
								<option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
					<?php echo form_label( 'Assign to Team', 'team' ); ?>
					<select id="team" name="team">
						<?php if ( is_array( $teams ) && ! empty( $teams ) && $teams ): ?>
							<?php foreach ( $teams as $team ): ?>
								<option value="<?php echo $team->id; ?>"><?php echo $team->name; ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
					<p></p>
					<?php echo form_submit( 'assign_team', 'Assign Team' ); ?>
					
				<?php echo form_close(); ?>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>
	
<?php echo $footer; ?>
