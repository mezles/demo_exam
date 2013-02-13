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
				
				
				<?php echo form_open(); ?>
					<?php echo form_label( 'Team Name', 'teamname' ); ?>
					<?php echo form_input( array( 'name' => 'teamname', 'id' => 'teamname', 'value' => set_value( 'teamname' ) ) ); ?>
					<p></p>
					<?php echo form_submit( 'create_team', 'Create Team' ); ?>
				<?php echo form_close(); ?>
				
			</div>
			
			<div class="clear"></div>
			
		</div>
		
	</div>

<?php echo $footer; ?>
