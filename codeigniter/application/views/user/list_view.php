<?php echo $header; ?>

	<div id="body">
	
		<?php echo $left_nav; ?>
		
		<div class="content-wrapper">
			<h2><?php echo $page_subtitle; ?></h2>
			<?php //var_dump($users); ?>
			
			<div class="error-wrapper">
				<?php echo $this->session->flashdata( 'error' ); ?>
			</div>
			
			<div class="success-wrapper">
				<?php echo $this->session->flashdata( 'success' ); ?>
			</div>
			
			<table class="table">
				<thead>
					<tr>
						<th><?php echo 'ID'; ?></th>
						<th><?php echo 'Username'; ?></th>
						<th><?php echo 'Level'; ?></th>
						<th><?php echo 'Team'; ?></th>
						<th><?php echo 'Action'; ?></th>
					</tr>
				</thead>
				
				<tbody>
				<?php foreach ( $users as $user ): ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->username; ?></td>
						<td><?php echo $this->user_model->get_level_by_id( $user->level ); ?></td>
						<td><?php echo $this->team_model->get_team_by_id( $user->id, 'name' ); ?></td>
						<td>
							<a href="<?php echo site_url( 'user/edit/' . $user->id ); ?>"><?php 
							echo 'Edit'; ?></a><?php echo '|';?>
							<a href="#"><?php echo 'Delete'; ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
				
			</table>
		</div>
		
		<div class="clear"></div>
		
	</div>

<?php echo $footer; ?>
